<?php

/**
 * Link
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */

/** @link http://wp-snippets.com/get-the-first-link-in-post/ */
function post_formats_get_content_link( $content = false, $echo = false )
{
    if ( $content === false )
        $content = get_the_content();

    $content = preg_match_all( '/hrefs*=s*["\']([^"\']+)/', $content, $links );
    $content = $links[1][0];

    if ( empty($content) ) {
    	$content = false;
    }

    return $content;
}

add_filter( 'the_excerpt_rss', 'post_formats_link_content');
add_filter( 'the_content', 'post_formats_link_content');

function post_formats_link_content( $content ) {
	if ( has_post_format( 'link' ) ) {

		if ( get_post_meta( get_the_ID(), '_format_link_url', true ) )
			$link = get_post_meta( get_the_ID(), '_format_link_url', true );
		else
			$link = post_formats_get_content_link( $content );

		if ( $link ) {
			$content .= sprintf(
				'<p><a href="%1$s" title="Direct link to featured article">Direct Link to Article</a> &#8212; <a href="%2$s" rel="bookmark">Permalink</a></p>',
				$link,
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
			 get_post_meta( get_the_ID(), '_format_link_url', true );
		else
			$link = post_formats_get_content_link();
	return $link;
}