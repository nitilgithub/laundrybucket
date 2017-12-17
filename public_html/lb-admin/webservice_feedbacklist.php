<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$all_order=array();

										
										$result=mysql_query("select * from tbl_feedback order by id DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	$orderid=$row["OrderId"];
										$result2=mysql_query("select * from tbl_orders where OrderId='$orderid'") or die(mysql_error());
										$row2=mysql_fetch_array($result2);
										$userid=$row2['OrderUserId'];
										
										
									   	$result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
										$row1=mysql_fetch_array($result1);
										
										
										$row_array["userid"]=$userid;											
										$row_array["orderid"]="<a href='suborder_dashboard.php?oid=".$orderid."' title='Click to view the order' style='color:#000;'>".$orderid."</a>";
										$row_array["client_name"]=$row1["UserFirstName"]." ".$row1["UserLastName"];
										$row_array["client_email"]=$row1["UserEmail"];
										$row_array["client_mob"]=$row1['UserPhone'];
										$row_array["address"]=$row1["UserAddress"].", ".$row1['UserCity'];
										 
										$rating=$row["rating"];
										
										$star="";
										for($i=1;$i<=$rating;$i++)
										{
												$star=$star."<i class='fa fa-star' style='color:#FAE570;'></i>";
										}
									
										$row_array["rating"]=$star;
										
										if($row['question1']<3){$ques1= "Very Dissatisfied";}
										else if($row['question1']>=3 && $row['question1']<=6){ $ques1="Neutral";}
										else{$ques1="Satisfied";}
										
										$row_array["product_exp"]=$ques1;
										
										if($row['question2']<3){$ques2= "Very Dissatisfied";}
										else if($row['question2']>=3 && $row['question2']<=6){ $ques2="Neutral";}
										else{$ques2="Satisfied";}
										$row_array["customer_service_rep"]=$ques2;
										
										if($row['question3']<3){$ques3= "Not at All";}
										else if($row['question3']>=3 && $row['question3']<=6){ $ques3="Neutral";}
										else{$ques3="Extremely Likely";}
										
										$row_array["recommend_to_friend"]=$ques3;
										
										$row_array["comment"]=$row["UserComment"];
																																										
										$row_array["receive_date"]=$row["addon"];		
							
										array_push($all_order,$row_array);
		                             	
										
									
									   }
									 echo json_encode($all_order);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>
								
										
								