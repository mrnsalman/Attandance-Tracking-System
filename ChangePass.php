<!DOCTYPE html>
<html>
    
    <head>
        <title>RMS Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style6.css">
    </head>
    <body>
<?php
require 'db.php';
$message = '';
 ?>
 <div class="headsection">
                <div class="logo">
                <a href="HomeFinal.php">
                <img src="image/bu-logo.png" alt="Logo" width="200" height="100"></a>
            </div>
            <div class="welcome">
            <marquee><p>Welcome, <?php echo $user?></p></marquee>
            </div>
            <h1>Bangladesh University</h1>
        </div>
        <div style="clear: both"></div>
        
        <div class="contensection">
       <?php require 'header.php'; ?>
        <div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Change Password</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>                
      <form action="Changepass_final.php" method="post">
        <div class="form-group">
          <label for="oldpassword">Current Password</label>
          <input type="password" name="oldpassword" id="oldpassword" class="form-control">
        </div>

        <div class="form-group">
          <label for="newpassword">New Password</label>
          <input type="password" name="newpassword" id="newpassword" class="form-control" >
        </div>
          <div class="form-group">
          <label for="renewpassword">Repeat New Password</label>
          <input type="password" name="renewpassword" id="renewpassword" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" name="submit" id="submit" class="btn btn-info">Change</button>
          </div>
      </form>
    </div>
                    
                    
                    
                    </div>
                    
                </div>
              </div>
              <div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>
</body>
</html>
    