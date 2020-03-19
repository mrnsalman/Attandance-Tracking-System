<!DOCTYPE html>
<html>
    
    <head>
        <title>RMS Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    
    <body>
        <?php
        require 'db.php';
        session_start();
        $user= $_SESSION['sess_user'];
        
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
            <div class="menusection">
                <div class="menuhead">
                    <p>Menu</p>
                </div>
                <div class="menuoption">
                    <ul>
                    <li><a href="viewprofile.html">View Profile</a></li>
                    <li><a href="viewprofile.html">Edit Profile</a></li>
                    <li><a href="ChangePass.html">Change Password</a></li>
                    <li><a href="Login.html">Logout</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="dashsection">
                <div class="dashhead"><marquee>Routine Management</marquee></div>
                <div class="DashContent">
                 <div class="Dashmenu"><a href="RoutineManagment.html">View</a></div>
                    <div class="Dashmenu"><a href="CourseManagement.html">Create</a></div>
                    <div class="Dashmenu"><a href="TeacherManagement.html">Update</a></div>
                    <div class="Dashmenu"><a href="StudentManagement.html">Delete</a></div>
                </div>
            </div>
        </div>
        <div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>

    </body>


</html>