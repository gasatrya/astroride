<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Astroride
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function astroride_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'astroride_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function astroride_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'astroride_pingback_header' );

/**
 * Adds custom class to the array of posts classes.
 */
function astroride_post_classes( $classes, $class, $post_id ) {
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'astroride_post_classes', 10, 3 );

/**
 * Customize tag cloud widget
 */
function astroride_customize_tag_cloud( $args ) {
	$args['largest']  = 13;
	$args['smallest'] = 13;
	$args['unit']     = 'px';
	$args['number']   = 20;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'astroride_customize_tag_cloud' );

/**
 * Change the excerpt more string.
 */
function astroride_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'astroride_excerpt_more' );

/**
 * Limit excerpt length
 */
function astroride_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'astroride_excerpt_length', 999 );

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function astroride_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}
