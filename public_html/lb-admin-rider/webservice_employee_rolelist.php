<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$list=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_employee_role") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {

		                                while($row=mysql_fetch_array($result))

		                             {

		                             	

		                             	

										$row_array["id"]=$row["roleId"];
										

									if($row["status"]==0){
										
										 $st="Deactivated"; } 
										 
										 else { $st="Activated"; }
										 

										$row_array["name"]=$row["roleName"];
										 
										 $row_array["status"]=$st;


										

									array_push($list,$row_array);

		                             	

										

									 }

									 

									 echo json_encode($list);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>