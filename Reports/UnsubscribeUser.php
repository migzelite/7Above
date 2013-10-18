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
if(isset($_REQUEST['emails']))
{
	$emails= $_REQUEST['emails'];
	$email[] = explode("\n",$emails);
	//var_dump($emails);
	//var_dump($email);
}
if(isset($_REQUEST['compType']))
{
	$compType =$_REQUEST['compType'];
	//var_dump($compType);
}

foreach($email as $key => $values)
{
	foreach($values as $value)
	{
		$value = trim($value);
		$query= "INSERT IGNORE INTO `unsubscribes` (email) VALUES ('".$value."')";
		//var_dump($query2);
		$res =$con->real_query($query);
		if (!$res)
		{
			$message  = 'Invalid query: ' . mysqli_error($con) . "\n";
			$message .= 'Whole query: ' . $query;
			die("Error  <br />email already inserted".mysqli_error($con));
		}

		$url = 'http://206.71.166.232/livefeed/index.php?email='.$value.'&list_id=65';
		//var_dump($url);
		$html = file_get_contents($url);
		//	var_dump($html);

	}

}

$con->close();

//otherDB($email);
//echo ("<SCRIPT LANGUAGE='JavaScript'>
//    window.alert('Succesfully Updated');
//    </SCRIPT>");


header("Location: unsubUser.php");
exit;
?>
