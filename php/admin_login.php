<?php
// Database connection
$host = "localhost";
$dbname = "mwa";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Start session


// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $adminUsername = $_POST['username'];
    $adminPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->bindParam(':username', $adminUsername);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    //if (password_verify($adminPassword, $admin['password']))
	if($adminPassword === $admin['password']) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: ../php/admin_dashboard.php"); // Redirect to admin dashboard
		session_start();
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    if (isset($_SESSION['admin'])) {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->bindParam(':username', $_SESSION['admin']);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($currentPassword, $admin['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateStmt = $conn->prepare("UPDATE admin SET password = :password WHERE username = :username");
            $updateStmt->bindParam(':password', $hashedPassword);
            $updateStmt->bindParam(':username', $_SESSION['admin']);
            $updateStmt->execute();

            $success = "Password changed successfully.";
        } else {
            $error = "Current password is incorrect.";
        }
    } else {
        $error = "You must be logged in to change your password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
	<style>
	/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color:black;/*#f4f4f9;*/
    margin: 0;
    padding: 0;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}


h1, h2 {
    text-align: center;
    color: #fff;
}

form {
    background: black;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
	margin-left:400px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #fff;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

p {
    text-align: center;
    font-size: 14px;
}

p[style='color: red;'] {
    color: #e74c3c;
}

p[style='color: green;'] {
    color: #2ecc71;
}

/* Responsive Design */
@media (max-width: 600px) {
    form {
        padding: 15px;
    }

    button {
        font-size: 14px;
        padding: 8px 12px;
    }
}
</style>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>

    <!-- Login Form -->
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" autocomplete="off" required><br>

        <button type="submit" name="login">Login</button>
    </form>

    <!-- Change Password Form -->
    <?php if (isset($_SESSION['admin'])): ?>
        <h2>Change Password</h2>
        <form method="post">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required><br>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required><br>

            <button type="submit" name="change_password">Change Password</button>
        </form>
    <?php endif; ?>
</body>
</html>