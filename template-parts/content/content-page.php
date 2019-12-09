<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post__header">
		<?php the_title( '<h1 class="post__title-h1">', '</h1>' ); ?>
	</header>

	<figure class="post__featured-wrapper">
		<?php astroride_post_thumbnail( 'large' ); ?>
	</figure>

	<div class="post__content">
		<div class="post__content-row">

			<div class="post__content-main">

				<article class="post__content-article">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'astroride' ),
						'after'  => '</div>',
					) );
					?>
				</article><!-- .post__content-article -->

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			</div><!-- .post__content-main -->

			<?php get_sidebar(); // get sidebar. ?>

		</div>
	</div>

</div><!-- #post-<?php the_ID(); ?> -->
