<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
//$uid=intval($_GET["uid"]);
$uaddress_id=intval($_GET["addressid"]);
$address=mysqli_real_escape_string($link,strip_tags($_GET["address"]));

//For Editing Email and Registered Mobile no seprate api has been created

 if(empty($address)) /* check for validation that User Address should not be empty if empty then error */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter Your Address";
		$row_array['title']="Alert"; // Alert Title
		
	}
	else /* if user address  not empty then */
	{
		$q="update tblusers_address set Address='$address' where(id='$uaddress_id')";
		$r=mysqli_query($link,$q) or die(mysqli_error($link));
		if(mysqli_affected_rows($link))
		{
			$row_array['status'] = 1;
			$row_array['message'] = "Your Address Updated Successfully";
			$row_array['title']="Alert"; // Alert Title
			
		}
		else {
			
					$row_array['status'] = 0;
					$row_array['message'] = "Try again";
					$row_array['title']="Alert"; // Alert Title
			
			
		}
	}		
			 	
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>