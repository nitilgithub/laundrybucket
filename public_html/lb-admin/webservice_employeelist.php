<?php

ob_start();

session_start();

include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$list=array();

                                        	

										

                                        $result=mysql_query("select * from tbl_employee order by empId") or die(mysql_error());

										if(mysql_affected_rows())

	                                  {
										$count=1;
		                                while($row=mysql_fetch_array($result))

		                             {

		                             	

		                             	

										$row_array["id"]=$row["empId"];

									$empid=$row["empId"];

										$row_array["name"]=$row["empName"];


										$row_array["phone"]=$row["empPhone"];
										
										$row_array["email"]=$row["empEmail"];
										
										$res2=mysql_query("select * from tbl_per_employee_roles where empId='$empid'") or die(mysql_error());
										$row_array['erole']="";
										while($row2=mysql_fetch_array($res2))
										{
											$roleid=$row2["empRoleId"];
											$res=mysql_query("select * from tbl_employee_role where roleId='$roleid'") or die(mysql_error());
											$row1=mysql_fetch_array($res);
											$row_array['erole']=$row_array['erole']."   ".$row1['roleName']." - ";
										}
										
										
										
										

									array_push($list,$row_array);

		                             	

										

									 }

									 

									 echo json_encode($list);

									  }

									  

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>