<?php
        session_start();
        $user= $_SESSION['sess_user'];
        $con = mysqli_connect("localhost","root","","rmsdb");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
        $result = mysqli_query($con, "SELECT * FROM users where username='$user'");
        while($row = mysqli_fetch_array($result))
  {
  $username = $row['username'];
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $password = $row['password'];
  $email = $row['email'];        
  $designation = $row['designation'];
  $department = $row['department'];
  $phone = $row['phone'];
  $picture = $row['pic'];            
}
        ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edit Profile</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form action= "editprofile_final.php"  method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="firstname">Firstname</label>
          <input type="text" value="<?php echo $firstname; ?>" name="firstname" id="firstname" class="form-control">
        </div>
          <div class="form-group">
          <label for="lastname">Lastname</label>
          <input type="text" value="<?php echo $lastname; ?>" name="lastname" id="lastname" class="form-control">
        </div>
          <div class="form-group">
          <label for="email">Email</label>
          <input type="text" value="<?php echo $email; ?>" name="email" id="email" class="form-control">
        </div>
          <div class="form-group">
          <label for="email">Phone</label>
          <input type="text" value="<?php echo $phone; ?>" name="phone" id="phone" class="form-control">
        </div>
          <div class="form-group">
          <label for="department">Department</label>
          <input type="text" value="<?php echo $department; ?>" name="department" id="department" class="form-control">
        </div>
          <div class="form-group">
          <label for="designation">Designation</label>
          <input type="text" value="<?php echo $designation; ?>" name="designation" id="designation" class="form-control">
        </div>
          <div class="form-group">
          <label for="uploadfile">Change Picture</label>
            <br>  
          <input type="file" class="btn btn-success" name="uploadfile" id="uploadfile" class="form-control">
          </div>
        <div class="form-group">
          <button type="submit"
          name="submit"  id="submit" 
          class="btn btn-info">Update Profile</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>