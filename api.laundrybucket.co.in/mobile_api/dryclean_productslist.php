<?php
ob_start();
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../connection.php';
$link = mysqli_connect($servername, $username, $password,$db);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$productslist=array();
$icat=$_GET["cat"];
                                        	
										
                                        $result=mysqli_query($link,"select * from tbl_ratelist where category='$icat' order by srno DESC") or die(mysqli_error($link));
										if(mysqli_affected_rows($link))
	                                  {
		                                while($row=mysqli_fetch_array($result))
		                             {
		                             	
		                             	
										$row_array["id"]=$row["srno"];
									
										$row_array["item_name"]=$row["item_name"];
										$row_array["itemimage"]="../drycleanimages/".$row["imagename"];
										$row_array["item_price"]="₹ ".$row["dmaxp"];
										//$row_array["item_category"]=$row["category"] ;
										
										array_push($productslist,$row_array);
		                             	
									 }
									 
									 echo json_encode($productslist);
									  }
									  
									  
									  mysqli_close($link);
									  ob_end_flush();
									  
		                             	?>