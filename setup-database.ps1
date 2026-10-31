$ErrorActionPreference = 'Stop'

$mysqlCommand = Get-Command mysql -ErrorAction SilentlyContinue
if ($mysqlCommand) {
    $mysqlPath = $mysqlCommand.Source
} elseif (Test-Path 'C:\Program Files\MySQL\MySQL Server 26.7\bin\mysql.exe') {
    $mysqlPath = 'C:\Program Files\MySQL\MySQL Server 26.7\bin\mysql.exe'
} elseif (Test-Path 'C:\xampp\mysql\bin\mysql.exe') {
    $mysqlPath = 'C:\xampp\mysql\bin\mysql.exe'
} else {
    throw 'The MySQL command-line client was not found. Install MySQL or XAMPP and add mysql.exe to PATH.'
}

$dumpPath = Join-Path $PSScriptRoot 'database\tms.sql'
$configPath = Join-Path $PSScriptRoot 'config.local.php'
if (-not (Test-Path $dumpPath)) {
    throw "The database dump was not found: $dumpPath"
}
if ((Test-Path $configPath) -and (Read-Host 'A local database config already exists. Replace it? [y/N]') -notmatch '^(y|yes)$') {
    throw 'Setup canceled; the existing database configuration was not changed.'
}

$adminUser = Read-Host 'MySQL administrator username [root]'
if ([string]::IsNullOrWhiteSpace($adminUser)) {
    $adminUser = 'root'
}
if ($adminUser -notmatch '^[A-Za-z0-9_.@$-]+$') {
    throw 'Use a MySQL username containing only letters, numbers, underscores, dots, at signs, or hyphens.'
}

$dbHost = Read-Host 'MySQL host [127.0.0.1]'
if ([string]::IsNullOrWhiteSpace($dbHost)) {
    $dbHost = '127.0.0.1'
}
if ($dbHost -notmatch '^[A-Za-z0-9.:-]+$') {
    throw 'Use a valid local host name or IP address.'
}

$dbPort = 0
$dbPortInput = Read-Host 'MySQL port [3307]'
if ([string]::IsNullOrWhiteSpace($dbPortInput)) {
    $dbPort = 3307
} else {
    $cleanPort = ($dbPortInput -replace '\D', '').Trim()
    if ([string]::IsNullOrWhiteSpace($cleanPort) -or -not [int]::TryParse($cleanPort, [ref]$dbPort) -or $dbPort -lt 1 -or $dbPort -gt 65535) {
        throw 'Enter a valid MySQL port number between 1 and 65535 (such as 3307 or 3306).'
    }
}

$securePassword = Read-Host "MySQL password for $adminUser" -AsSecureString
$passwordPointer = [IntPtr]::Zero
$tempDirectory = Join-Path ([System.IO.Path]::GetTempPath()) "tms-mysql-$([guid]::NewGuid().ToString('N'))"

