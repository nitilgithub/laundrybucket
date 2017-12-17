<?php
include 'header.php';
include '../connection.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
$order_type="Drycleaning";
function submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$review)
{
		$result=mysql_query("insert into tbl_orders(OrderType,OrderUserId,OrderEmail,OrderPhone,OrderShipAddress,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review) 
		values('$ord_type','$uid','$email','$phone','$address','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$review')") or die(mysql_error());
							if(mysql_affected_rows())
							{
								echo "Order Placed Successfully";
						   }
    						else
								{
								echo "Failed";	
								}

}
?>

<script>
	$(function()
	{
		$("#subscriptions_data").hide();
		
		$("#email").on("keyup",function()
		{
             	 $("#my_select ")[0].selectedIndex = 0;		
		});
		$("#my_select").on("change",function()
		{
			var op=$(this).val();
			switch(op)
			{
				case "subscription":
				var email=$("#email").val();
				if(email=="" || email==null)
				{
					$("#btnsubmit").hide();
					alert("Please enter your email address !");
					return false;
				} 
				else
				{
					var email=$("#email").val();
					var uri="fetch_subscription.php?uemail="+email;
					$.ajax(
					{
						url:uri,
						type:"GET",
					beforeSend: function ()
		               {
		                 $.blockUI({ css: { 
					           border: 'none', 
					           padding: '15px', 
					           backgroundColor: '#000', 
					           '-webkit-border-radius': '10px', 
					           '-moz-border-radius': '10px', 
					           opacity: .5, 
					           color: '#fff' 
					       } }); 
					 
					       setTimeout($.unblockUI, 2000); 
					   },
						success:function(result)
						{
						    $.each(result, function (i,field) 
						    {
						    	var status=field.status;
						    	
						    	switch(status)
						    	{
						    		case 1:
						    		$("#subscriptions_data").show();
						    		var dd="<option value="+ field.srno+">"+field.subs_name+"</option>";
						    		$("#subscriptions_data #my_select_2").append(dd);
						    		break;
						    		case 2:
						    		 alert("No Package Found !");
						    		  $("#my_select ")[0].selectedIndex = 0;
						    		break;
						    		case 3:
						    		 alert("User is not Registered,Please select another order type");
						    		  $("#my_select ")[0].selectedIndex = 0;
						    		break;
						    	}
						    	
						    	
						    });	
						},
						error:function(err)
						{
							alert(err);
						}
						
					});
					
					
				}
				 
				break;
				default :
				$("#subscriptions_data #my_select_2").html("");
				 break;
			}
			
		});
	});
</script>

   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Create Order</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Create New Order </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    							
    							
    							     
                                   <?php
		if(isset($_POST["btnsave"]))
		{
			$name=trim($_POST["name"]);
			$email=trim($_POST["email"]);
			$phone=trim($_POST["phone"]);
			
			$address=trim($_POST["address"]);
			$pickdate=trim($_POST["pickdate"]);
			$picktime=trim($_POST["picktime"]);
			
			$delivery_type=$_POST["dtype"];
			$ord_type=trim($_POST["ordercat"]);
			
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			
			$review=trim($_POST["review"]);
			

			$result=mysql_query("select * from tblusers where UserEmail='$email' or UserPhone='$phone'") or die(mysql_error());
if(mysql_num_rows($result))
{
	$row=mysql_fetch_array($result);
	$uid=$row["UserId"];		//fetch userid if user have not login and have account
}
else {
	$uid=0;   //userid will be set to zero if user doesnot have account
}


		
			
				if($ord_type=="trial_laundry")
		{
				$chk=mysql_query("select * from tbl_orders where OrderEmail='$email' and OrderType='trial_laundry'");
				if(mysql_affected_rows())
				{
					?>
						<script>
						alert("Sorry Your Request Could not Processed. This client have already taken the trial. Please subscribe the package or place an standard order online or call us at +919718661177");
						</script>
					<?php
				}
							
				else
				{
					submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$review);	
				}
		}
				else
					{
						submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$review);
					}
		
			

?>
<span class="section"> &nbsp;</span>

