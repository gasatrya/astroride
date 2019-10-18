<?php
/**
 * _s Theme Customizer
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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'astroride_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'astroride_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'astroride_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function astroride_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function astroride_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * This function adds some styles to the WordPress Customizer
 */
function astroride_custom_customizer_style() { ?>
	<style>
		.customize-control {
			margin-bottom: 20px;
		}
		.select2-container .select2-selection--single {
			height: 30px;
		}
		.customize-control-kirki-radio-image .image label {
			width: 30%;
			line-height: 1;
			margin-right: 3%;
			margin-bottom: 2%;
		}
		.customize-control-kirki-radio-image input:checked + label img {
			box-shadow: none;
			border: none;
			outline: 2px solid #3498DB;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'astroride_custom_customizer_style', 999 );

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
