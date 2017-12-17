<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();
$offerid=trim($_GET['offerid']);
$totalamt=trim($_GET['totalamt']);
$otherdiscount=trim($_GET['otherdiscount']);
$taxpercent=trim($_GET['taxpercent']);
$subtaxamt=trim($_GET['subtaxamt']);
$suborderid=trim($_GET['suborderid']);
$taxableamt=$totalamt;
	$res=mysql_query("select * from tbl_offer where OfferId='$offerid' order by OfferId") or die(mysql_error());
	if(mysql_affected_rows())
	{
	$row=mysql_fetch_array($res);
	$offervalue=$row['OfferValue'];
	$offerunit=$row['OfferUnit'];
	$offercode=$row['OfferCode'];
	$offerdesc=$row['OfferDescription'];
		$r=mysql_query("insert into tbl_applyOffer(subOrderId,OfferCode,OfferValue,OfferUnit,OfferDescription,addon) values('$suborderid','$offercode','$offervalue','$offerunit','$offerdesc',now())");
		if(mysql_affected_rows())
		{
			$r1=mysql_query("select * from tbl_applyOffer where subOrderId='$suborderid' order by id") or die(mysql_error());
			$totaldiscount="";
			$totaldiscount1="";
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
				$totaldiscount=$totaldiscount+$discount;
				$taxableamt=$taxableamt-$discount;
				if($ofcode!='MANUAL'&& $ofcode!='REFERRAL')
				{
					if($ofunit=='flat')
					{
						$discount1=$ofvalue;
					}
					else {
						$discount1=$taxableamt*($ofvalue/100);
					}
					
				}
				$totaldiscount1=$totaldiscount1+$discount1;
			}
			
			
		
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
$row_array['discount']=$totaldiscount1;
	$row_array['status']=1;
	}
	else {
		$row_array['status']=0;
	}
}	
else {
		$row_array['status']=0;
	}
array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
