<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$subscriptionlist=array();
                                        	
										
                                        $result=mysql_query("select * from tbl_subscriptions order by subs_id DESC") or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                while($row=mysql_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["id"]=$row["subs_id"];
									
										$row_array["subs_name"]=$row["subs_name"];																				
										
										$row_array["subs_servicetype"]=$row["Subs_ServiceType"];																				
										
										$row_array["subs_garmenttype"]=$row["Subs_GarmentType"];																				
										
										$row_array["subs_cost"]="₹ ".$row["subs_cost"] ;
										$row_array["subs_weight"]=$row["subs_wt"]." Kg" ;
										$row_array["subs_maxpickup"]=$row["subs_maxpickup"];
										
										$row_array["subs_extra_wt_cost"]=$row["subs_extra_wt_cost"];
										
										$row_array["subs_extra_pickup_cost"]=$row["subs_extra_pickup_cost"];
										
										$row_array["validity"]=$row['subs_validity']." days";
																														
										$row_array["subs_remarks"]=$row["Remark"];
										array_push($subscriptionlist,$row_array);
		                             	
										
									 }
									 
									 echo json_encode($subscriptionlist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>