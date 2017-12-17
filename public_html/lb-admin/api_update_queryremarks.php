<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
include('../connection.php');

$return_array=array();

$id=mysql_real_escape_string($_GET['id']);
$remarks=mysql_real_escape_string($_GET['remark']);

$result=mysql_query("update tbl_contactenquiry set Remarks='$remarks' where id='$id'");
if($result)
{
	
	$rows['status']=1;
}
else {
	
	$rows['status']=0;
}
array_push($return_array,$rows);
echo json_encode($return_array);
?>