<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<nav class="header__navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'astroride' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_class'     => 'menu',
				'container'      => false,
			)
		);
		?>
	</nav><!-- .header__navigation -->
<?php endif; ?>
