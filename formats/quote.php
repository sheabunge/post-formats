<?php

/**
 * Quote
 *
 * @since Post Formats 1.0
 * @link http://justintadlock.com/archives/2012/08/27/post-formats-quote
 *
 * @package Post Formats
 * @subpackage Formats
 */

add_filter( 'the_content', 'post_formats_quote_content' );

function post_formats_quote_content( $content ) {

	/* Check if we're displaying a 'quote' post. */
	if ( has_post_format( 'quote' ) ) {

		/* Match any <blockquote> elements. */
		preg_match( '/<blockquote.*?>/', $content, $matches );

		/* If no <blockquote> elements were found, wrap the entire content in one. */
		if ( empty( $matches ) ) {
			$content = "<blockquote>{$content}</blockquote>";
		}

		/* Are we using the Crowd Favourite Post Formats UI plugin? */
		$name = esc_html( get_post_meta( get_the_ID(), '_format_quote_source_name', true ) );
		$url = esc_url( get_post_meta( get_the_ID(), '_format_quote_source_url', true ) );

		/* Is the name set, and is it not already mentioned in the content? */
		if ( ! empty( $name ) && strpos( $content, $name ) === false ) {

			/* If so, add the attribution */
			$content .= "\n\n" . '<p>&mdash; <em>';

			if ( empty( $url ) ) {
				$content .= $name;
			}
			else {
				$content .= sprintf( '<a href="%s">%s</a>', $url, $name );
			}

			$content .= '</em></p>';
		}

	}

	return $content;
}
