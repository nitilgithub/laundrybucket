<?php
@ob_start();
@session_start();
include '../connection.php';
$id=mysql_real_escape_string(intval($_GET["id"]));
require '../class.phpmailer.php';
require '../class.smtp.php';
$client_name=mysql_real_escape_string($_GET["cname"]);
$subs_cost=mysql_real_escape_string($_GET["subscost"]);
$subs_name=mysql_real_escape_string($_GET["subsname"]);
$client_email=mysql_real_escape_string($_GET["cemail"]);
?>
<?php
  $result=mysql_query("update tbl_usersubscriptions set subs_status='activated' where srno='$id'") or(die(mysql_error())) ;
	
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
								header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
								 exit;
								}
	
	
	
	//header("location:usersubscription.php?ref=inactive&as");  //as stands for-inactivation success
	//echo "cancelled order";
}
else {
	header("location:usersubscription.php?ref=inactive&af");  //iaf stands for-inactivation Faiure
}
ob_end_flush();
?>