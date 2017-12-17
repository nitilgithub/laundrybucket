<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

		$order_id=$_POST['sorderid'];
	$suborder_id=trim($_POST["ssuborderid"]);
	$totalamtselect=trim($_POST['totalamtselect']);
	$subototalamt=trim($_POST['subototalamt']);
	$subtaxamt=trim($_POST['subtaxamt']);
	$taxpercent=trim($_POST['taxpercent']);
	$subtax=trim($_POST['subtax']);
	$otherdiscount=trim($_POST['otherdiscount']);
	$subpayable=trim($_POST['subpayable']);
	$offerdiscounttotal=trim($_POST['offerdiscounttotal']);
	
	$noofitems=trim($_POST['noofitems']);
	
	/*$serviceid=trim($_POST["sserviceid"]);
	$uid=$_POST['suserid'];
	$servicecat_id=trim($_POST["servicecat"]);		
	$itemid=trim($_POST["item"]);
	$itemrate=$_POST["itemrate"];
	$itemprice=intval($_POST["itemprice"]);
	$qty=trim($_POST["qty"]);
	$tprice=$_POST["tprice"];
	$itemname=trim($_POST["itmname"]);
	
	
	$quer="insert into tbl_suborders_items(SubOrderId,OrderId,UserId,ItemId,ItemName,ItemRate,Qty,TotalAmount,addon) values('$suborder_id','$order_id','$uid','$itemid','$itemname','$itemprice','$qty','$tprice',now())";
		
		$res1=mysql_query($quer);
	if(mysql_affected_rows())
		{*/
	//Quick order
		
		if($totalamtselect==1){
			$res1=mysql_query("update tbl_suborders set TotalAmount='$subototalamt',QuickTotalAmount='$subototalamt',ApplicableAmount='$totalamtselect',OfferDiscount='$offerdiscounttotal',ManualDiscount='$otherdiscount',TaxableAmount='$subtaxamt',TaxPercentage='$taxpercent',tax='$subtax',PayableAmount='$subpayable',totalItems='$noofitems' where SubOrderId='$suborder_id'");
			
			}
		else {
			$res1=mysql_query("update tbl_suborders set TotalAmount='$subototalamt',ItemTotalAmount='$subototalamt',ApplicableAmount='$totalamtselect',OfferDiscount='$offerdiscounttotal',ManualDiscount='$otherdiscount',TaxableAmount='$subtaxamt',TaxPercentage='$taxpercent',tax='$subtax',PayableAmount='$subpayable',totalItems='$noofitems' where SubOrderId='$suborder_id'");
		}	
			if($res1)
			{
		
		 $res2=mysql_query("select sum(TotalAmount) as totalamount,sum(OfferDiscount) as offdiscount,sum(ManualDiscount) as othdiscount,sum(TaxableAmount) as taxableamount,sum(tax) as tax,sum(TaxPercentage) as taxpercentage,sum(PayableAmount) as payableamount from tbl_suborders where OrderId='$order_id'");
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
		 $res3=mysql_query("update tbl_orders set OrderTotalAmount='$totalamt',OfferDiscount='$offdiscount',ManualDiscount='$othdiscount',TaxableAmount='$taxableamt',tax='$tax',TaxPercentage='$taxpercent',PayableAmount='$payableamt' where OrderId='$order_id'");
		
		if($res3)
		{
			$status=1;
		} 
		else{
			echo "<script>alert('error');</script>".mysql_error();
			$status=0;
		}
	}
else
{
	echo "<script>alert('error on main');</script>".mysql_error();
	$status=0;
}

	
$i=1;
$rows["status"]=$status;
$rows["orderid"]=$order_id;
/*

$rows["userid"]=$uid;
$rows["serviceid"]=$ord_type;*/
array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
