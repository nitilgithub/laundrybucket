<?php
include 'header.php';
?>
    <link href="chart/morris.css" rel="stylesheet" type="text/css" />

 
  <!--Load the AJAX API--
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    
    google.charts.load("current", {packages: ["bar"]});  
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "https://laundrybucket.co.in/lb-admin/webservice_yearly_collectionchart.php?ref=Dryclean",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_div'));
      chart.draw(data, {width: 600, height: 300});
    }



google.charts.setOnLoadCallback(drawChart2);
      
    function drawChart2() {
      var jsonData = $.ajax({
         url: "https://laundrybucket.co.in/lb-admin/webservice_yearly_collectionchart.php?ref=Laundry",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('chart_div2'));
      chart.draw(data, {width: 600, height: 300});
    }

    </script>
-->
<?php 

$val=2017;
?>
 <?php if(isset($_POST['submit']))
 {
 	$val=mysql_real_escape_string($_POST['val']);
 }	?>

   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order Summary Chart</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Yearly Collection </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                	
				 <form method="post" >          	
				<select id="mySelect" name="val" class="form-control">
                      <option value="2017" <?php if($val==2017) echo 'selected'; ?>>2017</option>
                      <option value="2016" <?php if($val==2016) echo 'selected'; ?>>2016</option>
                      <option value="2015" <?php if($val==2015) echo 'selected'; ?>>2015</option>
                </select>
                <input type="submit"  name="submit" value="Submit" >
               </form> 
    
<!--                              <div id="columnchart_material" style="width: 900px; height: 500px;"></div>--
                                   
                               <div id="chart_div"></div> <!--Division for drawing Chart for dryclean type order--
   
                                    <br/>
                               
                                <div id="chart_div2"></div>  <!--Division for drawing Chart for Laundry type order-->
                                   
                                  
                                </div>
                                                
                                     <div class=" box-success "  >
                <div class="box-header">
                  <h3 class="box-title">Dryclean (<?php echo $val; ?>)</h3>
                </div>
                <div class="box-body chart-responsive" style="width: 900px; height: 500px;">
                  <div class="chart_div" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->       
                                            
                                         <div class=" box-success "  >
                <div class="box-header">
                  <h3 class="box-title">Laundry(<?php echo $val; ?>)</h3>
                </div>
                <div class="box-body chart-responsive" style="width: 900px; height: 500px;">
                  <div class="chart_div" id="bar-chart1" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->       

                                </div>
                                    
                            </div>
                            </div>
                            </div>
     
      <script src="chart/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <!-- Morris.js charts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="chart/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='chart/plugins/fastclick/fastclick.min.js'></script>
 <script type="text/javascript">
 $(function () {
      	 var json = (function () {
       var json = null;
       $.ajax({
           'async': false,
           'global': false,
           'url': 'https://laundrybucket.co.in/lb-admin/webservice_yearly_chart1.php?ref=Dryclean&val=<?php echo $val; ?>',
           'dataType': "json",
           'success': function (data) {
               json = data;
           }
       });

       return json;
   })
   ();
   
       
 //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: json,
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Dryclean'],
          hideHover: 'auto'
        });
        
      
         
      });
      $(function () {
      	 var json = (function () {
       var json = null;
       $.ajax({
           'async': false,
           'global': false,
           'url': 'https://laundrybucket.co.in/lb-admin/webservice_yearly_chart1.php?ref=Laundry&val=<?php echo $val; ?>',
           'dataType': "json",
           'success': function (data) {
               json = data;
           }
       });

       return json;
   })
   ();
       
 //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart1',
          resize: true,
          data: json,
          barColors: ['#f56954', '#f56954'],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Laundry'],
          hideHover: 'auto'
        });
        
      
         
      });
    </script>		
     
     <?php include 'footer.php';?>                            
