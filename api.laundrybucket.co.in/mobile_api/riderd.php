
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$op=intval($_GET["op"]);
$regdate=date("Y-m-d");
$uname=mysqli_real_escape_string($link,trim($_GET["uname"]));
$upass=md5(mysqli_real_escape_string($link,trim($_GET["upass"])));
$referal_code=mysqli_real_escape_string($link,trim($_GET["referal-code"]));

$createdby=mysqli_real_escape_string($link,trim($_GET["createdby"])); //value can be either admin,self,rider

//Check if Rider ID exist then get riderid else me set riderid to null(Rider Id will Exist if user is created by rider or delivery boy)
if(isset($_GET["riderid"]))
{
	$riderid="'".$_GET["roderid"]."'";
}
else {
	$riderid= "NULL";
}

$rfquery="select * from tbl_reward";
$rfresult=mysqli_query($link,$rfquery) or die(mysqli_error($link));
$rfrow=mysqli_fetch_array($rfresult);

$joining_reward=$rfrow["JoiningAmount"];
$referal_reward=$rfrow["ReferalAmount"];
$join_referal_reward=$rfrow["JoiningWithReferalAmount"];
 	

   if(empty($uname) || empty($upass))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
   elseif(!filter_var($uname, FILTER_VALIDATE_EMAIL))
   {
   	$row_array['flag']=0;
		$row_array['status'] = "Please enter a valid email address";
   }
   
	else
	{
	$q="select * from tblusers where UserEmail='$uname' and UserPassword='$upass'";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Dublicate Email Address.This Email Address is Already Registered";
	}
	else 
	{
			
		
		$q1="insert into tblusers(UserEmail,UserPassword,UserRegistrationDate,CreatedBy,RiderId) values('$uname','$upass','$regdate','$createdby',$riderid)";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
		$id=mysqli_insert_id($link);
		$row_array['flag'] = 1;
		$row_array['userid']=$id;
		
		if(empty($referal_code))
		{
			$q2="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward','$joining_reward',NOW())";
			$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
			
		}
		
		else if(!empty($referal_code))
		{
			$chkreferal_code="select * from tblusers where referal_code='$referal_code'";
			$chkresult=mysqli_query($link,$chkreferal_code) or die(mysqli_error($link));
			
			if(mysqli_affected_rows($link))
			{
			$chkrow=mysqli_fetch_array($chkresult);
			
			$referal_uid=$chkrow["UserId"];
			
			$q3="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward with Referal','$join_referal_reward',NOW())";
			$r3=mysqli_query($link,$q3) or die(mysqli_error($link));
			
			$q4="insert into tbl_wallet(uid,title,amount,addon) values('$referal_uid','Referal Reward','$referal_reward',NOW())";
			$r4=mysqli_query($link,$q4) or die(mysqli_error($link));
		   	}
			
			else {
			$q2="insert into tbl_wallet(uid,title,amount,addon) values('$id','Joining Reward','$joining_reward',NOW())";
			$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
			
			}
			
			
		}
		
	}
  }

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>