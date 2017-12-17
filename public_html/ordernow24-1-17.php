	<?php
include 'header.php';
//include 'connection.php';
require 'class.phpmailer.php';
require 'class.smtp.php';
if($_SESSION["userloginstatus"]==1)
{
$uid=mysql_real_escape_string($_SESSION["uid"]);
}


//$uloginid= $_SESSION["uloginid"];
$str1="";
//$order_type="Drycleaning";
?>
<style>
<link href="assets/php-captcha/style.css" rel="stylesheet">

ul 
{
	overflow: hidden;
    background-color:red;
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
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<!-- JS for Pickup address -->
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
          
          
          <!-- JS for Delivery address -->
          <!--
          <script>

                         	$(document).on("click","#savenewaddressd",function()
                         		{
                         		
                         			//alert("ok");
                         			
                         			var addressd=$("#newaddressd").val();
                         			var strurld="https://laundrybucket.co.in/apisave_newaddress.php?uid="+<?php echo $_SESSION["uid"]; ?>+"&address="+addressd;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurld,
						 				type:"GET",
						 				success:function(datad)
						 				{
						 					//console.log(data);
						 					//$("#subscriptions_data").html(data);
						 					$("#deliver_add").val(addressd);
						 					
						 					
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                         	});
                         	
                         
</script>
 <script>
          	$(document).on("click",".btnaddressd",function(){
          		var addressd=$(this).attr("title");
          		//alert(address);
          		$("#deliver_add").val(addressd);
          		//$("#collapseTwo").slideUp();
          		//$("#collapseTwo").collapse('hide');
          		
          	});
          </script>
-->

<!-- Js for unregistered user delivery address -->
<!--
<script>

	function SetAddress(checked) {
	if (checked) {
    	document.getElementById('deliver_add2').value = document.getElementById('pickadd2').value;    
          $('#deliver_add2').attr('readonly', true);
	 
	} 
	else {
        
		  $('#deliver_add2').attr('readonly', false);
		document.getElementById('deliver_add2').value = ''; 
	}
}

</script>
-->

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
						$("#getuid").val(field.userid);
						//alert(field.unloginuaddress);
						$("#unlogin_addresslist").append(field.unloginuaddress);
						$('#pickadd').prop('readonly', true);
						$('#email').prop('readonly', true);
						$('.phone').prop('readonly', true);
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
	
	// end of js if user fill order form without login
</script>



<?php
function send_clientmessage($ordid,$pickdate,$picktime,$name,$phone)
{
	//$txtmsg=urlencode("Dear $name your order has been received of INR $address and its status is unpaid. OrderNo $ordid Dated $pickdate Login and get detail about order.");
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate . Pickup $picktime . Client $name . Ph $phone .");
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


function send_adminmessage($name,$ord_type,$phone,$pickup_address)
{

$adminsms=urlencode("Laundry Order Detail: Name: $name, Ph: $phone , Type: $ord_type , Add: $pickup_address Thanks.");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=8744009933,9718661177&sender=BUCKET&message=".$adminsms;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								    header("location:thanku.php");
									} 
										curl_close($ch);
	
}
?>

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background" id="form1-22" style="margin-top:28px;background-image: url(assets/images/img-65803888x2592-131.jpg); background-repeat: repeat-x;">
    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(34, 34, 34);"></div>
    <div class="mbr-section__container mbr-section__container--std-padding container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" data-form-type="formoid">
                    	
                        <div class="mbr-header mbr-header--center mbr-header--std-padding">
                        	
                            <?php

function submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby)
{
	$usermessage = file_get_contents('email_template/userorder.html');
	$adminmessage = file_get_contents('email_template/adminorderemail.html');
	
			
		$result=mysql_query("insert into tbl_orders(OrderType,OrderUserId,User_Subsid,OrderShipName,OrderEmail,OrderPhone,OrderCity,OrderShipAddress,delivery_address,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review,Order_Via,CreatedBy) values('$ord_type','$uid','$ussubstype','$name','$email','$phone','$city','$pickup_address','$delivery_add','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$remarks','$order_via','$createdby')") or die(mysql_error());
							if(mysql_affected_rows())
							{
							$ordid=mysql_insert_id();
							if($remarks!='')
							{
							
							$r3=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$ordid','$uid','$remarks','$remarksby','$remarksbyid',NOW())") or die(mysql_error());
							}
							//echo $ussubstype;
							
				// Replace the % with the actual information for sending email to user id
$usermessage = str_replace('%orderid%', $ordid, $usermessage);
$usermessage = str_replace('%ordertype%', $ord_type, $usermessage);
$usermessage = str_replace('%pickdate%', $pickdate, $usermessage);
$usermessage = str_replace('%picktime%', $picktime, $usermessage);			
$usermessage = str_replace('%address%', $pickup_address, $usermessage);							


// Replace the % with the actual information for sending email to Admin id
$adminmessage = str_replace('%client-name%', $name, $adminmessage);
$adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
$adminmessage = str_replace('%client-email%', $email, $adminmessage);
$adminmessage = str_replace('%client-mobile%', $phone, $adminmessage);
$adminmessage = str_replace('%ordertype%', $ord_type, $adminmessage);
$adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
$adminmessage = str_replace('%picktime%', $picktime, $adminmessage);
$adminmessage = str_replace('%city%', $city, $adminmessage);			
$adminmessage = str_replace('%address%', $pickup_address, $adminmessage);							
$adminmessage = str_replace('%review%', $review, $adminmessage);

  
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
										   	}
										 else {
     
											  }
                                }
							    else
							    {
							       echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
							    }
							    
    
	send_clientmessage($ordid,$pickdate,$picktime,$name,$phone);
	   
	    send_adminmessage($name,$ord_type,$phone,$pickup_address);
		
		//header("location:thanku.php");
    } 
							else
								{
								echo "not inserted";	
								}

}
?>
                        </div>
                        <div data-form-alert="true"></div>
                        <?php
