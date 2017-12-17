<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');


//$offerid=trim($_GET["offerid"]);
$suborderid=trim($_GET['suborderid']);
?>



<?php
	 $q="select * from tbl_applyOffer where subOrderId='$suborderid' order by id";

	 $result1=mysql_query($q) or die(mysql_error());

	
							while($row=mysql_fetch_array($result1))
							
									{
										
										?>
										
									
									<p><?php echo $row['OfferDescription'];?></p>
									<a href="#" title="<?php echo $row['id']; ?>" class="removeoffer" style="color:#57AFF7;">Remove</a>
									
									<?php	
									}  
            				      	

						mysql_close();	

						 ?> 	

						 

                           