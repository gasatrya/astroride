<?php
$hero_enable     = get_theme_mod( 'astroride_hero', '0' );
$hero_title      = get_theme_mod( 'astroride_hero_title' );
$hero_tagline    = get_theme_mod( 'astroride_hero_tagline' );
$hero_type       = get_theme_mod( 'astroride_hero_type', 'color' );
$hero_img        = get_theme_mod( 'astroride_hero_image' );
$hero_img        = wp_get_attachment_image_src( $hero_img , 'full' );
$hero_text_align = get_theme_mod( 'astroride_hero_text_alignment', 'left' );
$hero_text_align = 'text-' . $hero_text_align;

if ( !$hero_enable ) {
	return;
}
?>
<div class="hero <?php echo sanitize_html_class( $hero_text_align ); ?>" <?php if ( $hero_type == 'image' && !empty ( $hero_img ) ) echo 'style="background-image: url( \'' . esc_url( $hero_img[0] ) . '\');"'?>>
	<div class="hero__container">
		<div class="hero__wrapper">

			<div class="hero__title"><?php echo wp_kses_post( $hero_title ); ?></div>
			<div class="hero__tagline"><?php echo wp_kses_post( $hero_tagline ); ?></div>

		</div>
	</div>
</div>
