<?php include('header.php');
require 'class.phpmailer.php';
require 'class.smtp.php';
if($_SESSION["userloginstatus"]==1)
{
$uid=mysql_real_escape_string($_SESSION["uid"]);
}
 ?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title> 
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
	 
	$(document).on("click","#btnSaveOffers",function(){
		 var final1 = '';
	    /*$('.offer_list:checked').each(function(){        
	        var values = $(this).val()+", ";
	        final += values;
	    });*/
	   var value=""+$("#offer_list").val()+", ";
	   
	    $("#offers_span").append(value);
	    var final1=$("#offers_span").html();
	    $("#offers_text").val(final1);
	    $("#btnCloseModal").trigger("click");
	});
	$(document).on("click","#clear",function(){
		$("#offers_span").html("");
		$("#offers_text").val("");
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
          	$(document).on("click",".btnaddress",function()
          	{
          		var address=$(this).attr("title");
          		//alert(address);
          		$("#headingTwo").css("background-color", "#444");
          		$("#pickadd").val(address);
          		
          		//$("#collapseTwo").slideUp();
          		//$("#collapseTwo").collapse('hide');
          		
          	});
          </script>
      <!-- JS end for Pickup address -->
 <script>
function chkdeliverytype(dtype) {
	
	//alert(dtype);

	if(dtype=="fast")
	{
		//$('.dfast').innerHTML("F");
		document.getElementById('dfast').innerHTML = 'We deliver with in 24 hours & extra charges will apply';
	}
	else
	{
		document.getElementById('dfast').innerHTML = 'We Deliver with in 2-3 days';
		//alert("error");
	}

}

</script>


<script>
//this js is for Order form fill without login  
$(function()
	{
	$("#unloginpickup").hide();
	
});
	
	$(document).on("keyup","#email, .phone",function(e)
	{
		//$("#pickadd").val("");
		//$("#getuid").val("");
		
		var keypresscode=e.keyCode || e.which;
		//alert(keypresscode);
		if(keypresscode==9){
			e.preventDefault();
		}
		else{
		var email=$("#email").val();
		var phone=$(".phone").val();
		
		//$(".phone").empty();
		//$("#unlogin_addresslist").empty();
		$("#pickadd").val("");
		$("#getuid").val("");
		
		
		var strurl="https://laundrybucket.co.in/lb-admin/api_fetchaddressurl.php?uemail="+email+"&uphone="+phone;
		
		$.ajax({
			url:strurl,
			type:"GET",
			success:function(data)	
			{
				$("#unlogin_addresslist").empty();
				$.each(data,function(i,field){
					
					var status=field.status;
					var pickupadd=field.address;
					
					
					if(status==1)
					{
						//$("#message").html("<strong>This is already existing user</strong>");
						var fetchphone=	field.phone;
						$("#ufname").val(field.ufname);
						$("#ulname").val(field.ulname);
						$("#email").val(field.email);
						$(".phone").val(field.phone);
						$(".phone2").val(field.phone2);
						$("#pickadd").val(field.address);
						$("#unloginpickup").show();
						$('#refDiv').hide(100);
						$("#reference").val("");
						$("#getuid").val(field.userid);
						//alert(field.unloginuaddress);
						$("#unlogin_addresslist").append(field.unloginuaddress);
						$('#pickadd').prop('readonly', true);
						$('#email').prop('readonly', true);
						$('.phone').prop('readonly', true);
						
						$("#ufname").prop('readonly', true);
						$("#ulname").prop('readonly', true);
						if(fetchphone==null || fetchphone=="")
						{
								$('.phone').prop('required', false);
								$('.phone').hide();
								$('.phone2').prop('required', true);
								$('.phone2').prop('placeholder', "Enter Your Phone No");
						}
						else
						{
							$('.phone').prop('required', true);
							$('.phone').show();
							$('.phone2').prop('required', false);
							$('.phone2').prop('placeholder', "Enter Your Alternate Phone No");
						}
						
						if(pickupadd==null || pickupadd=="")
						{
							
							$("#pickadd").prop('placeholder', "select Your Pickup Address");
							$(".paneltext").text("select Your Pickup Address");
						}
						else
						{
							$("#pickadd").prop('placeholder', "Change Your Pickup Address");
							$(".paneltext").text("Change Your Pickup Address");
						}
						
					}
					else if(status==0)
					{
						//$("#message").empty();
						//$("#message").html("<strong>New User</strong>");
						$("#unloginpickup").hide();
						$('#pickadd').prop('readonly', false);
						$('#email').prop('readonly', false);
						$('.phone').prop('readonly', false);
						
						$("#ufname").prop('readonly', false);
						$("#ulname").prop('readonly', false);
						
						$('.phone').prop('required', true);
						$('.phone2').prop('required', false);
						$('#refDiv').show(100);
						$("#reference").val("");
						
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
	
	// end of js if user fill order form without login
</script>

<?php
function send_clientmessage($ordid,$pickdate,$picktime,$name,$phone)
{
	
	$pickdate1=date("d-m-Y", strtotime($pickdate));
	
	//$txtmsg=urlencode("Dear $name your order has been received of INR $address and its status is unpaid. OrderNo $ordid Dated $pickdate Login and get detail about order.");
	
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate1 . Pickup $picktime . Client $name . Ph $phone .");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								//header("location:thanku.php");
									} 
										curl_close($ch);
	
}


//function send_adminmessage($name,$ord_type,$phone,$pickup_address)
//{
		
	
function send_adminmessage($name,$phone,$pickup_address,$ordid,$offerid,$uid)
{
$adminsms=urlencode("Laundry Order Detail: Name: $name, Ph: $phone , Type:  , Add: $pickup_address Thanks.");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=8744009933,9718661177,7876786000&sender=BUCKET&message=".$adminsms;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								    	echo "<script>window.location.href='offer_payment.php?id=".$ordid."-".$offerid."-".$uid."'</script>";
								    //header("location:thanku.php");
								    
								    //echo "<script>window.location.href='offer_payment.php?id=".$ordid."-".$offerid."-".$uid."';<script>";
								    
									} 
										curl_close($ch);
	
}
?>

	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Buy Offer</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Buy Offer</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	

	<!-- QUOTE -->
	<div class="section pad bglight">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-10 col-md-offset-1">

<?php
                        //	function submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$delivery_date,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby)
					
					
					function submit_order($uid,$name,$email,$phone,$city,$pickup_address,$order_status_id,$remarks,$remarksby,$remarksbyid,$order_via,$createdby,$offers,$offerid)
					{
					//header("location:thanku.php");
					$usermessage = file_get_contents('email_template/userofferorder.html');
					$adminmessage = file_get_contents('email_template/adminofferorder.html');
					
					if($uid==0)
					{
						$remarks=$remarks."-".$name."-".$email."-".$phone;
					}
					
					//echo "<script>alert('".$uid."')</script>";
					//$result=mysql_query("insert into tbl_orders(OrderType,OrderUserId,User_Subsid,OrderShipName,OrderEmail,OrderPhone,OrderCity,OrderShipAddress,delivery_address,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review,Order_Via,CreatedBy,delivery_date) values('$ord_type','$uid','$ussubstype','$name','$email','$phone','$city','$pickup_address','$delivery_add','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$remarks','$order_via','$createdby','$delivery_date')") or die(mysql_error());	
					
					$seloffer=mysql_query("select * from tbl_combo_offer where offerId='$offerid'");
					$offerrow=mysql_fetch_array($seloffer);
					$offeramt=$offerrow['amount'];		
					
					$result=mysql_query("insert into tbl_orders(OrderUserId,OrderCity,PickupAddress,addon,OrderStatusId,Remarks,Order_Via,CreatedBy,UserDemandOffer,franchiseId,comboOfferId,OrderTotalAmount,TaxableAmount,PayableAmount) values('$uid','$city','$pickup_address',NOW(),'$order_status_id','$remarks','$order_via','$createdby','$offers','1','$offerid','$offeramt','$offeramt','$offeramt')") or die(mysql_error());
					
					if(mysql_affected_rows())
					 {
							$ordid=mysql_insert_id();
							if($remarks!='')
							{
							
							$r3=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$ordid','$uid','$remarks','$remarksby','$remarksbyid',NOW())") or die(mysql_error());
							}
							
							//echo $ussubstype;
							
														
						//Replace the % with the actual information for sending email to user id
							
							$usermessage = str_replace('%offername%', $offerrow['offerName'], $usermessage);
							
							
							//$usermessage = str_replace('%ordertype%', $ord_type, $usermessage);
							
							
							$usermessage = str_replace('%offerdesc%', $offerrow['offerDescription'], $usermessage);
							$usermessage = str_replace('%amount%', $offerrow['amount'], $usermessage);			
							$usermessage = str_replace('%pvalidity%', $offerrow['purchaseValidity'], $usermessage);							
							
							
						//Replace the % with the actual information for sending email to Admin id
							$adminmessage = str_replace('%offername%', $offerrow['offerName'], $usermessage);
							$adminmessage = str_replace('%offerdesc%', $offerrow['offerDescription'], $usermessage);
							$adminmessage = str_replace('%amount%', $offerrow['amount'], $usermessage);			
							$adminmessage = str_replace('%pvalidity%', $offerrow['purchaseValidity'], $usermessage);	
						
							$adminmessage = str_replace('%client-name%', $name, $adminmessage);
							$adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
							$adminmessage = str_replace('%client-email%', $email, $adminmessage);
							$adminmessage = str_replace('%client-mobile%', $phone, $adminmessage);
							
							
							//$adminmessage = str_replace('%ordertype%', $ord_type, $adminmessage);
							
							
							//$adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
							
							//$adminmessage = str_replace('%picktime%', $picktime, $adminmessage);
							$adminmessage = str_replace('%city%', $city, $adminmessage);			
							$adminmessage = str_replace('%address%', $pickup_address, $adminmessage);							
		  					$adminmessage = str_replace('%review%', $review, $adminmessage);
							
							   $mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom($email,"Laundry Bucket Order"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "New Order from laundrybucket.co.in";
								$mail->Body = $adminmessage;
								$mail->AddAddress("bucket@laundrybucket.co.in"); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');

							 if($mail->Send())
							    {
								$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom("orders@laundrybucket.co.in","Laundry Bucket"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Thanks for placing order";
								$mail->Body = $usermessage;
								$mail->AddAddress($email); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
								

										 if($mail->Send())
										    {
										    	echo "<script>window.location.href='offer_payment.php?id=".$ordid."-".$offerid."-".$uid."'</script>";
										   	}
										 else {
     
											  }
                                }
							    else
							    {
							       echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
							    }
							//send_clientmessage($ordid,$pickdate,$picktime,$name,$phone);
							
							//send_adminmessage($name,$phone,$pickup_address,$ordid,$offerid,$uid);
	   
	    					//send_adminmessage($name,$ord_type,$phone,$pickup_address);
	    					
	    					/*if($offerid!=""){
	    						echo "<script>window.location.href='offer_payment.php?id=".$ordid."-".$offerid."-".$uid."';<script>";
	    					}*/
	    					
	    					
					} 
							else
								{
								echo "not inserted";	
								}		    
								
					 }
                        	?>					
					<h2 class="section-heading">
						Your Basic Details
						<?php
						if(isset($_GET['offer'])){}
						else {
							?>
						
							<?php
						}
						?>
						
					</h2>

<?php
if($_SESSION["userloginstatus"]==1)
{
	$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($result);
	$userid=$row["UserId"];
?>					
					<form class="form-contact" method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS" name="ordern" onsubmit="return validateorderform(document.ordern.name,document.ordern.phone,document.ordern.laundry,document.ordern.dryclean)>
						<input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
						<div class="row">
							
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="email" class="form-control"  id="p_email" name="email"  placeholder="Email..." required="" value="<?php echo $row["UserEmail"]; ?>">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<?php
                            if(empty($row["UserPhone"]))
							{
							?>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control hidden" value="<?php echo $row["UserPhone"]; ?>" name="phone" readonly  placeholder="Phone..." data-inputmask="'mask' : '9999999999'">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row["UserPhone2"]; ?>" name="phone2" pattern="[0-9]{10}" required="required"  placeholder="Phone..." data-inputmask="'mask' : '9999999999'">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<?php
								}
								else {
							?>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row["UserPhone"]; ?>" name="phone" readonly  placeholder="Phone..." data-inputmask="'mask' : '9999999999'">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" value="<?php echo $row["UserPhone2"]; ?>" name="phone2" pattern="[0-9]{10}"  placeholder="Alternate Phone ..." data-inputmask="'mask' : '9999999999'">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
                            <?php	
							}
                            ?>
							
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control text-capitalize" value="<?php echo $row["UserFirstName"]; ?>"  name="fname" onblur="return usname(document.ordern.name)" required="" id="p_name" placeholder="First Name..." >
									<div class="help-block with-errors"></div>
									<span id="nameerr" style="color: Red; display: none">Characters only </span>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text text-capitalize" value="<?php echo $row["UserLastName"]; ?>"  name="lname" required="" class="form-control" id="p_name" placeholder="Last Name..." >
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								
								<div class="form-group">
							       <input type="text" class="form-control" readonly value="<?php echo $row["UserAddress"]; ?>" id="pickadd" name="address" required=""  placeholder="<?php if(empty($rows['UserAddress'])){ echo "Select Your Address"; } else { echo "Change Your Address" ; }?>" data-form-field="address">
							          <div class="panel panel-default">
							          	
										    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
											    <h4 class="panel-title">
												    <a style="text-decoration:none;cursor: pointer" class="collapsed" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
													   <?php
													 if(empty($row["UserAddress"]))
													 {
													 echo "Select Your Address";	
													 }
													 else {
														 echo "Change Your Address";
													 }
													 ?>
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
							                            	<input type="text" class="form-control text-capitalize hidden" value="<?php echo $userid; ?>" id="getuid"  name="getuid"  data-form-field="LastName">
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
												              	 <ul style="list-style-type:none;">
												              		<?php
												              		$i=1;
												              		$rs1=mysql_query("select * from tblusers_address where UserID='$userid'") or die(mysql_error());
																	if(mysql_num_rows($rs1)>0)
																	{
																		while($row1=mysql_fetch_array($rs1))
																		{
																			?>
																			
																			<li>
															    
															              	<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
															                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row1["Address"]; ?></span></address>
															                 <button type="button" class="btn g-back btn-block btn-success btnaddress" title="<?php echo $row1["Address"]; ?>" data-target="#collapseTwo" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseTwo">Select</button>
															                 
															               </li>
																			<?php
																			$i++;
																		}
																	}
												              		?>
												              		
												               </ul>
												             </span>
							             		</div>
							          
							 			  </div>
							    	   </div>
							 	  </div>
							</div>
								
								
								
								
								
								
								<!--<div class="form-group">
									<input type="text" class="form-control" id="p_address" placeholder="Pickup Address...">
									<div class="help-block with-errors"></div>
								</div>-->
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<select name="city"  class="styledselect_form_1 form-control" required  placeholder="Select City...">
										 <option value="">Select City</option>
	            				      	<?php
	            				      	$rs=mysql_query("select * from tbl_city");
										while($row=mysql_fetch_array($rs))
										{
											?>
										<option value="<?php echo $row["CityName"]; ?>" style="padding:10px"> <?php echo $row["CityName"]; ?> </option>
										<?php	
										}  
	            				      	?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!--<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control datepicker" name="pickdate" required="" placeholder="Pickup Date...">
									<div class="help-block with-errors"></div>
								</div>
							</div>-->
							<!--<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<select class="form-control" name="picktime" required placeholder="Select Pickup Time...">
										<option value="">Select Pickup Time</option>
    									<?php
	
										 $res2=mysql_query("SELECT * from tbl_pickuptime");			
											if(mysql_affected_rows())
										{
											while($rows2=mysql_fetch_array($res2))
									
										{
											?>
											<option  value="<?php echo $rows2["PickupTime"]; ?>" ><?php echo $rows2["PickupTime"]; ?></option>
											
											<?php
											}
											}
										?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group hidden-xs" hidden>
		                              <select name="reference"  class="form-control" aria-required="true" style="padding: 10px" id="reference">
		            				      	
		            				      	 <option value="">How you know about us?</option>
		            				      	<?php
		            				      	$rs3=mysql_query("select * from tbl_reference");
											while($row3=mysql_fetch_array($rs3))
											{
												?>
											<option value="<?php echo $row3["RefId"]; ?>" style="padding:10px"> <?php echo $row3["RefText"]; ?> </option>
											<?php	
											}  
		            				      	?>
		            									
											</select>
		               
		                         </div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<?php if(isset($_GET['offer'])){
										$offersel=mysql_real_escape_string($_GET['offer']);
										$seloffer=mysql_query("select * from tbl_combo_offer where offerId='$offersel'");
										$offerrow=mysql_fetch_array($seloffer);
										?>
										<span style="background: #fff; padding: 10px; border-radius:5px;">
										<span style="font-size:16px; ">Selected Offers : </span>
					                	<span id="offers_span" style="font-size:16px; "><?php echo $offerrow['offerName'];?></span>
					                	<input type="hidden" name="offerid" value="<?php echo $offersel; ?>" />
					                	<input type="hidden" name="offers" id="offers_text" value="<?php echo $offerrow['offerName'];?>" />
					                </span>
										<?php
									}
									else
									{
									?>
									
									 <input type="button" value="Add Offers" class="btn btn-primary" data-toggle="modal" data-target="#addoffer" />
									 <span style="background: #fff; padding: 10px; border-radius:5px;">
										<span style="font-size:16px; ">Selected Offer : </span>
					                	<span id="offers_span" style="font-size:16px; "></span>
					                	
					                	<span class="fa fa-times" id="clear" style="cursor: pointer; text-align: right; "></span>
					                	<input type="hidden" name="offerid" value="" />
					                	<input type="hidden" name="offers" id="offers_text" />
					                </span>
					                <?php
									}?>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									 <textarea id="p_message" class="form-control" name="review" rows="6" placeholder="Remarks"></textarea>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="g-recaptcha" data-sitekey="6LfNPCIUAAAAANekZa3PRBvdg_BkaaTtW1oJkZGi"></div>
		                         <noscript>
								  <div>
								    <div style="width: 302px; height: 422px; position: relative;">
								      <div style="width: 302px; height: 422px; position: absolute;">
								        <iframe src="https://www.google.com/recaptcha/api/fallback?k=6LfNPCIUAAAAANekZa3PRBvdg_BkaaTtW1oJkZGi"
								                frameborder="0" scrolling="no"
								                style="width: 302px; height:422px; border-style: none;">
								        </iframe>
								      </div>
								    </div>
								    <div style="width: 300px; height: 60px; border-style: none;
								                   bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
								                   background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
								      <textarea id="g-recaptcha-response" name="g-recaptcha-response"
								                   class="g-recaptcha-response"
								                   style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
								                          margin: 10px 25px; padding: 0px; resize: none;" >
								      </textarea>
								    </div>
								  </div>
								</noscript>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<div id="success"></div>
									<button type="submit" name="submitorder" class="btn btn-secondary">BUY OFFER</button>
								</div>
							</div>
						</div>
					</form>
<?php
}
}
else {
?>
				<form  class="form-contact" method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS" name="ordern" onsubmit="return validateorderform(document.ordern.name,document.ordern.phone,document.ordern.laundry,document.ordern.dryclean)">
						<input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
						<div class="row">
							
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email..." required="">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control phone" name="phone" required="" pattern="[0-9]{10}" data-inputmask="'mask' : '9999999999'" id="p_phone" placeholder="Phone...">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control phone2" name="phone2" pattern="[0-9]{10}" data-inputmask="'mask' : '9999999999'" id="p_phone" placeholder="Alternate Phone...">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control text-capitalize" id="ufname"  name="fname" onblur="return usname(document.ordern.name)" required="" placeholder="First Name..." >
									<div class="help-block with-errors"></div>
									<span id="nameerr" style="color: Red; display: none">Characters only </span>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control text-capitalize" id="ulname"  name="lname"  placeholder="Last Name..." required="">
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
							       <input type="text" class="form-control"   id="pickadd" name="address" required="" placeholder="Enter Your Address" data-form-field="address">
							          <div class="panel panel-default" id="unloginpickup" style="display:none">
							          	
										    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
											    <h4 class="panel-title">
												    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
													   Change Your  Address
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
							                            	<input type="text" class="form-control text-capitalize hidden" id="getuid"  name="getuid"  placeholder="Enter Last Name*" data-form-field="LastName">
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
												              	 <ul style="list-style-type:none;" id="unlogin_addresslist">
												              	
												              		
												               </ul>
												             </span>
							             		</div>
							          
							 			  </div>
							    	   </div>
							 	  </div>
							</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<select name="city"  class="styledselect_form_1 form-control" required  placeholder="Select City...">
										 <option value="">Select City</option>
	            				      	<?php
	            				      	$rs3=mysql_query("select * from tbl_city");
										while($row3=mysql_fetch_array($rs3))
										{
											?>
										<option value="<?php echo $row3["CityName"]; ?>" style="padding:10px"> <?php echo $row3["CityName"]; ?> </option>
										<?php	
										}  
	            				      	?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<!--<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control datepicker" name="pickdate" required="" id="datepicker" placeholder="Pickup Date...">
									<div class="help-block with-errors"></div>
								</div>
							</div>-->
							<!--<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<select class="form-control" name="picktime" required  placeholder="Select Pickup Time...">
										<option value="">Select Pickup Time</option>
            									
            								<?php
			
											 $res2=mysql_query("SELECT * from tbl_pickuptime");			
												if(mysql_affected_rows())
											{
												while($rows2=mysql_fetch_array($res2))
										
											{
												?>
												<option  value="<?php echo $rows2["PickupTime"]; ?>"  ><?php echo $rows2["PickupTime"]; ?></option>
												
												<?php
												}
												}
											?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>-->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<select name="reference" class="form-control" id="reference" placeholder="Select How you know about Us?...">
										<option value="">How you know about us?</option>
	            				      	<?php
	            				      	$rs3=mysql_query("select * from tbl_reference");
										while($row3=mysql_fetch_array($rs3))
										{
											?>
										<option value="<?php echo $row3["RefId"]; ?>" style="padding:10px"> <?php echo $row3["RefText"]; ?> </option>
										<?php	
										}  
	            				      	?>
									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<?php if(isset($_GET['offer'])){
										$offersel=mysql_real_escape_string($_GET['offer']);
										$seloffer=mysql_query("select * from tbl_combo_offer where offerId='$offersel'");
										$offerrow=mysql_fetch_array($seloffer);
										?>
										<span style="background: #fff; padding: 10px; border-radius:5px;">
										<span style="font-size:16px; ">Selected Offers : </span>
					                	<span id="offers_span" style="font-size:16px; "><?php echo $offerrow['offerName'];?></span>
					                	<input type="hidden" name="offerid" value="<?php echo $offersel; ?>" />
					                	<input type="hidden" name="offers" id="offers_text" value="<?php echo $offerrow['offerName'];?>" />
					                </span>
										<?php
									}
									else
									{
									?>
									
									 <input type="button" value="Add Offers" class="btn btn-primary" data-toggle="modal" data-target="#addoffer" />
									 <span style="background: #fff; padding: 10px; border-radius:5px;">
										<span style="font-size:16px; ">Selected Offer : </span>
					                	<span id="offers_span" style="font-size:16px; "></span>
					                	
					                	<span class="fa fa-times" id="clear" style="cursor: pointer; text-align: right; "></span>
					                	<input type="hidden" name="offerid" value="" />
					                	<input type="hidden" name="offers" id="offers_text" />
					                </span>
					                <?php
									}?>
									 
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									 <textarea id="p_message" class="form-control" name="review" rows="6" placeholder="Remarks"></textarea>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="g-recaptcha" data-sitekey="6LfNPCIUAAAAANekZa3PRBvdg_BkaaTtW1oJkZGi"></div>
		                         <noscript>
								  <div>
								    <div style="width: 302px; height: 422px; position: relative;">
								      <div style="width: 302px; height: 422px; position: absolute;">
								        <iframe src="https://www.google.com/recaptcha/api/fallback?k=6LfNPCIUAAAAANekZa3PRBvdg_BkaaTtW1oJkZGi"
								                frameborder="0" scrolling="no"
								                style="width: 302px; height:422px; border-style: none;">
								        </iframe>
								      </div>
								    </div>
								    <div style="width: 300px; height: 60px; border-style: none;
								                   bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
								                   background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
								      <textarea id="g-recaptcha-response" name="g-recaptcha-response"
								                   class="g-recaptcha-response"
								                   style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
								                          margin: 10px 25px; padding: 0px; resize: none;" >
								      </textarea>
								    </div>
								  </div>
								</noscript>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<div id="success"></div>
									<button type="submit" name="submitorder" class="btn btn-secondary">BUY OFFER</button>
								</div>
							</div>
						</div>
					</form>
<?php }

		if(isset($_POST["submitorder"]))
		{
		$fname=mysql_real_escape_string(trim($_POST["fname"]));
			$lname=mysql_real_escape_string(trim($_POST["lname"]));
			$name=$fname." ".$lname;
			$email=mysql_real_escape_string(trim($_POST["email"]));
			if(empty($email))
			{
				$email="";
			}
			$phone1=mysql_real_escape_string(trim($_POST["phone"]));
			$phone2=mysql_real_escape_string(trim($_POST["phone2"]));
			$phone=(empty($phone1)) ? $phone2:$phone1;
			
			
			
			$city=mysql_real_escape_string($_POST["city"]);
			$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
			//$pickdate=mysql_real_escape_string(trim($_POST["pickdate"]));
			//$picktime=mysql_real_escape_string(trim($_POST["picktime"]));
			
			$offers=mysql_real_escape_string(trim($_POST["offers"]));
			$offerid=mysql_real_escape_string(trim($_POST["offerid"]));
			
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			
			$order_via='website';
			$createdby="user";
			
			$uid="";
			$query="";
			
			
			
			/*Start In this code section we are getting userid if user have account and placing order without login*/
		if(!isset($_SESSION["userloginstatus"]))
		{
			$query="select * from tblusers where((UserEmail='$email'&&UserEmail!='') OR (UserPhone='$phone1' && UserPhone!=''))";
		}
		else {
	$uid=mysql_real_escape_string($_SESSION["uid"]);  //userid if user is placing order after login to account
	$query="select * from tblusers where UserId='$uid'";
	}
	
	$result=mysql_query($query) or die(mysql_error());
if(mysql_num_rows($result)>0)
{
	$row=mysql_fetch_array($result);
	$count=mysql_num_rows($result);
	
	$uid=$row["UserId"];
	
	//echo $uid;		//fetch userid if user have not login and have account
	
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
	$ucreatedby="UserOrder";
	$uevstatus=1;
	$usertype="websiteuser";
	$result2=mysql_query("insert into tblusers(UserFirstName,UserLastName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerifiedStatus,UserType,CreatedBy) values('$fname','$lname','$email','$phone1','$upass','$pickup_address','$regdate','$uevstatus','$usertype','$ucreatedby')");
	if($result2)
	{
		$uid=mysql_insert_id();
$result4=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$pickup_address',NOW())");	
	
    }
	else
	{
		$uid=0;
		
		
	}
}

/*End  In this code section we are getting userid if user have account and placing order without login*/

$remarks=mysql_real_escape_string(trim($_POST["review"]));
$remarksby="user";
$remarksbyid=$uid;


			$msg=array();
			// code for check server side validation
	/*if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$msg[]="The Validation code does not match!";// Captcha verification is incorrect.		
	}*/
	
	
		if(empty($_POST['g-recaptcha-response'] ) || $_POST['g-recaptcha-response']==""){  
		$msg[]="The Validation code does not match!";// Captcha verification is incorrect.		
	}
	else
	{
		
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$myvar1="6LfNPCIUAAAAAM3WD74kuyYDzGX8uHk4xX3GDw5M";
		$myvar2=$_POST['g-recaptcha-response'];
		$myvars = 'secret=' . $myvar1 . '&response=' . $myvar2;
		
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec( $ch );
		
		$resp=json_decode($response);
		if(($resp->success)!=1)
		{
			$msg[]="The Validation code does not match!";// Captcha verification is incorrect.
		}
	}
	
	//else{// Captcha verification is Correct. Final Code Execute here!		
		//$msg="<span style='color:green'>The Validation code has been matched.</span>";		
	//}
	
	if(!empty($msg))
				{
					foreach($msg as $error)
					{
						//echo $err.'<br/>';
					
					echo '<script type="text/javascript">alert("'.$error.'");</script>';
					}
				}
				
	else {
									
			submit_order($uid,$name,$email,$phone,$city,$pickup_address,$order_status_id,$remarks,$remarksby,$remarksbyid,$order_via,$createdby,$offers,$offerid);
				
				//echo "user id is:".$uid;					
	
	}
	
		}

?>



				</div>
			</div>
		</div>
	</div>

	

<?php include('footercta.php');?>

<div id="addoffer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Offer</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" name="offer" id="offer_list" />
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSaveOffers">Save</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include('footer.php'); ?>