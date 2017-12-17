<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();
//$offerid=trim($_GET['offerid']);
$totalamt=trim($_GET['totalamt']);
$otherdiscount=trim($_GET['discount']);
$taxpercent=trim($_GET['taxpercent']);
$subtaxamt=trim($_GET['subtaxamt']);
$suborderid=trim($_GET['suborderid']);
$taxableamt=$totalamt;
	
		$r=mysql_query("insert into tbl_applyOffer(subOrderId,OfferCode,OfferValue,OfferUnit,OfferDescription,addon) values('$suborderid','MANUAL','$otherdiscount','flat','Flat $otherdiscount rupees',now())");
		if(mysql_affected_rows())
		{
			$r1=mysql_query("select * from tbl_applyOffer where subOrderId='$suborderid' order by id") or die(mysql_error());
			$totaldiscount="";
			while($row1=mysql_fetch_array($r1))
			{
				$ofunit=$row1['OfferUnit'];
				$ofvalue=$row1['OfferValue'];
				if($ofunit=='flat')
				{
					$discount=$ofvalue;
				}
				else {
					$discount=$taxableamt*($ofvalue/100);
				}
				$totaldiscount=$totaldiscount+$discount;
				$taxableamt=$taxableamt-$discount;
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

	$row_array['status']=1;
	}
	else {
		$row_array['status']=0;
	}
		

array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
