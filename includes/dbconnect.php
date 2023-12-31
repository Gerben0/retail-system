<?php 

// Connect to DB
$host     = getenv('DB_HOST') ?: '127.0.0.1';
$db       = getenv('DB_NAME') ?: 'retail_system';
$user     = getenv('DB_USER') ?: 'admin_retail_system';
$pass     = getenv('DB_PASS') ?: 'admin_retail_system';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     error_log($e->getMessage());
     throw new \Exception("Unable to connect to the database.");
}
