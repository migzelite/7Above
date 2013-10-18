<?php

include '../Login/connect.php';

$con = new mysqli($server ,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
$query = "SELECT DISTINCT source_url,COUNT(id) as sCount FROM BMI.source GROUP BY source_url";


$res = $con->query($query) or die("SQL Error getUserCount by url: " . mysqli_error($con));
	
while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
	$result[] = array(
			'source_url'=>$row['source_url'],
			'count'=>$row['sCount']);
}
	
	
//var_dump($result);
header("Content-type: application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
$error = json_last_error();

?>