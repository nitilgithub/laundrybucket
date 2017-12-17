<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_wallet=array();
//$uloginid=$_SESSION["uloginid"];
$uid=intval($_GET["uid"]);
//global $usemail;
				
				$i=0;					
			//if user have money in their wallet then we will get how much money is used by user or how much money has been deducted from user wallet
			$result3=mysqli_query($link,"SELECT * FROM tbl_orders WHERE (OrderUserId='$uid' and Order_via='mobile' and OrderTotalAmount!='Null' and walletdeduction_amt!=0)") or die(mysqli_error($link));
			global $total_wallet_deduction;
			if(mysqli_num_rows($result3)>0)
			{	
				 while($row3=mysqli_fetch_array($result3))
		              {
		                             	
										$ord_id=$row3[0];
										$i=$i+1;
										$row_array["srno"]=$i;
										$row_array["order_id"]=$ord_id;
										$row_array["wallet_deductamount"]=$row3["walletdeduction_amt"];
										$row_array["order_date"]=$row3["addon"];
										$row_array["status"]=1;
										
										array_push($user_wallet,$row_array);
		               }
				
			}
			else 
			{
					$row_array["status"]=0;
					$row_array['message'] = "No Amount is deducted from your wallet";
					$row_array['title']="Alert"; // Alert Title
					array_push($user_wallet,$row_array);
			}
			
									echo json_encode($user_wallet);	
									mysqli_close($link);
									ob_end_flush();
									  
			
		                         ?>