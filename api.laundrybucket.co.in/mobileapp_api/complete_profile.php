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
$ufname=mysqli_real_escape_string($link,strip_tags($_GET["ufname"]));
$ulname=mysqli_real_escape_string($link,strip_tags($_GET["ulname"]));
$umob=mysqli_real_escape_string($link,strip_tags($_GET["umob"]));

 if(empty($ufname) || empty($ulname) || empty($umob)) /* check for validation that ufname,ulname & umob should not be empty if empty then error */
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
	else /* if ufname,ulname & umob not then */
	{
	$q="select * from tblusers where UserPhone='$umob'"; /* check that entered user phone already exist in database or not */
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0) /* if entered user phone no. already exist then fetch registered user id of that record */
	{
		$roww=mysqli_fetch_array($result);
		$dub_uid=$roww["UserId"]; //dub stands for dublicate
		//echo $uiid;
		
		if($uid!=$dub_uid) /* check that fetched userid and appuser's uid are same or not if they are not same this means that entered phone no is registered with another user */
		{
		$row_array['flag']=0;
		$row_array['status'] = "Dublicate Mobile Number.This Phone Number is Already Exist";	
		}
		else /* if fetched userid and appuser;s uid are same this means this is current app user so we can update user profile*/
		{
			$q1="update tblusers set UserFirstName='$ufname', UserLastName='$ulname', UserPhone='$umob' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));

			if(mysqli_affected_rows($link))
			{
				$row_array['flag'] = 1;
			$row_array['status']="Your Profile has been updated successfully";
			}
	
	 		else
			{
				$row_array['status']="Can not Updated try again later";
			}
		
	}
		
	}

	else  /* if entered user phone no not already exist then we can update record and insert that phone no- */
	{
		$q1="update tblusers set UserFirstName='$ufname', UserLastName='$ulname', UserPhone='$umob' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));

			if(mysqli_affected_rows($link))
			{
				$row_array['flag'] = 1;
			$row_array['status']="Your Profile has been updated successfully";
			}
	
	 		else
			{
				$row_array['status']="Can not Updated try again later";
			}
		
	}

  }
			 	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>