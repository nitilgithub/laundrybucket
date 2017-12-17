<?php
@ob_start();
@session_start();
require 'class.phpmailer.php';
require 'class.smtp.php';
include 'connection.php';

$uloginid=mysql_real_escape_string($_SESSION["uloginid"]);//this can be either email or mobile no because user vcan login via email/mobileno
//global $usid;
$id=mysql_real_escape_string($_GET["id"]);
$subs_name=mysql_real_escape_string($_GET["subs_name"]);
$uemail="";	
$rs=mysql_query("select * from tblusers where(UserEmail='$uloginid' OR UserPhone='$uloginid')");
$row1=mysql_fetch_array($rs);
$uemail=$row1["UserEmail"];

if(isset($_GET['id']))
{
	$result=mysql_query("update tbl_usersubscriptions set subs_status='cancel' where srno='$id'") or die(mysql_error());	
	if(mysql_affected_rows())
	{
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
							<td style='color: rgb(0, 66, 164); font-size: 18px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'><strong>Your Laundry Subscribed Power Plan <span color='black'>".$subs_name."</span> has been cancelled successfully</strong> </td>
							</tr>
							
							<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							<tr>
							<td style='background: rgb(0, 66, 164); height: 2px; line-height: 1px; font-size: 1px;'>&nbsp;</td>
							</tr>
							<br/>
                              
                              	<tr>
							<td height='23'>&nbsp;</td>
							</tr>
							
							
							
							
							 
							<tr><td height='23'>&nbsp;</td></tr><tr><td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;' valign='top'> Regards,<br>Team Laundry Bucket Website.</td>
							</tr><tr><td height='23'>&nbsp;</td></tr></tbody></table></td></tr></tbody></table>";
							
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
								$mail->SetFrom("orders@laundrybucket.co.in","Laundry Bucket Subscription Cancelled"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Laundry Subscription plan:".$subs_name;;
								$mail->Body =$str3;
								$mail->AddAddress("bucket@laundrybucket.co.in"); //Email to
								$mail->AddAddress($uemail); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
								
								if($mail->Send())
								{
								header("location:usersubscription.php?successmsg");
								}
								
								else {
									echo "<p style='padding:10px;' class='bg bg-info'>Mail error</p>";
								}
	}
	
	else {
		
		header("location:usersubscription.php?errssmsg");
	}
	
}
else {
	echo "error";
}
ob_end_flush();
?>