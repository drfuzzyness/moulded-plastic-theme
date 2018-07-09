<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Matthew_Conto_2016
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer page-block half" role="contentinfo">
		<div class="site-info row align-center">
			<div class="large-4 small-4 column text-center">
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
					<img src="<?php echo esc_url( get_theme_mod( 'mattconto_2016_logo_white' ) ); ?>" alt="">
				</a>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri() ; ?>/bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ; ?>/bower_components/what-input/what-input.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ; ?>/bower_components/foundation-sites/dist/foundation.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ; ?>/js/min/app-min.js"></script>


</body>
</html>
