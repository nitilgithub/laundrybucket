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

$user_order=array();
//$uloginid=$_SESSION["uloginid"];
$uid=$_GET["uid"];
//global $usemail;
										
		
												$i=0;
                                        $result2=mysqli_query($link,"select * from tbl_orders where OrderUserId='$uid' order by OrderId DESC") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result2))
		                             {
		                             	$ord_id=$row[0];
		                             	$i=$i+1;
		                             	$row_array["srno"]=$i;
										$row_array["ord_no"]=$row["OrderId"];
										
										$row_array["ord_type"]=$row["OrderType"];
										$row_array["ord_disc"]=(empty($row["Review"]) ? ('No Discription') : $row["Review"]);
										
										$row_array["ord_date"]=$row["OrderDate"];
										//$row_array["total_amt"]=$row["OrderTotalAmount"];
										//$row_array["order_invoice"]=$row["OrderDate"];
										
							$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? ($row["OrderTotalWeight"] == 0 ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["OrderTotalAmount"]) ? ('0') : " ₹ ".$row["OrderTotalAmount"]) );			
										
										$order_statusid=$row["OrderStatusId"];
										
										$row_array["order_receipt_img"]=$row["OrderReceiptPic"];
										
										                             
		                            $result5=mysqli_query($link,"select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysqli_error($link));
		                             	$data2=mysqli_fetch_array($result5);
										 
										$row_array["order_statustext"]=$data2["order_status_text"];
										
										$row_array["status"]=1;
										
										array_push($user_order,$row_array);
		                             	
										
									 }
									 
									
									  }
else {
	$row_array["status"]=0;
}
										array_push($user_order,$row_array);
									   echo json_encode($user_order);
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>