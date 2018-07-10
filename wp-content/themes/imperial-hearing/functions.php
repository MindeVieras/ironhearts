<?php

/**
 * Imperial Hearing functions and definitions
 * @package Imperial_Hearing
 */

/**
 * Enqueue scripts & styles
 */
add_action( 'wp_enqueue_scripts', 'imperialhearing_enqueue_files' );

function imperialhearing_enqueue_files() {
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/css/styles.css' );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), false, true );
}

/**
 * Enqueue scripts & styles
 */
add_action( 'admin_enqueue_scripts', 'imperial_hearing_enqueue_admin_files' );

function imperial_hearing_enqueue_admin_files() {

	$browser_key = get_theme_mod( 'google_api_key' );
	$key = empty( $browser_key ) ? '' : 'key='. $browser_key . '&';

	wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?'. $key .'libraries=weather,geometry,visualization,places,drawing' );
}

if ( ! function_exists( 'imperial_hearing_setup' ) ) :

	function imperial_hearing_setup() {

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		
		add_image_size( 'hero-image', 1270, 390, true );
		add_image_size( 'hp-image', 1690, 600, true );
    add_image_size( 'event-image', 480, 480, true );
		add_image_size( 'team-member', 220, 220, true );
		add_image_size( 'hearing-aid-image', 420, 190, true );

	  register_nav_menus(
	  	array(
	  		'main' => __('Main'),
	  		'footer_bottom' => __('Footer Bottom')
	  	)
	  );

	}
endif;
add_action( 'after_setup_theme', 'imperial_hearing_setup' );

add_filter('jpeg_quality', function($arg){return 80;});

/**
 * Register widget area.
 */
function imperial_hearing_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'imperial-hearing' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'imperial-hearing' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'imperial_hearing_widgets_init' );


// EDITOR
/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
/*
 * Modify TinyMCE editor to remove TAGS.
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	// print('<pre>');print_r($init);print('</pre>');
	$init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;';
	return $init;
}

// Redirect homepage to homepage :)
function wpse101952_redirect() {
  global $post;
  if( is_page( array( 'home-page' ) ) ) {
    wp_redirect( '/' );
    exit();
  }
}
add_action( 'template_redirect', 'wpse101952_redirect' );



/**
 * Custom template functions.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-breadcrumbs.php';
