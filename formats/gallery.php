<?php

/**
 * Gallery
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */


/**
 * Prepend the [gallery] shortcode
 * to the content, if it does not
 * already exist
 *
 * @since Post Formats 1.0
 */
function post_formats_gallery_content( $content ) {

	if ( has_post_format( 'gallery' ) ) {
	
		if ( strpos( $content, '[gallery]' ) === false ) {
		
			$gallery = do_shortcode( '[gallery]' );
			
			if ( ! empty( $gallery ) ) {
				$content = $gallery . "\n\n" . $content;
			}
			
		}
		
	}
	return $content;
}

add_filter( 'the_content', 'post_formats_gallery_content' );