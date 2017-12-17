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
$service_itemlist=array();
$scat_id=$_GET["scatid"]; //Service Category Id from api service_cat.php
$service_id=$_GET["serviceId"]; //Service Id from api service.php

                                        	
								
                              $result=mysqli_query($link,"select i.ItemId,i.ItemName,i.StandardRate,i.PremiumRate,u.UnitName from tbl_services_itemsprice as i join tbl_priceunit as u on i.PriceUnit=u.UnitId where ServiceCatId='$scat_id' && ServiceId='$service_id'") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
				                             {
				                             	
												$row_array["status"]=1;
				                             	$row_array["item_id"]=$row["ItemId"];
											    $row_array["item_name"]=$row["ItemName"];
												$row_array["item_standardrate"]=$row["StandardRate"];
												$row_array["item_premiumrate"]=$row["PremiumRate"];
												$row_array["unit_name"]=$row["UnitName"];
												
												array_push($service_itemlist,$row_array);
				                             	
											 }
									 
									
									  }
									else
									{
										$row_array["status"]=0;
										array_push($service_itemlist,$row_array);
									}
									  
									   echo json_encode($service_itemlist);
									  mysqli_close($link);
									  ob_end_flush();
								   	?>