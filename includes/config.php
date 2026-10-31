<?php
$localConfigPath = __DIR__ . '/../config.local.php';
$localConfig = is_file($localConfigPath) ? require $localConfigPath : [];

define('DB_HOST', getenv('TMS_DB_HOST') ?: ($localConfig['host'] ?? '127.0.0.1'));
define('DB_PORT', getenv('TMS_DB_PORT') ?: ($localConfig['port'] ?? '3306'));
define('DB_USER', getenv('TMS_DB_USER') ?: ($localConfig['user'] ?? 'root'));
define('DB_PASS', getenv('TMS_DB_PASS') ?: ($localConfig['password'] ?? ''));
define('DB_NAME', getenv('TMS_DB_NAME') ?: ($localConfig['name'] ?? 'tms'));

try {
    $dbh = new PDO(
        'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    exit('Database connection failed: ' . $e->getMessage());
}
?>