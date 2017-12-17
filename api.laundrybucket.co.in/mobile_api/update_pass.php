<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();

$uid=$_GET["uid"];
$pass=mysqli_real_escape_string($link,trim(md5($_GET["pass"])));

			 	
   $query="update tblusers set UserPassword='$pass' where UserId='$uid'";

  $result=mysqli_query($link,$query) or die(mysqli_error($link));
	if(mysqli_affected_rows($link))
	{
	
		$row_array['status']=1;
	
}

 else
		{
			$row_array['status']=0;
		}

array_push($return_arr,$row_array);
echo json_encode($return_arr);
?>