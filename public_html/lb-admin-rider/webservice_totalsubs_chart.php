<?php

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

include '../connection.php';

$return_array=array();

$z=array();

$z1=array();

$z3=array();

//$query="SELECT COUNT(*) as no_of_orders,`OrderType`,MONTH(OrderDate) as Months FROM `tbl_orders` WHERE (`OrderType`='dryclean' or `OrderType`='laundry') GROUP BY MONTH(OrderDate)";

$arr=array();
$return_arr = array();
$val=mysql_real_escape_string($_GET['val']);


$query="SELECT COUNT(*) as no_of_subs, monthname(addon) as Months FROM tbl_usersubscriptions where year(addon)='$val' GROUP BY MONTH(addon)";     

	           $result=mysql_query($query) or die(mysql_error());



            

			   while($row=mysql_fetch_array($result))

					   {

	

              $row_array['y'] = $row['Months'];
				$row_array['a'] = $row['no_of_subs'];
				

array_push($return_arr,$row_array);
 			        }

				    

					 echo json_encode($return_arr);

					 mysql_close();
	
?>

										

								