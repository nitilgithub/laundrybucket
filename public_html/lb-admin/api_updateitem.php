<?php

@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();




	$id=intval($_GET["id"]);
	$uid=$_GET['uid'];
	$oid=$_GET['oid'];
	$soid=$_GET['soid'];
	$qty=$_GET['qty'];
	$r1=mysql_query("select * from tbl_suborders_items where srno='$id'") or die(mysql_error());
	if(mysql_affected_rows())
	{
	$row1=mysql_fetch_array($r1);
	$old_itm_amt=$row1["TotalAmount"];
	$itmrate=$row1['ItemRate'];
	$new_itm_amt=$itmrate*$qty;
	$amt_diff=$old_itm_amt-$new_itm_amt;

	$r2=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
		$row2=mysql_fetch_array($r2);
		/*$itemtotal=$row2["ItemTotalAmount"]-$amt_diff;*/
		$itemtotal=$row2["TotalAmount"]-$old_itm_amt;
		$itemtotal= $itemtotal + $new_itm_amt;
		if($row2['ApplicableAmount']==1)
		{
			$res3=mysql_query("update tbl_suborders set ItemTotalAmount='$itemtotal' where SubOrderId='$soid'");
		}
		else {
			$discount=$row2['OfferDiscount']+$row2['ManualDiscount'];
		 
		 //$res4=mysql_query("select TaxPercentage from tbl_tax where TaxActive='y'");
		 //$row4=mysql_fetch_array($res4);
		 
		 $taxpercent=$row2['TaxPercentage'];
		 $taxableamt=$itemtotal-$discount;
		 $tax=$taxableamt*($taxpercent/100);
		 $payableamt=$taxableamt+$tax;
		 $res3=mysql_query("update tbl_suborders set TotalAmount='$itemtotal',ItemTotalAmount='$itemtotal',TaxableAmount='$taxableamt',tax='$tax',PayableAmount='$payableamt' where SubOrderId='$soid'");
		
		}
		if($res3)
		{
			 $result2=mysql_query("select sum(TotalAmount) as totalamount,sum(OfferDiscount) as offdiscount,sum(ManualDiscount) as othdiscount,sum(TaxableAmount) as taxableamount,sum(tax) as tax,sum(TaxPercentage) as taxpercentage,sum(PayableAmount) as payableamount from tbl_suborders where OrderId='$oid'");
		 $rows2=mysql_fetch_array($result2);
		
		 $totalamt=$rows2['totalamount'];
		 $offdiscount=$rows2['offdiscount'];
		 $othdiscount=$rows2['othdiscount'];
		 
		
		 
		 $taxpercent=$rows2['taxpercentage'];
		 $taxableamt=$rows2['taxableamount'];
		 $tax=$rows2['tax'];
		 $payableamt=$rows2['payableamount'];
		 $res33=mysql_query("update tbl_orders set OrderTotalAmount='$totalamt',OfferDiscount='$offdiscount',ManualDiscount='$othdiscount',TaxableAmount='$taxableamt',tax='$tax',TaxPercentage='$taxpercent',PayableAmount='$payableamt' where OrderId='$oid'");
		if($res33)
		{
			$result=mysql_query("update tbl_suborders_items set Qty='$qty',TotalAmount='$new_itm_amt' where srno='$id'") or die(mysql_error());

	if($res33)

	{

		$row_array['status']=1;
		
		//header("location:items_dashboard.php?uid=".$uid."&oid=".$oid."&soid=".$soid);

	
	}

	else

		{
			$row_array['status']=0;
			
			//echo "can't update try later";

		}

			
		}
else {
		$row_array['status']=0;
	
	//echo "error4".mysql_error();
}
		}
else {
		$row_array['status']=0;
	
	//echo "error3".mysql_error();
}
	}
else {
	
	$row_array['status']=0;
	
	//echo "error2".mysql_error();
}
	}
else {
	
	$row_array['status']=0;
	
	//echo "error1".mysql_error();
}
array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();		




?>

