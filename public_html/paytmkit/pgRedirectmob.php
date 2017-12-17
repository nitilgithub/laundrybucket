<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytmmob.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

require_once('../connection.php');

$q="select ifnull(pid,0) pid from tbl_paytm_payment order by pid desc limit 0,1";
$res=mysql_query($q);
$row=mysql_fetch_array($res);
$id=$row[0]+1;

$ORDER_ID = "lb-".$_GET["orderid"]."-".$id;
$CUST_ID = $_GET["userid"];
$INDUSTRY_TYPE_ID = 'Retail';
$CHANNEL_ID = 'WAP';
$TXN_AMOUNT = $_GET["amt"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

$paramList["CALLBACK_URL"]="https://laundrybucket.co.in/lb_transactionmob.php";

//$paramList["MSISDN"] = '9729044645'; //Mobile number of customer
//$paramList["EMAIL"] = 'jainneha7257@gmail.com'; //Email ID of customer

//$paramList["VERIFIED_BY"] = "EMAIL"; //
//$paramList["IS_USER_VERIFIED"] = "YES"; //



//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>