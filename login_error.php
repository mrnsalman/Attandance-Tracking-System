<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Attendance Tracking System</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
  <link rel="stylesheet" href="log_error.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
  <?php
  $message = $_GET['message'];
  if(empty($message)){
    $message = '';
  }
  if(isset($_POST["submit"])){
  if(!empty($_POST['username']) && !empty($_POST['password'])){
  $username =  $_POST ['username'];
  $password =  md5($_POST ['password']);
  $username =  stripcslashes ($username);
  $password =  stripcslashes ($password);
  //mysql_connect("localhost","root","");
  //mysql_select_db ("users");
  $con=mysqli_connect("localhost","root","","rmsdb")or die ("couldn't connect");
  $userquery = mysqli_query ($con,"SELECT * FROM users WHERE username = '".$username."' and password = '".$password."' limit 1") or die ("The query could not be completed. Please try again..".mysqli_error($con));
  $numrows=mysqli_num_rows($userquery);
  if ($numrows!=0){
  while ($rows = mysqli_fetch_array ($userquery)){
      $firstname = $rows ['firstname'];
      $lastname = $rows ['lastname'];
      $dbusername = $rows ['username'];
      $id = $rows ['id'];
      $dbpassword = $rows ['password'];
      $email = $rows ['email'];
      $designation = $rows ['designation'];
      $db = $rows ['db'];
  }
  if($username == $dbusername && $password == $dbpassword)  
    {  
    session_start();
      $_SESSION['sess_user']=$username;
      $_SESSION['sess_db']=$db;
      header ("Location: Home.php");
  } 
  }
    else {  
    $message = 'Invalide username or password!!';
    
    }  
  } else {  
    $message = 'All fields are required!!';
    
    } 
  }
?>
  
  <div id="particles-js">
    <div class="loginbox">
    <img src="image/avatar.png" class="avatar">
        <h1>Login Here</h1>
        <?php if(!empty($message)): ?>
        <div class="alert alert-danger" style="color: #DF0404; font-size: 13px; border: 2px solid #DF0404; border-radius: 10px; padding: 5px; padding-left: 5px; text-transform: uppercase; font-weight: bold">
          <?= $message; ?>
        </div>
      <?php endif; ?><br>
        <form action="login_error.php?message=" method="POST">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username">
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <input type="submit" name="submit" id="submit" value="Login">
            <p id="accpass">Not a user? <a href="Register.php">Create Account!</a></p>
            <p id="accpass">Forgot Passwor? <a id="pass" href="forgotpass.php">Reset Password!</a></p>
      </form>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

  <script>
    particlesJS.load('particles-js', 'particles.json', function(){
      console.log('particles.json loaded...');
    });
  </script>
    </div>
  </div>
</body>
</html>

