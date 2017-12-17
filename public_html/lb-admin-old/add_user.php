<?php
include 'header.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
?>

   <div class="right_col" role="main">

 <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Users</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>
       
      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Add New User </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                       
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
    							
    							
    							      
                                   <?php
		if(isset($_POST["btnsave"]))
		{
			$op=1;
			$uid=2;
			$utype="websiteuser";
			$ufname=mysql_real_escape_string($_POST["crfname"]);
			$ulname=mysql_real_escape_string($_POST["crlname"]);
			$uemail=mysql_real_escape_string($_POST["cremail"]);
			$uph=mysql_real_escape_string($_POST["crmobile"]);
			$upwd=mysql_real_escape_string(md5($_POST['upwd']));
				$udob=mysql_real_escape_string($_POST['udob']);
					$usex=mysql_real_escape_string($_POST['usex']);
					$ucity=mysql_real_escape_string($_POST['ucity']);
					$ustate=mysql_real_escape_string($_POST['ustate']);
					$uzip=125055;
					$uev=1;
					//$uvcode="NA";
					$uvmob=rand(1111,9999);
					$uvcode=md5($uvmob);
					
					$uip=$_SERVER['SERVER_ADDR'];
					
					$ufax=016666-290399;
					$uc="India";
					//$uadd=rawurlencode($_POST['uadd']);
					$uadd=mysql_real_escape_string($_POST['uadd']);
					$ua=0;
					$uuby=0;
					$uremark=0;
					$ucreatedby="admin";


	
				$return_arr = array();	

$query="call spUsers($op,$uid,'$utype','$uemail','$upwd','$ufname','$ulname','$udob','$usex','$ucity','$ustate','$uzip','$uev',
'$uvcode','$uip','$uph','$ufax','$uc','$uadd','$ua',$uuby,'$uremark','$ucreatedby')";
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
				//echo "Working";
		
		$txtmsg=urlencode("Your Laundry Bucket OTP is- $uvmob . Use it to verify your identity and update your password.");
		
		?>
		
		<span id="sms" style="display: none"> 
						<?php
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uph&sender=BUCKET&message=$txtmsg"
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
<a href='https://laundrybucket.co.in/verify.php?email=$uemail&hash=$uvcode'>https://laundrybucket.co.in/verify.php?email=.$uemail.&hash=.$uvcode.</a>
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
   // echo "<p style='padding:10px;' class='bg bg-info'>Message Sent Successfully</p>";
    }
    else
    {
      // echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
    }	
    
	?>
						<script>
						alert("User Added Successfully");
						//window.location.href="thankusignup.php";
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

	
					
