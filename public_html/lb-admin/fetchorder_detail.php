<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$orderid=trim($_GET["oid"]);


?>


<?php
	 $q="select * from tbl_orders where OrderId='$orderid'";

	 $result1=mysql_query($q) or die(mysql_error());

	
							$row=mysql_fetch_array($result1);
?>
			<h5>Order Summary</h5>					
			<table class="table">
				<tr>
					<td>Total Amount : </td>
					<td><?php echo $row['OrderTotalAmount']; ?></td>
				</tr>
				<tr>
					<td>Offer Discount : </td>
					<td><?php echo $row['OfferDiscount']; ?></td>
				</tr>
				<tr>
					<td>Manual Discount : </td>
					<td><?php echo $row['ManualDiscount']; ?></td>
				</tr>
				<tr>
					<td>Tax(in %): </td>
					<td><?php echo $row['TaxPercentage']; ?></td>
				</tr>
				<tr>
					<td>Payable Amount : </td>
					<td><?php echo $row['PayableAmount']; ?></td>
				</tr>
			</table>

				<?php		
				mysql_close();	

			?> 	

						 

                           