<!DOCTYPE html>
<html>
<head>
  <title>Our Doctors</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<div class="wrapper">
<body>
<?php include '../inc/header.php';?>

<div class="content">
<h2>Our Doctors</h2>
<?php
include "../config/init.php";
try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    $qry = "SELECT doctor_id, doctor_last_name, doctor_first_name, doctor_speciality
             FROM doctor
             ORDER BY doctor_id;";
    $stmt = $conn->prepare($qry);
    $stmt->execute();

    echo "<table>\n";
    echo "<caption>The best in their fields</caption>\n";
    echo "<tr><th>Last Name</th><th>First Name</th><th>Speciality</th></tr>\n";

    //loop through each row
    while ($result = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $result['doctor_last_name'] . "</td>";
        echo "<td>" . $result['doctor_first_name'] . "</td>";
        echo "<td>" . $result['doctor_speciality'] . "</td>";
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
</div>
</body>
</html>
