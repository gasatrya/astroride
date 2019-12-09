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
	return 25;
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

/**
 * Add extra user fields
 */
function astroride_user_fields( $contactmethods ) {

	$contactmethods['twitter']     = esc_html__( 'Twitter URL', 'astroride' );
	$contactmethods['facebook']    = esc_html__( 'Facebook URL', 'astroride' );
	$contactmethods['instagram']   = esc_html__( 'Instagram URL', 'astroride' );
	$contactmethods['pinterest']   = esc_html__( 'Pinterest URL', 'astroride' );
	$contactmethods['linkedin']    = esc_html__( 'Linkedin URL', 'astroride' );
	$contactmethods['dribbble']    = esc_html__( 'Dribbble URL', 'astroride' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'astroride_user_fields' );

/**
 * Modifies the theme layout.
 */
function astroride_mod_theme_layout( $layout ) {

	// Change the layout to Full Width on Attachment page.
	if ( is_attachment() && wp_attachment_is_image() ) {
		$post_layout = get_post_layout( get_queried_object_id() );
		if ( 'default' === $post_layout ) {
			$layout = 'full-width';
		}
	}

	// Layout on Archive & Search page.
	if ( is_archive() || is_search() || is_404() ) {
		$layout = 'full-width';
	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'astroride_mod_theme_layout', 15 );
