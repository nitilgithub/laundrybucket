<?php
/*
 *
 *Template Name: Front-Page
 * 
 */
 
get_header();
?>

   	<div class="container">
   		
  	<?php if ( function_exists( "easingsliderlite" ) ) { easingsliderlite(); } ?>
  		
 </div>
 <audio style="display:none" controls="controls" onloadeddata="var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, 8000)">
    <source src="http://www.shahsatnamjigirlscollege.com/audio/Prayer.mp3" type="audio/mp3" />
</audio>
 <div class="row jumbotron" >
	<div class="col-md-3 col-md-offset-1 border-rows">
	<a target="_blank" href="http://www.ssjitm.com/wp-content/uploads/mandatory-disclosuressjitm-updated-03-08-2015.doc"><h4 class="white text-center">MANDATORY DISCLOSURE</h4></a>	
	</div>
	<div target="_blank" class="col-md-3 border-rows">
		<a href="http://www.ssjitm.com/wp-content/uploads/Prospectus.pdf"><h4 class="white text-center text-uppercase">Download Prospectus</h4></a>	
	</div>
	<div class="col-md-5">
		<div class="col-md-10 pull-right">
		<?php get_search_form(); ?>
		</div>
	</div>
		</div>
 		
   <div>&nbsp;</div>
<div class="container">
<div class="col-md-6 col-sm-12 pull-left">
	<div class="col-md-12 bgwhite">
					<h3 class="text-center text-info" style="border-bottom: 5px solid #0F5BA4;padding-bottom: 5px;">Director Message</h3>
  				<div class="row">
  					<div class="col-md-12">
  						<img style="float:left;margin:2px 10px;" class="img-responsive img-thumbnail" src="<?php bloginfo('stylesheet_directory'); ?>/img/Chanchal Rani.jpg" />
  						<p class="text-justify">The Guiding philosophy of Shah Satnam Ji Institute of Technology & Management, Sirsa is to produce Zealous, competent, dynamic & social techno mangers under the pious shelter of our guiding spirit St.Gurmeet Ram Rahim Singh Ji Insan, the youth attain a different identify in this age of over-reaching ambition with high expectations.The transition into professional world is always full of confusion and anxieties. As in professionals colleges, youth is often engrossed in drugs, alcohol, smoking & so on.. but the youth of The Shah Satnam Ji Educational Institutes endeavor to do their best for the service of mankind. They are strengthened with sound character to Tackle confusion and life crisis. They are developed and nurtured into leaders of tomorrow, equipping them with integrity <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">more..</a></p>
  					</div>
  				</div>
  				
  				<div>&nbsp;</div>
  				<div class="col-md-12 bgwhite">
					<h3 class="text-center text-info" style="border-bottom: 5px solid #0F5BA4;padding-bottom: 5px;">Video Gallery</h3>
  				<div class="row">
  					<div class="col-md-12">
<iframe width="100%" height="315" src="https://www.youtube.com/embed/GjyJcf0Lv4k?rel=0" frameborder="0" allowfullscreen></iframe>
  					
  					</div>
<a class='btn btn-info pull-right' href="http://www.ssjitm.com/video-gallery/">more</a>
  				</div>
  				<div>&nbsp;</div>
		</div>
</div>

</div>
<div class="col-md-6 col-sm-12 pull-right">
<div class="col-md-12 bgwhite">
				
  				<div class="row">
  					<div class="col-md-12">
  						 <?php get_sidebar();  ?>
  					</div>
  				</div>
  				
  				<div>&nbsp;</div>
  				<div class="col-md-12 bgwhite">
					
  				<div class="row">
  					<div class="col-md-12">

  					</div>
  				</div>
  				<div>&nbsp;</div>
		</div>
</div>
	</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div style="padding:20px;">
  <h3>Director Message</h3>	
  <b>Dhan Dhan Satguru Tera Hi Asra.</b>
 <p>The Guiding philosophy of Shah Satnam Ji Institute of Technology & Management, Sirsa is to produce Zealous, competent, dynamic & social techno mangers  under the pious shelter of our guiding spirit St.Gurmeet Ram Rahim Singh Ji Insan, the youth attain a different identify in this age of over-reaching ambition with high expectations. The transition into professional world is always full of confusion and anxieties. As in professionals colleges, youth is often engrossed in drugs, alcohol, smoking & so on.. but the youth of The Shah Satnam Ji Educational Institutes endeavor to do their best for the service of mankind. They are strengthened with sound character to Tackle confusion and life crisis. They are developed and nurtured into leaders of tomorrow, equipping them with integrity, truth, honesty, ethos and values of professionalism.</p>
 <p>Apart from this, we have state-of-the-art infrastructure and an environment conducive to meet academic, co-curricular and extra curricular aspirations of the students. We have a full fledged English lab to provide them communicative proficiency. Our dedicated team of faculty is committed to provide holistic education to meet the intellectual aspirations of students and adorn/endow them with managerial skills to contribute effectively in the advancement of society.</p>
 <p>By the blessings of Hazoor Pita Ji, we are sure that the institute will enable you to become a through bred- professionals in the technical and management field. We look forword to welcoming you to our campus.</p>
<h3>Director</h3>
<h3>Dr. Chanchal Rani </h3>
<p>Shah Satnam Ji Institute of Technology & Management,Sirsa.</p> 
</div>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>