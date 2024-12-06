<?php 
session_start();
include('server.php') 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" href="css/mystyle.css">
</head>
<body>
  <div class="wrapper2">
  <?php include '../inc/header.php';?>

  <div class="content">
    <h2>Login</h2>

    <form method="post" action="login/login.php">
      <?php include('errors.php'); ?>
      <div class="input-group">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="pswrd" value="<?php echo $pswrd; ?>">
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
      </div>
      <p>Not a member yet?</p>
      <a href='subscription/subscribe.php'>Subscribe</a>
    </form>
  </div>

  <?php include '../inc/footer.php';?>
  </div>
</body>
</html>
