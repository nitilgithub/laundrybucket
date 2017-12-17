<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
	if (!$link) {
	    die("Connection failed: " . mysqli_connect_error());
	}
 $return_arr = array();

 $uid=mysqli_real_escape_string($link,base64_decode($_GET["u"]));
 
 
 $uemail=mysqli_real_escape_string($link,base64_decode($_GET["ue"]));
 $original_otp=$uid.$uemail;
 //$otp=base64_decode($_GET["ot"]);
 $fetch_userotp=mysqli_real_escape_string($link,base64_decode($_GET["ot"]));
 $updatedby="user";
 $uemailvstatus=1; //User Email Verification Status
 
 if($fetch_userotp!=$original_otp)
 {
	$row_array['status'] = 0;
	$row_array['message'] = "Invalid Confirmation Link";
	$row_array['title']="Alert"; // Alert Title
	
 }
 else {
 //$row_array['flag']="matched otp";  
	 
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
			if($roww["UserEmailVerifiedStatus"]==1)
			{
			
				$row_array['status'] = 0;
				$row_array['message'] = "This Email has been already Verified";
				$row_array['title']="Alert"; // Alert Title
			}
			
			else {
				 $q1="update tblusers set UserEmailVerifiedStatus='$uemailvstatus', RecordUpdatedDate=NOW(),UpdatedBy='$updatedby' where (UserId='$uid')";
				$r=mysqli_query($link,$q1) or die(mysqli_error($link));
				if($r)
				{
					$row_array['status'] = 1;
					$row_array['message'] = "Your Email has been verified  successfully";
					$row_array['title']="Alert"; // Alert Title
				}
				else
				{
					$row_array['status'] = 0;
					$row_array['message'] = "Can not update try again later";
					$row_array['title']="Alert"; // Alert Title
				}
			}   
				
		}
	}
	
	else /* if entered user Email id not already exist then we can update user email- */
	{
		 $q1="update tblusers set UserEmail='$uemail',UserEmailVerifiedStatus='$uemailvstatus', RecordUpdatedDate=NOW(),UpdatedBy='$updatedby' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			if($r)
			{
			$row_array['status'] = 1;
			$row_array['message'] = "Your Email has been verified & updated successfully";
			$row_array['title']="Alert"; // Alert Title
			}
	
	 		else
			{
				$row_array['status'] = 0;
				$row_array['message'] = "Can not update try again later";
				$row_array['title']="Alert"; // Alert Title
			}
	}
 }
 
// $otp=$_GET['ot'];
 	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>
