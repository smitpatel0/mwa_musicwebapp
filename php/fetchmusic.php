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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch playlists and their associated songs
$sql = "SELECT 
            p.playlist_name, 
            p.playlist_cover, 
            p.description, 
            s.song_title, 
            s.song_artist,
			p.playlist_audio
        FROM playlists p
        LEFT JOIN songs s ON p.id = s.playlist_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Library</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    color: #fff;
    background: linear-gradient(to bottom, blue, white);
    display: flex;
    justify-content: center;
}

.header {
    background-color: #111;
    color: white;
    display: flex;
    width: 100%;
    height: 70px;
    font-size: 24px;
    font-weight: bold;
    justify-content: center;
    /*box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);*/
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    margin-bottom: 700px;
}

.playlist-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columns */
    gap: 20px;
    align-items: center;
    width: 100%;
    height: auto;
    justify-content: center;
}

.playlist {
    background-color: #282828;
    border: 1px solid #555;
    margin-top: 55px;
    max-width: 350px;
    max-height: 600px;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.playlist:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.playlist img {
    width: 250px;
    height: 250px;
    border-radius: 8px;
}

.song {
    margin-top: 10px;
    padding-left: 10px;
    color: #f1f1f1;
}
    </style>
</head>

	<header class="header">
	<h3>MusicWave</h3>
    
	</header>
<body>
    <?php
    if ($result->num_rows > 0) {
        $currentPlaylist = null;

        while ($row = $result->fetch_assoc()) {
            // Group songs under their respective playlists
            if ($currentPlaylist !== $row['playlist_name']) {
                if ($currentPlaylist !== null) {
                    echo "</div>"; // Close previous playlist div
                }

                $currentPlaylist = $row['playlist_name'];

                echo "<div class='playlist'>";
                echo "<h2>Playlist:" . htmlspecialchars($row['playlist_name']) . "</h2>";
                echo "<p><h2>Description: " . htmlspecialchars($row['description']) . "</h2></p><br>";
				
                if (!empty($row['playlist_cover'])) {
                    echo "<img src='" . htmlspecialchars($row['playlist_cover']) . "' alt='Playlist Cover'><br>";
                }
				echo "<audio controls controlsList=\"nodownload\">
					<source src='".htmlspecialchars($row['playlist_audio'])."' type='audio/mpeg'>
					</audio>";
            }

            // Display song details
            if (!empty($row['song_title']) && !empty($row['song_artist'])) {
                echo "<div class='song'>";
                echo "<strong><h2>Song Title:</strong> " . htmlspecialchars($row['song_title']) . "</h2>";
                echo "<strong><h2>Artist:</strong> " . htmlspecialchars($row['song_artist']);
                echo "</h2></div>";
            }
        }

        echo "</div>"; // Close the last playlist div
    } else {
        echo "<p>No playlists found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>