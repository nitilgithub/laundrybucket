<?php include 'header.php';?>
<?php
include '../connection.php';
include 'update_subs_status.php';
?>

<?php
$fdate="";
$sdate="";
$type='laundry';
$url="";
if(isset($_POST['sub']))
{
	$fdate=mysql_real_escape_string($_POST['f_date']);
	
	$sdate=mysql_real_escape_string($_POST['s_date']);
	$type=mysql_real_escape_string($_POST['type']);
	
	$url="webservice_searchdatetodateorders.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
	
	if(date("F",strtotime($fdate))!=date("F",strtotime($sdate))) 
	{
		 $title= date("F",strtotime($fdate))." - ". date("F",strtotime($sdate)) ;
	}
	else {
		$title=date("F",strtotime($sdate));
	} 
}
else {
	//$fdate=date("m/d/Y", strtotime("-1 months"));
	//$sdate=date("m/d/Y");
	//$url="webservice_datetodate.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
	$url="webservice_pendingdeliveries.php";
	$title="Pending Deliveries";
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

<script>


	function actionFormatter(value, row, index) {
		
		var sendmailbutton = row.order_type  === 'subscription' ? '<a href="javascript:void(0)" style="color:black" class="btnsuborderdetail btn btn-primary btn-sm" title="subscription order edit" >Edit Order</a>' : '<a class="btndetail btn btn-info  btn-sm" href="javascript:void(0)" title="edit"> Edit Order</a>';
		var viewsuborderbutton ='<a class="btnsuborder btn btn-info  btn-sm" href="javascript:void(0)" title="view"> View Order</a>';
		var payorder ='<a class="btnpayorder btn btn-info  btn-sm" href="javascript:void(0)" title="pay"> Update Payment</a>';
		var invoice ='<a class="btninvoice btn btn-primary  btn-sm" href="javascript:void(0)" title="invoice"> Invoice</a>';
		var createsuborder ='<a class="btncreatesuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="Create Suborder">Create Suborder</a>';
		var createsubssuborder ='<a class="btnsubssuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="Create Subscription Suborder">Create Subscription Suborder</a>';
    	var editsuborder='<a class="btneditsuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="Edit Suborder">Edit Suborder</a>';
    	var viewsuborder='<a class="btnviewsuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="View Suborder">View Suborder</a>';
    return [
        
        sendmailbutton,
        viewsuborderbutton,
       editsuborder,
       viewsuborder,
        payorder,
        invoice,
        
         '<a class="btncancel btn btn-danger btn-sm" href="javascript:void(0)"  title="Cancel Order">', ' ',
        'Cancel order',
        '</a>'
       
    ].join('');
}





window.actionEvents = {
    'click .btndetail': function (e, value, row, index) {
    	
  		 window.location.href="place_order.php?oid="+row.order_id+"&edit=1";
  		
    },
    'click .btnsuborder': function (e, value, row, index) {
    	
  		 window.location.href="suborder_dashboard.php?oid="+row.order_id;
  		
    },
    'click .btneditsuborder': function (e, value, row, index) {
    	
  		 window.location.href="create_suborder.php?oid="+row.order_id+"&edit=1&soid="+row.suborder_id;
  		
    },
    
    'click .btnviewsuborder': function (e, value, row, index) {
    	
  		 window.location.href="create_suborder.php?oid="+row.order_id+"&edit=2&soid="+row.suborder_id;
  		
    },
    
    'click .btninvoice': function (e, value, row, index) {
    	
  		 window.open("invoice.php?oid="+row.order_id);
  		
    },
    'click .btnpayorder': function (e, value, row, index) {
    	
  		 window.location.href="pay_order.php?oid="+row.order_id;
  		
    },
    
     'click .btnsuborderdetail': function (e, value, row, index) {
        window.location.href="subscriptionorder_detail.php?id="+row.order_id;
    },
    
     'click .btncancel': function (e, value, row, index) {
        var r=confirm("Do you really want to cancel this Order");
  		if(r==true)
  		{
  		//window.location.href="cancel_allorderslist.php?id="+row.order_id;
  		window.scrollTo(0, 0);
  		$("#cancelRemarkdiv").fadeToggle(100);
  		 $(".container").find("*").not("#cancelRemarkdiv").animate({
            opacity: "0.9"
        }, 1000);
        	$(document).on("click","#btnRemark",function(){
        	var remark=$("#cancelremark").val();
			var strurl="cancel_addremark.php?id="+row.order_id+"&remark="+remark;
			$.ajax({
			    type : "GET",
			    url : strurl,
			    success : function(data){
			       $.each(data,function(i,field){
			       				var status=field.status;
								if(status==1)
								{
									window.location.href="cancel_allorderslist.php?id="+row.order_id;
								}
								else
								{
									alert("error");
								}
							});
			    }
			});
			
			});
  		
  		}
  		else
  		{
  			return false;
  		}
        
    }
   
};
</script>


<script>

        $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#drycleantable').bootstrapTable('getSelections'), function (row) {
                
               
              //  alert(uri);
             var did=row.order_id;
               var r=confirm("Do you really want to Cancel this Order");
			  		if(r==true)
			  		{
						window.scrollTo(0, 0);
				  		$("#cancelRemarkdiv").fadeToggle(100);
				  		 $(".container").find("*").not("#cancelRemarkdiv").animate({
				            opacity: "0.9"
				        }, 1000);
				        	$(document).on("click","#btnRemark",function(){
				        	var remark=$("#cancelremark").val();
				        	
							var strurl="cancel_addremark.php?id="+did+"&remark="+remark;
							$.ajax({
							    type : "GET",
							    url : strurl,
							    success : function(data){
							       $.each(data,function(i,field){
							       				var status=field.status;
												if(status==1)
												{
													
													 var uri="cancel_allorderslist.php?id="+did+"&op=1";
													$.get(uri,function(result){
												   //  alert(result);
												   location.reload();
												    });
												}
												else
												{
													alert("error");
												}
											});
							    }
							});
							
							});
			  		     
			            
			  		}
			  		else
			  		{
			  			return false;
			  		}
			               
                return row.order_id;
                
            });
            //alert(ids);
            
            $('#drycleantable').bootstrapTable('remove', {
                field: 'order_id',
                values: ids
            });
            
            
           //  $('#remove').prop('disabled', true);
        });
    });
