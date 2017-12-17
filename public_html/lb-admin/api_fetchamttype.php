<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();
$amttype=$_GET['amttype'];
$soid=$_GET['suboid'];

$res5=mysql_query("select * from tbl_wallet_history where subOrderId='$soid'");
$rowss=mysql_fetch_array($res5);
$referdiscount=$rowss['amount'];

	$res=mysql_query("select * from tbl_suborders where SubOrderId='$soid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
	$row=mysql_fetch_array($res);
	
	$q=mysql_query("select count(*) from tbl_suborders_items where SubOrderId='$soid'");
	$rr=mysql_fetch_array($q);
	$totalitems=$rr[0];
	
	$applicable=$row['ApplicableAmount'];
	
	if($applicable==1)
	{
		if($amttype==1)
		{
		$row_array['totalamount']=$row['QuickTotalAmount'];
		$row_array['OfferDiscount']=$row['OfferDiscount'];
		$row_array['ManualDiscount']=$row['ManualDiscount'];
		$row_array['TaxableAmount']=$row['TaxableAmount'];
		$row_array['tax']=$row['tax'];
		$row_array['TaxPercentage']=$row['TaxPercentage'];
		$row_array['PayableAmount']=$row['PayableAmount'];
		$row_array['totalItems']=$row['totalItems'];
		}
		else
		{
		$row_array['totalamount']=$row['ItemTotalAmount'];
		$row_array['OfferDiscount']=$row['OfferDiscount'];
		$row_array['ManualDiscount']=$row['ManualDiscount'];
		$row_array['TaxableAmount']=$row_array['totalamount']-($row['OfferDiscount']+$row['ManualDiscount']+$referdiscount);	
		$row_array['TaxPercentage']=$row['TaxPercentage'];
		$tax=$row_array['TaxableAmount']*($row['TaxPercentage']/100);
		$row_array['tax']=$tax;
	 	$row_array['PayableAmount']=$row_array['TaxableAmount']+$tax;
		$row_array['totalItems']=$totalitems;
		}
	}
	else if($applicable==2)
	{
		if($amttype==1)
		{
		$row_array['totalamount']=$row['QuickTotalAmount'];
		$row_array['OfferDiscount']=$row['OfferDiscount'];
		$row_array['ManualDiscount']=$row['ManualDiscount'];
		$row_array['TaxableAmount']=$row_array['totalamount']-($row['OfferDiscount']+$row['ManualDiscount']+$referdiscount);	
		$row_array['TaxPercentage']=$row['TaxPercentage'];
		$tax=$row_array['TaxableAmount']*($row['TaxPercentage']/100);
		$row_array['tax']=$tax;
	 	$row_array['PayableAmount']=$row_array['TaxableAmount']+$tax;
		$row_array['totalItems']=$row['totalItems'];
		}
		else
		{
		$row_array['totalamount']=$row['ItemTotalAmount'];
		$row_array['OfferDiscount']=$row['OfferDiscount'];
		$row_array['ManualDiscount']=$row['ManualDiscount'];
		$row_array['TaxableAmount']=$row['TaxableAmount'];
		$row_array['tax']=$row['tax'];
		$row_array['TaxPercentage']=$row['TaxPercentage'];
		$row_array['PayableAmount']=$row['PayableAmount'];
		$row_array['totalItems']=$totalitems;
		}
	}
	else {
		if($amttype==1)
		{
		$row_array['totalamount']=$row['QuickTotalAmount'];
		$totalamt=$row['QuickTotalAmount'];
		}
		else
		{
		$row_array['totalamount']=$row['ItemTotalAmount'];
		$totalamt=$row['ItemTotalAmount'];
		}
		$row_array['OfferDiscount']=$row['OfferDiscount'];
		$row_array['ManualDiscount']=$row['ManualDiscount'];
		$row_array['TaxableAmount']=$totalamt-($row['OfferDiscount']+$row['ManualDiscount']+$referdiscount);
		$row_array['TaxPercentage']=$row['TaxPercentage'];
		$tax=$totalamt*($row['TaxPercentage']/100);
		$row_array['tax']=$tax;
		
		$row_array['PayableAmount']=$row_array['TaxableAmount']+$tax;
		$row_array['totalItems']=$totalitems;
	}
	
	$row_array['status']=1;
	}
	else {
		$row_array['status']=0;
	}


array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
