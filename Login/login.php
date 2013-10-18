<?php
require_once 'config.php';

if($_SESSION['username'])
{
	header("location: Home.php");
	
	exit;
}
if(isset($_REQUEST['submit']))
{
	$do_login = true;
	include_once 'do_login.php';
}
?>
<!DOCTYPE HTML>
<HTML>
	<head>
		<title>7Above Login </title>
		<link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css" />
		
	</head>
	<body>
	<p class="t1" >7Above Client Portal Login</p>
	<form name="login" method="post" action="login.php" class="center">
		<div>
		UserName:<input type="text" name="username">		
		</div>
		<div>
		Password: <input type="password" name="password">
		</div>
		<div>
		<input type="submit" name="submit" value="Login">
		</div>
	</form>
	</body>
</HTML>