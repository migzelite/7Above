<?php
include '../Login/config.php';
include '../AdminSite/common.php';
include '../Login/users.php';
include '../Menu/menuBar.html';
//var_dump($_SESSION);
// Check if the user is logged in
//var_dump($_SESSION['valid']);
//echo cpm_stats;
$pos = strpos($_SESSION['valid'] ,Reports);
//var_dump($pos);
if( $pos === false){
	header("HTTP/1.1 404 invalid user");
	echo "invalid user";
	exit;
}
session_start();
$_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];

if(!isSet($_SESSION['username']))
{
header("Location: /PHP/Login/login.php");
exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Find REgion based on Metrocode </title>
<script type="text/javascript" src="../jqwidgets/jqxdocking.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxsplitter.js"></script>
</head>

<body>
<script type="text/javascript">
        $(document).ready(function () {
            var theme = getDemoTheme();
			  $("#sendButton").click(function () {
                var validationResult = function (isValid) {
                    if (isValid) {
                        $("#form").submit();
                    }
                }
                $('#form').jqxValidator('validate', validationResult);
            });
			  $('#docking').jqxDocking({ orientation:'horizontal', width:690, mode:'docked'});
				$('#docking').jqxDocking('disableWindowResize', 'window1'); 
			  
		});
</script>
<form class="form" id="form" method="post" action="getClickers.php" style="font-size: 13px; font-family: Verdana; width: 650px;">
<table>
<tr>
 
</tr>
<tr>
<td>ISP</td><td><input type="text" name="isp"></td></tr>
<td>
Metrocode
</td>
<td><textarea rows="6" cols="50"  name="reason_code"></textarea></td></tr>
<span> One reason code per line</span>
<td><input type = "submit" value = "Submit"></td></tr>
</table>
</form>
<div id='jqxWidget'>
        <div id="docking">
            <div>
                <div id="window1" style="height: 220px;">
				<div style="padding: 3px; margin: 10px; width: 150px; height: 84px; float: left;">
                 <noscript><a href="http://184.82.109.218/7Above/clickersGrid.html">"Export Clickers"</a>
                 </noscript>
  
</div>
</div>
</div>
</div>
</div>

</body>
</html>
