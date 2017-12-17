<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$return_arr = array();
$row_array["ph"]=2;

array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>