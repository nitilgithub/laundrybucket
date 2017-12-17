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
										
$query1=mysqli_query($link,"select * from tbl_wallet where uid='$uid' and status=0");
if(mysqli_num_rows($query1)>0)
{
	$rfquery="select * from tbl_reward";
	$rfresult=mysqli_query($link,$rfquery) or die(mysqli_error($link));
	$rfrow=mysqli_fetch_array($rfresult);
	
	$surprise_reward=$rfrow["SurpriseRewardAmount"];
	
	$query2=mysqli_query($link,"insert into tbl_wallet(uid,title,amount,addon) values('$uid','Surprise Reward','$surprise_reward',now())");
	if(mysqli_affected_rows($link))
	{
		$query3=mysqli_query($link,"update tbl_wallet set status=1 where uid='$uid'");
	}
}									
										
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
				//$result3=mysqli_query($link,"SELECT ifnull(SUM(walletdeduction_amt),0) as twda FROM tbl_orders WHERE (OrderUserId='$uid' and Order_via='mobile' and OrderTotalAmount!='Null')") or die(mysqli_error($link));
			
			$result3=mysqli_query($link,"SELECT ifnull(SUM(amount),0) as twda FROM tbl_wallet_history WHERE userId='$uid'") or die(mysqli_error($link));
			
			global $total_wallet_deduction;
			if(mysqli_num_rows($result3)>0)
			{	
				$row3=mysqli_fetch_array($result3);
		              
		                             	 
										 
										 $total_wallet_deduction=$row3["twda"];
								
										$row_array["wallet_total_amt"]=$row2["wta"];					  
									 	$row_array["wallet_used"]=$total_wallet_deduction;
									 
									 	$wallet_balance=$wallet_total_amt-$total_wallet_deduction;
									 
									 	$row_array["wallet_balance"]=$wallet_balance;
				
			}
		}
			array_push($user_wallet,$row_array);
	           echo json_encode($user_wallet);	
									   mysqli_close($link);
									  ob_end_flush();
									  
		}		
			
										
		
								
		                             	?>