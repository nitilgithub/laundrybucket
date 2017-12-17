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
$subscriptionlist_detail=array();

    $subs_id=intval($_GET['subs_id']);
	//print_r($subs_ids);
	$subs_ids = join(",", $subs_id);
	//print_r($cities);
	
	/*foreach($subs_ids as $val)
	{
		echo $val;
	}
	  */                         	
										$query="select * from tbl_subscriptions where(subs_id IN ($subs_ids)) order by subs_id DESC";
										//echo $query;
										
                                        $result=mysqli_query($link,$query) or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["subs_id"]=$row["subs_id"];
									
										$row_array["subs_name"]=$row["subs_name"];
										$row_array["subs_servicetype"]=$row["Subs_ServiceType"];
										$row_array["subs_garmenttype"]=$row["Subs_GarmentType"];
										$row_array["subs_cost"]=$row["subs_cost"];
										$row_array["subs_wt"]=$row["subs_wt"];
										$row_array["subs_maxpickup"]=$row["subs_maxpickup"] ;
										$row_array["subs_discount_monthly"]=$row["SubsDiscount_Monthly"];
										$row_array["remark"]=$row["Remark"];
																				
										array_push($subscriptionlist_detail,$row_array);
		                             	
									 }
									} 
									 //array_push($subscriptionlist_detail,$row_array);
									 echo json_encode($subscriptionlist_detail);
									  
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>