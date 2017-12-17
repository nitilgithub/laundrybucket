<?php
@ob_start();
@session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$insert_quickorder=array();
$ord_type=$_GET["otype"];
$uid=$_GET["ouid"];
$pickdate=$_GET["txtpickupdate"];
$picktime=$_GET["txttime"];
$order_status_id=$_GET["ostatusid"];
$delivery_type=$_GET["deliver_type"];
$order_via="mobile";
$createdby="user";
//$user_subscription_id=$_GET["usubid"];
if(isset($_GET["usubid"]))
{
	$user_subscription_id="'".$_GET["usubid"]."'";
	$order_total_weight='0';
	
}
else {
	$user_subscription_id= "NULL";
	$order_total_weight="NULL";
}


 	if(empty($pickdate) || empty($uid) || empty($picktime)  || empty($ord_type) || $delivery_type==-1)
	{
		$row_array["status"]=0;	
		$row_array["message"]="Please Fill All Fields";
		array_push($insert_quickorder,$row_array);		echo json_encode($insert_quickorder);
	}		
	else {
		
		$q="select * from tblusers where UserId='$uid'";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
if(mysqli_affected_rows($link))
{
	$data=mysqli_fetch_array($r); 
	if(empty($data["UserFirstName"]) || empty($data["UserPhone"]) || empty($data["UserAddress"]))
	{
		$row_array["status"]=0;
		$row_array["message"]="Please review Personal Info";	
	}
	
	else
		{
								$query="select * from  tblusers where UserId='$uid'";
								$res=mysqli_query($link,$query);
								$row=mysqli_fetch_array($res);
								$ordername=$row["UserFirstName"];
								$orderemail=$row['UserEmail'];
								$order_phone=$row['UserPhone'];
								$order_address=$row['UserAddress'];
											
 $result=mysqli_query($link,"insert into tbl_orders(OrderType,OrderUserId,User_Subsid,OrderTotalWeight,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Order_Via,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress,CreatedBy)
  values('$ord_type','$uid',$user_subscription_id,$order_total_weight,'$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$order_via','$ordername','$orderemail','$order_phone','$order_address','$createdby')") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
	                                  	$row_array["status"]=1;
	                                  	$ordid=mysqli_insert_id($link);
										$row_array["orderid"]=mysqli_insert_id($link);
										
										
								 }
										else
											{
											$row_array["status"]=0;	
											$row_array["message"]="Error Try Again";
											}
		}
}	
										array_push($insert_quickorder,$row_array);
										echo json_encode($insert_quickorder);
									  ob_end_flush();
	}
									   mysqli_close($link);
									  ?>