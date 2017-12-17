<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
    die("Connection failed: " . mysqli_connect_error());
}
$display_order=array();
$oid=intval($_GET["oid"]);

										
                                        $result2=mysqli_query($link,"select * from tbl_orders where OrderId='$oid'") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                $row=mysqli_fetch_array($result2);
										
										//$ord_deliverytype_id=$row["DeliveryTypeId"];
		                             
										$row_array["ord_no"]=$row["OrderId"];
										$row_array["ord_date"]=$row["addon"];
										$row_array["pickdate"]=$row["Order_PickDate"];
										$row_array["picktime"]=$row["Order_PickTime"];
										$row_array["pickaddress"]=$row["PickupAddress"];
										$row_array["city"]=$row["OrderCity"];
										$row_array["remarks"]=$row["Remarks"];
										
										$row_array["status"]=1;
										$row_array['message'] = "Order Placed successfully";
										$row_array['title']="Alert"; // Alert Title			
																			                             
		                    //$result3=mysqli_query($link,"select * from tbl_deliverytypes where DeliveryId='$ord_deliverytype_id'") or die(mysqli_error($link));
		                    //$data3=mysqli_fetch_array($result3);
										 
										//$row_array["ord_deliverytype"]=$data3["DeliveryTitle"];
										
										
								
										//$row_array["ord_type"]=$row["OrderType"];
										array_push($display_order,$row_array);
		                            
									 echo json_encode($display_order);
									  }
										
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>
		                             	