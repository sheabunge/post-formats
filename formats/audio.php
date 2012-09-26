<?php

/**
 * Audio
 *
 * @since Post Formats 1.0
 *
 * @package Post Formats
 * @subpackage Formats
 */

function post_formats_audio_content( $content ) {

	if ( has_post_format( 'audio' ) ) {
	
		$embed = get_post_meta( get_the_ID(), '_format_audio_embed', true );
	
		if ( ! empty( $embed ) && strpos( $content, $embed ) === false ) {
			$post->post_content = $embed . "\n\n" . $content;
		}
	}
	return $post->post_content;
}