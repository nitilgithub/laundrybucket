<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

$id=$_GET['id'];

$res=mysql_query("delete from tbl_per_employee_roles where id='$id'") or die(mysql_error());

	if(mysql_affected_rows())
	{
		$rows['status']=1;
	}
	else {
		$rows['status']=0;
	}
	

array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
