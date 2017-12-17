<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$itemslist=array();

                                        	

										

                                        $result=mysql_query("select i.ItemId,i.ItemName,i.StandardRate,i.PremiumRate,i.item_img,p.UnitName,c.ServiceCatName,s.ServiceName from tbl_services_itemsprice as i,tbl_services_category as c,tbl_services as s,tbl_priceunit as p where(i.ServiceCatId=c.ServiceCatId and i.ServiceId=s.ServiceId and p.UnitId=i.PriceUnit)") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

		                             	

		                             	

										$row_array["id"]=$row["ItemId"];

									

										$row_array["item_name"]=$row["ItemName"];


										$row_array["s_rate"]="₹ ".$row["StandardRate"];
										
										$row_array["p_rate"]="₹ ".$row["PremiumRate"];
										
										$row_array["priceunit"]="Per ".$row["UnitName"];

										$row_array["service_cat"]=$row["ServiceCatName"] ;
										
										$row_array["service_name"]=$row["ServiceName"] ;

										$row_array["itemimage"]=$row["item_img"];
										

										array_push($itemslist,$row_array);

		                             	

										

									 }

									 

									 echo json_encode($itemslist);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>