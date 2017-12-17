<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

		$order_id=mysql_real_escape_string($_POST['sorderid']);
	$suborder_id=trim(mysql_real_escape_string($_POST["ssuborderid"]));
	$serviceid=trim(mysql_real_escape_string($_POST["sserviceid"]));
	$uid=mysql_real_escape_string($_POST['suserid']);
	$servicecat_id=trim(mysql_real_escape_string($_POST["servicecat"]));
	$unitid=trim(mysql_real_escape_string($_POST["priceunit"]));		
	$itemid=trim(mysql_real_escape_string($_POST["item"]));
	$itemrate=mysql_real_escape_string($_POST["itemrate"]);
	$itemprice=intval($_POST["itemprice"]);
	$qty=trim(mysql_real_escape_string($_POST["qty"]));
	$tprice=mysql_real_escape_string($_POST["tprice"]);
	$itemname=trim(mysql_real_escape_string($_POST["itmname"]));
	$description=trim($_POST['descp']);
	
	
	$quer="insert into tbl_suborders_items(SubOrderId,OrderId,UserId,ItemId,ItemName,ItemRate,Qty,TotalAmount,Description,addon) values('$suborder_id','$order_id','$uid','$itemid','$itemname','$itemprice','$qty','$tprice','$description',now())";
		
		$res1=mysql_query($quer);
	if($res1)
		{
		 $res2=mysql_query("select sum(TotalAmount) from tbl_suborders_items where SubOrderId='$suborder_id'");
		 $row2=mysql_fetch_array($res2);
		 $totalamt=$row2[0];
		 
		 $r1=mysql_query("select * from tbl_suborders where SubOrderId='$suborder_id'");
		 $rw1=mysql_fetch_array($r1);
		 if($rw1['ApplicableAmount']==2 || $rw1['ApplicableAmount']==0)
		 {
		 	$discount=$rw1['OfferDiscount']+$rw1['ManualDiscount'];
			 $taxpercent=$rw1['TaxPercentage'];
		 $taxableamt=$totalamt-$discount;
		 $tax=$taxableamt*($taxpercent/100);
		 $payableamt=$taxableamt+$tax;
		 
		  $res3=mysql_query("update tbl_suborders set TotalAmount='$totalamt',ItemTotalAmount='$totalamt',TaxableAmount='$taxableamt',tax='$tax',PayableAmount='$payableamt' where SubOrderId='$suborder_id'");
		
		 }
		else{
			$res3=mysql_query("update tbl_suborders set ItemTotalAmount='$totalamt' where SubOrderId='$suborder_id'");
		}

		 /*$discount=0;
		 $res4=mysql_query("select TaxPercentage from tbl_tax where TaxActive='y'");
		 $row4=mysql_fetch_array($res4);
		 $taxpercent=$row4[0];
		 $taxableamt=$totalamt-$discount;
		 $tax=$taxableamt*($taxpercent/100);
		 $payableamt=$taxableamt+$tax;
		 $res3=mysql_query("update tbl_suborders set TotalAmount='$totalamt',discount='$discount',TaxableAmount='$taxableamt',tax='$tax',TaxPercentage='$taxpercent',PayableAmount='$payableamt' where SubOrderId='$suborder_id'");*/
		
		
		if($res3)
		{
			$status=1;
		} 
		else{
			echo "inner".mysql_error();
			$status=0;
		}
    	}
else
{
	echo "outer".mysql_error();
	$status=0;
}

	
$i=1;
$rows["status"]=$status;
$rows["suborderid"]=$suborder_id;
/*$rows["orderid"]=$order_id;

$rows["userid"]=$uid;
$rows["serviceid"]=$ord_type;*/
array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
