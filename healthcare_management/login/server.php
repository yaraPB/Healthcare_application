<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session only if no session is already active
}
// Include database connection
include "../config/init.php";

// Initialize variables
$email = "";
$pswrd = "";
$errors = array();

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    // Check if the login form is submitted
    if (isset($_POST['login_user'])) {
        // Get the input values
        $email = $_POST['email'];
        $pswrd = $_POST['pswrd'];

        // Validate input
        if (empty($email)) array_push($errors, "Email is required");
        if (empty($pswrd)) array_push($errors, "Password is required");

        if (count($errors) == 0) {
            // Query to verify the user's credentials
            $qry = "SELECT patient_id, patient_last_name, patient_first_name 
                    FROM PATIENT 
                    WHERE patient_email = :email AND 
                          patient_password = :pswrd;";
            $stmt = $conn->prepare($qry);
            $stmt->execute([':email' => $email, ':pswrd' => $pswrd]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Login success: Set session and redirect
                $_SESSION['last_name'] = $result['patient_last_name'];
                $_SESSION['first_name'] = $result['patient_first_name'];
                $_SESSION['patient_id'] = $result['patient_id'];
                $_SESSION['success'] = "You are now logged in";
                header('location: ../index.php');
                exit();
            } else {
                array_push($errors, "Invalid email or password");
            }
        }
    }
} catch (PDOException $e) {
    array_push($errors, "SQL Error: " . $e->getMessage());
} catch (Error $e) {
    array_push($errors, "Error: " . $e->getMessage());
}
