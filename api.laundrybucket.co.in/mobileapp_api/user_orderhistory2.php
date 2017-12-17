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

$user_order=array();
//$uloginid=$_SESSION["uloginid"];
$oid=$_GET["oid"]; //get Order Id of master table tbl_orders
$uid=$_GET["uid"];

//global $usemail;
										
		
												$i=0;
                                        $result=mysqli_query($link,"select * from tbl_suborders where OrderId='$oid' order by SubOrderId DESC") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
	                                  	
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	$subord_id=$row["SubOrderId"];
										$ordtype_id=$row["OrderTypeId"]; //this id is used to fetch order type from service table
										$deliverytype_id=$row["DeliveryTypeId"];
										
		                             	$i=$i+1;
		                             	$row_array["srno"]=$i;
										
										$row_array["subord_id"]=$row["SubOrderId"];
										$row_array["suborder_totalamt"]=$row["TotalAmount"];
										$row_array["suborder_discount"]=$row["OfferDiscount"]+$row['ManualDiscount'];
										$row_array["suborder_taxableamt"]=$row["TaxableAmount"];
										$row_array["suborder_tax"]=$row["tax"];
										$row_array["suborder_payableamt"]=$row["PayableAmount"];
										$row_array["suborder_paidamt"]=$row["PaidAmount"];
										
										$row_array["subord_disc"]=(empty($row["Remarks"]) ? ('No Description') : $row["Remarks"]);
										
										
							//$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? ($row["OrderTotalWeight"] == 0 ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["OrderTotalAmount"]) ? ('0') : " ₹ ".$row["OrderTotalAmount"]) );			
										
										/*$order_statusid=$row["OrderStatusId"];
										*/
										                             
		                    $result2=mysqli_query($link,"select * from tbl_services where ServiceId='$ordtype_id'") or die(mysqli_error($link));
		                    $data2=mysqli_fetch_array($result2);
										 
										$row_array["suborder_type"]=$data2["ServiceName"];
										
							
											                             
		                    $result3=mysqli_query($link,"select * from tbl_deliverytypes where DeliveryId='$deliverytype_id'") or die(mysqli_error($link));
		                    $data3=mysqli_fetch_array($result3);
										 
										$row_array["suborder_deliverytype"]=$data3["DeliveryTitle"];			
										 
										
										$row_array["status"]=1;
										
										array_push($user_order,$row_array);
		                             	
										
									 }
									 
									
									  }
else {
		$row_array["status"]=0;
		$row_array['message'] = "No Order Found";
		$row_array['title']="Alert"; // Alert Title			
	array_push($user_order,$row_array);
}
										
									   echo json_encode($user_order);
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>