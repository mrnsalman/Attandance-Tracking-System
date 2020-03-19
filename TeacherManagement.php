<!DOCTYPE html>
<html>
    
    <head>
        <title>RMS Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    
    <body>
        <?php
        require 'db.php';
        
        ?>
        <div class="headsection">
                <div class="logo">
                <a href="Home.php">   
                <img src="image/bu-logo.png" alt="Logo" width="200" height="100"></a>
            </div>
            <div class="welcome"><marquee><a>Welcome, <?php echo $user?></a></marquee></div>
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
                    <li><a href="viewprofile.php">View Profile</a></li>
                    <li><a href="viewprofile.php">Edit Profile</a></li>
                    <li><a href="ChangePass.php">Change Password</a></li>
                    <li><a href="Login.php">Logout</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="dashsection">
                <div class="dashhead"><marquee>Teacher Management</marquee></div>
                <div class="DashContent">
                 <div class="Dashmenu"><a href="teacher_list.php">View</a></div>
                    <div class="Dashmenu"><a href="teacher_create.php">Add</a></div>
                    <div class="Dashmenu"><a href="teacher_edit_page.php">Update</a></div>
                    <div class="Dashmenu"><a href="teacher_delete_page.php">Delete</a></div>
                </div>
            </div>
        </div>
        <div class="footer">
        &copy; 2017 Copyright by <a href="http://bu.edu.bd/">Bangladesh University</a> All right reserved
        </div>

    </body>


</html>