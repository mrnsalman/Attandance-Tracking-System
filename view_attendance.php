<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
        <link rel="stylesheet" type="text/css" href="view_attendance.css">
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
  <script>
function togglecheckboxes(master,group){
    var cbarray = document.getElementsByName(group);
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
  }
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
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="$dbname"; // Database name
$code = $_GET['coursecode'];
$semester = $_GET['semester'];
$table = $code . $semester;

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
<?php         

echo "<center>";
echo "<table border='1'>";
echo "<tr>";
echo "<th id='tblheader' colspan='7'><h2>Attendance</h2></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Student Name</th>";
echo "<th>Student Id</th>";
echo "<th>Class Conducted</th>";
echo "<th>Class Attended</th>";
echo "<th>Parcentage</th>";
echo "<th>Zone</th>";
echo "<th>Mark Attendance</th>";
echo "</tr>";

echo "<form action='update.php?coursecode=$code&semester=$semester' method='post'>";
if($result){
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

  echo "<tr>";
  echo "<td>" . $row['studentname'] . "</td>";
  echo "<td>" . $row['studentid'] . "</td>";
  echo "<td>" . $row['class_conducted'] . "</td>";
  echo "<td>" . $row['class_attended'] . "</td>";
  echo "<td>" . $c . "</td>";
  if ($c>=80) echo "<td align='center'><font size=\"4\" color=\"green\">" . $d . "</font></td>";
  elseif ($c>=70 ) echo "<td align='center'><font size=\"4\" color=\"orange\">" . $e . "</font></td>";
  else echo "<td align='center'><font size=\"4\" color=\"red\">" . $f . "</font></td>";
  echo "<td align='center'><input type='checkbox' name='cb[]' class='cb' id='cb' value=". $row['studentid'] ."></td>";
  echo "</tr>";
  }
}
echo "<tr>";
echo "<th id='updatebtn' align='center' colspan='6'><input type='submit' name='submit' id='submit' value='Update' class='btn btn-info'></th>";
echo "<td style=background:paleturquoise><input type='checkbox' name='cb_master' id='cb_master' onchange=togglecheckboxes(this,'cb[]')></td>";
echo "</tr>";
echo "</form>";
echo "</table>";
echo "</center>";
mysqli_close($con);
?>
</div>
</div>
</div>
</div>
<footer class="footer">
        <p>&copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved</p>
        </footer>
</body>
</html>