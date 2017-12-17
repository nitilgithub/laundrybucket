<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
 $link = mysqli_connect($servername, $username, $password,$db);
	if (!$link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
 $return_arr = array();

 $uid=$_GET["uid"];
 $userotp=intval($_GET["userotp"]);

		 	
   $verify_user_otp="select * from tblusers WHERE (UserId='$uid' and Password_otp='$userotp')";

   $result=mysqli_query($link,$verify_user_otp) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$row_array['status']="1";
		$row_array['userid']=$uid;
	}

    else
		{
			$row_array['status']="Your have entered wrong OTP";
		}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>