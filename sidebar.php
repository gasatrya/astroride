<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astroride
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

// Return early if user uses 1 column layout.
if ( in_array( get_theme_mod( 'theme_layout' ), array( 'full-width' ) ) ) {
	return;
}
?>

<aside class="content__sidebar">
	<div class="content__sidebar-wrapper">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- .content__sidebar -->
