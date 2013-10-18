<?php

include '../Login/connect.php';

$con = new mysqli($server ,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
$query = "SELECT md5(e.email) FROM email e
			INNER JOIN opener_clicker oc on oc.email_id = e.id
			WHERE oc.event = 'click' order by oc.timestamp DESC limit 50000";


$res = $con->query($query) or die("SQL Error clickerMD5: " . mysqli_error($con));
$result = array();
	
while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
	$result[] = array(
			'email'=>$row['email']);
}
	
	
//var_dump($result);
header("Content-type: application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
$error = json_last_error();

?>