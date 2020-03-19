<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Attendance Tracking System</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
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
$semester = $_GET['semester'];
$code = $_GET['coursecode'];
$table = $code . $semester;
$sql = "DELETE FROM $semester WHERE coursecode='$code'";
$result = mysqli_query($db, $sql);
$sql1 = "DROP TABLE $table";
$result1= mysqli_query($db, $sql1);
if($result&&$result1){
	$message = 'Course deleted successfully';
}
$sql2 = "SELECT * FROM $semester";
$result2 = mysqli_query($db, $sql2);
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
          <div align="left" class="semester">
            <form action="course_delete_page.php" method="POST" id="frm">
              <input type="text" name="semestername" id="semestername">
              <input type="submit" name="submit" value="VIEW">
            </form>
          </div>
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
  <div class="datatable">
      <table class="table table-bordered">
        <tr>
          <td id="tblheader" colspan="6"><h2>DELETE COURSES</h2></td>
        </tr>
        <tr>
          <td colspan="6" class="alert alert-success">
            <?php if(!empty($message)): ?>
          <?= $message; ?>
    <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>Course Name</th>
          <th>Course Code</th>
          <th>Credit</th>
          <th>Theory/Lab</th>
          <th>Semester</th>
          <th>Action</th>
        </tr>
        <?php if($result2)
        foreach($result2 as $rows): ?>
          <tr>
            <td><?php echo "<a href='view_attendance.php?coursecode=".$rows['coursecode']."&semester=".$rows['semester']."'>".$rows['coursename']."</a>" ?></td>
            <td><?php echo $rows['coursecode'] ?></td>
            <td><?php echo $rows['credit'] ?></td>
            <td><?php echo $rows['labtheory'] ?></td>
            <td><?php echo $rows['semester'] ?></td>
              <td>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="course_delete_final.php?semester=<?php echo $rows['semester'] ?>&coursecode=<?php echo $rows['coursecode'] ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>
</body>
</html>