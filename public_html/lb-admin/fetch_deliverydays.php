<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$did=trim($_GET["did"]);

$return_array=array();

     

	 $q="select * from tbl_deliverytypes where(DeliveryId='$did'&&DeliveryId!='')";

	 $result1=mysql_query($q) or die(mysql_error());

	 $count=mysql_num_rows($result1);



							if(mysql_num_rows($result1)>0)

									{

										$row=mysql_fetch_array($result1);

										$rows["status"]=1;


										$rows["deliverydays"]=mysql_real_escape_string(trim($row["DeliveryDays"]));

										
										$i=1;

					              		
											array_push($return_array,$rows);
	
								
						}

							else {

								$rows["status"]=0;

								array_push($return_array,$rows);

							}

									

						echo json_encode($return_array);

						mysql_close();	

						 ?> 	

						 

                           