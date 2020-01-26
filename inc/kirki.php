<?php
/**
 * Add the configuration.
 * This way all the fields using the 'astroride_options' ID
 * will inherit these options
 */
Kirki::add_config( 'astroride_options', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/**
 * Disable Kirki loader
 */
add_filter( 'kirki/config', function( $config ) {
	$config['disable_loader'] = true;
	return $config;
} );

/**
 * Customizer Options
 */

// Retina Logo
require get_template_directory() . '/inc/options/retina.php';

// Hero
require get_template_directory() . '/inc/options/hero.php';
