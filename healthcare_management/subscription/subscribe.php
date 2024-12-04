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
        <button type="submit" class="btn" name="sub_user">Subscribe</button>
      </div>
    </form>
  </div>




  <?php include '../inc/footer.php';?>
  </div>
</body>
</html>