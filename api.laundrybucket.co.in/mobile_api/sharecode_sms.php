<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$phone=mysqli_real_escape_string($link,trim($_GET["phone"]));
$phone=mysqli_real_escape_string($link,trim($_GET["rfcode"]));
//$share_message=mysqli_real_escape_string($link,trim($_GET["share_message"]));

//$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate . Pickup $picktime . Client $name . Ph $phone .");

$txtmsg=urlencode("Download Laundry Bucket App and create account by using $referal_code refer code and earn INR 1000 Download Now. https://play.google.com/store/apps/details?id=com.laundrybucket.app");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$phone&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										//curl_exec($ch);
										
								    if($result = curl_exec($ch))
								    {
								//header("location:thanku.php");
								$row_array["msg"]="Send Success";
								$row_array["status"]=1;
									} 
									else {
										$row_array["status"]=0;
									}
										curl_close($ch);

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>