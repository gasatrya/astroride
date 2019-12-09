<?php
	$social = get_theme_mod( 'social_icons', true );
?>

<?php if ( $social == true && has_nav_menu( 'social' ) ) : ?>
	<nav class="header__social" aria-label="<?php esc_attr_e( 'Social Links Menu', 'astroride' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'menu_class'     => 'social-menu',
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>' . astroride_get_icon_svg( 'link' ),
				'depth'          => 1,
				'container'      => false
			)
		);
		?>
	</nav><!-- .header__social -->
<?php endif; ?>
