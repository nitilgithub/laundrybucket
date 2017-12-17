<?php
include('connection.php');
if(isset($_GET['id']))
{
	$oid=mysql_real_escape_string($_GET['id']);
	
	$res=mysql_query("select * from tbl_orders where OrderId='$oid'");
	
	$row=mysql_fetch_array($res);
	
	$balamt=$row['PayableAmount']-$row['PaidAmount'];
	if($balamt<0)
	{
		$balamt=0;
	}
	$uid=$row['OrderUserId'];
	
	if(!empty($uid)&&!empty($balamt))
	{
		echo "<script>window.location.href='http://www.laundrybucket.co.in/paytmkit/pgRedirect.php?orderid=".$oid."&userid=".$uid."&amt=".$balamt."';</script>";
	}
}
?>