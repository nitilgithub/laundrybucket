<?php
include 'header.php';
$user_id=intval(trim($_GET["id"]));
global $orderreceipt_id;
?>
<script>
	function actionFormatter(value, row, index) {
    return [
        '<a class="btnedit btn btn-primary btn-xs" href="javascript:void(0)" title="edit">', '<i class="glyphicon glyphicon-edit"> </i>',' ',
        'EDIT',
        '</a>'
        /*
        '<a class="btndel btn btn-danger btn-xs" href="javascript:void(0)" title="Edit">', '<i class="fa fa-trash-o"></i>', ' ',
        'Delete',
        '</a>',
         '<a class="btnorderhistory btn btn-info btn-xs" href="javascript:void(0)" title="Order History">', '<i class="fa fa-history"></i>', ' ',
        'Order History',
        '</a>'
        */
    ].join('');
}

window.actionEvents = {
    'click .btnedit': function (e, value, row, index) {
        window.location.href="allorders_detail.php?id="+row.ord_no;
    }
    /*
    'click .btndel': function (e, value, row, index) {
        window.location.href="delete_reguser.php?id="+row.id;
    },
    
      'click .btnorderhistory': function (e, value, row, index) {
        window.location.href="user_orderhistory.php?id="+row.id;
    }
    */
};


        /*
    $(function () {
        $('#remove').click(function () {
            var ids = $.map($('#table').bootstrapTable('getSelections'), function (row) {
                var did=row.id;
                var uri="delete_reguser.php?id="+did+"&op=1";
              //  alert(uri);
                $.get(uri,function(result){
			    //   alert(result);
			    });
                return row.id;
                
            });
            //alert(ids);
            
            $('#table').bootstrapTable('remove', {
                field: 'id',
                values: ids
            });
            
           //  $('#remove').prop('disabled', true);
        });
    });
    */
</script>
 

 <!-- page content -->
            
<div class="right_col" role="main" style="min-height: 1500px">
	<?php
	  if(isset($_GET["id"]))
	{
		 $result=mysql_query("select * from tbl_orders where OrderUserId='$user_id' order by OrderId DESC") or die(mysql_error());
		if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_array($result);
			$result2=mysql_query("select * from tblusers where UserId='$user_id'") or die(mysql_error());
			if(mysql_num_rows($result2)>0)
			{
				$row2=mysql_fetch_array($result2);
				$usname=(empty($row2["UserFirstName"]) ? $row["OrderShipName"] : $row2["UserFirstName"]);
			
	?>     
	      
	        
		          <div class="page-title">
		   			 <div class="title_left">
		        		<h3>Orders History </h3>
		         	</div>
		     	 </div>
		                    
		    	<div class="clearfix"></div>
		    	
		    <!-- Start Section for Subscription Order Details-->
		         
		         <div class="">
 					<div class="col-md-12 col-sm-12 col-xs-12">
               			 <div class="x_panel">
               			 	
                    		 <div class="x_title">
		                       <h2 class="text-capitalize"><i class="fa fa-bars"></i> <?php echo $usname." 's" ; ?> Order Detail </h2>
		                       <ul class="nav navbar-right panel_toolbox">
	                      		 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	                       	    <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                       		  </ul>
                       		  <div class="clearfix"></div>
                   			 </div>
                   			 
                   			 
                   			 <div class="x_content table-responsive">
      			    	
	                  			 <div class="fixed-table-toolbar">
				 						<!--
									  <div class="columns columns-left btn-group pull-left">
									  	  <button id="remove" class="btn btn-danger" >
									         <i class="glyphicon glyphicon-remove"></i> Delete
										  </button>
									  </div>
									  -->
									 <table data-toggle="table" id="table" data-url="webservice_user_orderhistory.php?uid=<?php echo $user_id;?>" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
									    <thead>
									   		 <tr>
									        	<th data-field=" " data-checkbox="true"></th>
									        	<th data-field="srno" data-align="left">Sr no</th>
									        	<th data-field="ord_no" data-align="left" data-sortable="true">Order Id</th>
									        	<th data-field="ord_receiptno">Order Receipt No.</th>
									       		<th data-field="ord_type" data-align="left">Order Type</th>
									          	<th data-field="ord_date" data-align="center">Order Date</th>
									          	<th data-field="order_total_amt_weight">Order Total Amount/Weight</th>
									         	<th data-field="order_statustext" data-align="left">Order Status</th>
									          	<th data-field="ord_remarks" data-align="left">Order Remarks</th>
									         	<th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
									         
									    	</tr>
									   </thead>
								   </table>
								 </div>
               				</div>
               			</div>
               		</div>
               	</div>
               	
           <!-- End Section fot Subscription Order Detail -->
      <?php
   	    }
   	   }
		else {
			header("location:reguserlist.php?uid=$user_id&ohstatus");
		}
	 }
   	 ?>       				

</div>

<?php include 'footer.php'; ?>
   