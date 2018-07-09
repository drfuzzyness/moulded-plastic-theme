<?php
/*
Template Name: Matt Project Page

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
<style>
	.primary-color-bg {
		background-color: <?php the_field('header_bgcolor') ?>;
	}
	
	.story-header {
		background: url("<?php the_field('header_bgimage') ?>") <?php the_field('header_bgcolor') ?>;
	}
	
	.secondary-color-bg {
		border-top: none;
		background-color: <?php the_field('theme_color') ?>;
	}
	.light-background h1.project-title {
		background-color: <?php the_field('header_bgcolor') ?>;
		color: white;
		display: inline-block;
		padding: 8px .5em;
	}
	.light-background .tagline {
		background-color: <?php the_field('header_bgcolor') ?>;
		color: white;
		display: inline-block;
		padding: 8px 1em;
	}
	
	.dark-background h1.project-title {
		background-color: white;
		color: <?php the_field('header_bgcolor') ?>;
		display: inline-block;
		padding: 8px .5em;
	}
	.dark-background .tagline {
		background-color: white;
		color: <?php the_field('header_bgcolor') ?>;
		display: inline-block;
		padding: 8px 1em;
	}
</style>
<header class="story-header <?php the_field('header_lightness') ?> primary-color-bg" style="">
	<div class="row align-justify align-middle">
		<?php
		if( get_field('header_logo_is_title') ) {
			echo '<div class="column small-12 medium-12 large-12 text-center"><img src="' . get_field('header_logo_image') . '" alt="">
			</div>';
			echo '<div class="column text-right medium-12 small-12">
				<p class="tagline">' . get_field('tagline') . '</p>
			</div>';
		} else {
			echo '<div class="column small-12 medium-4 large-4 text-left"><img src="' . get_field('header_logo_image') . '" alt="">
			</div>';
			echo '<div class="column text-right large-8 medium-8 small-12">
				<h1 class="project-title">' . get_field('header_title') . '</h1>
				<br><p class="tagline">' . get_field('tagline') . '</p>
			</div>';
		} ?>
		
	</div>
</header>

<section class="story-subheader <?php the_field('theme_lightness') ?> secondary-color-bg" style="">
	<div class="row align-justify">
		<div class="column shrink">
			<?php the_field('context_left'); ?>
		</div>
		<div class="column shrink">
			<?php the_field('context_right'); ?>
		</div>
	</div>
</section>
<?php
	while ( have_posts() ) : the_post();
		if( !empty( get_the_content() ) ): 
			?> 
<section class="page-block half about">
	<div class="row align-center">
		<article class="large-8 medium-10 small-10 column">
			<?php the_content(); 
			if ( comments_open() || get_comments_number() ) :
				comments_template(); 
			endif;
			?>
		</article>
	</div>
</section>
			<?php
		endif;
		// If comments are open or we have at least one comment, load up the comment template.
		endwhile; // End of the loop.
?>

<?php if( !empty(get_field('project_cat_slg')) ) { ?>
<div class="row">
	<div class="small-12 large-12 columns" role="main">
		<section class="page-block project-feed">
			<div class="row align-center">
				<div class="large-2 medium-2 small-12 column sidebar hide-for-small-only" data-sticky-container>
					<div class="widget-container sticky" data-sticky data-sticky-on="medium" data-anchor="project-posts" data-margin-top="6">
						<div class="widget text-right float-right">
							<h4>Updates</h4>
							<ul class="project-feed-magellan" data-magellan>
								<?php 
								$query = new WP_Query(array('showposts' => 0, 'category_name' => get_field('project_cat_slg') ));
								// $query = new WP_Query( get_field('project_cat_slg') );
								if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

								<li><a href="#postlist-<?php the_ID(); ?>"><?php
								// if( empty(get_title()) ) {
								// 	echo '<strong class="title">' . the_time( 'F jS, Y' ) . '</strong>';
								// } else {
									echo '<strong class="title">' . get_the_title() . '</strong>';
									echo '<em class="date">' . get_the_time( 'M j, \'y' ) . '</em>';
								// }
								 ?></a></li>
								 
								 <?php endwhile; endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<div id="project-posts" class="large-8 medium-10 small-12 column">
					<ul class="posts">
					<?php
						if ( $query->have_posts() ) :
							/* Start the Loop */
							while ( $query->have_posts() ) : $query->the_post();

								/*
								* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/
								echo '<li class="post" id="postlist-' . get_the_ID() .  '" data-magellan-target="postlist-' . get_the_ID() .  '">';
								get_template_part( 'template-parts/content', get_post_format() );
								echo '</li>';

							endwhile;

							the_posts_navigation();

						else :
							// If no posts
							get_template_part( 'template-parts/content', 'none' );

					endif; ?>
					</ul>
				</div>
			</div>
		</seciton>
		
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>