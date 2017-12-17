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
$uphone=mysqli_real_escape_string($link,strip_tags($_GET["uphone"]));
$otp=mt_rand(1111,9999); //user verification mobile code

if(empty($uphone)) /* check for validation that umob should not be empty if empty then error */
	{
		$row_array['status']=0;
		$row_array['message'] = "Please Enter User Phone no";
		$row_array['title']="Alert"; // Alert Title
	}
	else /* if user Phone  not empty then */
	{
	$chk="select * from tblusers where UserPhone='$uphone'"; /* check that entered user Phone already exist in database or not */
	//echo $q;
	$result=mysqli_query($link,$chk) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0) /* if entered user Phone already exist */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Dublicate Phone no .This Phone no is Already Exist";
		$row_array['title']="Alert"; // Alert Title
	}

	else  /* if entered  User Phone no is not already exist then we can update user Phone- */
	{
		 $q1="update tblusers set UserVerificationCode='$otp' where (UserId='$uid')";
		 $r=mysqli_query($link,$q1) or die(mysqli_error($link));
		 if($r)
		 {
		 
		 			$row_array['uphone']=$uphone;
				 	
					$row_array['status'] = 1;
					$row_array['message']="Please Enter OTP sent to Your Mobile no to verify  and we will add this Phone no to your LaundryBucket account";
					$row_array['title']="Alert"; // Alert Title
		
					
				   $txtmsg=urlencode("Your Laundry Bucket OTP is- $otp . Use it to verify your identity and update your password.");
				$ch = curl_init();
				$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$uphone&sender=BUCKET&message=$txtmsg";
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
				curl_exec($ch);
				curl_close($ch);
		 }	
		 
		 else {
			 $row_array['status']=0;
			 $row_array['message']="Try Again Later";
			 $row_array['title']="Alert"; // Alert Title
		 }
		
	}

  }
			 	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>