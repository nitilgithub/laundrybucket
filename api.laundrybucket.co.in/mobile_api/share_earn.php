<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../class.phpmailer.php';
require '../class.smtp.php';
include '../connection.php';

$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$return_arr = array();
$uid=mysqli_real_escape_string($link,trim($_GET["uid"]));

	
	$query="select * from tblusers where UserId='$uid'";
	$result=mysqli_query($link,$query) or die(mysqli_error($link));
	$row=mysqli_fetch_array($result);
	
	$uemail=$row["UserEmail"];
	$referal_code=$row["referal_code"];
	
	if(empty($referal_code))
	{
	$random_no1=substr("$uemail",0,3);
	$random_no=mt_rand(11, 99); //randomly gemerate password
	
	$referal_code=$random_no1.$uid.$random_no;
	
		$q2="update tblusers SET referal_code='$referal_code' where UserId='$uid'";
		$rs2=mysqli_query($link,$q2) or die(mysqli_error($link));
		
		$row_array['referal_code']=$referal_code;
		     }
else {
	     $row_array['referal_code']=$referal_code;
}
				$row_array['referal_message']="Refer Laundry Bucket App & earn INR 500/- on each new joining with your referal code";
				$row_array['share_message']="Download Laundry Bucket App & create account by using ".$referal_code." referal code & earn INR 1000/-.Download Now! https://play.google.com/store/apps/details?id=com.laundrybucket.app";
				
  array_push($return_arr,$row_array);
  echo json_encode($return_arr);
?>