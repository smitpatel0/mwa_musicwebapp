<?php
	session_start();
	include ('db_connection.php');
	
	if(isset($_SESSION['user_id'])){
		$user_id=$_SESSION['user_id'];
		
		//fetch the user data
		$query = "select username,email from users where user_id= :user_id";
		$stmt=$pdo->prepare($query);
		$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
		$stmt->execute();
		
		//fetch user data
		$user=$stmt->fetch(PDO::FETCH_ASSOC);
		
		//check if user exists
		if(!$user){
			echo "User not found";
			exit();
		}
		
	}
?>