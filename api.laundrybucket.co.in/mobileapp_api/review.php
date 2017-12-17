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
$ufname=mysqli_real_escape_string($link,strip_tags($_GET["ufname"])); //User First Name
$ulname=mysqli_real_escape_string($link,strip_tags($_GET["ulname"])); //User Last Name
$address=mysqli_real_escape_string($link,strip_tags($_GET["address"]));
$umob=mysqli_real_escape_string($link,strip_tags($_GET["umob"]));

 if(empty($ufname)||empty($ulname)||empty($address)||empty($umob))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
	else 
	{
			
		$q="select * from tblusers where UserPhone='$umob'";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0)
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
			$q1="update tblusers set UserFirstName='$ufname',UserLastName='$ulname', UserAddress='$address', UserPhone='$umob' where (UserId='$uid')";
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