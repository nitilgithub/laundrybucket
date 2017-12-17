<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection2.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_order=array();
//$uloginid=$_SESSION["uloginid"];
$suboid=intval($_GET["suboid"]); //get SubOrder Id of Sub Order table tbl_suborders
//$uid=$_GET["uid"];

//global $usemail;
										
		
												$i=0;
                                        $result=mysqli_query($link,"select * from tbl_suborders_items where SubOrderId='$suboid' order by srno DESC") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
	                                  	
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	$subord_itemid=$row["srno"];
										$item_id=$row["ItemId"]; //this id is used to fetch Item Detail  from service item price table
										
										$i=$i+1;
		                             	$row_array["srno"]=$i;
										
										$row_array["subord_id"]=$row["SubOrderId"];
										$row_array["suborder_item_name"]=$row["ItemName"];
										$row_array["suborder_item_rate"]=$row["ItemRate"];
										$row_array["suborder_item_qty"]=$row["Qty"];
										$row_array["suborder_item_tamt"]=$row["TotalAmount"];
										$row_array["status"]=1;
										array_push($user_order,$row_array);
		                    		 }
											
									  }
else {
		$row_array["status"]=0;
		$row_array['message'] = "No items Found";
		$row_array['title']="Alert"; // Alert Title			
	array_push($user_order,$row_array);
}
										
									   echo json_encode($user_order);
									   mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>