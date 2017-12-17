<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$return_array=array();
$z=array();
$z1=array();
$z3=array();
//$query="SELECT COUNT(*) as no_of_orders,`OrderType`,MONTH(OrderDate) as Months FROM `tbl_orders` WHERE (`OrderType`='dryclean' or `OrderType`='laundry') GROUP BY MONTH(OrderDate)";

$query="SELECT COUNT(*) as no_of_subs, monthname(addon) as Months FROM tbl_usersubscriptions GROUP BY MONTH(addon)";     
	           $result=mysql_query($query) or die(mysql_error());

            
			  $return_array = array('cols' => array(array('label' => 'Months', 'type' => 'string'),array('label' => 'Subscriptions', 'type' => 'string')),
              'rows' => array());
			   while($row=mysql_fetch_array($result))
					   {
	
				 $return_array['rows'][] = array('c' => array(array('v' => $row["Months"]), array('v' => $row["no_of_subs"])));
	
 
 			        }
				    
					 echo json_encode($return_array);
					 mysql_close();
?>
										
								