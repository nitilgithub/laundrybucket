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
$uname=mysqli_real_escape_string($link,trim($_GET["uname"]));
$upass=md5(mysqli_real_escape_string($link,trim($_GET["upass"])));



   if(empty($uname) || empty($upass))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information";
	}
	else 
	{
	$q="select * from tblusers where UserEmail='$uname' and UserPassword='$upass'";
	//echo $q;
	$result=mysqli_query($link,$q) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Duplicate Email Address. This Email Address is already registered";
	}
	else 
	{
	
		$q1="insert into tblusers(UserEmail,UserPassword) values('$uname','$upass')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
		$id=mysqli_insert_id($link);
		$row_array['flag'] = 1;
		$row_array['userid']=$id;
	}
  }

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>