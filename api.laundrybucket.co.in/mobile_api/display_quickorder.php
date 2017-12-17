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

$quick_order=array();
//$uloginid=$_SESSION["uloginid"];
$oid=$_GET["oid"];

//global $usemail;
										
		
												$i=0;
                                        $result2=mysqli_query($link,"select * from tbl_orders where OrderId='$oid'") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                $row=mysqli_fetch_array($result2);
		                             
		                             	$pickdate=$row["Order_PickDate"];
										$picktime=$row["Order_PickTime"];
										$order_name=$row["OrderShipName"];
										$order_phone=$row["OrderPhone"];
										
										$row_array["ord_no"]=$row["OrderId"];
										$row_array["ord_date"]=$row["OrderDate"];
										$row_array["ord_dtype"]=$row["OrderDeliveryType"];
										
										//$row_array["ord_type"]=$row["OrderType"];
										array_push($quick_order,$row_array);
		                             
									 /*
									 //$txtmsg=urlencode("Dear $name your order has been received of INR $address and its status is unpaid. OrderNo $ordid Dated $pickdate Login and get detail about order.");
	$txtmsg=urlencode("Laundry Bucket Order Placed Id $oid . Date $pickdate . Pickup $picktime . Client $order_name . Ph $order_phone .");
						$ch = curl_init();
					// $url="http://text.sircltech.com/sendsms.jsp?user=rajeev&password=RJVOIL&mobiles=$upmob&sms=$utxtmsg&senderid=RJVOIL";
					 $url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=8901594900&sender=BUCKET&message=".$txtmsg;
					 //echo $url;
    									curl_setopt($ch, CURLOPT_URL, $url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_exec($ch);
										curl_close($ch);
									*/	
								   /* if($result = curl_exec($ch))
								    {
								//header("location:thanku.php");
								$row_array["status"]=1;
									} 
										curl_close($ch);
										$row_array["status"]=1;
								    */
									
									 echo json_encode($quick_order);
									  }
										
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>