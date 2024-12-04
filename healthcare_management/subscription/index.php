<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
        $_SESSION['msg'] = "You can subscribe";
        header('location: subscribe.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <base href="http://localhost:8000/healthcare_management/">
  <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>
  <?php include '../inc/header.php';?>

  <div class="content">
    <h2>Home Page</h2>
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- subscribed user information -->
    <?php  if (isset($_SESSION['name'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['name']; ?></strong></p>
    <?php endif ?>
  </div>
                
  <?php include '../inc/footer.php';?>
</body>
</html>