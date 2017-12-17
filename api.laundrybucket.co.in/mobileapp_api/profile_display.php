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
$q="select * from tblusers where UserId='$uid'";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
if(mysqli_num_rows($r)>0)
{
	$data=mysqli_fetch_array($r);
	//$dob=$data["UserDOB"];
	//$uaddressid=$data["UserAddressId"];
	//$udob=date("d/m/Y", strtotime($dob));
	
	$row_array["UserFirstName"]=isset($data["UserFirstName"])?$data["UserFirstName"]:"";
	$row_array["UserLastName"]=isset($data["UserLastName"])?$data["UserLastName"]:"";
	//$row_array["dob"]=isset($data["UserDOB"])?$udob:"";
	
	$row_array["gender"]=isset($data["UserSex"])?$data["UserSex"]:"";
	$row_array["UserEmail"]=isset($data["UserEmail"])?$data["UserEmail"]:"";
	$row_array["UserEmailstatus"]=isset($data["UserEmailVerifiedStatus"])?1:0; //If User Email Verified status is 0 then display Message verify Email
	$row_array["UserPhone"]=isset($data["UserPhone"])?$data["UserPhone"]:"";  // if userPhone number Exist in database then donot give option to edit or update this phone no
	$row_array["UserPhone2"]=isset($data["UserPhone2"])?$data["UserPhone2"]:""; //alternate Phone no
	
	$row_array["referal_code"]=isset($data["referal_code"])?$data["referal_code"]:""; 
	
	
	if(empty($uaddressid))
	{
	//$row_array["UserAddress"]=isset($data["UserAddress"])?$data["UserAddress"]:""; 	
	}
	else
		 {
		$q1="select * from tblusers_address where UserID='$uid' and id='$uaddressid'";
		$r1=mysqli_query($link,$q1) or die(mysqli_error($link));
		$data1=mysqli_fetch_array($r1);
		$uaddress=$data1["Address"];
		
		//$row_array["UserAddress"]=$data1["Address"];
	}
	
	
	$row_array['status'] = 1;
	//$row_array['message'] = "";
	//$row_array['title']="Alert"; // Alert Title
	
}

else
	{
		$row_array['status'] = 0;
		$row_array['message'] = "No Record Found With This User Id";
		$row_array['title']="Alert"; // Alert Title
	}	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>