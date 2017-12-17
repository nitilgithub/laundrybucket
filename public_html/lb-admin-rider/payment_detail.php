<?php
include('header.php');
?>
<?php
if(isset($_GET['oid']))
{
	$oid=$_GET['oid'];

?>
<style>
	@media screen and (max-width: 600px) {
#example {width:100%;}
#example thead {display: none !important;}
#example tr:nth-of-type(2n) {background-color: inherit;}
#example tr td:first-child {background: #f0f0f0; font-weight:bold;font-size:1.3em;}
#example tbody td {display: block; }
#example tbody td:before { 
    content: attr(data-th); 
    display: block;
   	
  }
}
</style>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			
				<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i>
                                    	<?php
										
										$r=mysql_query("select OrderUserId from tbl_orders where OrderId='$oid'") or die(mysql_error());
										if(mysql_affected_rows())
										{
											$urow=mysql_fetch_array($r);
											$userid=$urow[0];
											$res=mysql_query("select * from tblusers where UserId='$userid'") or die(mysql_error());
											
											 if(mysql_affected_rows())
											{
												$urow1=mysql_fetch_array($res);
												
											 echo $urow1['UserFirstName']." ".$urow1['UserLastName']."'s ";
											}
										}
										 ?> Payment Detail </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <!--<li><a class="close-link"><i class="fa fa-close"></i></a>  </li>-->
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                               


                                                  <div class="x_content table-responsive">
                                                  	
                                    <table id="example" class="table table-striped table-bordered responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <!--
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                -->
                                               <th>User Id</th>
												<th>Order Id </th>
	                                     		<th>Amount Paid</th> 
                                                <th>Mode of Payment </th>
                                               	<th>Amount Received By</th>
                                                <th>Delivery Boy Name</th>
                                                <th>Amount Received On</th>
                                                <th>Remarks</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											
	                                              
                                    <?php
                                    $res=mysql_query("select * from tbl_payment_history where OrderId='$oid'") or die(mysql_error());
									while($row=mysql_fetch_array($res))
									{
										$paymentmode=$row['ModeofPayment'];
										$riderid=$row['RiderId'];
										
										$re2=mysql_query("select * from tbl_employee where empId='$riderid'") or die(mysql_error());
										$rw2=mysql_fetch_array($re2);
								
										$result1=mysql_query("select * from tbl_paymentmode where id='$paymentmode'") or die(mysql_error());
										$row1=mysql_fetch_array($result1);
										$result2=mysql_query("select * from tbl_rider where RiderId='$riderid'") or die(mysql_error());
										$row2=mysql_fetch_array($result2);
								
                                   	?>
                                   	<tr class="even pointer">
                                   		<td data-th="User Id" title="Click on this id to view complete detail of customer"><a href="reguserlist_new.php?uid=<?php echo $row["UserId"];?>" style="color:black;display:block;"><?php echo $row["UserId"];?></a></td>
                                   		
												     <td data-th="Order Id"><?php echo $oid; ?></td>
												     
												      <td data-th="Amount Paid" class=" ">₹ <?php echo $row["AmountPaid"];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td data-th="Mode of Payment" class=" "><?php
												      if($row1["PaymentMode"]==""){
												      	echo $paymentmode;
													  }
													  else {
														  echo $row1["PaymentMode"];
													  }
												      
												      ?> </td>
	                                               <td data-th="Amount Received By" class=" "><?php echo $row["AmountReceivedBy"];?> </td>
	                                                <td data-th="Delivery Boy Name" class=" "><?php if($riderid==-1){echo "-Not Applicable-";} else{ echo  $rw2["empName"];}?>  </td>
	                                                <td data-th="Amount Received On" class=" "><?php echo  $row["AmountReceivedOn"];?>  </td>
	                                     <td data-th="" class=" "><?php echo  $row["Remarks"];?>  </td>
	                                                 		 </tr>
															 
										<?php }  ?>		
                                            
                                        </tbody>

                                    </table>
                                    
                           			 </div>

                                </div>
                            </div>
                            

	<div class="col-md-12 col-sm-12 col-xs-12">
				<!--<div class="row">
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
				</div>-->
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					<h3>Existing Order</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<?php
							$res=mysql_query("select * from tbl_orders where OrderId='$oid'");
							if(mysql_affected_rows())
							{
								while($row=mysql_fetch_array($res))
								{
									$balance=$row["PayableAmount"]-$row["PaidAmount"];
							?>
							
							<div class="col-md-4 col-sm-6 col-xs-12">
								
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
										<td>Order Total Amount</td>
										<td>₹ <?php echo $row['OrderTotalAmount'];?></td>
									</tr>
									<tr>
										<td><a href="place_order.php?oid=<?php echo $row['OrderId'];?>&uid=<?php echo $userid;?>" style="color:#000000;"><button class="btn btn-primary">Edit Order</button></a></td>
										<td>
											<?php if($row["PayableAmount"]==0){ ?><button class="btn btn-success">&nbsp;&nbsp;&nbsp;NA&nbsp;&nbsp;&nbsp;</button><?php }else if($balance==0){?> <button class="btn btn-success">&nbsp;&nbsp;PAID&nbsp;&nbsp;</button><?php } else{?>
											<a href="pay_order.php?oid=<?php echo $row['OrderId'];?>" style="color:#000000;"><button class="btn btn-danger">Pay Now</button></a><?php }?>
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
<?php } ?>
<?php
include('footer.php');
?>