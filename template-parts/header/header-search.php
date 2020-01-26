<div class="header__search">

	<?php
		$astroride_search = get_theme_mod( 'astroride_search_icon', true );
		if ( true == $astroride_search ) :
	?>
		<a class="header__search-link" href="#"><?php echo astroride_get_icon_svg( 'search' ); ?></a>
	<?php endif; ?>

	<div class="header__search-form-wrapper">
		<form class="header__search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input class="header__search-field" type="search" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Press enter to search &hellip;', 'placeholder', 'astroride' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>" title="<?php echo esc_attr_x( 'Search for:', 'label', 'astroride' ) ?>">
		</form>
	</div>

</div>
