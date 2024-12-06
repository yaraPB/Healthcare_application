<?php
// Ensure session is only started if not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session only if no session is already active
}

echo "<header>
  <a href=''>Home</a>
  <a href='doctors/doctors.php'>Doctors</a>
  <a href='appointments/appointments.php'>Appointments</a>
  <a href='subscription/subscribe.php'>Subscribe</a>
 ";
  // Check if the user is logged in
  if (isset($_SESSION['last_name'])) {  // Assuming 'user_id' is set when the user logs in
    echo "<a href='booking/booking.php'>Booking</a>";  // Show logout link if logged in
    echo "<a href='logout/logout.php'>Logout</a>";
} 
echo "</header>\n";
?>
