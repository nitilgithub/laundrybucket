<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

$subsid=$_GET['subsid'];
$orderwt=$_GET['orderwt'];
$remainwt=$_GET['remainwt'];

if($remainwt=='unlimited' || $remainwt=='Unlimited')
{
	$row_array['extrawtcost']=0;
	$row_array['status']=1;
}
else if($remainwt-$orderwt>=0)
{
	$row_array['extrawtcost']=0;
	$row_array['status']=1;
}
else {
	$res=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
	$row=mysql_fetch_array($res);
	$extrawtcost_perkg=$row['subs_extra_wt_cost'];
	$extrawt=$orderwt-$remainwt;
	$row_array['extrawtcost']=$extrawt*$extrawtcost_perkg;
	$row_array['status']=1;
	}
	else {
		
		$row_array['status']=0;
	}
	
}
	

array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
