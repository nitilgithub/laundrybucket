<?php
include 'header.php';
include '../connection.php';
require '../class.phpmailer.php';
require '../class.smtp.php';


function submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby)
{
	$usermessage = file_get_contents('../email_template/userorder.html');
	$adminmessage = file_get_contents('../email_template/adminorderemail.html');
		
		$result=mysql_query("insert into tbl_orders(OrderType,OrderUserId,User_Subsid,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review,Order_Via,CreatedBy) values('$ord_type','$uid','$ussubstype','$name','$email','$phone','$address','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$remarks','$order_via','$createdby')") or die(mysql_error());
							if(mysql_affected_rows())
							{
							$ordid=mysql_insert_id();
							if($remarks!='')
							{
							
							$r3=mysql_query("insert into tbl_remarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$ordid','$uid','$remarks','$remarksby',$remarksbyid,NOW())") or die(mysql_error());
							}
							
				// Replace the % with the actual information for sending email to user id
$usermessage = str_replace('%orderid%', $ordid, $usermessage);
$usermessage = str_replace('%ordertype%', $ord_type, $usermessage);
$usermessage = str_replace('%pickdate%', $pickdate, $usermessage);
$usermessage = str_replace('%picktime%', $picktime, $usermessage);			
$usermessage = str_replace('%address%', $address, $usermessage);							


// Replace the % with the actual information for sending email to Admin id
$adminmessage = str_replace('%client-name%', $name, $adminmessage);
$adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
$adminmessage = str_replace('%client-email%', $email, $adminmessage);
$adminmessage = str_replace('%client-mobile%', $phone, $adminmessage);
$adminmessage = str_replace('%ordertype%', $ord_type, $adminmessage);
$adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
$adminmessage = str_replace('%picktime%', $picktime, $adminmessage);			
$adminmessage = str_replace('%address%', $address, $adminmessage);							
$adminmessage = str_replace('%review%', $review, $adminmessage);

  
								$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "laundrybucket77@gmail.com"; //gmail email here
$mail->Password = "5qgapFAnR8giCOjA"; //gmail password here
$mail->SetFrom("laundrybucket77@gmail.com"); //from Address here
$mail->Subject = "New Order from laundrybucket.co.in";
$mail->Body = $adminmessage ;
$mail->AddAddress("laundrybucket1988@gmail.com"); //Email t0 test admin@laundrybucket.co.in

 if($mail->Send())
    {
								$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "laundrybucket77@gmail.com"; //gmail email here
$mail->Password = "5qgapFAnR8giCOjA"; //gmail password here
$mail->SetFrom("laundrybucket77@gmail.com"); //from Address here
$mail->Subject = "Thanks for placing order";
$mail->Body = $usermessage ;
$mail->AddAddress($email); //Email t0
 if($mail->Send())
    {
   	}
 else {
     
 }
    }
    else
    {
       echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
    }
    
    
	
	//$txtmsg=urlencode("Dear $name your order has been received of INR $address and its status is unpaid. OrderNo $ordid Dated $pickdate Login and get detail about order.");
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate . Pickup $picktime . Client $name . Ph $phone .");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone,8744009933,9718661177&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    ?>
    
						
										 <?php
										curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								//header("location:thanku.php");
								echo "Order Placed Successfully";
									
								    } 
										curl_close($ch);
	
	//echo "Order type is:".$ord_type;
	?>

<?php
	
    } 
							else
								{
								echo "Some error has been occoured";	
								}

}
?>

