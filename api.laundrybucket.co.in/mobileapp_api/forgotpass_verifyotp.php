<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
 $link = mysqli_connect($servername, $username, $password,$db);
	if (!$link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
 $return_arr = array();

 $uid=intval($_GET["uid"]);
 $userotp=intval($_GET["userotp"]);

		 	
   $verify_user_otp="select * from tblusers WHERE (UserId='$uid' and Password_otp='$userotp')";

   $result=mysqli_query($link,$verify_user_otp) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0)
	{
		$query2="update tblusers SET UserVerifiedStatus='1', UserVerificationCode='1' where(UserId='$uid')";
		$result2=mysqli_query($link,$query2) or die(mysqli_errno($link));
		if($result2)
		{
		$row_array['userid']=$uid;
		$row_array['status']="1";
		$row_array['message']="Otp matched now update your password";
		$row_array['title']="Alert"; // Alert Title
		}
	}

    else
		{
			$row_array['status']="1";
			$row_array['message']="Your have entered wrong OTP";
			$row_array['title']="Alert"; // Alert Title
		}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>