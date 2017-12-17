<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$uid=$_GET["uid"];
$uaddress=mysqli_real_escape_string($link,strip_tags($_GET["uaddress"]));

if(empty($uaddress)) /* check for validation that Uaddress should not be empty if empty then error */
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Your Address";
	}
	else /* if user email field not empty then */
	{
	$chk="select * from tblusers where UserId='$uid'"; /* check that entered user email already exist in database or not */
	
	$result=mysqli_query($link,$chk) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0) 
	{
		$roww=mysqli_fetch_array($result);
		$uaddress=$roww["UserAddress"]; 
		//echo $uiid;
		
		if(empty($uaddress)) 
		{
			$q="insert into tblusers_address(UserID,Address,addon)values('$uid','$uaddress',NOW())";
			$r=mysqli_query($link,$q) or die(mysqli_error($link));
			if(mysqli_affected_rows($link))
			{
				 $q1="update tblusers set UserAddress='$uaddress' where (UserId='$uid')";
				 $r1=mysqli_query($link,$q1) or die(mysqli_error($link));
				 if($r)
				 {
				 	$row_array['status'] = 1;
					$row_array['message']="Address has been Added successfully";
					$row_array['title']="Alert"; // Alert Title
				 }
			}
			
		}
		else 
		{
			
			   $q="insert into tblusers_address(UserID,Address,addon)values('$uid','$uaddress',NOW())";
			$r=mysqli_query($link,$q) or die(mysqli_error($link));
			if(mysqli_affected_rows($link))
			{
					$row_array['status'] = 1;
					$row_array['message']="Address has been Added successfully";
					$row_array['title']="Alert"; // Alert Title
			}
				
		}
	}

	else  /* if entered user Email id not already exist then we can update user email- */
	{
		
		$row_array['status'] = 0;
		$row_array['message']="Some Error";
		$row_array['title']="Alert"; // Alert Title
	}

  }
			 	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>