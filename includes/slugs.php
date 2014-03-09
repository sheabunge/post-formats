<?php

function my_get_post_format_slugs() {

	$slugs = array(
		'aside'   => 'asides',
		'audio'   => 'audio',
		'chat'    => 'chats',
		'gallery' => 'galleries',
		'image'   => 'images',
		'link'    => 'links',
		'quote'   => 'quotes',
		'status'  => 'status-updates',
		'video'   => 'videos'
	);

	return $slugs;
}

/* Remove core WordPress filter. */
remove_filter( 'term_link', '_post_format_link', 10 );

/* Add custom filter. */
add_filter( 'term_link', 'my_post_format_link', 10, 3 );

/**
 * Filters post format links to use a custom slug.
 *
 * @param string $link The permalink to the post format archive.
 * @param object $term The term object.
 * @param string $taxnomy The taxonomy name.
 * @return string
 */
function my_post_format_link( $link, $term, $taxonomy ) {
	global $wp_rewrite;

	if ( 'post_format' != $taxonomy ) {
		return $link;
	}

	$slugs = my_get_post_format_slugs();

	$slug = str_replace( 'post-format-', '', $term->slug );
	$slug = isset( $slugs[ $slug ] ) ? $slugs[ $slug ] : $slug;

	if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) ) {
		$link = str_replace( "/{$term->slug}", '/' . $slug, $link );
	} else {
		$link = add_query_arg( 'post_format', $slug, remove_query_arg( 'post_format', $link ) );
	}

	return $link;
}

/* Remove the core WordPress filter. */
remove_filter( 'request', '_post_format_request' );

/* Add custom filter. */
add_filter( 'request', 'my_post_format_request' );

/**
 * Changes the queried post format slug to the slug saved in the database.
 *
 * @param array $qvs The queried variables.
 * @return array
 */
function my_post_format_request( $qvs ) {

	if ( ! isset( $qvs['post_format'] ) ) {
		return $qvs;
	}

	$slugs = array_flip( my_get_post_format_slugs() );

	if ( isset( $slugs[ $qvs['post_format'] ] ) ) {
		$qvs['post_format'] = 'post-format-' . $slugs[ $qvs['post_format'] ];
	}

	$tax = get_taxonomy( 'post_format' );

	if ( ! is_admin() ) {
		$qvs['post_type'] = $tax->object_type;
	}

	return $qvs;
}
