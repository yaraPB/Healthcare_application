<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Appointment Details</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
    <div class="wrapper">
<?php include '../inc/header.php'; ?>

<div class="content">
<h2>Appointment Details</h2>
<?php
include "../config/init.php";

try {
    // Get the appointment ID from the URL parameter
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $appointment_id = intval($_GET['id']);

        // Establish database connection
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

        // Query to fetch details for the specific appointment
        $qry = "SELECT APPOINTMENT_ID, APPOINTMENT_DATE_BEG, APPOINTMENT_DATE_END,
                       P.PATIENT_ID, P.PATIENT_EMAIL,
                       D.DOCTOR_ID, D.DOCTOR_SPECIALITY
                FROM APPOINTMENT A
                JOIN PATIENT P ON A.patient_id = P.PATIENT_ID
                JOIN DOCTOR D ON A.DOCTOR_id = D.DOCTOR_ID
                WHERE APPOINTMENT_ID = :appointment_id;";
        
        $stmt = $conn->prepare($qry);
        $stmt->execute(['appointment_id' => $appointment_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Display appointment details
            echo "<table>\n";
            echo "<caption>Appointment Details</caption>\n";
            echo "<tr><th>Field</th><th>Value</th></tr>\n";
            echo "<tr><td>Appointment ID</td><td>" . $result['APPOINTMENT_ID'] . "</td></tr>";
            echo "<tr><td>Appointment Beginning Date</td><td>" . $result['APPOINTMENT_DATE_BEG'] . "</td></tr>";
            echo "<tr><td>Appointment Ending Date</td><td>" . $result['APPOINTMENT_DATE_END'] . "</td></tr>";
            echo "<tr><td>Patient ID</td><td>" . $result['PATIENT_ID'] . "</td></tr>";
            echo "<tr><td>Patient Email</td><td>" . $result['PATIENT_EMAIL'] . "</td></tr>";
            echo "<tr><td>Doctor ID</td><td>" . $result['DOCTOR_ID'] . "</td></tr>";
            echo "<tr><td>Doctor Speciality</td><td>" . $result['DOCTOR_SPECIALITY'] . "</td></tr>";
            echo "</table>\n";
        } else {
            echo "<p>No appointment found with ID: $appointment_id</p>";
        }
    } else {
        echo "<p>Invalid or missing appointment ID.</p>";
    }
}
catch(PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

// Close the connection
$conn = null;
?>
</div>

<?php include '../inc/footer.php'; ?>
</div>
</body>
</html>
