<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$order_id=$_POST['orderid'];
	$delivery_add=trim($_POST["address"]);
	$delivery_type=$_POST["dtype"];
	$delivery_status=$_POST["dstatus"];
	
	/*$tmpdate=mysql_real_escape_string(trim($_POST["deliverydate"]));
	$tdate = DateTime::createFromFormat('m/d/Y', $tmpdate);
	$deliverydate=$tdate->format('Y-m-d');*/
	
	$deliverydate=trim($_POST["deliverydate"]);
	
	
	$actualdd=$_POST["actualdd"];
	if($actualdd=="")
	{
		$actualdd=$deliverydate;
	}
	else {
		
		/*$ddate=trim($_POST["actualdd"]);
	$date = DateTime::createFromFormat('m/d/Y', $ddate);
	$actualdd=$date->format('Y-m-d');*/
	
	$actualdd=trim($_POST["actualdd"]);
	}
	
	if($_POST["ordercat"])
	{
	$ord_type=trim($_POST["ordercat"]);
	}
	else {
		$q=mysql_query("select * from tbl_services where ServiceName like '%subscription%'");
		$qr=mysql_fetch_array($q);
		$ord_type=$qr['ServiceId'];	
	}
	$remarks=trim($_POST["remarks"]);
	$uid=$_POST['getuid'];
	$deliverby=$_POST['deliverby'];
	
	$totalwt=$_POST['orderwt'];
	$remainwt=$_POST['remainwt'];
	
	
		$usedwt=$totalwt;
	
	
	$totalamt=$_POST['totalcost'];
	
	$usersubsid=$_POST['usersubstypeid'];
	
	$extrawtcost=$_POST['extrawtcost'];
	
	$extrawpickcost=$_POST['extrawpickcost'];
	
	
	
		$res4=mysql_query("insert into tbl_suborders(OrderId,UserId,OrderTypeId,DeliveryTypeId,DeliveryStatusId,DeliveryDate,DeliveryAddress,Remarks,RiderId,ActualDeliveryDate,TotalWeight,TotalAmount,TaxableAmount,PayableAmount,addon) values('$order_id','$uid','$ord_type','$delivery_type','$delivery_status','$deliverydate','$delivery_add','$remarks','$deliverby','$actualdd','$totalwt','$totalamt','$totalamt','$totalamt',now())");
		if($res4)
		{
			$suboid=mysql_insert_id();
			$res7=mysql_query("insert into tbl_subordersremarks(SubOrderId,OrderId,UserId,Remarks,RemarksBy,addon)values('$suboid','$order_id','$uid','$remarks','admin',NOW())");
			if($res7)
			{
			$ress=mysql_query("insert into tbl_subs_suborder(subOrderId,user_subs_id,extra_wt_cost,extra_pickup_cost,addon) values('$suboid','$usersubsid','$extrawtcost','$extrawpickcost',now())");
			if($ress)
			{
				
			$ress1=mysql_query("update tbl_usersubscriptions set max_pickup=max_pickup+1,used_weight=used_weight+'$usedwt' where UserId='$uid' and srno='$usersubsid'");
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
		else{
			echo "error".mysql_error();
			$status=0;
		}


$i=1;
$rows["status"]=$status;
$rows["orderid"]=$order_id;

array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
