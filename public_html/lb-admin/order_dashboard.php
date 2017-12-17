<?php
include 'header.php';
?>
<?php
//if(empty($_SESSION['current_user']))
//header('location:customer_info.php');
if(isset($_GET['uid']))
{
$uid=$_GET['uid'];
?>

<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
					<?php
					
					$r=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
					if(mysql_affected_rows())
					{
						$urow=mysql_fetch_array($r);
						
					 echo "<h2>".$urow['UserFirstName']." ".$urow['UserLastName']."'s Order Summary/Order Dashboard</h2>";
					}
					 ?>
				</div>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<a href="place_order.php?uid=<?php echo $uid;?>" style="color:#000000;">
				<button class="btn btn-info pull-left">
					<img src="img/plus.png" class="img-responsive pull-left" height="33px" width="33px">&nbsp;<span style="font-size:20px; text-align: center;">New Order</span>
				</button>
				</a>
				<a href="payment_history.php?uid=<?php echo $uid;?>" style="color:#000000;">
					<button class="btn btn-info btn-lg">Payment History</button>
				</a>
				</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					<h3>Select Order/Existing Orders</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<?php
							$res=mysql_query("select * from tbl_orders where OrderUserId='$uid'");
							if(mysql_affected_rows())
							{
								while($row=mysql_fetch_array($res))
								{
									$balance=$row["PayableAmount"]-$row["PaidAmount"];
							?>
							
							<div class="col-md-4 col-sm-6 col-xs-12" style="height: 300px;">
								
								<div class="col-md-12 col-sm-12 col-xs-12 ordersdiv" style="border: 1px solid #c0c0c0; padding:5px;<?php
									if($row['OrderStatusId']==0){echo 'background-color: #F0D278;';}
									if($row['OrderStatusId']==1){echo 'background-color: #90CFE8;';}
									if($row['OrderStatusId']==2){echo 'background-color: #A8A6E3;';}
									if($row['OrderStatusId']==3){echo 'background-color: #F4FA4D;';}
									if($row['OrderStatusId']==4){echo 'background-color: #67F060;';}
									if($row['OrderStatusId']==5){echo 'background-color: #FA9078;';}
									?>">
								<table class="table">
									<tr>
										<td>Order Id</td>
										<td><?php echo $row['OrderId'];?></td>
									</tr>
									<tr>
										<td>Order Total Amt</td>
										<td>₹ <?php echo $row['OrderTotalAmount'];?></td>
									</tr>
									<tr>
										<td>Order Paid Amt</td>
										<td>₹ <?php echo $row['PaidAmount'];?></td>
									</tr>
									<tr>
										<td>Order Pending Amt</td>
										<td>₹ <?php echo $balance;?>
											
										<?php if($row["PayableAmount"]==0){ ?><?php }else if($balance==0){?><br> <?php } else{?>
											<a href="pay_order.php?oid=<?php echo $row['OrderId'];?>" style="color:#000000;"><button class="btn btn-danger btn-xs">Pay Now</button></a><?php }?>	
										</td>
									</tr>
									<tr>
										<td><a href="place_order.php?oid=<?php echo $row['OrderId'];?>&uid=<?php echo $uid;?>" style="color:#000000;"><button class="btn btn-primary">Edit Order</button></a></td>
										<td>
										</td>
									</tr>
								</table>
								</div>&nbsp;
							</div>
							<?php
								}
							}
							?>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #F0D278;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Ready for Pickup</span>
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #90CFE8;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Order received</span>
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #A8A6E3;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Order is in Process</span>
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #F4FA4D;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Order is  ready to deliver</span>
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #67F060;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Order delivered</span>
						</div>
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div style="height: 20px; width: 20px; background-color: #FA9078;" class="pull-left"></div>&nbsp;
							<span class="pull-left" style="font-size:18px;">&nbsp;Order Cancelled</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<?php
include 'footer.php';

?>