<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();
$offerid=$_GET['offerid'];
$totalamt=$_GET['totalamt'];
$otherdiscount=$_GET['otherdiscount'];
$taxpercent=$_GET['taxpercent'];
$subtaxamt=$_GET['subtaxamt'];
$suborderid=$_GET['suborderid'];
$taxableamt=$totalamt;

$othdis="";

$q=mysql_query("select * from tbl_applyOffer where id='$offerid' and OfferCode='REFERRAL'");
if(mysql_affected_rows())
{
	$rowss=mysql_fetch_array($q);
	$suboid=$rowss['subOrderId'];
	$q1=mysql_query("delete from tbl_wallet_history where subOrderId='$suboid'");
} 

	$res=mysql_query("delete from tbl_applyOffer where id='$offerid'") or die(mysql_error());
	if(mysql_affected_rows())
	{
$r1=mysql_query("select * from tbl_applyOffer where subOrderId='$suborderid' order by id") or die(mysql_error());
			$totaldiscount="";
			while($row1=mysql_fetch_array($r1))
			{
				$ofunit=$row1['OfferUnit'];
				$ofvalue=$row1['OfferValue'];
				$ofcode=$row1['OfferCode'];
				if($ofunit=='flat')
				{
					$discount=$ofvalue;
				}
				else {
					$discount=$taxableamt*($ofvalue/100);
				}
				if($ofcode=="MANUAL" || $ofcode=="REFERRAL")
				{
					$othdis+=$ofvalue;
				}
				$totaldiscount=$totaldiscount+$discount;
				$taxableamt=$taxableamt-$discount;
			}
			$totaldiscount=$totaldiscount-$othdis;;
			
		
	/*if($offerunit=='flat')
	{
		$discount=$offervalue;
	}
	else {
		$discount=$totalamt*($offervalue/100);
	}

if($subtaxamt=='0')
{
$taxableamt=$totalamt-$discount;	
}*/


$tax=$taxableamt*($taxpercent/100);
$payableamt=$taxableamt+$tax;

$row_array['taxableamt']=$taxableamt;
$row_array['tax']=$tax;	
$row_array['payableamt']=$payableamt;
$row_array['discount']=$totaldiscount;
	$row_array['status']=1;
	
}	
else {
		$row_array['status']=0;
	}
array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	
?>