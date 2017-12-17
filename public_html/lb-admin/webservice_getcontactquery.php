<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$x=array();
                                        	
											$i=0;
                                        $result1=mysql_query("select * from tbl_contactenquiry order by id DESC") or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                while($row=mysql_fetch_array($result1))
		                             {
		                             	$i=$i+1;
		                             	$row_array["srno"]=$i;
										$row_array["id"]=$row[0];
										$row_array["name"]=$row["name"];
										$row_array["phone"]=$row["phone"];
										$row_array["email"]=$row["email"];																				$row_array["enquirytpe"]=$row["enquirytype"];
										$row_array["message"]=$row["message"];
										$row_array["date"]=$row["addon"];
										
										$row_array["remarks"]=$row['Remarks'];
										array_push($x,$row_array);
		                             	
										
									 }
									 
									 echo json_encode($x);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>