<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if no session is already active
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Appointments</title>
    <base href="http://localhost:8000/healthcare_management/">
    <link rel="stylesheet" href="css/mystyle.css">
</head>
<div class="wrapper">
<body>

<?php include '../inc/header.php';?>

<div class="content">
    <h2>My Appointments</h2>
    <p>Here are your past and upcoming appointments:</p>
    <p class="date">Today's Date: <strong><?php echo date('l, F j, Y'); ?></strong></p> <!-- Display Current Date -->
    <?php
    include "../config/init.php";

    try {
        if (!isset($_SESSION['patient_id'])) {
            header("location: ../login/login.php"); // Redirect to login if not logged in
            exit();
        }

        $patient_id = $_SESSION['patient_id']; // Logged-in patient's ID

        // Connect to the database
        $conn = new PDO("mysql:host=$server; dbname=$db", $user, $password);

        // Query for past and future appointments
        $qry_past = "SELECT appointment_id, appointment_date_beg, appointment_date_end, doctor_first_name, doctor_last_name 
                     FROM appointment
                     INNER JOIN doctor ON appointment.doctor_id = doctor.doctor_id
                     WHERE patient_id = :patient_id AND appointment_date_beg < NOW()
                     ORDER BY appointment_date_beg DESC;";
                     
        $qry_future = "SELECT appointment_id, appointment_date_beg, appointment_date_end, doctor_first_name, doctor_last_name 
                       FROM appointment
                       INNER JOIN doctor ON appointment.doctor_id = doctor.doctor_id
                       WHERE patient_id = :patient_id AND appointment_date_beg >= NOW()
                       ORDER BY appointment_date_beg ASC;";

        // Prepare and execute queries
        $stmt_past = $conn->prepare($qry_past);
        $stmt_past->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
        $stmt_past->execute();

        $stmt_future = $conn->prepare($qry_future);
        $stmt_future->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
        $stmt_future->execute();

        // Display future appointments
        echo "<h3 class='apt'>Upcoming Appointments</h3>";
        if ($stmt_future->rowCount() > 0) {
            echo "<table>\n";
            echo "<tr><th>Appointment Number</th><th>Start Time</th><th>End Time</th><th>Doctor</th></tr>\n";

            while ($result = $stmt_future->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><span class='number'><a href='../appointments/appointment_details.php?id=" . $result['appointment_id'] . "'>" . $result['appointment_id'] . "</a></span></td>";
                echo "<td>" . $result['appointment_date_beg'] . "</td>";
                echo "<td>" . $result['appointment_date_end'] . "</td>";
                echo "<td>Dr. " . $result['doctor_first_name'] . " " . $result['doctor_last_name'] . "</td>";
                echo "</tr>\n";
            }
            echo "</table>\n";
        } else {
            echo "<p>You have no upcoming appointments.</p>";
        }

        // Display past appointments
        echo "<h3  class='apt'>Past Appointments</h3>";
        if ($stmt_past->rowCount() > 0) {
            echo "<table>\n";
            echo "<tr><th>Appointment Number</th><th>Start Time</th><th>End Time</th><th>Doctor</th></tr>\n";

            while ($result = $stmt_past->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><span class='number'><a href='/healthcare_management/appointments/appointment_details.php?id=" . $result['appointment_id'] . "'>" . $result['appointment_id'] . "</a></span></td>";
                echo "<td>" . $result['appointment_date_beg'] . "</td>";
                echo "<td>" . $result['appointment_date_end'] . "</td>";
                echo "<td>Dr. " . $result['doctor_first_name'] . " " . $result['doctor_last_name'] . "</td>";
                echo "</tr>\n";
            }
            echo "</table>\n";
        } else {
            echo "<p>You have no past appointments.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>
</div>

<?php include '../inc/footer.php';?>
</body>
</div>
</html>
