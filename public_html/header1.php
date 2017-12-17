<?php
@ob_start();
@session_start();
include 'connection.php';
//$uloginid=$_SESSION["uloginid"];
$uid=mysql_real_escape_string($_SESSION["uid"]);
include 'Mobile_Detect.php';
?>
<?php 
 $detect = new Mobile_Detect(); 
 
 ?>
<!DOCTYPE html>
<html>
<head>
  <!-- Laundry service and ironing services  -->
  <meta charset="UTF-8">
  <meta https-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v2.5.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  
  <title>Free laundry and Dry cleaning Pick Up services In Vaishali, Ghazibad</title>
  <meta name="description" content="Best dry cleaning and laundry service in Ghaziabad, we offer dry cleaning pickup service in Vaishali and Indirapuram, order now at low cost">

  <meta name="google-site-verification" content="F9crcEJxT1gtrvRsdxcjBGuxj_MnBgpe1lk-PzQbX30" />
  <meta name="google-site-verification" content="2fnTq1r8HFPdv-wO9kbHO3dHY5z6ote-UUffL_73628" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <script src="assets/jquery/jquery.min.js"></script>
  
  <link href="assets/bootstrap-timepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="assets/jquery_validation.min.js"></script>
   <script src="assets/formvalidation.js"></script>
  <link rel="stylesheet" href="assets/mobirise/css/style.css">
  <link rel="stylesheet" href="assets/mobirise-slider/style.css">
 <link rel="stylesheet" href="assets/mystyle.css">
 <link rel="stylesheet" href="assets/ihover.css">
 <link rel="stylesheet" href="assets/floating-labels.css">
 <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <script>
  $(document).ready(function() {
    var $window = $(window);

        // Function to handle changes to style classes based on window width
        function checkWidth() {
        if ($window.width() < 991) {
            $('#moblist').removeClass('dropdown').addClass('dropup');
            
            
            $(".contactbtn").click(function () 
            {
            $(".hidemobilediv").show();
        });
            
            };
 if ($window.width() >= 991) {
            $('#moblist').removeClass('dropup').addClass('dropdown');
        }
      
    }

    // Execute on load
    checkWidth();

    // Bind event listener
        $(window).resize(checkWidth);
});
 
  </script>
  
   <style>
  /* 
   @media (max-width: 991px) 
   {
   	
   }*/
   
  #profiletab:hover, #profiletab:focus, #profiletab.focus
  {
  	color:black;
  	
  }
  
  .profilemenu > li > a:hover, .dropdown-menu > li > a:focus {
    text-decoration: none;
    color: #262626;
    background-color: #5BC0DE;
   }
  </style>
            <script src="assets/floating-labels.js"></script>    
  <script>
  /*
$(document).ready(function(){
	
	//$("#txtemail").hide();
    $("#txtmobile").hide();
    
    
    $("#login").click(function(){
        $("#myModal").modal();
    });
    
});


$(document).on("click","#email",function()
{
	$("#txtmobile").hide('slow');
	$("#txtemail").show('slow');
});

$(document).on("click","#mobile",function()
{
	$("#txtmobile").show('slow');
	$("#txtemail").hide('slow');	
});

*/
</script>

<script>
		$(document).ready(function()
		{
	
	$(".highlight1").hide();
			$(".shw").hover(function()
			{
				
				//$(".highlight1").slideToggle("slow");
				$(".highlight1").slideToggle("slow");
				
			});
	
		});
	
	</script>
	
