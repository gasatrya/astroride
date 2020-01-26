<?php
/**
 * TGM Plugin Lists
 */

/**
 * Register required and recommended plugins.
 */
function astroride_register_plugins() {

	$plugins = array(

		array(
			'name'     => 'Kirki',
			'slug'     => 'Kirki',
			'required' => false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'astroride_register_plugins' );
