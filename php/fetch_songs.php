<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$playlistId = $_GET['playlist_id'];

$sql = "SELECT * FROM songs WHERE playlist_id = $playlistId";
$result = $conn->query($sql);

$songs = [];
while ($row = $result->fetch_assoc()) {
    $songs[] = $row;
}

echo json_encode($songs);

$conn->close();
?>