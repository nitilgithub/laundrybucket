<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$all_order=array();

$fdate=mysql_real_escape_string($_GET['fdate']);
$sdate=mysql_real_escape_string($_GET['sdate']);
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
	
	 */$query="SELECT `OrderId`,`OrderReceiptId`,`OrderType`,`OrderSubType`,`OrderUserId`,`User_Subsid`,
`OrderTotalAmount`,`OrderTotalWeight`,`OrderShipName`,`OrderShipAddress`,`delivery_address`,
`OrderCity`,`OrderState`,`OrderZip`,`OrderCountry`,`OrderPhone`,`OrderFax`,
`OrderShipping`,`OrderEmail`,`OrderDate`,`OrderStatusId`,`OrderTrackingNumber`,
`OrderCustReceiptCopy`,`OrderDeliveryType`,ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
as Order_PickupDate,
`Order_PickTime`,`Review`,`Order_Via`,`walletdeduction_amt`,`CreatedBy`,
`RiderId`,`delivery_date`,`discount`,`tax`,`PaidAmount` FROM
`tbl_orders` where
((ifnull(str_to_date(Order_PickDate,'%m/%d/%Y'),Order_PickDate)
between str_to_date('$fdate','%m/%d/%Y') and
str_to_date('$sdate','%m/%d/%Y'))&& (OrderStatusId=4)&& PaidAmount<OrderTotalAmount)";
                                    
										
										
										$result=mysql_query($query) or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   		$order_statusid=$row["OrderStatusId"];											$pickupdate=$row["Order_PickupDate"];
									   												
										$row_array["order_id"]=$row["OrderId"];
										
										$row_array["order_type"]=$row["OrderType"];
										 
										//$row_array["order_username"]=$row["OrderUserName"];
										$row_array["order_statusid"]=$row["OrderStatusId"];
										
										$row_array["order_shipname"]=$row["OrderShipName"];
										$row_array["order_email"]=$row["OrderEmail"];
										
										$row_array["order_phone"]=$row["OrderPhone"];
										$row_array["PaidAmount"]=$row["PaidAmount"];
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
																				//$row_array["pickupdate"]=$pickupdate;
										//$row_array["order_date"]=$row["OrderDate"];																						
									$row_array["pickupdate"]=date("Y-m-d", strtotime($pickupdate));										
																				$row_array["remarks"]=$row["Review"];																				$row_array["delivery_type"]=$row["OrderDeliveryType"];
							$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["OrderTotalAmount"]) ? $row["OrderTotalAmount"] : " ₹ ".$row["OrderTotalAmount"]) );
													
										//In $row_array["order_total_amt_weight"] we are getting value as - 1stly check order type is subscription or other .if order type is subscription then further check
										//ordertotalweight. if order totalweight is zero then print hiphen else print order total weight with kg.
										//if order type other then check order totalamount either null or not  
													
							 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
		                             	$data2=mysql_fetch_array($result2);
										 
										$row_array["order_statustext"]=$data2["order_status_text"];
										
										array_push($all_order,$row_array);
		                             	
										
									
									   }
									 echo json_encode($all_order);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>
								
										
								