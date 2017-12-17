<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$all_order=array();
						
	if($_SESSION['loginrole']==9)
	{
		$result=mysql_query("select * from tbl_orders where(OrderStatusId!=5) and (PayableAmount-PaidAmount!=0) and franchiseId='".$_SESSION['loginid']."' order by OrderId DESC") or die(mysql_error());
	}			
	else {
				
	$result=mysql_query("select * from tbl_orders where(OrderStatusId!=5) and (PayableAmount-PaidAmount!=0) order by OrderId DESC") or die(mysql_error());
										
	}                                  
		                               while($row=mysql_fetch_array($result))
									   {
									   	$userid=$row["OrderUserId"];
										$orderStatusid=$row['OrderStatusId'];
										$oid=$row['OrderId'];
										
										$res=mysql_query("select * from tbl_orderstatus_id where order_status_id='$orderStatusid'") or die(mysql_error());
										$rows=mysql_fetch_array($res);
										$res1=mysql_query("select count(*) from tbl_invoicereminder where OrderId='$oid'") or die(mysql_error());
										$row3=mysql_fetch_array($res1);
										$res2=mysql_query("SELECT * FROM `tbl_invoicereminder` where OrderId='$oid' order by srno desc limit 0,1")or die(mysql_error());
										$row2=mysql_fetch_array($res2);
										
										
										if(empty($row2['addon']))
										{
											$noOfdays="";
										}
										else
										{
										$start = strtotime(date("Y-m-d"));
										$end = strtotime($row2['addon']);
										$x=trim(ceil(abs($end - $start) / 86400));
										$noOfdays = "before <span style='color:red;'>".$x."days</span> ";
										}
										
										if($orderStatusid==4){
										
										$row_array['payment_reminder']="<span style='font-size:12px; line-height:10px;'>".$rows['order_status_text']."<br><span style='color:red; line-height:10px;'>Reminder Detail:</span><br>Total: <span style='color:red;'>".$row3[0]."</span> ".$noOfdays."<br>Last Date: ".$row2['addon']."</span><br><button class='btn btn-primary btn-xs' id='btnRemind' title='".$oid."'>Remind Me</button>";
										}
										else {
										$row_array['payment_reminder']="<span style='font-size:12px; line-height:10px;'>".$rows['order_status_text']."</span>";											
										}
									   	$result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
										$row1=mysql_fetch_array($result1);
										
																					
										$row_array["order_id"]=$row["OrderId"];
										$row_array["pending_amt"]=" ₹ ".($row["PayableAmount"]-$row['PaidAmount']);
										
									
										$row_array["order_shipname"]=$row1["UserFirstName"]." ".$row1["UserLastName"];
										$row_array["order_email"]=$row1["UserEmail"];
										
										$row_array["order_phone"]=$row1["UserPhone"];
										
										
							$row_array["order_total_amt_weight"]=($row["OrderType"] == 'subscription' ? (empty($row["OrderTotalWeight"]) ? ('-') : $row["OrderTotalWeight"]." Kg ") : (empty($row["PayableAmount"]) ? $row["PayableAmount"] : " ₹ ".$row["PayableAmount"]) );
													
										//In $row_array["order_total_amt_weight"] we are getting value as - 1stly check order type is subscription or other .if order type is subscription then further check
										//ordertotalweight. if order totalweight is zero then print hiphen else print order total weight with kg.
										//if order type other then check order totalamount either null or not  
													
							
										array_push($all_order,$row_array);
		                             	
										
									
									   }
									 echo json_encode($all_order);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>
								
										
								