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
$pass=mysqli_real_escape_string($link,trim(md5($_GET["pass"])));

			 	
   $query="update tblusers set UserPassword='$pass', Password_otp='-200'  where UserId='$uid'";

  $result=mysqli_query($link,$query) or die(mysqli_error($link));
	if($result)
	{
	
		$row_array['status']=1;
		$row_array['message']="Your Pasword has been updated";
		$row_array['title']="Alert"; // Alert Title
	
}

 else
		{
			$row_array['status']=0;
			$row_array['message']="Some Error Try Again";
			$row_array['title']="Alert"; // Alert Title
		}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>