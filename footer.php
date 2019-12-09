<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astroride
 */

?>

	</div><!-- .content -->

	<?php
	// Instagram shortcode.
	$shortcode = get_theme_mod( 'instagram' );
	if ( $shortcode ) :
	?>
		<div class="instagram">
			<?php echo do_shortcode( esc_html( $shortcode ) ); ?>
		</div>
	<?php endif; ?>

	<footer class="footer">
		<div class="footer__container">

			<div class="footer__wrapper">

				<div class="footer__copyright">
					<?php
						printf( esc_html__( '&copy; Copyright %1$s %2$s. All Rights Reserved', 'astroride' ),
							date( 'Y' ),
							'<a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>'
						);
					?>
				</div>

				<div class="footer__social">
					<?php get_template_part( 'template-parts/menu/menu', 'social' ); ?>
				</div>

				<div class="footer__designer">
					<?php astroride_footer_text(); ?>
				</div>

			</div>

		</div>
	</footer><!-- #colophon -->

</div><!-- .site -->

<?php astroride_back_to_top(); ?>

<?php wp_footer(); ?>

</body>
</html>
