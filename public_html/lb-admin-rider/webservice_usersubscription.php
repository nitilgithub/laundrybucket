<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$subs_ref=$_GET["ref"];
$user_subs=array();

/*
$ordertype="Drycleaning";
												
												// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Conection Process Complete	

	$i=0;

	$query="call spDrycleanOrderList('$ordertype')";
	echo "<h1 class='text-danger'>".$query."<h1>";

$result=mysqli_query($conn,$query);

 	if(mysqli_affected_rows($conn))
	{
		while($row=mysqli_fetch_array($result))
		{
											
			$row_array["order_id"]=$row["OrderId"]; 
										//$row_array["order_username"]=$row["OrderUserName"];
										
										$row_array["order_email"]=$row["OrderEmail"];
										
										$row_array["order_phone"]=$row["OrderPhone"];
										
										$row_array["order_shipaddress"]=$row["OrderShipAddress"];
										
										$row_array["order_date"]=$row["OrderDate"];								
		array_push($dryclean_order,$row_array);
		                             	
										
									
									   }
									
	}
	
	   mysql_close($conn);
	   echo json_encode($dryclean_order,JSON_UNESCAPED_UNICODE);
	ob_end_flush();
	
	 */
                                    
										if($subs_ref=='inactive')
		
		{
			
										
										$result=mysql_query("select * from tbl_usersubscriptions where subs_status='inactive' order by srno DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
										$userid=$row["UserId"];
										$subsid=$row["subs_id"];
									   	
									   $row_array["id"]=$row["srno"];
										$row_array["substatus"]=$row["subs_status"];
											$row_array["subsdate"]=$row["subs_date"]; 
										
										
										$query=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
									   																					
									   	$rowss=mysql_fetch_array($query);
																														
									   	$subs_weight=$rowss['subs_wt'];	
																													
									   	if($subs_weight=="unlimited" || $subs_weight=="Unlimited")										
									   	{
									   														
									  $row_array['remainingweight']="Unlimited";										
										}										
										
										else {
											$remainwt=$subs_weight-$row['used_weight'];
											if($remainwt<0)
											{
												$row_array['remainingweight']=0;
											}
											else {
												$row_array['remainingweight']=$subs_weight-$row['used_weight'];
											}
											
										}
										
										
											$row_array['startdate']=$row['start_date'];	
																																
											$row_array['enddate']=$row['next_renewal'];	
																																
											$date1=date_create($row['start_date']);
																					
											$date2=date_create($row['next_renewal']);
																						
											$diff=date_diff($date1,$date2);	
																					
											$validity=$diff->format("%a days");	
																																
											$row_array['validity']=$validity;	
																																
											$row_array['usedweight']=$row['used_weight'];	
																																
											$row_array['usedpick']=$row['max_pickup'];	
											
											$remainpickup=$rowss['subs_maxpickup']-$row['max_pickup'];
											
											if($remainpickup<0)
											{
												
												$row_array['remainingpick']=0;
												
											}
											else {
												
												$row_array['remainingpick']=$rowss['subs_maxpickup']-$row['max_pickup'];
												
											}																					
											
										
							 $result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							              
										  $data=mysql_fetch_array($result1);
										  
										$row_array["clientname"]=$data["UserFirstName"]." ".$data["UserLastName"];
										
										$row_array["clientemail"]=$data["UserEmail"];
										
							
							 $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
							              
										  $data2=mysql_fetch_array($result2);
										  
										$row_array["subsname"]=$data2["subs_name"];
										$row_array["subscost"]=$data2["subs_cost"];
						
$row_array['subsdetail']="Name: ".$data2["subs_name"]."<br>Date: ".$row["subs_date"]."<br>Start Date: ".$row['start_date']."<br>End Date: ".$row['next_renewal']."<br>Validity: ".$validity;

$row_array['weight']="Used: ".$row_array['usedweight']."<br>Remaining: ".$row_array['remainingweight'];	

$row_array['pickup']="Used: ".$row_array['usedpick']."<br>Remaining: ".$row_array['remainingpick'];									
										
										
										array_push($user_subs,$row_array);
		                             	
										
									
									   }
									 echo json_encode($user_subs);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
 
 									  } /* Webservice code end for inactive subscription */
 


