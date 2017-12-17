<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
session_start();
// following files need to be included
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Confirmation Page</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="row">
			<div>&nbsp;</div>
<?php

$cuid=$_SESSION["cid"];
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	
	if (isset($_POST) && count($_POST)>0 )
	{
		$EMailArr=array(); 
		foreach($_POST as $paramName => $paramValue) {
			
				//echo "<br/>" . $paramName . " = " . $paramValue;
				
			$EMailArr[$paramName]=$paramValue;
			
		}
					if(is_array($EMailArr)){
			
					    $sql = "INSERT INTO tbl_paytm_payment(mid,orderId,txnAmount,currency,txnId,bankTxnId,status,respCode,respMsg,txnDate,gatewayName,bankName,paymentMode,checksumHash,addon) values ";
					
					    $valuesArr = array();
					    
					
					        $mid = mysqli_real_escape_string($link,$EMailArr['MID']);
					        $oid = mysqli_real_escape_string($link, $EMailArr['ORDERID'] );
					        $txnamt = mysqli_real_escape_string($link, $EMailArr['TXNAMOUNT'] );
							$currency = mysqli_real_escape_string($link, $EMailArr['CURRENCY'] );
					        $txnid = mysqli_real_escape_string($link, $EMailArr['TXNID'] );
							$banktxnid = mysqli_real_escape_string($link, $EMailArr['BANKTXNID'] );
					        $status = mysqli_real_escape_string($link, $EMailArr['STATUS'] );
					        $respcode = mysqli_real_escape_string($link, $EMailArr['RESPCODE'] );
					        $respmsg = mysqli_real_escape_string($link, $EMailArr['RESPMSG'] );
							$txndate = mysqli_real_escape_string($link, $EMailArr['TXNDATE'] );
					        $gateway = mysqli_real_escape_string($link, $EMailArr['GATEWAYNAME'] );
							$bankname = mysqli_real_escape_string($link, $EMailArr['BANKNAME'] );
					        $paymentmode = mysqli_real_escape_string($link, $EMailArr['PAYMENTMODE'] );
					        $checksum = mysqli_real_escape_string($link, $EMailArr['CHECKSUMHASH'] );
					
					        $valuesArr[] = "('$mid', '$oid', '$txnamt','$currency','$txnid','$banktxnid','$status','$respcode','$respmsg','$txndate','$gateway','$bankname','$paymentmode','$checksum',now())";
					  
					
					    $sql .= implode(',', $valuesArr);
						mysqli_query($link,$sql);
		}
		}
	
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		?>
		<div class="col-md-12 col-xs-12">
			<center>
			<h3 class="text-center">Success !</h3>
			<p>You just paid <?php echo $_POST["TXNAMOUNT"] ?> to Laundry Bucket.</p>
			<img src="payment-successful.png" class="img-responsive" />
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<b>Press Back to Close.</b>
			</center>
		</div>
		<?php
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
		$respcode=$_POST["RESPCODE"]; 
		$status=$_POST["STATUS"];
		$amount=$_POST["TXNAMOUNT"];
		$orderid=explode("_", $_POST["ORDERID"]);
		$oid=$orderid[1];
		$paymentmode="Paytm";
		if($respcode==1){
		  $result=mysqli_query($link,"insert into tbl_payment_history(OrderId,UserId,ModeofPayment,AmountPaid,addon)
		  values('$oid','$cuid','$paymentmode','$amount',NOW())") or die(mysqli_error($link));
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
						$total_payamt=$amount;
					}
							
				$q1="update tbl_orders set ModeofPayment='$paymentmode', PaidAmount='$total_payamt' where OrderId=$oid";
				$r1=mysqli_query($link,$q1) or die(mysqli_error($link));
						  
			}
		}
	}
	else {
		//echo "<b>Transaction status is failure</b>" . "<br/>";
		
		?>
		<div class="col-md-12 col-xs-12">
			<center>
			<h3 class="text-center">failure !</h3>
			<p>Transaction is failure of <?php echo $_POST["TXNAMOUNT"]; ?> to Laundry Bucket.</p>
			
			<img src="fail.png" class="img-responsive" />
			<p><?php echo $_POST["RESPMESG"]; ?></p>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<b>Press Back to Close.</b>
			</center>
		</div>
		<?php
	}

	

}
else {
	//echo "<b>Checksum mismatched.</b>";
	?>
	<div class="col-md-12 col-xs-12">
			<center>
			<h3 class="text-center">failure !</h3>
			<p>Transaction is failure of <?php echo $_POST["TXNAMOUNT"] ?> to Laundry Bucket.</p>
			<img src="fail.png" class="img-responsive" />
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<b>Press Back to Close.</b>
			</center>
		</div>
	<?php
	//Process transaction as suspicious.
}
mysqli_close($link);
?>
     </div>
   </div>
 </body>
</html>