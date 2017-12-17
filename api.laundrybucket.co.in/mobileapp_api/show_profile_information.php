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
if(mysqli_affected_rows($link))
{
	$data=mysqli_fetch_array($r);
	$row_array["userfname"]=isset($data["UserFirstName"])?$data["UserFirstName"]:"";
	$row_array["userlname"]=isset($data["UserLastName"])?$data["UserLastName"]:"";
	$row_array["useremail"]=isset($data["UserEmail"])?$data["UserEmail"]:"";
	$row_array["userphone"]=isset($data["UserPhone"])?$data["UserPhone"]:""; //Registered Phone no will not be changeable readonly if already exist phone no then readonly if not exist then not 
	$row_array["userphone2"]=isset($data["UserPhone2"])?$data["UserPhone2"]:"";
	$row_array["userdob"]=isset($data["UserDOB"])?$data["UserDOB"]:"";
	$row_array["usergender"]=isset($data["UserSex"])?$data["UserSex"]:"";
	
	
	if(empty($row_array))
	{
		$row_array["msg"]="Error..";
	}
}	

array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>
