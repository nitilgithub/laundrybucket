<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../class.phpmailer.php';
require '../class.smtp.php';
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$row_array=array();
$op=intval($_GET["op"]);
$regdate=date("Y-m-d");


//$uemail=($_GET["uname"]!="")? $_GET["uname"]:"";
$uemail=mysqli_real_escape_string($link,trim($_GET["uemail"])); //User Email Field is optional
	
$fullname=mysqli_real_escape_string($link,trim($_GET["uname"]));//User Full Name required
$names = explode(" ", $fullname);
$ufame=$names["0"]; //User First Name
$ulname=$names["1"]; //User Last Name

$uphone=mysqli_real_escape_string($link,trim($_GET["uphone"])); //User Phone no is required
$upass=md5(mysqli_real_escape_string($link,trim($_GET["upass"]))); //User Password is required
$referal_code=mysqli_real_escape_string($link,trim($_GET["referal-code"])); //Refreal code is optional
$utype="appuser";
$createdby="user";

$uvmob=mt_rand(1111,9999); //user verification mobile code
//$uvcode=md5($uvmob); //encrypted uvcode
$uvstatus=0; //user verification status
//$uemailvstatus=0; //User Email Verfication Status
$uemailvstatus = !empty($uemail) ? "'0'" : "NULL";
$deviceid=mysqli_real_escape_string($link,$_GET["deviceid"]);

$rfquery="select * from tbl_reward";
$rfresult=mysqli_query($link,$rfquery) or die(mysqli_error($link));
$rfrow=mysqli_fetch_array($rfresult);

$joining_reward=$rfrow["JoiningAmount"];
$referal_reward=$rfrow["ReferalAmount"];
$join_referal_reward=$rfrow["JoiningWithReferalAmount"];
 	
	
	
	if(empty($uphone) || empty($upass) || empty($fullname))
	{
		
		
		$row_array['message'] = "Please Enter Required Information Name, Phoneno and Password";
		
	}

	else {
	 
	 if(str_word_count($fullname) < 2)
	 {
	 			
				$row_array['message'] = "First Name and Last Name is Required";
				
	 }    
		
		 if($uemail!="")
		 {
		 
		 	if(!filter_var($uemail,FILTER_VALIDATE_EMAIL))
			{
				
				$row_array['message'] = "Please Enter a valid email address";
				
			}
		
		 }
	}  
   
   if(!empty($row_array))
	{
		foreach($row_array as $val){
			//echo $val;
			$row_array['status']=0;
			$row_array['title']="Alert"; // Alert Title
			array_push($return_arr,$row_array);
			echo json_encode($return_arr);
		}
	}
	
  else
	{
	$q="Select * from tblusers where (UserPhone='$uphone' && UserPhone!='')";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$row_array['status']=0;
		$row_array['message'] = "Dublicate mobile no.This mobile no is Already Registered";
		$row_array['title']="Alert"; // Alert Title
	}
	else 
	{
		$q5="Select * from tblusers where ((UserEmail='$uemail' && UserEmail!=''))";
		$result2=mysqli_query($link,$q5) or die(mysqli_error($link));
		if(mysqli_num_rows($result2)>0)
		{
			$row_array['status']=0;
			$row_array['message'] = "Dublicate Email Address.This Email is Already Registered";
			$row_array['title']="Alert"; // Alert Title
		}
		
		else
		{
		
		$q1="insert into tblusers(UserType,UserFirstName,UserLastName,UserPhone,UserEmail,UserPassword,UserRegistrationDate,CreatedBy,UserVerificationCode,UserVerifiedStatus,UserEmailVerifiedStatus,DeviceId) values('$utype','$ufame','$ulname','$uphone','$uemail','$upass','$regdate','$createdby','$uvmob','$uvstatus',$uemailvstatus,'$deviceid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
		if(mysqli_affected_rows($link))
		{
		
		$id=mysqli_insert_id($link);
		$random_no1=substr("$uemail",0,3);
		$random_no=mt_rand(11, 99); //randomly gemerate password
		$genreferal_code=$random_no1.$id.$random_no;//new generate referral code of current user
		
		$q8="update tblusers SET referal_code='$genreferal_code' where UserId='$id'";
		$rs8=mysqli_query($link,$q8) or die(mysqli_error($link));
	
		
		if(empty($referal_code))
		{
			$q2="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward','$joining_reward',NOW())";
			$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
			
		}
		
		else if(!empty($referal_code))
		{
			$chkreferal_code="select * from tblusers where referal_code='$referal_code'";
			$chkresult=mysqli_query($link,$chkreferal_code) or die(mysqli_error($link));
			
			if(mysqli_affected_rows($link))
			{
			$chkrow=mysqli_fetch_array($chkresult);
			
			$referal_uid=$chkrow["UserId"];
			
			$q3="insert into tbl_wallet(uid,title,amount,addon,referUserId) values('$id','Joining Reward with Referal','$join_referal_reward',NOW(),'$referal_uid')";
			$r3=mysqli_query($link,$q3) or die(mysqli_error($link));
			
			$q4="insert into tbl_wallet(uid,title,amount,addon,status,referUserId) values('$referal_uid','Referal Reward','$referal_reward',NOW(),'1','$id')";
			$r4=mysqli_query($link,$q4) or die(mysqli_error($link));
		   	}
			
			else {
			$q2="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward','$joining_reward',NOW())";
			$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
			
			}
		}
		
		
		if(!empty($uemail))
		{
			$otp=$id.$uemail;
			/* We are sending these 3 papameter(otp,uemail,uid) in encrpted form with url in email so that no can understand*/
			$otp_encrypt=base64_encode($otp);
			$uemail_encrypt=base64_encode($uemail);
			$uid_encrypt=base64_encode($id);
			
			$usermessage = file_get_contents('../email_template/email_verifylink.html');
			// Replace the % with the actual information for sending email to user id
			$usermessage = str_replace('%otp%', $otp_encrypt, $usermessage);
			$usermessage = str_replace('%uid%', $uid_encrypt, $usermessage);
			$usermessage = str_replace('%uemail%', $uemail_encrypt, $usermessage);
			
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
				
				
		}
		
			/* Code for Send Account Verification OTP to User Mobile no*/
			
				$txtmsg=urlencode("Your Laundry Bucket OTP is- $uvmob . Use it to verify your identity and update your password.");
				$ch = curl_init();
				$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uphone&sender=BUCKET&message=$txtmsg";
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
				curl_exec($ch);
				curl_close($ch);
			
		$row_array['status'] = 1;
		$row_array['userid']=$id;
		$row_array['message'] = "Verification Code has been  sent to your Entered Mobile no for account verification and verification link send to email for email varification";
		$row_array['title']="Alert"; // Alert Title
		
	  }	
	}
   }
array_push($return_arr,$row_array);
echo json_encode($return_arr);	
 }

?>