<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$itemid=trim($_GET["itmid"]);


?>


<?php
	 $q="select ItemName from tbl_services_itemsprice where ItemId='$itemid'";

	 $result1=mysql_query($q) or die(mysql_error());

	
							$row=mysql_fetch_array($result1);
								
								echo $row[0];	

						mysql_close();	

						 ?> 	

						 

                           