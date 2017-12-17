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
$subscriptionlist=array();
                                        	
										
                                        $result=mysqli_query($link,"select * from tbl_subscriptions order by subs_id DESC") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["subs_id"]=$row["subs_id"];
									
										$row_array["subs_name"]=$row["subs_name"];
										$row_array["subs_cost"]=$row["subs_cost"];
										$row_array["subs_wt"]=$row["subs_wt"];
										$row_array["subs_maxpickup"]=$row["subs_maxpickup"] ;
										
										array_push($subscriptionlist,$row_array);
		                             	
									 }
									 
									 echo json_encode($subscriptionlist);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>