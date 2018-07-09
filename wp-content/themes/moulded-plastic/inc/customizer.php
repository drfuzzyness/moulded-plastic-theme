<?php
/**
 * Matthew Conto 2016 Theme Customizer.
 *
 * @package Matthew_Conto_2016
 */
 


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mattconto_2016_customize_register( $wp_customize ) {	
	$wp_customize->add_section( 'mattconto_2016_logo_section' , array(
		'title'       => __( 'Logo', 'mattconto_2016' ),
		'priority'    => 30,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	
	$wp_customize->add_setting( 'mattconto_2016_logo_color' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mattconto_2016_logo_color', array(
		'label'    => __( 'Logo Color', 'mattconto_2016' ),
		'section'  => 'mattconto_2016_logo_section',
		'settings' => 'mattconto_2016_logo_color',
	) ) );
	
	$wp_customize->add_setting( 'mattconto_2016_logo_white' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mattconto_2016_logo_white', array(
		'label'    => __( 'Logo White', 'mattconto_2016' ),
		'section'  => 'mattconto_2016_logo_section',
		'settings' => 'mattconto_2016_logo_white',
	) ) );
	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
}
add_action( 'customize_register', 'mattconto_2016_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mattconto_2016_customize_preview_js() {
	wp_enqueue_script( 'mattconto_2016_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mattconto_2016_customize_preview_js' );