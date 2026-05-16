<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "mwa"; // Replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Get form data
$user_id = intval($_POST['user_id']);
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Update user data
$sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE user_id=$user_id";
$result = $conn->query($sql);
//echo "<script>alert(\"sucess\");</script>";
echo "<style>
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
</style>";
if($result !== NULL)
	{
		echo "<script>alert(\"Profile updated successfully..\");</script>";
		echo "<a href='../dashboard/index1.html'>Click To Go Home Page</a>";
	}
	else
	{
		echo "<script>alert(\"Profile updation failed..\");</script>";
	}
$conn->close();
?>
