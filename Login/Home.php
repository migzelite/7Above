<?php
include 'config.php';
include 'users.php';
include '../Menu/menuBar.html';
include '../AdminSite/feed.php';
if(!isSet($_SESSION['username']))
{
header("Location: login.php");
exit;
}
?>
<html>
<head>
<link rel="stylesheet" href="../jqwidgets/styles/rss.css" type="text/css" /></link>
</head>
<body>
<div id="rssOutput"></div>
</body>
</html>


