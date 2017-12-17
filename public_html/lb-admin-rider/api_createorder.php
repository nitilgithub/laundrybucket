<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$order_id=$_POST['orderid'];
	$fname=mysql_real_escape_string(trim($_POST["fname"]));
	$lname=mysql_real_escape_string(trim($_POST["lname"]));
	$email=mysql_real_escape_string(trim($_POST["email"]));		
	$phone1=mysql_real_escape_string(trim($_POST["phone1"]));
	$phone2=mysql_real_escape_string(trim($_POST["phone2"]));
	$pickup_address=mysql_real_escape_string(trim($_POST["address"]));
	$pickdate=trim($_POST["pickdate"]);
	$picktime=trim($_POST["picktime"]);
	$delivery_add=trim($_POST["address"]);
	$city=$_POST["city"];
	$order_status_id=$_POST["orstatus"];
	$delivery_type=$_POST["dtype"];
	
	/*$ddate=trim($_POST["deliverydate"]);
	$date = DateTime::createFromFormat('m/d/Y', $ddate);
	$deliverydate=$date->format('Y-m-d');*/
	
	$deliverydate=trim($_POST["deliverydate"]);
	
	$ord_type=trim($_POST["ordercat"]);
	$remarks=trim($_POST["review"]);
	$user_type='websiteuser';
	$createdby="adminorder";
	$user_status=0;
	$upass=md5(rand(1111,9999));
	$regdate=date("Y-m-d");
	$uid=$_POST['getuid'];
	$verify_code=rand(1111,9999);
	$order_via='website';
	$createdby="admin";
	if(!empty($phone2))
	{
		$res5=mysql_query("select * from tblusers where UserId='$uid'");
		if(mysql_num_rows($res5)>0)
		{
			$res6=mysql_query("update tblusers set UserPhone2='$phone2' where UserId='$uid'");
		}
	}
	if(!empty($email))
	{
		$res5=mysql_query("select * from tblusers where UserId='$uid' and UserEmail=''");
		if(mysql_num_rows($res5)>0)
		{
			$res6=mysql_query("update tblusers set UserEmail='$email' where UserId='$uid'");
		}
	}
	if($uid=="")
	{
		$res1=mysql_query("insert into tblusers(UserType,UserEmail,UserPassword,UserFirstName,UserLastName,UserCity,UserVerifiedStatus,UserRegistrationDate,UserVerificationCode,UserPhone,UserAddress,UpdateRemarks,CreatedBy,UserPhone2) values('$user_type','$email','$upass','$fname','$lname','$city','$user_status','$regdate','$verify_code','$phone1','$pickup_address','$remarks','$createdby','$phone2')");
		if(mysql_affected_rows())
		{
		$uid=mysql_insert_id();
		$res2=mysql_query("insert into tblusers_address(UserId,Address,addon) values('$uid','$pickup_address',NOW())");
    	}
	}
	
	$res3=mysql_query("update tbl_orders set OrderUserId='$uid',Order_PickDate='$pickdate',Order_PickTime='$picktime',PickupAddress='$pickup_address',Remarks='$remarks',Order_Via='$order_via',CreatedBy='$createdby',OrderStatusId='$order_status_id',addon=now() where OrderId='$order_id'");
	if($res3)
	{
	if($ord_type==-1)
	{
		echo "<script>alert('No order/service type selected');</script>";
	}
	else
	{
		$res4=mysql_query("insert into tbl_suborders(OrderId,UserId,OrderTypeId,DeliveryTypeId,DeliveryDate,DeliveryAddress,Remarks) values('$order_id','$uid','$ord_type','$delivery_type','$deliverydate','$delivery_add','$remarks')");
		if(mysql_affected_rows())
		{
			$oid=mysql_insert_id();
			$status=1;
		} 
		else{
			echo "<script>alert('error');</script>".mysql_error();
			$status=0;
		}

	}
	}
$i=1;
$rows["status"]=$status;
$rows["orderid"]=$order_id;
$rows["suborderid"]=$oid;
$rows["userid"]=$uid;
$rows["serviceid"]=$ord_type;
array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
