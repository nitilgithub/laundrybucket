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
$address=mysqli_real_escape_string($link,strip_tags($_GET["address"]));
$updatedby="user";
$address_active=1;//1 means currently added address will be active by  default
$address_dactive=0;// all other address except current will be set to zero(deactive)

 if(empty($address)) /* check for validation that User Address should not be empty if empty then error */
	{
		$row_array['status'] = 0;
		$row_array['message'] = "Please Enter Your Address";
		$row_array['title']="Alert"; // Alert Title
		
	}
	else /* if user address  not empty then */
	{
		$q="insert into tblusers_address(UserID,Address,ActiveStatus,addon)values('$uid','$address','$address_active',NOW())";
		$r=mysqli_query($link,$q) or die(mysqli_error($link));
		if(mysqli_affected_rows($link))
		{
			$addressid=mysqli_insert_id($link);
			
				/* This query will update all other status with 0(deactive) except currently added address Status of currenty added address will be 1 that we have set in above query */
			
			    $q1="update tblusers_address set ActiveStatus='$address_dactive' where (UserId='$uid' and id!='$addressid')";
				$r1=mysqli_query($link,$q1) or die(mysqli_error($link));
				
			//$chk="SELECT * FROM `tblusers` where (UserId='$uid' and IFNULL(UserAddress, '') = '')"; /* check that User Address Field is (empty,null) or not*/
			$chk="SELECT * FROM `tblusers` where (UserId='$uid' and ISNULL(UserAddress))";
			$result=mysqli_query($link,$chk) or die(mysqli_error($link));
			if(mysqli_num_rows($result)==1)/* If User Field is empty(means user 1st address) then update user address(We are update user address when user add address for 1st time) */
			{
			    $q2="update tblusers set UserAddressId='$addressid',RecordUpdatedDate=NOW(),UpdatedBy='$updatedby' where (UserId='$uid')";
				$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
			}
			
			
						$row_array['status'] = 1;
						$row_array['message'] = "Your Address Added Successfully";
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