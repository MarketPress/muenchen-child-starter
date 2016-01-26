<?php
/**
 * Functions and definitions for Muenchen Child.
 *
 * @package    WordPress
 * @subpackage Muenchen_Child
 * @version    1.0
 * @author     marketpress.com
 */

add_action( 'after_setup_theme', 'muenchen_child_setup' );
/**
 * Sets up theme defaults and registers support for various WordPress features
 * of Muenchen Child Theme.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support for post thumbnails.
 *
 * @since   05/07/2015
 * @return  void
 */
function muenchen_child_setup() {

	/* The .min suffix for stylesheets and scripts.
	 *
	 * In order to provide a quick start, this child theme by default will load
	 * regular CSS and javascript files (whereas its parent theme loads
	 * minified versions of its stylesheets and scripts by default).
	 *
	 * If you want your child theme to default on minified stylesheets and scripts,
	 * set the following filter:
	 *
	 * if( function_exists( 'muenchen_get_script_suffix' ) ) {
	 *     add_filter( 'muenchen_child_starter_get_script_suffix', 'muenchen_get_script_suffix' );
	 * }
	 *
	 * Don’t forget to actually add applicable .min files to your child theme first!
	 *
	 * You can then temporarily switch back to unminified versions of the same
	 * files by setting the constant SCRIPT_DEBUG to TRUE in your wp-config.php:
	 * define( 'SCRIPT_DEBUG', TRUE );
	 */

	// Loads the child theme's translated strings
	load_child_theme_textdomain(
		'muenchen-child-starter',
		get_stylesheet_directory() . '/languages'
	);

	if ( ! is_admin() ) {

		// child theme styles
		add_filter( 'muenchen_get_styles', 'muenchen_child_filter_muenchen_get_styles_add_stylesheets' );

	}
}

/**
 * Adding our own styles for our child theme
 *
 * @wp-hook muenchen_get_styles
 *
 * @param   array $styles
 *
 * @return  array $styles
 */
function muenchen_child_filter_muenchen_get_styles_add_stylesheets( array $styles = array() ) {

	// add suffix
	$suffix = apply_filters( 'muenchen_child_starter_get_script_suffix', '' );

	// getting the theme-data
	$theme_data = wp_get_theme();

	// adding our own styles to
	$styles[ 'muenchen_child' ] = array(
		'src'     => get_stylesheet_directory_uri() . '/style' . $suffix . '.css',
		'deps'    => NULL,
		'version' => $theme_data->Version,
		'media'   => NULL,
	);

	return $styles;

}
