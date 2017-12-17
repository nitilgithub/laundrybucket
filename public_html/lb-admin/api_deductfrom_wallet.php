<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

$uid=mysql_real_escape_string($_GET['uid']);
$damt=mysql_real_escape_string($_GET['damt']);
$dremarks=mysql_real_escape_string($_GET['dremarks']);

if($damt==""||$dremarks==""|| $damt<=0)
{
	$rows['status']=2;
}
else {
	
$result=mysql_query("insert into tbl_wallet_history(userId,amount,remarks,addon) values('$uid','$damt','$dremarks',now())");
if(mysql_affected_rows())
{
	$rows['status']=1;
}
else {
	$rows['status']=0;
}
}
array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();
?>