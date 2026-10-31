<?php
define('DB_HOST', getenv('TMS_DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('TMS_DB_PORT') ?: '3306');
define('DB_USER', getenv('TMS_DB_USER') ?: 'root');
define('DB_PASS', getenv('TMS_DB_PASS') ?: '');
define('DB_NAME', getenv('TMS_DB_NAME') ?: 'tms');

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