</script>

<style>
	@media screen and (max-width: 600px) {
table {width:100%;}
thead {display: none !important;}
tr:nth-of-type(2n) {background-color: inherit;}
tr td:first-child {background: #f0f0f0; font-weight:bold;font-size:1.3em;}
tbody td {display: block; }

  td:nth-of-type(2):before { 
    content: 'Order Details:' ; 
    display: block;
     
  }
  
  td:nth-of-type(3):before { 
    content: 'Order Created By:' ; 
    display: block;
     
  }
  td:nth-of-type(4):before { 
    content: 'Order Via:' ; 
    display: block;
     
  }
  
}
</style>

<div style="left: 450px; top: 200px; position: absolute; z-index: 99999; background: #ccc; padding: 10px; border-radius: 5px;" id="cancelRemarkdiv" hidden>
	<h3>Why you are cancelling this order?</h3>
	<form role="form" action="" method="post">
		<caption>Add Remarks</caption>
		<input type="text" class="form-control" name="cancelremark" placeholder="Enter your remarks" id="cancelremark" />
		&nbsp;
		<input type="button" class="btn btn-primary" name="btnRemark" value="Add Remark" id="btnRemark" />
	</form>
	
</div>
            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Pending Deliveries</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                    	
                    	<!--<div class="row"> 
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel fixed_height_320" style="background-color:#565252;height: auto">
                                <div class="x_title panel-heading" style="color:white">
                                    <h2>Filter Orders &nbsp;</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    	<li>&nbsp; &nbsp;&nbsp; </li>
                                        
                                         <li>&nbsp; &nbsp; &nbsp;</li>
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                	
								<form method="post" class="form-inline"> 
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
									
									<div class="form-group">
								<button onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger">Refresh </button>
									</div>
								</form>
                                </div>
                            </div>
                        </div> 
                       </div>-->
                    	
                    	
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i><?php echo $title; ?> Order History</h2>
                                   
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
									

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pending Deliveries Order History</a>
                                            </li>
                                           
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                
                                                  <div class="x_content table-responsive">
                                                  	
                                                  	                           	                      
            			<?php
            			if(isset($_GET["cancelsuccess"]))
						{
						
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Order Cancelled successfully</div>";
echo "<script>setTimeout(\"location.href = 'allorder_list_new.php';\",800);</script>";	
						}
						elseif(isset($_GET["cancelfail"]))
						{
						
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Order Already Cancelled</div>";
echo "<script>setTimeout(\"location.href = 'allorder_list_new.php';\",800);</script>";	
						}
            			?>
                        
            <!-- Button for multiple delete-->
                
                     <div class="fixed-table-toolbar">
 	
  <div class="columns columns-left btn-group pull-left">
  	
  	  <button id="remove" class="btn btn-danger" >
           <i class="glyphicon glyphicon-remove"></i> 
            Cancel Selected Order
</button>

  </div>
              
<!-- End Button for multiple delete-->         


                        
                        
                                                 
                                    
                               <table data-toggle="table" id="drycleantable"  data-url="<?php echo $url; ?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-strict-search="false" data-multiple-search="true">
      
    <thead>
    <tr>
       <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
      
       <th data-field="order_detail" data-align="left" >Order</th>
       
        <!--<th data-field="order_id" data-align="left" >Order_Id</th>
        <th data-field="suborder_id" data-align="left" >SubOrder_Id</th>
         <th data-field="order_type" data-align="left" >Order Type</th>
         <th data-field="order_shipname" data-align="left" >Client Name</th>
         <th data-field="order_email" data-align="left" >Client Email</th>
         <th data-field="order_phone" data-align="left" >Client Mob</th>
        <th data-field="order_shipaddress" data-align="left">Delivery Address</th>
          <th data-field="pickupdate" data-align="center">Delivery_Date</th>
          <th data-field="order_total_amt_weight" data-align="center">Order_Amt/Wt</th>
         <th data-field="order_statustext" data-align="left">Order_status</th>
          <th data-field="payment_status" data-align="left">Payment status</th>-->
          
         <th data-field="order_createdby" data-align="left">Order Created By</th> 
         <th data-field="order_via" data-align="left">Order Via</th>
          
          <th data-field="remarks" data-align="left">Remarks</th> 
          
          <!--<th data-field="delivery_type" data-align="left">Delivery Type</th>-->
         
         <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
        
      
         
    </tr>
    </thead>
</table>
                                    
                                </div>
                                                
                                            </div>
                                            
                                 
                                           
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                
<?php include 'footer.php'; ?>
