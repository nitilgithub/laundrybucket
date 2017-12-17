<?php
/*include '../connection.php';
$sql = "SELECT count(*) as count FROM tbl_orders";
$qry = mysql_query($sql);
$row = mysql_fetch_array($qry);
echo $row['count'];*/
?>
<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

	$sql = "SELECT count(*) as count FROM tbl_contactenquiry";
	$qry = mysql_query($sql);
	$row = mysql_fetch_array($qry);
	
	$sql2 = "SELECT * FROM tbl_enquirycount";
	$qry2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($qry2);
	
	$rows['enquirycount']=$row['count']-$row2['EnquiryCount'];
	
	
$i=1;


array_push($return_array,$rows);
echo json_encode($return_array);
mysql_close();	

?> 	
