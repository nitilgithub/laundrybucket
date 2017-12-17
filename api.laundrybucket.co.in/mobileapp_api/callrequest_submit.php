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
$call_mob=mysqli_real_escape_string($link,strip_tags($_GET["cmob"]));
$call_date=mysqli_real_escape_string($link,strip_tags($_GET["cdate"]));
$call_time=mysqli_real_escape_string($link,strip_tags($_GET["ctime"]));
$call_msg=mysqli_real_escape_string($link,strip_tags($_GET["cmsg"]));

 if(empty($call_mob) || empty($call_date) || empty($call_time) || empty($call_msg) )
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
	else 
	{
		$q1="insert into tbl_callrequest(uid,phone,calldate,calltime,message,addon) values('$uid','$call_mob','$call_date','$call_time','$call_msg',NOW())";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			if(mysqli_affected_rows($link))
			{
			$row_array['flag'] = 1;
			$row_array['status']="Your call request has been submitted successfully";
			}
	
	 		else
			{
				$row_array['flag'] = 0;
				$row_array['status']="Can not submit try again later";
			}
		
	}
  

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>