if($_SESSION["userloginstatus"]==1)
{
	$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($result);
	$userid=$row["UserId"];
	
?>

            
               
                          <form method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS" name="ordern" onsubmit="return validateorderform(document.ordern.name,document.ordern.phone,document.ordern.laundry,document.ordern.dryclean)">
                            <input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
                           
                           <div class="col-md-12">
                            			<div class="col-md-10">
                            				<h2 class="mbr-header__text text-center">YOUR ORDER DETAILS </h2>
                            				</div>
                            				<div class="col-md-2">
                           		 <input type="reset" onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger"><br/>
                           		 </div>
                           	</div>
						
						  <div class="form-group">
                                <input type="email" class="form-control" value="<?php echo $row["UserEmail"]; ?>" name="email"    placeholder="Email" data-form-field="Email">
                              <!--<span id="emailerr" style="color: Red; display: none">Invalid Email Address </span>-->
                            </div>
                            
                            <?php
                            if(empty($row["UserPhone"]))
							{
								?>
								 <div class="form-group">
                                <input type="tel" class="form-control hidden" value="<?php echo $row["UserPhone"]; ?>" name="phone" readonly data-inputmask="'mask' : '9999999999'" placeholder="Enter Phone" data-form-field="Phone">
                            </div>
                            
								 <div class="form-group">
                                <input type="tel" class="form-control" value="<?php echo $row["UserPhone2"]; ?>" pattern="[0-9]{10}" title="Enter your mobile number" name="phone2" required  data-inputmask="'mask' : '9999999999'" placeholder="Enter Phone No" data-form-field="Phone">
                           		 </div>
								<?php
							}
							else {
								?>
							 <div class="form-group">
                                <input type="tel" class="form-control" value="<?php echo $row["UserPhone"]; ?>"  name="phone" required  readonly data-inputmask="'mask' : '9999999999'" placeholder="Enter Phone" data-form-field="Phone">
                            </div>
                            
                             <div class="form-group">
                                <input type="tel" class="form-control" value="<?php echo $row["UserPhone2"]; ?>" pattern="[0-9]{10}" title="Enter your mobile number"  name="phone2"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Alternate Phone No" data-form-field="Phone">
                           		 </div>
                            <?php	
							}
                            ?>
                           
                            
                            
                           
                            <div class="form-group">
                                <input type="text" class="form-control text-capitalize" value="<?php echo $row["UserFirstName"]; ?>"  name="fname" onblur="return usname(document.ordern.name)" required="" placeholder="Name*" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>
                            </div>
                            
                            <div class="form-group">
                            	<input type="text" class="form-control text-capitalize" value="<?php echo $row["UserLastName"]; ?>"  name="lname" required="" placeholder="Entaer Last Name*" data-form-field="LastName">
                            </div>
                            
                            
                          
                            <?php
                           if(isset($_GET["otype"]))
						  {
						   if($_GET["otype"]=="laundry")
						   {
						   	?>
						   	<script>
						 	$(function()
						 	{
						 		
						 			var strurl="https://laundrybucket.co.in/fetch_subscription.php?uid="+<?php echo $_SESSION["uid"]; ?>;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					$("#subscriptions_data").html(data);
						 				},
						 				error:function(err)
						 				{
						 					//alert($err);
						 				}
						 			})
						 			//alert(strurl);
						 		   //$("#subscriptions_data").load(strurl);
						 		
						 	});
												 	</script>
						   	   <div class="form-group">
						   	   	</div>
						   	<?php
						   }
						   else
						   	{
						   	  $type=mysql_real_escape_string($_GET["otype"]);
							  echo "<input type='hidden' name='hiddenotype' value='".$type."'>";	
						   	}
						  }
                   else {
                         ?>
                         <script>
                         	$(function()
                         	{
                         		$(".btnsubschk").on("change",function()
                         		{
                         			if($(this).is(":checked")) 
                         			{
                         			var strurl="https://laundrybucket.co.in/fetch_subscription.php?uid="+<?php echo $_SESSION["uid"]; ?>;
						 			//alert(strurl);
						 			$.ajax({
						 				url:strurl,
						 				type:"GET",
						 				success:function(data)
						 				{
						 					//console.log(data);
						 					$("#subscriptions_data").html(data);
						 				},
						 				error:function(err)
						 				{
						 					alert($err);
						 				}
						 			 })
                           		    }
                           		else
                           		{
                           			//alert(strurl);
                           			$("#subscriptions_data").html("");
                           			
                           		}
                         			});
                         	});
                         </script>
                      
                                         <div class="form-group checkbox bg-info" style="padding: 5px">
                             	<h3> Order Selection</h3>
                               <label>
                               	&nbsp;
                   <input type="checkbox" id="laun" class="btnsubschk" value="laundry" name="laundry"> Laundry & Ironing
                             </label>
                             <br/>
                             &nbsp;
                             <label>
              <input type="checkbox" id="dry"  value="dryclean"  name="dryclean"> Drycleaning
                             </label>
                             <br/>
                              <span id="chkerror" style="color: Red; display: none">Please Select at least 1 order Type </span>
                             </div>
             	
	                 <?php
                         }
                           ?>
                            
                             
                             	
                             	
                             		<div id="subscriptions_data">
                             			
                             		
                             	</div>
                            
                            
                            <!--code start for pickup address -->
                            
                             
 <div class="form-group">
       <input type="text" class="form-control" readonly value="<?php echo $row["UserAddress"]; ?>" id="pickadd" name="address" required=""  placeholder="<?php if(empty($rows['UserAddress'])){ echo "Select Your Pickup Address"; } else { echo "Change Your Pickup Address" ; }?>" data-form-field="address">
          <div class="panel panel-default">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
					    <a style="text-decoration:none;cursor: pointer" class="collapsed" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
						   <?php
						 if(empty($row["UserAddress"]))
						 {
						 echo "Select Your Pickup Address";	
						 }
						 else {
							 echo "Change Your Pickup Address";
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
					              	 <ul style="list-style-type:none;margin-left:-50px">
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
                           

						<!--code End for pickup address -->		
							 
							 
							 <!--code start for Delivery address -->
							 <!--
 <div class="form-group">
     
     <input type="text" id="deliver_add" readonly value="<?php echo $row["UserAddress"]; ?>"  class="form-control" required="" name="deladdress" placeholder="Your Delivery Address">
    
				
							 
							   <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingThree" style="background-color: #0042A4; color:white;">
	      <h4 class="panel-title">
	        <a style="text-decoration:none;cursor: pointer" class="collapsed" data-toggle="collapse" data-target="#collapseThree"  aria-expanded="false" aria-controls="collapseThree">
	          Change Your Delivery Address
	        </a>
	       
	      </h4>
	    </div>
	    
	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	      <div class="panel-body">
	               
	              <div class="col-md-12" style="border:1px solid red">
	              <h4>Add New Address</h4>
	        <!-- We can not do nested form, so we do this using ajax without form tag-->
	        <!--
	               <div class="row">
	                	<div class="col-md-6">
			<div class="form-group">
				
	                     <textarea class="form-control" rows="1" id="newaddressd"></textarea>
	        </div>
	                    </div>
	                	<div class="col-md-6">
			<div class="form-group">
	<input type="button"  id="savenewaddressd" value="save address" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="btn btn-success"/>                    
	        </div>
	                    </div>
	                </div>
	              
					  
				
	          </div>
	          <br/>
	         
	          <div class="col-md-12">
	          <h4>Already Saved Address</h4>
	              <span class="address-bar">
	              	<ul style="list-style-type:none;margin-left:-50px">
	              		<?php
	              		/*
	              		$i=1;
	              		$rs2=mysql_query("select * from tblusers_address where UserID='$userid'") or die(mysql_error());
						if(mysql_num_rows($rs2)>0)
						{
							while($row2=mysql_fetch_array($rs2))
							{
								*/
								?>
								
								<li>
				    
	              	<b>Address <?php echo $i; ?> <span class="text-right"><i class="glyphicon glyphicon-edit"></i></span></b>
	                <address><i class="glyphicon glyphicon-map-marker"></i> <span class="addressspan"><?php echo $row2["Address"]; ?></span></address>
	                 <button type="button" class="btn g-back btn-block btn-success btnaddressd" title="<?php echo $row2["Address"]; ?>" data-target="#collapseThree" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseThree">Select</button>
	                 
	               </li>
								<?php
								/*
								$i++;
							}
						}
						*/
	              		?>
	              		
	               </ul>
	              </span>
	             
	              
	          </div>
	          
	 
	          
	      </div>
	    </div>
	    </div>
 </div>                            
-->
<!--code End for Delivery address -->

							  <div class="form-group">
                              <select name="city"  class="styledselect_form_1 form-control" required aria-required="true">
            				      	
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
               
                            </div>
                            
							
                            
                             <div class="form-group">
                 <input type="text" id="datepicker" class="form-control" name="pickdate" readonly="" required="" placeholder="Select Pickup Date">
                            </div>
                            
                            <!--
                               <div class="form-group bootstrap-timepicker">
                    <input id="timepicker1" type="text" class="input-small form-control" required="" readonly="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">
                   -->
                     <div class="form-group">
                   	<select name="picktime" required class="form-control" style="padding: 0px">
            									<option value="">Select Pickup Time</option>
            									<option value="08-09-AM" style="padding:10px">08-09 AM</option>
												<option value="09-10-AM" style="padding:10px">09-10 AM</option>
												<option value="10-11-AM" style="padding:10px">10-11 AM</option>
												<option value="11-12-AM" style="padding:10px">11-12 AM</option>
												<option value="12-01-PM" style="padding:10px">12-01 PM</option>
												<option value="01-02-PM" style="padding:10px">01-02 PM</option>
												<option value="02-03-PM" style="padding:10px">02-03 PM</option>
												<option value="03-04-PM" style="padding:10px">03-04 PM</option>
												<option value="04-05-PM" style="padding:10px">04-05 PM</option>
												<option value="05-06-PM" style="padding:10px">05-06 PM</option>
												<option value="06-07-PM" style="padding:10px">06-07 PM</option>
												<option value="07-08-PM" style="padding:10px">07-08 PM</option>
												<option value="08-09-PM" style="padding:10px">08-09 PM</option>
                   					</select>
                
                </div>
                              
                              <!-- 
                            <div class="form-group checkbox">
    <label>
      <input type="checkbox" onclick="SetAddress(this.checked);"> <p class="bg-info"> Check this box if Delivery Address is same as Pickup Address</p>   
       </label>
  </div>
  
                            
                              <div class="form-group">
                              	 
                               <input type="text" id="deliver_add" class="form-control" required="" name="deladdress" placeholder="Enter Your Delivery Address">
                            </div>
                            -->
                            
                            
                               	<div class="form-group">
                               	  				<select name="dtype"  class="styledselect_form_1 form-control" required class="deliverytype" onchange="chkdeliverytype(this.value)">
            									<option value="">Select Delivery Type</option>
            									<option value="normal" style="padding:10px">Normal Delivery </option>
												<option value="fast" style="padding:10px">Express Delivery </option>
												
									</select>
               
                    </div>
                    
                    <div class="form-group" >
                    	<span  style="color:red" id="dfast">   </span>
                    	</div>
                
                     <div class="form-group">
                               <input type="text"  class="form-control"  name="review" placeholder="Remarks" style="height: 95px">
                            </div>
  
      				 <div class="form-group bg-info" style="padding: 10px">
  								 	<h4> Captcha Verfication</h4>
                              	<img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
                              	 <label for='message'>Enter the code above here :</label>
                              	  <input id="captcha_code" class="form-control" placeholder="Enter the above code here" name="captcha_code" type="text" required>
       							Can't read the image? click <a href='javascript: refreshCaptcha();'> here </a> to refresh.
                              
                            </div>
                            
                            
                            <div class="mbr-buttons mbr-buttons--right">
                            	<input value="Place Order" type="submit" name="submitorder" class="btn btn-primary btn-lg btn-info">
                            	</div>
                        </form>
                        
                        <div class="col-md-12"> &nbsp;</div>
                         <div class="col-md-12"> &nbsp;</div>
                        <?php
}

}
else {
	?>
               <form method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS" name="ordern" onsubmit="return validateorderform(document.ordern.name,document.ordern.phone,document.ordern.laundry,document.ordern.dryclean)">
                            <input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
                            
                            		<div class="col-md-12">
                            			<div class="col-md-10">
                            				<h2 class="mbr-header__text text-center">YOUR ORDER DETAILS </h2>
                            				</div>
                            				<div class="col-md-2">
                           		 <input type="button" onclick="window.location.href=''" value="Reset Form!" class="btn btn-danger"><br/>
                           		 </div>
                           	</div>
                           	
                           	   <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email"  placeholder="Email*" data-form-field="Email">
                              <!--<span id="emailerr" style="color: Red; display: none">Invalid Email Address </span>-->
                            </div>
                            
                            <div class="form-group">
                                <input type="tel" class="form-control phone" name="phone" required="" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Phone" data-form-field="Phone">
                          		  
                            </div>
                            
							<div class="form-group">
                                <input type="tel" class="form-control phone2" name="phone2" pattern="[0-9]{10}" title="Enter your mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter Alternate Phone" data-form-field="Phone">
                          		  
                            </div>
                           
                           	
                            <div class="form-group">
                            	
                                <input type="text" class="form-control text-capitalize" id="ufname"  name="fname" onblur="return usname(document.ordern.name)" required="" placeholder="Name*" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>
                            </div>
                            
  	                          
                             <div class="form-group">
                            	<input type="text" class="form-control text-capitalize" id="ulname"  name="lname" required="" placeholder="Enter Last Name*" data-form-field="LastName">
                            </div>
                          
                            <?php
                           if(isset($_GET["otype"]))
						   {
						   	 $type=mysql_real_escape_string($_GET["otype"]);
							  echo "<input type='hidden' name='hiddenotype' value='".$type."'>";
						   }
                   else {
                         ?>
                                         <div class="form-group checkbox bg-info" style="padding: 5px">
                             	<h3> Order Selection</h3>
                               <label>
                               	&nbsp;
              <input type="checkbox" id="laun" value="laundry" name="laundry"> Laundry & Ironing
                             </label>
                             <br/>
                             &nbsp;
                             <label>
              <input type="checkbox" id="dry" value="dryclean"  name="dryclean"> Drycleaning
                             </label>
                             <br/>
                              <span id="chkerror" style="color: Red; display: none">Please Select at least 1 order Type </span>
                             </div>
             	     <?php
                         }
                           ?>
                           
                            <!--code start for pickup address -->
                             
 <div class="form-group">
       <input type="text" class="form-control"   id="pickadd" name="address" required="" placeholder="Enter Your Pickup Address" data-form-field="address">
          <div class="panel panel-default" id="unloginpickup" style="display:none">
          	
			    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #0042A4; color:white;">
				    <h4 class="panel-title">
					    <a style="text-decoration:none;cursor: pointer" class="collapsed paneltext" data-toggle="collapse" data-target="#collapseTwo"  aria-expanded="false" aria-controls="collapseTwo">
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
					              	 <ul style="list-style-type:none;margin-left:-50px" id="unlogin_addresslist">
					              	
					              		
					               </ul>
					             </span>
             		</div>
          
 			  </div>
    	   </div>
 	  </div>
</div>
                           

						<!--code End for pickup address -->		

                            
                            
                            <!--
                             <div class="form-group checkbox">
    <label>
      <input type="checkbox" onclick="SetAddress(this.checked);"> <p class="bg-info"> Check this box if Delivery Address is same as Pickup Address</p>   
       </label>
  </div>
  
                            
                              <div class="form-group">
                              	 
                               <input type="text" id="deliver_add2" class="form-control" required="" name="deladdress" placeholder="Enter Your Delivery Address">
                            </div>
                            -->
                            
                            
                                <div class="form-group">
                              <select name="city"  class="styledselect_form_1 form-control" required aria-required="true">
            				      	
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
               
                            </div>
               
                            
                             <div class="form-group">
                 <input type="text" id="datepicker" class="form-control" readonly=""  name="pickdate" required="" placeholder="Select Pickup Date">
                            </div>
                            
                            <!--
                               <div class="form-group bootstrap-timepicker">
                    <input id="timepicker1" type="text" class="input-small form-control" readonly="" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">
                   -->
                   <div class="form-group">
                   	<select name="picktime" required class="form-control" style="padding: 0px">
            									<option value="">Select Pickup Time</option>
            									<option value="08-09-AM" style="padding:10px">08-09 AM</option>
												<option value="09-10-AM" style="padding:10px">09-10 AM</option>
												<option value="10-11-AM" style="padding:10px">10-11 AM</option>
												<option value="11-12-AM" style="padding:10px">11-12 AM</option>
												<option value="12-01-PM" style="padding:10px">12-01 PM</option>
												<option value="01-02-PM" style="padding:10px">01-02 PM</option>
												<option value="02-03-PM" style="padding:10px">02-03 PM</option>
												<option value="03-04-PM" style="padding:10px">03-04 PM</option>
												<option value="04-05-PM" style="padding:10px">04-05 PM</option>
												<option value="05-06-PM" style="padding:10px">05-06 PM</option>
												<option value="06-07-PM" style="padding:10px">06-07 PM</option>
												<option value="07-08-PM" style="padding:10px">07-08 PM</option>
												<option value="08-09-PM" style="padding:10px">08-09 PM</option>
                   					</select>
                		</div>
                
                
           
                           
                           
                             	<div class="form-group">
                               	  				<select name="dtype" class="form-control" required style="padding: 0px" class="deliverytype" onchange="chkdeliverytype(this.value)">
            									<option value="">Select Delivery Type</option>
												<option value="normal" style="padding:10px">Normal Delivery </option>
												<option value="fast" style="padding:10px">Express Delivery </option>
									</select>
               
                    </div>
                    
                    <div class="form-group" >
                    	<span  style="color:red" id="dfast"> </span>
                    	</div>
                          
                      <div class="form-group">
                               <input type="text"  class="form-control"  name="review" placeholder="Remarks" style="height: 95px">
                            </div>
                            
  						 <div class="form-group bg-info" style="padding: 10px">
  								 	<h4> Captcha Verfication</h4>
                              	<img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
                              	 <label for='message'>Enter the code above here :</label>
                              	  <input id="captcha_code" class="form-control" placeholder="Enter the above code here" name="captcha_code" type="text" required>
       							Can't read the image? click <a href='javascript: refreshCaptcha();'> here </a> to refresh.
                              
                            </div>
                        
                            <div class="mbr-buttons mbr-buttons--right">
                            	<input value="Place Order" type="submit" name="submitorder" class="btn btn-primary btn-lg btn-info">
                            	</div>
                        </form>
                        <?php
}
?>
                     
                        <?php
			
			if(isset($_POST["submitorder"]))
		{
			$fname=mysql_real_escape_string(trim($_POST["fname"]));
			$lname=mysql_real_escape_string(trim($_POST["lname"]));
			$name=$fname." ".$lname;
			$email=mysql_real_escape_string(trim($_POST["email"]));
			$phone1=mysql_real_escape_string(trim($_POST["phone"]));
			$phone2=mysql_real_escape_string(trim($_POST["phone2"]));
			$phone=(empty($phone1)) ? $phone2:$phone1;
			
			//$ord_dry=trim($_POST["dryclean"]);
			//$ord_laun=trim($_POST["laundry"]);
			
			$ord_type=(mysql_real_escape_string($_POST["hiddenotype"]))?mysql_real_escape_string($_POST["hiddenotype"]):mysql_real_escape_string($_POST["laundry"]);
			$ord_type2=(mysql_real_escape_string($_POST["dryclean"]))?mysql_real_escape_string($_POST["dryclean"]):"";
			
			$city=mysql_real_escape_string($_POST["city"]);
			$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
			$pickdate=mysql_real_escape_string(trim($_POST["pickdate"]));
			$picktime=mysql_real_escape_string(trim($_POST["picktime"]));
			
			$delivery_add=mysql_real_escape_string(trim($_POST["address"]));
			$delivery_type=mysql_real_escape_string($_POST["dtype"]);
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			
			$order_via='website';
			$createdby="user";
			
			$uid="";
			$query="";
			
			$subtype=mysql_real_escape_string(trim($_POST["laundry"]));
			
			if(isset($_POST["subtype"]))
			{
				$ussubstype=mysql_real_escape_string(trim($_POST["subtype"]));
			}
			else {
				$ussubstype=0;
			}
			
			

			
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
	$result2=mysql_query("insert into tblusers(UserFirstName,UserLastName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$fname','$lname','$email','$phone1','$upass','$pickup_address','$regdate','$uevstatus','$usertype','$ucreatedby')");
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
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$msg[]="The Validation code does not match!";// Captcha verification is incorrect.		
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
				
				//echo "user id is:".$uid;					
	
		if($ord_type=="trial_laundry")
		 {
				$chk=mysql_query("select * from tbl_orders where OrderEmail='$email' and OrderType='trial_laundry'");
				if(mysql_affected_rows())
				 {
					?>
						<script>
						alert("Sorry Your Request Could not Processed. You have already taken the trial. Please subscribe the package or place an standard order online or call us at +919718661177");
						</script>
					<?php
				 }
							
				else
				 {
					submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);	
				 }
		 }
	
		elseif($ord_type=="laundry" and $ord_type2=="dryclean")
		{
			submit_order($uid,$name,'laundry',$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
			submit_order($uid,$name,'dryclean',$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
		
			elseif($ord_type=="subscription" and $ord_type2=="dryclean")
		{
			submit_order($uid,$name,'subscription',$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
			submit_order($uid,$name,'dryclean',$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
	
		
		
		elseif($ord_type2=="dryclean")
		{
			
			
			submit_order($uid,$name,$ord_type2,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
		
		
		elseif($ord_type=="laundry")
		{
			
			submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}

	
	
	
		
			elseif($ord_type=="subscription")
		{
			submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
				
			elseif($ord_type=="standard_laundry")
		{
		 		submit_order($uid,$name,$ord_type,$email,$phone,$city,$pickup_address,$pickdate,$picktime,$order_status_id,$delivery_add,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
		

	
	}
	
}

				?>	
                    </div>
                    
                    <div class="col-md-12"> &nbsp; </div>
                    <div class="col-md-12"> &nbsp; </div>
                        
                </div>
            </div>
        </div>
    </div>
</section>





	
<?php
include 'footer.php';
?>