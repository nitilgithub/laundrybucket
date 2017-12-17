<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
	
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
	die("Connection failed: " . mysqli_connect_error());
}

$return_arr = array();

		$loginid=mysqli_real_escape_string($link,$_GET["loginid"]);
		$upass=md5(mysqli_real_escape_string($link,$_GET["upass"]));
		$device=trim($_GET["device"]);
		if(!empty($loginid) && !empty($upass))
		{
			$query="select * from tblusers WHERE (UserEmail='$loginid' or UserPhone='$loginid') and (BINARY UserPassword= BINARY '$upass')";	
		
			$result=mysqli_query($link,$query) or die(mysqli_error($link));
		
			if(mysqli_num_rows($result)>0)
			{
				$rows=mysqli_fetch_array($result) or die(mysqli_error($link));
				if($rows["DeviceId"]!=NULL or !empty($rows["DeviceId"]))
				
				{
				$deviceupdate=mysqli_query($link,"update tblusers set DeviceId='$device' WHERE (UserEmail='$loginid' or UserPhone='$loginid')");
                }
				$row_array['status'] = 1;
				$row_array['userid']=$rows["UserId"];
				$row_array['userstatus']=$rows["UserVerifiedStatus"]; /* get Status from database that user account is verified or not(1-verified and 0-notverified) if not verified then we will display verfy account screen in front end and if account is verified then not display verify account screen */
				$row_array['userloginid']=$loginid;
				
				
			}
			else 
			{
				$row_array['status'] = 0;
				$row_array['message'] = "Invalid Login Credentials";
				$row_array['title']="Alert"; // Alert Title
			}
	}
	else
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter Your Login Id(Email Or Phone) and Password";
		$row_array['title']="Alert"; // Alert Title
	}
	
array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>