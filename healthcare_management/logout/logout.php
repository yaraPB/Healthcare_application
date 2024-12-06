<?php
session_start();  // Start the session to access session data

// Destroy the session to log the user out
session_unset();  // Removes all session variables
session_destroy();  // Destroys the session

// Optional: Clear session cookies for added security
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
              $params["path"], 
              $params["domain"], 
              $params["secure"], 
              $params["httponly"]);
}

// Redirect to home page (or login page) after logout
header('Location: ../index.php');  // You can change this to 'login_form.php' if you want
exit();  // Ensure no further code is executed
?>
