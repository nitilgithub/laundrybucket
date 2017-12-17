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
$device_id=trim($_GET["did"]);


		$q1="insert into tbl_pushnotification(uid,device_id,addon) values('$uid','$device_id',NOW())";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			if(mysqli_affected_rows($link))
			{
			$row_array['flag'] = 1;
			$row_array['status']="Notification send successfully";
			}
	
	 		else
			{
				$row_array['flag'] = 0;
				$row_array['status']="Can not Send try again later";
			}
	 		
		

  

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>