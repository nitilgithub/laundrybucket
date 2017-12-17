<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$return_array=array();
$ref=mysql_real_escape_string($_GET["ref"]);
//$query="SELECT COUNT(*) as no_of_orders,`OrderType`,MONTH(OrderDate) as Months FROM `tbl_orders` WHERE (`OrderType`='dryclean' or `OrderType`='laundry') GROUP BY MONTH(OrderDate)";

$query="call yearly_collection_chart('$ref')";     
	           $result=mysql_query($query) or die(mysql_error());

            
			  $return_array = array('cols' => array(array('label' => 'Months', 'type' => 'string'),array('label' => $ref, 'type' => 'string')),
              'rows' => array());
			 
			   while($row=mysql_fetch_array($result))
					   {
	
				 $return_array['rows'][] = array('c' => array(array('v' => $row["Months"]), array('v' => $row["ota"]),array('v' => $row["OrderType"])));

 			        }
				    
					 echo json_encode($return_array);
					 mysql_close();
?>
										
								