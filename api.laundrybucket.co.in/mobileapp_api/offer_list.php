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
$offer_list=array();

                                        	
										
                              $result=mysqli_query($link,"select * from tbl_offer where ExpiryDate>CURDATE()") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
										$ordertypeid=$row["OrderTypeId"];
										
										$q=mysqli_query($link, "select * from tbl_services where ServiceId='$ordertypeid'");
										
										$row1=mysqli_fetch_array($q);
										
		                             	
		                             	$row_array["OfferId"]=$row["OfferId"];
									    $row_array["OfferCode"]=$row["OfferCode"];
										
										$row_array["ServiceName"]=$row1["ServiceName"];
									    $row_array["OfferValue"]=$row["OfferValue"];
										
										$row_array["OfferUnit"]=$row["OfferUnit"];
									    $row_array["Validity"]=$row["Validity"];
										
										$row_array['StartDate']=$row['StartDate'];
										$row_array["OfferDescription"]=$row["OfferDescription"];
										
										array_push($offer_list,$row_array);
		                             	
									 }
									 
									 echo json_encode($offer_list);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>