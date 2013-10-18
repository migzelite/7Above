<?php

include '../Login/connect.php';

$con = new mysqli($server ,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
$query = "SELECT e.email,sd.subscribe_date, s.source_ip, s.source_url FROM email e
		INNER JOIN subscribedDate sd on sd.email_id = e.id 
		INNER JOIN source s on s.email_id = e.id";


$res = $con->query($query) or die("SQL Error 6: " . mysqli_error($con));
	
while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
	$result[] = array(
			'email'=>$row['email'],
			'subscribe_date'=>$row['subscribe_date'],
			'source_ip'=>$row['source_ip'],
			'source_url'=>$row['source_url']);
}
	
	
//var_dump($result);
header("Content-type: application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
$error = json_last_error();

?>