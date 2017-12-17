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
$citylist=array();

                                        	
										
                                        $result=mysqli_query($link,"SELECT * FROM tbl_city") or die(mysqli_error($link));
										if(mysqli_num_rows($result)>0)
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                            	$row_array["cityname"]=$row["CityName"];
									$row_array["status"]=1;
										array_push($citylist,$row_array);
		                             }
									
									  }
										else
											{
												$row_array["status"]=0;
												array_push($citylist,$row_array);
											}
									  
									 echo json_encode($citylist);  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>