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
$ufname=mysqli_real_escape_string($link,strip_tags($_GET["ufname"]));
$ulname=mysqli_real_escape_string($link,strip_tags($_GET["ulname"]));
//$dob=mysqli_real_escape_string($link,date("Y-m-d", strtotime($_GET["txtpickupdate"]))); //dob-date of birth
$gender=mysqli_real_escape_string($link,strip_tags($_GET["gender"])); //
$phone2=mysqli_real_escape_string($link,strip_tags($_GET["phone2"])); 
$updatedby="user";

//For Editing Email and Registered Mobile no seprate api has been created

 if(empty($ufname) || empty($ulname) || empty($gender)) /* check for validation that ufname,ulname & umob should not be empty if empty then error */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter First Name,Last Name,Gender";
		$row_array['title']="Alert"; // Alert Title
		
	}
	else /* if ufname,ulname & umob not then */
	{
	    $q1="update tblusers set UserFirstName='$ufname', UserLastName='$ulname',UserSex='$gender',RecordUpdatedDate=NOW(),UpdatedBy='$updatedby',UserPhone2='$phone2' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));

			if(mysqli_affected_rows($link))
			{
				$row_array['status'] = 1;
				$row_array['message'] = "Your Profile has been updated successfully";
				$row_array['title']="Alert"; // Alert Title
				
			}
	
	 		else
			{
				$row_array['status'] = 0;
				$row_array['message'] = "Can not Update Your Profile! Try Again";
				$row_array['title']="Alert"; // Alert Title
			}
  }
			 	
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>