<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$insert_subsorder=array();

                                        	
 $order_type=$_GET["otype"];
 $uid=$_GET["uid"];
 $user_subscription_id=$_GET["usubsid"];
 $order_total_weight=$_GET["otw"];
 $address=$_GET["address"];
 $uphone=$_GET["phone"];
 $uemail=$_GET["email"];
 $order_status_id=$_GET["ostatusid"];
 $pickdate=$_GET["pickdate"];
 $picktime=$_GET["picktime"];
 $review=$_GET["review"];
 										
 

	$result=mysqli_query($link,"insert into  tbl_orders(OrderType,OrderUserId,User_Subsid,OrderTotalWeight,OrderShipAddress,OrderPhone,OrderEmail,OrderDate,OrderStatusId,Order_PickDate,Order_PickTime,Review) values('$order_type','$uid','$user_subscription_id','$order_total_weight','$address','$uphone','$uemail',NOW(),'$order_status_id','$pickdate','$picktime','$review')") or die(mysql_error($link));
										if(mysqli_affected_rows($link))
	                                  {
										$row_array["msg"]="Order Placed Successfully";
									  }
										else
											{
											$row_array["msg1"]="Sorry, Please Try again";	
											}
										array_push($insert_subsorder,$row_array);

									 
									 echo json_encode($insert_subsorder);
									  
									  
									  
									 mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>