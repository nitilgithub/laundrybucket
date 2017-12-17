<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$return_array=array();

//$query="SELECT COUNT(*) as no_of_orders,`OrderType`,MONTH(OrderDate) as Months FROM `tbl_orders` WHERE (`OrderType`='dryclean' or `OrderType`='laundry') GROUP BY MONTH(OrderDate)";

//$query="SELECT s.subs_id, s.subs_name, COUNT(*) as no_of_subs FROM tbl_subscriptions as s, tbl_usersubscriptions as u WHERE (s.`subs_id` = u.`subs_id`) GROUP BY subs_id";
//SELECT s.subs_id, s.subs_name, IFNULL(COUNT(u.srno),0) as total FROM tbl_subscriptions as s LEFT OUTER JOIN tbl_usersubscriptions as u ON s.`subs_id` = u.`subs_id` GROUP BY subs_id     

$query="SELECT s.subs_id, s.subs_name, IFNULL(COUNT(u.srno),0) as no_of_subs FROM tbl_subscriptions as s LEFT OUTER JOIN tbl_usersubscriptions as u ON s.`subs_id` = u.`subs_id` GROUP BY subs_id";
	           $result=mysql_query($query) or die(mysql_error());
				 mysql_close();
				 
				 $table = array();
$table['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Subscription', 'type' => 'string'),
    array('id' => '', 'label' => 'No of Subscriptions', 'type' => 'number')
    ); 
				 
				 $rows = array();
				  while($row=mysql_fetch_assoc($result))
				 {
	//$table['rows'][] = array('c' => array(array('v' => $row["Months"]), array('v' => $row["no_of_subs"])));
	 $temp = array();
     
    //Values
    $temp[] = array('v' => (string) $row['subs_name']);
    $temp[] = array('v' => (float) $row['no_of_subs']); 
    $rows[] = array('c' => $temp);
   // $result->free();
    $table['rows'] = $rows;
		}

$jsonTable = json_encode($table);
echo $jsonTable;
 

?>
										
								