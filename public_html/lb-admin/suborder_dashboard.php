<?php
include 'header.php';
if(isset($_GET['oid']))
{
	$oid=$_GET['oid'];
	if(isset($_GET[uid])){
		$uid=$_GET['uid'];
	}
	else {
		$result=mysql_query("select OrderUserId from tbl_orders where OrderId='$oid'") or die(mysql_error());
		$rows=mysql_fetch_array($result);
		$uid=$rows[0];
	}
	
}
?>
<script>
	$(document).on("click",".btndelsuborder",function(){
		var suboid=$(this).attr("title");
		var r=confirm("Do you really want to delete this suborder and all its items?");
		if(r==true)
  		{
  		//window.location.href="cancel_allorderslist.php?id="+row.order_id;
  		window.scrollTo(0, 0);
  		$("#confirmDeletediv").fadeToggle(100);
  		 $(".container").find("*").not("#confirmDeletediv").animate({
            opacity: "0.9"
        }, 1000);
        	$(document).on("click","#btnDelete",function(){
        	var loginpass=$("#loginpass").val();
        	var confirmpass=$("#confirmpass").val();
        	if(loginpass==confirmpass)
        	{
			var strurl="https://www.laundrybucket.co.in/lb-admin/delete_suborder.php?suboid="+suboid;
			$.ajax({
			    type : "GET",
			    url : strurl,
			    success : function(data){
			       $.each(data,function(i,field){
			       				var status=field.status;
								if(status==1)
								{
									alert("Suborder deleted Successfully");
									window.setTimeout(function(){location.reload()},1000);
								}
								else
								{
									alert("error");
								}
							});
			    }
			});
			}
			else
			{
				alert("You entered wrong password");
			}
			
			});
  		
  		}
  		else
  		{
  			return false;
  		}
	});
	
