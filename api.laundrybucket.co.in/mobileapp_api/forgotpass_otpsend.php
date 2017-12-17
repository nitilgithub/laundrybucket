<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../class.phpmailer.php';
require '../class.smtp.php';
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$loginid=mysqli_real_escape_string($link,trim($_GET["loginid"])); //can be either email or phone no

if(empty($loginid))
{
	$row_array['status']=0;
	$row_array['message']="Please Enter Your Login Id Either Email or Mobile no";
	$row_array['title']="Alert"; // Alert Title
}

else
{	
	$check_query="select * from tblusers WHERE (UserEmail='$loginid' or UserPhone='$loginid')";
	$result=mysqli_query($link,$check_query) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result) or die(mysqli_error($link));
		
		$otp=mt_rand(10000, 999999); //randomly gemerate password
		
		$uid=$row["UserId"];
		
		//$row_array['userid']=$row["UserId"];
		//$row_array['UserFirstName']=ucfirst($row["UserFirstName"]);
		//$row_array['otp']=$otp;
		
		$q2="update tblusers SET Password_otp='$otp' where UserId='$uid'";
		$rs2=mysqli_query($link,$q2) or die(mysqli_error($link));
		
		if($rs2)
		{
		
				if(filter_var($loginid,FILTER_VALIDATE_EMAIL))
				{
					//echo "Entered Login id  is email";
					
					$usermessage = file_get_contents('../email_template/forgotpassotp_send.html');
					
					// Replace the % with the actual information for sending email to user id
					$usermessage = str_replace('%otp%', $otp, $usermessage);
					
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
						$mail->Body = $usermessage;
						$mail->AddAddress($loginid); //Email to
						//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');	
						
						if($mail->Send())
						 {
						 	$row_array['status']=1;
							$row_array['message']="Otp sent to your Entered Email Id";
							$row_array['title']="Alert"; // Alert Title
							$row_array['userid']=$uid;
						 }
						else
						{
						   //echo "<p style='padding:10px;' class='bg bg-info'>Message cannot sent</p>";
						  $row_array['status']=0;
						  $row_array['message']="Some Error Try Again";
							$row_array['title']="Alert"; // Alert Title
						}
				}
		
				else 
				{
					//echo "Entered Login id is phone no;";
					
				$txtmsg=urlencode("Your Laundry Bucket OTP is- $otp . Use it to verify your identity and update your password.");
				$ch = curl_init();
				$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$loginid&sender=BUCKET&message=$txtmsg";
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
				curl_exec($ch);
				curl_close($ch);
						
						$row_array['status']=1;
						$row_array['message']="Otp sent to your Entered Mobile no";
						$row_array['title']="Alert"; // Alert Title
						$row_array['userid']=$uid;
				}
				
			}
		}
	else
	{
		$row_array['status']=0;
	 	$row_array['message']="You are not a registered user. Please Signup";
	 	$row_array['title']="Alert"; // Alert Title
	}	
}
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>