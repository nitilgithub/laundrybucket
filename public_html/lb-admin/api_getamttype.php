<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

$soid=$_GET['suboid'];

	$res=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
	$row=mysql_fetch_array($res);
	$amttype=$row['ApplicableAmount'];
	$row_array['amttype']=$amttype;
	
	$row_array['status']=1;
	}
	else {
		$row_array['status']=0;
	}


array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