</head>
<body>
<section class="engine"><a rel="nofollow" href="https://laundrybucket.co.in">Welcome to Laundry Bucket</a></section>
<section class="mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--auto-collapse" id="ext_menu-1">
    <div class="mbr-navbar__section mbr-section">
        <div class="mbr-section__container container">
            <div class="mbr-navbar__container">
                <div class="mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand">
                    <span class="mbr-navbar__brand-link mbr-brand mbr-brand--inline">
                        <a class="mbr-brand__logo" href="https://laundrybucket.co.in"><img class="mbr-navbar__brand-img mbr-brand__img" alt="" src="assets/images/img-1959-copy491x213-160.png"></a>
                        <span class="mbr-brand__name"><a class="mbr-brand__name text-white" href="https://laundrybucket.co.in">Laundry Bucket</a></span>
                    </span>
                </div>
                <div class="mbr-navbar__hamburger mbr-hamburger text-black"><span class="mbr-hamburger__line"></span></div>
                <div class="mbr-navbar__column mbr-navbar__menu">
                    <nav class="mbr-navbar__menu-box mbr-navbar__menu-box--inline-right">
                        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active mbr-buttons--only-links">
                        	<li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="https://www.laundrybucket.co.in/">HOME</a></li>
                        	<!--<li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="about.php">ABOUT</a></li>-->
                        	<li class="mbr-navbar__item" id="hidemobileli"><a class="mbr-buttons__link btn text-black" href="https://laundrybucket.co.in/blog">BLOGS</a></li>  
               <li class="mbr-navbar__item">         
                       
			 <a class="mbr-buttons__link btn text-black" href="https://www.laundrybucket.co.in/drycleaning.php?cat=Men"> DRYCLEANING </a>
					                         
                       </li>
                        
                          <li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="https://www.laundrybucket.co.in/laundry-service"> LAUNDRY </a></li>
                          <li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="https://www.laundrybucket.co.in/deliverytypes.php">DELIVERY TYPE </a></li>	
                           <li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="https://www.laundrybucket.co.in/ordernow.php">ORDER NOW </a></li>
                                 
                                <?php
                                if(isset($_SESSION['userloginstatus']))
								{
									$result=mysql_query("select * from tblusers where UserId='$uid'") or die(mysql_error());
if(mysql_affected_rows())
{
	$row=mysql_fetch_array($result);
	$usfname=$row["UserFirstName"];
									?>	
									
										
                        		
                        		<li class="mbr-navbar__item dropdown keep-open" id="moblist">
                        			<button class="mbr-buttons__link btn text-black dropdown-toggle" id="profiletab" data-toggle="dropdown" href="javascript:void(0)"> 
                        			Hi <?php echo $usfname; ?> <b class="caret"></b></button>
                        			<ul class="dropdown-menu profilemenu atext" aria-labelledby="dLabel">
                        		
                        		<li style="margin-top:5px"><a href="https://www.laundrybucket.co.in/userlogout.php"> <p>Logout</p>  </a></li>
                        		<li style="margin-top:5px"><a href="#"> <p>Change Password </p></a></li>
                        			
                        		<li style="margin-top:5px"><a href="https://www.laundrybucket.co.in/usersubscription.php?ref=current"> <p> My Subscription </p></a></li>
                        		
         		                 	<li style="margin-top:5px"><a href="https://www.laundrybucket.co.in/userorderhistory.php"> <p> My Order History </p></a></li>
         			
									         			
         							</ul>
                        			
                        			</li>
                        		
                        		<?php
								}
								}
								else
									{
                        		?>
									<li class="mbr-navbar__item">
                        		
                        		<!--<a class="mbr-buttons__link btn text-black" href="#"  id="logn"> LOGIN  </a> useremail.php --> 
                        		<!--a class="mbr-buttons__link btn text-black" href="useremail.php"  id="logn"> LOGIN  </a> -->
                              <a class="mbr-buttons__link btn text-black" href="login.php"  id="logn"> LOGIN  </a>
                        		</li>
                        		<?php
									}
                        		?>
                        	
                        	
                        	   <!--<li class="mbr-navbar__item"><a class="mbr-buttons__link btn text-black" href="index.php#contactus11">Contact Us </a></li>-->
                        	
  
                        	<!--<li class="mbr-navbar__item"><a class="btn btn-primary" href="cart.php">My Bucket</a></li>-->
                        	 </ul></div>
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
