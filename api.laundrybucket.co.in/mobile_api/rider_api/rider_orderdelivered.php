<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) 
{
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$uid=$_GET["uid"];
$oid=$_GET["oid"];
$paid_amt=$_GET["paidamount"];
$ostatusid=4; //Status id 4 means order delivered successfully

$remarks=mysqli_real_escape_string($link,strip_tags($_GET["remarks"]));
$remarksby="rider";
$remarksbyid=$_GET["riderid"];
$ddate=date("Y-m-d");// ddate stands for delivery date on which order delivered

	
		$q1="update tbl_orders set PaidAmount='$paid_amt',Review='$remarks',delivery_date='$ddate',OrderStatusId='$ostatusid' where (OrderId='$oid')";
		$r=mysqli_query($link,$q1) or die(mysqli_error($link));
			if($r)
			{
				$row_array['flag'] = 1;
				if($remarks!='')
				{
				
				$q2="insert into tbl_remarks(OrderId,UserId,Remarks,RemarksBy,RemarksById,addon)values('$oid','$uid','$remarks','$remarksby','$remarksbyid',NOW())";
				$r2=mysqli_query($link,$q2) or die(mysqli_error($link));
				}
				
			}
			//$row_array['status']="Your  review has been submitted successfully";
array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>