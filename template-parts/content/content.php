<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */

// Home layout.
$home_layout = get_theme_mod( 'home_layout', 'list' );
$image_size = 'medium';

if ( $home_layout == 'standard' ) {
	$image_size = 'astroride-first-post';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post__wrapper">

		<figure class="post__thumbnail-wrapper">
			<?php astroride_post_thumbnail( $image_size ); ?>
		</figure>

		<div class="post__excerpt-wrapper">

			<?php
				the_title( '<h2 class="post__title-h2"><a class="post__title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="post__meta">
					<?php astroride_posted_on(); ?>
					<?php astroride_post_category(); ?>
				</div>
			<?php endif; ?>

			<div class="post__excerpt">
				<?php the_excerpt(); ?>
			</div>

			<footer class="post__readmore">
				<?php
					$readmore = sprintf(
						esc_html__( 'Continue Reading %s', 'astroride' ),
						astroride_get_icon_svg( 'chevron_right' )
					);

					echo '<a class="post__readmore-link" href="' . esc_url( get_permalink() ) . '">' . $readmore . '</a>';
				?>
			</footer>

		</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
