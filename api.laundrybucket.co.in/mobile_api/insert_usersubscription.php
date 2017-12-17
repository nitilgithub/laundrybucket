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
$insert_subscription=array();

                                        	
 $uid=$_GET["uid"];
 $subsid=$_GET["subsid"];
 $startdate = date('F d, Y');
 $new_renewal=date('F d, Y', strtotime('+1 month'));
 $maxpickup=0;
 $used_weight=0;
 $subs_status='inactive';
 
 
		
 $result=mysqli_query($link,"insert into tbl_usersubscriptions(UserId,subs_id,start_date,next_renewal,last_renewal,max_pickup,used_weight,subs_status,addon) values('$uid','$subsid','$startdate','$new_renewal','$startdate','$maxpickup','$used_weight','$subs_status',NOW())") or die(mysqli_error($link));										
 
										if(mysqli_affected_rows($link))
	                                  {
										$row_array["msg"]="Subscription Subscribe Successfully";
									  }
										else
											{
											$row_array["msg1"]="Sorry, Please Try again";	
											}
										array_push($insert_subscription,$row_array);

									 
									 echo json_encode($insert_subscription);
									  
									  
									  
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>