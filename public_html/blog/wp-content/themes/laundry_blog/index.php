<?php get_header(); ?>
<!-- End of  header-->
<section>&nbsp;</section>
<section>&nbsp;</section>
<section>&nbsp;</section>
<section>&nbsp;</section>
<section>&nbsp;</section>
	<section class="container">
	<div class="col-md-12 col-xs-12">
		<h3 class="text-center">Latest Feeds</h3>
		<hr class="style-two " />
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>    
		  <div class="col-md-12 col-xs-12" style="border-bottom:1px groove #777;border-right:1px groove #ccc;">
		  	<div class="col-md-4 col-xs-12">
		  	        <?php the_post_thumbnail('thumbnail'); ?>
		  	</div>
		  	<div class="col-md-8 col-xs-12">
		  <a style="color:#000;text-decoration: none;" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><h4></i> <?php the_title(); ?></h4></a>
		  	<?php the_content("more"); ?>.
		  	</div>
		  </div>
		<?php endwhile; ?>
		<?php if(function_exists('wp_paginate')) {
		    wp_paginate();
		}
		?> 
	<?php endif; ?>
	</div>
	
	</section>
	
<!--Footer Start-->
<?php get_footer(); ?>
