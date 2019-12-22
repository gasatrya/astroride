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

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post__featured-wrapper">
			<?php astroride_post_thumbnail( 'post-thumbnail' ); ?>
		</figure>
	<?php endif; ?>

	<header class="post__header">
		<?php the_title( '<h1 class="post__title-h1">', '</h1>' ); ?>
	</header>

	<div class="post__content">

		<div class="post__content-article">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'astroride' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'astroride' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .post__content-article -->

	</div><!-- .post__content -->

</article><!-- #post-<?php the_ID(); ?> -->
