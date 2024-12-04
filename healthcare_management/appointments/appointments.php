<!DOCTYPE html>
<html>

<head>
  <title>Appointments</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<div class="wrapper">
<body>

<?php include '../inc/header.php';?>

<div class="content">
<h2>Upcoming appointments</h2>
<p>Our healthcare facility is working 24/7 to ensure your safety and well-being</p>
<?php
include "../config/init.php";
try
{
    $conn = new PDO("mysql:host=$server; dbname=$db", $user, $password);

    $qry = "SELECT appointment_id, appointment_date  
             FROM appointment
             ORDER BY appointment_id;";
    $stmt = $conn->prepare($qry);
    $stmt->execute();

    echo "<table>\n";
    echo "<caption>Appointments</caption>\n";
    echo "<tr><th>Appointment Number</th><th>Date</th></tr>\n";

    //loop through each row
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td><span class='number'><a href='appointments/appointment_details.php?id=" . $result['appointment_id'] . "'>" . $result['appointment_id'] . "</a></span></td>";
        echo "<td>" . $result['appointment_date'] . "</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
</div>

<?php include '../inc/footer.php';?>
</body>
</div>
</html>
