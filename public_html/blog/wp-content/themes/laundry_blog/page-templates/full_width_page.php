<?php
/**
 * Template Name: Full-width Page Template, No Sidebar

 * 
 */

get_header(); ?>
    <div class="row">
    	<div>&nbsp;</div>
    	<div class="container">
   	
   		<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
				<?php comments_template( '', true ); ?>
				<?php 	// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					} ?>
			<?php endwhile; // end of the loop. ?>

	
	</div><!-- #primary -->
	</div>
<?php get_footer(); ?>