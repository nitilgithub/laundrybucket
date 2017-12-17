<?php include('header.php'); ?>
	<!-- BANNER -->
	<title> Contact For Best laundry service & Laundry pickup service</title> 
	<div class="section banner-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="title-page">Contact</div>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">Contact</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ABOUT FEATURE -->
	<div class="section pad">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-4 col-md-4">

					<div class="widget">
						<h4 class="lead">Feel free to leave us a message using the contact form and we will get back to you within 24 hours.</h4>
					</div>
					<div class="widget contact-info-sidebar">
						<div class="widget-title">
							Contact Info
						</div>
						<ul class="list-info">
							<li>
								<div class="info-icon">
									<span class="fa fa-map-marker"></span>
								</div>
								<div class="info-text">Ghaziabad, Noida, Greater Noida, East Delhi</div> </li>
							<li>
								<div class="info-icon">
									<span class="fa fa-phone"></span>
								</div>
								<div class="info-text">+91 9718661177 , 011 39589786</div>
							</li>
							<li>
								<div class="info-icon">
									<span class="fa fa-envelope"></span>
								</div>
								<div class="info-text">admin@laundrybucket.co.in, bucket@laundrybucket.co.in</div>
							</li>
							<li>
								<div class="info-icon">
									<span class="fa fa-clock-o"></span>
								</div>
								<div class="info-text">Mon - Sun 09:00 - 22:00</div>
							</li>
						</ul>
					</div> 

				</div>
				<div class="col-sm-8 col-md-8">
					
					<div class="free-quote">
						<h2 class="section-heading-2 color_white">
							Contact Us
						</h2>
						
						<form class="form-contact" id="frmcontactenquiry1" >
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
								<button type="button" class="btn btn-primary" id="btnsendcontact1" title="Click here to submit your message!">SEND YOUR MESSAGE</button>
							</div>
						</form>
					</div>

				</div>

			</div>

		</div>
	</div>

	<!-- MAPS -->
	<div class="maps-wraper">
		<div id="cd-zoom-in"></div>
		<div id="cd-zoom-out"></div>
		<div id="maps" class="maps" data-lat="28.5666817" data-lng="77.4580429" zoom="15" data-marker="images/cd-icon-location.png">
		</div>
	</div>

  
<?php include('footercta.php'); ?>
		 
<?php include('footer.php'); ?>