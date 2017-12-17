<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$ORDER_ID = "";
$requestParamList = array();
$responseParamList = array();

$requestParamList = array("MID" => 'Brogwa60765622703131' , "ORDERID" => "lb-2850-21");   

$checkSum = getChecksumFromArray($requestParamList,'7m&d4ErI0Q%oq35G');//merchant_key
$requestParamList['CHECKSUMHASH'] = urlencode($checkSum);

$data_string = "JsonData=".json_encode($requestParamList);
echo $data_string;

$ch = curl_init();                    // initiate curl
$url = "https://pguat.paytm.com/oltp/HANDLER_INTERNAL/getTxnStatus?"; // where you want to post data
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string); // define what you want to post
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$output = curl_exec($ch); // execute
$info = curl_getinfo($ch);

echo "kkk".$output;
$data = json_decode($output, true);
echo "<pre>";
print_r($data);
echo "</pre>";

?>