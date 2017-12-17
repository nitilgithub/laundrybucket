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
$uaddress_id=intval($_GET["addressid"]);
$address_active=1;
$address_dactive=0;

 
		$q="update tblusers_address set ActiveStatus='$address_active' where (UserId='$uid' and id='$uaddress_id')";
		$r=mysqli_query($link,$q) or die(mysqli_error($link));
		if(mysqli_affected_rows($link))
		{
			$q1="update tblusers_address set ActiveStatus='$address_dactive' where (UserId='$uid' and id!='$uaddress_id')";
			$r1=mysqli_query($link,$q1) or die(mysqli_error($link));
		
			$row_array['status'] = 1;
			$row_array['message'] = "Address Set Successfully";
			$row_array['title']="Alert"; // Alert Title
			
		}
		else {
			
					$row_array['status'] = 0;
					$row_array['message'] = "Try again";
					$row_array['title']="Alert"; // Alert Title
			
			
		}
			
			 	
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>