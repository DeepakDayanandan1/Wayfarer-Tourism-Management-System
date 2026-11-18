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

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host " Wayfarer Tourism Management System (Laravel 13.x)" -ForegroundColor Green
Write-Host " Public Website: http://127.0.0.1:8000" -ForegroundColor Yellow
Write-Host " Admin Portal:   http://127.0.0.1:8000/admin/login" -ForegroundColor Yellow
Write-Host " Press Ctrl+C to stop the server." -ForegroundColor Gray
Write-Host "==========================================================" -ForegroundColor Cyan

& $phpPath artisan serve --host=127.0.0.1 --port=8000
