<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
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

// Handle playlist creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlistName = $conn->real_escape_string($_POST['playlist-name']);
    $description = $conn->real_escape_string($_POST['description']);

    // Insert playlist data
    $sql = "INSERT INTO playlists (name, description) 
            VALUES ('$playlistName', '$description')";

    if ($conn->query($sql) === TRUE) {
        $playlistId = $conn->insert_id; // Get the ID of the inserted playlist

        // Insert songs
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'song-title-') === 0) {
                $songIndex = str_replace('song-title-', '', $key);
                $songName = $conn->real_escape_string($value);
                $artistName = $conn->real_escape_string($_POST["song-artist-$songIndex"]);

                // Handle album cover upload
                $albumCover = $_FILES["song-cover-$songIndex"]['name'];
                $coverTargetDir = "../php/uploads/playlists/covers/";
                $coverTargetFile = $coverTargetDir . basename($albumCover);

                // Handle song file upload
                $songFile = $_FILES["song-audio-$songIndex"]['name'];
                $audioTargetDir = "../php/uploads/playlists/audios/";
                $audioTargetFile = $audioTargetDir . basename($songFile);

                // Move uploaded files to the target directories
                if (move_uploaded_file($_FILES["song-cover-$songIndex"]['tmp_name'], $coverTargetFile) &&
                    move_uploaded_file($_FILES["song-audio-$songIndex"]['tmp_name'], $audioTargetFile)) {
                    // Insert song data
                    $songSql = "INSERT INTO songs (playlist_id, song_name, artist_name, album_cover, song_file) 
                                VALUES ($playlistId, '$songName', '$artistName', '$coverTargetFile', '$audioTargetFile')";

                    if (!$conn->query($songSql)) {
                        echo "Error inserting song: " . $conn->error;
                    }
                } else {
                    echo "Error uploading files for song $songIndex.<br>";
                }
            }
        }

        echo "Playlist created successfully.";
		echo "<br><a href='../dashboard/index1.html'>Click To Go Home Page</a>";
    } else {
        echo "Error inserting playlist: " . $conn->error;
    }
}

$conn->close();
?>