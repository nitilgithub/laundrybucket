<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
global $wallet_deduct_amt;
$uid=$_GET["uid"];
$oid=$_GET["oid"];
$ota=$_GET["ota"]; //ota stands for order total amount(its not a payable amount)
$discount=$_GET["discount"]; //This discount amount is in %age
$tax=$_GET["tax"]; //This tax amount is in %age
$wallet_deduct_amt=$_GET["wallet"];
$remarks=mysqli_real_escape_string($link,strip_tags($_GET["remarks"]));
$remarksby="rider";
$remarksbyid=$_GET["riderid"];
$ddate=mysqli_real_escape_string($link,strip_tags($_GET["ddate"])); // ddate stands for delivery date


		
		$q1="update tbl_orders set OrderTotalAmount='$ota', discount='$discount',tax='$tax',walletdeduction_amt='$wallet_deduct_amt',Review='$remarks',delivery_date='$ddate' where (OrderId='$oid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			if($r)
			{
				$row_array['flag'] = 1;
				$row_array['wallet'] = $wallet_deduct_amt;
				if($remarks!='')
				{
				
				$q2="insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$oid','$uid','$remarks','$remarksby','$remarksbyid',NOW())";
				$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
				}
				
			}
			//$row_array['status']="Your  review has been submitted successfully";
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>