<?php
// Database connection
$host = 'localhost';
$db = 'mwa';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert sample playlists
$playlists = [
    [
        'name' => 'Bhakti',
        'description' => 'Relaxing music for a calm evening.'
    ],
    [
        'name' => 'Broken',
        'description' => 'Energetic tracks to power your workout.'
    ]
    /*[
        'name' => 'Road Trip Mix',
        'description' => 'Perfect playlist for a long drive.'
    ]*/
];

foreach ($playlists as $playlist) {
    $name = $conn->real_escape_string($playlist['name']);
    $description = $conn->real_escape_string($playlist['description']);
    $sql = "INSERT INTO playlists (name, description) VALUES ('$name', '$description')";
    if ($conn->query($sql) === TRUE) {
        $playlistId = $conn->insert_id; // Get the ID of the inserted playlist
        echo "Playlist '$name' inserted successfully. ID: $playlistId<br>";

        // Insert sample songs for this playlist
        $songs = [];
        if ($playlist['name'] === 'Bhakti') {
            $songs = [
                [
                    'song_name' => 'Hanuman Chalisa',
                    'artist_name' => 'Smit',
                    'album_cover' => 'HanumanChalisa.jpeg',
                    'song_file' => 'Hanuman Chalisa.mp3'
                ],
                [
                    'song_name' => 'Har Har Sambhu',
                    'artist_name' => 'sbk',
                    'album_cover' => 'shivay.jpeg',
                    'song_file' => 'Hanuman Chalisa.mp3'
                ]
            ];
        } elseif ($playlist['name'] === 'Broken') {
            $songs = [
                [
                    'song_name' => 'Ae dil hai mushkil',
                    'artist_name' => 'Arijit',
                    'album_cover' => 'aedilhaimushkil.jpeg',
                    'song_file' => 'Ae Dil Hai Mushkil.mp3'
                ],
                [
                    'song_name' => 'O Bedardeya',
                    'artist_name' => 'Arijit Singh',
                    'album_cover' => 'obedardeya.jpeg',
                    'song_file' => 'O Bedardeya.mp3'
                ]
            ];
        } /*elseif ($playlist['name'] === 'Road Trip Mix') {
            $songs = [
                [
                    'song_name' => 'Highway Nights',
                    'artist_name' => 'Travel Beats',
                    'album_cover' => 'highway.jpg',
                    'song_file' => 'highway_nights.mp3'
                ],
                [
                    'song_name' => 'Open Road',
                    'artist_name' => 'Adventure Sounds',
                    'album_cover' => 'road.jpg',
                    'song_file' => 'open_road.mp3'
                ]
            ];
        }*/

        foreach ($songs as $song) {
            $songName = $conn->real_escape_string($song['song_name']);
            $artistName = $conn->real_escape_string($song['artist_name']);
            $albumCover = $conn->real_escape_string($song['album_cover']);
            $songFile = $conn->real_escape_string($song['song_file']);
            $sql = "INSERT INTO songs (playlist_id, song_name, artist_name, album_cover, song_file) 
                    VALUES ($playlistId, '$songName', '$artistName', '$albumCover', '$songFile')";
            if ($conn->query($sql) === TRUE) {
                echo "Song '$songName' inserted successfully.<br>";
            } else {
                echo "Error inserting song: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Error inserting playlist: " . $conn->error . "<br>";
    }
}

$conn->close();
?>