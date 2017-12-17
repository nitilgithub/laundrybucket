<?php include('header.php');
if(isset($_GET['oid']))
{
	$oid=intval($_GET['oid']);
?>
<style>
	#header { width: 100%; margin: 10px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px;  float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 5px; border: 1px solid #fff; max-width: 540px; max-height: 70px; overflow: hidden; }


#customer-title { font-size: 20px; float: left; text-transform:capitalize; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td span { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 10px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items span { height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description {  }
#items td.item-name {  }
#items td.description span, #items td.item-name span {  }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value span { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 10px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms span { width: 100%; text-align: center;}



.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>

	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Order Detail</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Order Detail</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="widget categories">
						<ul class="category-nav">
							
							<li class="active"><a href="userorderhistory.php">Order History</a></li>
							<li><a href="usersubscription.php">My Subscriptions</a></li>
							<li><a href="userprofile.php">My Profile</a></li>
							<li><a href="contact.php">Assist Me</a></li>
						</ul>
					</div>
					
					
				</div>

				<div class="col-sm-9 col-md-9">

					<div class="single-page">
						<div id="page-wrap">

						<h2 id="header">INVOICE</h2>
						&nbsp;&nbsp;
						<div id="identity">
						
				            <span id="address">Laundry Bucket<br>
				Email: admin@laundrybucket.co.in
				<br>
				Phone: 011 39589786</span>
				
				            <div id="logo">
				  
				              <img id="image" src="https://laundrybucket.co.in/assets/images/img-1959-copy491x213-160.png" alt="logo" height="70px" />
				            </div>
						
						</div>
						&nbsp;
						<div style="clear:both"></div>
						&nbsp;
						<?php
		$r1=mysql_query("select * from tbl_orders where OrderId='$oid'") or die(mysql_error());
		if(mysql_affected_rows())
		{
			$row=mysql_fetch_array($r1);
			$uid=$row['OrderUserId'];
			$r2=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
			$row2=mysql_fetch_array($r2);
			$uemail=$row2['UserEmail'];
			
			$pickdate=$row['Order_PickDate'];
			
			
		$phone=$row2['UserPhone'];
		$name=$row2['UserFirstName']." ".$row2['UserLastName'];
		$amount=$row['PayableAmount'];
		
		$balamt=$row['PayableAmount']-$row['PaidAmount'];
		if($balamt<0)
		{
			$balamt=0;
		}
		
		//$link="https://www.laundrybucket.co.in/viewinvoice/$oid/$authcode/";
		
		//$link="<a href='https://beta.laundrybucket.co.in/viewinvoice/$oid/$authcode/'> here</a>";
		
		?>
					
						<div id="customer">
				
				            <span id="customer-title">
				            	<?php echo $row2['UserFirstName']." ".$row2['UserLastName']."<br>";
				            	if($row2['UserAddress']=="")
								{
									$result2=mysql_query("select * from tblusers_address where UserId='$uid'");
									$rows2=mysql_fetch_array($result2);
									
									echo $rows2["Address"]."<br>";
								}
								else {
								echo $row2['UserAddress']."<br>";	
								}
								
								echo "Phone: ".$row2['UserPhone'];
				            	?>
				            	
				            </span>
				
				            <table id="meta" class="table">
				                <tr>
				                    <td class="meta-head">Order #</td>
				                    <td><span><?php echo $row['OrderId'];?></span></td>
				                </tr>
				                <tr>
				
				                    <td class="meta-head">Date</td>
				                    <td><span id="date">
				                    	<?php
				                    	$datetime=strtotime($row['addon']);
				                    	$date=date('d-m-Y',$datetime);
										echo $date;
										
				                    	?>
				                    </span></td>
				                </tr>
				                 <tr>
				                    <td class="meta-head">Total Amount</td>
				                    <td><div class="due"> ₹ <?php echo $row['PayableAmount'];?></div></td>
				                </tr>
				                 <tr>
				                    <td class="meta-head">Amount Paid</td>
				                    <td><div class="due"> ₹ <?php echo $row['PaidAmount'];?></div></td>
				                </tr>
				                <tr>
				                    <td class="meta-head">Amount Due</td>
				                    <td><div class="due"> ₹ <?php echo $row['PayableAmount']-$row['PaidAmount'];?></div></td>
				                </tr>
				
				            </table>
						
						</div>
						<?php
		$r3=mysql_query("select * from tbl_suborders where OrderId='$oid' and UserId='$uid'") or die(mysql_error());
		if(mysql_affected_rows())
		{
	
			$count=1;
			while($row3=mysql_fetch_array($r3))
			{
				$soid=$row3['SubOrderId'];
		?>
						<div class="suborder">
						<span style="font-size: 20px; border-bottom: 1px solid #000; border-top: 1px solid #000;">Suborder #<?php echo $count;?>
						<?php
						$otypeid=$row3['OrderTypeId'];
						$res=mysql_query("select * from tbl_services where ServiceId='$otypeid'") or die(mysql_error());
						$rows=mysql_fetch_array($res);
						echo $rows['ServiceName'];
						?>
						</span>
						<table id="items" class="table">
						
						  <tr>
						      <th>Item</th>
						      <th>Service Category</th>
						     <th>Description</th>
						      <th>Unit Cost</th>
						      <th>Quantity</th>
						      <th>Price</th>
						  </tr>
						  <?php
						  $r4=mysql_query("select * from tbl_suborders_items where SubOrderId='$soid'") or die(mysql_error());
						  if(mysql_affected_rows())
						  {
						  	while($row4=mysql_fetch_array($r4)){
						  		$itmid=$row4['ItemId'];
								$r5=mysql_query("select * from tbl_services_itemsprice where ItemId='$itmid'") or die(mysql_error());
								$row5=mysql_fetch_array($r5);
								$serviceCatid=$row5['ServiceCatId'];
								$r6=mysql_query("select * from tbl_services_category where ServiceCatId='$serviceCatid'") or die(mysql_error());
								$row6=mysql_fetch_array($r6);
						  ?>
						  <tr class="item-row">
						      <td class="item-name"><div class="delete-wpr"><span><?php echo $row4['ItemName'];?></span></div></td>
						      <td class="service-cat"><span><?php echo $row6['ServiceCatName'];?></span></td>
						      <td class="description"><span><?php echo $row4['Description'];?></span></td>
						      <td><span class="cost">  ₹ <?php echo $row4['ItemRate'];?></span></td>
						      <td><span class="qty"><?php echo $row4['Qty'];?></span></td>
						      <td><span class="price"> ₹ <?php echo $row4['TotalAmount'];?></span></td>
						  </tr>
						   <?php		
						  	}
						  }
						  ?>
						  
						  
						  <tr id="hiderow">
						    <td colspan="6"></td>
						  </tr>
						  
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line">Subtotal</td>
						      <td colspan="2" class="total-value" align="right"><div id="subtotal"> ₹ <?php echo $row3['TotalAmount'];?></div></td>
						  </tr>
						  <tr>
				
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line">Discount</td>
						      <td colspan="2" class="total-value" align="right"><div id="total"> ₹ <?php echo $row3['OfferDiscount']+$row3['ManualDiscount'];?></div></td>
						  </tr>
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2"  class="total-line">Tax(%)</td>
				
						      <td colspan="2" class="total-value" align="right"><span id="paid"> ₹ <?php echo $row3['tax'];?></span></td>
						  </tr>
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line balance">Payable Amount</td>
						      <td colspan="2" class="total-value balance" align="right"><div class="due"> ₹ <?php echo $row3['PayableAmount'];?></div></td>
						  </tr>
						
						</table>
						</div>
						&nbsp;
						
						<?php	
						$count++;	
							}
						}
						?>
						<!--<div class="suborder">
						<span style="font-size: 20px; border-bottom: 1px solid #000; border-top: 1px solid #000;">Suborder #3179
							DryClean
						</span>
						<table id="items" class="table">
						
						  <tr>
						      <th>Item</th>
						      <th>Service Category</th>
						     <th>Description</th>
						      <th>Unit Cost</th>
						      <th>Quantity</th>
						      <th>Price</th>
						  </tr>
						  
						  <tr class="item-row">
						      <td class="item-name"><div class="delete-wpr"><span>Shirt</span></div></td>
						      <td class="service-cat"><span>Men</span></td>
						      <td class="description"><span></span></td>
						      <td><span class="cost"> ₹ 50</span></td>
						      <td><span class="qty">2</span></td>
						      <td><span class="price"> ₹ 100</span></td>
						  </tr>
						  
						  
						  
						  <tr id="hiderow">
						    <td colspan="6"></td>
						  </tr>
						  
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line">Subtotal</td>
						      <td colspan="2" class="total-value" align="right"><div id="subtotal"> ₹ 100</div></td>
						  </tr>
						  <tr>
				
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line">Discount</td>
						      <td colspan="2" class="total-value" align="right"><div id="total"> ₹ 0.00</div></td>
						  </tr>
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2"  class="total-line">Tax(%)</td>
				
						      <td colspan="2" class="total-value" align="right"><span id="paid"> ₹ 0</span></td>
						  </tr>
						  <tr>
						      <td colspan="2" class="blank"> </td>
						      <td colspan="2" class="total-line balance">Payable Amount</td>
						      <td colspan="2" class="total-value balance" align="right"><div class="due"> ₹ 100</div></td>
						  </tr>
						
						</table>
						</div>
						&nbsp;-->
						
						
						<br>
						<?php if($balamt!=0){?>
				    	<center>
				    	<a href="http://www.laundrybucket.co.in/paytmkit/pgRedirect.php?orderid=<?php echo $oid;?>&userid=<?php echo $uid;?>&amt=<?php echo $balamt;?>">
				    		<button class="btn btn-info">PayNow with Paytm</button>
				    	</a>
				    	</center>
				    	<?php } ?>
						<div id="terms">
						  <h5>Terms</h5>
						  <span>Terms &amp; Conditions Apply. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</span>
						</div>
					
					</div>
						
					 </div>

				</div>

			</div>
			



		</div>
	</div>

<?php
}
}
 include('footercta.php')?>
		
<?php include('footer.php');?>