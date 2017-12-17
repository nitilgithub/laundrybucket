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
	
	/*$ddate=trim($_POST["actualdd"]);
	$date = DateTime::createFromFormat('m/d/Y', $ddate);
	$actualdd=$date->format('Y-m-d');*/
	
	$actualdd=trim($_POST["actualdd"]);
	
	$ord_type=trim($_POST["ordercat"]);
	$remarks=trim($_POST["review"]);
	$uid=$_POST['getuid'];
	$deliverby=$_POST['deliverby'];
	
	$res4=mysql_query("update tbl_suborders set DeliveryTypeId='$delivery_type',DeliveryStatusId='$delivery_status',DeliveryDate='$deliverydate',DeliveryAddress='$delivery_add',Remarks='$remarks',RiderId='$deliverby',ActualDeliveryDate='$actualdd' where SubOrderId='$suboid'");
	if($res4)
	{
		$status=1;
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
