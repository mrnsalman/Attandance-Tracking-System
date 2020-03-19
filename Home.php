<!DOCTYPE html>
<html>
    
    <head>
        <title>Attendance Tracking System</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/bu-logo.png">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
    </head>
    
    <body>
<?php
        $message = '';
        session_start();
        if(isset($_SESSION['sess_user'])){
            $user=$_SESSION['sess_user'];
            $dbname=$_SESSION['sess_db'];
    
        }
        else {
            header("Location: Login-error.php?message=You must be logged in first!!");
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
            <div class="menusection">
                <div class="menuhead">
                    <p>MENU</p>
                </div>
                <div class="menuoption">
                    <ul>
                    <li><i class="fa fa-user-alt" style="color: darkred; width: 30px"></i><a href="viewprofile.php">View Profile</a></li>
                    <li><i class="fa fa-user-edit" style="color: darkred; width: 30px"></i><a href="editprofile_final.php">Edit Profile</a></li>
                    <li><i class="fa fa-key" style="color: darkred; width: 30px"></i><a href="ChangePass_final.php">Change Password</a></li>
                    <li><i class="fa fa-sign-out-alt" style="color: darkred; width: 30px"></i><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="dashsection">
                <div class="dashhead"><marquee>DASHBOARD</marquee></div>
                <div class="DashContent">
                 <div class="Dashmenu"><i class="fas fa-file fa-2x" style="color: darkred; margin-left: 65px; padding-top: 10px;padding-bottom: 10px"></i><a href="course_list.php?semester"><p>View Course</p></a></div>
                    <div class="Dashmenu"><i class="fas fa-file-medical fa-2x" style="color: darkred; margin-left: 65px; padding-top: 10px;padding-bottom: 10px"></i><a href="course_create_final.php"><p>Add Course</p></a></div>
                    <div class="Dashmenu"><i class="fas fa-edit fa-2x" style="color: darkred; margin-left: 65px; padding-top: 10px;padding-bottom: 10px"></i><a href="course_edit_page.php?semester"><p>Edit Course</p></a></div>
                    <div class="Dashmenu"><i class="fas fa-trash-alt fa-2x" style="color: darkred; margin-left: 65px; padding-top: 10px;padding-bottom: 10px"></i><a href="course_delete_page.php?semester"><p>Delete Course</p></a></div>
                </div>
            </div>
        </div>
        <div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>

    </body>


</html>