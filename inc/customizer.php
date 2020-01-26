<?php
/**
 * Astroride Theme Customizer
 *
 * @package Astroride
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function astroride_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback'  => function() {
				return get_bloginfo( 'name', 'display' );
			}
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback'  => function() {
				return get_bloginfo( 'description', 'display' );
			}
		) );
	}

}
add_action( 'customize_register', 'astroride_customize_register' );
