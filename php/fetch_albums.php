<?php
// Database connection
$host = 'localhost';
$dbname = 'mwa';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all albums
    $stmt = $conn->query("SELECT * FROM albums");
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data as JSON
    echo json_encode($albums);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>