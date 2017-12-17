<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$all_order=array();

if($_SESSION['loginrole']==9)
{
	$res=mysql_query("select * from tbl_suborders where DeliveryDate=CURDATE() or STR_TO_DATE(DeliveryDate, '%m/%d/%Y') = CURDATE() and OrderId in (select OrderId from tbl_orders where(OrderStatusId!=5 and franchiseId='".$_SESSION['loginid']."'))");
}			
else {

$res=mysql_query("select * from tbl_suborders where DeliveryDate=CURDATE() or STR_TO_DATE(DeliveryDate, '%m/%d/%Y') = CURDATE() and OrderId in (select OrderId from tbl_orders where(OrderStatusId!=5))");
	}
	
while($row=mysql_fetch_array($res))
{
	$orderid=$row['OrderId'];

	
	$result=mysql_query("select * from tbl_orders where OrderId='$orderid'") or die(mysql_error());
	$rw=mysql_fetch_array($result);
   
   //while($row=mysql_fetch_array($result))
   //{
   	$userid=$row["UserId"];
	$riderid=$row['RiderId'];
	
	
   	$result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
	$row1=mysql_fetch_array($result1);
	
	$result2=mysql_query("select * from tbl_employee where empId='$riderid'") or die(mysql_error());
	$row2=mysql_fetch_array($result2);
	
   		$delivery_statusid=$row["DeliveryStatusId"];											
   		$deliverydate=$row["DeliveryDate"];
		$row_array["pickupdate"]=$deliverydate;	
   			
			if($rw["PayableAmount"]==0)
			{
				$row_array['payment_status']="NA";
			}
			else if(($rw["PayableAmount"]-$rw["PaidAmount"])==0)
			{
				$row_array['payment_status']="PAID";
			}				
			else {
				$row_array['payment_status']="PENDING";
			}
												
	$row_array["order_id"]=$row["OrderId"];
	
	$row_array["suborder_id"]=$row["SubOrderId"];
	
	if($rw["CreatedByName"]=='NA')
	{
		$row_array["order_createdby"]=$rw["CreatedBy"];
	}
	else {
		$row_array["order_createdby"]=$rw["CreatedByName"];
	}
	
	$row_array["order_via"]=$rw["Order_Via"];
	$row_array["order_pickby"]=$row2['empName'];
	
	$ordertypeid=$row["OrderTypeId"];
	
	$q=mysql_query("select * from tbl_services where ServiceId='$ordertypeid'");
	$r=mysql_fetch_array($q);
	$row_array["order_type"]=$r["ServiceName"];
	 
	//$row_array["order_username"]=$row["OrderUserName"];
	$row_array["order_statusid"]=$row["DeliveryStatusId"];
	
	$row_array["order_shipname"]=$row1["UserFirstName"]." ".$row1["UserLastName"];
	$row_array["order_email"]=$row1["UserEmail"];
	
	$row_array["order_phone"]=$row1["UserPhone"];
	
	$row_array["order_shipaddress"]=$row["DeliveryAddress"].", ".$rw["OrderCity"];
											//$row_array["pickupdate"]=$pickupdate;
	//$row_array["order_date"]=$row["OrderDate"];																						
				
			
		$row_array["remarks"]=$row["Remarks"];																				
		$row_array["delivery_type"]=$row["OrderDeliveryType"];
$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["PayableAmount"]) ? $row["PayableAmount"] : " ₹ ".$row["PayableAmount"]) );
				
	//In $row_array["order_total_amt_weight"] we are getting value as - 1stly check order type is subscription or other .if order type is subscription then further check
	//ordertotalweight. if order totalweight is zero then print hiphen else print order total weight with kg.
	//if order type other then check order totalamount either null or not  
						
 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$delivery_statusid'") or die(mysql_error());
         	$data2=mysql_fetch_array($result2);
$deliverbyriderId=$row['Rider_Id'];	
$result4=mysql_query("select * from tbl_employee where empId='$deliverbyriderId'") or die(mysql_error());
$row4=mysql_fetch_array($result4);		
			

$orderid=$row["OrderId"];
$r1=mysql_query("select * from tbl_suborders where OrderId='$orderid'");
$ocount=mysql_num_rows($r1);
$count=0;
while($rw1=mysql_fetch_array($r1))
{
	$deliverstatus=$rw1['DeliveryStatusId'];
	if($deliverstatus==4)
	{
		$count=$count+1;
	}
	else
		{
			break;
		}
}
	if($count==$ocount && $count!=0)
	{
		
		$r2=mysql_query("update tbl_orders set OrderStatusId=4 where OrderId='$orderid'");
}
		
		if($order_statusid==4)
		{
			$row_array["order_statustext"]=$data2["order_status_text"]."&nbsp; <span style='color:red;'>Delivered On: ".$row['Order_DeliverDate']."  Deliver By: ".$row4['empName']."</span>";
	}
	else
		{
	$row_array["order_statustext"]=$data2["order_status_text"];
		}
		
		
		
$q1=mysql_query("select * from tbl_suborders where OrderId='$orderid'");
$row_array['offercode']="";
while($q2=mysql_fetch_array($q1))
{
	$suboid=$q2['SubOrderId'];
	$q3=mysql_query("select * from tbl_applyOffer where subOrderId='$suboid'");
	while($q4=mysql_fetch_array($q3))
	{
		if($q4['OfferCode']!='MANUAL')
		{
			$row_array['offercode']=$row_array['offercode'].$q4['OfferCode'].", ";
		}
	}
}
	
	array_push($all_order,$row_array);
 	
	

   }
   //}
 echo json_encode($all_order);

   	
  
  mysql_close();
  ob_end_flush();
  
 	?>

	
					