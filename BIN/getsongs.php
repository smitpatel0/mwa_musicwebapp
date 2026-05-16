<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

header('Content-Type: application/json');

$genre = $_GET['genres'];
$sql = "SELECT songs.song_title, songs.song_artist, playlists.playlist_audio, playlists.playlist_cover 
        FROM songs
        JOIN playlists ON songs.playlist_id = playlists.playlist_id
        WHERE songs.genre = '$genre'";

$result = $conn->query($sql);
$songs = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $songs[] = [
            'song_title' => $row['song_title'],
            'song_artist' => $row['song_artist'],
            'playlist_audio' => $row['playlist_audio'],
            'playlist_cover' => $row['playlist_cover']
        ];
    }
}

echo json_encode($songs);
?>
