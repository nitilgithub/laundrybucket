<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$serviceid=trim($_GET["s"]);

$servicecatid=trim($_GET["scat"]);

$unitid=trim($_GET["uid"]);
?>

<option value=""  style="padding-bottom:7px">Select Item Name</option>

<?php
	 $q="select * from tbl_services_itemsprice where ServiceId='$serviceid' and ServiceCatId='$servicecatid' and PriceUnit='$unitid'";

	 $result1=mysql_query($q) or die(mysql_error());

	
							while($row=mysql_fetch_array($result1))
							
									{
										
										?>
										
									<option value="<?php echo $row["ItemId"]; ?>" style="padding:10px"> <?php echo $row["ItemName"]; ?> </option>
									
									<?php	
									}  
            				      	

						mysql_close();	

						 ?> 	

						 

                           