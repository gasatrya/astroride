<?php
/**
 * Demo importer custom function
 * We use https://wordpress.org/plugins/one-click-demo-import/ to import our demo content
 */

// Disable branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * After import function
 */
function astroride_after_import_setup() {

	// Assign menus to their locations.
	$primary = get_term_by( 'name', 'Primary', 'nav_menu' );
	$social  = get_term_by( 'name', 'Social', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'menu-1'  => $primary->term_id,
		'social'  => $social->term_id
	) );

}
add_action( 'pt-ocdi/after_import', 'astroride_after_import_setup' );
