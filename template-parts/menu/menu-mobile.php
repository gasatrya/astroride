<?php if ( has_nav_menu( 'mobile' ) ) : ?>
	<nav class="mobile-navigation">

		<button class="menu-toggle close-toggle">
			<?php esc_html_e( 'Close menu', 'astroride' ); ?>
		</button>

		<div class="mobile-navigation__wrappper">

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'mobile',
					'menu_class'      => 'mobile-navigation__items',
					'menu_id'         => 'mobile-navigation__items',
					'container'       => false
				)
			);
			?>

		<form class="mobile-navigation__search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input class="mobile-navigation__search-field" type="search" name="search-mobile" id="search-mobile" placeholder="<?php echo esc_attr_x( 'Press enter to search &hellip;', 'placeholder', 'astroride' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>" title="<?php echo esc_attr_x( 'Search for:', 'label', 'astroride' ) ?>">
		</form>

		</div><!-- .header__navigation-wrappper -->
	</nav><!-- .header__navigation -->
<?php endif; ?>
