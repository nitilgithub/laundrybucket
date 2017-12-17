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
$insert_order=array();
$ord_type=$_GET["otype"];
$name=$_GET["txtname"];
$uid=$_GET["ouid"];
$ussubstype=$_GET["usubsid"];
$email=$_GET["txtemail"];
$phone=$_GET["txttel"];
$city=$_GET["city"];
$address=$_GET["txtaddress"];
$pickdate=$_GET["txtpicckupdate"];
$picktime=$_GET["txttime"];
$order_status_id=$_GET["ostatusid"];
$delivery_type=$_GET["deliver_type"];
$review=$_GET["txtremark"];
 										
 $result=mysqli_query($link,"insert into tbl_orders(OrderShipName,OrderType,OrderUserId,User_Subsid,OrderEmail,OrderPhone,OrderShipAddress,OrderCity,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Review)
  values('$name','$ord_type','$uid','$ussubstype','$email','$phone','$address','$city','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$review')") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
	                                  	
										$row_array["status"]=1;
									  }
										else
											{
											$row_array["status"]=0;	
											}
										
										array_push($insert_order,$row_array);
										echo json_encode($insert_order);
									  ob_end_flush();
									   mysqli_close($link);
									  ?>