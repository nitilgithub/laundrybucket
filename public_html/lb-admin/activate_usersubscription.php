<?php
@ob_start();
@session_start();
include '../connection.php';
$id=intval($_GET["id"]);
require '../class.phpmailer.php';
require '../class.smtp.php';
$client_name=mysql_real_escape_string($_GET["cname"]);
$subs_cost=mysql_real_escape_string($_GET["subscost"]);
$subs_name=mysql_real_escape_string($_GET["subsname"]);
$client_email=mysql_real_escape_string($_GET["cemail"]);
$subsvalid=mysql_real_escape_string($_GET["subsvalid"]);
$activedate=mysql_real_escape_string($_GET["activedate"]);
$validarr=explode(" ", $subsvalid);
$validity=$validarr[0];

$r1=mysql_query("select UserId from tbl_usersubscriptions where srno='$id'");
$rw1=mysql_fetch_array($r1);
$userid=$rw1[0];

$r2=mysql_query("select * from tblusers where UserId='$userid'");
$rw2=mysql_fetch_array($r2);
if($rw2['UserPhone']=="")
{
$phone=$rw2['UserPhone2'];
}
else {
	$phone=$rw2['UserPhone'];
}

$startdate = date('F d, Y',strtotime($activedate));

//$interval="INTERVAL ".$subsvalid." DAY";
			
//$new_renewal=date_add('$startdate', $interval);

$new_renewal=date('F d, Y', strtotime($startdate. ' + '.$validity.' days'));

//$new_renewal=date('F d, Y', strtotime('+1 month'));

?>
<?php
  $result=mysql_query("update tbl_usersubscriptions set subs_status='activated',start_date='$startdate',next_renewal='$new_renewal',last_renewal='$startdate',amtPaid='$subs_cost' where srno='$id'") or(die(mysql_error())) ;
	
if($result)
{
	
	
	
	$customermessage = file_get_contents('../email_template/activatesubscription_user.html');
	// Replace the % with the actual information for sending email to Admin id
	
	$customermessage = str_replace('%customername%', $client_name, $customermessage);
	$customermessage = str_replace('%subsid%', $id, $customermessage);
	$customermessage = str_replace('%subsname%', $subs_name, $customermessage);
	$customermessage = str_replace('%subsamount%', $subs_cost, $customermessage);
								
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
								$mail->Subject = "Activated Laundry Subscribed plan:";
								$mail->Body = $customermessage;
								$mail->AddAddress($client_email); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
							 if($mail->Send())
							    {
								//header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
								 //exit;
								}
							 else {
								 //header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
								 //exit;
							 }

		$txtmsg=urlencode("Dear $client_name, Thanks to Subscribe Our Plan $subs_name . Your Subscription is activated. Regards,Team Laundry Bucket.");
		
		
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
		$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone&sender=BUCKET&message=$txtmsg";
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
	
										if($result = curl_exec($ch))
									    {
									  	echo '<script type="text/javascript">alert("message sent");</script>';
										// header("location:thnkulaundry.php");
									      header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
								 			
									    }
										
										else
											{
											echo '<script type="text/javascript">alert("message not sent");</script>';
											 header("location:usersubscription.php?ref=inactive&as");
											} 
									 
curl_close($ch);

			
	//header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
	//echo "cancelled order";
}
else {
	header("location:usersubscription.php?ref=inactive&af");  //iaf stands for-inactivation Faiure
}
ob_end_flush();
?>