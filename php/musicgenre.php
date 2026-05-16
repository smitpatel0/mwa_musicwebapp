<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mwa'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch genres from the database
$sql_genres = "SELECT DISTINCT genre FROM albums"; // Fetch genres from the 'albums' table
$result_genres = $conn->query($sql_genres);

// Fetch albums based on genre (if genre is selected)
$albums = [];
if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $genre = $_GET['genre'];
    $sql_albums = "SELECT album_title, album_artist, album_cover, album_audio 
                   FROM albums 
                   WHERE genre = ?"; // Fetch albums based on genre
    $stmt = $conn->prepare($sql_albums);
    $stmt->bind_param('s', $genre);
    $stmt->execute();
    $result_albums = $stmt->get_result();
    while ($row = $result_albums->fetch_assoc()) {
        $albums[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            background: #2d2d44;
            color: white;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
        }
        select, button {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        audio {
            width: 100%;
            margin-top: 20px;
        }
        .album-info {
            margin-top: 20px;
            text-align: center;
        }
        .album-info img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
			margin-left:200px;
        }
        .album-info p {
            font-size: 18px;
			color:black;
        }
		#albumArtist
    </style>
</head>
<body>
    <div class="container">
        <h1>Music Player</h1>

        <!-- Genre Dropdown -->
        <form method="GET" action="../php/musicgenre.php">
            <select name="genre" id="genreDropdown" onchange="this.form.submit()">
                <option value="">Select Genre</option>
                <?php
                // Populate genre dropdown
                if ($result_genres->num_rows > 0) {
                    while ($row = $result_genres->fetch_assoc()) {
                        $selected = (isset($_GET['genre']) && $_GET['genre'] == $row['genre']) ? 'selected' : '';
                        echo "<option value='" . $row['genre'] . "' $selected>" . $row['genre'] . "</option>";
                    }
                }
                ?>
            </select>
        </form>

        <!-- Album Dropdown -->
        <?php if (isset($albums) && count($albums) > 0): ?>
            <select id="albumDropdown">
                <option value="">Select Album</option>
                <?php foreach ($albums as $album): ?>
                    <option value="<?= $album['album_audio'] ?>" data-cover="<?= $album['album_cover'] ?>" data-artist="<?= $album['album_artist'] ?>">
                        <?= $album['album_title'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <p>No albums available for this genre.</p>
        <?php endif; ?>

        <!-- Audio Player -->
        <audio id="audioPlayer" controls controlsList="nodownload">
            <source src="" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>

        <!-- Album Info -->
        <div class="album-info" id="albumInfo">
            <img id="albumCover" src="" alt="Album Cover" style="display: none;">
            <p id="albumArtist"></p>
        </div>
    </div>

    <script>
        // Display selected album's cover, artist, and play audio
        document.getElementById('albumDropdown').addEventListener('change', function() {
            const audioPlayer = document.getElementById('audioPlayer');
            const albumInfo = document.getElementById('albumInfo');
            const albumCover = document.getElementById('albumCover');
            const albumArtist = document.getElementById('albumArtist');

            const selectedOption = this.options[this.selectedIndex];
            const albumSrc = selectedOption.value;
            const coverSrc = selectedOption.dataset.cover;
            const artist = selectedOption.dataset.artist;

            // Set audio source
            audioPlayer.src = albumSrc;

            // Play the audio
            audioPlayer.play()
                .catch(error => console.error('Error playing audio:', error));

            // Display album cover and artist
            if (coverSrc) {
                albumCover.src = coverSrc;
                albumCover.style.display = 'block';
            } else {
                albumCover.style.display = 'none';
            }
            albumArtist.textContent = 'Song Artist:'+artist || 'Unknown Artist';
        });
    </script>
</body>
</html>