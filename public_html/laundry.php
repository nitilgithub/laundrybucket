<?php include('header.php'); ?> 
<title>Best laundry service & Laundry pickup service in Ghaziabad, Indirapuram</title>
<meta name="description" content="Best dry cleaning and laundry service in Ghaziabad, we offer laundry pickup service in Vaishali and Indirapuram, at low cost">
<link rel="canonical" href="/laundry-service"/>
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Laundry Services</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Laundry Services</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	      
	
	 
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad" style="padding-top: 15px;">
		<div class="container">
			
			<div class="box-service">
				<div class="box-service-item">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h4 class="section-heading" style="padding-bottom: 5px;">Laundry Service </h4>
							<p style="text-align: center;">
								Our laundry service is best amongst other services in the city because we provide best care to your clothes and ensure that you receive high quality services at low prices. We use latest technology machines that are internationally recognised and premium detergents to give your clothes the special care it needs.  We offer services for your domestic as well as commercial laundry.
							</p>
						</div>
					</div>
					&nbsp;
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="domestic_laundry.php" class="title">Domestic Laundry</a></h3>
				                <p>Whether it is your clothes or home draperies, we offer brilliant administrations on individual pieces of clothing. All the products used by us are of international standards and ...</p>
				                <a href="domestic_laundry.php" class="readmore">Read More <i class="fa fa-angle-right"></i></a>
			              	</div>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_2.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
					</div>
				</div>
				<div class="box-service-item">
					<div class="row">
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_3.jpg" alt="rud" class="img-responsive">
			              	</div>
					</div>
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="commercial_laundry.php" class="title">Commercial Laundry</a></h3>
				                <p>We don’t only specialize in domestic laundry, but provide laundry services for commercial purposes. We understand that it is difficult to invigorate ...</p>
				                <a href="commercial_laundry.php" class="readmore">Read More <i class="fa fa-angle-right"></i></a>
			              	</div>
						</div>
					</div>
				</div>
				
				
			</div>
			
		<!--vs-->
			
			<div class="row">
				
				<div class="col-sm-12 col-md-12">
					<h2 class="section-heading">
						Standard vs Premium Laundry
					</h2>
				</div>

				<div class="col-sm-4 col-md-2 padding0">

					<div class="panel panel-pricing">
						<header class="panel-heading">
							
							<div class="price" style="background: none; color:#000;">
								<span>Service Type</span>
							</div>
						</header>
						<div class="panel-body">
							<table class="table tableservice">
								<tbody>
									<tr><td>Packaging</td></tr>
									<tr><td>Chemicals</td></tr>
									<tr><td>Process</td></tr>
									<tr><td>Undergarments</td></tr>
									<tr><td>Socks</td></tr>
									<tr><td>Handkerchiefs</td></tr>
									<tr><td>Hanger Cloths</td></tr>
									<tr><td>Express Delivery</td></tr>
									<tr><td style="border: none !important;">Tax</td></tr>
									
								</tbody>
							</table>
						</div>
						
					</div>

				</div>

				<div class="col-sm-4 col-md-5 padding0">

					<div class="panel panel-pricing">
						<header class="panel-heading">
							
							<div class="price">
								<span>Standard Laundry</span>
							</div>
						</header>
						<div class="panel-body">
							<table class="table tableservice">
								<tbody>
									<tr><td>Multiple Garments per packaging</td></tr>
									<tr><td>Normal</td></tr>
									<tr><td>MIX WASHING</td></tr>
									<tr><td>NO</td></tr>
									<tr><td>NO</td></tr>
									<tr><td>NO</td></tr>
									<tr><td>Extra charges applies</td></tr>
									<tr><td>100 Percent Extra Charges</td></tr>
									<tr><td style="border: none !important;">All charges included</td></tr>
									
								</tbody>
							</table>
						</div>
						
					</div>

				</div>

				<div class="col-sm-4 col-md-5 padding0">

					<div class="panel panel-pricing">
						<header class="panel-heading">
							
							<div class="price">
								<span>Premium Laundry</span>
							</div>
						</header>
						<div class="panel-body">
							<table class="table tableservice">
								<tbody>
									<tr><td>Individual Packaging</td></tr>
									<tr><td>Premium</td></tr>
									<tr><td>Washing per customer</td></tr>
									<tr><td>NO</td></tr>
									<tr><td>YES</td></tr>
									<tr><td>YES</td></tr>
									<tr><td>No extra charges for hanger cloths</td></tr>
									<tr><td>50 Percent Extra Charges</td></tr>
									<tr><td style="border: none !important;">All charges included</td></tr>
									
								</tbody>
							</table>
						</div>
						
					</div>

				</div>

			</div>
			
			<!--rate list-->
			
			<div class="row">
			
				<div class="col-sm-12 col-md-12">
					<h2 class="section-heading">
						Laundry &amp; Ironing Prices (Inclusive of GST)
					</h2>
				</div>
				
	<?php
	$q=mysql_query("select * from tbl_services where ServiceName like '%laundry%'");
  	$r=mysql_fetch_array($q);
  	$serviceid=$r['ServiceId'];
  	
  	
 	$res=mysql_query("select c.ServiceCatId, c.ServiceCatName from tbl_services_category as c join tbl_services_itemsprice as i on c.ServiceCatId=i.ServiceCatId where i.ServiceId='$serviceid' group by c.ServiceCatName  order by c.ServiceCatName");
  	while($row=mysql_fetch_array($res))
	{
		 $servicecatid=$row['ServiceCatId'];
		 
	?>

				<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading"><?php echo $row['ServiceCatName'];?></div>
						<div class="price-detail-body col-sm-12">
							
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4">Item</div>
								<div class="item-price col-sm-4 col-xs-4">Standard Price</div>
								<div class="item-price col-sm-4 col-xs-4">Premium Price</div>
							</div>
							<?php
					      	$res1=mysql_query("select * from tbl_services_itemsprice where ServiceId='$serviceid' and ServiceCatId='$servicecatid'");
					      	while($row1=mysql_fetch_array($res1))
							{
								$priceunit=$row1['PriceUnit'];
								$q1=mysql_query("select * from tbl_priceunit where UnitId='$priceunit'");
								$r1=mysql_fetch_array($q1);
								
					      	?>
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i><?php echo $row1['ItemName'];?></div>
								<div class="item-price col-sm-4 col-xs-4"><?php echo $row1['StandardRate']." /".$r1['UnitName'];?></div>
								<div class="item-price col-sm-4 col-xs-4"><?php echo $row1['PremiumRate']." /".$r1['UnitName'];?></div>
							</div>
							<?php 
							}
							?>
							<!--<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i>HouseHold</div>
								<div class="item-price col-sm-4 col-xs-4">85.00 /kg</div>
								<div class="item-price col-sm-4 col-xs-4">60.00 /kg</div>
							</div>
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i>Mix</div>
								<div class="item-price col-sm-4 col-xs-4">85.00 /kg</div>
								<div class="item-price col-sm-4 col-xs-4">60.00 /kg</div>
							</div>-->
							
						</div>
					</div>
		
				</div>
				<?php 
				}
				?>
				<!--<div class="col-sm-12 col-md-6">
					<div class="price-detail">
						<div class="price-detail-heading">Wash and Iron</div>
						<div class="price-detail-body col-sm-12">
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4">Item</div>
								<div class="item-price col-sm-4 col-xs-4">Premium Price</div>
								<div class="item-price col-sm-4 col-xs-4">Standard Price</div>
							</div>
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i>Apparels</div>
								<div class="item-price col-sm-4 col-xs-4">125.00 /kg</div>
								<div class="item-price col-sm-4 col-xs-4">85.00 /kg</div>
							</div>
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i>Mix</div>
								<div class="item-price col-sm-4 col-xs-4">125.00 /kg</div>
								<div class="item-price col-sm-4 col-xs-4">85.00 /kg</div>
							</div>
							<div class="item row">
								<div class="item-name col-sm-4 col-xs-4"><i class="fa fa-check-circle hidden-xs"></i>HouseHold</div>
								<div class="item-price col-sm-4 col-xs-4">85.00 /kg</div>
								<div class="item-price col-sm-4 col-xs-4">60.00 /kg</div>
							</div>
							
						</div>
					</div>
		
				</div>-->
				
				
				
				<div class="col-sm-12 col-md-12">
				
				<p class="more-info-price">
				Don't worry if your items not listed here, <a href="contact.php" title="">Send Us Message</a> and we will take care of it.</p>
				</div>
			</div>
		</div>
	</div> 

	<?php include('footercta.php');?>
		 
<?php include('footer.php'); ?>
