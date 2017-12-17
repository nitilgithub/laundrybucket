<?php include('header.php');

if(isset($_GET["cat"]))
{
	$wearcat=mysql_real_escape_string($_GET["cat"]);
}
else
{
  $wearcat="Men";
}
 ?>     
<title>Men's Wear Drycleaning Services, Prices in Noida, Ghaziabad</title>
<meta name="description" content="Best dry cleaning and laundry service rates , list here the rate of ironing and laundry cleaning service rates in noida Ghaziabad  "> 
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Dryclean</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Dryclean</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad" style="padding-top: 10px;">
		<div class="container">
			
			<div class="row" id="dryclean">
				
					<h2 class="section-heading" style="padding-bottom: 10px;">
						<?php echo $wearcat; ?>'s Wear Drycleaning Prices (Inclusive of GST)
						
					</h2>
					<p style="text-align: justify;">Our dry cleaning service is capable of Low-Moisture Encapsulation Technology. It takes soil and converts it to crystallized polymers, making removal easy using deep brush agitation. There is no sticky residue and our dry cleaning agents are pet and people safe. Apart from your daily garments, our cleaning services include upholstery, carpet, leather, mattress, rugs, floor and pet odour treatments. We provide high quality dry cleaning services to every customer. We don’t just dry clean, we restore your garments as well. Laundry bucket is known to be an effective, efficient and proven solution for those who have no time for doing these tasks themselves.</p>
				
				<ul class="nav nav-tabs">
				  <li class="<?php if(isset($_GET['wl'])|| isset($_GET['hl'])){ } else { echo 'active'; }?> tab"><a  href="https://www.laundrybucket.co.in/Mens-wear-drycleaning-service">Men's Wear Rate List</a></li>
				  <li class="<?php if(isset($_GET['wl'])){ echo 'active';}?> tab"><a  href="https://www.laundrybucket.co.in/Women&wls-wear-drycleaning-service">Women's Wear Rate List</a></li>
				  <li class="<?php if(isset($_GET['hl'])){ echo 'active';} ?> tab"><a  href="https://www.laundrybucket.co.in/HouseHold&hls-wear-drycleaning-service">HouseHold Rate List</a></li>
				</ul>
				<br>
				<div class="tab-content">
					
				  <div  class="tab-pane fade in active">
				    <div class="row">
	<?php

	$result=mysql_query("select i.ItemName,i.StandardRate,i.PremiumRate,i.item_img from tbl_services_itemsprice as i join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId join tbl_services as s on s.ServiceId=i.ServiceId where c.ServiceCatName='$wearcat' and s.ServiceName='Dryclean'") or die(mysql_error());
	
	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			?>
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="https://cdn.laundrybucket.co.in/images/<?php echo $row['item_img'];?>" alt="<?php echo $row['ItemName']; ?>" />
				    			</div>
				    			<div class="itemdetail">
					    			<span><?php echo $row['ItemName']; ?></span><br>
					    			<span>&#8377; <?php echo $row['StandardRate'];?></span>
				    			</div>
				    		</div>
				    	</div>
		<?php } } ?>  	
				    	<!--<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="https://cdn.laundrybucket.co.in/images/<?php echo $row['item_img'];?>" />
				    			</div>
				    			<div class="itemdetail">
					    			<span><?php echo $row['ItemName']; ?></span><br>
					    			<span>&#8377; <?php echo $row['StandardRate'];?></span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-men-trouser.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Trouser</span><br>
					    			<span>₹ 70.00</span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-men-denim.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Denim</span><br>
					    			<span>₹ 80.00</span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-men-jeans.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Jeans</span><br>
					    			<span>₹ 80.00</span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-silk-men-shirt.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Silk Shirt</span><br>
					    			<span>₹ 90.00</span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-men-kurta.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Kurta</span><br>
					    			<span>₹ 70.00</span>
				    			</div>
				    		</div>
				    	</div>
				    	
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="img/dryclean/men/laundry-bucket-men-kurta-pajama.jpg" />
				    			</div>
				    			<div class="itemdetail">
					    			<span>Pajama</span><br>
					    			<span>₹ 70.00</span>
				    			</div>
				    		</div>
				    	</div>-->
				    	
				    	
				    	
				    	
				    </div>
				  </div>
				  
				  
				  
				  <!--<div id="women" class="tab-pane fade">
				    
				    <div class="row">
				    	<?php

	$result=mysql_query("select i.ItemName,i.StandardRate,i.PremiumRate,i.item_img from tbl_services_itemsprice as i join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId join tbl_services as s on s.ServiceId=i.ServiceId where c.ServiceCatName='Women' and s.ServiceName='Dryclean'") or die(mysql_error());
	
	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			?>
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="https://cdn.laundrybucket.co.in/images/<?php echo $row['item_img'];?>" alt="<?php echo $row['ItemName']; ?>" />
				    			</div>
				    			<div class="itemdetail">
					    			<span><?php echo $row['ItemName']; ?></span><br>
					    			<span>&#8377; <?php echo $row['StandardRate'];?></span>
				    			</div>
				    		</div>
				    	</div>
		<?php } } ?>  
				    	
				    	
				    	
				    	
				    	
				    </div>
				  </div>
				  
				  
				  
				  <div id="household" class="tab-pane fade">
				    
				    <div class="row">
				    	<?php

	$result=mysql_query("select i.ItemName,i.StandardRate,i.PremiumRate,i.item_img from tbl_services_itemsprice as i join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId join tbl_services as s on s.ServiceId=i.ServiceId where c.ServiceCatName='HouseHold' and s.ServiceName='Dryclean'") or die(mysql_error());
	
	if(mysql_affected_rows())
	{
		while($row=mysql_fetch_array($result))
		{
			?>
				    	<div class="col-md-2 col-sm-3 col-xs-6">
				    		<div class="col-md-12 col-sm-12 col-xs-12 drycleanlist">
				    			<div>
				    				<img src="https://cdn.laundrybucket.co.in/images/<?php echo $row['item_img'];?>" alt="<?php echo $row['ItemName']; ?>" />
				    			</div>
				    			<div class="itemdetail">
					    			<span><?php echo $row['ItemName']; ?></span><br>
					    			<span>&#8377; <?php echo $row['StandardRate'];?></span>
				    			</div>
				    		</div>
				    	</div>
		<?php } } ?>  
				    	
				    	
				    </div>
			</div>-->
				  
				</div>
			</div>
			
		</div>
	</div>

<?php include('footercta.php');?>
		 
<?php include('footer.php'); ?>
