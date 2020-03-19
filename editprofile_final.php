<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
        <link rel="stylesheet" type="text/css" href="style6.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" type="text/css" href="test.css">
        <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap.min.js"></script>
  <script type="text/javascript">
    $(function() { 
  $('.cbx').bind('click',function() {
    $('.cbx').not(this).prop("checked", false);
  });
});
  </script>
    </head>
    <body>
<?php
session_start();
        if(isset($_SESSION['sess_user'])){
            $user=$_SESSION['sess_user'];
    
        }
        else {
            header("Location: Login-error.php?message=You must be logged in first!!");
        }
$message = "";
$con=mysqli_connect("localhost","root","","rmsdb");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
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
if (isset ($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $department = $_POST['department'];
  $designation = $_POST['designation'];
  $phone = $_POST['phone'];
  $filename = $_FILES["uploadfile"]["name"];
  if(empty($filename)){
    $filename = $picture;
    $folder = $filename;
  }else{
    $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "pictures/".$filename;
  move_uploaded_file($tempname, $folder);
  }
  $sql = "UPDATE users SET firstname='$firstname',  lastname='$lastname', email='$email', phone='$phone', department='$department', designation='$designation', pic='$folder' WHERE username='$user'";
  $result = mysqli_query($con, $sql);
  if($result){
    $message = 'data updated successfully';
  }
}
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
          <div id="sidebar">
  <ul>
    <li><a href="Home.php"><i class="fa fa-home" style="color: white :hover black;width: 30px"></i>Home</a></li>
    <li>
      <div class="item">
      <input type="checkbox" id="check2" class="cbx">
      <label for="check2"><i class="fa fa-user-alt" style="color: white :hover black;width: 30px"></i>Profile</label>
      <ul>
        <li><a href="viewprofile.php"><i class="fas fa-street-view" style="color: white :hover black;width: 30px"></i>View Profile</a></li>
        <li><a href="editprofile_final.php"><i class="fa fa-user-edit" style="color: white :hover black;width: 30px"></i>Edit Profile</a></li>
        <li><a href="ChangePass_final.php"><i class="fa fa-key" style="color: white :hover black;width: 30px"></i>Change Password</a></li>
      </ul>
      </div>
    </li>
    <li>
      <div class="item">
      <input type="checkbox" id="check1" class="cbx">
      <label for="check1"><i class="fas fa-file-alt" style="color: white :hover black;width: 30px"></i>Course</label>
      <ul>
        <li><a href="course_list.php?semester=<?php echo $semester?>"><i class="fas fa-file" style="color: white :hover black;width: 30px"></i>View Course</a></li>
        <li><a href="course_create_final.php"><i class="fas fa-file-medical" style="color: white :hover black;width: 30px"></i>Add Course</a></li>
        <li><a href="course_edit_page.php?semester=<?php echo $semester?>"><i class="fas fa-edit" style="color: white :hover black;width: 30px"></i>Edit Course</a></li>
        <li><a href="course_delete_page.php?semester=<?php echo $semester?>"><i class="fas fa-trash-alt" style="color: white :hover black;width: 30px"></i>Delete Course</a></li>
      </ul>
      </div>
    </li>
   <li><a href="logout.php?message="><i class="fa fa-sign-out-alt" style="color: white :hover black; width: 30px"></i>Logout</a></li>
</ul>
</div>
<div id="toggle-btn" onclick="toggleSidebar(this)">
  <span></span>
  <span></span>
  <span></span>
</div>
<script>
  function toggleSidebar(ref) {
  ref.classList.toggle('active');
  document.getElementById('sidebar').classList.toggle('active');
}
</script>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edit Profile</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissable fade show">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
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
</div>
<div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>
</body>
</html>