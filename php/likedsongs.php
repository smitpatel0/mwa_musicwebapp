<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mwa";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["song_name"])) {
    $song_name = $conn->real_escape_string($_POST["song_name"]);
    $sql = "INSERT INTO liked_songs (song_name) VALUES ('$song_name')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
    exit();
}

// Fetch liked songs
$result = $conn->query("SELECT song_name FROM liked_songs");

while ($row = $result->fetch_assoc()) {
    echo "<li>" . htmlspecialchars($row["song_name"]) . "</li>";
}
?>
