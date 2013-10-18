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
if(isset($_REQUEST['isp']))
{
	$isp= $_REQUEST['isp'];
	
	//var_dump($emails);
	//var_dump($email);
}
if(isset($_REQUEST['reason_code']))
{
	$rc= $_REQUEST['reason_code'];
	$rc = implode(",",$rc);
	//var_dump($emails);
	//var_dump($email);
}


$query = "SELECT e.email, ipe.isp,sd.subscribe_date,s.source_ip,s.source_url,d.reason_code FROM email e
			INNER JOIN subscribedDate sd on sd.email_id = e.id
			INNER JOIN source s on s.email_id = e.id
			INNER JOIN ISPperEmail ipe on ipe.email_id = e.id
			INNER JOIN demographics d on d.email_id = e.id
			WHERE ipe.isp ='AOL'";
			//WHERE  ipe.isp='".$isp."' AND d.reason_code in ('".$rc."')";
				
	
$res = $con->query($query) or die("SQL Error getClickers: " . mysqli_error($con));
			
			while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
			 {
				 $result[] = array(
				  'email'=>$row['email'],
				  'isp'=>$row['isp'],		
				  'subscribe_date'=>$row['subscribe_date'],
				  'source_ip'=>$row['source_ip'],
				  'source_url'=>$row['source_url'],
				  'reason_code'=>$row['reason_code']);
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


//header("Location: Clicker_ISP.php");
//exit;