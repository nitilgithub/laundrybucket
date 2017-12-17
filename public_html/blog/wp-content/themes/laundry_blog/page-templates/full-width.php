<?php
/**
 * Template Name: Full-width Page Template, No Sidebar

 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>