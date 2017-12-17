<?php include 'header.php';?>
<?php
include 'connection.php';
?>
<?php
$fdate="";
$sdate="";
$type='laundry';
$url="";
 {
	//$fdate=date("m/d/Y", strtotime("-1 months"));
	//$sdate=date("m/d/Y");
	//$url="webservice_datetodate.php?fdate=".$fdate."&sdate=".$sdate."&type=".$type;
	$url="webservice_pendingdeliveries.php";
	$title=" Pending Deliveries";
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
		
		var sendmailbutton = row.order_type  === 'subscription' ? '<a href="javascript:void(0)" style="color:black" class="btnsuborderdetail btn btn-primary btn-sm" title="subscription order edit" >Edit Detail</a>' : '<a class="btndetail btn btn-info  btn-sm" href="javascript:void(0)" title="edit"> Edit Detail</a>';
		
    return [
        
        sendmailbutton
        /*
         '<a class="btncancel btn btn-danger btn-sm" href="javascript:void(0)"  title="Cancel Order">', ' ',
        'Cancel order',
        '</a>'
       */
    ].join('');
}

window.actionEvents = {
    'click .btndetail': function (e, value, row, index) {
    	
  		 window.location.href="allorders_detail.php?id="+row.order_id;
  		
    },
    
     'click .btnsuborderdetail': function (e, value, row, index) {
        window.location.href="subscriptionorder_detail.php?id="+row.order_id;
    }
    
    /*
     'click .btncancel': function (e, value, row, index) {
        var r=confirm("Do you really want to delete this Order");
  		if(r==true)
  		{
  		window.location.href="delete_cancelledorders.php?id="+row.order_id;
  		
  		}
  		else
  		{
  			return false;
  		}
        
    }
   */
};
</script>

<!--
<script>
        $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#drycleantable').bootstrapTable('getSelections'), function (row) {
                var did=row.order_id;
                var uri="cancel_allorderslist.php?id="+did+"&op=1";
              //  alert(uri);
             
               var r=confirm("Do you really want to Cancel this Order");
			  		if(r==true)
			  		{
			  		     $.get(uri,function(result){
						    //   alert(result);
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
-->
            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                    	
                    	
                    	
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i><?php echo $title; ?> </h2>
                                   
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
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pending Deliveries</a>
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
echo "<script>setTimeout(\"location.href = 'allorder_list.php';\",800);</script>";	
						}
						elseif(isset($_GET["cancelfail"]))
						{
						
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Order Already Cancelled</div>";
echo "<script>setTimeout(\"location.href = 'allorder_list.php';\",800);</script>";	
						}
            			?>
                        
            <!-- Button for multiple delete-->
                <!--
                     <div class="fixed-table-toolbar">
 	
  <div class="columns columns-left btn-group pull-left">
  	  <button id="remove" class="btn btn-danger" >
           <i class="glyphicon glyphicon-remove"></i> 
            Cancel
</button>
  </div>
    -->          
<!-- End Button for multiple delete-->         


                        
                        
                                                 
                                    
                               <table data-toggle="table" id="drycleantable"  data-url="<?php echo $url; ?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-strict-search="false" data-multiple-search="true">
      
    <thead>
    <tr>
       <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
        <th data-field="order_id" data-align="left" >Order_Id</th>
         <th data-field="order_type" data-align="left" >Order_Type</th>
         <th data-field="order_shipname" data-align="left" >Client Name</th>
         <th data-field="order_email" data-align="left" >Client Email</th>
         <th data-field="order_phone" data-align="left" >Client Mob</th>
        <th data-field="order_shipaddress" data-align="left">Address</th>
          <th data-field="pickupdate" data-align="center">Pickup_Date</th>
           <th data-field="delivery_date" data-align="center">Delivery_Date</th>
          <th data-field="order_total_amt_weight" data-align="center">Order_Amt/Wt</th>
         <th data-field="order_statustext" data-align="left">Order_status</th>
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