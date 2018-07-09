<?php
/*
Template Name: Matt Blog Page

Fields: 
theme_color
theme_lightness
header_bgcolor
header_bgimage
header_lightness
header_logo_is_title
header_title
header_logo_image
tagline
card_image
card_type

context_left
context_right

project_cat_slg
*/
get_header(); ?>
<div class="row">
	<div class="small-12 large-12 columns" role="main">
		<section class="page-block project-feed">
			<div class="row align-center">
				
				
				<div class="large-2 medium-2 small-12 column sidebar hide-for-small-only" data-sticky-container>
					<div class="widget-container sticky" data-sticky data-sticky-on="medium" data-anchor="project-posts" data-margin-top="6">
						<?php dynamic_sidebar( 'blogpage-sidebar-1' ); ?>
					</div>
				</div>
				<div id="project-posts" class="large-8 medium-10 small-12 column">
					<ul class="posts">
					<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
						'posts_per_page' => 0,
						'paged'          => $paged
						);

						$the_query = new WP_Query( $args ); 
						if ( $the_query->have_posts() ) :
							/* Start the Loop */
							while ( $the_query->have_posts() ) : $the_query->the_post();

								/*
								* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/
								echo '<li class="post" id="postlist-' . get_the_ID() .  '" data-magellan-target="postlist-' . get_the_ID() .  '">';
								get_template_part( 'template-parts/content', get_post_format() );
								echo '</li>';

							endwhile;

							// the_posts_navigation();
							the_posts_pagination( array(
								'mid_size'  => 2,
								'prev_text' => __( 'Back', 'textdomain' ),
								'next_text' => __( 'Onward', 'textdomain' ),
							) );

						else :
							// If no posts
							get_template_part( 'template-parts/content', 'none' );

					endif; ?>
					</ul>
				</div>
			</div>
		</seciton>
		<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
		<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
	</div>
</div>
<?php get_footer(); ?>