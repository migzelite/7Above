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
<html lang="en">
<head>
	

    <link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="../jqwidgets/styles/blakes_theme.css" type="text/css" />
    <script type="text/javascript" src="../scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxscrollview.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.grouping.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxgrid.export.js"></script> 
    <script type="text/javascript" src="../jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxdata.export.js"></script> 
	<script type="text/javascript" src="../jqwidgets/jqxdatetimeinput.js"></script>
	<script type="text/javascript" src="../jqwidgets/jqxcalendar.js"></script>
	<script type="text/javascript" src="../jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxdropdownlist.js"></script>
	<script type="text/javascript" src="../jqwidgets/jqxpanel.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxchart.js"></script>
 	<script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../jqwidgets/jqxdragdrop.js"></script>
    <script type="text/javascript" src="../scripts/gettheme.js"></script>
    <script type="text/javascript">
    
          $(document).ready(function() {
        	  
               var theme = getDemoTheme();
                var url = "getClickers.php";
               //prepare data
              var  source ={
                    datatype: "json",
                    type: "POST",
                    datafields:[
                    { name: 'email', type:'string'}, 
                    { nmae: 'isp', type:'string'},          
                    { name: 'subscribe_date', type: 'date', cellsformat: 'MM/dd/yyyy HH:mm' },
                    { name: 'source_ip', type:'string'  },
                    { name: 'source_url', type: 'string' },
                    { name: 'reason_code', type:'string'}],
                    url: url,
                    sortcolumn:'subscribe_date',
                    sortdirection:'desc'
                  
                };
               	//data adapter
                	var dataAdapter = new $.jqx.dataAdapter(source);//
			
                	  $("#jqxgrid").jqxGrid({ 
  	                    width: 900,
  	                    source: dataAdapter,
  	                    theme: 'blakes_theme',
  	                    showstatusbar: true,
  	                    renderstatusbar:function(statusbar){
  	  	                    //appends buttons to status bar
  	  	                    var container = $("<div style='overflow: hidden; position: relative; margin: 5px;'></div>");
                  			var reloadButton = $("<div style='float: left; margin-left: 5px;'><img style='position: relative; margin-top: 2px;' src='../jqwidgets/styles/images/refresh.png'/><span style='margin-left: 4px; position: relative; top: -3px;'>Reload</span></div>");
							container.append(reloadButton);
                  			statusbar.append(container);
                  			reloadButton.jqxButton({ theme: theme, width: 65, height: 20 });
                  		// reload grid data.
                            reloadButton.click(function (event) {
                            	 source.url = url;
            	                   dataAdapter.dataBind();
            	                            
            	                    $("#jqxgrid").jqxGrid({ source: dataAdapter});
            	                    
                            });
                          
                                
  	                    },
  	                    selectionmode: 'multiplerowsextended',
  	                    sortable:true,
  	                  	autoshowfiltericon: true,
  	                    //showfilterrow: true,
  	                    groupable: true,
  	                    filterable: true,
  	                    sortable: true,
  	                    pageable: true,
  	                    autoheight: true,
  	                    columnsresize: true,
  	                    autoshowfiltericon: true,
  	                    columns: [
  	                        { text: 'Email', datafield:'email', filtertype:'text', width:250},
  	                        { text: 'ISP', datafield: 'isp',filtertype:'text', width:100},    
  	                        { text: 'Subscribe Date', datafield: 'subscribe_date', filtertype: 'date', width: 150, cellsformat: 'MM/dd/yyyy HH:mm' },
  	                        { text: 'Source IP', datafield: 'source_ip',filtertype:'text', width: 150 },
  	                        { text: 'Source_url', datafield: 'source_url', width: 150, filtertype: 'text' },
  	                        { text: 'Reason Code',datafield:'reason_code', width:75, filtertype: 'text'}],
  	                        groups:['isp','reason_code']
  	           
  					});
               
               $('#jqxgrid').jqxDragDrop();
               
               //buttons
               $("#jqxcalendar").jqxDateTimeInput({ width: '250px', height: '25px', selectionMode: 'range',formatString: 'MM/dd/yyyy HH:mm', theme:theme });
               $("#jqxDateButton").jqxButton({theme:'blakes_theme'});
               $("#jqxDateButton").on('click',function () {
                      $('#spinner').show();

                       var selection = $('#jqxcalendar').jqxDateTimeInput('getRange');
                       if (selection.from != null) {

                           //alert("HELLO");
                           //gets the dates
                           var fromDate = (selection.from.getMonth()+1)  + '/' + selection.from.getDate() + '/' + selection.from.getFullYear() + ' ' + '00:00:00';
                           var toDate = (selection.from.getMonth()+1)  + '/' + selection.to.getDate() + '/' + selection.to.getFullYear() + ' ' + '23:59:59';
                           var data = { "start_date": fromDate, "end_date": toDate };
                           var url = 'data.php';
                           source.url = url;
                          //injects the to and from date for the request
                           source.data = data;
						  //gets the data for the updates
						  var dataAdapterDate = new $.jqx.dataAdapter(source,{async:false});
						  dataAdapterDate.dataBind();
						 var dataDate= dataAdapterDate.records;
						  var localSourceDate={
	                              datatype: 'json',
	                              datafields:[
								 	{ text: 'Email', datafield:'email', filtertype:'text', width:250},
  	                        { text: 'ISP', datafield: 'isp',filtertype:'text', width:100},    
  	                        { text: 'Subscribe Date', datafield: 'subscribe_date', filtertype: 'date', width: 150, cellsformat: 'MM/dd/yyyy HH:mm' },
  	                        { text: 'Source IP', datafield: 'source_ip',filtertype:'text', width: 150 },
  	                        { text: 'Source_url', datafield: 'source_url', width: 150, filtertype: 'text' },
  	                        { text: 'Reason Code',datafield:'reason_code', width:75, filtertype: 'text'}],
  	                        groups:['isp','reason_code'],
	                              localdata:dataDate,
	                              sortcolumn:'Date',
	                              sortdirection:'desc'
	                              
	                            
	                          };
						  var localDateAdapter = new $.jqx.dataAdapter(localSourceDate);
                           $("#jqxgrid").jqxGrid({source:localDateAdapter});
                         //  $("#jqxgrid2").jqxGrid({ source: source2 });
                           //chart data
                       }
                    });
               $("#excelExport").jqxButton({ theme: 'blakes_theme' });
               $("#csvExport").jqxButton({ theme: 'blakes_theme' });
               $("#excelExport").click(function () {
                   $("#jqxgrid").jqxGrid('exportdata', 'xls', 'jxGrid');
               });
               $("#csvExport").click(function () {
                   $("#jqxgrid").jqxGrid('exportdata', 'csv','jxGrid');
               });
      });
      
        </script>

    <style type="text/css">
        .topcorner {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>

<body class = 'default'>
  <div id ='content'>

	    <div id='jqxcalendar' ></div>
        <input type="submit" value="filter" id="jqxDateButton" />
       </div>
        <!--display Grid-->
	    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left; position: absolute; left: 50%" >
		    <div id='jqxgrid' style="position: relative; left:-50%"></div>
		    <div style='margin-top: 20px;'>
            	<div style='float: left;'>
               		 <input type="button" value="Export to Excel" id='excelExport' /> 
               		 <input type="button" value="Export to CSV" id='csvExport' /> 
           		</div>
         	</div>
         </div>
    <!--<a href="logout.php">Logout</a><br /><br />-->
</body>          
</html>