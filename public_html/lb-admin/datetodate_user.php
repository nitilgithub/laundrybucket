<?php
include 'header.php';
?>
<?php
$fdate="";
$sdate="";

if(isset($_POST['sub']))
{
	$fdate=$_POST['f_date'];
	
	$sdate=$_POST['s_date'];
	$type=$_POST['type'];
	
	$url="webservice_searchdatetodateusers.php?fdate=".$fdate."&sdate=".$sdate;
}
else {
	$fdate=date("m/d/Y", strtotime("-1 months"));
	$sdate=date("m/d/Y");
	$url="webservice_searchdatetodateusers.php?fdate=".$fdate."&sdate=".$sdate;
}


 ?>
<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
	
  <script type="text/javascript">
                        $(document).ready(function () {
                            $('.datepicker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4",
                                 //showDropdowns: true
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>
   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Filter Users &amp; Export Excel</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
                     <div class="row"> 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel fixed_height_320" style="background-color:#565252;height: auto">
                                <div class="x_title panel-heading" style="color:white">
                                    <h2>Date To Date Excel of Users &nbsp;</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    	<li>&nbsp; &nbsp;&nbsp; </li>
                                        
                                         <li>&nbsp; &nbsp; &nbsp;</li>
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content table-responsive">
                                	
								<form method="post" class="form-inline"> <!--action="phpexcel/datetodate.php"-->
									 <div class="form-group">
									 	<label for="from date"> <span style="color:white"> From Date:</span>
             						<input type="text"  name="f_date" value="<?php echo $fdate; ?>" class="form-control datepicker"  placeholder="Select First Date">
               						</div>
               						&nbsp; &nbsp;
  									 <div class="form-group">
  									 	<label for="to date"> <span style="color:white"> To Date:</span>
             						<input type="text"  name="s_date" value="<?php echo $sdate; ?>" class="form-control datepicker"  placeholder="Select Second Date">
               						</div>
               						&nbsp;&nbsp;
               						
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Search Now" name="sub">
									</div>
								</form>
                                </div>
                            </div>
                        </div> 
                       </div>
   
    <div class="row">   
						 <div class="fixed-table-toolbar">
                         	<form method="post" action="phpexceldownload/datetodate_userexcel.php" >
                         	<input type="hidden" name="fdate" value="<?php echo $fdate ?>" />
                         	<input type="hidden" name="sdate" value="<?php echo $sdate ?>" />
                         	
                            <button id="exportButton" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>
                      	</form>
  
					
					
						<table data-toggle="table" id="exportTable" data-url="<?php echo $url;?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
    <caption>  <h2 style="color:black"> Records for <?php echo date("F",strtotime($fdate));?> <?php if(date("F",strtotime($fdate))!=date("F",strtotime($sdate))) { echo "-". date("F",strtotime($sdate)); } ?> Month </h2>  </caption>
    <thead>
    <tr>
        <th data-field="id" data-align="left" data-sortable="true">ID</th>
       
          <th data-field="name" data-align="left" class="text-capitalize">Name</th>
          <th data-field="email" data-align="center">Email</th>
          <th data-field="mobile" data-align="left">Mobile</th>
          <th data-field="address" data-align="left">Address</th>
          <th data-field="regdate">Reg Date</th>
          <th data-field="usertype" data-align="left">User Type</th>
          <th data-field="totaldeliverorder" data-align="left">Total Delivered<br> Orders</th>
           <th data-field="totalbusiness" data-align="left">Total Business</th>
          <th data-field="wallet" data-align="left">Wallet Amount</th>
          <th data-field="reference" data-align="left">Sales Channel</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

                                </div>
</div></div>

</div>
<?php include 'footer.php'; ?>
