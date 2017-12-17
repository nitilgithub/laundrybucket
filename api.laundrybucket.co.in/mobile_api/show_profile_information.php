<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$uid=$_GET["uid"];
$q="select * from tblusers where UserId='$uid'";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
if(mysqli_affected_rows($link))
{
	$data=mysqli_fetch_array($r);
	$row_array["UserFirstName"]=isset($data["UserFirstName"])?$data["UserFirstName"]:"";
	$row_array["UserLastName"]=isset($data["UserLastName"])?$data["UserLastName"]:"";
	$row_array["UserPhone"]=isset($data["UserPhone"])?$data["UserPhone"]:"";
	if(empty($row_array))
	{
		$row_array["msg"]="Error..";
	}
}	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>