<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

include '../connection.php';

$return_array=array();

$val=mysql_real_escape_string($_GET['val']);
$query="SELECT COUNT(*) as no_of_user,MONTHNAME(UserRegistrationDate) as Months FROM `tblusers` WHERE year(`UserRegistrationDate`)='$val' GROUP BY MONTH(UserRegistrationDate)";
$arr=array();
$return_arr = array();



	           $result=mysql_query($query) or die(mysql_error());
			  
			   while($row=mysql_fetch_array($result))

					   {

					
				$row_array['y'] = $row['Months'];
				$row_array['a'] = intval($row['no_of_user']);
								
				
				array_push($return_arr,$row_array);
				 			        }

				    

					 echo json_encode($return_arr);

					 mysql_close();

?>

										

								