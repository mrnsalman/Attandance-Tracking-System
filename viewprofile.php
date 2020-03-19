<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="stylesheet" type="text/css" href="style4.css">
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
    
        }
        else {
            header("Location: Login-error.php?message=You must be logged in first!!");
        }
        $con = mysqli_connect("localhost","root","","rmsdb");
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
        ?>
        <div class="headsection">
                <div class="logo">
                <a href="Home.php">   
                <img src="image/bu-logo.png" alt="Logo" width="200" height="100"></a>
            </div>
            <div class="welcome"><marquee>Welcome, <?php echo $user?></marquee></div>
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
            <div class="dashsection">
                <div class="dashhead"><marquee>VIEW PROFILE</marquee></div>
                <div class="DashContent">
                 <div class="image">
                    <a href= '<?php echo $picture?>'><img src="<?php echo $picture?>" height = '300' width = '300'/></a>
                     </div>
                    <div class="detail">
                        <table>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo $firstname," ", $lastname?></td>
                        </tr>
                        <tr>
                            <th>Email:</th><td><?php echo $email?></td>
                        </tr>
                        <tr>
                        <th>Department:</th>
                        <td><?php echo $department?></td>
                        </tr>
                        <tr>
                        <th>Designation:</th>
                        <td><?php echo $designation?></td>
                        </tr>
                        <tr>
                        <th>Phone:</th><td><?php echo $phone?></td>
                        </tr>
                            </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer">
        <p>&copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved</p>
        </div>

    </body>


</html>