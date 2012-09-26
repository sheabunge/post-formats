<?php

/**
 * Image
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */

function post_formats_image_content( $content ) {

	/* Only precede past this point if the current post is an image post */
	if( ! has_post_format( 'image' ) ) return;

	/* Get the image ID, which may have been added by the Crowdfavourite Post Formats UI plugin */
	$image_id = intval( get_post_meta( get_the_ID(), '_thumbnail_id', true ) );
	if ( $image_id ) {
		$content = wp_get_attachment_image( $image_id, 'small')."\n\n".$post->post_content;
	}
	return $post->post_content;
}
