	<!-- FOOTER SECTION -->
	
	<div class="footer" >
		
		<div class="container" >
			
			<div class="row" >
				<div class="col-sm-5 col-md-5">
					<div class="footer-item">
						<img src="img/logo.png" alt="logo bottom" class="logo-bottom" >
						<!--<p>This template is a micro niche for business categories, namely Super Clean - Cleaning Services HTML Template. there was an excess of this template is using HTML/CSS.</p>-->
						<div class="footer-sosmed">
							<!--<a href="#" title="">
								<div class="item">
									<i class="fa fa-facebook"></i>
								</div>
							</a>
							<a href="#" title="">
								<div class="item">
									<i class="fa fa-twitter"></i>
								</div>
							</a>
							<a href="#" title="">
								<div class="item">
									<i class="fa fa-instagram"></i>
								</div>
							</a>
							<a href="#" title="">
								<div class="item">
									<i class="fa fa-pinterest"></i>
								</div>
							</a> -->
							<div class="col-md-6 col-xs-6">
							<a href="https://play.google.com/store/apps/details?id=com.laundrybucket.app" title="" target="_blank">
								
									<img src="images/googleplay.png" style="height: 35px !important;" />
									
								
							</a>
							</div>
							<div class="col-md-6 col-xs-6">
							<a href="https://itunes.apple.com/in/app/laundry-bucket/id1265429011?mt=8" title="" target="_blank">
								
									<img src="images/appstore.png" style="height: 35px !important;" />
								
							</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-md-offset-1">
					<div class="footer-item">
						<div class="footer-title">
							Extra Links
						</div>
						<ul class="list">
							<li><a href="index.php" title="">Home</a></li>
							<li><a href="contact.php" title="">Contact</a></li>
							<!--<li><a href="faq.html" title="">Blog</a></li>-->
							<li><a href="terms.php" title="">Terms &amp; Conditions</a></li>
							<li><a href="https://www.laundrybucket.co.in/sitemap.html" title="">Site Map</a></li>
							<li><a href="privacypolicy.php" title="">Privacy Policy</a></li>
							<li><a href="refundpolicy.php" title="">Cancellation &amp; Refund Policy</a></li>
							
							
						</ul>
					</div>
				</div>
				<!--<div class="col-sm-4 col-md-4">
					<div class="footer-item">
						<div class="footer-title">
							Subscribe
						</div>
						<p>Lit sed The Best in dolor sit amet consectetur adipisicing elit sedconsectetur adipisicing</p>
						<form action="#" class="footer-subscribe">
			              <input type="email" name="EMAIL" class="form-control" placeholder="enter your email">
			              <input id="p_submit" type="submit" value="send">
			              <label for="p_submit"><i class="fa fa-envelope"></i></label>
			              <p>Get latest updates and offers.</p>
			            </form>
					</div>
				</div>-->
			</div>
		</div>
		
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p class="ftex">&copy; 2017 Laundry Bucket - All Rights Reserved</p> 
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<!-- JS VENDOR -->
	<script type="text/javascript" src="js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vendor/jquery.superslides.js"></script>
	<script type="text/javascript" src="js/vendor/owl.carousel.js"></script>
	<script type="text/javascript" src="js/vendor/bootstrap-hover-dropdown.min.js"></script>
	<script type="text/javascript" src="js/vendor/jquery.magnific-popup.min.js"></script>
	
	<!-- sendmail -->
	<script type="text/javascript" src="js/vendor/validator.min.js"></script>
	<script type="text/javascript" src="js/vendor/form-scripts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
	
	<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&amp;ver=4.1.5'></script>-->
	  <script src="https://maps.google.com/maps/api/js?key=AIzaSyCuzyct7M2aeqZxsdDsHMpWNvjwggnwyXA&sensor=false&amp;ver=4.1.5"
  type="text/javascript"></script>

	<script type="text/javascript" src="js/script.js"></script>


<script>
	$(document).ready(function(){
	$('.datepicker').datepicker({
		autoclose:true
	});
	});
	
	
	$(document).on("click","#clear",function(){
		$("#offers_span").html("");
		$("#offers_text").val("");
	});
	$(document).ready(function(){
		$("#accordion .firstopen:first").children("div.collapse").addClass("in");
		
	});

</script>
<script>

function getlocation(city)
{
	document.getElementById("location").innerHTML="";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      
	       document.getElementById("location").innerHTML = xhttp.responseText;
	    }
	};
	xhttp.open("GET", "getlocation.php?city="+city, true);
	xhttp.send();
}
</script>
<script>
        $(document).ready(function () {
            $(":input").inputmask();
            
        });
        $(document).on("click","#btnsendcontact",function(){
        	var frmdata=$("#frmcontactenquiry").serialize();
        	var strurl="send_contact.php?"+frmdata; 
        	 $.ajax(
		       {
				url:strurl,
				type:"GET",
				/*beforeSend: function ()
				                {
				                 $.blockUI({ css: { 
					            border: 'none', 
					            padding: '15px', 
					            backgroundColor: '#000', 
					            '-webkit-border-radius': '10px', 
					            '-moz-border-radius': '10px', 
					            opacity: .5, 
					            color: '#fff' 
						        } }); 
						        setTimeout($.unblockUI, 3000);
					            },*/
								success: function(msg)
								{
									//alert(msg);
									if(msg==1){
										window.location.href="thanksconatct.php";
									}
									else{
										alert(msg);
									}
									  //window.location.href="cart.php";
								},
							});
        });
        $(document).on("click","#btnsendcontact1",function(){
        	var frmdata=$("#frmcontactenquiry1").serialize();
        	var strurl="send_contact.php?"+frmdata; 
        	 $.ajax(
		       {
				url:strurl,
				type:"GET",
				/*beforeSend: function ()
				                {
				                 $.blockUI({ css: { 
					            border: 'none', 
					            padding: '15px', 
					            backgroundColor: '#000', 
					            '-webkit-border-radius': '10px', 
					            '-moz-border-radius': '10px', 
					            opacity: .5, 
					            color: '#fff' 
						        } }); 
						        setTimeout($.unblockUI, 3000);
					            },*/
								success: function(msg)
								{
									//alert(msg);
									if(msg==1){
										window.location.href="thanksconatct.php";
									}
									else{
										alert(msg);
									}
									  //window.location.href="cart.php";
								},
							});
        });
        
           $(document).on("click","#btnsendcontact3",function(){
        	var frmdata=$("#frmcontactenquiry3").serialize();
        	var strurl="send_contact.php?"+frmdata; 
        	 $.ajax(
		       {
				url:strurl,
				type:"GET",
				/*beforeSend: function ()
				                {
				                 $.blockUI({ css: { 
					            border: 'none', 
					            padding: '15px', 
					            backgroundColor: '#000', 
					            '-webkit-border-radius': '10px', 
					            '-moz-border-radius': '10px', 
					            opacity: .5, 
					            color: '#fff' 
						        } }); 
						        setTimeout($.unblockUI, 3000);
					            },*/
								success: function(msg)
								{
									//alert(msg);
									if(msg==1){
										window.location.href="thanksconatct.php";
									}
									else{
										alert(msg);
									}
									  //window.location.href="cart.php";
								},
							});
        });
    </script>
		
</body>


</html>