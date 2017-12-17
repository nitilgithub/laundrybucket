<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$filterorderslist=array();
$fdate=$_GET['fdate'];
$sdate=$_GET['sdate'];
$type=$_GET['type'];
$query="";
            					if($type=='all')
								{
									 $query="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=b.DeliveryStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$fdate','%m/%d/%Y') and str_to_date('$sdate','%m/%d/%Y'))&& (o.OrderStatusId!=5)) order by o.OrderId";
								}					
								else 
								{
						
							
                                        $query="SELECT o.OrderId,o.OrderReceiptId,s.ServiceName,o.OrderUserId,b.TotalAmount,b.TotalWeight,u.UserFirstName,u.UserLastName,o.PickupAddress,b.DeliveryAddress,o.OrderCity,u.UserPhone,u.UserEmail,o.addon,t.order_status_text,d.DeliveryTitle,ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)as Order_PickupDate,o.Order_PickTime,b.Remarks,o.Order_Via,o.CreatedBy,
b.DeliveryDate,b.OfferDiscount,b.ManualDiscount,b.tax,o.PaidAmount FROM
tbl_orders as o join tbl_suborders as b on o.OrderId=b.OrderId join tbl_services as s on b.OrderTypeId=s.ServiceId join tblusers as u on u.UserId=b.UserId join tbl_orderstatus_id as t on t.order_status_id=b.DeliveryStatusId join tbl_deliverytypes as d on d.DeliveryId=b.DeliveryTypeId where
((ifnull(str_to_date(o.Order_PickDate,'%m/%d/%Y'),o.Order_PickDate)
between str_to_date('$fdate','%m/%d/%Y') and str_to_date('$sdate','%m/%d/%Y'))&& (o.OrderStatusId!=5)&& (s.ServiceName like '%".$type."%')) order by o.OrderId";					
								
								}
								
													
								       $result=mysql_query($query)or die(mysql_error());
										if(mysql_affected_rows())
	                                   {
		                                while($row=mysql_fetch_array($result))
		                             {
		                             	$order_statusid=$row["OrderStatusId"];
		                             	
		                             	
										$row_array["order_id"]=$row["OrderId"];
										$row_array["OrderReceiptId"]=$row["OrderReceiptId"];
										$row_array["order_type"]=$row["ServiceName"] ;
										
										//$row_array["OrderSubType"]=$row["OrderSubType"];
										
										$row_array["OrderUserId"]=$row["OrderUserId"];
										
										//$row_array["User_Subsid"]=$row["User_Subsid"];
										
									
										$row_array["OrderTotalAmount"]=$row["TotalAmount"];
										$row_array["OrderTotalWeight"]=(empty($row["TotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ");
										
										$row_array["order_shipname"]=$row["UserFirstName"]." ".$row["UserLastName"];
										$row_array["order_shipaddress"]=$row["PickupAddress"];
										$row_array["delivery_address"]=$row["DeliveryAddress"];
									
										$row_array["OrderCity"]=$row["OrderCity"];
										
										/*$row_array["OrderState"]=$row["OrderState"] ;
										$row_array["OrderZip"]=$row["OrderZip"];
										$row_array["OrderCountry"]=$row["OrderCountry"];*/
										
										$row_array["order_phone"]=$row["UserPhone"];
	
										/*$row_array["OrderFax"]=$row["OrderFax"];
										$row_array["OrderShipping"]=$row["OrderShipping"] ;*/
										
										
										$row_array["order_email"]=$row["UserEmail"];
										$row_array["OrderDate"]=$row["addon"];
									
										$row_array["order_statustext"]=$row["order_status_text"];
										
										/*$row_array["OrderTrackingNumber"]=$row["OrderTrackingNumber"] ;
										$row_array["OrderCustReceiptCopy"]=$row["OrderCustReceiptCopy"];*/
										
										$row_array["OrderDeliveryType"]=$row["DeliveryTitle"];
										$row_array["pickupdate"]=$row["Order_PickupDate"];
										
										
									
										$row_array["Order_PickTime"]=$row["Order_PickTime"];
										$row_array["Review"]=$row["Remarks"] ;
										$row_array["Order_Via"]=$row["Order_Via"];
										
										//$row_array["walletdeduction_amt"]=$row["walletdeduction_amt"];
										
										$row_array["CreatedBy"]=$row["CreatedBy"];
										
										//$row_array["RiderId"]=$row["RiderId"] ;
										
										$row_array["delivery_date"]=$row["DeliveryDate"];
										$row_array["discount"]=$row["OfferDiscount"]+$row['ManualDiscount'];
										$row_array["tax"]=$row["tax"];
										$row_array["PaidAmount"]=$row["PaidAmount"];
									
/*$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["OrderTotalAmount"]) ? $row["OrderTotalAmount"] : " ₹ ".$row["OrderTotalAmount"]) );									
										
										
										 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
		                             	$data2=mysql_fetch_array($result2);
										$row_array["order_statustext"]=$data2["order_status_text"];*/
										

$row_array['orderdetail']="Receipt No: ".$row["OrderReceiptId"]."<br>Type: ".$row["ServiceName"]."<br>Date: ".$row["addon"]."<br>Status: ".$row["order_status_text"]."<br>Pickup Date: ".$row["Order_PickupDate"]."<br>Pickup Time: ".$row["Order_PickTime"]."<br>Delivery Type: ".$row["DeliveryTitle"]."<br>Delivery Addr: ".$row["DeliveryAddress"]."<br>Delivery Date: ".$row["DeliveryDate"]."<br>OrderVia: ".$row["Order_Via"]."<br>Created By: ".$row["CreatedBy"];

$row_array['userdetail']="UserId: ".$row["OrderUserId"]."<br>Name: ".$row["UserFirstName"]." ".$row["UserLastName"]."<br>Address: ".$row["PickupAddress"]."<br>City: ".$row["OrderCity"]."<br>Phone: ".$row["UserPhone"]."<br>Email: ".$row["UserEmail"];

$row_array['paydetail']="Total Amt: ".$row["TotalAmount"]."<br>Total Weight: ".$row_array["OrderTotalWeight"]."<br>Discount: ".$row_array["discount"]."<br>Tax: ".$row["tax"]."<br>Paid Amt: ".$row["PaidAmount"];																	
										
										array_push($filterorderslist,$row_array);
		                             	
										
									 }
									 
									 echo json_encode($filterorderslist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>