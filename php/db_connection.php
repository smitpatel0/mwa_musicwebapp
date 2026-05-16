<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'mwa';

try {
    // Create a new PDO instance for the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);

    // Set error mode to exceptions for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>