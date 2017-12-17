<?php
@ob_start();
@session_start();
include '../connection.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$uemail=trim($_GET["uemail"]);
$uphone=trim($_GET["uphone"]);
$return_array=array();

 //$q="select * from tblusers where UserEmail='$uemail'";
       $q="select * from tblusers where((UserEmail='$uemail'&&UserEmail!='') OR (UserPhone='$uphone' && UserPhone!=''))";
	   $result1=mysql_query($q) or die(mysql_error());
	   $count=mysql_num_rows($result1);
	   
	// echo $count;
	// print_r($expression)
	
       if($count>0)
	  {
		 $row=mysql_fetch_array($result1);
		 //print_r($row);
		 $uid=$row["UserId"];
		 
		 $q2="select * from tbl_usersubscriptions where UserId='$uid' and subs_status='activated'";
		 $result2=mysql_query($q2) or die(mysql_error());
		 if(mysql_affected_rows())
		 {
		 	while($row2=mysql_fetch_array($result2))
			{
				//print_r($row2);
				$subs_id=$row2["subs_id"];
											
				$rows["status"]=1;
				$rows["subs_id"]=$row2["subs_id"];
										
				$result3=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'");
				$row3=mysql_fetch_array($result3);
				$rows["subs_name"]=$row3["subs_name"];
											
				$rows["srno"]=$row2["srno"];
											
				array_push($return_array,$rows);
			}
		 }
		 
		else
		{
						    		
			$rows["status"]=2;
			array_push($return_array,$rows);
		}
		
	  }
	  
	 else
	 {
		$rows["status"]=3;
		array_push($return_array,$rows);
	 }
	 
  echo json_encode($return_array);
  mysql_close();
  ob_end_flush();			  	 	
?>