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
$ota=$_GET["ota"]; //ota stands for order total amount
$discount=$_GET["discount"]; //This discount amount is in %age
$tax=$_GET["tax"]; //This tax amount is in %age




		
				$result4=mysqli_query($link,"SELECT ifnull(SUM(amount),0) as wta FROM tbl_wallet WHERE uid='$uid'") or die(mysqli_error($link));
			if(mysqli_num_rows($result4)>0)
			{
			$row4=mysqli_fetch_array($result4);
			
			$wallet_total_amt=$row4["wta"];
			
			if($wallet_total_amt==0) //have no money in wallet
			{
				
				$wallet_deduct_amt=0; //have no money in wallet so no deduction will be done from order total amount set wallet deduction amount to zero
			}
			
			else { //user have some money in wallet
				
				//if user have money in their wallet then we will get how much money is used by user or how much money has been deducted from user wallet
				$result5=mysqli_query($link,"SELECT ifnull(SUM(walletdeduction_amt),0) as wda FROM tbl_orders WHERE (OrderUserId='$uid'&& OrderId!='$oid')") or die(mysqli_error($link));
				
			if(mysqli_num_rows($result5)>0)
			{	
				$row5=mysqli_fetch_array($result5);
				
				$final_wallet_total_amt=$wallet_total_amt-$getwalletdeduct_amt; //get balanced or remaining wallet amount by subtracting (user's used wallet amount) from (user total wallet amount) 
				
				if($final_wallet_total_amt>0)
				{
					
				//Fetch wallet deduction amount % set or fixed by admin 
				$result3=mysqli_query($link,"SELECT * FROM tbl_reward") or die(mysqli_error($link));
			
				$row3=mysqli_fetch_array($result3);
				$fixed_walletdeduction_amt=$row3["walletDeduction"];
				//end Fetch wallet deduction amount % set or fixed by admin
					
					$wallet_discount=($ota*$fixed_walletdeduction_amt)/100;
					
					if($wallet_discount>$final_wallet_total_amt)
					{
						$wallet_deduct_amt=$final_wallet_total_amt;
						
					}
					else {
						$wallet_deduct_amt=$wallet_discount;
						
					}
				
				}
				else
					{
						$wallet_deduct_amt=0;
							echo "walbal".$wallet_deduct_amt;
					}
			}
			}
		}

		$row_array['wda'] = $wallet_deduct_amt;
		
		$discount_amt=($ota*$discount)/100;	
		$newota=$ota-$discount_amt;
		
		$row_array['discountamount'] = $discount_amt;
			
		$tax_amt=($newota*$tax)/100;
		
		$finalota=$newota+$tax_amt;
		
		$row_array['taxamount'] = $tax_amt;
		
		$payable_amt=$finalota-$wallet_deduct_amt;
		
		$row_array['payableamt'] = $payable_amt;
		
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>