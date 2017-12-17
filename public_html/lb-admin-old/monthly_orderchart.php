<?php
include 'header.php';
?>
 
  <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
$(function()
{
     var latestmonth=$("#ddmonth").val();
   	   //alert(latestmonth);
   	   
    // Load the Visualization API and the piechart package.
    google.charts.load("current", {packages: ["bar"]});  
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
   
   //Function for drawing chart on page laoad for dryclean type order  
    function drawChart() {
    	//alert(latestmonth);
      var jsonData = $.ajax({
          url: "https://laundrybucket.co.in/lb-admin/webservice_monthly_orderchart.php?ref=Dryclean&month="+latestmonth,
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 300});
    }
    
    
    //Function for drawing chart on page laoad for laundry type order
     google.charts.setOnLoadCallback(drawChartlaundry);
      
    function drawChartlaundry() {
    	//alert(latestmonth);
      var jsonData = $.ajax({
          url: "https://laundrybucket.co.in/lb-admin/webservice_monthly_orderchart.php?ref=Laundry&month="+latestmonth,
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_divlaundry'));
      chart.draw(data, {width: 600, height: 300});
    }
 
 //we are defining same function drawchart() again awith different name to remove the problem of error-
 // Uncaught Error: google.charts.load() cannot be called more than once with version 44 or earlier.
   
   //function for drawing chart on change of month type for dryclean type order
      function drawChartdryclean2(mon) {
      	//alert("caaled 2 - https://new.laundrybucket.co.in/admin/webservice_monthly_orderchart.php?month="+mon);
      var jsonData = $.ajax({
          url: "https://laundrybucket.co.in/lb-admin/webservice_monthly_orderchart.php?ref=Dryclean&month="+mon,
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 300});
    }
    
    
    //function for drawing chart on change of month type for Laundry type order
     function drawChartlaundry2(mon) {
      	//alert("caaled 2 - https://new.laundrybucket.co.in/admin/webservice_monthly_orderchart.php?month="+mon);
      var jsonData = $.ajax({
          url: "https://laundrybucket.co.in/lb-admin/webservice_monthly_orderchart.php?ref=Laundry&month="+mon,
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_divlaundry'));
      chart.draw(data, {width: 600, height: 300});
    }
    
    
    //Code for calling function on change of month type from drop downlist
     $(document).on("change","#ddmonth",function()
   {
   	   var mon=$(this).val();
   	  // alert(mon);
   	   
   	   drawChartdryclean2(mon); //On change this function draw chart for dryclean type order
   	   
   	   drawChartlaundry2(mon); //On change this function draw chart for Laundry type order
   	  
   });
   
    });
    </script>
    
    <script>
  
    
 
  
   
   
 
    </script>


   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order Summery Chart</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Monthly Orders </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                               
                              <div class="col-md-6"> 	
				<form method="post">
				<div class="form-group">
					<select class="form-control" id="ddmonth" name="monthtype">
						<option value=""> Select Month </option>
						<?php
						$result=mysql_query("select distinct monthname(OrderDate) as monthtype from tbl_orders order by OrderDate desc")or die(mysql_error());
						
							$totalcount=mysql_num_rows($result);/*Total count form October to May is 12 */
							$count=mysql_num_rows($result);
						if($count>0)
						{
							while($row=mysql_fetch_array($result))
							{
								?>
								<option style="padding: 10px"  value="<?php echo $row["monthtype"]; ?>" <?php if($count==$totalcount) echo 'Selected' ?>> <?php echo $row["monthtype"]; ?> </option>
								<?php
								$count--;
							}
						}
						?>
						</select>
					</div>

                  </form>    
                  </div>
<!--                              <div id="columnchart_material" style="width: 900px; height: 500px;"></div>-->
                                   
                        <div class="row">
                        	<div class="col-md-12">
                        		&nbsp;
                        		</div>
                        		<div class="col-md-12">
                        		&nbsp;
                        		</div>
                        		<div class="col-md-12">
                        		&nbsp;
                        		</div>
                        	</div>
                        
                        
                        <div class="row">
                        
                        	<div class="col-md-12">
                           <div id="chart_div"></div>
   							</div>
   							
   							<div class="col-md-12">
   								&nbsp;
   								</div>
   						
   							<div class="col-md-12">
   								&nbsp;
   								</div>
   						
   							<div class="col-md-12">
   								&nbsp;
   								</div>
   								
   							
   							<div class="col-md-12">
                        <div id="chart_divlaundry"></div>
   							</div>
   							
   							</div>
                                   
                                   
                                  
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
