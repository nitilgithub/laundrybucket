<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$row_array=array();
$op=intval($_GET["op"]);
$regdate=date("Y-m-d");
$uemail=($_GET["uname"]!="")? $_GET["uname"]:"";
$uphone=mysqli_real_escape_string($link,trim($_GET["uphone"]));
$upass=md5(mysqli_real_escape_string($link,trim($_GET["upass"])));
$referal_code=mysqli_real_escape_string($link,trim($_GET["referal-code"]));
$utype="appuser";
$createdby="user";

$rfquery="select * from tbl_reward";
$rfresult=mysqli_query($link,$rfquery) or die(mysqli_error($link));
$rfrow=mysqli_fetch_array($rfresult);

$joining_reward=$rfrow["JoiningAmount"];
$referal_reward=$rfrow["ReferalAmount"];
$join_referal_reward=$rfrow["JoiningWithReferalAmount"];
 	
	if(empty($uphone) || empty($upass))
	{
		
	//	$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information phoneno and password";
	}

	else {
	     
		 if($uemail!="")
		 {
		 
		 	if(!filter_var($uemail,FILTER_VALIDATE_EMAIL))
			{
				//$row_array['flag']=0;
				$row_array['status'] = "Enter a valid Email Address";
			}
		
		 }
	}  
   
   if(!empty($row_array))
	{
		foreach($row_array as $val){
			//echo $val;
			array_push($return_arr,$val);
			echo json_encode($return_arr);
		}
	}
   
  else
	{
	$q="Select * from tblusers where ((UserEmail='$uemail' && UserEmail!='') or (UserPhone='$uphone' && UserPhone!=''))";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Dublicate Email Address or mobile no.This Email Address or mobile no is Already Registered";
	}
	else 
	{
			
		$q1="insert into tblusers(UserType,UserEmail,UserPhone,UserPassword,UserRegistrationDate,CreatedBy) values('$utype','$uemail','$uphone','$upass','$regdate','$createdby')";
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
array_push($return_arr,$row_array);
echo json_encode($return_arr);
  }

?>