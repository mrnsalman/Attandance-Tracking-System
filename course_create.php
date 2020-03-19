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
                <a href="Home.php">
                <img src="image/bu-logo.png" alt="Logo" width="200" height="100"></a>
            </div>
            <div class="welcome">
            <marquee><p>Welcome, <?php echo $user?></p></marquee>
            </div>
            <h1>Bangladesh University</h1>
        </div>
        <div style="clear: both"></div>
        
        <div class="contensection">
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a course</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post" action="course_create_final.php">
        <div class="form-group">
          <label for="coursename">Course Name</label>
          <input type="text" name="coursename" id="coursename" class="form-control">
        </div>
        <div class="form-group">
          <label for="coursename">Course Code</label>
          <input type="text" name="coursecode" id="coursecode" class="form-control">
        </div>
          <div class="form-group">
          <label for="credit">Credit</label>
          <select type="text" name="credit" id="credit" class="form-control">
            <option value="1">1</option>
            <option value="3" selected>3</option>
            </select>
        </div>
        <div class="form-group">
          <label for="labtheory">Theory/Lab</label>
            <select type="text" name="labtheory" id="labtheory" class="form-control">
            <option value="Lab">Lab</option>
            <option value="Theory" selected>Theory</option>
            </select>
          </div>
        <div class="form-group">
          <button type="submit" name="submit" id="submit" class="btn btn-info">Add course</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<div class="footer">
        <p>&copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved</p>
        </div>
</body>
</html>