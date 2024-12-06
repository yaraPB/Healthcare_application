<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session only if no session is already active
}

// initializing variables
$lname = "";
$fname = "";
$email = "";
$phone = "";
$pswrd = "";
$errors = array(); 

include "../config/init.php";

try
{
  // connect to the database
  $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

  if (isset($_POST['sub_user']))
  {
    // Receive all input values from the form
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pswrd = $_POST['pswrd'];

    // Check that the mandatory form fields are filled
    if (empty($lname))
        array_push($errors, "Last name is required");
    if (empty($fname))
        array_push($errors, "First name is required");
    if (empty($email))
        array_push($errors, "Area code is required");
    if (empty($phone))
        array_push($errors, "Phone is required");
    if (empty($pswrd))
        array_push($errors, "Password is required");

    // First make sure a patient does not already exist with same name and phone #
    $qry = "SELECT 1
              FROM PATIENT
             WHERE PATIENT_last_name = :lname AND
                   patient_first_name = :fname AND";

    $qry .= "      patient_email = :email AND
                   patient_password = :pswrd AND
                   patient_phone = :phone;";
    $stmt = $conn->prepare($qry);
    if ($stmt->fetch()) 
        array_push($errors, "Patient with same name and phone already exists");

    if (count($errors) == 0)
    {
        $qry = "SELECT MAX(patient_id) AS maxcode
                  FROM patient;";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $result = $stmt->fetch();
        $code = 1 + intval($result['maxcode']);
        $sql = "INSERT INTO PATIENT
        (patient_last_name, patient_first_name, patient_email, patient_phone, patient_password)
        VALUES
        (:lname, :fname, :email, :phone, :pswrd);";

        $stmt = $conn->prepare($sql);

        $stmt->execute([':lname' => $lname,
                        ':fname' => $fname,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':pswrd' => $pswrd, ]);
        
        $_SESSION['name'] = $lname;
        $_SESSION['success'] = "You are now subscribed";
        header('location: index.php');
    }
  }
}
catch(PDOException $e)
{
    echo "SQL Error: " . $e->getMessage();
}
catch(Error $e)
{
    echo "Error: " . $e->getMessage();
}