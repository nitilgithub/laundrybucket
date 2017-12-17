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
if(isset($_POST['next10']))
{
	$val=mysql_real_escape_string($_POST['orderval']);
	
	
	
	$url="webservice_allorderlist_new.php?v=".$val;
	
	
}
else {
	//$fdate=date("m/d/Y", strtotime("-1 months"));
	//$sdate=date("m/d/Y");
	//$url="webservice_datetodate.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
	$url="webservice_allorderlist_new.php?v=10";
	$title="All";
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
 function imageFormatter(value, row) 
      {
      	if(value==null || value=='')
      	{
      		return '-';
      	}
      	else
      	{
      	var path='https://cdn.laundrybucket.co.in/images/'+value;
      	//alert(path);
      	return '<a href="'+path+'" target="_blank"><img style="width:60px;height:60px;" class="img-responsive img-thumbnail" src="'+path+'" /></a>';
    	}
    }

	function actionFormatter(value, row, index) {
		
		var sendmailbutton = row.order_type  === 'subscription' ? '<a href="javascript:void(0)" style="color:black" class="btnsuborderdetail btn btn-primary btn-sm" title="subscription order edit" >Edit Order</a>' : '<a class="btndetail btn btn-info  btn-sm" href="javascript:void(0)" title="edit"> Edit Order</a>';
		var viewsuborderbutton ='<a class="btnsuborder btn btn-info  btn-sm" href="javascript:void(0)" title="view"> View SubOrder</a>';
		var payorder ='<a class="btnpayorder btn btn-info  btn-sm" href="javascript:void(0)" title="pay"> Update Payment</a>';
		var invoice ='<a class="btninvoice btn btn-primary  btn-sm" href="javascript:void(0)" title="invoice"> Invoice</a>';
		var createsuborder ='<a class="btncreatesuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="Create Suborder">Create Suborder</a>';
		var createsubssuborder ='<a class="btnsubssuborder btn btn-primary  btn-sm" href="javascript:void(0)" title="Create Subscription Suborder">Create Subscription Suborder</a>';
    return [
        
        sendmailbutton,
        viewsuborderbutton,
        createsuborder,
        createsubssuborder,
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
    'click .btncreatesuborder': function (e, value, row, index) {
    	
  		 window.location.href="create_suborder.php?oid="+row.order_id+"&edit=0";
  		
    },
    
    'click .btnsubssuborder': function (e, value, row, index) {
    	
  		 window.location.href="create_subs_suborder.php?oid="+row.order_id;
  		
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
						window.scrollTo(0,0);
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
    content: 'Order Process:' ; 
    display: block;
     
  }
  td:nth-of-type(3):before { 
    content: 'Order Details:' ; 
    display: block;
     
  }
  td:nth-of-type(4):before { 
    content: 'Order Receipt:' ; 
    display: block;
     
  }
  td:nth-of-type(5):before { 
    content: 'Order Created By:' ; 
    display: block;
     
  }
  td:nth-of-type(6):before { 
    content: 'Order Via:' ; 
    display: block;
     
  }
  td:nth-of-type(7):before { 
    content: 'Order PickUp By:' ; 
    display: block;
     
  }
}
</style>
            <!-- page content -->
            <div class="right_col" role="main">
            	<div style="left: 10%; top: 10%; position: absolute; z-index: 99999; background: #ccc; padding: 10px; border-radius: 5px;" id="cancelRemarkdiv" hidden>
					<h3>Why you are cancelling this order?</h3>
					<form role="form" action="" method="post">
						<caption>Add Remarks</caption>
						<input type="text" class="form-control" name="cancelremark" placeholder="Enter your remarks" id="cancelremark" />
						&nbsp;
						<input type="button" class="btn btn-primary" name="btnRemark" value="Add Remark" id="btnRemark" />
					</form>
					
				</div>

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>All Orders</h3>
                            
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                    	
                    	
                    	
                    	
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
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">All Orders</a>
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
	<form action="" method="post">
		<input type="number" name="orderval" placeholder="No. of orders to view" />
     <input type="submit" value="View" name="next10" class="btn btn-primary" />
     </form>
  </div>
              
<!-- End Button for multiple delete-->         


                        
                        
                                                 
 <table data-toggle="table" id="drycleantable"  data-url="<?php echo $url; ?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-strict-search="false" data-multiple-search="true">
      
    <thead>
    <tr>
       <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
      <th data-field="oprocess" data-align="left" >Order <br>Process</th>
      
       <th data-field="order_detail" data-align="left" >Order Detail</th>
       
      
      
      <th data-field="receipt_pic" data-formatter="imageFormatter">Order Receipt</th>
      
        <th data-field="order_createdby" data-align="left">Order Created By</th> 
         <th data-field="order_via" data-align="left">Order Via</th>
           <th data-field="order_pickby" data-align="left">Order PickedBy<br>(Rider)</th>
      
      <th data-field="remarks" data-align="left">Remarks</th>
      
        <!--<th data-field="order_id" data-align="left" >Order_Id</th>
         
         <th data-field="order_shipname" data-align="left" >Client Name</th>
         <th data-field="order_email" data-align="left" >Client Email</th>
         <th data-field="order_phone" data-align="left" >Client Mob</th>
        <th data-field="order_shipaddress" data-align="left">Address</th>
          <th data-field="pickupdate" data-align="center">Pickup_Date</th>
          <th data-field="order_total_amt_weight" data-align="center">Order_Amt/Wt</th>
         <th data-field="order_statustext" data-align="left">Order_status</th>
         
         <th data-field="ordertypes" data-align="left">Order Type</th>
         
       
           
           <th data-field="offer_demand" data-align="left">User selected<br> Offers</th>
           
           
            <th data-field="offercode" data-align="left">Offer Codes<br> Applied</th>
            
            <th data-field="receipt_no" data-align="left">Order ReceiptNo</th>
            <th data-field="receipt_pic" data-align="center" data-formatter="imageFormatter">Order Receipt</th>
            
            
          <th data-field="remarks" data-align="left">Remarks</th> 
          
          
          
           <th data-field="payment_status" data-align="left">Payment status</th>-->
         
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
