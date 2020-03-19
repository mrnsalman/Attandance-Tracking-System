<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="stylesheet" type="text/css" href="style6.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
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
    $dbname=$_SESSION['sess_db'];

}
else {
    header("Location: Login-error.php?message=You must be logged in first!!");
}

$db = mysqli_connect('localhost', 'root', '', $dbname);
if (!$db)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }

$message = '';
$errors = array();
$code = $_GET['coursecode'];
$semester = $_GET['semester'];
$table = $code . $semester;
if (isset ($_POST['submit'])) {
  $batchname = mysqli_real_escape_string($db, $_POST['Batch']);
  $dayeve = mysqli_real_escape_string($db, $_POST['dayeve']);
  $Batch = $batchname . $dayeve;

  if (empty($batchname)) { array_push($errors, "Batch name is required");}
  if (empty($dayeve)) { array_push($errors, "Day/Evening is required"); }

if (count($errors) == 0) {
  $sql = "INSERT INTO $table SELECT * FROM rmsdb.$Batch";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $message = 'Batch added successfully';
  }
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
    <li>
    <div class="item">
      <input type="checkbox" id="check3" class="cbx">
      <label for="check3"><i class="fas fa-address-book" style="color: white :hover black;width: 30px"></i>Attendance</label>
      <ul>
      <li><a href="view_attendance.php?coursecode=<?php echo $code?>&semester=<?php echo $semester?>"><i class="fa fa-eye" style="color: white :hover black;width: 30px"></i> View Attendance</a></li>
    <li><a href="batch_create.php?coursecode=<?php echo $code?>&semester=<?php echo $semester?>"><i class="fa fa-users" style="color: white :hover black;width: 30px"></i>Add Batch</a></li>
    <li><a href="student_create.php?coursecode=<?php echo $code?>&semester=<?php echo $semester?>"><i class="fa fa-user-plus" style="color: white :hover black;width: 30px"></i>Add Student</a></li>
    <li><a href="student_edit_page.php?coursecode=<?php echo $code?>&semester=<?php echo $semester?>"><i class="fa fa-user-edit" style="color: white :hover black;width: 30px"></i>Edit Student</a></li>
    <li><a href="student_delete_page.php?coursecode=<?php echo $code?>&semester=<?php echo $semester?>"><i class="fa fa-user-times" style="color: white :hover black;width: 30px"></i>Delete Student</a></li>
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
      <h2>Add Batch</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <?php include ('errors.php'); ?>
      <form method="post">
        <div class="form-group">
          <label for="Batch">Batch Name</label>
          <input type="text" name="Batch" id="Batch" class="form-control">
        </div>
          <div class="form-group">
          <label for="dayeve">Day/Eve</label>
          <select type="text" name="dayeve" id="dayeve" class="form-control">
            <option value="day" selected>Day</option>
            <option value="eve">Eve</option>
            </select>
        </div>
        <div class="form-group">
          <button type="submit" name="submit" id="submit" class="btn btn-info">ADD</button>
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