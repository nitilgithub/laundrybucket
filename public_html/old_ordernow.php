﻿	<?php
include 'header.php';
header('Access-Control-Allow-Origin: *');
include 'connection.php';
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
</style>
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<!--
<script>

	function SetAddress(checked) {
	if (checked) {
    	document.getElementById('deliver_add').value = document.getElementById('pickadd').value;    
          $('#deliver_add').attr('readonly', true);
	 
	} 
	else {
        
		  $('#deliver_add').attr('readonly', false);
		document.getElementById('deliver_add').value = ''; 
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


function send_adminmessage($name,$ord_type,$phone,$address)
{

$adminsms=urlencode("Laundry Order Detail: Name: $name, Ph: $phone , Type: $ord_type , Add: $address Thanks.");
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

<section class="mbr-section mbr-section--relative mbr-section--fixed-size mbr-parallax-background" id="form1-22" style="margin-top:28px;background-image: url(assets/images/img-65803888x2592-131.jpg);">
    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(34, 34, 34);"></div>
    <div class="mbr-section__container mbr-section__container--std-padding container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2" data-form-type="formoid">
                    	
                        <div class="mbr-header mbr-header--center mbr-header--std-padding">
                        	
                            <h2 class="mbr-header__text">YOUR ORDER DETAILS </h2>
                            <?php

function submit_order($uid,$name,$ord_type,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby)
{
	$usermessage = file_get_contents('email_template/userorder.html');
	$adminmessage = file_get_contents('email_template/adminorderemail.html');
	
			
		$result=mysql_query("insert into tbl_orders(OrderType,OrderUserId,User_Subsid,OrderShipName,OrderEmail,OrderPhone,OrderCity,OrderShipAddress,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review,Order_Via,CreatedBy) values('$ord_type','$uid','$ussubstype','$name','$email','$phone','$city','$address','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$remarks','$order_via','$createdby')") or die(mysql_error());
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
$usermessage = str_replace('%address%', $address, $usermessage);							


// Replace the % with the actual information for sending email to Admin id
$adminmessage = str_replace('%client-name%', $name, $adminmessage);
$adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
$adminmessage = str_replace('%client-email%', $email, $adminmessage);
$adminmessage = str_replace('%client-mobile%', $phone, $adminmessage);
$adminmessage = str_replace('%ordertype%', $ord_type, $adminmessage);
$adminmessage = str_replace('%pickdate%', $pickdate, $adminmessage);
$adminmessage = str_replace('%picktime%', $picktime, $adminmessage);
$adminmessage = str_replace('%city%', $city, $adminmessage);			
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
$mail->AddAddress("laundrybucket1988@gmail.com"); //Email t0 testadmin@laundrybucket.co.in

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
    
    
	send_clientmessage($ordid,$pickdate,$picktime,$name,$phone);
	   
	    send_adminmessage($name,$ord_type,$phone,$address);
		
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
if(mysql_real_escape_string($_SESSION["userloginstatus"]==1))
{
	$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($result);
	$userid=$row["UserId"];
	
?>

            
               
                          <form method="post" data-form-title="PROVIDE YOUR PICK UP DETAILS" name="ordern" onsubmit="return validateorderform(document.ordern.name,document.ordern.phone,document.ordern.laundry,document.ordern.dryclean)">
                            <input type="hidden" value="6H50uNkmkicfaj9R3ES/7SG6674QJObvsCo4vcoF9BaYt6FYAdBOD/7NF1AyIMy5aKhnr8n+ZoOm+BIVJoQw1r6Ixrkqmx9bfRt1vuOvd0MA8CP4KHfc0lTEL/giMBND" data-form-email="true">
                            <div class="form-group">
                            	
                                <input type="text" class="form-control" value="<?php echo $row["UserFirstName"]; ?>"  name="name" onblur="return usname(document.ordern.name)" required="" placeholder="Name*" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>
                            </div>
                            
                            
                            <div class="form-group">
                                <input type="email" class="form-control" value="<?php echo $row["UserEmail"]; ?>" name="email"  placeholder="Email*" data-form-field="Email">
                              <!--<span id="emailerr" style="color: Red; display: none">Invalid Email Address </span>-->
                            </div>
                            
                            <div class="form-group">
                                <input type="tel" class="form-control" value="<?php echo $row["UserPhone"]; ?>" name="phone" required="" onblur="return phonenumber(document.ordern.phone)" data-inputmask="'mask' : '9999999999'" placeholder="Phone" data-form-field="Phone">
                                            <span id="error" style="color: Red; display: none">Please Enter Valid 10 Digits Phone Number </span>
                            </div>
                            
                          
                            <?php
                           if(isset(mysql_real_escape_string($_GET["otype"])))
						  {
						   if(mysql_real_escape_string($_GET["otype"]=="laundry"))
						   {
						   	?>
						   	<script>
						 	$(function()
						 	{
						 		
						 			var strurl="https://laundrybucket.co.in/fetch_subscription.php?uid="+<?php echo mysql_real_escape_string($_SESSION["uid"]); ?>;
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
                            
                            
                             <div class="form-group">
                               <input type="text" class="form-control" value="<?php echo $row["UserAddress"]; ?>" id="pickadd" name="address" required="" placeholder="Enter Your Pickup Address" data-form-field="address">
                            </div>


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
                   	<select name="picktime" class="form-control" style="padding: 0px">
            									<option value="">Select Pickup Time</option>
            									
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
                               	  				<select name="dtype"  class="styledselect_form_1 form-control" class="deliverytype" onchange="chkdeliverytype(this.value)">
            									<option value="-1">Select Delivery Type</option>
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
                            	<input value="Place Order" type="submit" name="submit" class="btn btn-primary btn-lg btn-info">
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
                            <div class="form-group">
                            	
                                <input type="text" class="form-control"  name="name" onblur="return usname(document.ordern.name)" required="" placeholder="Name*" data-form-field="Name">
                            <span id="nameerr" style="color: Red; display: none">Characters only </span>
                            </div>
                            
                            
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"  placeholder="Email*" data-form-field="Email">
                              <!--<span id="emailerr" style="color: Red; display: none">Invalid Email Address </span>-->
                            </div>
                            
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" required="" onblur="return phonenumber(document.ordern.phone)" data-inputmask="'mask' : '9999999999'" placeholder="Phone" data-form-field="Phone">
                                            <span id="error" style="color: Red; display: none">Please Enter Valid 10 Digits Phone Number </span>
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
                           
                                        
                             <div class="form-group">
                               <input type="text" class="form-control"  id="pickadd" name="address" required="" placeholder="Enter Your Pickup Address" data-form-field="address">
                            </div>
                            
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
                 <input type="text" id="datepicker" class="form-control" readonly=""  name="pickdate" required="" placeholder="Select Pickup Date">
                            </div>
								<!--                            
                               <div class="form-group bootstrap-timepicker">
                    <input id="timepicker1" type="text" class="input-small form-control" readonly="" required="" name="picktime" placeholder="Enter Pickup Time: eg-4:00AM">-->
                   <div class="form-group">
                   	<select name="picktime" class="form-control" style="padding: 0px">
            									<option value="">Select Pickup Time</option>
            									
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
                               	  				<select name="dtype" class="form-control" style="padding: 0px" class="deliverytype" onchange="chkdeliverytype(this.value)">
            									<option value="-1">Select Delivery Type</option>
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
                            	<input value="Place Order" type="submit" name="submit" class="btn btn-primary btn-lg btn-info">
                            	</div>
                        </form>
                        <?php
}
?>
                     
                        <?php
			
			if(isset($_POST["submit"]))
		{
			
			$name=mysql_real_escape_string(trim($_POST["name"]));
			$email=mysql_real_escape_string(trim($_POST["email"]));
			$phone=mysql_real_escape_string(trim($_POST["phone"]));
			
			//$ord_dry=trim($_POST["dryclean"]);
			//$ord_laun=trim($_POST["laundry"]);
			
			$ord_type=(mysql_real_escape_string($_POST["hiddenotype"]))?mysql_real_escape_string($_POST["hiddenotype"]):mysql_real_escape_string($_POST["laundry"]);
			$ord_type2=(mysql_real_escape_string($_POST["dryclean"]))?mysql_real_escape_string($_POST["dryclean"]):"";
			
			$city=mysql_real_escape_string($_POST["city"]);
			$address=mysql_real_escape_string(trim($_POST["address"]));
			$pickdate=mysql_real_escape_string(trim($_POST["pickdate"]));
			$picktime=mysql_real_escape_string(trim($_POST["picktime"]));
			
			$delivery_type=mysql_real_escape_string($_POST["dtype"]);
			$order_status_id=0; // here order status zero means Order is Ready for Pickup store in table tbl_orderstatus_id
			
			$order_via='website';
			$createdby="user";
			
			$uid="";
			
			$subtype=mysql_real_escape_string(trim($_POST["laundry"]));
			
			if(isset(mysql_real_escape_string($_POST["subtype"])))
			{
				$ussubstype=mysql_real_escape_string(trim($_POST["subtype"]));
			}
			else {
				$ussubstype=0;
			}
			
			

			
/*Start In this code section we are getting userid if user have account and placing order without login*/
		if(!isset(mysql_real_escape_string($_SESSION["userloginstatus"])))
{
	$result=mysql_query("select * from tblusers where((UserEmail='$email'&&UserEmail!='') OR UserPhone='$phone')") or die(mysql_error());
if(mysql_num_rows($result)>0)
{
	$row=mysql_fetch_array($result);
	$uid=$row["UserId"];		//fetch userid if user have not login and have account
	if($row["UserPhone"]!=$phone)
	{
		$result1=mysql_query("update tblusers set UserPhone2='$phone' where UserId='$uid'");
    }
}
else {
	//$uid=0;   //userid will be set to zero if user doesnot have account
	$upass=md5(rand(1111,9999));
	$regdate=date("Y-m-d");
	$ucreatedby="UserOrder";
	$uevstatus=1;
	$usertype="websiteuser";
	$result2=mysql_query("insert into tblusers(UserFirstName,UserEmail,UserPhone,UserPassword,UserAddress,UserRegistrationDate,UserEmailVerified,UserType,CreatedBy) values('$name','$email','$phone','$upass','$address','$regdate','$uevstatus','$usertype','$ucreatedby')");
	if(mysql_affected_rows())
	{
		$uid=mysql_insert_id();
    }
	else
	{
		$uid=0;
	}
}

}			
else {
	$uid=mysql_real_escape_string($_SESSION["uid"]);  //userid if user is placing order after login to account
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
					submit_order($uid,$name,$ord_type,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);	
				 }
		 }
	
		elseif($ord_type=="laundry" and $ord_type2=="dryclean")
		{
			submit_order($uid,$name,'laundry',$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
			submit_order($uid,$name,'dryclean',$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
		
			elseif($ord_type=="subscription" and $ord_type2=="dryclean")
		{
			submit_order($uid,$name,'subscription',$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
			submit_order($uid,$name,'dryclean',$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
	
		
		
		elseif($ord_type2=="dryclean")
		{
			
			
			submit_order($uid,$name,$ord_type2,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
		
		
		elseif($ord_type=="laundry")
		{
			
			submit_order($uid,$name,$ord_type,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}

	
	
	
		
			elseif($ord_type=="subscription")
		{
			submit_order($uid,$name,$ord_type,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
		}
				
			elseif($ord_type=="standard_laundry")
		{
		 		submit_order($uid,$name,$ord_type,$email,$phone,$city,$address,$pickdate,$picktime,$order_status_id,$delivery_type,$remarks,$remarksby,$remarksbyid,$ussubstype,$order_via,$createdby);
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