/* Webservice code Start for Activated subscription */
elseif($subs_ref=='activated')
		
		{
					
										$result=mysql_query("select * from tbl_usersubscriptions where subs_status='activated' order by srno DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
										$userid=$row["UserId"];
										
										$subsid=$row["subs_id"];
										
									   	$query=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
									   																					
									   	$rowss=mysql_fetch_array($query);
																														
									   	$subs_weight=$rowss['subs_wt'];	
																													
									   	if($subs_weight=="unlimited" || $subs_weight=="Unlimited")										
									   	{
									   														
									  $row_array['remainingweight']="Unlimited";										
										}										
										
										else {
											$remainwt=$subs_weight-$row['used_weight'];
											if($remainwt<0)
											{
												$row_array['remainingweight']=0;
											}
											else {
												$row_array['remainingweight']=$subs_weight-$row['used_weight'];
											}
											
										}
										
									   $row_array["id"]=$row["srno"];
									   
										$row_array["substatus"]=$row["subs_status"];
										
											$row_array["subsdate"]=$row["subs_date"];	
																																
											$row_array['startdate']=$row['start_date'];	
																																
											$row_array['enddate']=$row['next_renewal'];	
																																
											$date1=date_create($row['start_date']);
																					
											$date2=date_create($row['next_renewal']);
																						
											$diff=date_diff($date1,$date2);	
																					
											$validity=$diff->format("%a days");	
																																
											$row_array['validity']=$validity;	
																																
											$row_array['usedweight']=$row['used_weight'];	
																																
											$row_array['usedpick']=$row['max_pickup'];	
											
											$remainpickup=$rowss['subs_maxpickup']-$row['max_pickup'];
											
											if($remainpickup<0)
											{
													
												$row_array['remainingpick']=0;		
												
											}
											else
												{
													
													$row_array['remainingpick']=$rowss['subs_maxpickup']-$row['max_pickup'];
													
												}
																																
											
											
											
											//$todaydate = date('F d, Y');
											//$expirydate=strtotime($row["next_renewal"]);
											
											
											//$days_ago = date('F d, Y', strtotime('-5 days', $expirydate)); 
										//$row_array["days_ago"]= $days_ago;
										
										
							 $result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							              
										  $data=mysql_fetch_array($result1);
										  
										$row_array["clientname"]=$data["UserFirstName"]." ".$data["UserLastName"];
										
							
							 $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
							              
										  $data2=mysql_fetch_array($result2);
										  
										$row_array["subsname"]=$data2["subs_name"];
										
$row_array['subsdetail']="Name: ".$data2["subs_name"]."<br>Date: ".$row["subs_date"]."<br>Start Date: ".$row['start_date']."<br>End Date: ".$row['next_renewal']."<br>Validity: ".$validity;

$row_array['weight']="Used: ".$row_array['usedweight']."<br>Remaining: ".$row_array['remainingweight'];	

$row_array['pickup']="Used: ".$row_array['usedpick']."<br>Remaining: ".$row_array['remainingpick'];							
										
										array_push($user_subs,$row_array);
		                             	
										
									
									   }
									 echo json_encode($user_subs);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
				}
			/* Webservice code End for Activated subscription */
			
			 /* Webservice code stsrt for completed subscription */  
							elseif($subs_ref=='completed')
									
									{
			
										
										$result=mysql_query("select * from tbl_usersubscriptions where subs_status='completed' order by srno DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
										$userid=$row["UserId"];
										$subsid=$row["subs_id"];
									   	
									   $row_array["id"]=$row["srno"];
										$row_array["substatus"]=$row["subs_status"];
											$row_array["subsdate"]=$row["subs_date"]; 
										
										
										$query=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
									   																					
									   	$rowss=mysql_fetch_array($query);
																														
									   	$subs_weight=$rowss['subs_wt'];	
																													
									   	if($subs_weight=="unlimited" || $subs_weight=="Unlimited")										
									   	{
									   														
									  $row_array['remainingweight']="Unlimited";										
										}										
										
										else {
											$row_array['remainingweight']=$subs_weight-$row['used_weight'];
										}
										
										
											$row_array['startdate']=$row['start_date'];	
																																
											$row_array['enddate']=$row['next_renewal'];	
																																
											$date1=date_create($row['start_date']);
																					
											$date2=date_create($row['next_renewal']);
																						
											$diff=date_diff($date1,$date2);	
																					
											$validity=$diff->format("%a days");	
																																
											$row_array['validity']=$validity;	
																																
											$row_array['usedweight']=$row['used_weight'];	
																																
											$row_array['usedpick']=$row['max_pickup'];	
																																
											$row_array['remainingpick']=$rowss['subs_maxpickup']-$row['max_pickup'];
										
							 $result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							              
										  $data=mysql_fetch_array($result1);
										  
										$row_array["clientname"]=$data["UserFirstName"]." ".$data["UserLastName"];
										
										$row_array["clientemail"]=$data["UserEmail"];
										
							
							 $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
							              
										  $data2=mysql_fetch_array($result2);
										  
										$row_array["subsname"]=$data2["subs_name"];
										$row_array["subscost"]=$data2["subs_cost"];
						
										
										array_push($user_subs,$row_array);
		                             	
										
									
									   }
									 echo json_encode($user_subs);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
 
 									  } /* Webservice code end for completed subscription */
 

			
				  
		                             	?>
								
															