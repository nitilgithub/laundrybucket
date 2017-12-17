<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
require '../class.phpmailer.php';
require '../class.smtp.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$return_arr = array();

$uid=intval($_GET["uid"]);
$uemail=mysqli_real_escape_string($link,strip_tags($_GET["uemail"]));

    if(empty($uemail)) /* check for validation that ufname,ulname & umob should not be empty if empty then error */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter User Email";
		$row_array['title']="Alert"; // Alert Title
	}
	else /* if user email field not empty then */
	{
	  $chk="select * from tblusers where UserEmail='$uemail'"; /* check that entered user email already exist in database or not */
	 //echo $q;
	 $result=mysqli_query($link,$chk) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0) /* if entered user email already exist then fetch registered user id of that record */
	{
		$roww=mysqli_fetch_array($result);
		$dub_uid=$roww["UserId"]; //dub stands for dublicate
		//echo $uiid;
		
		if($uid!=$dub_uid) /* check that fetched userid and appuser's uid are same or not if they are not same this means that entered Email id is registered with another user */
		{
			$row_array['status'] = 0;
			$row_array['message'] = "Dublicate Email Id.This Email Id is Already Exist";
			$row_array['title']="Alert"; // Alert Title	
		}
		else /* if fetched userid and appuser;s uid are same this means this is current app user with same email id*/
		{
			if($roww["UserEmailVerifiedStatus"]==1) //If User Email is already verified
			{
			
				$row_array['status'] = 0;
				$row_array['message'] = "No Change Found This Email has been already Verified";
				$row_array['title']="Alert"; // Alert Title
			}
			else {
			
				$str3="";
		$otp=$uid.$uemail;
		/* We are sending these 3 papameter(otp,uemail,uid) in encrpted form with url in email so that no can understand*/
		$otp_encrypt=base64_encode($otp);
		$uemail_encrypt=base64_encode($uemail);
		$uid_encrypt=base64_encode($uid);
		
		$usermessage = file_get_contents('../email_template/email_verifylink.html');
		// Replace the % with the actual information for sending email to user id
		$usermessage = str_replace('%otp%', $otp_encrypt, $usermessage);
		$usermessage = str_replace('%uid%', $uid_encrypt, $usermessage);
		$usermessage = str_replace('%uemail%', $uemail_encrypt, $usermessage);
		$usermessage = str_replace('%messagetxt%', "Verify", $usermessage);
			
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
				$mail->Subject = "Laundry Bucket Email Verification";
				$mail->Body = $usermessage;
				$mail->AddAddress($uemail); //Email to
				//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');	
				
				if($mail->Send())
				 {
				 	$row_array['status'] = 1;
					$row_array['message'] = "Email Verification Link sent on your entered Email Address , verify the link. This will take 4-5 minute";
					
					$row_array['title']="Alert"; // Alert Title
				 }
				else
				{
				   //echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
				  $row_array['status'] = 0;
				  $row_array['message'] = "Some Error Please Try Again Later";
				  $row_array['title']="Alert"; // Alert Title
				}		
				
			}
				
		}
	}

	else  /* if entered user Email id not already exist then we can update user email- */
	{
		$str3="";
		$otp=$uid.$uemail;
		/* We are sending these 3 papameter(otp,uemail,uid) in encrpted form with url in email so that no can understand*/
		$otp_encrypt=base64_encode($otp);
		$uemail_encrypt=base64_encode($uemail);
		$uid_encrypt=base64_encode($uid);
		
		$usermessage = file_get_contents('../email_template/email_verifylink.html');
		// Replace the % with the actual information for sending email to user id
		$usermessage = str_replace('%otp%', $otp_encrypt, $usermessage);
		$usermessage = str_replace('%uid%', $uid_encrypt, $usermessage);
		$usermessage = str_replace('%uemail%', $uemail_encrypt, $usermessage);
		$usermessage = str_replace('%messagetxt%', "Update", $usermessage);	
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
				$mail->Subject = "Laundry Bucket Email Verification";
				$mail->Body = $usermessage;
				$mail->AddAddress($uemail); //Email to
				//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');	
				
				if($mail->Send())
				 {
				 	$row_array['status'] = 1;
					$row_array['message'] = "Email Verification Link sent on your entered Email Address , verify the link and we will add this Email to your LaundryBucket account. This will take 4-5 minute";
					
					$row_array['title']="Alert"; // Alert Title
				 }
				else
				{
				   //echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
				  $row_array['status'] = 0;
				  $row_array['message'] = "Some Error Please Try Again Later";
				  $row_array['title']="Alert"; // Alert Title
				}
		
	}

  }
			 	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>