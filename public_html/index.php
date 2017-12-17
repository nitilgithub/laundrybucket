<?php include('header.php'); ?>
<title>laundry &  ironing services | Dry Cleaning Pickup Services  Noida</title>
<meta name="description" content="laundry Bucket offers Dry cleaning & Laundry services at doorstep in Noida and Ghaziabad, Laundry , ironing services in Noida with  Home pickup and delivery at indirapuram">

<link rel="publisher" href="https://plus.google.com" />
<meta name="keywords" content="dry cleaners in Greater Noida, wardrobe dry cleaners Noida, dry cleaners in Ghaziabad, fastest cleaners East Delhi"/>
<meta name="subject" content=" Dry Cleaning">
<meta name="copyright" content=" laundry bucket">
<meta name="robots" content="index, follow">
<meta name="revised" content="All" />
<meta name="author" content="Admin, info@nitsvits.click">
<meta property="og:url" content="/" />
<meta property="og:site_name" content="laundry bucket " />
<meta property="og:image" content="/assets/images/img-1959-copy491x213-160.png" />
<meta property="og:type" content="Local service" />
<link rel="canonical" href="/"/>
<meta name="google-site-verification" content="F9crcEJxT1gtrvRsdxcjBGuxj_MnBgpe1lk-PzQbX30" />
<?php
if(isset($_POST['laundrySearch']))
{
	$city=str_replace(' ', '-', $_POST['loc']);
	$location=str_replace(' ', '-', $_POST['place']);
	$service=str_replace(' ', '-', $_POST['service']);
	
	//$val=$service."-services-in-".$city."--".$location;
	//echo("<script>location.href = 'https://beta.laundrybucket.co.in/".$val."/';</script>");
	
	//echo("<script>location.href = 'enquiry.php?loc=".$city."&place=".$location."&service=".$service."';</script>");
	
	     
	//echo("<script>location.href = 'enquiry.php?loc=".$location."&place=".$city."&service=".$service."';</script>");
	
	echo("<script>location.href = '/".$service."-services-".$location."-in-".$city."';</script>");
}
?>
<style>
	#searchboxlayer{z-index:99;position:relative;top:-250px;padding:10px;background-color:rgba(0,0,0,.3);}
