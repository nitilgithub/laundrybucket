<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');


$otypeid=trim($_GET["otypeid"]);
?>
<option value="">Select Offer Code</option>


<?php
$today=date("Y-m-d");

	 $q="select * from tbl_offer where OrderTypeId='$otypeid' and ExpiryDate>='$today'";

	 $result1=mysql_query($q) or die(mysql_error());

	
							while($row=mysql_fetch_array($result1))
							
									{
										
										?>
										
									<option value="<?php echo $row["OfferId"]; ?>" style="padding:10px"> <?php echo $row["OfferCode"]; ?> </option>
									
									<?php	
									}  
            				      	

						mysql_close();	

						 ?> 	

						 

                           