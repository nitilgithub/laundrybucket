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
$service_catlist=array();
$service_id=$_GET["serviceId"];

                                       	
										
 $result=mysqli_query($link,"select s.ServiceCatId,s.ServiceCatName,min(i.StandardRate) StandardRate,min(i.PremiumRate) PremiumRate,u.UnitName from tbl_services_category as s join tbl_services_itemsprice as i on i.ServiceCatId=s.ServiceCatId join tbl_priceunit as u on u.UnitId=i.PriceUnit  where s.ServiceCatId in (select ServiceCatId from tbl_services_itemsprice where ServiceId='$service_id') group by s.ServiceCatId,s.ServiceCatName,u.UnitName") or die(mysqli_error($link));
							if(mysqli_affected_rows($link))
	                                  {
	                                  	
		                                while($row=mysqli_fetch_array($result))
		                           		  {
		                           		  	$row_array["status"]=1;
		                             	 	$row_array["scatid"]=$row["ServiceCatId"];
										    $row_array["scat_name"]=$row["ServiceCatName"]." Prices (Incl. GST)";
											//$row_array["standard_rate"]=$row["StandardRate"];
											//$row_array["premium_rate"]=$row["PremiumRate"];
											//$row_array["unit_name"]=$row["UnitName"];
											$row_array["smessage"]="Standard Rate Start From INR ".$row["StandardRate"]." per ".$row["UnitName"].", Premium Rate Start From INR ".$row["PremiumRate"]." per ".$row["UnitName"];
											//$scat=$row["ServiceCatId"];
											array_push($service_catlist,$row_array);	
										
									 	}
									
									 $x=count($service_catlist);
									
									$service_catlist1=array();
									for($i=0;$i<$x;$i++)
									{
									 	
									 $row_array1["scatid"]=$service_catlist[$i]["scatid"];
									 $row_array1["scat_name"]=$service_catlist[$i]["scat_name"];	
									 $row_array1["desc"]=$service_catlist[$i]["smessage"];
									 if($i<$x-1)
									 {
									 	if($service_catlist[$i]["scatid"]==$service_catlist[$i+1]["scatid"])
										{
												$row_array1["desc"]=$row_array1["desc"]."\n".$service_catlist[$i+1]["smessage"];
												$i++;
										}
									 }
									 
									 $row_array1["status"]=1;
									 array_push($service_catlist1,$row_array1);
									 
									 
									}
									 echo json_encode($service_catlist1);
									 
								}
								else {
									
									$row_array1["status"]=0;
									
									array_push($service_catlist,$row_array1);
									
									echo json_encode($service_catlist);
									
								}
									
									 
									  
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>