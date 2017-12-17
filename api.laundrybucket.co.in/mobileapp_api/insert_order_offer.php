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
$usermessage = file_get_contents('../email_template/userofferorder.html');
$adminmessage = file_get_contents('../email_template/adminofferorder.html');

					
$insert_order=array();

$uid=intval($_GET["uid"]);
$offerid=intval($_GET["offerid"]);


//$pickdat=$_GET["txtpickupdate"];
//$CreatedByName=date("Y-m-d", strtotime($_GET["cb"]));;

//$pickdate=date("Y-m-d", strtotime($_GET["txtpickupdate"]));

//$pickdate=mysqli_real_escape_string($link,$_GET["txtpickupdate"]);
//$picktime=mysqli_real_escape_string($link,$_GET["txttime"]);
//$pickup_address=mysqli_real_escape_string($link,$_GET["pickaddress"]);
//$city=mysqli_real_escape_string($link,$_GET["city"]);


//$delivery_date="";
//$delivery_type_id=$_GET["dtypeid"]; //Selection of delivery type is dynamic comes from table tbl_deliverytypes
//$delivery_address=$_GET["pickaddress"];

/* Code Start for fetching Delivery Type Title or Name based on selection*/
//$rs=mysqli_query($link,"SELECT * FROM tbl_deliverytypes where DeliveryId='$delivery_type_id'");
//$rw=mysqli_fetch_array($rs);

//$delivery_type=$rw["DeliveryTitle"];
//$delivery_days=$rw["DeliveryDays"]; 
/* Code Start for fetching Delivery Type Title or Name based on selection*/


//$delivery_date=date("m/d/Y", strtotime($pickdate. '+ '.$delivery_days . ' days'));

$order_status_id=0;
$order_via="mobile";
$createdby="user";

$remarks="";
$remarksby="user";
$remarksbyid=intval($_GET["uid"]);

	
		
		//$pickdate=date("Y-m-d", strtotime($_GET["txtpickupdate"]));
		
		$q="select * from tblusers where UserId='$uid'";
