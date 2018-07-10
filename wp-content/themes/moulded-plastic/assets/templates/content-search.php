<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Matthew_Conto_2016
 */

?>
<div class="row align-center">
	<div class="large-6 medium-8 small-9 column">
		<article id="post-<?php the_ID(); ?>" <?php post_class( array('blogpost') ); ?>>
		<div class="entry-header">
			<?php 
			if( empty( get_field('nice_title') ) ) {
				the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			} else {
				echo '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_field('nice_title') . '</a></h2>';
			} 
			?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php moulded_plastic_posted_on();
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo ' - from <a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				}
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</div><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php moulded_plastic_entry_footer(); ?>
		</div><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>

