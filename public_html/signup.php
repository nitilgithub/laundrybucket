<?php include('header.php');
require 'class.phpmailer.php';
require 'class.smtp.php'; ?>
	<!-- BANNER -->
	<title>Best laundry service & Laundry pickup service in Indirapuram </title> 

	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Sign Up</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Sign Up</li>
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
					<h2 class="section-heading">
						Signup for Laundry Bucket
					</h2>
				</div>
				<div class="col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2 col-xs-12">
					 
					<div class="free-quote">
						<h2 class="section-heading-2 color_white">
							Create an account  <i class="fa fa-user"></i>
						</h2>
						
						<form class="form-contact" id="signup" method="post" onsubmit="return validateForm()"><!-- id="contactForm" data-toggle="validator">-->
							<div class="form-group iconinput">
								
								<input type="text" class="form-control" id="fname" name="ufname" placeholder="First Name..." required="">
								<span><i class="fa fa-user"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="text" class="form-control" id="lname" name="ulname" placeholder="Last Name..." required="">
								<span><i class="fa fa-male"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="email" class="form-control" id="uemail" name="uemail" placeholder="Your Email..." required="">
								<span><i class="fa fa-envelope"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="password" class="form-control" id="password" name="upwd" placeholder="Your Password..." required="">
								<span><i class="fa fa-lock"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="password" class="form-control" name="confirmpass" id="rpassword" placeholder="Confirm Password..." required="">
								<span><i class="fa fa-key"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group iconinput">
								
								<input type="text" id="mobile" maxlength="10" pattern="[0-9]{10}" class="form-control" name="uph" placeholder="Mobile Number..." required="">
								<span><i class="fa fa-phone"></i></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<select class="form-control" id="reference" name="reference" placeholder="How you know about us..." required="">
									<option value="">-Select-</option>
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
							
							<div class="form-group">
								<div id="success"></div>
								<button type="submit" class="btn btn-primary" name="btnsignup">SIGN UP</button>
							</div>
						</form>
						
					</div>

				</div>

			</div>

		</div>
	</div>
<?php
				
				$url="";
				if(isset($_POST["btnsignup"]))
				{
					$op=1;
					$uid=2;
					$utype="websiteuser";
					$uemail=mysql_real_escape_string($_POST['uemail']);
					$upwd=mysql_real_escape_string(md5($_POST['upwd']));
					$ufname=mysql_real_escape_string($_POST['ufname']);
					$ulname=mysql_real_escape_string($_POST['ulname']);
					$udob=mysql_real_escape_string($_POST['udob']);
					$usex=mysql_real_escape_string($_POST['usex']);
					$ucity=mysql_real_escape_string($_POST['ucity']);
					$ustate=mysql_real_escape_string($_POST['ustate']);
					$reference=mysql_real_escape_string($_POST['reference']);
					$uzip=125055;
					
					$uev=0;
					//$uvcode="NA";
					
						$uvmob=rand(1111,9999);
						$uvcode=md5($uvmob);
					
					$uip=$_SERVER['SERVER_ADDR'];
					$uph=mysql_real_escape_string($_POST['uph']);
					$ufax=016666-290399;
					$uc="India";
					$uadd=rawurlencode(mysql_real_escape_string($_POST['uadd']));
					$ua=0;
					$uuby=0;
					$uremark=0;
					$ucreatedby="user";
					$franchiseid=1;
					$reftxt="";
				
				$return_arr = array();	

$query="call spUsers($op,$uid,'$utype','$uemail','$upwd','$ufname','$ulname','$udob','$usex','$ucity','$ustate','$uzip','$uev',
'$uvcode','$uip','$uph','$ufax','$uc','$uadd','$ua',$uuby,'$uremark','$ucreatedby','$reference','$reftxt','$franchiseid')";
//echo "$query";	

				$result=mysql_query($query);
					if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			
			$row_array['op'] = $row['OP'];
			$row_array['status'] = $row['Status'];
			$row_array['ts'] = $row['TS'];
			$ts=$row['TS'];
			
			if(($op==4 || $op==7) && $ts==1 )
			{
				
				
				$row_array['uid']=$row['UserID'];
				$row_array['utype']=$row['UserType'];
				$row_array['uemail']=$row['UserEmail'];
				$row_array['upwd']=$row['UserPassword'];
				$row_array['ufname']=$row['UserFirstName'];
				$row_array['ulname']=$row['UserLastName'];
				$row_array['udob']=$row['UserDOB'];
				$row_array['usex']=$row['UserSex'];
				$row_array['ucity']=$row['UserCity'];
				$row_array['ustate']=$row['UserState'];
				$row_array['uzip']=$row['UserZip'];
				$row_array['uev']=$row['UserEmailVerified'];
				$row_array['urdate']=$row['UserRegistrationDate'];
				$row_array['uvcode']=$row['UserVerificationCode'];
				$row_array['uip']=$row['UserIP'];
				$row_array['uph']=$row['UserPhone'];
				$row_array['ufax']=$row['UserFax'];
				$row_array['uc']=$row['UserCountry'];
				$row_array['uadd']=$row['UserAddress'];
				$row_array['ua']=$row['UserAddress2'];
				$row_array['uuby']=$row['UpdatedBy'];
				$row_array['uudate']=$row['RecordUpdatedDate'];
				$row_array['uremark']=$row['UpdateRemarks'];
				$row_array['uremark']=$row['UpdateRemarks'];
				

				
			}
			if($op==1 && $ts==1 )
			{
				
		 
			$_SESSION["uemail"]=$uemail;
			$_SESSION["uph"]=$uph;
		
		$txtmsg=urlencode("Your Laundry Bucket OTP is- $uvmob . Use it to verify your identity and update your password.");
		$_SESSION[usph]=$uph;
		?>
		
		<span id="sms" style="display: none"> 
						<?php
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uph&sender=BUCKET&message=$txtmsg";
    ?>
    
						
										 <?php
										curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_exec($ch);
										curl_close($ch);
		
								?>
						</span>	
			<?php
   
   $str2="<table align='center' border='0' cellpadding='0' cellspacing='0' width='580'>
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
<td style='color:#0043a5;font-size:17px;margin:0!important;line-height:17px;font-family:Arial,Helvetica,sans-serif'><strong style='text-align:center'>
Thanks for signing up with us ! </strong> </td>
</tr>

<tr>
<td height='23'>&nbsp;</td>
</tr>

<tr>
<td style='color:#666666;font-size:15px;margin:0!important;line-height:17px;font-family:Arial,Helvetica,sans-serif'>

Your account has been created, Please Activate your account for login  by pressing the url below.

 </td>
</tr>

<tr>
<td height='23'>&nbsp;</td>
</tr>

<tr>
<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>
Please click this link to activate your account:</strong><br> 
<a href='https://laundrybucket.co.in/verify.php?email=$uemail&hash=$uvcode'>https://laundrybucket.co.in/ab=78hjhjd564=8iui-hjhjbnb=ouiu</a>
<br> </td>
</tr>
<tr>
<td height='23'>&nbsp;</td>
</tr>
 
 
 
<tr><td height='23'>&nbsp;</td></tr><tr><td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;' valign='top'> <br> Laundry Bucket Website.</td>
</tr><tr><td height='23'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table>";

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
								$mail->Subject = "Laundry Bucket Account Activation";
								$mail->Body = $str2;
								$mail->AddAddress($uemail); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');		
	
 if($mail->Send())
    {
    //echo "<p style='padding:10px;' class='bg bg-info'>Message Sent Successfully</p>";
    }
    else
    {
     // echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
    }	
    
	?>				
					
						<script>
							
						alert("Your Account Created Successfully");
						window.location.href="thankusignup.php";
						
						</script>
					
						<?php
   
			}

