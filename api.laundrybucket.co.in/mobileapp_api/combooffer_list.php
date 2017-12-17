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
$offerlist=array();
                                        	
										
                                        $result=mysqli_query($link,"select * from tbl_combo_offer where STR_TO_DATE(expireDate, '%Y-%m-%d') > CURDATE() and isActive='1' order by offerId") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                            	$row_array["offerId"]=$row["offerId"];
										$row_array["offerName"]=$row["offerName"];
										$row_array["offerDescription"]=$row["offerDescription"];
										$row_array["amount"]=$row["amount"];
										$row_array["purchaseValidity"]=$row["purchaseValidity"] ;
										$row_array["offerPic"]=$row["offerPic"] ;
										
										
										array_push($offerlist,$row_array);
		                            
									 }
									 
										 echo json_encode($offerlist);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>