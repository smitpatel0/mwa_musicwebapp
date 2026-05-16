<?php
include '../php/fetch_user.php';  // Adjust the path if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Profile</title>
    <style>
	/* General body styling */
body {
    font-family: Arial, sans-serif;
    background: #fff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container styling */
.container {
    background-color: #2d2d44; 
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

/* Heading styling */
h2 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 24px;
    color: #fff;
    text-align: center;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
}

/* Label styling */
label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #fff;
}

/* Input styling */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button styling */
button[type="submit"] {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 480px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        font-size: 12px;
    }

    button[type="submit"] {
        font-size: 14px;
    }
}
</style>
</head>
<body>
    <div class="container">
        <h2>Edit User Profile</h2>
        <form id="editForm" action="../php/update_user.php" method="POST">
            <!-- Auto-captured user_id from session -->
            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
