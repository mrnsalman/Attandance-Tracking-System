<?php
class connect {
  session_start();
  if(isset($_SESSION['sess_user'])){
  $user = $_SESSION['sess_user'];
  $dbname = $_SESSION['sess_db'];

  }
  else {
    header("Location: Login-error.php?message=You must be logged in first!!");
  }
  public $host="localhost"; // Host name
  public $username="root"; // Mysql username
  public $password=""; // Mysql password
  public $db_name="$dbname"; // Database name
  
  // Connect to server and select databse.
  public function construct(){
  $con = mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect");
  if (!$con)
    {
    die('Could not connect: ' . mysqli_error($con));
    }
}
}

?>