<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
	include '../connection.php';
	$link = mysqli_connect($servername, $username, $password,$db);
		if (!$link) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$return_arr = array();
		$uname=mysqli_real_escape_string($link,$_GET["uname"]);
		$upass=md5(mysqli_real_escape_string($link,$_GET["upass"]));
		if(!empty($uname) && !empty($upass))
		{
		$q="select * from tblusers where  UserEmail='$uname' and BINARY UserPassword= BINARY '$upass'";
		
		$result=mysqli_query($link,$q) or die(mysqli_error($link));
		
		if(mysqli_num_rows($result)>0)
		{
			$rows=mysqli_fetch_array($result) or die(mysqli_error($link));
			$row_array['userid']=$rows["UserId"];
			$row_array['useremail']=$uname;
			$row_array['status']=1;
		}
		else 
		{
			$row_array['status'] = 0;
		}
	}
	else
	{
		$row_array['status'] = 0;
	}
	
array_push($return_arr,$row_array);
echo json_encode($return_arr);
mysqli_close($link);
?>