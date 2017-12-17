<?php
include 'header.php';
require 'class.phpmailer.php';
require 'class.smtp.php';
//include 'connection.php';
//$uloginid=$_SESSION["uloginid"];
$uid=mysql_real_escape_string($_SESSION["uid"]);
$str1="";

if(!isset($_SESSION["userloginstatus"])==1)
{
//header("location:login.php?e");	

echo "<script>window.location.href='login.php?e';</script>";
}
else {
	
	$customermsg = file_get_contents('email_template/placesubscription_user.html');
	$adminmessage = file_get_contents('email_template/placesubscription_admin.html');
	
	$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
	
	if(mysql_affected_rows())
	{
			$row=mysql_fetch_array($result);
			//$usid=$row["UserId"];
			
			$usname=$row["UserFirstName"].' '.$row["UserLastName"];
			$usemail=$row["UserEmail"];
			$usphone=$row["UserPhone"];
		
	
			$subsid=mysql_real_escape_string(trim($_GET["s"]));
								
		    $startdate = date('F d, Y');
									
	      //  $duedate = date('F d, Y', strtotime('+1 month'));                                               
	         
			 $new_renewal=date('F d, Y', strtotime('+1 month'));
			 
			 
			 
			 $maxpickup=0;
			 $used_weight=0;
			
			 $subs_status='inactive';
			 
			
			 $date=date('m/d/Y');
			 
			 $result1=mysql_query("select * from tbl_subscriptions where subs_id='$subsid' ") or die(mysql_error());
			
			 if(mysql_affected_rows())
			{
				$row1=mysql_fetch_array($result1);
				$subs_name=$row1["subs_name"];
				$subs_cost=$row1["subs_cost"];
				$subs_wt=$row1["subs_wt"];
				$subs_maxpickup=$row1["subs_maxpickup"];
	
$result2=mysql_query("insert into tbl_usersubscriptions(UserId,subs_id,start_date,next_renewal,last_renewal,max_pickup,used_weight,subs_status,addon) values('$uid','$subsid','$startdate','$new_renewal','$startdate','$maxpickup','$used_weight','$subs_status',NOW())");				

              $usersubid=mysql_insert_id();
			  
			  
			  /*
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
							<br/>
							<tr>
							<td style='background: rgb(0, 66, 164); height: 2px; line-height: 1px; font-size: 1px;'>&nbsp;</td>
							</tr>
							
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							 <tr>
							<td style='color: rgb(102, 102, 102); font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Thank you for subscribing power plan : <span style='color:rgb(0, 66, 164)'>".$subs_name." </span></strong> </td>

							</tr>
							
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							<tr>
							<td style='background: rgb(0, 66, 164); height: 2px; line-height: 1px; font-size: 1px;'>&nbsp;</td>
							</tr>
							<br/>
                              	<tr>
							<td style='color: rgb(0, 66, 164); font-size: 18px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Your Laundry Subscribed Power Plan Details:</strong> </td>
							</tr>
                              	<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							 <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Subscribe Plan Name :</strong>".$subs_name." </td>
							</tr>
						<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							  <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Subscribe Plan Cost :</strong>".$subs_cost." rs/-</td>
							</tr>
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							  <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Subscribe Plan Weight :</strong>".$subs_wt." Kg </td>
							</tr>
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							 
							 <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Subscribe Plan Maximum Pickup :</strong>".$subs_maxpickup." times </td>
							</tr>
							
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							 
							 <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Subscribe Plan Expiry Date:</strong>".$new_renewal." </td>
							</tr>
							
                              	<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							 <tr>
							<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Please place an standard order online or call us at +919718661177</strong> </td>

							</tr>
							 
							<tr><td height='23'>&nbsp;</td></tr><tr><td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;' valign='top'> Regards,<br>Team Laundry Bucket Website.</td>
							</tr><tr><td height='23'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table>";
							*/
							
			// Replace the % with the actual information for sending email to Admin id
			
		   $adminmessage = str_replace('%uname%', $usname, $adminmessage);
		   $adminmessage = str_replace('%uemail%', $usemail, $adminmessage);
		   $adminmessage = str_replace('%umobile%', $usphone, $adminmessage);
		   
		   $adminmessage = str_replace('%usersubid%', $usersubid, $adminmessage);
		   $adminmessage = str_replace('%subname%', $subs_name, $adminmessage);
		   $adminmessage = str_replace('%subcost%', $subs_cost, $adminmessage);			
		   $adminmessage = str_replace('%subweight%', $subs_wt, $adminmessage);							
		   $adminmessage = str_replace('%subexpiredate%', $new_renewal, $adminmessage);
									
									
			// Replace the % with the actual information for sending email to customer id
		
		   $customermsg = str_replace('%customername%', $usname, $customermsg);
		   $customermsg = str_replace('%usersubid%', $usersubid, $customermsg);
		   $customermsg = str_replace('%subname%', $subs_name, $customermsg);
		   $customermsg = str_replace('%subcost%', $subs_cost, $customermsg);			
		   $customermsg = str_replace('%subweight%', $subs_wt, $customermsg);							
		   $customermsg = str_replace('%subexpiredate%', $new_renewal, $customermsg);
			$customermsg = str_replace('%substatus%', $subs_status, $customermsg);
			
			 
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
								$mail->SetFrom($usemail,"Laundry Bucket Subscription"); //from Address here
								//$mail->AddReplyTo($usemail, 'Laundry Ticket');
								$mail->Subject = "New Subscription  from laundrybucket.co.in";
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
								$mail->Subject = "Laundry Subscription plan:".$subs_name;
								$mail->Body = $customermsg;
								$mail->AddAddress($usemail); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
							 if($mail->Send())
							    {
							    //header("location:thnkulaundry.php");
								 //exit;
								
							    }
							    else
							    {
							       //echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
							    }
	 				 }
					
					else {
						
					}
					
					
			$txtmsg=urlencode("Dear $usname, Thanks to Subscribe Our Plan $subs_name . Subscription id $usersubid Regards,Team Laundry Bucket.");
		
		
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
		   $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$usphone&sender=BUCKET&message=$txtmsg";
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
	
										if($result = curl_exec($ch))
									    {
									  	echo "<script>window.location.href='thnkulaundry.php';</script>";
										 //header("location:thnkulaundry.php");
										 
									      
									    }
										else
										{
											echo "<script>window.location.href='thnkulaundry.php';</script>";
										  //header("location:thnkulaundry.php");
										  		
										} 
									 
			curl_close($ch);
					

   		}	  					
	}
}


include 'footer.php';
?>