<?php

}


		?>
                                    <form method="post" role="form" class="form-horizontal" name="ordern" enctype="multipart/form-data" onsubmit="return validateorderform(document.ordern.name,document.ordern.email,document.ordern.phone)">
                                    		
                                    		<!--
                                    		<div class="col-md-12 col-sm-12 col-xs-12 bg-info">
                                    		<h3 >Step-1 &nbsp; <small>Customer Personal Info </small> </h3>
                                    		</div>
                                    		-->
                                    		<div class="col-md-12 col-sm-12 col-xs-12">
                                    			&nbsp;<br/>
                                    			</div>
                                   		
                                   		&nbsp;
                                   		 
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Customer Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="name" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer Name" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>    
                                            </div>
                                        </div>
                                      
                                       &nbsp;
            								 <div class="item form-group" id="usemail">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Customer Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="email" class="form-control col-md-7 col-xs-12" id="email" name="email" onblur="checkMailStatus();" required="" placeholder="Enter Customer Email Id" data-form-field="Email">
                              <span id="emailerr" style="color: Red; display: none">Invalid Email Address </span>  
                                            </div>
                                        </div>

            								&nbsp;
            						               								
            								 <div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12" name="phone" required="" onblur="return phonenumber(document.ordern.phone)" data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                            <span id="error" style="color: Red; display: none">Please Enter Valid 10 Digits Phone Number </span>
                                            </div>
                                        </div>
            
                                        &nbsp;
                                        
                                           
                                              <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus"> Select Order Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
                                             <select class="form-control"  id="my_select" name="ordercat"   style="cursor: pointer">
            						<option value="-1"  style="padding-bottom:7px">Select Order Type</option>
            						
            						  <option value="dryclean"  style="padding-bottom:7px"> Dryclean Order</option>
            						  <option value="laundry" class="btnsubschk"  style="padding-bottom:7px"> Laundry Order</option>
										<option value="trial_laundry"  style="padding-bottom:7px"> Trial Order</option>
										<option value="standard_laundry"  style="padding-bottom:7px"> Standard Order</option>
										<option value="subscription"  style="padding-bottom:7px"> Subscription Order</option>
										
										
										</select>
                                           
                                        <span id="oterror" style="color: Red; display: none">Please Select at least 1 order Type </span>
                                            </div>
                                        </div>
                                             
                                             
                                             &nbsp;
                                             <div id="subscriptions_data" class="item form-group" >
                             			     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus"> Select Subscription Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
	                                            <select class="form-control"  id="my_select_2" name="ordercat"   style="cursor: pointer">
	                                            	
	                                            </select>	
                             	            </div>
                             	            </div>
                            
                                             &nbsp;
                                          <div class="item form-group">
            				<label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-6 col-xs-12">
            				
            			  <input type="text" class="form-control"  id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address">	
            				</div>  
            				</div>  
                                        &nbsp;
                                        
                                          <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob">Pickup Date
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                  
                                   <input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Pickup Date">      
                                            </div>
                                        </div>
                                        
                                          &nbsp;
                                          
                                          <div class="item form-group bootstrap-timepicker">
            				<label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12">Pickup Time</label>
            				
            				<div class="col-md-6 col-sm-6 col-xs-12">
            				
            			<input id="timepicker2" type="text" class="input-small form-control" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">	
            				</div>  
            				
            			
            				</div>   
            				
            				&nbsp;
                                  <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus"> Select Delivery Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
                                             <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer">
            						<option value="-1"  style="padding-bottom:7px">Select Delivery Type</option>
            						
            						  <option value="normal"  style="padding-bottom:7px"> Normal Delivery</option>
            						  <option value="fast"  style="padding-bottom:7px"> Express Delivery</option>
										
										</select>
                                    
                                            </div>
                                        </div>
                                          
                                               <div class="item form-group" >
                                               	<span class="col-md-3 col-sm-3 col-xs-12"> </span>
                    	<span class="col-md-6 col-sm-6 col-xs-12"  style="color:red" id="dfast"> </span>
                    	</div>
                    	
                    	  &nbsp;
                    	
                    	<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Any Review
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="review" placeholder="Remarks" style="height: 95px">
                                 
                                            </div>
                                        </div>
                                             
                      
            			
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" id="btnsubmit" value="Save & Continue..."/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                                   
                                  
                             
                                   
                                
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
<?php include 'footer.php';?>                            
