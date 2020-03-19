<?php include('header.php') ?>
<?php
session_start();

// initializing variables
$newpass = "";
$repass   = "";
$errors = array();
$message = '';

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'rmsdb');
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }

  if($_GET['code']){
  $get_username = $_GET['username'];
  $get_code = $_GET['code'];
  $sql = "SELECT * FROM users WHERE username='$get_username'";
  $result = mysqli_query($db, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $db_code = $row['passreset'];
    $db_username = $row['username'];
  }
  if($get_username == $db_username && $get_code == $db_code){
    if (isset($_POST['submit'])) {
  // receive all input values from the form
  $newpass = mysqli_real_escape_string($db, md5($_POST['newpass']));
  $repass = mysqli_real_escape_string($db, md5($_POST['repass']));

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($newpass)) { array_push($errors, "New Password is required");}  
  if (empty($repass)) { array_push($errors, "Re Password is required"); }
  //if (empty($dbname)) { array_push($errors, "Database name is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  if (count($errors) == 0){
  if($newpass==$repass){
         $sql = "UPDATE users SET password='$newpass' WHERE username= '$get_username'";
    $result = mysqli_query($db, $sql); 
            if($result){
                $message = 'Password reset successfull.. You can now <a href="Login.php">Login</a> with your new password!';
            }
        }
            else{
            $message = 'New password does not match..';}
        }

  }
}
}
?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Reset Password</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
	<form method="post" action="" enctype="multipart/form-data">
    <?php include ('errors.php'); ?>    
  	<div class="form-group">
  	  <label for="newpass">New Password</label>
  	  <input type="password" name="newpass" id="newpass" class="form-control">
  	</div>
  	<div class="form-group">
  	  <label for="repass">Re Enter Password</label>
  	  <input type="password" name="repass" id="repass" class="form-control">
  	</div>
    <div class="form-group">    
      <button type="submit" class="btn btn-info" name="submit">Reset</button>
    </div>
  </form>
  <?php require 'footer.php'; ?>