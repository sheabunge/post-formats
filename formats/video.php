<?php

/**
 * Video
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */

/**
 * Prepends the video embed code to the
 * post content, if it does not already
 * exist
 *
 * @since Post Formats 1.0
 */
function post_formats_video_content( $content ) {

	if ( has_post_format( 'video' ) ) {

		$embed = get_post_meta( get_the_ID(), '_format_video_embed', true );

		if ( ! empty( $embed ) && strpos( $content, $embed ) === false ) {
			$content = $embed . "\n\n" . $content;
		}

	}
	return $content;
}

add_filter( 'the_content', 'post_formats_video_content' );
