<?php
include '../Login/connect.php';

$con = new mysqli($server,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL1: (" . $con->connect_errno . ") " . $con->connect_error;
}

/*$user="";
$passw="";
$firstname="";
$lastname="";
$email="";

if(isset($_REQUEST['city']))
{
	$c= $_REQUEST['city'];
	$c = explode(",",$c);
	//var_dump($emails);
	//var_dump($email);
}*/

$query = "SELECT DISTINCT city, metrocode FROM geo_location WHERE CITY <>'' AND metrocode<>''";
				
	
$res = $con->query($query) or die("SQL Error getMetrobyCity: " . mysqli_error($con));
			
			while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
				 $result[] = array(
				  'city'=>$row['city'],
				  'metrocode'=>$row['metrocode']);
			 }
			  
			
	   // var_dump($result);
		header("Content-type: application/json");
		echo json_encode($result,JSON_PRETTY_PRINT);
		$error = json_last_error();
		

//$con->close();

//otherDB($email);
//echo ("<SCRIPT LANGUAGE='JavaScript'>
//    window.alert('Succesfully Updated');
//    </SCRIPT>");


//header("Location: region.html");

exit;
?>