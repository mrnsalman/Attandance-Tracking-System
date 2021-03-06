<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="stylesheet" type="text/css" href="view_attendance.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
  
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
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="$dbname"; // Database name
$table = $_GET['coursecode'];

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
$sql = "SELECT * FROM $table";
$result = mysqli_query($con, $sql);
?>
<div class="wrapper">
<div class="headsection">
  <div class="logo">
                <a href="Home.php">
                <img src="image/bu-logo.png" alt="Logo" width="200" height="100"></a>
            </div>
            <div class="welcome">
            <marquee><p>Welcome, <?php echo $user?></p></marquee>
            </div>
            <div><h1>Bangladesh University</h1></div>
        </div>
        <div style="clear: both"></div>

 <div class="contensection">
  <div id="sidebar">
  <ul>
    <li><a href="Home.php"><i class="fa fa-home" style="color: white :hover black;width: 30px"></i>Home</a></li>
    <li>
      <div class="item">
      <input type="checkbox" id="check2">
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
      <input type="checkbox" id="check1">
      <label for="check1"><i class="fas fa-file-alt" style="color: white :hover black;width: 30px"></i>Course</label>
      <ul>
        <li><a href="course_list.php"><i class="fas fa-file" style="color: white :hover black;width: 30px"></i>View Course</a></li>
        <li><a href="course_create_final.php"><i class="fas fa-file-medical" style="color: white :hover black;width: 30px"></i>Add Course</a></li>
        <li><a href="course_edit_page.php"><i class="fas fa-edit" style="color: white :hover black;width: 30px"></i>Edit Course</a></li>
        <li><a href="course_delete_page.php"><i class="fas fa-trash-alt" style="color: white :hover black;width: 30px"></i>Delete Course</a></li>
      </ul>
      </div>
    </li>
    <li>
    <div class="item">
      <input type="checkbox" id="check3">
      <label for="check3"><i class="fas fa-address-book" style="color: white :hover black;width: 30px"></i>Attendance</label>
      <ul>
      <li><a href="view_attendance.php?coursecode=<?php echo $_GET['coursecode'] ?>"><i class="fa fa-eye" style="color: white :hover black;width: 30px"></i> View Attendance</a></li>
    <li><a href="batch_create.php?coursecode=<?php echo $_GET['coursecode'] ?>"><i class="fa fa-users" style="color: white :hover black;width: 30px"></i>Add Batch</a></li>
    <li><a href="student_create.php?coursecode=<?php echo $_GET['coursecode'] ?>"><i class="fa fa-user-plus" style="color: white :hover black;width: 30px"></i>Add Student</a></li>
    <li><a href="student_edit_page.php?coursecode=<?php echo $_GET['coursecode'] ?>"><i class="fa fa-user-edit" style="color: white :hover black;width: 30px"></i>Edit Student</a></li>
    <li><a href="student_delete_page.php?coursecode=<?php echo $_GET['coursecode'] ?>"><i class="fa fa-user-times" style="color: white :hover black;width: 30px"></i>Delete Student</a></li>
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
  <div class="datatable">
  	<form>
      <table class="table table-bordered">
        <tr>
          <td id="tblheader" colspan="5"><h2>Students Attendance</h2></td>
        </tr>
        <tr>
          <th>Studen Name</th>
          <th>Student ID</th>
          <th>Class Conducted</th>
          <th>Class Attended</th>
          <th>Parcentage</th>
          <th>Zone</th>
          <th>Mark Attendance</th>
        </tr>
        <?php foreach($result as $rows):?>

          <tr>
            <td><?php echo $rows['studentname'] ?></td>
            <td><?php echo $rows['studentid'] ?></td>
            <td><?php echo $rows['class_conducted'] ?></td>
            <td><?php echo $rows['class_attended'] ?></td>
            <?php if($result){
while($row = mysqli_fetch_assoc($result))
  {
  $a = $row['class_conducted'];
  $b = $row['class_attended'];
  if($a&&$b!=0){
  $c = ($b/$a)*100;
  $c = number_format ($c, 2);
  }
  else {
    $c = 0;
  }
  $d = "ALLOWED";
  $e = "SUBMIT ASSIGNMENT";
  $f = "NOT ALLOWED";
}
}
?>
            <td><?php echo $c ?></td>
            <td <? if($c>=80) print "style=color:green"; elseif($c>=75) print "style=color:orange"; else print "style=color:red";?>>
    </td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td id="updatebtn" colspan="5">
            <a onclick="return confirm('Are you sure you want to delete all students?')" href="student_delete_all.php?coursecode=<?php echo $table?>" class="btn btn-danger">DELETE ALL STUDENTS</a>
          </td>
        </tr>
      </table>
  </form>
    </div>
  </div>
</div>
<div class="footer">
        <p>&copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved</p>
        </div>
</body>
</html>