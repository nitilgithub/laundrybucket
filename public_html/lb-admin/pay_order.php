<?php include('header.php'); ?>
<?php
if(isset($_GET['oid']))
{
	$oid=$_GET['oid'];
	$res=mysql_query("select * from tbl_orders where OrderId='$oid'") or die(mysql_error());
	$row=mysql_fetch_array($res);
	$balance=$row['PayableAmount']-$row['PaidAmount'];	
	if($balance<=0)
	{
		header('location:suborder_dashboard.php?oid='.$oid);
	}
	$uid=$row['OrderUserId'];
	if(isset($_POST['btnPay']))
	{
		$paymentmode=$_POST['paymentmode'];
		$amtpaid=$_POST['paymentreceive'];
		$receiveby=$_POST['paymentreceiveby'];
		$riderid=$_POST['deliverboy'];
		
		//$amtreceiveon=$_POST['pickdate'];
		$ddate=trim($_POST["pickdate"]);
		$date = DateTime::createFromFormat('m/d/Y', $ddate);
		$amtreceiveon=$date->format('Y-m-d');
			
		$remarks=$_POST['remarks'];
		
		$result=mysql_query("insert into tbl_payment_history(OrderId,UserId,ModeofPayment,AmountPaid,AmountReceivedBy,RiderId,AmountReceivedOn,Remarks,addon) values('$oid','$uid','$paymentmode','$amtpaid','$receiveby','$riderid','$amtreceiveon','$remarks',now())");
		
		if(mysql_affected_rows())
		{
			$res1=mysql_query("select sum(AmountPaid) from tbl_payment_history where OrderId='$oid'") or die(mysql_error());
			$row1=mysql_fetch_array($res1);
			$totalamtpaid=(float)$row1[0];
			$res2=mysql_query("update tbl_orders set PaidAmount='$totalamtpaid' where OrderId='$oid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				header('location:suborder_dashboard.php?oid='.$oid);
			}
		}
		else {
			echo mysql_error();
			
		}
	}
?>
<script>
	$(document).on("change","#paymentreceiveby",function(){
		var receiveby=$(this).val();
		if(receiveby=='Delivery Boy')
		{
			$(".deliveryboydiv").show(50);
		}
		else
		{
			$(".deliveryboydiv").hide(50);
			$("#deliverboy").val("-1");
		}
	});
	$(document).on("keyup","#paymentreceive",function(){
		var receiveamt=$(this).val();
		var remainingamt=$("#remainingamt").val();
		//alert(receiveamt);
		//alert(remainingamt);
		if(Number(receiveamt)>Number(remainingamt))
		{
			$(".message").html("The amount you entered is incorrect");
			//alert("incorrect");
		}
		else
		{
			$(".message").html("");
		}
	});
</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="co-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2>Pay for the Order</h2>
			</div>
			<div class="co-md-12 col-sm-12 col-xs-12">
				
					<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="orderid">Order Id</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<input type="text" class="form-control col-md-7 col-xs-12" name="orderid" required="" readonly="readonly" placeholder="" value="<?php echo $oid;?>">
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="orderamt">Total Order Amount</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<input type="text" class="form-control col-md-7 col-xs-12" name="orderamt" required="" readonly="readonly" placeholder="" value="<?php echo $row['PayableAmount'];?>">
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="paidamt">Amount Paid</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<input type="text" class="form-control col-md-7 col-xs-12" name="paidamt" required="" readonly="readonly" placeholder="" value="<?php echo $row['PaidAmount'];?>">
							
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="remainingamt">Remaining Amount(To be paid)</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<input type="text" class="form-control col-md-7 col-xs-12" name="remainingamt" id="remainingamt" required="" readonly="readonly" placeholder="" value="<?php echo $row['PayableAmount']-$row['PaidAmount'];?>">
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="paymentreceive">Payment Received</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<input type="text" class="form-control col-md-7 col-xs-12" name="paymentreceive" id="paymentreceive" placeholder="Enter Amount Received(In Rupees)" required="required" />
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="message"></label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<span class="message" style="color:red;"></span>
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="paymentreceiveby">Payment Received By</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<select class="form-control" required name="paymentreceiveby" id="paymentreceiveby">
								<option value=""  style="padding-bottom:7px">Select Payment Received By</option>
								<option value="Delivery Boy"  style="padding-bottom:7px">Delivery Boy</option>
								<option value="Company Account"  style="padding-bottom:7px">Company Account</option>
							</select>
							</div>
						</div>
						&nbsp;
						<div class="item form-group deliveryboydiv" hidden>
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="deliverboy">Delivery Boy Name</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<select class="form-control" required name="deliverboy" id="deliverboy">
								<option value="-1"  style="padding-bottom:7px">Select Delivery Boy</option>
								<?php
						
							 $res2=mysql_query("SELECT * from tbl_per_employee_roles where empRoleId=7");			
								if(mysql_affected_rows())
							{
								while($rows2=mysql_fetch_array($res2))
						
							{
								$empid=$rows2['empId'];
								$r1=mysql_query("select * from tbl_employee where empId='$empid'");
								$row3=mysql_fetch_array($r1);
								?>
								<option  value="<?php echo $rows2["empId"]; ?>"   style="margin-bottom:7px"><?php echo $row3["empName"]; ?></option>
								
								<?php
								}
								}
							?>
								
							</select>
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
			        		<label class="control-label col-md-4 col-sm-5 col-xs-5" for="dob">Payment Received On
		                    </label>
		                    <div class="col-md-6 col-sm-7 col-xs-7">
		          
		           			<input type="text" id="datepicker" class="form-control date-picker col-md-7 col-xs-12" name="pickdate" required="" placeholder="Select Received Date">      
		                    </div>
		                </div>
		                &nbsp;
						<div class="item form-group">
							<label class="control-label col-md-4 col-sm-5 col-xs-5" for="paymentmode">Payment Mode</label>
							<div class="col-md-6 col-sm-7 col-xs-7" >
							<select class="form-control" required name="paymentmode" id="paymentmode">
								<option value=""  style="padding-bottom:7px">Select Payment Mode</option>
								<?php
							
								 $res2=mysql_query("SELECT * from tbl_paymentmode");			
									if(mysql_affected_rows())
									{
									while($rows2=mysql_fetch_array($res2))
									{
									?>
									<option  value="<?php echo $rows2["id"]; ?>" style="margin-bottom:7px"><?php echo $rows2["PaymentMode"]; ?></option>
									<?php
									}
									}
								?>
							</select>
							</div>
						</div>
						&nbsp;
						<div class="item form-group">
                            <label class="control-label col-md-4 col-sm-5 col-xs-5" for="remarks">Remarks
                            </label>
                            <div class="col-md-6 col-sm-7 col-xs-7">
                       		<input type="text" class="form-control col-md-7 col-xs-12"  name="remarks" placeholder="Remarks" style="height: 95px">
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
                         	<input type="submit" name="btnPay" class="btn btn-success" id="btnPay" value="Submit"/>
                        	</div>
                    	</div>
                    	&nbsp;
					</form>
				
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<?php include('footer.php'); ?>