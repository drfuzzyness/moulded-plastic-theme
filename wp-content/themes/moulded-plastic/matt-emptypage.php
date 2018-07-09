<?php
/*
Template Name: Matt Basic Page
*/
get_header(); ?>
<?php
	while ( have_posts() ) : the_post();
		if( !empty( get_the_content() ) ): 
			?> 
			<?php the_content();?>
			<?php
		endif;
	// If comments are open or we have at least one comment, load up the comment template.
	endwhile; // End of the loop.
?>
<?php get_footer(); ?>