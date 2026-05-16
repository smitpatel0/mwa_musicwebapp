<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
     $errors = [];

      $username = $_POST['username'];
       if (empty($username)) {
          $errors['username'] = "Username is required.";
       }

      $email = $_POST['email'];
       if (empty($email)) {
        $errors['email'] = "Email is required.";
      }  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors['email'] = "Invalid Email format.";
      }

       $password = $_POST['password'];
       if (empty($password)) {
            $errors['password'] = "Password is required.";
        }
         else if (strlen($password) < 8 || strlen($password) > 20) {
           $errors['password'] = "Password must be between 8 and 20 characters.";
        }

        if (empty($errors)){
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO users (username, email, password) 
                    VALUES (:username, :email, :password)
                ");
                $stmt->execute([
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                ]);

                echo "<script>alert('Registration successful! You can now log in.'); window.location.href = '../dashboard/login.html';</script>";

            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
    }
    else{
          $error_message = "";
           foreach ($errors as $field => $error) {
              $error_message .= $error . "\\n";
          }
        echo "<script> alert('$error_message'); window.location.href='../dashboard/registration.html'</script>";
    }
}
?>