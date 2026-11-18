$ErrorActionPreference = 'Stop'

$mysqlServer = Get-Command mysqld -ErrorAction SilentlyContinue
if ($mysqlServer) {
    $serverPath = $mysqlServer.Source
    $mysqlPath = Join-Path (Split-Path $serverPath -Parent) 'mysql.exe'
} elseif (Test-Path 'C:\Program Files\MySQL\MySQL Server 26.7\bin\mysqld.exe') {
    $serverPath = 'C:\Program Files\MySQL\MySQL Server 26.7\bin\mysqld.exe'
    $mysqlPath = 'C:\Program Files\MySQL\MySQL Server 26.7\bin\mysql.exe'
} elseif (Test-Path 'C:\xampp\mysql\bin\mysqld.exe') {
    $serverPath = 'C:\xampp\mysql\bin\mysqld.exe'
    $mysqlPath = 'C:\xampp\mysql\bin\mysql.exe'
} else {
    throw 'MySQL Server was not found. Install MySQL or XAMPP first.'
}

$basedir = Split-Path (Split-Path $serverPath -Parent) -Parent
$dataPath = Join-Path $env:LOCALAPPDATA 'KindConnect-TMS\mysql-data'
$port = 3307
$listener = [System.Net.Sockets.TcpClient]::new()
try {
    $listener.Connect('127.0.0.1', $port)
    if (Test-Path $mysqlPath) {
        $serverDataPath = & $mysqlPath --no-defaults --protocol=TCP --host=127.0.0.1 "--port=$port" --user=root --batch --skip-column-names -e 'SELECT @@datadir;' 2>$null
        $expectedDataPath = [System.IO.Path]::GetFullPath($dataPath).TrimEnd('\') + '\'
        if ($LASTEXITCODE -eq 0 -and [System.IO.Path]::GetFullPath($serverDataPath.Trim()).TrimEnd('\') + '\' -ieq $expectedDataPath) {
            Write-Output "The tourism database server is already running on 127.0.0.1:$port."
            return
        }
    }

    throw "Port $port is already in use by another process. Stop that process or change the tourism database port in setup-database.ps1."
} catch [System.Net.Sockets.SocketException] {
} finally {
    $listener.Dispose()
}

[void][System.IO.Directory]::CreateDirectory($dataPath)
if (-not (Test-Path (Join-Path $dataPath 'mysql'))) {
    Write-Output 'Initializing a separate local MySQL data directory for the tourism app...'
    & $serverPath --no-defaults "--basedir=$basedir" "--datadir=$dataPath" --initialize-insecure --console
    if ($LASTEXITCODE -ne 0) {
        throw 'MySQL data directory initialization failed.'
    }
}

Write-Output "Starting the tourism database on 127.0.0.1:$port. Press Ctrl+C to stop it."
& $serverPath --no-defaults "--basedir=$basedir" "--datadir=$dataPath" --bind-address=127.0.0.1 "--port=$port" --mysqlx=0 --console
if ($LASTEXITCODE -ne 0) {
    throw "The MySQL server exited with code $LASTEXITCODE."
}
