<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
        <link rel="stylesheet" type="text/css" href="course_list.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
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

$result = array();

if(isset($_POST['submit'])){
  $semester = mysqli_real_escape_string($db, $_POST['semestername']);
  $sql = "SELECT * FROM $semester";
  $result = mysqli_query($db, $sql);
}
else {
  $semester = $_GET['semester'];
  $sql = "SELECT * FROM $semester";
  $result = mysqli_query($db, $sql);
}
?>
<div class="wraper">
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
        		<form action="course_list.php" method="POST" id="frm">
        			<input type="text" name="semestername" id="semestername" placeholder="Type semester Name">
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
</ul>
</div>
<div id="toggle-btn" onclick="toggleSidebar(this)">
  <span></span>
  <span></span>
  <span></span>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>

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
          <th id="tblheader" colspan="5"><h2>ALL COURSES</h2></th>
        </tr>
        <tr>
          <th>Course Name</th>
          <th>Course Code</th>
          <th>Credit</th>
          <th>Theory/Lab</th>
          <th>Semester</th>
        </tr>
        <?php if($result)
        foreach($result as $row): ?>
            <tr>
            <td><?php echo "<a href='view_attendance.php?coursecode=".$row['coursecode']."&semester=".$row['semester']."'>".$row['coursename']."</a>" ?></td>
            <td><?php echo $row['coursecode']; ?></td>
            <td><?php echo $row['credit']; ?></td>
            <td><?php echo $row['labtheory'] ?></td>
            <td><?php echo $row['semester'] ?></td>

          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    </div>
  </div>
</div>
        <footer class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </footer>

    </body>


</html>

<script>
$(document).ready(function(){
 
 $('#semestername').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"index.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>