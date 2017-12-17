<?php 
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$return_array=array();
$subsid=$_GET['subsid'];
$userid=$_GET['userid'];

$res=mysql_query("select * from tbl_usersubscriptions where UserId='$userid' and subs_id='$subsid'");
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($res);
	
	$row_array['usedweight']=$row['used_weight'];
	
	$row_array['usedpickup']=$row['max_pickup'];
	
	$res1=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
	$row1=mysql_fetch_array($res1);
	
	$row_array['availableweight']=$row1['subs_wt'];
	
	$row_array['availablepickup']=$row1['subs_maxpickup'];
	
	$row_array['extrapickupcost']=$row1['subs_extra_pickup_cost'];
	
	$row_array['status']=1;
	
	
}
else {
	$row_array['status']=0;
}
array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?>