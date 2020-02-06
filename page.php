<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

					get_template_part( 'template-parts/content/content', 'page' );

				endwhile; // End of the loop.
				?>

			</main><!-- .content__main -->
		</div><!-- .content__row -->
	</div><!-- .content__container -->

<?php
get_footer();
