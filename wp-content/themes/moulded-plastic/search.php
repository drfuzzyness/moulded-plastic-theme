<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Matthew_Conto_2016
 */

get_header(); ?>
		<section class="row align-center page-block">
			<div class="column large-8 small-10">
				<span class="blue caps">Search Results:</span>
				<h2 class="orange"><?php printf( esc_html__( '%s', 'moulded-plastic' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</div>
			
		</section>
		<?php
		if ( have_posts() ) : ?>
		

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
// get_sidebar();
get_footer();