?>
<span class="section"> &nbsp;</span>
<?php

}
	?>
                   
    							
                                   	
                                   
                                    <form method="post" role="form" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validation()">
                                    
                                              
                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">First Name <span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="crfname" id="fname" required="" class="form-control col-md-7 col-xs-12" placeholder="Enter User First Name"/>
                                        
                                            </div>
                                        </div>
                                      
            								&nbsp;
            							
            							
            							  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Last Name <span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="text" name="crlname" id="lname" required="" class="form-control col-md-7 col-xs-12" placeholder="Enter User Last Name"/>
                                        
                                            </div>
                                        </div>
                                      
            								&nbsp;
            								
            								
            								
            								  <div class="item form-group" id="usemail">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Email
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="email"  name="cremail" id="email"  class="form-control col-md-7 col-xs-12" placeholder="Enter User Email (Optional)"/>
                                        
                                            </div>
                                        </div>
                                        
                                     					&nbsp;
                                                    								
            								  <div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Mobile <span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                        <input type="tel" name="crmobile"  id="mobile" required="" pattern="[0-9]{10}" title="Enter valid 10 digit mobile number"  data-inputmask="'mask' : '9999999999'" placeholder="Enter User Mobile No" class="form-control col-md-7 col-xs-12"/>
                                        
                                            </div>
                                        </div>
                                     
                                     
                                     
                                     
                                     					&nbsp;
                                                    								
            								  <div class="item form-group" id="usmobile">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Password <span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                   <input type="password" name="upwd" required="" id="password" class="form-control"  placeholder="Enter user Password" />       
                                            </div>
                                        </div>
                                     
                                     
                                     
                                     					&nbsp;
                                                    								
            								  <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itname">Confirm Password <span>*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                           
                                         <input type="password" name="confirmpass" id="rpassword" class="form-control" placeholder="Enter  user Pasword again" />
                                        
                                            </div>
                                        </div>
                                     
                                        &nbsp;
                                        
                                           <div class="item form-group">
            				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">  Address <span>*</span> </label>
            				
            				                <div class="col-md-6 col-sm-6 col-xs-12">
            				<input type="text" name="uadd" id="address" required="" class="form-control" Placeholder="Enter User complete Address" /> 
            				</div>
            				</div>   
            		
            		 &nbsp;
                    <div class="item form-group">
            				
            				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">  City <span>*</span> </label>
            				
            				<div class="col-md-6 col-sm-6 col-xs-12">
            				<input type="text" list="city" name="ucity" id="city" class="form-control"  Placeholder="Enter User city (Noida, Gaziabaad)">
            					<datalist id="city">
							    <option value="Gaziabad" />
							    <option value="Noida" />
							  </datalist>
            				</input>
            				</div>
            				</div>
            				
            				 &nbsp; 
            				 
                             <div class="item form-group">
            				
            				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">  State <span>*</span> </label>
            				<div class="col-md-6 col-sm-6 col-xs-12">
            				<input type="text" list="state" name="ustate" id="state"  class="form-control" Placeholder="Enter User  State (UP Only)" >
            				 	<datalist id="state">
							    <option value="UP" />
							  
							  </datalist>
            				</input>
            				</div>
                              </div>       
                                        &nbsp;
             
             				
            			
                               
            			
                                        <div class="ln_solid"> </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                
                                                <input type="submit" name="btnsave" class="btn btn-success" value="Submit"/>&nbsp;
                                            </div>
                                        </div>
                                    </form>
                                   
                             
                                   
                                
                                </div>
                                                
                                            
                                            
                                        

                                </div>
                            </div>
                            </div>
                            </div>
                            
                            
                            
<script type="text/javascript">
	function validation()
  {
 // var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
  var mobileRegex = /^[789]\d{9}$/;
  var nameRegex = /^[A-Za-z]{3,20}$/;
  var fname= document.getElementById("fname").value;
  var lname= document.getElementById("lname").value;
  var femail= document.getElementById("email").value;
  var fpassword= document.getElementById("password").value;
  var rpassword= document.getElementById("rpassword").value;
  var mob= document.getElementById("mobile").value;
  
 if( fname == "" )
   {
     document.getElementById("fname").focus();
     alert("Enter the first name");
     return false;
   } else if(!nameRegex.test(fname))
   {
   	 document.getElementById("fname").focus();
     alert("Invalid first name");
     return false;
   }
 if( lname == "" )
   {
     document.getElementById("lname").focus();
     alert("Enter the last name");
     return false;
   } else if(!nameRegex.test(lname))
   {
   	document.getElementById("lname").focus();
     alert("Invalid last name");
     return false;
   }
   /*
   if(femail == "" )
	{
	 document.getElementById("email").focus();
	  alert("Enter the email");
	  return false;
   }
  else if(!emailRegex.test(femail)){
  document.getElementById("email").focus();
  alert("Invalid Email");
  return false;
  }
  */
  if(fpassword == ""){
   document.getElementById("password").focus();
   alert("Enter the password");
   return false;
  }
  if(rpassword == "")
  {
   document.getElementById("rpassword").focus();
   alert("Confirm your password");
   return false;
  }
  else if(fpassword!=rpassword)
  {
   document.getElementById("rpassword").focus();
   alert("Confirm Password is not match");
   return false;
  }
   if(mob == "" )
	{
	  document.getElementById("mfocus").focus();
	  alert("Enter 10 digit mobile number");
	  return false;
   } else if(!mobileRegex.test(mob))
   {
   	  document.getElementById("mfocus").focus();
	  alert("Invalid mobile number");
	  return false;
   }
}
</script>		

                            
<?php include 'footer.php';?>                            
