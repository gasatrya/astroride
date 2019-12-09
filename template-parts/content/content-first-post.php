<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post__first' ); ?>>
	<div class="post__first-wrapper">

		<figure class="post__first-thumbnail-wrapper">
			<?php astroride_post_thumbnail( 'astroride-first-post' ); ?>
		</figure>

		<div class="post__first-excerpt-wrapper">

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
