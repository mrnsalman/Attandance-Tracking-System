<?php include('header.php') ?>
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();
$message = '';
$code = '';

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'rmsdb');
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }

if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required");}  
  if (empty($email)) { array_push($errors, "Email is required"); }
  //if (empty($dbname)) { array_push($errors, "Database name is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username && $user['email'] === $email) {
      $code = rand(10000, 1000000);
      $to = $user['email'];
      $subject = "Pasword reset";
      $body = "
      This is an automated mail. Please do not reply to this mail.

      Click the link below or paste it into your browser
      http://localhost/attendance/forgotpass_complete.php?code=$code&username=$username
      ";
      $headers = "From: testmiran1992@gmail.com";
    }
    else {
      array_push($errors, "Username or Email doesn't match");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $query = "UPDATE users SET passreset='$code' WHERE username='$username'";
    $result=mysqli_query($db, $query);
    if($result){
      mail($to, $subject, $body, $headers );
      $message = 'Check Your Email';
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
	<form method="post" action="forgotpass.php" enctype="multipart/form-data">
    <?php include ('errors.php'); ?>    
  	<div class="form-group">
  	  <label for="username">Username</label>
  	  <input type="text" name="username" id="usernmae" class="form-control">
  	</div>
  	<div class="form-group">
  	  <label for="email">Email</label>
  	  <input type="email" name="email" id="email" class="form-control">
  	</div>
    <div class="form-group">    
      <button type="submit" class="btn btn-info" name="submit">Reset</button>
    </div>
  </form>
  <?php require 'footer.php'; ?>