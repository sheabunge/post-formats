<?php

/**
 * Link
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */

add_filter( 'the_excerpt_rss', 'post_formats_link_content');
add_filter( 'the_content', 'post_formats_link_content');

function post_formats_link_content( $content ) {
	if ( has_post_format( 'link' ) ) {
		if ( get_post_meta( get_the_ID(), '_format_link_url', true ) ) {
			$content .= sprintf(
				'<p><a href="%1$s" title="Direct link to featured article">Direct Link to Article</a> &#8212; <a href="%2$s" rel="bookmark">Permalink</a></p>',
				get_post_meta( get_the_ID(), '_format_link_url', true ),
				get_permalink()
			);
		}
	}
	return $content;
}

add_filter( 'the_permalink_rss', 'post_formats_link_permalink_rss' );

function post_formats_link_permalink_rss( $link ) {
	if ( has_post_format( 'link' ) )
		if ( get_post_meta( get_the_ID(), '_format_link_url', true ) )
			$link = get_post_meta( get_the_ID(), '_format_link_url', true );
	return $link;
}