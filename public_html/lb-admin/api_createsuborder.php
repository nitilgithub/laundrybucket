<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$order_id=$_GET['orderid'];
	$delivery_add=trim($_GET["address"]);
	$delivery_type=$_GET["dtype"];
	$delivery_status=$_GET["dstatus"];
	
	/*$tmpdate=mysql_real_escape_string(trim($_GET["deliverydate"]));
	$tdate = DateTime::createFromFormat('m/d/Y', $tmpdate);
	$deliverydate=$tdate->format('Y-m-d');*/
	
	$deliverydate=trim($_GET["deliverydate"]);
	
	
	$actualdd=$_GET["actualdd"];
	if($actualdd=="")
	{
		$actualdd=$deliverydate;
	}
	else {
		
		/*$ddate=trim($_GET["actualdd"]);
	$date = DateTime::createFromFormat('m/d/Y', $ddate);
	$actualdd=$date->format('Y-m-d');*/
	
	$actualdd=trim($_GET["actualdd"]);
	}
	
	$ord_type=trim($_GET["ordercat"]);
	$remarks=trim($_GET["remarks"]);
	$uid=$_GET['getuid'];
	$deliverby=$_GET['deliverby'];
	
	
		$res4=mysql_query("insert into tbl_suborders(OrderId,UserId,OrderTypeId,DeliveryTypeId,DeliveryStatusId,DeliveryDate,DeliveryAddress,Remarks,RiderId,ActualDeliveryDate,addon) values('$order_id','$uid','$ord_type','$delivery_type','$delivery_status','$deliverydate','$delivery_add','$remarks','$deliverby','$actualdd',now())");
		if($res4)
		{
			$suboid=mysql_insert_id();
			$res7=mysql_query("insert into tbl_subordersremarks(SubOrderId,OrderId,UserId,Remarks,RemarksBy,addon)values('$suboid','$order_id','$uid','$remarks','admin',NOW())");
			if($res7)
			{
			$status=1;
	    	}
			
		} 
		else{
			echo "error".mysql_error();
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
