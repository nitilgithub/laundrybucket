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
$useraddresslist=array();
$uid=intval($_GET["uid"]);

                                        	
										
                                        $result=mysqli_query($link,"SELECT * FROM tblusers_address where UserId='$uid'") or die(mysqli_error($link));
										if(mysqli_num_rows($result)>0)
	                                  {
			                              while($row=mysqli_fetch_array($result))
			                             {
			                             	$row_array["id"]=$row["id"];
			                             	$row_array["address"]=$row["Address"];
											$row_array["status"]=1;
											array_push($useraddresslist,$row_array);
			                             	
										 }
									 }
									 
										else {
												$row_array["status"]=0;
												$row_array['message'] = "No Address Found Please Add Address 1st to place order";
												$row_array['title']="Alert"; // Alert Title
												array_push($useraddresslist,$row_array);
										} 
									  
									 echo json_encode($useraddresslist); 
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>