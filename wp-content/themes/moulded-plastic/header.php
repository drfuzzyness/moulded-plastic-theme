<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * Fields used: 
 theme_color
 theme_lightness
 hide_header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Matthew_Conto_2016
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php 
	$themeColor = get_field('theme_color');
	if( empty( $themeColor ) ) {
		$themeColor = 'white';
	}
	$themeLightness = get_field('theme_lightness');
	if( empty( $themeLightness ) ) {
		$themeLightness = 'light-background';
	}
	echo '<meta name="theme-color" content="' . $themeColor . '">';
 ?>
 
 <style>
	 #header-nav .title-bar {
		 background: <?php echo $themeColor; ?>
	 }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='https://fonts.googleapis.com/css?family=Fira+Sans:300italic,400,500,400italic' rel='stylesheet' type='text/css'>
<meta name="flattr:id" content="gnq5pw"> 
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mattconto-2016' ); ?></a>
	
	<!--Dynamically change between half-header, quarter-header, and full-header depending on page-->
	<?php if( empty(get_field("hide_header") || get_field("hide_header") ) ) { ?>
	<header id="masthead" class="quarter-header light-background" role="banner" >
		<div class="row align-center">
			<div class="large-2 medium-3 small-6 column logo medium-order-2 small-order-1">
				<!--Logo-->
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
					<img src="<?php echo esc_url( get_theme_mod( 'mattconto_2016_logo_color' ) ); ?>" alt="">
				</a>
			</div>
			<div class="large-10 medium-9 small-12 column medium-order-1 small-order-2">
				<h1><?php bloginfo( 'name' ); ?></h1>
				<p class="tagline"><?php bloginfo( 'description' ); ?></p>
				<ul class="links">
					<?php wp_nav_menu_no_ul_header(); ?>
				</ul>
				
			</div>
		</div>
	</header>
	<?php } ?>
	
	<div id="nav-start" data-something>
	<!-- Controls how far the topbar will scroll -->
	<div data-sticky-container>
		<div id="header-nav" class="sticky" data-sticky data-sticky-on="small" data-anchor="nav-start" data-margin-top='0' data-margin-bottom='0'>
			<div class="row">
				<div class="title-bar text-right" data-responsive-toggle="top-menu" data-hide-for="medium" style="background-color: <?php echo $themeColor; ?>">
					<!--<button class="menu-icon" type="button" data-toggle></button>-->
					<div class="title-bar-title <?php echo $themeLightness; ?>" type="button" data-toggle>
						Menu
					</div>
				</div>
				<div class="top-bar" id="top-menu">
					<div class="top-bar-left">
						<ul class="menu">
							<li class="menu-text ">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src="<?php echo esc_url( get_theme_mod( 'mattconto_2016_logo_color' ) ); ?>" alt="">Matthew Conto</a>
							</li>
							<?php wp_nav_menu_no_ul_primary() ?>
						</ul>
					</div>
					<div class="top-bar-right">
						<ul class="menu search">
							<li><?php get_search_form(); ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="content" class="site-content">