</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2>Sub Order Summary/Sub Order Dashboard</h2>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Customer Detail </h2>
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
                                               
												<th title="Click on id to view complete detail of cutomer">CustomerId </th>
												
                                                
                                               <th>Name </th> 
                                                <th>Email </th>
                                               
                                                <th>Mobile </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
	                                               <?php
                                             	$query="select * from  tblusers where UserId='$uid'";
													$res=mysql_query($query);
													$row1=mysql_fetch_array($res);
	                                               	?>
												     <td title="Click on this id to view complete detail of cutomer"><a href="reguserlist_new.php?uid=<?php echo $uid; ?>" style="color:black;display:block;"><?php echo $uid; ?></a></td>
												     
												      <td class=" "><?php echo $row1["UserFirstName"].' '.$row1["UserLastName"];?></td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $row1["UserEmail"];?> </td>
	                                               
	                                                <td class=" "><?php echo  $row1["UserPhone"];?>  </td>
	                                     
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Order Detail </h2>
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
                                               
												<th>Order Id </th>
                                             
                                               <th>PickUp Date </th> 
                                               <th>PickUp By</th>
                                               <th>PickUp Address</th>
                                                <th>Order Amount </th>
                                                <th>Total Discount</th>
                                                <th>Tax(%)</th>
                                                <th>Payable Amount</th>
                                               <th>Amount Paid</th>
                                               <th>Remaining Amount</th>
                                                <th>Order Status</th>
                                                <th>Remarks</th>
                                                <th>Payment Detail</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
                                    <?php
                                    $query="select * from  tbl_orders where OrderId='$oid'";
									$res=mysql_query($query);
									$row1=mysql_fetch_array($res);
									$order_statusid=$row1["OrderStatusId"];	
									$result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
	                             	$data2=mysql_fetch_array($result2);
								$balance=$row1["PayableAmount"]-$row1["PaidAmount"];
								$balamt=(float)$balance;
								
								$riderid=$row1["RiderId"];
								$re2=mysql_query("select * from tbl_employee where empId='$riderid'") or die(mysql_error());
								$rw2=mysql_fetch_array($re2);
								
								
								$res1=mysql_query("select s.OrderId,sum(w.amount) as tamount from tbl_wallet_history as w join tbl_suborders as s on w.subOrderId=s.SubOrderId where w.userId='$uid' and s.OrderId='$oid'");
								$rows1=mysql_fetch_array($res1);
										
                                   	?>
												     <td><?php echo $oid; ?></td>
												     
												      <td class=" "><?php echo $row1["Order_PickDate"];?></td> 
												      
												       <td class=" "><?php echo $rw2["empName"];?></td> 
												        <td class=" "><?php echo $row1["PickupAddress"].", ".$row1["OrderCity"];?></td> 
												        
												      <td class=" ">₹<?php echo $row1["OrderTotalAmount"];?> </td>
												      <td class=" ">₹<?php echo $row1["OfferDiscount"]+$row1['ManualDiscount']+$rows1['tamount'];?> </td>
												      <td class=" ">₹<?php echo $row1["TaxPercentage"];?> </td>
												      <td class=" ">₹<?php echo $row1["PayableAmount"];?> </td>
	                                               <td class=" ">₹<?php echo $row1["PaidAmount"];?> </td>
	                                               <td class=" ">₹<?php echo $balamt;?> </td>
	                                                <td class=" "><?php echo  $data2["order_status_text"];?>  </td>
	                                                <td class=" "><?php echo  $row1["Remarks"];?>  </td>
	                                     <td><a href="payment_detail.php?oid=<?php echo $oid; ?>"><button class="btn btn-primary btn-xs">Payment Detail</button></a>
	                                     	<?php if($row1["PayableAmount"]==0){?><button class="btn btn-success btn-xs">NA</button><?php }else if($balance<=0){?> <button class="btn btn-success btn-xs">PAID</button><?php }?>
	                                     </td>
	                                                 		 </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
              <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Sub Order Detail </h2>
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
                                               
												<th>Sub Order Id </th>
												<th>Order Type</th>
												<th>Delivery Type</th>
												<th>Delivery Date</th>
                                                <th>Delivery Address</th>
                                                 <th>Delivery Status</th>
                                                <th>Delivered By(Rider)</th>
                                                <th>Order Weight<br>(in kg)</th>
                                               <th>Order Amount </th>
                                                <th>Total Discount</th>
                                                <th>Tax(%)</th>
                                               <th>Payable Amount</th>
                                               <th>Actual Delivery Date</th>
                                               <th>Remarks</th>
                                               <th>Action</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              <?php
			$res=mysql_query("select * from tbl_suborders where OrderId='$oid' and UserId='$uid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				while($row=mysql_fetch_array($res))
				{
					$soid=$row['SubOrderId'];
					$ordertype_id=$row['OrderTypeId'];
					$deliverytype_id=$row['DeliveryTypeId'];
					$deliverystatus_id=$row['DeliveryStatusId'];
					$deliverby=$row['RiderId'];
					$result1=mysql_query("select * from tbl_services where ServiceId='$ordertype_id'") or die(mysql_error());
					$row1=mysql_fetch_array($result1);
					$result2=mysql_query("select * from tbl_deliverytypes where DeliveryId='$deliverytype_id'") or die(mysql_error());
					$row2=mysql_fetch_array($result2);
					$result3=mysql_query("select * from tbl_orderstatus_id where order_status_id='$deliverystatus_id'") or die(mysql_error());
					$row3=mysql_fetch_array($result3);
					$result4=mysql_query("select * from tbl_employee where empId='$deliverby'") or die(mysql_error());
					$row4=mysql_fetch_array($result4);
					
					$result5=mysql_query("select * from tbl_wallet_history where subOrderId='$soid' and userId='$uid'");
					$row5=mysql_fetch_array($result5);
			?>
											<tr class="even pointer">
	                                              
                                  
												     <td><?php echo $row['SubOrderId'];?></td>
												     
												      <td class=" "><?php echo $row1['ServiceName'];?><br>
												      	<?php
				                                        if($row1['ServiceName']=="Subscription")
														{
															$q=mysql_query("select * from tbl_subs_suborder where subOrderId='$soid'");
															$res1=mysql_fetch_array($q);
															$usersubsid=$res1['user_subs_id'];
															
														 $que1=mysql_query("select * from tbl_usersubscriptions where srno='$usersubsid'");
														 $ro1=mysql_fetch_array($que1);
														 $subsid=$ro1['subs_id'];
														 
															$q2=mysql_query("select * from tbl_subscriptions where subs_id='$subsid'");
															$res2=mysql_fetch_array($q2);
															echo "[".$res2['subs_name']."]";
														}
														?>
										
												      	
												      </td> <!-- if user name not exist in table tblusers then fetch username from tbl_orders-->
												      <td class=" "><?php echo $row2['DeliveryTitle'];?> </td>
	                                               
	                                                <td class=" "><?php echo $row['DeliveryDate'];?></td>
	                                                <td class=" "><?php echo $row['DeliveryAddress'];?> </td>
	                                                <td><?php echo $row3['order_status_text'];?></td>
	                                                <td><?php echo $row4['empName'];?></td>
	                                                <td>
	                                                	<?php
				                                        if($row1['ServiceName']=="Subscription")
														{
															echo $row['TotalWeight'];
														}
														else {
															echo "-";
														}
														?>
	                                                </td>
	                                                 <td>₹<?php echo $row['TotalAmount'];?></td>
	                                                 <td>₹<?php echo $row['OfferDiscount']+$row['ManualDiscount']+$row5['amount'];?></td>
	                                                 <td>₹<?php echo $row['TaxPercentage'];?></td>
	                                                <td>₹<?php echo $row['PayableAmount'];?></td>
	                                                <td><?php echo $row['ActualDeliveryDate'];?></td>
	                                                <td><?php echo $row['Remarks'];?></td>
	                                        <?php
	                                        if($row1['ServiceName']=="Subscription")
											{
											?>
											 <td><a href="create_subs_suborder.php?oid=<?php echo $oid;?>&uid=<?php echo $uid;?>&soid=<?php echo $soid;?>"><button class="btn btn-primary btn-xs">Edit</button></a>
	                                     	
	                                     	<button class="btn btn-danger btn-xs btndelsuborder" title="<?php echo $soid;?>">Delete</button>
	                                     </td>
											<?php
											}
											else {
											?>
											 <td><a href="create_suborder.php?oid=<?php echo $oid;?>&uid=<?php echo $uid;?>&soid=<?php echo $soid;?>&edit=1"><button class="btn btn-primary btn-xs">Edit</button></a>
	                                     	<a href="create_suborder.php?oid=<?php echo $oid;?>&uid=<?php echo $uid;?>&soid=<?php echo $soid;?>&edit=2"><button class="btn btn-success btn-xs">View</button></a>
	                                     	<button class="btn btn-danger btn-xs btndelsuborder" title="<?php echo $soid;?>">Delete</button>
	                                     </td>
											<?php
											}
	                                        ?>    
	                                            
	                                    
	                                                 		 </tr>
															 
						<?php
						}
						}
						?>						
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
			
			<!--<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
			<?php
			$res=mysql_query("select * from tbl_suborders where OrderId='$oid' and UserId='$uid'") or die(mysql_error());
			if(mysql_affected_rows())
			{
				while($row=mysql_fetch_array($res))
				{
					$ordertype_id=$row['OrderTypeId'];
					$deliverytype_id=$row['DeliveryTypeId'];
					$result1=mysql_query("select * from tbl_services where ServiceId='$ordertype_id'") or die(mysql_error());
					$row1=mysql_fetch_array($result1);
					$result2=mysql_query("select * from tbl_deliverytypes where DeliveryId='$deliverytype_id'") or die(mysql_error());
					$row2=mysql_fetch_array($result2);
			?>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #c0c0c0; padding:5px;">
				<table class="table">
					<tr>
						<td>SubOrder Id : </td>
						<td><?php echo $row['SubOrderId'];?></td>
					</tr>
					<tr>
						<td>Order Type : </td>
						<td><?php echo $row1['ServiceName'];?></td>
					</tr>
					<tr>
						<td>Delivery Type : </td>
						<td><?php echo $row2['DeliveryTitle'];?></td>
					</tr>
					<tr>
						<td>Delivery Date : </td>
						<td><?php echo $row['DeliveryDate'];?></td>
					</tr>
					<tr>
						<td>Delivery Address : </td>
						<td><?php echo $row['DeliveryAddress'];?></td>
					</tr>
					<tr>
						<td>Payable Amount : </td>
						<td><?php echo $row['PayableAmount'];?></td>
					</tr>
				</table>
				</div>
			</div>
			<?php
				}
			}			
			?>
			</div>
			</div>-->
			
			
				
			
		</div>
	</div>
</div>
<div style="left: 10%; top: 10%; position: absolute; z-index: 99999; background: #ccc; padding: 10px; border-radius: 5px;" id="confirmDeletediv" hidden>
	<h3>Please confirm your password before deleting this suborder</h3>
	<form role="form">
		<caption>Password</caption>
		<input type="hidden" value="<?php echo $_SESSION['loginpass'];?>" id="loginpass" name="loginpass">
		<input type="password" class="form-control" name="confirmpass" placeholder="Enter your password" id="confirmpass" />
		&nbsp;
		<input type="button" class="btn btn-primary" name="btnDelete" value="Confirm" id="btnDelete" />
	</form>
	
</div>
<?php
include 'footer.php';

?>