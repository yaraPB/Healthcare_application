<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();  // Start the session only if no session is already active
}
if (!isset($_SESSION['last_name'])) {
    $_SESSION['msg'] = "You need to log in to book an appointment";
    header('location: ../subscription/subscribe.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<body>
  <div class="wrapper">
    <?php include '../inc/header.php'; ?>

    <div class="content">
      <h2>Book an Appointment</h2>
      <form method="post" action="book_appointment.php">
        <div class="input-group">
          <label>Appointment Date</label>
          <input type="date" name="appointment_date" required>
        </div>
        <div class="input-group">
          <button type="submit" class="btn" name="book_appointment">Book</button>
        </div>
      </form>
    </div>

    <?php include '../inc/footer.php'; ?>
  </div>
</body>
</html>
