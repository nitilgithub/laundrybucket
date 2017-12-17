<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();


$suboid=mysql_real_escape_string($_GET['suboid']);

$q=mysql_query("select * from tbl_suborders where SubOrderId='$suboid'");

$rw=mysql_fetch_array($q);

$oid=$rw['OrderId'];
$ordertypeid=$rw['OrderTypeId'];
$q1=mysql_query("select * from tbl_services where ServiceId='$ordertypeid'");
$rw1=mysql_fetch_array($q1);
$ordertype=$rw1['ServiceName'];
$uid=$rw['UserId'];


$weight=$rw['TotalWeight'];

if($ordertype=='Subscription' || $ordertype=='subscription')
{
	$q3=mysql_query("select * from tbl_subs_suborder where SubOrderId='$suboid'");
	$rw3=mysql_fetch_array($q3);
	$subsid=$rw3['subs_id'];
	
	$result2=mysql_query("update tbl_usersubscriptions set used_weight=used_weight-'$weight', max_pickup=max_pickup-1 where subs_id='$subsid' and UserId='$uid'");
}

$result=mysql_query("delete from tbl_subordersremarks where SubOrderId='$suboid'");
if($result)
{
	$result1=mysql_query("delete from tbl_subs_suborder where subOrderId='$suboid'");
	if($result1)
	{
		$res=mysql_query("delete from tbl_suborders where SubOrderId='$suboid'");
		if(mysql_affected_rows())
		{
			
		 $res2=mysql_query("select sum(TotalAmount) as totalamount,sum(OfferDiscount) as offdiscount,sum(ManualDiscount) as othdiscount,sum(TaxableAmount) as taxableamount,sum(tax) as tax,sum(TaxPercentage) as taxpercentage,sum(PayableAmount) as payableamount from tbl_suborders where OrderId='$oid'");
		 $row2=mysql_fetch_array($res2);
		 $totalamt=$row2['totalamount'];
		 $offdiscount=$row2['offdiscount'];
		 $othdiscount=$row2['othdiscount'];
		 
		 /*$res4=mysql_query("select TaxPercentage from tbl_tax where TaxActive='y'");
		 $row4=mysql_fetch_array($res4);*/
		 
		 $taxpercent=$row2['taxpercentage'];
		 $taxableamt=$row2['taxableamount'];
		 $tax=$row2['tax'];
		 $payableamt=$row2['payableamount'];
		 $res3=mysql_query("update tbl_orders set OrderTotalAmount='$totalamt',OfferDiscount='$offdiscount',ManualDiscount='$othdiscount',TaxableAmount='$taxableamt',tax='$tax',TaxPercentage='$taxpercent',PayableAmount='$payableamt' where OrderId='$oid'");
		if(mysql_affected_rows())
		{
			$row_array['status']=1;
		}
		else
		{
			$row_array['status']=0;
			$row_array['mesg']="update order".mysql_error().$oid;
		}
		
		}
		else
		{
			$row_array['status']=0;
			$row_array['mesg']="delete suborder".mysql_error();
		}
	}
	else
	{
		$row_array['status']=0;
	}
}
else
{
	$row_array['status']=0;
}

array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	


?>