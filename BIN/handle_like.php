<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mwa';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$albumId = $_POST['album_id'];
$userId = 1; // Replace with actual user authentication logic

// Check if the user has already liked the album
$query = "SELECT * FROM likes WHERE album_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $albumId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Unlike the album
    $query = "DELETE FROM likes WHERE album_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $albumId, $userId);
    $stmt->execute();
    echo json_encode(['success' => true, 'liked' => false]);
} else {
    // Like the album
    $query = "INSERT INTO likes (album_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $albumId, $userId);
    $stmt->execute();
    echo json_encode(['success' => true, 'liked' => true]);
}

$stmt->close();
$conn->close();
?>