<?php
/**
 * The template part for displaying header primary info.
 *
 * @package Newsreader
 */

$settings = array(
	'author_avatar' => true,
);

// Category.
if ( is_singular( 'post' ) ) {

	global $post;

	setup_postdata( $post );

	csco_get_post_meta( array( 'category' ), true, 'post_meta', $settings );

	wp_reset_postdata();
}

// Title.
the_title( '<h1 class="cs-entry__title"><span>', '</span></h1>' );

// Subtitle.
csco_post_subtitle();
