<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$all_order=array();

/*
$ordertype="Drycleaning";
												
												// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Conection Process Complete	

	$i=0;

	$query="call spDrycleanOrderList('$ordertype')";
	echo "<h1 class='text-danger'>".$query."<h1>";

$result=mysqli_query($conn,$query);

 	if(mysqli_affected_rows($conn))
	{
		while($row=mysqli_fetch_array($result))
		{
											
			$row_array["order_id"]=$row["OrderId"]; 
										//$row_array["order_username"]=$row["OrderUserName"];
										
										$row_array["order_email"]=$row["OrderEmail"];
										
										$row_array["order_phone"]=$row["OrderPhone"];
										
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
										
										$row_array["order_date"]=$row["OrderDate"];								
		array_push($dryclean_order,$row_array);
		                             	
										
									
									   }
									
	}
	
	   mysql_close($conn);
	   echo json_encode($dryclean_order,JSON_UNESCAPED_UNICODE);
	ob_end_flush();
	
	 */
                                    
if($_SESSION['loginrole']==9)
	{
		$result=mysql_query("select * from tbl_orders where OrderStatusId=0 and (STR_TO_DATE(Order_PickDate, '%m/%d/%Y') < CURDATE() and Order_PickDate < CURDATE()) and franchiseId='".$_SESSION['loginid']."' order by OrderId DESC") or die(mysql_error());
	}			
	else {				
	
	$result=mysql_query("select * from tbl_orders where OrderStatusId=0 and (STR_TO_DATE(Order_PickDate, '%m/%d/%Y') < CURDATE() and Order_PickDate < CURDATE()) order by OrderId DESC") or die(mysql_error());
	}	
   
   while($row=mysql_fetch_array($result))
   {
   	$userid=$row["OrderUserId"];
	$riderid=$row['RiderId'];
	
	
   	$result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
	$row1=mysql_fetch_array($result1);
	
	$result2=mysql_query("select * from tbl_employee where empId='$riderid'") or die(mysql_error());
	$row2=mysql_fetch_array($result2);
	
   		$order_statusid=$row["OrderStatusId"];											
   		$pickupdate=$row["Order_PickDate"];
   			
			if($row["PayableAmount"]==0)
			{
				$row_array['payment_status']="NA";
			}
			else if(($row["PayableAmount"]-$row["PaidAmount"])==0)
			{
				$row_array['payment_status']="PAID";
			}				
			else {
				$row_array['payment_status']="PENDING";
			}
												
	$row_array["order_id"]=$row["OrderId"];
	$row_array["order_createdby"]=$row["CreatedByName"];
	$row_array["order_via"]=$row["Order_Via"];
	$row_array["order_pickby"]=$row2['empName'];
	$row_array["order_type"]=$row["OrderType"];
	 
	//$row_array["order_username"]=$row["OrderUserName"];
	$row_array["order_statusid"]=$row["OrderStatusId"];
	
	$row_array["order_shipname"]=$row1["UserFirstName"]." ".$row1["UserLastName"];
	$row_array["order_email"]=$row1["UserEmail"];
	
	$row_array["order_phone"]=$row1["UserPhone"];
	
	$row_array["order_shipaddress"]=$row["PickupAddress"].", ".$row["OrderCity"];
											//$row_array["pickupdate"]=$pickupdate;
	//$row_array["order_date"]=$row["OrderDate"];																						
	$row_array["pickupdate"]=date("Y-m-d", strtotime($pickupdate));				
			
		$row_array["remarks"]=$row["Remarks"];																				
		$row_array["delivery_type"]=$row["OrderDeliveryType"];
$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["PayableAmount"]) ? $row["PayableAmount"] : " ₹ ".$row["PayableAmount"]) );
				
	//In $row_array["order_total_amt_weight"] we are getting value as - 1stly check order type is subscription or other .if order type is subscription then further check
	//ordertotalweight. if order totalweight is zero then print hiphen else print order total weight with kg.
	//if order type other then check order totalamount either null or not  
						
 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
         	$data2=mysql_fetch_array($result2);
$deliverbyriderId=$row['DeliverByRider_Id'];	
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
 echo json_encode($all_order);

   	
  
  mysql_close();
  ob_end_flush();
  
 	?>

	
					