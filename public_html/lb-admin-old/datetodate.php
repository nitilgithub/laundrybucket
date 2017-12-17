<?php
include 'header.php';
?>
<?php
$fdate="";
$sdate="";
$type='laundry';
if(isset($_POST['sub']))
{
	$fdate=mysql_real_escape_string($_POST['f_date']);
	
	$sdate=mysql_real_escape_string($_POST['s_date']);
	$type=mysql_real_escape_string($_POST['type']);
	
	$url="webservice_searchdatetodateorders.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
}
else {
	$fdate=date("m/d/Y", strtotime("-1 months"));
	$sdate=date("m/d/Y");
	$url="webservice_searchdatetodateorders.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
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
                            <h3>Filter Orders & Export Excel</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
                     <div class="row"> 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel fixed_height_320" style="background-color:#565252;height: auto">
                                <div class="x_title panel-heading" style="color:white">
                                    <h2>Date To Date Excel &nbsp;</h2>
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
               						 	<label for="order_type"><span style="color:white"> Order Type:</span> 
             						<select  name="type"  class="form-control" >
             						<option value="laundry">Laundry</option>
             						<option value="dryclean">Dryclean</option>
             						<option value="all">All</option>
             						</select>
               						</div>
  								
  									&nbsp; &nbsp; &nbsp;
  								
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
                         	<form method="post" action="phpexceldownload/datetodate.php" >
                         	<input type="hidden" name="fdate" value="<?php echo $fdate ?>" />
                         	<input type="hidden" name="sdate" value="<?php echo $sdate ?>" />
                         	<input type="hidden" name="type" value="<?php echo $type ?>" />
                            <button id="exportButton" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>
                      	</form>
  
					
					
						<table data-toggle="table" id="exportTable" data-url="<?php echo $url;?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
    <caption>  <h2 style="color:black"> Records for <?php echo date("F",strtotime($fdate));?> <?php if(date("F",strtotime($fdate))!=date("F",strtotime($sdate))) { echo "-". date("F",strtotime($sdate)); } ?> Month </h2>  </caption>
    <thead>
    <tr>
        <th data-field="order_id" data-align="left" data-sortable="true">ID</th>
          <th data-field="OrderReceiptId" data-align="center">OrderReceipt Id</th>
          <th data-field="order_type" data-align="center">Order Type</th>
          <th data-field="OrderSubType" data-align="center">Order SubType</th>
          <th data-field="OrderUserId" data-align="center">Order UserId</th>
          <th data-field="User_Subsid" data-align="center">User_Subsid</th>
          <th data-field="OrderTotalAmount" data-align="center">Order Total Amount</th>
          <th data-field="OrderTotalWeight" data-align="center">Order Total Weight</th>
          <th data-field="order_shipname" data-align="center">Order Ship Name</th>
          <th data-field="order_shipaddress" data-align="center">Order Ship Address</th>
          <th data-field="delivery_address" data-align="center">Delivery Address</th>
          <th data-field="OrderCity" data-align="center">Order City</th>
          <th data-field="OrderState" data-align="center">Order State</th>
          <th data-field="OrderZip" data-align="center">Order Zip</th>
          <th data-field="OrderCountry" data-align="center">Order Country</th>
          <th data-field="order_phone" data-align="center">Order Phone</th>
          <th data-field="OrderFax" data-align="center">Order Fax</th>
          <th data-field="OrderShipping" data-align="center">Order Shipping</th>
          <th data-field="order_email" data-align="center">Order Email</th>
          <th data-field="OrderDate" data-align="center">Order Date</th>
          <th data-field="order_statustext" data-align="center">OrderStatus Id</th>  
          <th data-field="OrderTrackingNumber" data-align="center">Order Tracking Number</th>
          <th data-field="OrderCustReceiptCopy" data-align="center">OrderCustReceipt Copy</th>
          <th data-field="OrderDeliveryType" data-align="center">Order Delivery Type</th>
          <th data-field="pickupdate" data-align="center">Order Pickup Date</th>
          <th data-field="Order_PickTime" data-align="center">Order Pick Time</th>
          <th data-field="Review" data-align="center">Review</th>                     <th data-field="Order_Via" data-align="center">Order Via</th>
          <th data-field="walletdeduction_amt" data-align="center">Walletdeduction Amt</th>
          <th data-field="CreatedBy" data-align="center">Created By</th>
          <th data-field="RiderId" data-align="center">Rider</th>
          <th data-field="delivery_date" data-align="center">Delivery Date</th>
          <th data-field="discount" data-align="center">Discount</th>
          <th data-field="tax" data-align="center">Tax</th>
          <th data-field="PaidAmount" data-align="center">Paid Amount</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

                                </div>
</div></div>

</div>
<?php include 'footer.php'; ?>
