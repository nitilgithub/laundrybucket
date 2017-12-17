<?php
@ob_start();
@session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../class.phpmailer.php';
require '../class.smtp.php';
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
					
$pay_order=array();

$oid=intval($_GET["oid"]);
$uid=intval($_GET["uid"]);
//$pickdat=$_GET["txtpickupdate"];
global $total_payamt;
$paymentmode=mysqli_real_escape_string($link,$_GET["paymentmode"]);
$payamount=mysqli_real_escape_string($link,$_GET["amount"]);


//$remarks=mysqli_real_escape_string($link,$_GET["remarks"]);
//$remarksby="user";
//$remarksbyid=intval($_GET["uid"]);


 	if(empty($paymentmode) || empty($amount))
	{
		$row_array["status"]=0;
		$row_array['message'] = "Please Fill All Fields";
		$row_array['title']="Alert"; // Alert Title	
		array_push($insert_order,$row_array);	
		echo json_encode($pay_order);
	}		
	else {
		
		
		$result=mysqli_query($link,"insert into tbl_payment_history(OrderId,UserId,ModeofPayment,AmountPaid,addon)
		  values('$oid','$uid','$paymentmode','$payamount',NOW())") or die(mysqli_error($link));
		  if(mysqli_affected_rows($link))
	         {
		            $q="select sum(AmountPaid) as amountpaid from tbl_payment_history where OrderId='$oid'";
					$r=mysqli_query($link,$q) or die(mysqli_error($q));
					if(mysqli_num_rows($r)>0)
					{
						$row=mysqli_fetch_array($r);
					 	$total_payamt=$row["amountpaid"];
					}
					else {
						$total_payamt=$payamount;
					}
							
				$q1="update tbl_orders set ModeofPayment='$paymentmode', PaidAmount='$total_payamt', where (OrderId='$oid')";
				$r1=mysqli_query($link,$q1) or die(mysqli_error($link));
				if(mysqli_affected_rows($link))
				{
					$row_array['status'] = 1;
					$row_array['message'] = "Your Payment Done Successfully";
					$row_array['title']="Alert"; // Alert Title
				}
				else {
					
					$row_array['status'] = 0;
					$row_array['message'] = "Failure Payment";
					$row_array['title']="Alert"; // Alert Title
				}
				          
						  
			}

		else {
			
			$row_array['status'] = 0;
			$row_array['message'] = "Failure Payment";
			$row_array['title']="Alert"; // Alert Title
		}
		  
		
		
						
		
}	
										array_push($pay_order,$row_array);
										echo json_encode($pay_order);
									  ob_end_flush();
	
									   mysqli_close($link);
									  ?>