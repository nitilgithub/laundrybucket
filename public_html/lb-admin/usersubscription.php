<?php include 'header.php';$subs_ref=$_GET["ref"];?>
<style>
	.daterangepicker{
		z-index:9999999;
	}
</style>
<script>


	function actionFormatter(value, row, index) {
		
			 //var imgdata = row.order_receipt_img === '#' ? 'Not Available' : 'available';
		//var sendmailbutton = row.id % 2 === 0 ? '<a href="'+value+'" style="color:black" class="btn btn-primary btn-sm"  target=_blank>Send Email</a>' : ' ';	 
    return [
    	
    	 
    	 '<a class="btnactivate btn btn-danger btn-sm" href="javascript:void(0)"  title="Activate">', ' ',
        'Activate',
        '</a>','&nbsp;&nbsp;',
        // sendmailbutton
       
       /* '<a class="btndetail btn btn-info  btn-sm" href="javascript:void(0)" title="edit">', ' ',
        'Edit Detail',
        '</a>',
         '<a class="btncancel btn btn-danger btn-sm" href="javascript:void(0)"  title="Cancel">', ' ',
        'Cancel subscription',
        '</a>'*/
       
    ].join('');
}

window.actionEvents = {
	'click .btnactivate': function (e, value, row, index) {
         var r=confirm("Do you really want to activate this subscription");
  		if(r==true)
  		{
  			$("#actvdate").val(row.activedate);
  			$('#myModal').modal('show'); 
  		//window.location.href="activate_usersubscription.php?id="+row.id+"&cname="+row.clientname+"&cemail="+row.clientemail+"&subscost="+row.subscost+"&subsname="+row.subsname+"&subsvalid="+row.validity;
  			$("#btnActive").on("click",function(){
		  	 var activedate=$("#actvdate").val();
		   		window.location.href="activate_usersubscription.php?id="+row.id+"&cname="+row.clientname+"&cemail="+row.clientemail+"&subscost="+row.subscost+"&subsname="+row.subsname+"&subsvalid="+row.validity+"&activedate="+activedate;
		   });
  		}
  		else
  		{
  			return false;
  		}
   
    }
    /*
    'click .btndetail': function (e, value, row, index) {
        window.location.href="drycleanorder_detail.php?id="+row.order_id;
    },
     'click .btncancel': function (e, value, row, index) {
        var r=confirm("Do you really want to cancel this Order");
  		if(r==true)
  		{
  		window.location.href="drycancel_order.php?id="+row.order_id;
  		
  		}
  		else
  		{
  			return false;
  		}
        
    }*/
   
};

</script>


<script>
	function actionFormatter2(value, row, index) {
    return [
        '<a class="btndeactivate btn btn-success btn-sm" href="javascript:void(0)"  title="Inactivate">', ' ',
        'Inactivate',
        '</a>'
       
    ].join('');
}

window.actionEvents2 = {
   'click .btndeactivate': function (e, value, row, index) {
         var r=confirm("Do you really want to Inactivate this subscription");
  		if(r==true)
  		{
  		window.location.href="inactivate_usersubscription.php?id="+row.id;
  		
  		}
  		else
  		{
  			return false;
  		}
   
    }
   
};
</script>

