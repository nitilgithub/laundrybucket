
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
    die("Connection failed: " . mysqli_connect_error());
}

$return_arr = array();
$regdate=date("Y-m-d");
$uphone=mysqli_real_escape_string($link,trim($_GET["uphone"]));
$uemail=mysqli_real_escape_string($link,trim($_GET["uemail"]));
$upass=md5(rand(1111,9999));
//$referal_code=mysqli_real_escape_string($link,trim($_GET["referal-code"]));
$createdby="rider"; //value can be either admin,user,rider,userorder(means user account created while placing order)
$riderid=$_GET["riderid"];

//Check if Rider ID exist then get riderid else me set riderid to null(Rider Id will Exist if user is created by rider or delivery boy)

$rfquery="select * from tbl_reward";
$rfresult=mysqli_query($link,$rfquery) or die(mysqli_error($link));
$rfrow=mysqli_fetch_array($rfresult);

$joining_reward=$rfrow["JoiningAmount"];
//$referal_reward=$rfrow["ReferalAmount"];
//$join_referal_reward=$rfrow["JoiningWithReferalAmount"];
 	
	if(empty($uphone))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}

	else
	{
		
	$q="select * from tblusers where((UserEmail='$uemail'&&UserEmail!='') OR UserPhone='$uphone')";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0)
	{
		$row=mysqli_fetch_array($result);
		
		$row_array['flag']=1;
		$row_array['uid']=$row['UserId'];
		$row_array['uname']=$row['UserFirstName'];
		$row_array['uphone']=$row['UserPhone2'];
		$row_array['uemail']=$row['UserEmail'];
		$row_array['uaddress']=$row['UserAddress'];
		
		$row_array['status'] = "Dublicate Email Address or mobile no.This Email/mobileno Already Registered";
		
	}
	else 
	{
		$q1="insert into tblusers(UserEmail,UserPhone,UserPassword,UserRegistrationDate,CreatedBy,RiderId) values('$uemail','$uphone','$upass','$regdate','$createdby','$riderid')";
		//$q1="insert into tblusers(UserEmail,UserPassword,UserPhone,UserRegistrationDate,CreatedBy,RiderId) values('$uemail','$upass','$regdate')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
		$id=mysqli_insert_id($link);
		$row_array['flag'] = 2;
		$row_array['uid']=$id;
		$row_array['useremail']=$uemail;
		
			$q2="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward','$joining_reward',NOW())";
			$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
	}
  }

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>