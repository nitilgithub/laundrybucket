<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$subscription_order=array();

               
										
										
										$result=mysql_query("select * from tbl_orders where OrderType='subscription' order by OrderId DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
									   $uid=$row["OrderUserId"];
										
										$us_subsid=$row["User_Subsid"];
										
									   	$order_statusid=$row["OrderStatusId"];
									   
									   
											$row_array["order_id"]=$row["OrderId"];
										 
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
										
										$row_array["order_date"]=$row["OrderDate"];
										
								
									
								 $result3=mysql_query("select * from tbl_usersubscriptions where srno='$us_subsid'") or die(mysql_error());
		                            $data3=mysql_fetch_array($result3);
										 
								$subs_id=$data3["subs_id"];
								
								
								 $result4=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'") or die(mysql_error());
		                            $data4=mysql_fetch_array($result4);
										 
								$row_array["subs_name"]=$data4["subs_name"];
								
								//$row_array["client_mobile"]=$data3["UserPhone"];
													
								
								
										
								 $result5=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
		                            $data5=mysql_fetch_array($result5);
										 
								$row_array["client_email"]=$data5["UserEmail"];
								
								$row_array["client_mobile"]=$data5["UserPhone"];
										
										
									
										
										
							 $result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
		                             	$data2=mysql_fetch_array($result2);
										 
										$row_array["order_statustext"]=$data2["order_status_text"];
										
										array_push($subscription_order,$row_array);
		                             	
										
									
									   }
									 echo json_encode($subscription_order);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>
								
										
								