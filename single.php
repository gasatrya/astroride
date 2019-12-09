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
		<main class="content__main-page">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'single' );

			endwhile; // End of the loop.
			?>

			<?php astroride_next_prev_post(); ?>

		</main><!-- .content__main -->
	</div><!-- .content__container -->

<?php
get_footer();
