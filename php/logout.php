<?php
session_start(); // Start the session to access session variables

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'logout') {
    // Unset all session variables
    session_unset();

    // Destroy the session data
    session_destroy();

    // Optional: Clear the session cookie from the browser
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, 
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Display a message before redirecting
    echo "<div style='color: green; font-weight: bold; text-align: center; margin-top: 20px;'>
            Logged out successfully!
          </div>";

    // Redirect to the main dashboard after 2 seconds
    echo "<script>
            setTimeout(function() {
                window.location.href='../dashboard/index.html'; // Replace with your actual dashboard page
            }, 2000);
          </script>";
} else {
    // If accessed directly without logout action, redirect to the dashboard
    header("Location: ../dashboard/index.html"); // Replace with your actual dashboard page
    exit();
}
?>