$r=mysqli_query($link,$q) or die(mysqli_error($q));
if(mysqli_num_rows($r)>0)
{
	$data=mysqli_fetch_array($r);
	
	 if($data["UserVerifiedStatus"]==0)
	 {
	 	$row_array["status"]=1;//! means User not verified we set this for understanding to display alerts
		$row_array['message'] = "Please Verify Your Account";
		$row_array['title']="Alert"; // Alert Title
			
	 }
	 else 
	 {
		/*
		if(empty($data["UserFirstName"]) || empty($data["UserLastName"]) || empty($data["UserPhone"])) //empty($data["UserAddress"])
		{
			// In this section if user profile is not complete then redirect user to APP's User  Profile Scrren 
				
			$row_array["status"]=2; //2 means user profile not complete and redirect user to comlete profile
			$row_array['message'] = "Please Complete Your Profile to place any order";
			$row_array['title']="Alert"; // Alert Title
				
		}
		
		else
		{
		 */
			$client_name=$data["UserFirstName"]." ".$data["UserLastName"];
			$client_email=$data["UserEmail"];
			$client_phone=$data["UserPhone"];
			$pickup_address=$data['UserAddress'];
			$city=$data['UserCity'];
			
			$select=mysqli_query($link,"select * from tbl_combo_offer where offerId='$offerid'");
			$selrow=mysqli_fetch_array($select);
			$offername=$selrow['offerName'];
			$offeramount=$selrow['amount'];
																			
		  $result=mysqli_query($link,"insert into tbl_orders(OrderUserId,PickupAddress,OrderCity,OrderStatusId,Order_Via,CreatedBy,Remarks,addon,comboOfferId,UserDemandOffer,OrderTotalAmount,TaxableAmount,PayableAmount)
		  values('$uid','$pickup_address','$city','$order_status_id','$order_via','$createdby','$remarks',NOW(),'$offerid','$offername','$offeramount','$offeramount','$offeramount')") or die(mysqli_error($link));
										
					if(mysqli_affected_rows($link))
	                 {
	                          $ordid=mysqli_insert_id($link);
							  
							  $row_array["orderid"]=mysqli_insert_id($link);
							  
							  if($remarks!='')
							 {
							    $r3=mysqli_query($link,"insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$ordid','$uid','$remarks','$remarksby','$remarksbyid',NOW())") or die(mysqli_error($link));
							 }
				
							// Replace the % with the actual information for sending email to user id
							$usermessage = str_replace('%offername%', $selrow['offerName'], $usermessage);
							//$usermessage = str_replace('%deliverytype%', $delivery_type, $usermessage);
							$usermessage = str_replace('%offerdesc%', $selrow['offerDescription'], $usermessage);
							$usermessage = str_replace('%amount%', $selrow['amount'], $usermessage);			
							$usermessage = str_replace('%pvalidity%', $selrow['purchaseValidity'], $usermessage);							
														
							
							
							// Replace the % with the actual information for sending email to Admin id
							$adminmessage = str_replace('%offername%', $selrow['offerName'], $usermessage);
							$adminmessage = str_replace('%offerdesc%', $selrow['offerDescription'], $usermessage);
							$adminmessage = str_replace('%amount%', $selrow['amount'], $usermessage);			
							$adminmessage = str_replace('%pvalidity%', $selrow['purchaseValidity'], $usermessage);	
						
							$adminmessage = str_replace('%client-name%', $client_name, $adminmessage);
							$adminmessage = str_replace('%orderid%', $ordid, $adminmessage);
							$adminmessage = str_replace('%client-email%', $client_email, $adminmessage);
							$adminmessage = str_replace('%client-mobile%', $client_phone, $adminmessage);	
							
							$adminmessage = str_replace('%city%', $city, $adminmessage);			
							$adminmessage = str_replace('%address%', $pickup_address, $adminmessage);							
		  					$adminmessage = str_replace('%review%', $remarks, $adminmessage);
							
								$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom($client_email,"Laundry Bucket Order"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "New Order from laundrybucket.co.in";
								$mail->Body = $adminmessage;
								$mail->AddAddress("bucket@laundrybucket.co.in"); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');
								
								if($mail->Send())
							    {
							    	
								$mail = new PHPMailer(); // create a new object
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "mail.laundrybucket.co.in";
								$mail->Port = 465; // or 587
								$mail->IsHTML(true);
								$mail->Username = "orders@laundrybucket.co.in"; //gmail email here
								//$mail->FromName = 'Laundry Ticket';
								$mail->Password = "91tGV@t!yP1S"; //gmail password here
								$mail->SetFrom("orders@laundrybucket.co.in","Laundry Bucket"); //from Address here
								//$mail->AddReplyTo($email, 'Laundry Ticket');
								$mail->Subject = "Thanks for placing order";
								$mail->Body = $usermessage;
								$mail->AddAddress($client_email); //Email to
								//$mail->AddCC("support@laundrybuckethelp.zendesk.com", 'cc account');	
								if($mail->Send())
								{
								}	
								else {
								}														
							}

								
								/* Code for Send order placing message User Mobile no*/
								/* Code for Send Account Verification OTP to User Mobile no*/
								/*$txtmsg=urlencode("Laundry Bucket Order Placed Id $ordid . Date $pickdate . Pickup $picktime . Client $client_name . Ph $client_phone .");
								$ch = curl_init();
								$url= "http://alerts.kapsystem.com/api/web2sms.php?workingkey=A28560483f0aa800b63f2d7ddeb3acb5a&to=$client_phone&sender=BUCKET&message=$txtmsg";
								curl_setopt($ch, CURLOPT_URL, $url);
								curl_setopt($ch, CURLOPT_HEADER, 0);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //use to hide curl sms send response
								curl_exec($ch);
								curl_close($ch);*/
								
								
								$row_array["status"]=3; // 3 means order placed successfully
								$row_array['message'] = "Order Placed Successfully";
								$row_array['title']="Alert"; // Alert Title				
											
						}
						
						else
						{
							$row_array["status"]=0;
							$row_array['message'] = "Error Try Again";
							$row_array['title']="Alert"; // Alert Title						
						}
		}

}	
										array_push($insert_order,$row_array);
										echo json_encode($insert_order);
									  ob_end_flush();
	
									   mysqli_close($link);
									  ?>