<style>
	table a{ color:#000;}
</style>

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>User Subscriptions</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 class="text-capitalize"><i class="fa fa-bars"></i> <?php echo $subs_ref;?> Subscriptions</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                      
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">


                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" class="text-capitalize"><?php echo $subs_ref;?> Subscriptions</a>
                                            </li>
                                           
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                
                                      
                                      	<?php
		if($subs_ref=='inactive')
		
		{
			?>
                                      
                                                  <div class="x_content">
                                                  	
                        <?php
                        
            			if(isset($_GET["as"]))
						{
					
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Subscription Activated Successfully</div>";
							?>
								<script>
			window.location.href="usersubscription.php?ref=inactive";
			</script>
							<?php
//echo "<script>setTimeout(\"location.href = 'usersubscription.php?inactive';\",800);</script>";	
						}
							elseif(isset($_GET["af"]))
						{
							//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Failed Subscription Activation.Please try again </div>";
							?>
								<script>
			window.location.href="usersubscription.php?ref=inactive";
			</script>
							<?php
//echo "<script>setTimeout(\"location.href = 'usersubscription.php?inactive';\",800);</script>";
						}
            			?>
                               
                                    
                               <table data-toggle="table" data-url="webservice_usersubscription.php?ref=inactive" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
        <th data-field="id" data-align="left" >Id</th>
        
        <th data-field="uid" data-align="left" >User Id</th>
        <th class="text-capitalize" data-field="clientname" data-align="left" >Client Name</th>
          <th class="text-capitalize" data-field="subsname" data-align="left" >Subscription</th>
          <th class="text-capitalize" data-field="subsdate" data-align="left" >Subscribe Date</th>
          
           <th class="text-capitalize" data-field="startdate" data-align="left" >Start Date</th>
          
           <th class="text-capitalize" data-field="enddate" data-align="left" >End Date</th>
           
            <th class="text-capitalize" data-field="validity" data-align="left" >Validity</th>
            
             <th class="text-capitalize" data-field="usedweight" data-align="left" >Used Weight</th>
             
              <th class="text-capitalize" data-field="remainingweight" data-align="left" >Remaining Weight</th>
              
               <th class="text-capitalize" data-field="usedpick" data-align="left" >Used Pickup</th>
               
                 <th class="text-capitalize" data-field="remainingpick" data-align="left" >Remaining Pickup</th>
        
        <!--
         <th data-field="clientname" data-align="left" >Client Name</th>
         <th data-field="order_phone" data-align="left" > </th>
        <th data-field="order_shipaddress" data-align="left">Address</th>
          <th data-field="order_date" data-align="center">Order_Date</th>
         -->
        
        <th class="text-capitalize" data-field="substatus" data-align="left">status</th>
           <!--
        <th data-field="payment_status" data-align="left">Paid Status</th>
        -->
        <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
         <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>
       <?php } ?>
        <!-- <th data-field="address">Address</th> 
         <th data-field="regdate">Reg Date</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>-->
         
    </tr>
    </thead>
</table>

                                    
                                </div>
                                <?php
                                }  /*Code end for Inactive Subscription */
                                
								
 /*Code for Activated Subscription Start*/
								
								
