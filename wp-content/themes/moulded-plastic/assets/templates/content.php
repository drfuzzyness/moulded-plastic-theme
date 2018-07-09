<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Matthew_Conto_2016
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array('blogpost') ); ?>>
	<div class="row align-center">
		<div class="medium-12 small-12 column text-center">
			
			<?php
				if ( is_single() ) {
					if( empty( get_field('nice_title') ) ) {
						the_title( '<h1 class="title">', '</h1>' );
					} else {
						echo '<h1 class="title">' . get_field('nice_title') . '</h1>';
					}
					
				} else {
					if( empty( get_field('nice_title') ) ) {
						the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					} else {
						echo '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_field('nice_title') . '</a></h2>';
					}
				}

			if ( 'post' === get_post_type() ) : ?>
			<span class="date">
				<?php
				mattconto_2016_posted_on();
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					echo ' - from <a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				}
				?> 
			</span><!-- .entry-meta -->
			<?php
			endif; ?>
		</div><!-- .entry-header -->

		<article class="entry-content medium-8 small-10 column">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mattconto-2016' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			
		?>
		</article><!-- .entry-content -->

		<div class="entry-footer small-8 column date">
			<?php 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mattconto-2016' ),
				'after'  => '</div>',
			) );
			mattconto_2016_entry_footer(); ?>
		</div><!-- .entry-footer -->
</div><!-- #post-## -->
