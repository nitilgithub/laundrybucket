<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

include 'connection.php';

$uid=intval($_GET["uid"]);

$id=trim($_GET["id"]);

$newaddr=trim($_GET["newaddr"]);

$return_array=array();


$result=mysql_query("update tblusers_address set Address='$newaddr' where id='$id' and UserId='$uid'");
if($result)
{
	$row_array['status']=1;
	
}
else {
	$row_array['status']=0;
}
array_push($return_array,$row_array);
echo json_encode($return_array);
?>



                           