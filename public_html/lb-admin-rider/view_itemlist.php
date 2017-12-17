<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');
$return_array=array();

$serviceid=$_GET['service'];
$servicecatid=$_GET['servicecat'];

$res=mysql_query("select * from tbl_services_itemsprice where ServiceId='$serviceid' and ServiceCatId='$servicecatid'");
if(mysql_affected_rows())
{
while($row=mysql_fetch_array($res))
{
	$rows['ItemName']=$row['ItemName'];
	$rows['StandardRate']=$row['StandardRate'];
	$rows['PremiumRate']=$row['PremiumRate'];
	
	$priceunit=$row['PriceUnit'];
	$q=mysql_query("select * from tbl_priceunit where UnitId='$priceunit'");
	$r=mysql_fetch_array($q);
	$rows['UnitName']=$r['UnitName'];
	
	$rows['status']=1;
	array_push($return_array,$rows);
	
}

}
else {
	$rows['status']=0;
	array_push($return_array,$rows);
}


echo json_encode($return_array);
mysql_close();	

?> 	
