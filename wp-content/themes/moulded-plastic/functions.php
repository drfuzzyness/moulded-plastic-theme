<?php
/**
 * Matthew Conto 2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Matthew_Conto_2016
 */
ini_set('display_errors', 'On');
define('ACF_EARLY_ACCESS', '5');


if ( ! function_exists( 'moulded_plastic_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function moulded_plastic_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Matthew Conto 2016, use a find and replace
	 * to change 'moulded-plastic' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'moulded-plastic', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// Removes ul class from wp_nav_menu
	function wp_nav_menu_no_ul_primary()
	{
		$options = array(
			'echo' => false,
			'container' => false,
			'theme_location' => 'primary',
			'fallback_cb'=> 'fall_back_menu'
		);

		$menu = wp_nav_menu($options);
		echo preg_replace(array(
			'#^<ul[^>]*>#',
			'#</ul>$#'
		), '', $menu);

	}
	
	function wp_nav_menu_no_ul_header()
	{
		$options = array(
			'echo' => false,
			'container' => false,
			'theme_location' => 'header-links',
			'fallback_cb'=> 'fall_back_menu'
		);

		$menu = wp_nav_menu($options);
		echo preg_replace(array(
			'#^<ul[^>]*>#',
			'#</ul>$#'
		), '', $menu);

	}

	function fall_back_menu(){
		return;
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'moulded-plastic' ),
		'header-links' => esc_html__( 'Header Links', 'moulded-plastic')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'moulded_plastic_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'moulded_plastic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function moulded_plastic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'moulded_plastic_content_width', 640 );
}
add_action( 'after_setup_theme', 'moulded_plastic_content_width', 0 );

if ( ! function_exists( 'moulded_plastic_pagination' ) ) :
function moulded_plastic_pagination() {
	global $wp_query;

	$big = 999999999; // This needs to be an unlikely integer

	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5,
		'prev_next' => true,
	    'prev_text' => __( '&laquo;', 'moulded_plastic' ),
	    'next_text' => __( '&raquo;', 'moulded_plastic' ),
		'type' => 'list',
	) );

	$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
	$paginate_links = str_replace( '<li><span class="page-numbers dots">', "<li><a href='#'>", $paginate_links );
	$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='current'><a href='#'>", $paginate_links );
	$paginate_links = str_replace( '</span>', '</a>', $paginate_links );
	$paginate_links = str_replace( "<li><a href='#'>&hellip;</a></li>", "<li><span class='dots'>&hellip;</span></li>", $paginate_links );
	$paginate_links = preg_replace( '/\s*page-numbers/', '', $paginate_links );

	// Display the pagination if more than one page is found.
	if ( $paginate_links ) {
		echo '<div class="pagination-centered">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function moulded_plastic_widgets_init() {
	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => 'blogpage-sidebar-1',
		'description'   => 'Sidebar for the blog page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title hide">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'moulded_plastic_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function moulded_plastic_scripts() {
	wp_enqueue_style( 'moulded-plastic-style', get_stylesheet_uri() );

	wp_enqueue_script( 'moulded-plastic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'moulded-plastic-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'moulded_plastic_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
