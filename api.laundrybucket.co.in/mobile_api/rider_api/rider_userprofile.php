<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
/*Getting User Information*/
$uid=$_GET["uid"];
$uname=mysqli_real_escape_string($link,strip_tags($_GET["uname"]));
$uphone2=mysqli_real_escape_string($link,strip_tags($_GET["uphone2"]));
$uemail=mysqli_real_escape_string($link,strip_tags($_GET["uemail"]));
$address=mysqli_real_escape_string($link,strip_tags($_GET["address"]));


/* Getting User Order Information*/
$ord_type=$_GET["otype"];
$pickdate=date("Y-m-d");
date_default_timezone_set('Asia/Kolkata'); //set time zone
$picktime=date('H:i a');
$order_status_id=0;
$delivery_type="normal";
$order_via="mobile";
$createdby="rider";
$rider_id=$_GET["riderid"];
//$user_subscription_id=$_GET["usubid"];
/*
if(isset($_GET["usubid"]))
{
	$user_subscription_id="'".$_GET["usubid"]."'";
	$order_total_weight='0';
	
}
else {
	$user_subscription_id= "NULL";
	$order_total_weight="NULL";
}
*/

 if(empty($uname)||empty($address)||empty($ord_type))
	{
		$row_array['flag']=0;
		$row_array['status'] = "Please Enter Required Information ie name & address & order type";
	}
	else 
	{
		/*
		if($uphone2=='')
		{
			$q="select * from tblusers where(UserEmail='$uemail'&&UserEmail!='')";
		}
		else {
		$q="select * from tblusers where((UserEmail='$uemail'&&UserEmail!='') OR (UserPhone='$uphone2') or (UserPhone='$uphone2'))";	
		}
			*/
			
			//$q="select * from tblusers where UserPhone='$umob'";
			
			if($uemail=='')
			{
					$q1="update tblusers set UserFirstName='$uname', UserEmail='$uemail',UserAddress='$address', UserPhone2='$uphone2' where (UserId='$uid')";
				    $r=mysqli_query($link,$q1) or die(mysqli_error($link));
					
					$r2=mysqli_query($link,"insert into tbl_orders(OrderType,OrderUserId,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Order_Via,CreatedBy,RiderId,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress)
		           values('$ord_type','$uid','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$order_via','$createdby','$rider_id','$uname','$uemail','$uphone2','$address')") or die(mysqli_error($link));
					
					if($r2)
					{
		               $row_array['flag'] = 1;
			           $ordid=mysqli_insert_id($link);
					   $row_array["orderid"]=mysqli_insert_id($link);	                                	
					    $row_array["uid"]=$uid;
					}
		            else
		            {
					$row_array['flag'] = 0;	
					$row_array["message"]="Error Try Again";
					}								
			}
			
			else {
			
	$query="select * from tblusers where(UserEmail='$uemail')";	
			
	$result=mysqli_query($link,$query) or die(mysqli_error($link));
	if(mysqli_num_rows($result)>0)
	{
		$roww=mysqli_fetch_array($result);
		$dub_uid=$roww["UserId"]; //dub stands for dublicate
		//echo $uiid;
		
		if($uid!=$dub_uid)
		{
		$row_array['flag']=0;
		//$row_array['status'] = "This Email Address is Already registered with other user";	
		}

		else {
			$q1="update tblusers set UserFirstName='$uname', UserEmail='$uemail',UserAddress='$address', UserPhone2='$uphone2' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			$r2=mysqli_query($link,"insert into tbl_orders(OrderType,OrderUserId,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Order_Via,CreatedBy,RiderId,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress)
		           values('$ord_type','$uid','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$order_via','$createdby','$rider_id','$uname','$uemail','$uphone2','$address')") or die(mysqli_error($link));
					
					if($r2)
					{
		               $row_array['flag'] = 1;
			           $ordid=mysqli_insert_id($link);
					   $row_array["orderid"]=mysqli_insert_id($link);
					   $row_array["uid"]=$uid;	                                	
												
					}
		            else
		            {
					$row_array['flag'] = 0;	
					$row_array["message"]="Error Try Again";
					}						
		}
		
	}
	
	else 
	  {
		
		$q1="update tblusers set UserFirstName='$uname', UserEmail='$uemail',UserAddress='$address', UserPhone2='$uphone2' where (UserId='$uid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			
			$r2=mysqli_query($link,"insert into tbl_orders(OrderType,OrderUserId,Order_PickDate,Order_Picktime,OrderDate,OrderStatusId,OrderDeliveryType,Order_Via,CreatedBy,RiderId,OrderShipName,OrderEmail,OrderPhone,OrderShipAddress)
		           values('$ord_type','$uid','$pickdate','$picktime',NOW(),'$order_status_id','$delivery_type','$order_via','$createdby','$rider_id','$uname','$uemail','$uphone2','$address')") or die(mysqli_error($link));
					
					if($r2)
					{
		               $row_array['flag'] = 1;
			           $ordid=mysqli_insert_id($link);
					   $row_array["orderid"]=mysqli_insert_id($link);
					   $row_array["uid"]=$uid;	                                	
												
					}
		            else
		            {
					$row_array['flag'] = 0;	
					$row_array["message"]="Error Try Again";
					}						
			
		
		}	
	}
}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>