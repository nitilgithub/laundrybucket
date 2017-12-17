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
$message=mysqli_real_escape_string($link,strip_tags($_GET["message"]));

 if(empty($message)) /* check for validation that User Address should not be empty if empty then error */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter Your Message";
		$row_array['title']="Alert"; // Alert Title
		
	}
	else /* if user address  not empty then */
	{
		$q="insert into tbl_writeus(Message,UID)values('$message','$uid')";
		$r=mysqli_query($link,$q) or die(mysqli_error($link));
		if(mysqli_affected_rows($link))
		{
			
			
						$row_array['status'] = 1;
						$row_array['message'] = "Your Message Added Successfully";
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