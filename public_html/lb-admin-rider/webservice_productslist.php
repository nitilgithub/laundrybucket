<?php
ob_start();
session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$productslist=array();
                                        	
										
                                        $result=mysql_query("select * from tbl_ratelist order by srno DESC") or die(mysql_error());
										if(mysql_affected_rows())
	                                  {
		                                while($row=mysql_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["id"]=$row["srno"];
									
										$row_array["item_name"]=$row["item_name"];
										$row_array["itemimage"]="../drycleanimages/".$row["imagename"];
										$row_array["item_price"]="₹ ".$row["dminp"]." - "." ₹ ". $row["dmaxp"];
										$row_array["item_category"]=$row["category"] ;
										
										array_push($productslist,$row_array);
		                             	
										
									 }
									 
									 echo json_encode($productslist);
									  }
									  
									  
									  mysql_close();
									  ob_end_flush();
									  
		                             	?>