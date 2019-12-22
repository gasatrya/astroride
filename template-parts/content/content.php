<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post__wrapper">

		<div class="post__excerpt-wrapper">

			<?php
				the_title( '<h2 class="post__title-h2"><a class="post__title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

			<div class="post__excerpt">
				<?php the_excerpt(); ?>
			</div>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="post__meta">
					<?php astroride_posted_by(); ?>
					<?php astroride_posted_on(); ?>
					<?php astroride_post_category(); ?>
					<?php astroride_post_readmore(); ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
