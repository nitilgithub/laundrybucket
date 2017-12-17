<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$normal_order=array();

             
										
										
										$result=mysql_query("select * from tbl_orders where (OrderType='laundry' or OrderType='standard_laundry') order by OrderId DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   		$order_statusid=$row["OrderStatusId"];
									   
										$row_array["order_id"]=$row["OrderId"]; 
										//$row_array["order_username"]=$row["OrderUserName"];
										$row_array["order_statusid"]=$row["OrderStatusId"];
										
										$row_array["order_email"]=$row["OrderEmail"];
										
										$row_array["order_phone"]=$row["OrderPhone"];
										
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
										
										$row_array["order_date"]=$row["OrderDate"];
									
									$row_array["order_total_amt"]=empty($row["OrderTotalAmount"]) ? $row["OrderTotalAmount"] : " ₹ ".$row["OrderTotalAmount"] ;
										
										
							 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
		                             	$data2=mysql_fetch_array($result2);
										 
										$row_array["order_statustext"]=$data2["order_status_text"];
										
										array_push($normal_order,$row_array);
		                             	
										
									
									   }
									 echo json_encode($normal_order);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>
								
										
								