<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$uid=$_GET["uid"];
$q="select * from tblusers where UserId='$uid'";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
if(mysqli_num_rows($r)>0)
{
	$data=mysqli_fetch_array($r);
	$row_array["UserEmail"]=isset($data["UserEmail"])?$data["UserEmail"]:"";
	$row_array["UserFirstName"]=isset($data["UserFirstName"])?$data["UserFirstName"]:"";
	$row_array["UserLastName"]=isset($data["UserLastName"])?$data["UserLastName"]:"";
	$row_array["UserAddress"]=isset($data["UserAddress"])?$data["UserAddress"]:"";
	$row_array["UserPhone"]=isset($data["UserPhone"])?$data["UserPhone"]:"";
	$row_array['flag'] = 1;
	
	if(empty($row_array))
	{
		$row_array["flag"]=0;
	}
}	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>