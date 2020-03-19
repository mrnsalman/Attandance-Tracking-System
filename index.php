<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "rmsdb");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "
 SELECT * FROM course WHERE coursename LIKE '%".$request."%'
";

$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["coursename"];
 }
 echo json_encode($data);
}

?>