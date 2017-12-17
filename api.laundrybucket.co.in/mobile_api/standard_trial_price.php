<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$standardrates=array();
                                        	
										$result=mysqli_query($link,"SELECT * FROM tbl_standard_trial_price")or die(mysqli_error($link));
                                        
										
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))	
		                             	{
		                             	if($row["Title"]=="Trial"){
		                             	$row_array["otype"]='trial_laundry';	
		                             	}
										else {
											$row_array["otype"]='standard_laundry';
										}
										$row_array["id"]=$row["Id"];
										$row_array["title"]=$row["Title"];
										$row_array["price"]=$row["Price"];
										$row_array["weight"]=$row["Weight"];
										
										$row_array["image_url"]="http://api.laundrybucket.co.in/mobile_api/laundry_logo.png";
										array_push($standardrates,$row_array);
									  }
									  }
									  
		                             
									 echo json_encode($standardrates);
									 
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>