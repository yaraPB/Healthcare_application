<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();  // Start the session only if no session is already active
}
?>
<!doctype html>
<html>
<head>
  <title>Healthcare Management</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<body>

<div class="wrapper">
<?php include 'inc/header.php';?>

<div class="content">
  <h2>Healthcare Management System</h2>
  <div class="img-container">
    <img src="images/logo.jpg" alt="logo" style="height:150px;">
    <p>Welcome to our healthcare management website where we help connecting patients to doctors</p>
  </div>
  <video width="100%" height="300px" autoplay muted loop>
    <source src="images/vid_op.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>

<?php
// Aggregate functions
include "config/init.php";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$server; dbname=$db", $user, $password);

    // Query for counting doctors
    $qry_count_doctors = "SELECT COUNT(*) AS doctor_count FROM doctor";
    $stmt_count_doctors = $conn->prepare($qry_count_doctors);
    $stmt_count_doctors->execute();
    $doctor_count = $stmt_count_doctors->fetch(PDO::FETCH_ASSOC)['doctor_count'];

    // Query for counting patients
    $qry_count_patients = "SELECT COUNT(*) AS patient_count FROM patient";
    $stmt_count_patients = $conn->prepare($qry_count_patients);
    $stmt_count_patients->execute();
    $patient_count = $stmt_count_patients->fetch(PDO::FETCH_ASSOC)['patient_count'];

    // Query for counting appointments
    $qry_count_appointments = "SELECT COUNT(*) AS appointment_count FROM appointment";
    $stmt_count_appointments = $conn->prepare($qry_count_appointments);
    $stmt_count_appointments->execute();
    $appointment_count = $stmt_count_appointments->fetch(PDO::FETCH_ASSOC)['appointment_count'];

    // Display the results
    echo "<div class='aggregate'>";
    echo "<h4>Some statistics about us</h4>";
    echo "<p><strong>Doctors Availables at your service 24/7:</strong> $doctor_count</p>";
    echo "<p><strong>Total Registered Patients:</strong> $patient_count</p>";
    echo "<p><strong>Total Appointments in our lifetime:</strong> $appointment_count</p>";
    echo "</div>";
} catch (PDOException $e) {
    echo "<p>Error fetching aggregate data: " . $e->getMessage() . "</p>";
}
?>

<?php include 'inc/footer.php';?>
</div> <!-- End of wrapper -->
</body>
</html>
