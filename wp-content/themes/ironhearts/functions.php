<?php
/**
 * ironhearts functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ironhearts
 */

/**
 * Enqueue scripts & styles
 */
add_action( 'wp_enqueue_scripts', 'ironhearts_enqueue_files' );

function ironhearts_enqueue_files() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900', false );
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/css/styles.css' );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), false, true );
}

if ( ! function_exists( 'ironhearts_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ironhearts_setup() {

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'ironhearts' ),
		) );

	}
endif;
add_action( 'after_setup_theme', 'ironhearts_setup' );


// Customize admin mce editor
function parallel_admin_head()
{
    add_filter('mce_buttons', 'parallel_mce_buttons', 5);
}

function parallel_mce_buttons($buttons)
{
    $position = array_search('alignright', $buttons);

    if (! is_int($position)) {

        return array_merge($buttons, ['alignjustify']);
    }

    return array_merge(
        array_slice($buttons, 0, $position + 1),
        ['alignjustify'],
        array_slice($buttons, $position + 1)
    );
}

add_action('admin_head', 'parallel_admin_head', 5);
