<?php
@ob_start();
@session_start();
include '../connection.php';

header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

$sorderid=trim($_GET["soid"]);


?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Item Name</th>
		<th>Item Price</th>
		<th>Quantity</th>
		<th>Total Amount</th>
		<th>Service</th>
		<th>Service Category</th>
		<th>Unit</th>
		<th>Description</th>
		<th colspan="2">Action</th>
	
	</tr>
<?php
	 $q2="select * from tbl_suborders_items where SubOrderId='$sorderid'";

	 $result2=mysql_query($q2) or die(mysql_error());

	$count=1;
					while($rows=mysql_fetch_array($result2))
							{
								$item_id=$rows['ItemId'];
								$result1=mysql_query("select * from tbl_services_itemsprice where ItemId='$item_id'") or die(mysql_error());
								$row1=mysql_fetch_array($result1);
								$servicecatid=$row1['ServiceCatId'];
								$priceunit=$row1['PriceUnit'];
								$serviceid=$row1['ServiceId'];
								$r1=mysql_query("select * from tbl_services where ServiceId='$serviceid'") or die(mysql_error());
								$rw1=mysql_fetch_array($r1);
								$r2=mysql_query("select * from tbl_priceunit where UnitId='$priceunit'") or die(mysql_error());
								$rw2=mysql_fetch_array($r2);
								$r3=mysql_query("select * from tbl_services_category where ServiceCatId='$servicecatid'") or die(mysql_error());
								$rw3=mysql_fetch_array($r3);
?>
		<tr>
			<td><?php echo $count; ?></td>
			<td><?php echo $rows['ItemName'];?></td>
			<td><?php echo $rows['ItemRate'];?></td>
			<td class="editqty"><?php echo $rows['Qty'];?></td>
			<td><?php echo $rows['TotalAmount'];?></td>
			<td><?php echo $rw1['ServiceName'];?></td>
			<td><?php echo $rw3['ServiceCatName'];?></td>
			<td><?php echo $rw2['UnitName'];?></td>
			<td><?php echo $rows['Description'];?></td>
			<td><button class="btn btn-primary editbtn btn-sm" title="<?php echo $rows['srno'];?>">Edit</button></td>
			<td><button class="btn btn-danger btndel btn-sm" title="<?php echo $rows['srno'];?>">Delete</button></td>
		</tr>						
			
<?php $count++; } ?>
</table>
<?php
	 $q="select * from tbl_suborders where SubOrderId='$sorderid'";

	 $result1=mysql_query($q) or die(mysql_error());

	
							$row=mysql_fetch_array($result1);
?>
			<h4>SubOrder Summary</h4>					
			<table class="table">
				<tr>
					<td>Total Amount : </td>
					<td><?php echo $row['ItemTotalAmount']; ?></td>
				</tr>
				<!--<tr>
					<td>Discount : </td>
					<td><?php echo $row['discount']; ?></td>
				</tr>
				<tr>
					<td>Tax(in %): </td>
					<td><?php echo $row['TaxPercentage']; ?></td>
				</tr>
				<tr>
					<td>Payable Amount : </td>
					<td><?php echo $row['PayableAmount']; ?></td>
				</tr>-->
			</table>

				<?php		
				mysql_close();	

			?> 	

						 

                           