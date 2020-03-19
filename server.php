<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$firstname = "";
$lastname = "";
$phone = "";
$department = "";
$designation = "";
$errors = array();
$message = '';
$filename = "";
$tempfile = "";
$folder = "";
$dbname = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'rmsdb');
if (!$db)
  {
  die('Could not connect: ' . mysql_error());
  }
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);    
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $department = mysqli_real_escape_string($db, $_POST['department']);
  $designation = mysqli_real_escape_string($db, $_POST['designation']);
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "pictures/".$filename;
  move_uploaded_file($tempname, $folder);
  //$dbname = mysqli_real_escape_string($db, $_POST['dbname']);
  $dbname = $username . 'db';

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required");}
  if (empty($firstname)) { array_push($errors, "Firstname is required"); }
  if (empty($lastname)) { array_push($errors, "Lastname is required"); }    
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone Number is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($department)) { array_push($errors, "Department is required"); }
  if (empty($designation)) { array_push($errors, "Designation is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  //if (empty($dbname)) { array_push($errors, "Database name is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);
    //encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, password, firstname, lastname, email, phone, department, designation, pic, db) VALUES('$username', '$password', '$firstname', '$lastname', '$email', '$phone', '$department', '$designation', '$folder', '$dbname')";
  	$result=mysqli_query($db, $query);
    $query2 = "CREATE DATABASE $dbname";
    $result2=mysqli_query($db, $query2);
    $query3 =  "CREATE TABLE $dbname.course(
    coursename varchar(50),
    coursecode varchar(50) PRIMARY KEY,
    credit int(11) NOT NULL,
    labtheory varchar(50))";
    $result3=mysqli_query($db, $query3);
      if($result && $result2 && $result3){
         $message = 'Account created successfully <a class="btn btn-success" href="Login.php">Login Now...</a>';
      }
  }
}?>
<?php require 'header.php'; ?>
      <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissable fade show">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          <?= $message; ?>
        </div>
      <?php endif; ?>
<?php include ('errors.php'); ?>
<?php require 'footer.php'; ?>
