<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

require '../class.phpmailer.php';

require '../class.smtp.php';

include '../connection.php';



$link = mysqli_connect($servername, $username, $password,$db);

if (!$link) {

    die("Connection failed: " . mysqli_connect_error());

}



$return_arr = array();



  $loginid=mysqli_real_escape_string($link,trim($_GET["loginid"]));


  $check_email_query="select * from tblusers WHERE UserEmail='$loginid'";

  $result=mysqli_query($link,$check_email_query) or die(mysqli_error($link));

	if(mysqli_affected_rows($link))

	{

		$otp=mt_rand(10000, 999999); //randomly gemerate password

	

		$q2="update tblusers SET Password_otp='$otp' where UserEmail='$loginid'";

		$rs2=mysqli_query($link,$q2) or die(mysqli_error($link));

		$row1=mysqli_fetch_array($result);

		$row_array['userid']=$row1["UserId"];

		$row_array['UserFirstName']=ucfirst($row1["UserFirstName"]);

		$row_array['otp']=$otp;

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
				
						<img src='http://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png' alt='Laundry Bucket' border='0'></a>
				
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
				
				<td style='color: #666666; font-size: 15px; margin: 0!important; line-height: 17px; font-family: Arial, Helvetica, sans-serif;'>We received a request to reset the password for your LaundryBucket Mobile App account.<br/>
				
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
										$mail->Subject = "Your laundrybucket Mobile App  One Time Password(OTP)";
										$mail->Body = $str3;
										$mail->AddAddress($loginid); //Email to
										//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');

		 if($mail->Send())

		    {

		   $row_array['status']=1;

			 }

		    else

		    {

		       //echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";

		        $row_array['status']=0;

		    }
}
else

		{

			$row_array['msg']="You are not a registered user. Please Signup";

		}

array_push($return_arr,$row_array);

echo json_encode($return_arr);

?>