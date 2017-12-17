<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$filterorderslist=array();
$fdate=mysql_real_escape_string($_GET['fdate']);
$sdate=mysql_real_escape_string($_GET['sdate']);
$type=mysql_real_escape_string($_GET['type']);
$query="";
            					if($type=='all')
								{
									 $query="SELECT `OrderId`,`OrderReceiptId`,`OrderType`,`OrderSubType`,`OrderUserId`,`User_Subsid`,
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
str_to_date('$sdate','%m/%d/%Y'))&& (OrderStatusId!=5))";
								}					
								else 
								{
						
							
                                        $query="SELECT `OrderId`,`OrderReceiptId`,`OrderType`,`OrderSubType`,`OrderUserId`,`User_Subsid`,
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
str_to_date('$sdate','%m/%d/%Y'))&& (OrderStatusId!=5)&& (OrderType like '%".$type."%') )";					
								
								}
								
													
								       $result=mysql_query($query)or die(mysql_error());
										if(mysql_affected_rows())
	                                   {
		                                while($row=mysql_fetch_array($result))
		                             {
		                             	$order_statusid=$row["OrderStatusId"];
		                             	
		                             	
										$row_array["order_id"]=$row["OrderId"];
										$row_array["OrderReceiptId"]=$row["OrderReceiptId"];
										$row_array["order_type"]=$row["OrderType"] ;
										$row_array["OrderSubType"]=$row["OrderSubType"];
										$row_array["OrderUserId"]=$row["OrderUserId"];
										$row_array["User_Subsid"]=$row["User_Subsid"];
									
										$row_array["OrderTotalAmount"]=$row["OrderTotalAmount"];
										$row_array["OrderTotalWeight"]=(empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ");
										
										$row_array["order_shipname"]=$row["OrderShipName"];
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
										$row_array["delivery_address"]=$row["delivery_address"];
									
										$row_array["OrderCity"]=$row["OrderCity"];
										$row_array["OrderState"]=$row["OrderState"] ;
										$row_array["OrderZip"]=$row["OrderZip"];
										$row_array["OrderCountry"]=$row["OrderCountry"];
										$row_array["order_phone"]=$row["OrderPhone"];
	
										$row_array["OrderFax"]=$row["OrderFax"];
										$row_array["OrderShipping"]=$row["OrderShipping"] ;
										$row_array["order_email"]=$row["OrderEmail"];
										$row_array["OrderDate"]=$row["OrderDate"];
									
										$row_array["order_statusid"]=$row["OrderStatusId"];
										$row_array["OrderTrackingNumber"]=$row["OrderTrackingNumber"] ;
										$row_array["OrderCustReceiptCopy"]=$row["OrderCustReceiptCopy"];
										$row_array["OrderDeliveryType"]=$row["OrderDeliveryType"];
										$row_array["pickupdate"]=$row["Order_PickupDate"];
										
										
									
										$row_array["Order_PickTime"]=$row["Order_PickTime"];
										$row_array["Review"]=$row["Review"] ;
										$row_array["Order_Via"]=$row["Order_Via"];
										$row_array["walletdeduction_amt"]=$row["walletdeduction_amt"];
										
										$row_array["CreatedBy"]=$row["CreatedBy"];
										$row_array["RiderId"]=$row["RiderId"] ;
										$row_array["delivery_date"]=$row["delivery_date"];
										$row_array["discount"]=$row["discount"];
										$row_array["tax"]=$row["tax"];
										$row_array["PaidAmount"]=$row["PaidAmount"];
									
$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["OrderTotalAmount"]) ? $row["OrderTotalAmount"] : " ₹ ".$row["OrderTotalAmount"]) );									
										
										
										 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
		                             	$data2=mysql_fetch_array($result2);
										$row_array["order_statustext"]=$data2["order_status_text"];
										
										
										
										array_push($filterorderslist,$row_array);
		                             	
										
									 }
									 
									 echo json_encode($filterorderslist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>