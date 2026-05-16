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

$sql = "SELECT * FROM playlists";
$result = $conn->query($sql);

$playlists = [];
while ($row = $result->fetch_assoc()) {
    $playlists[] = $row;
}

echo json_encode($playlists);

$conn->close();
?>