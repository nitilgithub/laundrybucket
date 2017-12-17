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

$user_wallet=array();
//$uloginid=$_SESSION["uloginid"];
$uid=intval($_GET["uid"]);
//global $usemail;
										
									
										
				//in this section we are getting user wallet total amount
				$result2=mysqli_query($link,"SELECT ifnull(SUM(amount),0) as wta FROM tbl_wallet WHERE uid='$uid'") or die(mysqli_error($link));
			if(mysqli_num_rows($result2)>0)
			{
			$row2=mysqli_fetch_array($result2);
			
			$wallet_total_amt=$row2["wta"];
			
			if($wallet_total_amt==0) //have no money in wallet
			{
				$row_array["status"]="Wallet Empty";//Wallet Empty 
			}
			
			else { //user have some money in wallet
			
			
				
				//if user have money in their wallet then we will get how much money is used by user or how much money has been deducted from user wallet
				$result3=mysqli_query($link,"SELECT * FROM tbl_orders WHERE (OrderUserId='$uid' and Order_via='mobile' and OrderTotalAmount!='Null')") or die(mysqli_error($link));
			global $total_wallet_deduction;
			if(mysqli_num_rows($result3)>0)
			{	
				 while($row3=mysqli_fetch_array($result3))
		              {
		                             	 $ord_id=$row3[0];
										 
										 $total_wallet_deduction+=$row3["walletdeduction_amt"];
										 $payable_amount=$row3["OrderTotalAmount"]-$row3["walletdeduction_amt"];
		                             	 $i=$i+1;
										 
		                             	$row_array["srno"]=$i;
										$row_array["order_id"]=$ord_id;
										$row_array["order_type"]=$row3["OrderType"];
										$row_array["ordertotalamt"]=$row3["OrderTotalAmount"];
										$row_array["discount"]=$row3["walletdeduction_amt"];
										$row_array["payableamt"]=$payable_amount;
										$row_array["order_date"]=$row3["OrderDate"];
										$row_array["status"]=1;
										
										array_push($user_wallet,$row_array);
		                            }
				
			}
			}
	           echo json_encode($user_wallet);	
									   mysqli_close($link);
									  ob_end_flush();
									  
		}		
			
										
		
								
		                             	?>