<?php
include 'header.php';
require 'class.phpmailer.php';
require 'class.smtp.php';
?>

<title>Laundry Service & Dry Cleaning Rates | Laundry cleaning Services Rates in Noida</title>
<meta name="description" content="Best dry cleaning and laundry service rates , list here the rate of ironing and laundry cleaning service rates in noida Ghaziabad  ">

<script>
$(document).ready(function(){

	$("#sms").addclass('hidden');
	
});

</script>

<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Forgot Password</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Forgot Password</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-md-12">
 						 <?php
 						    if(isset($_POST["btnforgot"]))
						   {
						   	$loginid=mysql_real_escape_string(trim($_POST["loginid"]));
							$otp=mt_rand(10000, 999999); //randomly gemerate password
							$_SESSION["verified"]=0;
							
							$str3="<table align='center' border='0' cellpadding='0' cellspacing='0' width='580'>
									<tbody>
									<tr>
									<td style='border: 1px solid #d8d8d8; border-radius: 5px;' bgcolor='#fff'>
										 <table align='center' border='0' cellpadding='0' cellspacing='0' width='540'>
									<tbody>
									<tr>
									<td height='23'>&nbsp;</td>
									</tr>
									<tr>
									<td>
										<a style='text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; color: #6ac451;' target='_blank'>
											<img src='https://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png' alt='Laundry Bucket' border='0'></a>
											</td>
									</tr>
									<tr>
									<td height='23'>&nbsp;</td>
									</tr>
									<tr>
									<td style='background: #cecece; height: 1px; line-height: 1px; font-size: 1px;'>&nbsp;</td>
									</tr>
									<tr>
									<td height='23'>&nbsp;</td>
									</tr>
									
									<tr>
									<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Dear User, </strong> </td>
									</tr>
									<tr>
									<td height='23'>&nbsp;</td>
									</tr>
									
									<tr>
									<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'>We received a request to reset the password for your LaundryBucket account.<br/>
									If you want to reset your password, Use the given OTP.
									
									 </td>
									</tr>
									
									<tr>
									<td height='23'>&nbsp;</td>
									</tr>
									 
									 <tr>
									<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Your One Time Password is(OTP):</strong><br>". $otp. "<br> </td>
									</tr>
									 
									<tr><td height='23'>&nbsp;</td></tr><tr><td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;' valign='top'> Regards,<br>Team Laundry Bucket Website.</td>
									</tr><tr><td height='23'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table>";
							  
								  $check_email_query="select * from tblusers WHERE UserEmail='$loginid' or UserPhone='$loginid'";
	   							  $result=mysql_query($check_email_query);	
	   							  if(mysql_num_rows($result)>0)      // if any record(useremail or usermobile no) entry found ..then match password and login the user
								 {
								 	$r2=mysql_fetch_array($result);
									$usemail=$r2["UserEmail"];
									$usmob=$r2["UserPhone"];
									
									if($loginid==$usemail)
									{
										$mail = new PHPMailer(); // create a new object
										$mail->IsSMTP(); // enable SMTP
										$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
										$mail->SMTPAuth = true; // authentication enabled
										$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
										$mail->Host = "mail.laundrybucket.co.in";
										$mail->Port = 465; // or 587
										$mail->IsHTML(true);
										$mail->Username = "bucket@laundrybucket.co.in"; //gmail email here
										//$mail->FromName = 'Laundry Ticket';
										$mail->Password = "Admin111***"; //gmail password here
										$mail->SetFrom("bucket@laundrybucket.co.in","Laundry Bucket"); //from Address here
										//$mail->AddReplyTo($email, 'Laundry Ticket');
										$mail->Subject = "Your laundrybucket One Time Password(OTP)";
										$mail->Body = $str3;
										$mail->AddAddress($usemail); //Email to
										//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
										
										if($mail->Send())
									    {
									    //echo "<p style='padding:10px;' class='bg bg-info'>Message Sent Successfully</p>";
									    $_SESSION["otp"]=$otp;
										$_SESSION["loginid"]=$usemail;
										$_SESSION["verified"]=1;
										echo "<script>window.location.href='verifyotp.php';</script>";
										//header("location:verifyotp.php");
										
										
										 }
										 
										 else
									    {
									       //echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
									       ?>
													 <div class=" row alert alert-success fade in">
									    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									    <strong> </strong> Email cannot send
									  </div>
													<?php
									    }
										 
									}
									
									elseif($loginid==$usmob)
									{
										//$utxtmsg="Dear%20Welcome%20Back!%20You%20to%20Laundry%20Bucket%20and%20Your%20Login%20Password%20is=".$uppass;
										//$txtmsg=urlencode("Dear welcome back to Laundry Bucket and your login Password is = $otp  Thanks to Visit our website.");
										$txtmsg=urlencode("Your Laundry Bucket OTP is- $otp . Use it to verify your identity and update your password.");
										?>
										<span id="sms" style="display: none"> 
										<?php
										$ch = curl_init();
									// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
									 	$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$usmob&sender=BUCKET&message=$txtmsg";
									 	
									 	curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_exec($ch);
										curl_close($ch);
										
										?>
														</span>
										<?php
										 $_SESSION["otp"]=$otp;
										 $_SESSION["loginid"]=$usmob;
									     $_SESSION["verified"]=1;
										 echo "<script>window.location.href='verifyotp.php';</script>";
									     //header("location:verifyotp.php");
									     
									}		
								 }
								 
								 else
								{
									?>
										 <div class=" row alert alert-warning fade in">
						    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						    <strong> </strong>You are not a registered user. Please <a href="signup.php" style="color:rgb(1, 111, 199); text-decoration:none; border-bottom:2px solid rgb(1, 111, 199);border-radius:20px; background-color: transparent">SignUp to Laundry Bucket </a>
						  </div>
										<?php	
									//echo "<p class='text-warning'>This email does not exist. Please request for Password by clicking on link </p>";	
								}	
			
						   }
						   ?>
						   
								   
		 						<h2 class="section-heading">
								Forgot your Password
							</h2>
						</div>
		 	            <div class="col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-12">
					
						 <div class="free-quote"> 
						 	<h2 class="section-heading-2 color_white">
								Forgot Password  <i class="fa fa-user"></i>
							</h2>
		 	               <form method="post" class="form-contact">
						
							 <div class="form-group iconinput">
							 	<input type="text" name="loginid"  class="form-control" id="uemail" placeholder="Your Email or Mobile..." required="">
								<span><i class="fa fa-envelope"></i></span>
								<div class="help-block with-errors"></div>
		                    	 
	    					 </div>
	    					 
		    				<div class="form-group">
								<div id="success"></div>
								<button type="submit" class="btn btn-primary" name="btnforgot" id="btnsave">Reset Password</button>
		                   		
		                    </div>
	                   
	                        
						</form>

 					</div>
 				</div>		
				
		    </div>
		  
			<div class="col-md-4 col-sm-12 col-lg-12 col-xs-12">
			</div>
						
		</div>		
	 </div>	
  	 
  	 
<?php
include 'footercta.php';
include 'footer.php';
?>	 
  	  	