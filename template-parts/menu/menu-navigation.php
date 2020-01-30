<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<nav id="site-navigation" class="header__navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'astroride' ); ?>">
		<button class="menu-toggle" aria-controls="primary-menu"><?php echo astroride_get_icon_svg( 'menu' ); ?></button>
		<div class="header__navigation-wrappper">
			<button class="menu-toggle close-toggle">
				<?php esc_html_e( 'Close menu', 'astroride' ); ?>
			</button>
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
		</div><!-- .header__navigation-wrappper -->
	</nav><!-- .header__navigation -->
<?php endif; ?>
