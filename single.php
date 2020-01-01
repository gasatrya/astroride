<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astroride
 */

get_header();
?>

	<div class="content__container">
		<div class="content__row">
			<main class="content__main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', 'single' );

				endwhile; // End of the loop.
				?>

				<?php astroride_post_next_prev(); // Next Prev post. ?>

				<?php astroride_post_author_box(); // Post author profile. ?>

				<?php
				// If enable and comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
				?>

				<?php // astroride_next_prev_post(); ?>

			</main><!-- .content__main -->
		</div><!-- .content__row -->
	</div><!-- .content__container -->

<?php
get_footer();
