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
$uname=mysqli_real_escape_string($link,strip_tags($_GET["uname"]));
$address=mysqli_real_escape_string($link,strip_tags($_GET["address"]));
$umob=mysqli_real_escape_string($link,strip_tags($_GET["umob"]));

 if(empty($uname)||empty($address)||empty($umob))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
	else 
	{
			
		$q="select * from tblusers where UserPhone='$umob'";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$roww=mysqli_fetch_array($result);
		$dub_uid=$roww["UserId"]; //dub stands for dublicate
		//echo $uiid;
		
		if($uid!=$dub_uid)
		{
		$row_array['flag']=0;
		$row_array['status'] = "This Mobile Number is Already registered with other user";	
		}

		else {
			$q1="update tblusers set UserFirstName='$uname', UserAddress='$address', UserPhone='$umob' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			$row_array['flag'] = 1;
			$row_array['status']="Your  review has been submitted successfully. Go back and submit order";
			
		}
		
	}
	
	
	else 
	  {
		
		$q1="update tblusers set UserFirstName='$uname', UserAddress='$address', UserPhone='$umob' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			$row_array['flag'] = 1;
			$row_array['status']="Your  review has been submitted successfully";
			
		
		}	
	}
  

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>