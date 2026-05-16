<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch genres
$sql = "SELECT DISTINCT genre FROM songs";
$result = $conn->query($sql);

$genres = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row['genre'];
    }
}

echo json_encode($genres);

$conn->close();
?>
