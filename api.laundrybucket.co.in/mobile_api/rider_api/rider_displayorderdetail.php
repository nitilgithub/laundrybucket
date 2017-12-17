<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$oid=$_GET["oid"];

	
			$query="select * from tbl_orders where OrderId='$oid'";
			$result=mysqli_query($link,$query) or die(mysqli_error($link));
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_array($result);
				$uid=$row["OrderUserId"];
				$row_array['name'] =$row["OrderShipName"];
				$row_array['phone']=$row["OrderPhone"];
				$row_array['email'] =$row["OrderEmail"];
				$row_array['address']=$row["OrderShipAddress"];
				
				$row_array['otype'] =$row["OrderType"];
				$row_array['pickdate']=$row["Order_PickDate"];
				$row_array['deliverydate']=$row["delivery_date"];
				$row_array['ota']=$row["OrderTotalAmount"];
				
				$ota=$row["OrderTotalAmount"];
				$discount=$row["discount"];//This value is in %age
				$tax=$row["tax"];//This value is in %age
				$wallet_deduct_amt=$row["walletdeduction_amt"]; //wda amt is in rs.
				
			$row_array['wda'] = $row["walletdeduction_amt"];
		
		$discount_amt=($ota*$discount)/100;	
		$newota=$ota-$discount_amt;
		
		$row_array['discountamount'] = $discount_amt;
			
		$tax_amt=($newota*$tax)/100;
		
		$finalota=$newota+$tax_amt;
		
		$row_array['taxamount'] = $tax_amt;
		
		$payable_amt=$finalota-$wallet_deduct_amt;
		
		$row_array['payableamt'] = $payable_amt;	
				
			}
	
			//$row_array['status']="Your  review has been submitted successfully";
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>