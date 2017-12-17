<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

include 'connection.php';

$uid=intval($_GET["uid"]);



$newaddr=trim($_GET["newaddr"]);

$return_array=array();


$result=mysql_query("insert into tblusers_address(UserId,addon,Address) values('$uid',now(),'$newaddr')");
if(mysql_affected_rows())
{
	$row_array['status']=1;
	
}
else {
	$row_array['status']=0;
}
array_push($return_array,$row_array);
echo json_encode($return_array);
?>



                           