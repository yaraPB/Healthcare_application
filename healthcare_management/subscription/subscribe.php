<?php 
session_start();
if (isset($_SESSION['last_name'])) {
    // If the user is logged in, display a message
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Already Logged In</title>
        <base href="http://localhost:8000/healthcare_management/">
        <link rel="stylesheet" href="css/mystyle.css">
    </head>
    <body>
        <div class="wrapper2">
            <?php include '../inc/header.php'; ?>
            <div class="content">
                <h2>Subscription</h2>
                <p>You are already logged in as <strong><?php echo $_SESSION['last_name']; ?></strong>.</p>
                <p><a href="../healthcare_management/index.php">Return to Home</a></p>
            </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </body>
    </html>
    <?php
    exit();
}
?>


<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Subscription system PHP and MySQL</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<body>
  <div class="wrapper2">
  <?php include '../inc/header.php';?>

  <div class="content">
    <h2>Subscribe</h2>

    <form method="post" action="subscription/subscribe.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>Last name</label>
        <input type="text" name="lname" value="<?php echo $lname; ?>">
      </div>
      <div class="input-group">
        <label>First name</label>
        <input type="text" name="fname" value="<?php echo $fname; ?>">
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
      </div>
      <div class="input-group">
        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>">
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="pswrd" value="<?php echo $pswrd; ?>">
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="sub_user">Subscribe</button>
      </div>
      <p>Already a member?</p>
      <a href='login/login.php'>Login</a>
    </form>
  </div>




  <?php include '../inc/footer.php';?>
  </div>
</body>
</html>