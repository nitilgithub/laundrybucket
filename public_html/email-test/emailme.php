<?php
require 'class.phpmailer.php';
require 'class.smtp.php';
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.laundrybucket.co.in";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "contactform@laundrybucket.co.in"; //gmail email here
$mail->FromName = 'Laundry Ticket';
$mail->Password = "QeGtS2uti,[3"; //gmail password here
$mail->SetFrom("contactform@laundrybucket.co.in","Laundry Bucket"); //from Address here
$mail->AddReplyTo('nitilmietcs@gmail.com', 'Laundry Ticket');
$mail->Subject = "Laundry Ticket";
$mail->Body = "Testing Email from Laundry Bucket";
$mail->AddAddress("harshitamittal16@gmail.com"); //Email to
$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');

 if($mail->Send())
    {
    echo "<p style='padding:10px;' class='bg bg-info'>Message Sent Successfully</p>";
   //header("location:#msg");
  
                       
    }
    else
    {
       echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
    }
?>	