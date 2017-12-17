<?php
include 'header.php';
require '../class.phpmailer.php';
require '../class.smtp.php';

$res=mysql_query("select * from tblusers where UserEmail!=''");
while($row=mysql_fetch_array($res))
{
$uemail=$row['UserEmail'];

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
$mail->Subject = "Laundry App Updated";
$mail->Body = "Grab the new version of Laundry Bucket app with better view and interesting new features. Update your app today. Visit: https://play.google.com/store/apps/details?id=com.laundrybucket.app";
$mail->AddAddress($uemail); //Email to
//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');

 if($mail->Send())
 {
 	echo "mail send successfully";
 }
 else {
     echo "mail error";
 }
 
 }
?>