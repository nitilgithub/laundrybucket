<?php
/**
 * Template Name: Contact Page template
 */
get_header(); ?>
<style>
	input[type='text'],input[type='email']
	{
		padding:10px 20px;
	}
	textarea{
		padding:10px 30px;
		resize:none;
	}
	input[type='submit']
	{
		padding:10px 20px;
	}
</style>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-12">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>
			</div>
			<div class="col-md-4 col-sm-12">
		<h3>How to reach us</h3>
		<hr />
 	<p><h3>Shah Satnam ji Institute of Technology and Management</h3></p>
 	<p>Sirsa-125055(Haryana)</p>
    <p>Location:Shah Satnam Ji Marg,Near Shah Mastana ji Dham.</p>
    <p class=""><abbr class="" title="Cell Phone" ><i class="glyphicon glyphicon-phone"></i>+91</abbr> 9962-11667</p>
 			<p class=""><abbr class="" title=""><i class="glyphicon glyphicon-phone"></i></abbr> 01666-238605</p>
     
			</div>
			<div class="col-md-4 col-sm-12">
				<h3>SSJITM Location</h3>
				<hr />
				<iframe src="https://mapsengine.google.com/map/embed?mid=z-tUKihgK9Xk.kBKS8GVntsTM" width="100%" height="480"></iframe>
			</div>
			
		</div><!-- #content -->
		<div class="row">
				
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>