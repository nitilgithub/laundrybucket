<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
 $link = mysqli_connect($servername, $username, $password,$db);
	if (!$link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
 $return_arr = array();

 $uid=mysqli_real_escape_string($link,$_GET["uid"]);
 $userotp=intval($_GET["txtotp"]); /* userotp means user verification code send to user mobile no during registration */

	$query="select * from tblusers WHERE (UserId='$uid' and UserVerificationCode='$userotp')"; //query to check user entered veriffication code is correct or wrong

   $result=mysqli_query($link,$query) or die(mysqli_error($link));
	if(mysqli_num_rows($result)==1) /* if correct means get 1 record then update status of verfication from zero to one(1) */
	{
		$query2="update tblusers SET UserVerifiedStatus='1', UserVerificationCode='1' where(UserId='$uid')";
		$result2=mysqli_query($link,$query2) or die(mysqli_errno($link));
		if($result2)
		{
			$row_array['status']=1;
			
			$row_array['message']="Account Verified Successfully";
			$row_array['title']="Alert"; // Alert Title
		}
		else
		{
				$row_array['status']=0;
				$row_array['message']="User Verification Status not updated";
				$row_array['title']="Alert"; // Alert Title
		}
		
	}

    else
		{
			$row_array['status']=0;
			$row_array['message']="Your have entered wrong OTP";
			$row_array['title']="Alert"; // Alert Title
		}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>