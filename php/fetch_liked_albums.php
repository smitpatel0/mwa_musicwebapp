<?php
// Database connection
$host = 'localhost';
$dbname = 'mwa';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch liked albums
    $stmt = $conn->query("
        SELECT a.* FROM albums a
        JOIN likes l ON a.id = l.album_id
    ");
    $likedAlbums = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data as JSON
    echo json_encode($likedAlbums);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>