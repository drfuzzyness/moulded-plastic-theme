<?php
/*
Template Name: Matt Portfolio Page
*/
get_header(); ?>

<section class="page-block">
	<div id="" class="row small-up-2 medium-up-3 large-up-4 portfolio-grid align-center">
	<?php 
	$query = new WP_Query(array('post_parent' => get_the_ID, 'post_type' => 'page'));
	if ( $query->have_posts() ) :
		/* Start the Loop */
		while ( $query->have_posts() ) : $query->the_post();
		if( !empty(get_field('card_image')) ) {
		 ?>
		<div class="item column small-6 medium-4 ">
            <a href=" <?php the_permalink(); ?> " class=" <?php the_field('theme_lightness'); ?> " style="background-color: <?php the_field('theme_color'); ?>">
                <div class="">
                    <div class="graphic" style="background-color: <?php the_field('header_bgcolor'); ?> "><img src="<?php the_field('card_image'); ?>" alt=""></div>
                    <div class="row">
                        <div class="column">
                            <div class="title"><?php the_title(); ?></div>
                            <div class="kind"><?php the_field('card_type'); ?></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
		<?php } endwhile; endif; ?>
	</div>
</section>

<section class="page-block about">
	<div class="row align-center">
		<article class="column small-10">
		<?php
			while ( have_posts() ) : the_post();
				the_content();

			endwhile; // End of the loop.
		?>
		</article>
	</div>
</section>



<?php get_footer(); ?>
