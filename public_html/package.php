<?php include('header.php');?>
 <title>Best laundry service & Laundry pickup service in Indirapuram </title> 
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Laundry Packages</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Laundry Packages</li>
					</ol>
				</div>
			</div>
		</div> 
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad" style="padding-top: 20px;">
		<div class="container">

			<div class="row" id="packages">
				<h2 class="section-heading" style="padding-bottom: 10px;">
						Laundry Packages
					</h2>
				
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#monthly">MONTHLY</a></li>
				  <li><a data-toggle="tab" href="#quaterly">QUATERLY</a></li>
				 
				</ul>
				<br>
				<div class="tab-content">
					<div id="monthly" class="tab-pane fade in active">
						<div class="row">
							<?php
        	$result1=mysql_query("select * from tbl_subscriptions where(planType='monthly') order by priority")or die(mysql_error());
			if(mysql_affected_rows())
			{
				$i=0;
				$rcount=mysql_num_rows($result1);
				$color = array("yellow", "green", "aqua", "red","brown", "voilet", "grey","yellow", "green", "aqua", "red","brown", "voilet", "grey","yellow", "green", "aqua", "red","brown", "voilet", "grey" );
				
				 while(($row1=mysql_fetch_array($result1)) && $i<$rcount)
				 {
				 	
				 	?>

							<div class="col-sm-3 col-md-3 col-xs-12">
			
								<div class="panel panel-pricing">
									<header class="panel-heading">
										<h3><?php echo $row1["subs_name"] ?></h3>
										<div class="price bg-<?php echo $color[$i]; ?>">
											<sup>&#8377;</sup><?php echo  $row1["subs_cost"]; ?> <small>/ month</small>
										</div>
									</header>
									<div class="panel-body">
										<table class="table table-striped">
											<tbody>
												<tr><td>Total weight</td><td><?php echo $row1["subs_wt"]; ?> KG</td></tr>
												<tr><td>Total Pickup</td><td><?php echo $row1["subs_maxpickup"]; ?></td></tr>
												<tr><td>Monthly Discount</td><td><?php echo $row1["SubsDiscount_Monthly"]; ?> % </td></tr>
												<tr><td>Service Type</td><td><?php echo $row1["Subs_ServiceType"]; ?></td></tr>
												<tr><td>Garment Type</td><td><?php echo $row1["Subs_GarmentType"]; ?></td></tr>
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<a href="subscribenow.php?o=subscribe&s=<?php echo $row1["subs_id"];?>" class="btn btn-secondary">Subscribe Now</a>
									</div>
								</div>
			
							</div>
				<?php
	 				$i++;
					 }
					 }
					 ?>
			
						</div>
					</div>
					
					
					
					<div id="quaterly" class="tab-pane fade">
						<div class="row">
							<?php
        	$result2=mysql_query("select * from tbl_subscriptions where(planType='quaterly') order by priority")or die(mysql_error());
			if(mysql_affected_rows())
			{
				$i=0;
				$rcount=mysql_num_rows($result2);
				$color = array("yellow", "green", "aqua", "red","brown", "voilet", "grey","yellow", "green", "aqua", "red","brown", "voilet", "grey","yellow", "green", "aqua", "red","brown", "voilet", "grey" );
				
				 while(($row1=mysql_fetch_array($result2)) && $i<$rcount)
				 {
				 	
				 	?>

							<div class="col-sm-3 col-md-3 col-xs-12">
			
								<div class="panel panel-pricing">
									<header class="panel-heading">
										<h3><?php echo $row1["subs_name"] ?></h3>
										<div class="price bg-<?php echo $color[$i]; ?>">
											<sup>&#8377;</sup><?php echo  $row1["subs_cost"]; ?> <small>/ quarter</small>
										</div>
									</header>
									<div class="panel-body">
										<table class="table">
											<tbody>
												<tr><td>Total weight</td><td><?php echo $row1["subs_wt"]; ?> KG</td></tr>
												<tr><td>Total Pickup</td><td><?php echo $row1["subs_maxpickup"]; ?></td></tr>
												<tr><td>Monthly Discount</td><td><?php echo $row1["SubsDiscount_Monthly"]; ?> % </td></tr>
												<tr><td>Service Type</td><td><?php echo $row1["Subs_ServiceType"]; ?></td></tr>
												<tr><td>Garment Type</td><td><?php echo $row1["Subs_GarmentType"]; ?></td></tr>
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<a href="subscribenow.php?o=subscribe&s=<?php echo $row1["subs_id"];?>" class="btn btn-secondary">Subscribe Now</a>
									</div>
								</div>
			
							</div>
				<?php
	 				$i++;
					 }
					 }
					 ?>
			
						</div>
					</div>
				</div>

			</div>
			



		</div>
	</div>
	 
	
	

<?php include('footercta.php');?>
		 
<?php include('footer.php');?>