<?php
/**
 * Custom template tags for Astroride theme.
 */

if ( ! function_exists( 'astroride_site_branding' ) ) :
	/**
	 * Site branding for the site.
	 *
	 * Display site title by default, but user can change it with their custom logo.
	 * They can upload it on Customizer page.
	 */
	function astroride_site_branding() {

		// Get the logo.
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_url = wp_get_attachment_image_src( $logo_id , 'full' );

		// Check if logo available, then display it.
		if ( $logo_id ) :
			echo '<div class="header__logo">';
				echo '<a href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
					echo '<img src="' . esc_url( $logo_url[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
				echo '</a>' . "\n";
			echo '</div>' . "\n";

		// If not, then display the Site Title and Site Description.
		else :
			if ( is_front_page() && is_home() ) :
				echo '<h1 class="header__title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>'. "\n";
			else :
				echo '<p class="header__title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></p>'. "\n";
			endif;
			echo '<p class="header__tagline">' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '</p>'. "\n";
		endif;

	}
endif;
