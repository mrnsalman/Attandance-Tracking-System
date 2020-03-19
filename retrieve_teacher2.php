<!DOCTYPE html>
<html>
    
    <head>
        <title>RMS Dashboard</title>
        <link rel="stylesheet" type="text/css" href="style6.css">
    </head>
    
    <body>
<?php
session_start();
if(isset($_SESSION['sess_user'])){
$user = $_SESSION['sess_user'];
$dbname=$_SESSION['sess_db'];   
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


echo "<center>";
echo "<table border='1'>";
echo "<tr>";
echo "<th><font size=\"5\" color=\"white\">Student Name<font></th>";
echo "<th><font size=\"5\" color=\"white\">Student Id<font></th>";
echo "<th><font size=\"5\" color=\"white\">Class Conducted<font></th>";
echo "<th><font size=\"5\" color=\"white\">Class Attended<font></th>";
echo "<th><font size=\"5\" color=\"white\">Parcentage<font></th>";
echo "<th><font size=\"5\" color=\"white\">Zone<font></th>";
echo "<th><font size=\"5\" color=\"white\">Mark Attendance<font></th>";
echo "</tr>";

echo '<form action="update.php" method="post">';
while($row = mysqli_fetch_array($result))
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
  $d = "";
  echo "<tr>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['studentname'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['studentid'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['class_conducted'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $row['class_attended'] . "<font></td>";
  echo "<td align='center'><font size=\"4\" color=\"white\">" . $c . "<font></td>";
  if ($c>=80) echo "<td align='center' bgcolor=\"green\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  elseif ($c>=75 ) echo "<td align='center' bgcolor=\"orange\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  else echo "<td align='center' bgcolor=\"red\"><font size=\"4\" color=\"white\">" . $d . "</font></td>";
  echo "<td align='center'><input type='checkbox' name='cb[]' value=". $row['studentid'] ." /></td>";
  echo "</tr>";
  }
echo "<tr>";
echo "<td align='center'><input type='submit' name='update' value='Update'/></td>";
echo "</tr>";
echo "</table>";
echo "</center>";
echo "</form>";

echo '<form action="change.php" method="post" >';
echo "<input type='text' name='username' value='$myusername' hidden readonly/>";
echo "<p align='center' ><input type='submit' name='back' value='Change Subject'></p>";
echo '</form>';

mysqli_close($con);
?>
</body>
</html>
