<?php include('header.php');
$uid=mysql_real_escape_string($_SESSION["uid"]);
?>
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Order History</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Order History</li>
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
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-yellow pull-left"></div>&nbsp;<span class="legendtitle">Ready for Pickup</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-green pull-left"></div>&nbsp;<span class="legendtitle">Order Received</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-aqua pull-left"></div>&nbsp;<span class="legendtitle">Order is in Process</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-brown pull-left"></div>&nbsp;<span class="legendtitle">Ready to Deliver</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-voilet pull-left"></div>&nbsp;<span class="legendtitle">Order Delievered</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-grey pull-left"></div>&nbsp;<span class="legendtitle">Partial Delivered</span>&nbsp;
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6">
						<div class="legendbox bg-red pull-left"></div>&nbsp;<span class="legendtitle">Order Cancelled</span>&nbsp;
						</div>
					</div>
<br>
					<div class="single-page row">
<?php
 $result2=mysql_query("select * from tbl_orders where OrderUserId='$uid' order by OrderId DESC") or die(mysql_error());
if(mysql_affected_rows())
  {
    while($row=mysql_fetch_array($result2))
 {						
?>						
						<div class="col-md-4 col-sm-6 col-xs-12">
			              <!-- small box -->
			              <div class="small-box 
			              <?php
			              if($row["OrderStatusId"]==0) echo "bg-yellow";
						  else if($row["OrderStatusId"]==1) echo "bg-green";
						  else if($row["OrderStatusId"]==2) echo "bg-aqua";
						  else if($row["OrderStatusId"]==3) echo "bg-brown";
						  else if($row["OrderStatusId"]==4) echo "bg-voilet";
						  else if($row["OrderStatusId"]==5) echo "bg-red";
						  else if($row["OrderStatusId"]==6) echo "bg-grey";
						  else echo "";
			              ?>">
			              	 				                    		
			                <div class="inner">
			                  <h3>#<?php echo $row["OrderId"];?></h3>
			                  <p>Pickup: <?php echo date("d-m-Y", strtotime($row["Order_PickDate"]));?>, &#8377; <?php echo $row['PayableAmount'];?></p>
			                </div>
			                <div class="iccon">
			                  <i class="fa fa-plus"></i>
			                </div>
			                <a href="userorder_detail.php?oid=<?php echo $row["OrderId"];?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			              </div>
			            </div>
			            
<?php } }?>			            
			            <!--<div class="col-md-4 col-sm-6 col-xs-12">
			              
			              <div class="small-box bg-voilet">
			              	 				                    		
			                <div class="inner">
			                  <h3>#3180</h3>
			                  <p>Pickup: 19-06-2017, &#8377; 215</p>
			                </div>
			                <div class="iccon">
			                  <i class="fa fa-plus"></i>
			                </div>
			                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			              </div>
			            </div>-->
						
						
					 </div>

				</div>

			</div>
			



		</div>
	</div>

<?php include('footercta.php')?>
		
<?php include('footer.php');?>