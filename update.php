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

if($_POST['submit']){
  if(empty($_POST['cb'])){
echo "heer";
$query="UPDATE $table SET class_conducted=class_conducted+1";
mysqli_query($con, $query) or die ('Error Updating the Database' . mysqli_errno());
}
else {
$cb = $_POST['cb'];

#mysql_select_db("students", $con);
$query="UPDATE $table SET class_conducted=class_conducted+1";
mysqli_query($con, $query) or die ('Error Updating the Database' . mysqli_errno());


foreach($cb as $value)
{ 
  $query="UPDATE $table SET class_attended=class_attended+1 WHERE studentid='$value'";
  mysqli_query($con, $query) or die ('Error Updating the Database' . mysql_errno());
}

}
}
header("Location:view_attendance.php?coursecode=$code&semester=$semester");
?>