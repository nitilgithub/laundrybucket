<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$sql = "SELECT count(*) as count FROM tbl_orders";
	$qry = mysql_query($sql);
	$row = mysql_fetch_array($qry);
	$newcount=$row['count'];
	
	$sql2 = "update tbl_ordercount set OrderCount='$newcount' where id='1'";
	$qry2 = mysql_query($sql2);
	if($qry2)
	{
		$rows['status']=1;
	}
	else {
		$rows['status']=0;
	}
	
	
$i=1;


array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
