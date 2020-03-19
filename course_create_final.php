<!DOCTYPE html>
<html>
    
    <head>
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

// initializing variables
$coursename = "";
$coursecode = "";
$dayeve = "";
$credit = "";
$labtheory = "";
$errors = array();
$message = '';
$name = '';

// connect to the database
$db = mysqli_connect('localhost', 'root', '', $dbname);
if (!$db)
  {
  die('Could not connect: ' . mysqli_connect_error());
  }
// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $coursenamepre = mysqli_real_escape_string($db, $_POST['coursename']);
  $coursecodepre = mysqli_real_escape_string($db, $_POST['coursecode']);
  $dayeve = mysqli_real_escape_string($db, $_POST['dayeve']);
  $credit = mysqli_real_escape_string($db, $_POST['credit']);
  $labtheory = mysqli_real_escape_string($db, $_POST['labtheory']);
  $semester = mysqli_real_escape_string($db, $_POST['semester']);
  $name = $coursecodepre . $dayeve . $semester;
  $coursename = $coursenamepre . '(' . $dayeve . ')';
  $coursecode = $coursecodepre . $dayeve;
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($coursenamepre)) { array_push($errors, "Coursename is required");}
  if (empty($coursecodepre)) { array_push($errors, "Coursecode is required"); }
  if (empty($dayeve)) { array_push($errors, "Day/Evening is required"); }
  if (empty($credit)) { array_push($errors, "Credit is required"); }    
  if (empty($labtheory)) { array_push($errors, "Lab/Theory is required"); }
  if (empty($semester)) { array_push($errors, "Semester is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM $semester WHERE coursename='$coursename' OR coursecode='$coursecode' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  if ($result) {
  	$user = mysqli_fetch_assoc($result);
  
  
  
    if ($user['coursecode'] === $coursecode) {
      array_push($errors, "Course already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$query3 = "CREATE TABLE $semester(
    coursename varchar(50),
    coursecode varchar(50) PRIMARY KEY,
    credit int(11) NOT NULL,
    labtheory varchar(20) NOT NULL,
    semester varchar(50) NOT NULL)";
    $result3 = mysqli_query($db, $query3);
    $query = "INSERT INTO $semester (coursename, coursecode, credit, labtheory, semester) VALUES('$coursename', '$coursecode', '$credit', '$labtheory', '$semester')";
  	$result=mysqli_query($db, $query);
    $query1 = "DROP TABLE IF EXISTS $name";
    $result1 = mysqli_query($db, $query1);
    $query2 = "CREATE TABLE $name(
    studentname varchar(50),
    studentid varchar(50) PRIMARY KEY,
    class_conducted int(11) NOT NULL,
    class_attended int(11) NOT NULL)";
    $result2=mysqli_query($db, $query2);
    $query4 = "INSERT INTO semester (semestername) VALUES('$semester')";
    $result4 = mysqli_query($db, $query4);
      if($result && $result2){
         $message = 'Course added successfully';
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
          <<div id="sidebar">
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
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add a course</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissable fade show">
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
          <?= $message; ?>
        </div>
      <?php endif; ?>
<?php include ('errors.php'); ?>
      <form method="post" action="course_create_final.php">
  <datalist id="courses">
  <option value="Introduction of computer Science">
<option value="Analog Electronics">
<option value="Analog Electronics (Lab)">
<option value="C Programming">
<option value="C Programming Lab">
<option value="Digital Logic">
<option value="Digital Logic (Lab)">
<option value="Physics">
<option value="Physics (lab)">
<option value="Electronic Device & Circuit">
<option value="Electronic Device & Circuit (Lab)">
<option value="C++ Programming">
<option value="C++ Programming (Lab)">
<option value="Java Programming">
<option value="Java Programming Lab">
<option value="Data Structure">
<option value="Data Structure (Lab)">
<option value="Algorithm (Lab)">
<option value="Microprocessor & Assembly Language">
<option value="Microprocessor & Assembly Language (Lab)">
<option value="Theory of Computation">
<option value="Data Communication">
<option value="Electrical Drives and Instrumentation">
<option value="Electrical Drives and Instrumentation (Lab)">
<option value="Web Programming">
<option value="Database System">
<option value="Database System (Lab)">
<option value="Operating System">
<option value="Operating System (Lab)">
<option value="VLSI Design">
<option value="Compiler Design">
<option value="Compiler Design (Lab)">
<option value="Digital System Design">
<option value="Digital System Design (Lab)">
<option value="Digital Electronics & Pulse Technique">
<option value="Software Engineering">
<option value="Pattern Recognition">
<option value="Pattern Recognition (Lab)">
<option value="Computer Network">
<option value="Computer Network (Lab)">
<option value="E-Commerce">
<option value="Numerical Method">
<option value="Artificial Intelligence">
<option value="Artificial Intelligence (Lab)">
<option value="Managment Information System">
<option value="Computer Graphics">
<option value="Computer Graphics (Lab)">
<option value="System Analysis & Design">
<option value="System Analysis & Design (Lab)">
<option value="System Programming">
<option value="Peripheral and Interfacing">
<option value="Computer Organization & Architecture">
  </datalist>
        <div class="form-group">
          <label for="coursename">Course Name</label>
          <input type="text" name="coursename" id="coursename" autocomplete="off" class="form-control" list="courses">
        </div>
        <div class="form-group">
          <label for="coursename">Course Code</label>
          <input type="text" name="coursecode" id="coursecode" class="form-control">
        </div>
        <div class="form-group">
          <label for="dayeve">Day/Evening</label>
          <select type="text" name="dayeve" id="dayeve" class="form-control">
            <option value="Day" selected>Day</option>
            <option value="Eve">Eve</option>
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
          <label for="credit">Credit</label>
          <input type="text" name="credit" id="credit" value="3" class="form-control">
        </div>
        <div class="form-group">
          <label for="semester">Semester</label>
          <input type="text" name="semester" id="semester" class="form-control">
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

<!-- <script>
$(document).ready(function(){
 
 $('#coursename').typeahead({
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
</script> -->

<script>
  $(document).ready(function(){
    $("#coursename").change(function(){
      a=$(this).val()
      if(a=="Introduction of computer Science"){
        $("#coursecode").val("CSE111")
      }
else if(a=="Analog Electronics"){
        $("#coursecode").val("CSE112")
      }
else if(a=="Analog Electronics (Lab)"){
        $("#coursecode").val("CSE113")
      }
else if(a=="C Programming"){
        $("#coursecode").val("CSE121")
      }
else if(a=="C Programming Lab"){
        $("#coursecode").val("CSE122")
      }
else if(a=="Digital Logic"){
        $("#coursecode").val("CSE123")
      }
else if(a=="Digital Logic (Lab)"){
        $("#coursecode").val("CSE124")
      }
else if(a=="Physics"){
        $("#coursecode").val("CSE131")
      }
else if(a=="Physics (lab)"){
        $("#coursecode").val("CSE132")
      }
else if(a=="Electronic Device & Circuit"){
        $("#coursecode").val("CSE133")
      }
else if(a=="Electronic Device & Circuit (Lab)"){
        $("#coursecode").val("CSE134")
      }
else if(a=="C++ Programming"){
        $("#coursecode").val("CSE135")
      }
else if(a=="C++ Programming (Lab)"){
        $("#coursecode").val("CSE136")
      }
else if(a=="Java Programming"){
        $("#coursecode").val("CSE211")
      }
else if(a=="Java Programming Lab"){
        $("#coursecode").val("CSE212")
      }
else if(a=="Data Structure"){
        $("#coursecode").val("CSE213")
      }
else if(a=="Data Structure (Lab)"){
        $("#coursecode").val("CSE214")
      }
else if(a=="Algorithm (Lab)"){
        $("#coursecode").val("CSE222")
      }
else if(a=="Microprocessor & Assembly Language"){
        $("#coursecode").val("CSE223")
      }
else if(a=="Microprocessor & Assembly Language (Lab)"){
        $("#coursecode").val("CSE224")
      }
else if(a=="Theory of Computation"){
        $("#coursecode").val("CSE231")
      }
else if(a=="Data Communication"){
        $("#coursecode").val("CSE232")
      }
else if(a=="Electrical Drives and Instrumentation"){
        $("#coursecode").val("CSE233")
      }
else if(a=="Electrical Drives and Instrumentation (Lab)"){
        $("#coursecode").val("CSE234")
      }
else if(a=="Web Programming"){
        $("#coursecode").val("CSE235")
      }
else if(a=="Database System"){
        $("#coursecode").val("CSE311")
      }
else if(a=="Database System (Lab)"){
        $("#coursecode").val("CSE312")
      }
else if(a=="Operating System"){
        $("#coursecode").val("CSE313")
      }
else if(a=="Operating System (Lab)"){
        $("#coursecode").val("CSE314")
      }
else if(a=="VLSI Design"){
        $("#coursecode").val("CSE311")
      }
else if(a=="Compiler Design"){
        $("#coursecode").val("CSE321")
      }
else if(a=="Compiler Design (Lab)"){
        $("#coursecode").val("CSE322")
      }
else if(a=="Digital System Design"){
        $("#coursecode").val("CSE323")
      }
else if(a=="Digital System Design (Lab)"){
        $("#coursecode").val("CSE324")
      }
else if(a=="Digital Electronics & Pulse Technique"){
        $("#coursecode").val("CSE325")
      }
else if(a=="Software Engineering"){
        $("#coursecode").val("CSE326")
      }
else if(a=="Pattern Recognition"){
        $("#coursecode").val("CSE331")
      }
else if(a=="Pattern Recognition (Lab)"){
        $("#coursecode").val("CSE332")
      }
else if(a=="Computer Network"){
        $("#coursecode").val("CSE333")
      }
else if(a=="Computer Network (Lab)"){
        $("#coursecode").val("CSE334")
      }
else if(a=="E-Commerce"){
        $("#coursecode").val("CSE335")
      }
else if(a=="Numerical Method"){
        $("#coursecode").val("CSE336")
      }
else if(a=="Artificial Intelligence"){
        $("#coursecode").val("CSE411")
      }
else if(a=="Artificial Intelligence (Lab)"){
        $("#coursecode").val("CSE412")
      }
else if(a=="Managment Information System"){
        $("#coursecode").val("CSE413")
      }
else if(a=="Computer Graphics"){
        $("#coursecode").val("CSE421")
      }
else if(a=="Computer Graphics (Lab)"){
        $("#coursecode").val("CSE422")
      }
else if(a=="System Analysis & Design"){
        $("#coursecode").val("CSE423")
      }
else if(a=="System Analysis & Design (Lab)"){
        $("#coursecode").val("CSE424")
      }
else if(a=="System Programming"){
        $("#coursecode").val("CSE431")
      }
else if(a=="Peripheral and Interfacing"){
        $("#coursecode").val("CSE432")
      }
else if(a=="Computer Organization & Architecture"){
        $("#coursecode").val("CSE433")
      }

    })
  })
</script>

<script>
  $(document).ready(function(){
    $("#labtheory").change(function(){
      a=$(this).val()
      if(a=="Theory"){
        $("#credit").val("3")
      }
      else {
        $("#credit").val("1")
      }
    })
  })
</script>

