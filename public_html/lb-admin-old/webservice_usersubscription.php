<?php
ob_start();
session_start();
include '../connection.php';
//include 'connection-mysql-i.php';
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$subs_ref=mysql_real_escape_string($_GET["ref"]);
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
											$row_array["subsdate"]=$row["start_date"]; 
										
										
										
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
 
 									  } /* Webservice code end for inactive subscription */
 


/* Webservice code Start for Activated subscription */
elseif($subs_ref=='activated')
		
		{
					
										$result=mysql_query("select * from tbl_usersubscriptions where subs_status='activated' order by srno DESC") or die(mysql_error());
										
                                       
		                               while($row=mysql_fetch_array($result))
									   {
									   	
										$userid=$row["UserId"];
										$subsid=$row["subs_id"];
									   	
									   $row_array["id"]=$row["srno"];
										$row_array["substatus"]=$row["subs_status"];
											$row_array["subsdate"]=$row["start_date"];
											
											//$todaydate = date('F d, Y');
											//$expirydate=strtotime($row["next_renewal"]);
											
											
											//$days_ago = date('F d, Y', strtotime('-5 days', $expirydate)); 
										//$row_array["days_ago"]= $days_ago;
										
										
							 $result1=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
							              
										  $data=mysql_fetch_array($result1);
										  
										$row_array["clientname"]=$data["UserFirstName"]." ".$data["UserLastName"];;
										
							
							 $result2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'") or die(mysql_error());
							              
										  $data2=mysql_fetch_array($result2);
										  
										$row_array["subsname"]=$data2["subs_name"];
										
						
										
										array_push($user_subs,$row_array);
		                             	
										
									
									   }
									 echo json_encode($user_subs);
									
									   	
									  
									  mysql_close();
									  ob_end_flush();
				}
			/* Webservice code End for Activated subscription */
				  
		                             	?>
								
															