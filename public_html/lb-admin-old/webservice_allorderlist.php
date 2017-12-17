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
                                    
										
										
										$result=mysql_query("select * from tbl_orders where(OrderStatusId!=5) order by OrderId DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   		$order_statusid=$row["OrderStatusId"];											$pickupdate=$row["Order_PickDate"];
									   												
										$row_array["order_id"]=$row["OrderId"];
										
										$row_array["order_type"]=$row["OrderType"];
										 
										//$row_array["order_username"]=$row["OrderUserName"];
										$row_array["order_statusid"]=$row["OrderStatusId"];
										
										$row_array["order_shipname"]=$row["OrderShipName"];
										$row_array["order_email"]=$row["OrderEmail"];
										
										$row_array["order_phone"]=$row["OrderPhone"];
										
										$row_array["order_city"]=$row["OrderCity"];
										
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
								
										
								