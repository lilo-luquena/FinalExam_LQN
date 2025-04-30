<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require __DIR__ . '/config.php';

$host = $config['host'];
$port = $config['port'];
$db = $config['dbname'];
$user = $config['username'];
$pass = $config['password'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Successfully connected!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
