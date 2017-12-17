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
$service_list=array();

                                        	
										
                              $result=mysqli_query($link,"select * from tbl_services") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	$row_array["service_id"]=$row["ServiceId"];
									    $row_array["service_name"]=$row["ServiceName"];
										
										array_push($service_list,$row_array);
		                             	
									 }
									 
									 echo json_encode($service_list);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>