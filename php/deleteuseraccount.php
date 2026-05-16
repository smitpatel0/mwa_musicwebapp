<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "mwa"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Get data from the request
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];
$password = $data['password'];

// Validate input
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
    exit;
}

// Check if the user exists with provided username and password
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($userId);

if ($stmt->fetch()) {
    // Delete the user account
    $deleteStmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $deleteStmt->bind_param("i", $userId);
    if ($deleteStmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Account deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete account']);
    }
    $deleteStmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
}

$stmt->close();
$conn->close();
?>
