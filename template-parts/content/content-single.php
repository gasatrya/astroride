<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */

// Vars
$img     = get_theme_mod( 'post_featured_image', true );
$meta    = get_theme_mod( 'post_meta', true );
$footer  = get_theme_mod( 'post_footer', true );
$comment = get_theme_mod( 'post_comment', true );
$switch  = get_theme_mod( 'post_switch_related', 'related' );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post__header">
		<?php the_title( '<h1 class="post__title-h1">', '</h1>' ); ?>
		<?php if ( true == $meta ) : ?>
			<div class="post__meta">
				<?php astroride_posted_on(); ?>
				<?php astroride_post_category(); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( true == $img ) : ?>
		<figure class="post__featured-wrapper">
			<?php astroride_post_thumbnail( 'large' ); ?>
		</figure>
	<?php endif; ?>

	<div class="post__content">
		<div class="post__content-row">

			<div class="post__content-main">

				<article class="post__content-article">
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
				</article><!-- .post__content-article -->

				<?php if ( true == $footer ) : ?>
					<div class="post__footer">
						<?php astroride_posted_by(); ?>
						<?php astroride_share_buttons(); ?>
					</div><!-- .post__footer -->
				<?php endif; ?>

				<?php astroride_post_author_box(); ?>

				<?php
				// Check if comment enable on customizer
				if ( true == $comment ) :
					// If enable and comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				endif;
				?>

			</div><!-- .post__content-main -->

			<?php
			if ( 'related' == $switch ) {
				astroride_related_posts(); // get the related posts.
			} else {
				get_sidebar(); // get sidebar.
			}
			?>

		</div>
	</div>

</div><!-- #post-<?php the_ID(); ?> -->
