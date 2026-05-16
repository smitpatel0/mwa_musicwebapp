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

// Fetch updated data
$data = [
    'total_users' => $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'],
    'total_songs' => $conn->query("SELECT COUNT(*) as total FROM songs")->fetch_assoc()['total'],
    'total_playlists' => $conn->query("SELECT COUNT(*) as total FROM playlists")->fetch_assoc()['total'],
    'total_albums' => $conn->query("SELECT COUNT(*) as total FROM albums")->fetch_assoc()['total'],
    'total_revenue' => $conn->query("SELECT SUM(subscription_amount) as total FROM payment_details")->fetch_assoc()['total']
];

header('Content-Type: application/json');
echo json_encode($data);
?>