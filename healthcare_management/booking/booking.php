<?php
session_start();
if (!isset($_SESSION['last_name'])) {
    header('Location: ../subscription/subscribe.php');
    exit();
}

include '../config/init.php';

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $appointment_date_beg = $_POST['appointment_date_beg'];
        $doctor_id = $_POST['doctor_id'];
        $patient_id = $_SESSION['patient_id'];

        // Validate input
        if (empty($appointment_date_beg)) {
            $errors[] = "Appointment date is required.";
        }

        if (empty($doctor_id)) {
            $errors[] = "Doctor is required.";
        }

        if (empty($errors)) {
            // Calculate appointment end time
            $appointment_date_end = date('Y-m-d H:i:s', strtotime($appointment_date_beg . ' +30 minutes'));

            // Check for doctor conflicts
            $doctor_query = "SELECT 1 
                             FROM appointment 
                             WHERE doctor_id = :doctor_id 
                             AND appointment_date_beg < :appointment_date_end 
                             AND appointment_date_end > :appointment_date_beg";
            $doctor_stmt = $conn->prepare($doctor_query);
            $doctor_stmt->execute([
                ':doctor_id' => $doctor_id,
                ':appointment_date_beg' => $appointment_date_beg,
                ':appointment_date_end' => $appointment_date_end,
            ]);
            $doctor_conflict = $doctor_stmt->rowCount() > 0;

            // Check for patient conflicts
            $patient_query = "SELECT 1 
                              FROM appointment 
                              WHERE patient_id = :patient_id 
                              AND appointment_date_beg < :appointment_date_end 
                              AND appointment_date_end > :appointment_date_beg";
            $patient_stmt = $conn->prepare($patient_query);
            $patient_stmt->execute([
                ':patient_id' => $patient_id,
                ':appointment_date_beg' => $appointment_date_beg,
                ':appointment_date_end' => $appointment_date_end,
            ]);
            $patient_conflict = $patient_stmt->rowCount() > 0;

            // Handle conflicts
            if ($doctor_conflict && $patient_conflict) {
                $errors[] = "The appointment could not be booked because both the doctor and the patient (you) are unavailable.";
            } elseif ($doctor_conflict) {
                $errors[] = "The appointment could not be booked because the doctor is unavailable.";
            } elseif ($patient_conflict) {
                $errors[] = "The appointment could not be booked because you are unavailable.";
            } else {
                // No conflicts: Insert the appointment
                $insert = "INSERT INTO appointment (appointment_date_beg, appointment_date_end, patient_id, doctor_id)
                           VALUES (:appointment_date_beg, :appointment_date_end, :patient_id, :doctor_id)";
                $stmt = $conn->prepare($insert);
                $stmt->execute([
                    ':appointment_date_beg' => $appointment_date_beg,
                    ':appointment_date_end' => $appointment_date_end,
                    ':patient_id' => $patient_id,
                    ':doctor_id' => $doctor_id,
                ]);

                $success = "Your appointment has been booked successfully!";
            }
        }
    } catch (PDOException $e) {
        $errors[] = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking</title>
    <base href="http://localhost:8000/healthcare_management/">
    <link rel="stylesheet" href="css/mystyle.css">
    <style>
        /* Add CSS to make error messages red */
        .errors p {
            color: red;
            font-weight: bold;
        }
        .success p {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="wrapper2">
    <?php include '../inc/header.php'; ?>
    <div class="content">
        <h2>Booking</h2>
        <p>Book a new consultation today, <strong><?php echo htmlspecialchars($_SESSION['last_name']); ?></strong>.</p>
        <form method="post" action="">
            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="success">
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            <?php endif; ?>
            <div class="input-group">
                <label for="appointment_date_beg">Beginning Appointment Date and Time (YYYY-MM-DD HH:MM:SS) (e.g: 2024-12-06 11:00:00):</label>
                <input type="text" id="appointment_date_beg" name="appointment_date_beg">
            </div>
            <div class="input-group">
                <label for="doctor_id">Doctor ID:</label>
                <input type="text" id="doctor_id" name="doctor_id">
            </div>
            <div class="input-group">
                <button type="submit" class="btn">Book Appointment</button>
            </div>
        </form>
    </div>
</div>
<?php include '../inc/footer.php'; ?>
</body>
</html>
