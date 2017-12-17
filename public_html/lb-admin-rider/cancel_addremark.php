<?php

ob_start();

session_start();

include '../connection.php';

error_reporting(0);

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$cancelled_order=array();
$oid=$_GET['id'];
$remark=$_GET['remark'];
$res=mysql_query("select OrderUserId from tbl_orders where OrderId='$oid'") or die(mysql_error());
$row1=mysql_fetch_array($res);
$uid=$row1[0];


										$result=mysql_query("insert into tbl_ordersremarks(OrderId,UserId,Remarks,RemarksBy,addon) values('$oid','$uid','$remark','admin',now())") or die(mysql_error());

		                             if(mysql_affected_rows())
									 {
									 	$row_array['status']=1;
									 }
									 else {
										 $row_array['status']=0;
									 }

										array_push($cancelled_order,$row_array);

		         
									 echo json_encode($cancelled_order);

									

									   	

									  

									  mysql_close();

									  ob_end_flush();

									  

		                             	?>

								

										

								