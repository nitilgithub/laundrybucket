<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$return_array=array();

//$offerid=trim($_GET['offerid']);

$totalamt=trim($_GET['totalamt']);
$availablereferral=trim($_GET['arefer']);
$taxpercent=trim($_GET['taxpercent']);
$subtaxamt=trim($_GET['subtaxamt']);
$suborderid=trim($_GET['suborderid']);
$userid=$_GET['userid'];
$taxableamt=$totalamt;

$q=mysql_query("select * from tbl_reward");
$rowss=mysql_fetch_array($q);
$deduction=$rowss['walletDeduction'];
$maxdeduct=$rowss['maxDeductionAmount'];
$otherdiscount=$availablereferral*($deduction/100);
$otherdiscount=round($otherdiscount,2);

if($otherdiscount>$maxdeduct)
{
	$otherdiscount=$maxdeduct;
}


$r3=mysql_query("select * from tbl_wallet_history where userId='$userid' and subOrderId='$suborderid'");
if(mysql_num_rows($r3)>0)
{
	$row_array['status']=2;
}
else {
		$r=mysql_query("insert into tbl_applyOffer(subOrderId,OfferCode,OfferValue,OfferUnit,OfferDescription,addon) values('$suborderid','REFERRAL','$otherdiscount','flat','Referral discount $otherdiscount rupees',now())");
		if(mysql_affected_rows())
		{
			
			$r2=mysql_query("insert into tbl_wallet_history(userId,subOrderId,amount,addon) values('$userid','$suborderid','$otherdiscount',now())");
			if($r2)
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
	}
	
	else {
		$row_array['status']=0;
	}
		
}

array_push($return_array,$row_array);
echo json_encode($return_array);
mysql_close();	

?> 	
