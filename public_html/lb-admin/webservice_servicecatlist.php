<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$productslist=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_services_category") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

										$row_array["id"]=$row["ServiceCatId"];

									
										$row_array["servicecat_name"]=$row["ServiceCatName"];

									array_push($productslist,$row_array);

		                             	

										

									 }
echo json_encode($productslist);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>