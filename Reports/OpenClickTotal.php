<?php

include '../Login/connect.php';

$con = new mysqli($server ,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
$query = "select isp,count(*) as iCount from geo_oc group by isp";


$res = $con->query($query) or die("SQL Error 7: " . mysqli_error($con));
$result=array();	
while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
	$result[] = array(
			'isp'=>$row['isp'],
			'count'=>$row['iCount']);
}
	
	
//var_dump($result);
header("Content-type: application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
$error = json_last_error();

?>