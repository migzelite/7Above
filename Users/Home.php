<?php
include 'config.php';
include 'users.php';
include 'MenuBar.html';
include 'showfeed.php';
if(!isSet($_SESSION['username']))
{
header("Location: login.php");
exit;
}
?>
<html>
<head>
<script type="text/javascript" src="menubar.js"></script>
<script>
$(document).ready(function(){
	//create jqxPanel
	 var theme = getDemoTheme();
	$('#docking').jqxDocking({ orientation:'horizontal', width:690, mode:'docked'});
	$('#docking').jqxDocking('disableWindowResize', 'window1');

</script> 
</head>
<body>
<div>
	<div id='jqxMenu'>       
	<div id="window1" style="height: 220px">
    <div>
    News
    </div>
    <div style="padding: 3px; margin: 10px; width: 150px; height: 84px; float: left;">
    <script type="text/javascript" src="http://feed.informer.com/widgets/SPIXLHXCLU.js"></script>
    <noscript><a href="http://feed.informer.com/widgets/SPIXLHXCLU.html">"newsDock"</a>
    Powered by <a href="http://feed.informer.com/">RSS Feed Informer</a></noscript>
  	</div>
    </div>
    </div>
</div> 
</body>
</html>