elseif($subs_ref=='activated')
		
		{
			?>
                                      
                                                  <div class="x_content">
                                                  	
                                                  	                           	                      
            			<?php
            			if(isset($_GET["ias"]))
						{
						
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Subscription InActivated Successfully</div>";
							?>
								<script>
			window.location.href="usersubscription.php?ref=activated";
			</script>
							<?php
							
	
						}
						elseif(isset($_GET["iaf"]))
						{
							//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Failed Subscription InActivation.Please try again </div>";
?>

	<script>
			window.location.href="usersubscription.php?ref=activated";
			</script>
<?php
						}
            			?>
                               
                                    
                               <table data-toggle="table" data-url="webservice_usersubscription.php?ref=activated" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
        <th data-field="id" data-align="left" >Id</th>
        
         <th data-field="uid" data-align="left" >User Id</th>
        <th class="text-capitalize" data-field="clientname" data-align="left" >Client Name</th>
          <th class="text-capitalize" data-field="subsname" data-align="left" >Subscription</th>
          <th class="text-capitalize" data-field="subsdate" data-align="left" >Subscribe Date</th>
          
            <th class="text-capitalize" data-field="startdate" data-align="left" >Start Date</th>
          
           <th class="text-capitalize" data-field="enddate" data-align="left" >End Date</th>
           
            <th class="text-capitalize" data-field="validity" data-align="left" >Validity</th>
            
             <th class="text-capitalize" data-field="usedweight" data-align="left" >Used Weight</th>
             
              <th class="text-capitalize" data-field="remainingweight" data-align="left" >Remaining Weight</th>
              
               <th class="text-capitalize" data-field="usedpick" data-align="left" >Used Pickup</th>
               
                 <th class="text-capitalize" data-field="remainingpick" data-align="left" >Remaining Pickup</th>
        <!--
         <th data-field="clientname" data-align="left" >Client Name</th>
         <th data-field="order_phone" data-align="left" > </th>
        <th data-field="order_shipaddress" data-align="left">Address</th>
          <th data-field="order_date" data-align="center">Order_Date</th>
         -->
        
        <th class="text-capitalize" data-field="substatus" data-align="left">status</th>
           <!--
        <th data-field="payment_status" data-align="left">Paid Status</th>
        -->
        <?php if($_SESSION['loginrole']==2 || $_SESSION['loginrole']==3){?>
         <th data-field="action" data-formatter="actionFormatter2" data-events="actionEvents2">Action</th>
       <?php } ?>
        <!-- <th data-field="address">Address</th> 
         <th data-field="regdate">Reg Date</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>-->
         
    </tr>
    </thead>
</table>

                                    
                                </div>
                                <?php
                                }
                /*code for complete subscription*/
                             
	elseif($subs_ref=='completed')
		
		{
			?>
                                      
                                                  <div class="x_content">
                                                  	
                        <?php
                        
            			if(isset($_GET["as"]))
						{
					
						//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Subscription Activated Successfully</div>";
							?>
								<script>
			window.location.href="usersubscription.php?ref=inactive";
			</script>
							<?php
//echo "<script>setTimeout(\"location.href = 'usersubscription.php?inactive';\",800);</script>";	
						}
							elseif(isset($_GET["af"]))
						{
							//echo "<script>alert('Record deleted Successfully')</script>";
							echo "<div class='alert alert-success'>Failed Subscription Activation.Please try again </div>";
							?>
								<script>
			window.location.href="usersubscription.php?ref=inactive";
			</script>
							<?php
//echo "<script>setTimeout(\"location.href = 'usersubscription.php?inactive';\",800);</script>";
						}
            			?>
                               
                                    
                               <table data-toggle="table" data-url="webservice_usersubscription.php?ref=completed" data-pagination="true" data-show-refresh="true" data-show-toggle="true"  data-show-columns="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true">
      
    <thead>
    <tr>
        <th data-field=" " data-checkbox="true"></th>
      <!--  <th data-field="srno" data-align="left" data-sortable="true">ID</th>-->
        <th data-field="id" data-align="left" >Id</th>
        <th class="text-capitalize" data-field="clientname" data-align="left" >Client Name</th>
          <th class="text-capitalize" data-field="subsname" data-align="left" >Subscription</th>
          <th class="text-capitalize" data-field="subsdate" data-align="left" >Subscribe Date</th>
          
           <th class="text-capitalize" data-field="startdate" data-align="left" >Start Date</th>
          
           <th class="text-capitalize" data-field="enddate" data-align="left" >End Date</th>
           
            <th class="text-capitalize" data-field="validity" data-align="left" >Validity</th>
            
             <th class="text-capitalize" data-field="usedweight" data-align="left" >Used Weight</th>
             
              <th class="text-capitalize" data-field="remainingweight" data-align="left" >Remaining Weight</th>
              
               <th class="text-capitalize" data-field="usedpick" data-align="left" >Used Pickup</th>
               
                 <th class="text-capitalize" data-field="remainingpick" data-align="left" >Remaining Pickup</th>
        
        <!--
         <th data-field="clientname" data-align="left" >Client Name</th>
         <th data-field="order_phone" data-align="left" > </th>
        <th data-field="order_shipaddress" data-align="left">Address</th>
          <th data-field="order_date" data-align="center">Order_Date</th>
         -->
        
        <th class="text-capitalize" data-field="substatus" data-align="left">status</th>
           <!--
        <th data-field="payment_status" data-align="left">Paid Status</th>
        -->
        
        <!-- <th data-field="address">Address</th> 
         <th data-field="regdate">Reg Date</th>
          <th data-field="action" data-formatter="actionFormatter" data-events="actionEvents">Action</th>-->
         
    </tr>
    </thead>
</table>

                                    
                                </div>
                                <?php
                                }  /*Code end for complete Subscription */
                                     
     
     ?>
     
                                                
                                            </div>
                                            
                                 
                                           
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Activation Date</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="datepicker form-control" placeholder="Slect Activation Date" id="actvdate" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnActive">Activate</button>
      </div>
    </div>

  </div>
</div>
                
<?php include 'footer.php'; ?>