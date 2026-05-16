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

// Fetch data
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_songs = $conn->query("SELECT COUNT(*) as total FROM songs")->fetch_assoc()['total'];
$total_playlists = $conn->query("SELECT COUNT(*) as total FROM playlists")->fetch_assoc()['total'];
$total_albums = $conn->query("SELECT COUNT(*) as total FROM albums")->fetch_assoc()['total'];
$total_revenue = $conn->query("SELECT SUM(subscription_amount) as total FROM payment_details")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom,blue,white);
            margin: 0;
            padding: 0;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .card p {
            font-size: 18px;
            color: #666;
        }
        .card.total-revenue {
            background: #4CAF50;
            color: white;
        }
        .card.total-revenue h2,
        .card.total-revenue p {
            color: white;
        }
		.menu{
		width: 250px;
		padding: 20px;
		display: flex;
		flex-direction:column;
		margin-top:5px;
		}

		.menu .nav{
		flex-grow: 1;
		margin-top:30px;
		}

		.menu .nav a{
			text-decoration: none;
			color: black;
			padding: 10px 0;
			display: block;
			font-size: 1rem;
			transition: color 0.3s ease;
		}

		.menu .nav a:hover{
			color: purple;
		}

		.menu .nav .active{
			color: #fff;
			font-weight: bold;
		}
		
		nav a:hover{
		color: #ffd700;
		}
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="card">
            <h2>Total Users</h2>
            <p id="total-users"><?php echo $total_users; ?></p>
        </div>
        <div class="card">
            <h2>Total Songs</h2>
            <p id="total-songs"><?php echo $total_songs; ?></p>
        </div>
        <div class="card">
            <h2>Total Playlists</h2>
            <p id="total-playlists"><?php echo $total_playlists; ?></p>
        </div>
        <div class="card">
            <h2>Total Albums</h2>
            <p id="total-albums"><?php echo $total_albums; ?></p>
        </div>
        <div class="card total-revenue">
            <h2>Total Revenue</h2>
            <p id="total-revenue">Rs.<?php echo number_format($total_revenue, 2); ?></p>
        </div>
    </div>
		<div class="menu">
        <div class="nav">
		<a href="../pages/addalbum.html">Add Album</a><br>
		<a href="../pages/displayalbums.html">View Albums</a><br>
        <a href="../pages/createplaylist.html">Create Playlist</a><br>
        <a href="../pages/displayplaylists.html">View Playlists</a>
		</div>
		</div>

    <script>
        // Function to update data dynamically (if needed)
        function updateData() {
            fetch('fetch_data.php') // Create a separate PHP file to fetch updated data
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-users').innerText = data.total_users;
                    document.getElementById('total-songs').innerText = data.total_songs;
                    document.getElementById('total-playlists').innerText = data.total_playlists;
                    document.getElementById('total-albums').innerText = data.total_albums;
                    document.getElementById('total-revenue').innerText = `$${data.total_revenue.toFixed(2)}`;
                });
        }

        // Update data every 60 seconds
        setInterval(updateData, 60000);
    </script>
</body>
</html>