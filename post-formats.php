<?php

/**
 * Plugin Name: Post Formats
 * Plugin URI: https://github.com/bungeshea/post-formats
 * Author Name: Shea Bunge
 * Author URI: http://bungeshea.com
 * Description: Adds support for many different post formats. Much thanks to Justin Tadlock. Also works with Alex King's <a href="http://alexking.org/blog/2011/10/25/wordpress-post-formats-admin-ui">Post Formats Admin UI</a>, but it is not required.
 * Version: 1.0
 *
 * Thanks to Justin Tadlock for many of the code samples that
 * went into this plugin
 *
 * This plugin also supports the Crowd Favourite Post Formats UI plugin
 * @link http://alexking.org/blog/2011/10/25/wordpress-post-formats-admin-ui
 *
 * @package Post Formats
 * @subpackage Main
 */

/***************** Components *****************/

/**
 * Admin interface
 */
#require_once plugin_dir_path( __FILE__ ) . 'includes/admin.php';

/**
 * Post format plural strings
 * @link http://justintadlock.com/archives/2012/09/07/post-format-plural-strings
 */
#require_once plugin_dir_path( __FILE__ ) . 'includes/plurals.php';

/**
 * Custom URLs for post formats
 * @link http://justintadlock.com/archives/2012/09/11/custom-post-format-urls
 */
#require_once plugin_dir_path( __FILE__ ) . 'includes/plurals.php';


/***************** Post Formats *****************/

global $post_formats;

$post_formats = array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
);

foreach( $post_formats as $format ) {
	require_once plugin_dir_path( __FILE__ ) . "/formats/{$format}.php" );
}

/***************** Setup *****************/

add_action( 'after_setup_theme', 'add_post_formats' );

function add_post_formats() {
	global $post_formats;
	add_theme_support( 'post_formats', $post_formats );
}
