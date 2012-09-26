<?php

/* Filter the post format archive title. */
add_filter( 'single_term_title', 'my_post_format_single_term_title' );

/**
 * Filters the single post format title, which is used on the term archive page. The purpose of this 
 * function is to replace the singular name with a plural version.
 *
 * @author Justin Tadlock 
 * @copyright Copyright (c) 2012
 * @link http://justintadlock.com/archives/2012/09/07/post-format-plural-strings
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 * @access public
 * @param string $title The term name.
 * @return string
 */
function my_post_format_single_term_title( $title ) {

	if ( is_tax( 'post_format' ) ) {
		$term = get_queried_object();
		$plural = my_post_format_get_plural_string( $term->slug );
		$title = !empty( $plural ) ? $plural : $title;
	}

	return $title;
}

/**
 * Gets the plural version of a post format name.
 *
 * @author Justin Tadlock 
 * @copyright Copyright (c) 2012
 * @link http://justintadlock.com/archives/2012/09/07/post-format-plural-strings
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 * @access public
 * @param string $slug The term slug.
 * @return string
 */
function my_post_format_get_plural_string( $slug ) {

	$strings = my_post_format_get_plural_strings();

	$slug = str_replace( 'post-format-', '', $slug );

	return isset( $strings[ $slug ] ) ? $strings[ $slug ] : '';
}

/**
 * Defines plural versions of the post format names since WordPress only provides a singular version 
 * of each format. Basically, I hate having archive pages labeled with the singular name, so this is 
 * what I created to take care of that problem.
 *
 * @author Justin Tadlock 
 * @copyright Copyright (c) 2012
 * @link http://justintadlock.com/archives/2012/09/07/post-format-plural-strings
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.1.0
 * @access public
 * @return array
 */
function my_post_format_get_plural_strings() {

	$strings = array(
	//	'standard' => __( 'Articles',       'my-textdomain' ), // Would this ever be used?
		'aside'    => __( 'Asides',         'my-textdomain' ),
		'audio'    => __( 'Audio',          'my-textdomain' ), // Leave as "Audio"?
		'chat'     => __( 'Chats',          'my-textdomain' ),
		'image'    => __( 'Images',         'my-textdomain' ),
		'gallery'  => __( 'Galleries',      'my-textdomain' ),
		'link'     => __( 'Links',          'my-textdomain' ),
		'quote'    => __( 'Quotes',         'my-textdomain' ), // Use "Quotations"?
		'status'   => __( 'Status Updates', 'my-textdomain' ),
		'video'    => __( 'Videos',         'my-textdomain' ),
	);

	return apply_filters( 'my_post_format_plural_strings', $strings );
}