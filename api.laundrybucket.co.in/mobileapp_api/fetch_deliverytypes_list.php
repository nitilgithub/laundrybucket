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
$deliverytypelist=array();

                                        	
										
                                        $result=mysqli_query($link,"SELECT * FROM tbl_deliverytypes") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["dtypeid"]=$row["DeliveryId"];
									
										$row_array["dtitile"]=$row["DeliveryTitle"];
										$row_array["dprice"]=$row["DeliveryPrice"];
										$row_array["ddays"]=$row["DeliveryDays"];  // send this value also to be used in insert_ordes Api to get delivery date
										//$row_array["item_category"]=$row["category"] ;
										
										array_push($deliverytypelist,$row_array);
		                             	
									 }
									 
									 echo json_encode($deliverytypelist);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>