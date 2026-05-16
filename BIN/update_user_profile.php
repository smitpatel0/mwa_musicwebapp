<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwa";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit();
}


$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['username']) || !isset($data['email'])) {
    echo json_encode(['error' => 'Invalid data provided']);
    exit();
}

  // Sanitize and validate username
  $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
  if (empty($username)) {
      echo json_encode(['error' => "Username is required."]);
      exit();
  }

   // Sanitize and validate email
   $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
   if (!$email) {
        echo json_encode(['error' => "Invalid email format."]);
        exit();
   }

try {
    $stmt = $pdo->prepare("
        UPDATE users
        SET username = :username, email = :email
        WHERE user_id = :user_id
    ");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'user_id' => $user_id
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'No changes made, user not found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>