</style>
	<!-- BANNER -->
	<div id="slides" class="section banner">
		<ul class="slides-container">
			<li>
				<img src="img/slider1.jpg" alt="">
				<div class="overlay-bg"></div>
				<div class="container">
					<div class="wrap-caption center">
						<h2 class="caption-heading">
							011 39589786
						</h2>
						
				    	<br>
			
						<a href="contact.php" class="btn btn-primary" title="Get in Touch"><i class="fa fa-mobile"></i>&nbsp;Get in Touch</a>
					</div>
				</div>
			</li>
			<li>
				<img src="img/slider2.jpg" alt="">
				<div class="overlay-bg"></div>
				<div class="container">
					<div class="wrap-caption center">
						<h2 class="caption-heading">
							Laundry and Drycleaning Service
						</h2>
						
						<a href="about.php" class="btn btn-primary" title="LEARN MORE">Learn More</a> <a href="contact.php" class="btn btn-secondary" title="CONTACT US">Contact Us</a>
					</div>
				</div>
			</li>
			<li>
				<img src="img/slider3.jpg" alt="">
				<div class="overlay-bg"></div>
				<div class="container">
					<div class="wrap-caption center">
						<h2 class="caption-heading">
							Download Laundry Bucket Mobile App
						</h2>
						
						<a href="https://play.google.com/store/apps/details?id=com.laundrybucket.app" target="_blank" class="btn btn-primary" title="Get in Touch"><i class="fa fa-play"></i>&nbsp;Get in on Google Play</a>
					</div>
				</div>
			</li>
			<li>
				<img src="img/slider4.jpeg" alt="">
				<div class="overlay-bg"></div>
				<div class="container">
					<div class="wrap-caption center">
						<h2 class="caption-heading">
							011 39589786
						</h2>
						
						<a href="contact.php" class="btn btn-primary" title="Get in Touch"><i class="fa fa-phone"></i> &nbsp;Contact Us</a>
					</div>
				</div>
			</li>
			
		</ul>

		<nav class="slides-navigation">
			<div class="container">
				<a href="#" class="next">
					<i class="fa fa-chevron-right"></i>
				</a>
				<a href="#" class="prev">
					<i class="fa fa-chevron-left"></i>
				</a>
	      	</div>
	    </nav>
		
	</div>
	
	
	<!--search-->

	<section>
    <div class="col-md-8 col-md-offset-2 col-xs-12">
	<div id="searchboxlayer" align="center">
    	<form method="post" class="form-inline" action="">
    		
    		<div class="form-group" style="width:200px;">
    			
				<select class="form-control input-md" style="width:100%; height: 40px; padding: 5px;" id="city" name="loc" required="" onchange="getlocation(this.value)">
					<option value="">Select Your City</option>
							<?php 
							$res1=mysql_query("select * from tbl_city") or die(mysql_error());
							while($row1=mysql_fetch_array($res1))
							{
							?>
							<option value="<?php echo $row1['CityName'];?>"><?php echo $row1['CityName'];?></option>
							<?php
							}
							?>
				</select>
    		</div>&nbsp;&nbsp;
    		<div class="form-group" style="width:200px;">
    			
    			<select class="form-control input-md" style="width:100%; height: 40px; padding: 5px;" id="location" name="place" required="">
    				<option value="">Select your Location</option>
    			</select>
    		</div>&nbsp;&nbsp;
    		<div class="form-group" style="width:200px;">
    			
    			
    			<select class="form-control input-md" style="width:100%; height: 40px; padding: 5px;" id="service" name="service" required="">
    				<option value="">Select Service</option>
    				<option>Laundry</option>
    				<option>Wash and Iron</option>
    				<option>Wash and Fold</option>
    				<option>Ironing</option>
    				<option>Steam Ironing</option>
    				<option>Dry Cleaning</option>
    				<option>Sofa Cleaning</option>
    			</select>
    		</div>&nbsp;&nbsp;
    		<div class="form-group" style="width:100px;">
    			<input type="submit" style="width:100%;" name="laundrySearch" class="btn btn-info input-md" value="SEARCH" />
    		</div>
    	</form>
    	</div>
    </div>
    </section>
  

	<!-- SERVICES -->
	<div class="section wedo pad bglight">
		<div class="container">
			<div class="row gutter-wedo">
				
				<div class="col-sm-4 col-md-4">
					<!-- BOX 1 -->
					<div class="box-image-1">
		              <div class="media">
		                <img src="img/laundry.jpg" alt="" class="img-responsive">
		              </div>
		              <div class="body">
		               <a href="/laundry-service" class="title">Laundry Services</a>
		               <!-- <p>We also understand that the safety of your family comes first.</p>-->
		                <a href="/laundry-service" class="readmore">Read More</a>
		              </div>
		            </div>
				</div>
				<div class="col-sm-4 col-md-4">
					<!-- BOX 2 -->
					<div class="box-image-1">
		              <div class="media">
		                <img src="img/dryclean.jpg" alt="" class="img-responsive">
		              </div>
		              <div class="body">
		               <a href="/Mens-wear-drycleaning-service" class="title">Dry Cleaning Services</a>
		              <!--  <p>We also understand that the safety of your family comes first.</p>-->
		                <a href="/Mens-wear-drycleaning-service" class="readmore">Read More</a>
		              </div>
		            </div>
				</div>
				<div class="col-sm-4 col-md-4">
					<!-- BOX 3 -->
					<div class="box-image-1">
		              <div class="media">
		                <img src="images/service-3.jpg" alt="" class="img-responsive">
		              </div>
		              <div class="body">
		               <a href="/laundry-drycleaning-services" class="title">Special Services</a>
		               <!-- <p>We also understand that the safety of your family comes first.</p>-->
		                <a href="/laundry-drycleaning-services" class="readmore">Read More</a>
		              </div>
		            </div>
				</div>
				
			</div>

			
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="jumbo-heading">
						<h2>We only use Eco Friendly Material</h2>
					</div>
				</div>
				<div class="col-sm-9 col-md-9">
					<!--<p class="lead">LaundryBucket is a professional on-demand dry cleaning service. We provide you the best laundry and dry-cleaning services with affordable pricing.</p> 
					<p>We understand the pressure of a busy and high-powered life and hence provide services on your doorstep. Looking for urgent laundry? We can provide you in 24* hours, in an effort to match your busy schedule and the demands it necessarily entails.</p> 