<style>
ul 
{
	overflow: hidden;
   /* background-color:red;*/
}
.address-bar ul li
{
	width: 257px;
border: 1px solid #DEEAEE;
border-radius: 4px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
padding: 10px;
/*margin: 10px 10px 10px 0;*/
margin-left: 15px;
margin-bottom: 10px;
float: left !important;
/*height: 150px;*/

}
</style>
<script>
	$(function()
	{
		$("#subscriptions_data").hide();
		
		
		$("#email").on("keyup",function()  //IF we change email address after selecting order type then selected order type will be reset and user needs to select order type again
		{
             	 $("#my_select ")[0].selectedIndex = 0;		//#my_select is ithe id of Order Type Div(// sets selected index to first item using the DOM)
				$("#subscriptions_data #my_select_2").html("");
				$("#subscriptions_data").hide();
				
		});
		
		$("#my_select").on("change",function()
		{
			var op=$(this).val();
			switch(op)
			{
				case "subscription":
				var email=$("#email").val();
				var phone=$(".phone").val();
				
				if((phone=="" || phone==null)&&(email=="" || email==null))
				{
					$("#btnsubmit").hide();
					alert("Please enter your phone or email !");
					return false;
				} 
				else
				{
					var email=$("#email").val();
					var phone=$(".phone").val();
					var uri="fetch_subscription.php?uemail="+email+"&uphone="+phone;
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
				$("#subscriptions_data").hide();
				 break;
			}
			
		});
	});
	
	
	
	$(function()
	{
	$("#unloginpickup").hide();
	
});
	
	$(document).on("keyup","#email, .phone",function(e)
	{
		
		var keypresscode=e.keyCode || e.which;
		//alert(keypresscode);
		if(keypresscode==9){
			e.preventDefault();
		}
		
		else{
		var email=$("#email").val();
		var phone=$(".phone").val();
		$("#message").empty();
		$(".phone").empty();
		$(".phone2").val("");
		$("#pickadd").val("");
		$("#getuid").val("");
		
		var strurl="https://laundrybucket.co.in/lb-admin/api_fetchaddressurl.php?uemail="+email+"&uphone="+phone;
	
		$.ajax({
			url:strurl,
			type:"GET",
			success:function(data)	
			{
				$.each(data,function(i,field){
					
					var status=field.status;
					
					if(status==1)
					{
						$("#message").html("<strong>This is already existing user</strong>");
						var fetchphone=	field.phone;
						$("#ufname").val(field.ufname);
						$("#ulname").val(field.ulname);
						$("#email").val(field.email);
						$(".phone").val(field.phone);
						$(".phone2").val(field.phone2);
						$("#pickadd").val(field.address);
						$("#unloginpickup").show();
						$("#getuid").val(field.userid);
						//alert(field.unloginuaddress);
						$("#unlogin_addresslist").append(field.unloginuaddress);
						$('#pickadd').prop('readonly', true);
						$('#email').prop('readonly', true);
						$('.phone').prop('disabled', true);
						if(fetchphone==null || fetchphone=="")
						{
								$('.phone').prop('required', false);
								
								$('.phonegroup1, .phone').hide();
								$('.phone2').prop('required', true);
								$('.phonegroup2 label').text("Customer Phone no");
								$('.phone2').prop('placeholder', "Enter Customer Phone No");
						}
						else
						{
							$('.phone').prop('required', true);
							$('.phonegroup1, .phone').show();
							$('.phone2').prop('required', false);
							$('.phonegroup2 label').text("Customer Alternate Phone no");
							$('.phone2').prop('placeholder', "Enter Customer Alternate Phone No");
						}
					}
					else if(status==0)
					{
						$("#message").html("<strong>New User</strong>");
						$("#unloginpickup").hide();
						$('#pickadd').prop('disabled', false);
						$('#email').prop('readonly', false);
						$('.phone').prop('disabled', false);
						$('.phone').prop('required', true);
						$('.phone2').prop('required', false);
						//$("#pickadd").removeClass("readonly");
						//$(".phone").val();
						//$("#pickadd").val();
						
						
					}
					
				});
				
				//$("#pickadd").val(data);
			}
			
		
		})
		}
	});
</script>

<script>
$(document).on("click","#savenewaddress",function()
                         		{
                         		
                         			//alert("ok");
                         			var getuid=$("#getuid").val();
                         			var address=$("#newaddress").val();
                         			
                         			var strurl="https://laundrybucket.co.in/apisave_newaddress.php?uid="+getuid+"&address="+address;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#headingTwo").css("background-color", "#444"); 
						 					$("#pickadd").val(address);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});
                         	
                         
</script>
 <script>
          	$(document).on("click",".btnaddress",function(){
          		var address=$(this).attr("title");
          		//alert(address);
          		$("#headingTwo").css("background-color", "#444");
          		$("#pickadd").val(address);
          		
          		//$("#collapseTwo").slideUp();
          		//$("#collapseTwo").collapse('hide');
          		
          	});
          </script>
      <!-- JS end for Pickup address -->    


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
                                    	
                                    	 <li>
                                        	<button onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger">Reset Order Form</button>
                                        	</li>
                                    	
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                        
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                 
                                </div>
                                <div class="x_content">
    							
    							
    							<!--
    						  <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data" >
                        
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                               <input type="submit" name="btnfilter" class="btn btn-success" value="Filter"/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                       -->
                        
                        
                        <?php
                        /*
if(isset($_POST["btnfilter"]))
{
  $res3=mysql_query("select * from tbl_ordersb"); //fetch Excel Uploaded Orders from temporary table ie tbl_neworders 
  while($row3=mysql_fetch_array($res3))
  {
  	$ordid=$row3["OrderId"];
	
  	//$ota=$row3["OrderTotalAmount"]; //get order ordertotalamt
  	$ota=($row3["OrderTotalAmount"]=='')?"NULL":"'".$row3["OrderTotalAmount"]."'";//fetch order amount in a variable
  	$otstatus=$row3["OrderStatusId"]; //get order ordertotalamt
  	$q4="update tbl_orders set OrderTotalAmount=$ota, OrderStatusId='$otstatus' where OrderId='$ordid'";
	$res4=mysql_query($q4);
	echo $q4;
	if(mysql_affected_rows()) //if email exist against mob no
	{
			echo $q4;
			echo "Orders Updted success";
	}
	else {
		echo "email not exist in table orders";
	}
	
	
  }	
}
						 * */
?>
    							
    							
    							     
                                   <?php
		if(isset($_POST["btnsave"]))
		{
			$fname=mysql_real_escape_string(trim($_POST["fname"]));
			$lname=mysql_real_escape_string(trim($_POST["lname"]));
			$name=$fname." ".$lname;
			
			$email=mysql_real_escape_string(trim($_POST["email"]));
			
			$phone1=mysql_real_escape_string(trim($_POST["phone"]));
			$phone2=mysql_real_escape_string(trim($_POST["phone2"]));
			$phone=(empty($phone1)) ? $phone2:$phone1;
			
			$address=mysql_real_escape_string(trim($_POST["address"]));
			$pickdate=trim($_POST["pickdate"]);
			$picktime=trim($_POST["picktime"]);
			
			$delivery_add=trim($_POST["address"]);
			$delivery_type=$_POST["dtype"];
			$ord_type=trim($_POST["ordercat"]);
						
			
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			$order_via='website';
			$createdby="admin";
			
						

if(isset($_POST["subtype"]))
			{
				$ussubstype=trim($_POST["subtype"]);
				
			}
			else {
				$ussubstype=0;
				
			}

			
			$result=mysql_query("select * from tblusers where((UserEmail='$email'&&UserEmail!='') OR (UserPhone='$phone1' && UserPhone!=''))") or die(mysql_error());
if(mysql_num_rows($result)>0)
{
	$row=mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	$uid=$row["UserId"];		//fetch userid if user have not login and have account
	if($count=1)
		{
			if(!empty($phone2))
			{
			if(empty($row["UserPhone"])&& $row["UserEmail"]==$email)	
			{
				$rs7=mysql_query("select * from tblusers where UserPhone='$phone2'");
				if(mysql_num_rows($rs7)>0)
				{
					$result7=mysql_query("update tblusers set UserPhone2='$phone2' where UserId='$uid'");
				}				
				else {
				    $result7=mysql_query("update tblusers set UserPhone='$phone2' where UserId='$uid'");	
				}
				
			}
			else
			{
				if($row["UserPhone"]!=$phone2)
				{
					$result7=mysql_query("update tblusers set UserPhone2='$phone2' where UserId='$uid'");
			    }
			
		    }	
			
		}
  }
}
else {
	//$uid=0;   //userid will be set to zero if user doesnot have account
	$upass=md5(rand(1111,9999));
	$regdate=date("Y-m-d");
	$ucreatedby="adminorder";
	$uevstatus=1;
	$usertype="websiteuser";
	$result2=mysql_query("insert into tblusers(UserFirstName,UserLastName,UserEmail,UserPhone,UserPhone2,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$name','$email','$phone1','$phone2','$upass','$address','$regdate','$uevstatus','$usertype','$ucreatedby')");
	
	if($result2)
	{
		$uid=mysql_insert_id();
		$uid=mysql_insert_id();
$result4=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$pickup_address',NOW())");
    }
	else
	{
		$uid=0;
	}
}


$remarks=mysql_real_escape_string(trim($_POST["review"]));
$remarksby="admin";
$remarksbyid="NULL";

		
			
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
						
				submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
				}
		}
		
				else
					{
		submit_order($uid,$name,$ord_type,$email,$phone,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		
		
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
                                   			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    		<span id="message" style="color:red;"> </span>
                                    			</div>
                                   		 
                                   		      &nbsp;
                                       
            								 <div class="item form-group" id="usemail">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Customer Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="email" class="form-control col-md-7 col-xs-12" id="email" name="email"   placeholder="Enter Customer Email Id" data-form-field="Email">
                                
                                            </div>
                                        </div>

            								&nbsp;
            						               								
            								 <div class="item form-group phonegroup1" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone" name="phone"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
                                        
                                        &nbsp;
            						               								
            								 <div class="item form-group phonegroup2" id="usmobile2">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Alternate Mobile
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                     
                                         <input type="tel" class="form-control col-md-7 col-xs-12 phone2" name="phone2"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Customer another Mobile no" data-form-field="Phone">
                                           
                                            </div>
                                        </div>
            
                                        &nbsp;
                                        
            
                                   		 
                                   		 
                                   		 
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Customer First Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"   name="fname" id="ufname" onblur="return usname(document.ordern.name)" required="" placeholder="Enter Customer First Name" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>    
                                            </div>
                                        </div>
                                      
                                       &nbsp;
                                       
                                        
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Customer Last Name
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                      
                                    <input type="text" class="form-control col-md-7 col-xs-12"  name="lname" id="ulname" required="" placeholder="Enter Customer Last Name" data-form-field="Name">
                                
                                            </div>
                                        </div>
                                      
                                  &nbsp;                               
                                              <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus"> Select Order Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
                                             <select class="form-control"  id="my_select" name="ordercat"   style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select Order Type</option>
            						
            						  <option value="dryclean"  style="padding-bottom:7px"> Dryclean Order</option>
            						  <option value="laundry" class="btnsubschk"  style="padding-bottom:7px"> Laundry Order</option>
										<option value="trial_laundry"  style="padding-bottom:7px"> Trial Order</option>
										<option value="standard_laundry"  style="padding-bottom:7px"> Standard Order</option>
										<option value="subscription"  style="padding-bottom:7px"> Subscription Order</option>
										
										
										</select>
                                            </div>
                                        </div>
                                             
                                             
                                             &nbsp;
                                             <div id="subscriptions_data" class="item form-group" >
                             			     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ordstatus"> Select Subscription Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" >
	                                            <select class="form-control"  id="my_select_2" name="subtype"   style="cursor: pointer">
	                                            	
	                                            </select>	
                             	            </div>
                             	            </div>
                            
                                             &nbsp;
                                          <div class="item form-group">
            				<label for="Image" class="control-label col-md-3 col-sm-3 col-xs-12">Pickup Address</label>
            				
            				<div class="col-md-6 col-sm-6 col-xs-12">
            			  
            			  <input type="text" class="form-control"  id="pickadd" name="address" required="" placeholder="Enter Customer Pickup Address" data-form-field="address">
            			       </div>
            			       
            			       <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
            			        <div class="panel panel-default" id="unloginpickup" style="display:none">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
					    <a style="text-decoration:none;cursor: pointer" class="collapsed" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   Change Your Pickup Address
						 </a>
						       
					 </h4>
				 </div>
						    
    			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      				<div class="panel-body">
               
              			<div class="col-md-12" style="border:1px solid red">
				              <h4>Add New Address</h4>
				         	<!-- We can not do nested form, so we do this using ajax without form tag-->
				         	   <div class="row">
				         	   	
				         	   	
				               	<div class="form-group">
                            	<input type="text" class="form-control text-capitalize hidden" id="getuid"  name="getuid" required="" placeholder="Enter Last Name*" data-form-field="LastName">
                            <!-- Using this field to get userid dynamically from email and mobile keyup function-->
                            </div>
				                	<div class="col-md-6">
										<div class="form-group">
										<textarea class="form-control" rows="1" id="newaddress" name="newaddress"></textarea>
				       					</div>
				                    </div>
				                    
				                	<div class="col-md-6">
										<div class="form-group">
										<input type="button"  id="savenewaddress" value="save address" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="btn btn-success"/>                    
								        </div>
				                    </div>
				              </div>
				              
            			</div>
            			
          				<br/>
         
          			   <div class="col-md-12">
					          <h4>Already Saved Address</h4>
					              <span class="address-bar">
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_addresslist">
					              	
					              		
					               </ul>
					             </span>
             		</div>
          
 			  </div>
    	   </div>
 	  </div>	
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
                                             <select name="dtype" class="form-control deliverytype"  onchange="chkdeliverytype(this.value)" style="cursor: pointer" required>
            						<option value=""  style="padding-bottom:7px">Select Delivery Type</option>
            						
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
