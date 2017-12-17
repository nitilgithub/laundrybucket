<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$q="select * from tbl_notifications ORDER BY id DESC";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
$i=0;
if(mysqli_affected_rows($link))
{
	while($data=mysqli_fetch_array($r))
	{
	$i+=1;
	$row_array["Status"]=1;
	$row_array["counter"]=$i;
	$row_array["title"]=isset($data["title"])? $data["title"]:"";
	$row_array["text"]=isset($data["text"]) ? $data["text"]:"";
	$row_array["addon"]=isset($data["addon"])? $data["addon"]:"";
	array_push($return_arr,$row_array);
	}
	
}
else {
	$row_array["Status"]=0;
}	


echo json_encode($return_arr);
mysqli_close($link);
?>