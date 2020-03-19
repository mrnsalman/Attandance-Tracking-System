<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
  <title>Attendance Tracking System</title>
</head>
<body>
<?php include('server.php') ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create an Account</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
	<form method="post" action="server.php" enctype="multipart/form-data">
    <?php include ('errors.php'); ?>    
  	<div class="form-group">
  	  <label for="username">Username</label>
  	  <input type="text" name="username" id="usernmae" class="form-control">
  	</div>
    <div class="form-group">
  	  <label for="firstname">Firstname</label>
  	  <input type="text" name="firstname" id="firstname" class="form-control">
  	</div>
    <div class="form-group">
  	  <label for="lastname">Lastname</label>
  	  <input type="text" name="lastname" id="lastname" class="form-control">
  	</div>
  	<div class="form-group">
  	  <label for="email">Email</label>
  	  <input type="email" name="email" id="email" class="form-control">
  	</div>
      <div class="form-group">
  	  <label for="phone">Phone</label>
  	  <input type="text" name="phone" id="phone" class="form-control">
  	</div>
  	<div class="form-group">
  	  <label for="password">Password</label>
  	  <input type="password" name="password_1" id="password_1" class="form-control">
  	</div>
  	<div class="form-group">
  	  <label for="password">Confirm password</label>
  	  <input type="password" name="password_2" id="password_2" class="form-control">
  	</div>
      <div class="form-group">
  	  <label for="department">Department</label>
  	  <input type="text" name="department" id="department" class="form-control">
  	</div>
    <div class="form-group">
  	  <label for="designation">Designation</label>
  	  <input type="text" name="designation" id="designation" class="form-control">
  	</div>
    <!--<div class="form-group">
        <label for="dbname">Set Database</label>
        <br>
  	  <input type="text" name="dbname" value="" placeholder="usernamedb" id="dbname" class="form-control">
  	</div>//-->
    <div class="form-group">
        <label for="image">Set Profile Picture</label>
        <br>
  	  <input type="file" class="btn btn-success" name="uploadfile" value="" class="form-control">
  	</div>     
  	<div class="form-group">    
  	  <button type="submit" class="btn btn-info" style="cursor: pointer;" name="reg_user">Create Account</button>
  	</div>
  	<div>
  	<p class="text-right">
  		<span class="text-info">Already a member?</span> <a class="btn btn-primary" href="login.php">Sign in</a>
  	</p>
  	</div>
  </form>
        <?php require 'footer.php'; ?>
      </div>
    </div>
  </div>
</body>
</html>