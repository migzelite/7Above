<?php
include '../Login/connect.php';

$con = new mysqli($server,$user,$pass,$db_name);
if ($con->connect_errno) {
	echo "Failed to connect to MySQL1: (" . $con->connect_errno . ") " . $con->connect_error;
}

$user="";
$passw="";
$firstname="";
$lastname="";
$email="";
if(isset($_REQUEST['metrocode']))
{
	$mc= $_REQUEST['metrocode'];
	
	var_dump($mc);
	//var_dump($email);
}

$query = "SELECT DISTINCT metrocode,region FROM geo_location WHERE metrocode <>''"; //WHERE metrocode IN('".$mc."')";
				
	
$res = $con->query($query) or die("SQL Error findMetroCode: " . mysqli_error($con));
			
			while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
				 $result[] = array(
				  'metrocode'=>$row['metrocode'],
				  'region'=>$row['region']);
			 }
			  
			
	//var_dump($result);
		header("Content-type: application/json");
		echo json_encode($result,JSON_PRETTY_PRINT);
		$error = json_last_error();
		

$con->close();

//otherDB($email);
//echo ("<SCRIPT LANGUAGE='JavaScript'>
//    window.alert('Succesfully Updated');
//    </SCRIPT>");


//header("Location: enterMetroCode.php");
//exit;
?>
