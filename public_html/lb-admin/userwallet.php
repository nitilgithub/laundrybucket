<?php
include 'header.php';
if(isset($_GET['uid']))
{
	$uid=mysql_real_escape_string($_GET['uid']);
	$query=mysql_query("select * from tblusers where UserId='$uid'");
	$qrow=mysql_fetch_array($query);
?>
<script>
	$(document).on("click","#btnDeduct",function(){
			var deduct_amt=$("#deduct_amt").val();
			var deduct_remarks=$("#deduct_remarks").val();
			var a_refer=$("#a_refer").val();
			var uid=$("#uid").val();
			
			if(deduct_amt>a_refer)
			{
				alert("Don't have enough money in the wallet. Please deduct an amount available.");
			}
			else
			{		
			var strurl="https://www.laundrybucket.co.in/lb-admin/api_deductfrom_wallet.php?uid="+uid+"&damt="+deduct_amt+"&dremarks="+deduct_remarks;
			console.log(strurl);
			$.ajax({
			    type : "GET",
			    url : strurl,
			    success : function(data){
			       $.each(data,function(i,field){
			       				var status=field.status;
								if(status==1)
								{
									alert("Amount Successfully deducted from wallet");
									window.setTimeout(function(){location.reload()},1000);
								}
								else if(status==2)
								{
									alert("Please fill the required fields marked with * with valid values");
								}
								else
								{
									alert("Error in processing your request. Try again");
								}
							});
			    }
			});
			}
	});
	
		$(document).on("click","#btnAddMoney",function(){
			var add_amt=$("#add_amt").val();
			var add_remarks=$("#add_remarks").val();
			
			var uid=$("#uid").val();
			
					
			var strurl="https://www.laundrybucket.co.in/lb-admin/api_addto_wallet.php?uid="+uid+"&damt="+add_amt+"&dremarks="+add_remarks;
			console.log(strurl);
			$.ajax({
			    type : "GET",
			    url : strurl,
			    success : function(data){
			       $.each(data,function(i,field){
			       				var status=field.status;
								if(status==1)
								{
									alert("Amount Successfully added to wallet");
									window.setTimeout(function(){location.reload()},1000);
								}
								else if(status==2)
								{
									alert("Please fill the required fields marked with * with valid values");
								}
								else
								{
									alert("Error in processing your request. Try again");
								}
							});
			    }
			});
			
	});
</script>
<div class="right_col" role="main">
	<div class="row">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				<h2><?php echo $qrow['UserFirstName']." ".$qrow['UserLastName']; ?>'s Wallet Detail</h2>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Deduct from Wallet
                                    	<?php
                                    	$result1=mysql_query("select sum(amount) from tbl_wallet where uid='$uid'");
	                                	$rows1=mysql_fetch_array($result1);
										
										$result2=mysql_query("select sum(amount) from tbl_wallet_history where userId='$uid'");
										$rows2=mysql_fetch_array($result2);
                                    	?>
                                    	(Available Wallet Amount: INR <?php if($rows1[0]==""){ echo 0;} else {echo $rows1[0]-$rows2[0]; }?>)
                                    	
                                    </h2>
                                    <input type="hidden" value="<?php if($rows1[0]==""){ echo 0;} else {echo $rows1[0]-$rows2[0]; }?>" id="a_refer" />
                                    <input type="hidden" value="<?php echo $uid; ?>" id="uid" />
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
                                               
                                                
                                               <th>Amount to Deduct* </th> 
                                                <th>Remarks* </th>
                                               
                                                <th>Action </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                            <td><input type="text" class="form-control" id="deduct_amt" name="deduct_amt" placeholder="Enter amount to deduct from wallet" required="required" /></td>
	                                            <td><textarea required="required" placeholder="Why you are deducting the amount?" id="deduct_remarks" name="deduct_remarks" class="form-control"></textarea></td>
	                                            <td><input type="button" class="btn btn-primary" value="Submit" id="btnDeduct" /></td>
	                                       </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
                            <!--add to wallet-->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Add to Wallet
                                    	
                                    	(Available Wallet Amount: INR <?php if($rows1[0]==""){ echo 0;} else {echo $rows1[0]-$rows2[0]; }?>)
                                    	
                                    </h2>
                                    
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
                                               
                                                
                                               <th>Amount to Add* </th> 
                                                <th>Remarks* </th>
                                               
                                                <th>Action </th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                            <td><input type="text" class="form-control" id="add_amt" name="add_amt" placeholder="Enter amount to add to wallet" required="required" /></td>
	                                            <td><textarea required="required" placeholder="Why you are adding the amount?" id="add_remarks" name="add_remarks" class="form-control"></textarea></td>
	                                            <td><input type="button" class="btn btn-primary" value="Submit" id="btnAddMoney" /></td>
	                                       </tr>
															 
												
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            <!--add to wallet-->
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Order Detail (Recent 3) </h2>
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
                                              
                                                <th>Order Amount </th>
                                                <th>Total Discount</th>
                                                <th>Tax(%)</th>
                                                <th>Payable Amount</th>
                                               <th>Amount Paid</th>
                                              
                                                <th>Order Status</th>
                                                <th>Remarks</th>
                                                
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											
	                                              
                                    <?php
                                    $query="select * from  tbl_orders where OrderUserId='$uid' order by OrderId desc limit 0,3";
									$res=mysql_query($query);
									while($row1=mysql_fetch_array($res))
									{
										$oid=$row1['OrderId'];
									$order_statusid=$row1["OrderStatusId"];	
									$result2=mysql_query("select * from tbl_orderstatus_id where order_status_id='$order_statusid'") or die(mysql_error());
	                             	$data2=mysql_fetch_array($result2);
								
								
								$res1=mysql_query("select s.OrderId,sum(w.amount) as tamount from tbl_wallet_history as w join tbl_suborders as s on w.subOrderId=s.SubOrderId where w.userId='$uid' and s.OrderId='$oid'");
								$rows1=mysql_fetch_array($res1);
										
                                   	?>
                                   	<tr class="even pointer">
												     <td><?php echo $oid; ?></td>
												     
												      <td class=" "><?php echo $row1["Order_PickDate"];?></td> 
												      
												       												        
												      <td class=" ">₹<?php echo $row1["OrderTotalAmount"];?> </td>
												      <td class=" ">₹<?php echo $row1["OfferDiscount"]+$row1['ManualDiscount']+$rows1['tamount'];?> </td>
												      <td class=" ">₹<?php echo $row1["TaxPercentage"];?> </td>
												      <td class=" ">₹<?php echo $row1["PayableAmount"];?> </td>
	                                               <td class=" ">₹<?php echo $row1["PaidAmount"];?> </td>
	                                              
	                                                <td class=" "><?php echo  $data2["order_status_text"];?>  </td>
	                                                <td class=" "><?php echo  $row1["Remarks"];?>  </td>
	                                     
	                                        </tr>
															 
										<?php
										}
										?>		
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Wallet Deduction History </h2>
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
                                               
												<th>Sr no </th>
                                               
                                               <th>Sub OrderId</th>
                                               <th>Amount</th>
                                                <th>Remarks</th>
                                                <th>Date</th>
                                                
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              
											<tr class="even pointer">
	                                              
                                    <?php
                                   $res1=mysql_query("select * from tbl_wallet_history where userId='$uid' order by id desc");
									$count=1;
									while($row1=mysql_fetch_array($res1))
									{	
                                   	?>
											   <td><?php echo $count; ?></td>
											     
											 
										       <td class=" "><?php echo $row1["subOrderId"];?></td> 
										       <td class=" "><?php echo "INR ".$row1["amount"];?></td> 
										        
                                               <td class=" "><?php echo  $row1["remarks"];?>  </td>
                                               <td class=" "><?php echo  $row1["addon"];?>  </td>
	                                  </tr>
															 
										
	                                     <?php
	                                     $count++;
	                                     }
	                                     ?>
	                                         		
                                            
                                        </tbody>

                                    </table>
                                    
                                    	                                </div>

                                </div>
                            </div>
                            
                            
              <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="fa fa-bars"></i> Wallet Addition History </h2>
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
                                               
												<th>Sr no</th>
												<th>Title</th>
												<th>Amount</th>
												<th>Date</th>
                                                <th>Referal User</th>
                                            </tr>
                                            
                                         
                                        </thead>

                                        <tbody>
                              <?php
								$res2=mysql_query("select * from tbl_wallet where uid='$uid' order by id desc");
								$count2=1;
								while($row2=mysql_fetch_array($res2))
								{
									$ruid=$row2['referUserId'];
									if($ruid=="" || $ruid==NULL){
										$referuser="-";
									}
									else
									{
										$q=mysql_query("select * from tblusers where UserId='$ruid'");
										$rw=mysql_fetch_array($q);
										$referuser="UserId: ".$rw['UserId']."<br>".$rw['UserEmail']."<br>".$rw['UserPhone'];
									}
							?>
											<tr class="even pointer">
	                                              
												    <td><?php echo $count2;?></td>
												     
	                                                <td class=" "><?php echo $row2['title'];?></td>
	                                                <td class=" "><?php echo "INR ".$row2['amount'];?> </td>
	                                                <td><?php echo $row2['addon'];?></td>
	                                              <td><?php echo $referuser;?></td>
	                                        </tr>
						               
								<?php
									$count2++;
								}
                                ?>    
                                        </tbody>

                                    </table>
                                    
                                  </div>

                                </div>
                            </div>
			
			
			
		</div>
	</div>
</div>

<?php
}
include 'footer.php';

?>