-->
					<p class="lead">
						Laundry bucket is one of the premium on-demand laundry services in Delhi NCR. We understand life has become a mad rush. 
					</p>
					<p>
						People are struggling to maintain a work life balance and returning from a hectic day, household errands feels like a burden. You have the option of ordering food online or even do grocery shopping. Then why struggle so much with laundry?
					</p>
				</div>

			</div>

			<div class="category-services">
				<div class="row">
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-floor-cleaning"></div>
							</div>
							<div class="heading">
								Floor cleaning
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-window-cleaning"></div>
							</div>
							<div class="heading">
								Window cleaning
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-laundry"></div>
							</div>
							<div class="heading">
								Laundry
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-trash-treatment"></div>
							</div>
							<div class="heading">
								Trash treatment
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-extra-shiny"></div>
							</div>
							<div class="heading">
								Extra shiny
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-md-2">
						<div class="box-icon-1">
							<div class="icon">
								<div class="rsi rsi-cloth-ironing"></div>
							</div>
							<div class="heading">
								Cloth ironing
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	 
	<!-- PROCESS -->
	<div class="section pad">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 col-md-12">
					<h2 class="section-heading">
						Our Cleaning Process
					</h2>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-3 col-md-3">
					<div class="box-icon-2 process-arrow">
						<div class="icon">
							<div class="rsi rsi-phone"></div>
							<div class="number">1</div>
						</div>
						<div class="heading">
							Give us a Call
						</div>
						<!--<p>Phasellus ac tincidunt eros. Nulla egestas tristique turpis sit amet lobortis</p>-->
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="box-icon-2 process-arrow">
						<div class="icon">
							<div class="rsi rsi-calendar-1"></div>
							<div class="number">2</div>
						</div>
						<div class="heading">
							Schedule it
						</div>
						<!--<p>Phasellus ac tincidunt eros. Nulla egestas tristique turpis sit amet lobortis</p>-->
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="box-icon-2 process-arrow">
						<div class="icon">
							<div class="rsi rsi-laundry"></div>
							<div class="number">3</div>
						</div>
						<div class="heading">
							The Cleaning
						</div>
						<!--<p>Phasellus ac tincidunt eros. Nulla egestas tristique turpis sit amet lobortis</p>-->
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="box-icon-2">
						<div class="icon">
							<div class="rsi rsi-payment"></div>
							<div class="number">4</div>
						</div>
						<div class="heading">
							Easy Payment
						</div>
						<!--<p>Phasellus ac tincidunt eros. Nulla egestas tristique turpis sit amet lobortis</p>-->
					</div>
				</div>
				
			</div>
		</div>
	</div>
	 
	<!-- INFO -->
	<div class="section pad" style="padding-top: 10px;">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h3>WELCOME</h3>
					<!--<p class="lead">LaundryBucket is a professional on-demand dry cleaning service. We provide you the best laundry and dry-cleaning services with affordable pricing.</p>
					<p>We understand the pressure of a busy and high-powered life and hence provide services on your doorstep. Looking for urgent laundry? We can provide you in 24* hours, in an effort to match your busy schedule and the demands it necessarily entails. </p>
					<p>From traditional self-service cleaning options to convenient online ordering with pickup and drop-off services, we have got you covered! We do laundry and dry-cleaning of all types of garments and fabrics.</p>
					<p>We are here to make your life easier - we'll go to your home, condo, apartment, office, your boat to pick up and deliver your articles.</p>
					-->
					<p class="lead">
						Laundry bucket is one of the premium on-demand laundry services in Delhi NCR. We understand life has become a mad rush. 
					</p>
					<p>
						People are struggling to maintain a work life balance and returning from a hectic day, household errands feels like a burden. You have the option of ordering food online or even do grocery shopping. Then why struggle so much with laundry?
					</p>
					<p>
						Doing laundry can be a tedious task, right from gathering dirty clothes to washing them as per the fabric needs and then ironing them. Don’t depend on maids anymore. Visit laundry bucket for all your laundry and dry-cleaning needs.
					</p>
					<p>
						Our laundry service is top-notch because we take extra care of your fabric to ensure that your laundry comes clean unscathed. We identify fabric washing requirements and take care of colour separations and temperature requirements. 
					</p>
					<p>
						We are here to make your life easier. We provide you the best laundry and dry cleaning services at affordable prices. So, don’t just wait! Visit our website today for your laundry needs.
					</p>
					<div class="margin-bottom-50"></div>
					<a href="about.php" class="btn btn-primary" title="Learn More">Learn More</a>
				</div>
				
			</div>
			<div class="sideright-img">
				<iframe class="mbr-embedded-video" src="https://www.youtube.com/embed/VTHQEOpY2zY?rel=0" height="90%" width="100%"  frameborder="0" allowfullscreen></iframe>

			</div>
		</div>
	</div>
	 
	<!-- SERVICES -->
	<div class="section pad cta-bg-1">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 col-md-12">
					<h2 class="cta-title-1">Save your time</h2>
					<h2 class="cta-title-2">We make it easy</h2>
					<div class="margin-bottom-70"></div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-3 col-md-2">
					<div class="counter-1">
			            <div class="counter-number">
			             HIGH QUALITY SERVICES
			            </div>
			            <div class="counter-title">Laundry services coupled with customised experience</div>
		          	</div>
				</div>
				<div class="col-sm-3 col-md-2">
					<div class="counter-1">
			            <div class="counter-number">
			              CUTTING EDGE TECHNOLOGY
			            </div>
			            <div class="counter-title">Latest technology machines and internationally standardized chemicals</div>
		          	</div>
				</div>
				<div class="col-sm-3 col-md-2">
					<div class="counter-1">
			            <div class="counter-number">
			              ORDER &amp; PICK UP
			            </div>
			            <div class="counter-title">Free pick up and delivery within 24 hours under express service</div>
		          	</div>
				</div>
				<div class="col-sm-3 col-md-2">
					<div class="counter-1">
			            <div class="counter-number">
			              SAFETY OF CLOTHES
			            </div>
			            <div class="counter-title">Expert Staff with in depth knowledge of fabric &amp; garments</div>
		          	</div>
				</div>

			</div>
		</div>
	</div>
	
	<!-- TESTIMONIALS --> 
	<div class="section testimony">
		<div class="container">
			
			<div class="row servicehome">
				
						<div class="col-sm-3 col-md-3">
							<div class="counter-1">
								<img src="img/deliver1.png" class="img-circle" />
					            <div class="counter-number1">
					              FREE PICKUP &amp; DELIVERY
					            </div>
					            <div class="">Free pick-up and delivery at your doorsteps so that you can enjoy hassle-free laundry services.</div>
				          	</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="counter-1">
								<img src="img/deliver2.png" class="img-circle" />
					            <div class="counter-number1">
					              CUSTOM PACKAGING
					            </div>
					            <div class="">Each garment is returned to you individually packaged to protect against dust, light and mildew.</div>
				          	</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="counter-1">
								<img src="img/deliver3.png" class="img-circle" />
					            <div class="counter-number1">
					              24HR DELIVERY*
					            </div>
					            <div class="">We ensure that you get your garments laundered within committed time.</div>
				          	</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="counter-1">
								<img src="img/deliver4.png" class="img-circle" />
					            <div class="counter-number1">
					              AFFORDABLE
					            </div>
					            <div class="">LaundryBucket is a quick, efficient and cost effective way to get your laundry done.</div>
				          	</div>
						</div>
					

			</div>
		</div>
	</div>
	
	<!-- TESTIMONIALS --> 
	<!--<div class="section testimony">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-12 col-md-12">

					<div class="row">
						<div class="col-sm-12 col-md-12">
							<h2 class="section-heading">
								What People Says
							</h2>
						</div>
					</div>

					<div id="owl-testimony">
						<div class="item">
							<div class="testimonial-1">
				              <div class="media"><img src="images/testimony-thumb-1.jpg" alt="" class="img-responsive"></div>
				              <div class="body">
				                <div class="title">Paul Juwaal</div>
				                <div class="company">Gasman ltd</div>
				                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry orem Ipsum has been. Mauris ornare tortor in eleifend blanditullam ut ligula et neque. Nulla interdum dapibus erat nec elementum. </p>
				              </div>
				            </div>
						</div>
						<div class="item">
				            <div class="testimonial-1">
				              <div class="media"><img src="images/testimony-thumb-2.jpg" alt="" class="img-responsive"></div>
				              <div class="body">
				                <div class="title">Debora Deandra</div>
				                <div class="company">Abc ltd</div>
				                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry orem Ipsum has been. Mauris ornare tortor in eleifend blanditullam ut ligula et neque. Nulla interdum dapibus erat nec elementum. </p>
				              </div>
				            </div>
						</div>
						<div class="item">
				            <div class="testimonial-1">
				              <div class="media"><img src="images/testimony-thumb-3.jpg" alt="" class="img-responsive"></div>
				              <div class="body">
				                <div class="title">Steve Nuer</div>
				                <div class="company">Manufacture ltd</div>
				                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry orem Ipsum has been. Mauris ornare tortor in eleifend blanditullam ut ligula et neque. Nulla interdum dapibus erat nec elementum. </p>
				              </div>
				            </div>
						</div>
						<div class="item">
				            <div class="testimonial-1">
				              <div class="media"><img src="images/testimony-thumb-4.jpg" alt="" class="img-responsive"></div>
				              <div class="body">
				                <div class="title">Robert Lav</div>
				                <div class="company">Gaspol ltd</div>
				                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry orem Ipsum has been. Mauris ornare tortor in eleifend blanditullam ut ligula et neque. Nulla interdum dapibus erat nec elementum. </p>
				              </div>
				            </div>
						</div>
						
						
					</div>
					
				</div>

			</div>
		</div>
	</div>-->
	
	<!-- PARTNERS -->
	<!--<div class="section partner bglight">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-3 col-md-3">
					<div class="client-img">
						<a href="#"><img src="images/partners-1.png" alt="" class="img-responsive"></a>
					</div>
				</div>

				<div class="col-sm-3 col-md-3">
					<div class="client-img">
						<a href="#"><img src="images/partners-2.png" alt="" class="img-responsive"></a>
					</div>
				</div>

				<div class="col-sm-3 col-md-3">
					<div class="client-img">
						<a href="#"><img src="images/partners-3.png" alt="" class="img-responsive"></a>
					</div>
				</div>

				<div class="col-sm-3 col-md-3">
					<div class="client-img">
						<a href="#"><img src="images/partners-4.png" alt="" class="img-responsive"></a>
					</div>
				</div>

				
			</div>
		</div>
	</div>-->

	<!-- CONTACT -->
	<div class="section contact pad">
		<div class="container">
			
			<div class="col-sm-12 col-md-12">
				<h2 class="section-heading white">
					Get In Touch
				</h2>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-6 col-md-6">
				<div class="contact-info">
					<p>We are determined to carry on our mission for as long as there will be a demand for that kind of care!</p>
					<div class="contactstrip col-xs-12">
					<h4>ORDER</h4>
					<p><a>bucket@laundrybucket.co.in</a></p>
					<p><i class="fa fa-phone"></i> +91 97 18 66 11 77 , 011 39589786</p>
					</div>
					&nbsp;
					<!--<h4>CONTACT</h4>
					<p><a href="#">admin@laundrybucket.co.in</a>&nbsp;&nbsp;<i class="fa fa-phone"></i>+91 97 18 66 11 77, 011 39589786</p>-->
					<div class="contactstrip col-xs-12">
					<h4>HELP/COMPLAINT</h4>
					<p><a>help@laundrybucket.co.in</a>, <a>admin@laundrybucket.co.in</a></p>
					<p><i class="fa fa-phone"></i> +91 97 18 66 11 77</p>
					</div>
					<!--<h4>COMPLAINT</h4>
					<p><a href="#">admin@laundrybucket.co.in</a>&nbsp;&nbsp;<i class="fa fa-phone"></i> +91 97 18 66 11 77</p>-->
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<form  class="form-contact" id="frmcontactenquiry" >
					<div class="form-group">
						<input type="text" class="form-control text-capitalize" name="name" id="name" placeholder="Full Name..." required="" pattern=".{3, }" title="Username should only contain letters having minimum length 3 character. e.g. John">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email..." required="">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="phone" id="phone" pattern="[7-9]{1}[0-9]{9}" title="Enter Valid mobile no" placeholder="Contact..." required="">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<select class="form-control" name="enqtype"  placeholder="Select Enquiry Type..." required="">
							<option value="-1" > Select Enquiry Type </option>
						 	<option value="General" > General Enquiry </option>
						 	<option value="Feedback" > Feedback Enquiry </option>
						 	<option value="Complaint" > Complaint Enquiry </option>
						 	<option value="Business" > Business Enquiry </option>
						 	<option value="Other"  > Other </option>
						</select>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						 <textarea name="message" id="message"  class="form-control" rows="6" placeholder="Write message"></textarea>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<div id="success"></div>
						<button type="button" class="btn btn-primary" id="btnsendcontact" title="Click here to submit your message!">SEND YOUR MESSAGE</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!-- MAPS -->
	<!--<div class="maps-wraper">
		<div id="cd-zoom-in"></div>
		<div id="cd-zoom-out"></div>
		<div id="maps" class="maps" data-lat="-7.452278" data-lng="112.708992" data-marker="images/cd-icon-location.png">
		</div>
	</div>-->
	 
<?php include('footer.php');
?>