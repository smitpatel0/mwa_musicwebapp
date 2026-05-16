<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$username = 'root'; // Replace with your DB username
$password = '';     // Replace with your DB password
$dbname = 'mwa';

$conn = new mysqli($host, $username, $password, $dbname);
echo "<style>
a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}
</style>";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumTitle = $conn->real_escape_string($_POST['album-title']);
    $artistName = $conn->real_escape_string($_POST['artist-name']);
    $genre = $conn->real_escape_string($_POST['genre']);
    $releaseDate = $conn->real_escape_string($_POST['release-date']);
    $description = $conn->real_escape_string($_POST['description']);

    // File upload
    $albumCover = $_FILES['album-cover']['name'];
    $covertargetDir = "../php/uploads/albums/covers/";
    $covertargetFile = $covertargetDir . basename($albumCover);
	
	$albumAudio = $_FILES['album-audio']['name'];
    $audiotargetDir = "../php/uploads/albums/audios/";
    $audiotargetFile = $audiotargetDir . basename($albumAudio);

    if (move_uploaded_file($_FILES['album-cover']['tmp_name'], $covertargetFile) &&
		move_uploaded_file($_FILES['album-audio']['tmp_name'], $audiotargetFile)	) {
        $sql = "INSERT INTO albums (album_title, album_artist, genre, release_date, album_cover, album_audio, description) 
                VALUES ('$albumTitle', '$artistName', '$genre', '$releaseDate', '$covertargetFile', '$audiotargetFile','$description')";

        if ($conn->query($sql) === TRUE) {
            echo "New album added successfully.";
			echo "<br><a href='../dashboard/index1.html'>Click To Go Home Page</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading album cover.";
    }
}

$conn->close();
?>
