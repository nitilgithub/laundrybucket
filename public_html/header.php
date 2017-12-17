<?php
session_start();
 include('connection.php');
 $uid=mysql_real_escape_string($_SESSION["uid"]);
?>
<!DOCTYPE html>
<html lang="en">
  

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-98426618-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-98426618-1');
</script>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
	
	 
	<!-- ==============================================
	Favicons
	=============================================== -->
	<link rel="shortcut icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
	<!-- ==============================================
	CSS VENDOR
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="css/vendor/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/vendor/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/vendor/simple-line-icons.css">
	<link rel="stylesheet" type="text/css" href="css/vendor/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="css/vendor/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="css/vendor/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
	
	
	<!-- ==============================================
	Custom Stylesheet
	=============================================== -->
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
    <script type="text/javascript" src="js/vendor/modernizr.min.js"></script>
	
</head>

<body>

	<!-- Load page -->
	<div class="animationload">
		<div class="loader"></div>
	</div>
	
	<!-- HEADER -->
    <div class="header">
    	<!-- TOPBAR -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-md-5">
						<div class="topbar-left">
							<div class="welcome-text">
							24/7 Support Service
							</div>
						</div>
					</div>
					<div class="col-sm-9 col-md-7">
						<div class="topbar-right">
							<ul class="topbar-menu">
								<li><i class="icon-phone icons"></i> Call Us Today +91 011 39589786</li>
								<li><i class="icon-location-pin icons"></i> Noida</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- NAVBAR SECTION -->
		<div class="navbar navbar-main">
		
			<div class="container container-nav">
						
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<a class="navbar-brand" href="index.php">
						<img src="img/logo.png" alt="Laundry Bucket" />
					</a>
				</div>


				<nav class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li> <a href="index.php">Home</a> </li> 
						<li> <a href="about.php">About</a> </li> 
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="https://www.laundrybucket.co.in/laundry-service">Laundry</a></li>
							<li><a href="https://www.laundrybucket.co.in/Mens-wear-drycleaning-service">Dry Clean</a></li>
							
							<li><a href="https://www.laundrybucket.co.in/laundry-drycleaning-services">Service Detail</a></li>
							<li><a href="package.php">Laundry Packages</a></li>
						  </ul>
						</li>
						<li> <a href="ordernow.php">Order Now</a> </li> 
						<li> <a href="offers.php">Offers</a> </li> 
						<!--<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="news-grid.html">Grid Bar</a></li>
							<li><a href="news-sidebar.html">Sidebar</a></li>
							<li><a href="news-detail.html">Single News</a></li>
						  </ul>
						</li>-->
						<li> <a href="contact.php">Contact Us</a> </li> 
						<?php
                        if(isset($_SESSION['userloginstatus']))
						{
							
						$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
						if(mysql_affected_rows())
						{
							$row=mysql_fetch_array($result);
							$usfname=$row["UserFirstName"];
						?>	
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						  	Hi <?php echo $usfname; ?><span class="caret"></span></a>
						  <ul class="dropdown-menu">
						  	<li><a href="userorderhistory.php">Dashboard</a></li>
							<li><a href="userlogout.php">Logout</a></li>
							
						  </ul>
						</li>
						<?php
						}
						}
						else {
						?>
						<li> <a href="login.php">Login</a> </li> 
						<?php	
						}
						?>
						
					</ul>

				</nav>
						
			</div>
	    </div>

	    <div class="container">
		    <div class="bookmenu">
		    	<a href="ordernow.php"><i class="icons icon-calendar"></i></a>
		    </div>
	    </div>

    </div>
 