try {
    $passwordPointer = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($securePassword)
    $adminPassword = [Runtime.InteropServices.Marshal]::PtrToStringBSTR($passwordPointer)
    $optionPassword = $adminPassword.Replace('\', '\\').Replace('"', '\"')

    $identity = [System.Security.Principal.WindowsIdentity]::GetCurrent().User
    $directorySecurity = New-Object System.Security.AccessControl.DirectorySecurity
    $directorySecurity.SetAccessRuleProtection($true, $false)
    $directorySecurity.SetOwner($identity)
    $inheritance = [System.Security.AccessControl.InheritanceFlags]::ContainerInherit -bor [System.Security.AccessControl.InheritanceFlags]::ObjectInherit
    $accessRule = [System.Security.AccessControl.FileSystemAccessRule]::new(
        $identity,
        [System.Security.AccessControl.FileSystemRights]::FullControl,
        $inheritance,
        [System.Security.AccessControl.PropagationFlags]::None,
        [System.Security.AccessControl.AccessControlType]::Allow
    )
    $directorySecurity.AddAccessRule($accessRule)
    [void][System.IO.Directory]::CreateDirectory($tempDirectory, $directorySecurity)

    $optionPath = Join-Path $tempDirectory 'mysql.ini'
    @"
[client]
user=$adminUser
password="$optionPassword"
host=$dbHost
port=$dbPort
protocol=TCP
"@ | Set-Content -LiteralPath $optionPath -Encoding ASCII

    $appPasswordBytes = New-Object byte[] 36
    $randomGenerator = [System.Security.Cryptography.RandomNumberGenerator]::Create()
    try {
        $randomGenerator.GetBytes($appPasswordBytes)
    } finally {
        $randomGenerator.Dispose()
    }
    $appPassword = [Convert]::ToBase64String($appPasswordBytes).TrimEnd('=').Replace('+', '-').Replace('/', '_')
    [Array]::Clear($appPasswordBytes, 0, $appPasswordBytes.Length)

    function Invoke-MySql {
        param(
            [Parameter(Mandatory = $true)][string]$Sql,
            [string[]]$Arguments = @()
        )

        $startInfo = New-Object System.Diagnostics.ProcessStartInfo
        $startInfo.FileName = $mysqlPath
        $startInfo.Arguments = "--defaults-extra-file=`"$optionPath`" --default-character-set=utf8mb4 $($Arguments -join ' ')"
        $startInfo.UseShellExecute = $false
        $startInfo.CreateNoWindow = $true
        $startInfo.RedirectStandardInput = $true
        $startInfo.RedirectStandardOutput = $true
        $startInfo.RedirectStandardError = $true

        $process = New-Object System.Diagnostics.Process
        $process.StartInfo = $startInfo
        if (-not $process.Start()) {
            throw 'Unable to start the MySQL command-line client.'
        }

        $outputTask = $process.StandardOutput.ReadToEndAsync()
        $errorTask = $process.StandardError.ReadToEndAsync()
        $process.StandardInput.Write($Sql)
        $process.StandardInput.Close()
        $process.WaitForExit()

        if ($process.ExitCode -ne 0) {
            $errorOutput = $errorTask.Result.Trim()
            if ($errorOutput) {
                throw "MySQL command failed: $errorOutput"
            }
            throw "MySQL command failed with exit code $($process.ExitCode)."
        }

        return $outputTask.Result.Trim()
    }

    $tableCountRaw = Invoke-MySql -Sql "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'tms';" -Arguments @('-N', '-s')
    $cleanCount = ($tableCountRaw -replace '\D', '').Trim()
    $existingCount = 0
    [void][int]::TryParse($cleanCount, [ref]$existingCount)
    if ($existingCount -gt 0) {
        $reimport = Read-Host "The 'tms' database already contains $existingCount tables. Re-import database from scratch? [y/N]"
        if ($reimport -match '^(y|yes)$') {
            Write-Output "Dropping and recreating 'tms' database..."
            [void](Invoke-MySql -Sql "DROP DATABASE IF EXISTS tms; CREATE DATABASE tms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")
            $dump = Get-Content -LiteralPath $dumpPath -Raw
            [void](Invoke-MySql -Sql $dump -Arguments @('tms'))
            Write-Output "Sample database re-imported."
        } else {
            Write-Output "Keeping existing database tables. Updating user permissions and local configuration..."
        }
    } else {
        [void](Invoke-MySql -Sql "CREATE DATABASE IF NOT EXISTS tms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")
        $dump = Get-Content -LiteralPath $dumpPath -Raw
        [void](Invoke-MySql -Sql $dump -Arguments @('tms'))
        Write-Output "Sample database imported successfully."
    }

    $quotedPassword = $appPassword.Replace("'", "''")
    $accountSetup = @"
CREATE USER IF NOT EXISTS 'tms_app'@'localhost' IDENTIFIED BY '$quotedPassword';
ALTER USER 'tms_app'@'localhost' IDENTIFIED BY '$quotedPassword';
CREATE USER IF NOT EXISTS 'tms_app'@'127.0.0.1' IDENTIFIED BY '$quotedPassword';
ALTER USER 'tms_app'@'127.0.0.1' IDENTIFIED BY '$quotedPassword';
GRANT SELECT, INSERT, UPDATE, DELETE ON tms.* TO 'tms_app'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON tms.* TO 'tms_app'@'127.0.0.1';
"@
    [void](Invoke-MySql -Sql $accountSetup)

    $localConfig = @"
<?php
return [
        'host' => '$dbHost',
        'port' => '$dbPort',
    'name' => 'tms',
    'user' => 'tms_app',
    'password' => '$appPassword',
];
"@
    Set-Content -LiteralPath $configPath -Value $localConfig -Encoding ASCII

    Write-Output 'Database initialized and local app credentials saved to config.local.php.'
    Write-Output 'The MySQL administrator password was not saved.'
} finally {
    if ($passwordPointer -ne [IntPtr]::Zero) {
        [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($passwordPointer)
    }
    if ($securePassword) {
        $securePassword.Dispose()
    }
    if (Test-Path $tempDirectory) {
        Remove-Item -LiteralPath $tempDirectory -Recurse -Force
    }
}
