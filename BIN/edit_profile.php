<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
     <link rel="stylesheet" href="../css/edit_profile.css">
	 <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body>
<script src="../javascript/shift.js" defer></script>
	<!--hamburger menu-->
	<div class="hamburger" onclick="toggleSidebar()">
		<div></div>
		<div></div>
		<div></div>
	</div>
	<!--Sidebar-->
	<div class="sidebar" id="sidebar">
		<a href="user_dashboard.php" id="b">Home</a>
		<a href="edit_profile.php">Edit Profile</a>
		<a href="my_movies.php">My Movies</a>
		<a href="my_cart.php">My Cart</a>
		<a href="../backend/logout.php" id="l">Log Out</a>
	</div>

	<div class="main-content" id="main-content">
	<h1>Edit Profile</h1>
	
	<form method="post" action="../backend/edit_profile.php">
		<input type="hidden" name="update_Profile">
		<label for="username">Username: </label>
		<input type="text" id="username" name="username" required>
		
		<label for="email">Email: </label>
		<input type="text" id="email" name="email" required>
		
		<label for="phone_number">Phone Number: </label>
		<input type="text" id="phone_number" name="phone_number" required>
		
		<button type="submit">Update Profile</button>
	</form>
	
	<h1>Change Password</h1>
	<form method="post" action="../backend/edit_profile.php">
		<input type="hidden" name="change_password">
		<label for="current_password">Current Password: </label>
		<input type="password" id="current_password" name="current_password" required>
		
		<label for="new_password">New Password: </label>
		<input type="password" id="new_password" name="new_password" required>
		
		<label for="confirm_password">Confirm Password: </label>
		<input type="password" id="confirm_password" name="confirm_password" required>
		
		<button type="submit">Change Password</button>
	</form>
	</div>
</body>
</html>