<?php
@ob_start();
@session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if(!$link)
{
  die("Connection failed: " . mysqli_connect_error());
}

$user_subscription=array();

//$uloginid=$_SESSION["uloginid"];

$uid=$_GET["uid"];

//global $usemail;

$todaydate = strtotime("Now");

$check_subs_query="select * from tbl_usersubscriptions WHERE (UserId='$uid'  AND subs_status!='expired')";
$result=mysqli_query($link,$check_subs_query)or die(mysqli_error($link));

if(mysqli_num_rows($result))
{
	while($row=mysqli_fetch_array($result))
	{
		$next_renewal_date=strtotime($row["next_renewal"]);
		$id=$row["0"];
		
		if($next_renewal_date<$todaydate)
		{
			//echo "Exp."; $row["subs_status"].'<br/>';
			
			$result1=mysqli_query($link,"update tbl_usersubscriptions SET subs_status='expired' where (UserId='$uid' AND srno='$id')")or die(mysqli_error($link));
			
		}
		
	}
	
	//show_currentsubscription();
	$result1=mysqli_query($link,"select * from tbl_usersubscriptions where UserId='$uid' and (subs_status='activated' or subs_status='inactive')order by srno desc") or die(mysqli_error($link));
	if(mysqli_num_rows($result1))
	{
		while($row1=mysqli_fetch_array($result1))
		{
			$row_array["id"]=$row1["srno"];
			
			$usubs_id=$row1["subs_id"];
			
			$used_wt=$row1["used_weight"];
			
			$todaydate = date('F d, Y');
			
			$row_array["status"]=1;
			
			$row_array["start_date"]=$row1["start_date"];
			
			$row_array["next_renewal"]=$row1["next_renewal"];
			
			$row_array["last_renewal"]=date('F d, Y', strtotime('-1 month', strtotime($row1["next_renewal"])));
			
			$row_array["used_wt"]=$row1["used_weight"];
			
			$row_array["subs_status"]=($row1["subs_status"]=="inactive") ? 0 : 1;
			
			$row_array["subs_name"]="Laundry";
			
			//$last_renewal.'-1 month');
			
			$result2=mysqli_query($link,"select * from tbl_subscriptions where subs_id='$usubs_id'") or die(mysqli_error($link));
			
			$row2=mysqli_fetch_array($result2);
			
			$subs_weight=$row2["subs_wt"];
			
			$row_array["subs_name"]=$row2["subs_name"];
			
			$row_array["subs_weight"]=$row2["subs_wt"];
			
			$row_array["pending_weight"]=$subs_weight-$used_wt;
			
			$row_array["flag"]=1;
			
			array_push($user_subscription,$row_array);
			
		}
		
	echo json_encode($user_subscription);	
	}

	else
	{
		$row_array["flag"]=0;
		$row_array["status"]="You donot have any subscription";
		array_push($user_subscription,$row_array);
		echo json_encode($user_subscription);
	}
	
		
}

else 
{
	//show_currentsubscription();
	$result1=mysqli_query($link,"select * from tbl_usersubscriptions where UserId='$uid' and (subs_status='activated' or subs_status='inactive')order by srno desc") or die(mysqli_error($link));
	if(mysqli_num_rows($result1))
	{
		while($row1=mysqli_fetch_array($result1))
		{
			$row_array["id"]=$row1["srno"];
			
			$usubs_id=$row1["subs_id"];
			
			$used_wt=$row1["used_weight"];
			
			$todaydate = date('F d, Y');
			
			$row_array["start_date"]=$row1["start_date"];
			
			$row_array["next_renewal"]=$row1["next_renewal"];
			
			$row_array["last_renewal"]=date('F d, Y', strtotime('-1 month', strtotime($row1["next_renewal"])));
			
			$row_array["used_wt"]=$row1["used_weight"];
			
			$row_array["subs_status"]=$row1["subs_status"];
			
			//$last_renewal.'-1 month');
			
			$result2=mysqli_query($link,"select * from tbl_subscriptions where subs_id='$usubs_id'") or die(mysqli_error($link));
			
			$row2=mysqli_fetch_array($result2);
			
			$subs_weight=$row2["subs_wt"];
			
			$row_array["subs_name"]=$row2["subs_name"];
			
			$row_array["subs_weight"]=$row2["subs_wt"];
			
			$row_array["pending_weight"]=$subs_weight-$used_wt;
			
			$row_array["flag"]=1;
			array_push($user_subscription,$row_array);
			
		}
	echo json_encode($user_subscription);
		
	}
	
	else
	{
		$row_array["flag"]=0;
		
		$row_array["status"]="You don't have any subscription";
		
		array_push($user_subscription,$row_array);
		
		echo json_encode($user_subscription);		
	}
			
}

/*function show_currentsubscription()

	{

	$uid=$_GET["uid"];

 }*/


?>