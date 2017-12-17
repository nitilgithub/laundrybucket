<?php include('header.php'); ?>
<title>Best laundry service & Laundry pickup service in Indirapuram </title>
<meta name="description" content="Best dry cleaning and laundry service in Indirapuram, we offer laundry pickup service in Vaishali and Indirapuram, at low cost">
<link rel="canonical" href="/laundry-drycleaning-services"/>
	<!-- BANNER -->
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Services</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Services</li>
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
							<h4 class="section-heading" style="padding-bottom: 5px;">Laundry Bucket- Services</h4>
							<p style="text-align: justify;">
								At laundry bucket you can enjoy gamut of services at affordable prices. Whether its domestic laundry or commercial laundry, dry cleaning, steam ironing or deep cleaning of your homes, you can find everything with us without worrying about the prices and turnaround time. Our express delivery service is perfect for last minute situations.
							</p>
							<p style="text-align: justify;">
								Laundry bucket is a perfect solution to maintain cleanliness in home, office or just any place you use. We understand the importance of cleanliness in your lives and work. Don’t bother yourself by cleaning your office or home space; you can always rely on us for all your cleaning needs. We provide professional cleaning services for both, homes and commercial establishments.  Our services include: 
							</p>
						</div>
					</div>
					&nbsp;
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="services-detail.html" class="title">Dry Clean</a></h3>
				                <p>Our dry cleaning process involves cleaning of clothes or any kind of textile with the help of fabric friendly solvent other than water. Our services are best for garments that can be degraded with normal washing procedures. By using high quality products, we ensure to maintain the colour and life of your expensive garments.</p>
<?php
$result=mysql_query("select min(i.StandardRate) StandardRate from tbl_services as s join tbl_services_itemsprice as i on i.ServiceId=s.ServiceId  where s.ServiceId in (select ServiceId from tbl_services where ServiceName like '%dryclean%')");
while($row=mysql_fetch_array($result))
{
	echo "	<a class='readmore'>Start From ".$row[0]."/-</a>";
}
?>	
				               <!-- <a class="readmore">Start From 22.00/- </a>-->
			              	</div>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_dryclean.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
					</div>
				</div>
				<div class="box-service-item">
					<div class="row">
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_iron.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="services-detail.html" class="title">Steam Ironing</a></h3>
				                <p>How irritating it can be, when you are late for a meeting and your favourite suit or sari has a crumpled crease. There is nothing more embarrassing than wearing a wrinkled garment in front of your colleagues or clients. Use our steam ironing service and get your daily and occasional garments wrinkle free. Our steam irons are capable enough to handle all kinds of garments as well as have the option of dry ironing. </p>
				                <a class="readmore">Start From 30 Rs/pc</a>
			              	</div>
						</div>
					</div>
				</div>
				<div class="box-service-item">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="services-detail.html" class="title">Wash &amp; Fold</a></h3>
				                <p> Our wash and fold service can help you save big time on your monthly home laundry expenses. Our service is convenient and handled by professionals, who are expert in washing and folding all kinds of fabrics and textiles. So, why waste time on these household chores when you have professional wash and fold service at your disposal. </p>
<?php
$result=mysql_query("select min(i.StandardRate) StandardRate from tbl_services as s join tbl_services_itemsprice as i on i.ServiceId=s.ServiceId join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId where c.ServiceCatId in (select ServiceCatId from tbl_services_category where ServiceCatName like '%WASH&fold%')");
while($row=mysql_fetch_array($result))
{
	echo "	<a class='readmore'>".$row[0]." Rs/Kg</a>";
}
?>				                
				                <!--<a class="readmore">60.00 Rs/Kg</a>-->
			              	</div>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_machine.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
					</div>
				</div>
				<div class="box-service-item">
					<div class="row">
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_hh.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="services-detail.html" class="title">House Hold</a></h3>
				                <p>Our household cleaning services ensure complete cleanliness of your house and cars. Don’t spend your precious hours in cleaning your home or office. Rather hire a professional service like us and leave all your cleaning worries with us. Laundry bucket is a specialist in providing household laundry services at affordable prices.</p>
<?php
$result=mysql_query("select min(i.StandardRate) StandardRate from tbl_services as s join tbl_services_itemsprice as i on i.ServiceId=s.ServiceId join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId where c.ServiceCatId in (select ServiceCatId from tbl_services_category where ServiceCatName like '%household%')");
while($row=mysql_fetch_array($result))
{
	echo "	<a class='readmore'>Start From ".$row[0]." /-</a>";
}
?>				                
				                <!--<a class="readmore">Start From 22.00 /-</a>-->
			              	</div>
						</div>
					</div>
				</div>
				<div class="box-service-item">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<div class="body">
				                <h3><a href="services-detail.html" class="title">Wash &amp; Iron</a></h3>
				                <p> Use our wash and iron service and get your clothes, washed, dried, ironed and ready to wear form. Why spend extra hours and money on these tasks. Instead hire laundry bucket to handle all your cleaning problems for you. Also make big monthly savings on your laundry bills by using our professional wash and iron service.</p>
<?php
$result=mysql_query("select min(i.StandardRate) StandardRate from tbl_services as s join tbl_services_itemsprice as i on i.ServiceId=s.ServiceId join tbl_services_category as c on c.ServiceCatId=i.ServiceCatId where c.ServiceCatId in (select ServiceCatId from tbl_services_category where ServiceCatName like '%WASH&IRON%')");
while($row=mysql_fetch_array($result))
{
	echo "	<a class='readmore'>".$row[0]." Rs/Kg</a>";
}
?>				             
				               <!-- <a class="readmore">60.00 Rs/Kg</a>-->
			              	</div>
						</div>
						<div class="col-sm-8 col-md-8">
							<div class="media">
				                <img src="img/laundry_iron1.jpg" alt="rud" class="img-responsive">
			              	</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>

<?php include('footercta.php');?>
		 
<?php include('footer.php'); ?>
