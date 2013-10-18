<?php

include '../Login/connect.php';

$con = new mysqli($server ,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}
$query = "SELECT insert_date,publisher_id, list_id,COUNT(email_id) as eCount FROM  lists 
			group by  insert_date, publisher_id,list_id order by insert_date asc";


$res = $con->query($query) or die("SQL Error 6: " . mysqli_error($con));
	
while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
{
	$result[] = array(
			'insert_date'=>$row['insert_date'],
			'publisher_id'=>$row['publisher_id'],
			'list_id'=>$row['list_id'],
			'eCount'=>$row['eCount']);
}
	
	
//var_dump($result);
header("Content-type: application/json");
echo json_encode($result,JSON_PRETTY_PRINT);
$error = json_last_error();
//header("Location: subscriptionsbyPublisher.html");
?>