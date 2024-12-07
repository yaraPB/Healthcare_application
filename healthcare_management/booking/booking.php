<?php 
session_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Booking</title>
        <base href="http://localhost:8000/healthcare_management/">
        <link rel="stylesheet" href="css/mystyle.css">
    </head>
    <body>
        <div class="wrapper2">
            <?php include '../inc/header.php'; ?>
            <div class="content">
                <h2>Booking</h2>
                <p>Book or a new consultation today <strong><?php echo $_SESSION['last_name']; ?></strong>.</p>
                <p>You can also cancel a previous consultation today <strong><?php echo $_SESSION['last_name']; ?></strong>.</p>
            </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </body>
    </html>
    <?php
    exit();

?>