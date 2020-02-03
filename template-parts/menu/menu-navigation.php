<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<nav id="site-navigation" class="header__navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'astroride' ); ?>">
		<button class="menu-toggle" aria-controls="primary-menu"><?php echo astroride_get_icon_svg( 'menu' ); ?></button>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'menu-1',
				'menu_class'      => 'menu',
				'menu_id'         => 'primary-menu',
				'container'       => false
			)
		);
		?>
	</nav><!-- .header__navigation -->
<?php endif; ?>
