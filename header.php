<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astroride
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'astroride' ); ?></a>

	<header class="header">

		<div class="header__container">

			<div class="header__wrapper">

				<div class="header__branding">
					<?php astroride_site_branding(); ?>
				</div>

				<?php get_template_part( 'template-parts/menu/menu', 'navigation' ); ?>

				<?php get_template_part( 'template-parts/menu/menu', 'mobile' ); ?>

				<?php get_template_part( 'template-parts/menu/menu', 'social' ); ?>

				<?php get_template_part( 'template-parts/header/header', 'search' ); ?>

			</div><!-- .header__wrapper -->

		</div><!-- .header__container -->

	</header><!-- .header -->

	<div class="content">
