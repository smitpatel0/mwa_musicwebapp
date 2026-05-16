<?php
session_start(); // Start the session at the beginning of the script
require 'db_connection.php';

echo "<style>
/* General body styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}

/* Styling for messages */
.message {
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    width: 100%;
    max-width: 400px;
}

/* Success message styling */
.message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Error message styling */
.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Styling for links */
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

/* Styling for logged-in user message */
.logged-in {
    margin-top: 20px;
    font-size: 18px;
    color: #28a745;
}

/* Styling for logout message */
.logout-message {
    margin-top: 20px;
    font-size: 18px;
    color: #dc3545;
}
</style>";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // Consider hashing passwords for better security
            $_SESSION['user_id'] = $user['user_id']; // Set session variable
            $_SESSION['username'] = $user['username'];
			$_SESSION['email'] = $user['email'];

            echo "Login Successful!<br>";
            echo "<a href='../dashboard/index1.html'>Click To Go Home Page</a>";
        } else {
            echo "Invalid Email Or Password.";
        }
    } elseif ($action === 'change_password') {
        if (!isset($_SESSION['user_id'])) {
            echo "You need to be logged in to change your password.";
            exit;
        }

        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        $email = $_SESSION['email'];		// Use session to get the logged-in user's email

        if ($newPassword !== $confirmPassword) {
            echo "New passwords do not match.";
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $currentPassword === $user['password']) { // Consider hashing passwords for better security
            $updateStmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
            $updateStmt->execute(['password' => $newPassword, 'email' => $email]);
            echo "Password changed successfully!";
        } else {
            echo "Current password is incorrect.";
        }
    }
}

// To check if a user is logged in elsewhere in your code:
if (isset($_SESSION['user_id'])) {
    echo "<br>User Logging In As:" . $_SESSION['email'];
} else {
    echo "<br>User is not logged in.";
}

// Optional logout functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'logout') {
    session_unset();
    session_destroy();
    echo "Logged out successfully!";
    echo "<script>window.location.href='../dashboard/login.html';</script>"; // Redirect to login page
}
?>
