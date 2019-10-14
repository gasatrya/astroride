<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'astroride' ); ?></a>

	<header class="header">

		<div class="header__left">

			<div class="header__branding">
				<?php astroride_site_branding(); ?>
			</div>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="header__navigation" aria-label="<?php esc_attr_e( 'Main Menu', 'astroride' ); ?>">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'astroride' ); ?></button>
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

		</div><!-- .header__left -->

		<div class="header__right">

			<?php if ( has_nav_menu( 'social' ) ) : ?>
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

		</div><!-- .header__right -->

	</header><!-- .header -->

	<div id="content" class="content">
