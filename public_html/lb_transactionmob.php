<?php include('header.php');


header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("paytmkit/lib/config_paytmmob.php");
require_once("paytmkit/lib/encdec_paytm.php");
?>
<div class="container-fluid">
	<div class="row">
	<div>&nbsp;</div>
	<div>&nbsp;</div>
</div>
 <div class="row" style="border: 1px solid #0080ff; margin-top:40px;">
		<div class="col-md-12" style="background-color: rgb(0,66,164);padding: 10px;color:white;">
		<center> <h3>Thanks for your transaction<br/></h3></center>
		</div>
		   
		    
		</div>
</div>
<br>
&nbsp;
<div class="col-md-12 col-sm-12 col-xs-12" style="line-height: 30px;" >
	<?php
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure. Please try again later.</b>" . "<br/>";
	}

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
					    
					
					        $mid = mysql_real_escape_string($EMailArr['MID']);
					        $oid = mysql_real_escape_string( $EMailArr['ORDERID'] );
					        $txnamt = mysql_real_escape_string( $EMailArr['TXNAMOUNT'] );
							$currency = mysql_real_escape_string( $EMailArr['CURRENCY'] );
					        $txnid = mysql_real_escape_string( $EMailArr['TXNID'] );
							$banktxnid = mysql_real_escape_string( $EMailArr['BANKTXNID'] );
					        $status = mysql_real_escape_string( $EMailArr['STATUS'] );
					        $respcode = mysql_real_escape_string( $EMailArr['RESPCODE'] );
					        $respmsg = mysql_real_escape_string( $EMailArr['RESPMSG'] );
							$txndate = mysql_real_escape_string( $EMailArr['TXNDATE'] );
					        $gateway = mysql_real_escape_string( $EMailArr['GATEWAYNAME'] );
							$bankname = mysql_real_escape_string( $EMailArr['BANKNAME'] );
					        $paymentmode = mysql_real_escape_string( $EMailArr['PAYMENTMODE'] );
					        $checksum = mysql_real_escape_string( $EMailArr['CHECKSUMHASH'] );
					
					        $valuesArr[] = "('$mid', '$oid', '$txnamt','$currency','$txnid','$banktxnid','$status','$respcode','$respmsg','$txndate','$gateway','$bankname','$paymentmode','$checksum',now())";
					  
					
					    $sql .= implode(',', $valuesArr);
					
					    if(mysql_query($sql))
						{
							//echo "inserted";
							$pid=mysql_insert_id();
							if($status=='TXN_SUCCESS')
							{
								$oarr=explode("-", $oid);
								$orderid=$oarr[1];
								$res=mysql_query("select * from tbl_orders where OrderId='$orderid'");
								$rw=mysql_fetch_array($res);
								$userid=$rw['OrderUserId'];
								
								$res1=mysql_query("insert into tbl_payment_history(OrderId,UserId,ModeofPayment,AmountPaid,AmountReceivedBy,RiderId,AmountReceivedOn,Remarks,addon) values('$orderid','$userid','Paytm','$txnamt','Company Account','-1','$txndate','Payment done through Paytm',now())");
								if(mysql_affected_rows())
								{
									//echo "done";
									
									$res2=mysql_query("update tbl_orders set ModeofPayment='Paytm',PaidAmount=(select sum(AmountPaid) from tbl_payment_history where OrderId='$orderid') where OrderId='$orderid'");
									if($res2)
									{
										//echo "success";
									}
									else {
										echo "Unable to update to order status. Please contact on given numbers.";
									}
								}
								else {
									echo "Unable to update to order status. Please contact on given numbers.";
								}
						}

						$quer1=mysql_query("select * from tbl_paytm_payment where pid='$pid'");
						$rws=mysql_fetch_array($quer1);
						?>
						
						<ul>
							<li>
								<b>Transaction Status</b> : <?php echo $rws['status'];?>
							</li>
							<li>
								<b>Transaction Amount</b> : <?php echo $rws['currency']." ".$rws['txnAmount'];?>
							</li>
							<li>
								<b>Transaction Id</b> : <?php echo $rws['txnId'];?>
							</li>
							<li>
								<b>Response Message</b> : <?php echo $rws['respMsg'];?>
							</li>
							
						</ul>
						<?php
							
						} 
						else {
							echo "Unable to update to order status. Please contact on given numbers.";
						}
					}
	}
	

}
else {
	echo "<b>Failed</b>";
	//Process transaction as suspicious.
}





 ?>

	
</div>
&nbsp;
<br>

<?php include('footer.php'); ?>