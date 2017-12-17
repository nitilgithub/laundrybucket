<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$serviceslist=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_services") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

										$row_array["id"]=$row["ServiceId"];

									
										$row_array["service_name"]=$row["ServiceName"];

									array_push($serviceslist,$row_array);

		                             	

										

									 }
echo json_encode($serviceslist);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>