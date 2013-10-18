   $(document).ready(function () {

                  var theme = getDemoTheme();
                  

				var data1;
				$.ajax({ url: '../Login/menu.php', async: false, success: function(data) { data1 = JSON.stringify(data); } }); 
                var source =
                {
                    datatype: 'json',
                    datafields: [
                        { name: 'id' },
                        { name: 'parentid' },
                        { name: 'text' },
                        { name: 'subMenuWidth'},
                        { name: 'href'}
                    ],
                    id: 'id',
                   	localdata: data1
                   // url:'menu.php'
                };
              //  alert(source);                        
                // create data adapter.
                var dataAdapter = new $.jqx.dataAdapter(source);
                
                // perform Data Binding.
               dataAdapter.dataBind();
                // get the menu items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents 
                // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter 
                // specifies the mapping between the 'text' and 'label' fields.  
                var records = dataAdapter.getRecordsHierarchy('id', 'parentid', 'items', [{ name: 'text', map: 'label'}]);
               //alert(records);
                $('#jqxMenu').jqxMenu({ source: records,width: '100%', height: '30px',  theme: 'blakes_theme' });
            	// centers items
                
              var centerItems = function () {
                    var firstItem = $($("#jqxMenu ul:first").children()[0]);
                    firstItem.css('margin-left', 0);
                    var width = 0;
                    var borderOffset = 2;
                    $.each($("#jqxMenu ul:first").children(), function () {
                        width += $(this).outerWidth(true) + borderOffset;
                    });
                    var menuWidth = $("#jqxMenu").outerWidth();
                    firstItem.css('margin-left', (menuWidth / 2 ) - (width / 2));
                }
                centerItems();
                $(window).resize(function () {
                    centerItems();
                });
                
                $("#jqxMenu").on('itemclick', function (event) {
                	href = dataAdapter.recordids[event.args.id].href;
         		   if (href!=undefined) 	window.open(href, '_self' );
                         
                   });
            });