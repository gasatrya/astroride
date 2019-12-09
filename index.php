<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Astroride
 */

get_header();
?>

	<?php
	// Home layout.
	$home_layout = get_theme_mod( 'home_layout', 'list' );
	?>

	<div class="content__container">
		<div class="content__row">
			<main class="content__main content__main-<?php echo esc_html( $home_layout ); ?>">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :

					the_post();

					if ( $wp_query->current_post === 0 ) :
						get_template_part( 'template-parts/content/content', 'first-post' );
					else :
						get_template_part( 'template-parts/content/content', get_post_type() );
					endif;

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content/content', 'none' );

			endif;
			?>

			</main><!-- .content__main -->

			<?php get_sidebar(); // get sidebar.php ?>

		</div><!-- .content__row -->
	</div><!-- .content__container -->

<?php
get_footer();
