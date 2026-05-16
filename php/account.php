<?php
session_start(); // Start session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../dashboard/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .account-container {
            background:#2d2d44;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 400px;
			height:300px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            color: #fff;
        }
        .account-info {
            margin-top: 20px;
			color:white;
        }
        .account-info p {
            margin: 10px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="account-container">
    <h2>My Account</h2>
    <div class="account-info">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    </div>
</body>
</html>
