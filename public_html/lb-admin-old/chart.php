<html>
	<head>
	<!-- Font Awesome Icons -->
    <!-- Morris charts -->
    <!-- Font Awesome Icons -->
    <!-- Morris charts -->
    <link href="chart/morris.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
   </head>
	<BODY>
		
		<div class="col-md-6">
              <!-- LINE CHART -->

              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Bar Chart</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->
  <script src="chart/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <!-- Morris.js charts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
   
    <script src="chart/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='chart/plugins/fastclick/fastclick.min.js'></script>
 <script type="text/javascript">
      $(function () {
        "use strict";
 //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: '2006', a: 100},
            {y: '2007', a: 75},
            {y: '2008', a: 50},
            {y: '2009', a: 75},
            {y: '2010', a: 50},
            {y: '2011', a: 75},
            {y: '2012', a: 100}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['DISK'],
          hideHover: 'auto'
        });
      });
    </script>		
	</BODY>

</html>