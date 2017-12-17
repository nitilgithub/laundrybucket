<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$order_id=$_POST['orderid'];
	$suboid=$_POST['suborderid'];
	$delivery_add=trim($_POST["address"]);
	$delivery_type=$_POST["dtype"];
	$delivery_status=$_POST["dstatus"];
	
	$deliverydate=trim($_POST["deliverydate"]);
	
	/*$tmpdate=trim($_POST["deliverydate"]);
	$tdate = DateTime::createFromFormat('m/d/Y', $tmpdate);
	$deliverydate=$tdate->format('Y-m-d');*/
	
	
	if($_POST["actualdd"]==""||$_POST["actualdd"]==null)
	{
		$actualdd=$deliverydate;
	}
	else {
		/*$ddate=trim($_POST["actualdd"]);
	$date = DateTime::createFromFormat('m/d/Y', $ddate);
	$actualdd=$date->format('Y-m-d');*/
	
	$actualdd=trim($_POST["actualdd"]);
	}
	
	//$actualdd=trim($_POST["actualdd"]);
	
	$ord_type=trim($_POST["ordercat"]);
	$remarks=trim($_POST["review"]);
	$uid=$_POST['getuid'];
	$deliverby=$_POST['deliverby'];
	
	$totalwt=$_POST['orderwt'];
	
	
	
	$orderwtold=$_POST['orderwtold'];
	
	$remainwt=$_POST['remainwt']+$orderwtold;
	
	
		$usedwt=$totalwt-$orderwtold;
	
	
	$totalamt=$_POST['totalcost'];
	
	$usersubsid=$_POST['usersubstypeid'];
	
	$extrawtcost=$_POST['extrawtcost'];
	
	$extrawpickcost=$_POST['extrawpickcost'];
	
	$res4=mysql_query("update tbl_suborders set DeliveryTypeId='$delivery_type',DeliveryStatusId='$delivery_status',DeliveryDate='$deliverydate',DeliveryAddress='$delivery_add',Remarks='$remarks',RiderId='$deliverby',ActualDeliveryDate='$actualdd',TotalWeight='$totalwt',TotalAmount='$totalamt',TaxableAmount='$totalamt',PayableAmount='$totalamt' where SubOrderId='$suboid'");
	if($res4)
	{
		$res7=mysql_query("insert into tbl_subordersremarks(SubOrderId,OrderId,UserId,Remarks,RemarksBy,addon)values('$suboid','$order_id','$uid','$remarks','admin',NOW())");
		if($res7)
			{
				$ress=mysql_query("update tbl_subs_suborder set extra_wt_cost='$extrawtcost',extra_pickup_cost='$extrawpickcost' where subOrderId='$suboid'");
			if($ress)
			{
			$ress1=mysql_query("update tbl_usersubscriptions set used_weight=used_weight+'$usedwt' where UserId='$uid' and srno='$usersubsid'");
			if($ress1)
			{
				$res2=mysql_query("select sum(TotalAmount) as totalamount,sum(OfferDiscount) as offdiscount,sum(ManualDiscount) as othdiscount,sum(TaxableAmount) as taxableamount,sum(tax) as tax,sum(TaxPercentage) as taxpercentage,sum(PayableAmount) as payableamount from tbl_suborders where OrderId='$order_id'");
				 $row2=mysql_fetch_array($res2);
				 $totalamt=$row2['totalamount'];
				 $offdiscount=$row2['offdiscount'];
				 $othdiscount=$row2['othdiscount'];
				 
				 $taxpercent=$row2['taxpercentage'];
				 $taxableamt=$row2['taxableamount'];
				 $tax=$row2['tax'];
				 $payableamt=$row2['payableamount'];
				 $res3=mysql_query("update tbl_orders set OrderTotalAmount='$totalamt',OfferDiscount='$offdiscount',ManualDiscount='$othdiscount',TaxableAmount='$taxableamt',tax='$tax',TaxPercentage='$taxpercent',PayableAmount='$payableamt' where OrderId='$order_id'");
				if($res3)
				{
					$status=1;
				}
			}
			}
			}
	}
	else {
		echo mysql_error();
		$status=0;
	}
		


$i=1;
$rows["status"]=$status;
$rows["orderid"]=$order_id;
$rows["suborderid"]=$suboid;
$rows["userid"]=$uid;
$rows["serviceid"]=$ord_type;
array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
