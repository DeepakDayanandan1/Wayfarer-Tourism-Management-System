$ErrorActionPreference = 'Stop'

$php = Get-Command php -ErrorAction SilentlyContinue
if ($php) {
    $phpPath = $php.Source
} elseif (Test-Path 'C:\xampp\php\php.exe') {
    $phpPath = 'C:\xampp\php\php.exe'
} else {
    $wingetPhpRoot = Join-Path $env:LOCALAPPDATA 'Microsoft\WinGet\Packages'
    $phpPath = Get-ChildItem -Path $wingetPhpRoot -Directory -Filter 'PHP.PHP.*' -ErrorAction SilentlyContinue |
        Sort-Object Name -Descending |
        ForEach-Object { Join-Path $_.FullName 'php.exe' } |
        Where-Object { Test-Path $_ } |
        Select-Object -First 1

    if (-not $phpPath) {
        throw 'PHP was not found. Install PHP 8.2+ or add php.exe to PATH.'
    }
}

$phpModules = & $phpPath -m
if ($LASTEXITCODE -ne 0) {
    throw "Unable to start PHP: $phpPath"
}

$phpArguments = @()
if ($phpModules -notcontains 'pdo_mysql') {
    $extensionDir = Join-Path (Split-Path $phpPath -Parent) 'ext'
    if (-not (Test-Path (Join-Path $extensionDir 'php_pdo_mysql.dll'))) {
        throw 'The pdo_mysql extension is not available. Enable it in php.ini or install PHP with MySQL PDO support.'
    }

    $phpArguments += @('-d', "extension_dir=$extensionDir", '-d', 'extension=pdo_mysql')
}

Write-Host "Wayfarer - Tourism Management System is running at http://127.0.0.1:8000" -ForegroundColor Cyan
Write-Host "Admin Portal is running at http://127.0.0.1:8000/admin/" -ForegroundColor Green
Write-Host "Press Ctrl+C to stop the server." -ForegroundColor Yellow
& $phpPath @phpArguments -S 127.0.0.1:8000 -t $PSScriptRoot
