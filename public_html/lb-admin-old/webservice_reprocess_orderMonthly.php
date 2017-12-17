<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

include '../connection.php';

$return_array=array();

$val=mysql_real_escape_string($_GET['val']);
$query="SELECT ifnull(count(*),0) as no_of_orders,MONTHNAME(OrderDate) as Months FROM `tbl_orders` WHERE (year(`OrderDate`)='$val' and OrderType='reprocess') GROUP BY MONTH(OrderDate)";
$arr=array();
$return_arr = array();



	           $result=mysql_query($query) or die(mysql_error());
			  
			   while($row=mysql_fetch_array($result))

					   {

						
				$row_array['y'] = $row['Months'];
				$row_array['a'] = $row['no_of_orders'];
				array_push($return_arr,$row_array);
				 			        }

				    

					 echo json_encode($return_arr);

					 mysql_close();

?>

										

								