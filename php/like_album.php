<?php
// Database connection
$host = 'localhost';
$dbname = 'mwa';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get album ID from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $albumId = $data['albumId'];

    // Insert like into the database
    $stmt = $conn->prepare("INSERT INTO likes (album_id) VALUES (:album_id)");
    $stmt->bindParam(':album_id', $albumId);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>