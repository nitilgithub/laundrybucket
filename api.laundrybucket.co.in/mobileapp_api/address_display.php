<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$uid=intval($_GET["uid"]);
$q="select * from tblusers_address where UserID='$uid' ORDER BY ActiveStatus DESC "; //Active status will be display at 1st position
$r=mysqli_query($link,$q) or die(mysqli_error($link));
if(mysqli_num_rows($r)>0)
{
	while($data=mysqli_fetch_array($r))
	{
			$row_array["addressid"]=$data["id"];
			$row_array["address"]=$data["Address"];
			$row_array['status'] = 1;
			array_push($return_arr,$row_array);
	}
		
	//$row_array['status']  = array_merge($address_array,$row_array);
}	
else {
	$row_array['status'] = 0;
	$row_array['message'] = "No Address Found";
	$row_array['title']="Alert"; // Alert Title
	array_push($return_arr,$row_array);
}

echo json_encode($return_arr);
mysqli_close($link);
?>