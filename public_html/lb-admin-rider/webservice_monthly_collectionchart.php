<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$return_array=array();
$z=array();
$z1=array();
$z3=array();
//$query="SELECT COUNT(*) as no_of_orders,`OrderType`,MONTH(OrderDate) as Months FROM `tbl_orders` WHERE (`OrderType`='dryclean' or `OrderType`='laundry') GROUP BY MONTH(OrderDate)";
$ref=$_GET["ref"];
$monthtype=$_GET["month"];

$query="call monthly_collection_chart('$ref','$monthtype')";   
  
	           $result=mysql_query($query) or die(mysql_error());

            
			  $return_array = array('cols' => array(array('label' => 'Days'.' '.$monthtype.' '.'Month( '.$ref.' Collection)', 'type' => 'string'),array('label' => $ref, 'type' => 'string')),
              'rows' => array());
			  
			   while($row=mysql_fetch_array($result))
					   {
				$return_array['rows'][] = array('c' => array(array('v' => $row["days"]), array('v' => $row["ota"]),array('v' => $row["OType"])));
					   }
				    
					 echo json_encode($return_array);
					 mysql_close();
?>
										
								