else {
	?>
						<script>
						alert("User Already Exist");
						</script>
						<?php
}
		}
	}
 	
	}
				
				?>
				
<?php include('footercta.php'); ?>
<script type="text/javascript">
	function validateForm()
  {
  	//alert("ok");
  	
  	var nameRegex = /^[A-Za-z]{3,20}$/;
  	var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
  	var mobileRegex = /^[789]\d{9}$/;
  	 var fname= document.getElementById("fname").value; 
  	 var lname= document.getElementById("lname").value;
  	 var femail= document.getElementById("uemail").value;
  	 var fpassword= document.getElementById("password").value;
  	 var rpassword= document.getElementById("rpassword").value;
  	 var mob= document.getElementById("mobile").value;

if (fname=="")  
{  
//document.getElementById("fname").focus();	
alert("Please Enter First Name");  
return false;  
} 
 else if(!nameRegex.test(fname))
   {
   document.getElementById("fname").focus();
     alert("Invalid first name");
     return false;
   }

if (lname=="")  
{  
document.getElementById("lname").focus();	
alert("Please Enter Last Name");  
return false;  
} 
 else if(!nameRegex.test(lname))
   {
   	 document.getElementById("lname").focus();
     alert("Invalid Last name");
     return false;
   } 
    
if (femail=="")  
{  
document.getElementById("lname").focus();	
alert("Please Enter Email Name");  
return false;  
} 
 else if(!emailRegex.test(femail))
   {
   	 document.getElementById("lname").focus();
     alert("Invalid Last name");
     return false;
   }
   
if(fpassword=="")
{
	document.getElementById("password").focus();
	alert("Please Enter Your Password");
	return false;
}

 else if(rpassword=="")
 {
 	document.getElementById("rpassword").focus();
 	alert("Confirm Password can not be empty");
 	return false;
 }
 
 else if(fpassword!=rpassword)
 {
 	document.getElementById("rpassword").focus();
 	alert("Password Mismatch");
 	return false;
 }
 
 if(mob=="")
 {
 	document.getElementById("mobile").focus();
 	alert("Please Enter Mobile no");
 	return false;
 }
 else if(!mobileRegex.test(mob))
 {
 	document.getElementById("mobile").focus();
 	alert("Invalid Mobile No");
 	return false;
 }



}
</script>		 
<?php include('footer.php'); ?>