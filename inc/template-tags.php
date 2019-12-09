<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Astroride
 */

if ( ! function_exists( 'astroride_site_branding' ) ) :
	/**
	 * Site branding for the site.
	 *
	 * Display site title by default, but user can change it with their custom logo.
	 * They can upload it on Customizer page.
	 */
	function astroride_site_branding() {

		// Get the logo.
		$logo_id  = get_theme_mod( 'custom_logo' );
		$logo_url = wp_get_attachment_image_src( $logo_id , 'full' );

		// Retina logo
		$retina_id  = get_theme_mod( 'retina_logo' );
		$retina_url = wp_get_attachment_image_src( $retina_id , 'full' );

		// Check if logo available, then display it.
		if ( $logo_id ) :
			echo '<div class="header__logo">';
				echo '<a class="header__logo-link" href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
					if ( empty( $retina_id ) ):
						echo '<img class="header__logo-img" src="' . esc_url( $logo_url[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
					else :
						echo '<img class="header__logo-img"
						      srcset="' . esc_url( $retina_url[0] ) . ' 2x"
						      src="' . esc_url( $logo_url[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
					endif;
				echo '</a>' . "\n";
			echo '</div>' . "\n";

		// If not, then display the Site Title and Site Description.
		else :
			if ( is_front_page() && is_home() ) :
				echo '<h1 class="header__title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>'. "\n";
			else :
				echo '<p class="header__title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></p>'. "\n";
			endif;
			echo '<p class="header__tagline">' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '</p>'. "\n";
		endif;

	}
endif;

if ( ! function_exists( 'astroride_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function astroride_posted_on() {
		$time_string = '<time class="post__date-time published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="post__date-time published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a class="post__date-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="post__date">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'astroride_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function astroride_posted_by() {
		$avatar = '<span class="post__author-avatar">' . get_avatar( get_the_author_meta( 'ID' ), 32 ) . '</span>';
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'astroride' ),
			'<span class="post__author-vcard"><a class="post__author-link url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$author = $avatar . '<span class="post__author-byline">' . $byline . '</span>';

		echo '<span class="post__author">' . $author . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'astroride_post_category' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function astroride_post_category() {

		// Hide category for pages.
		if ( 'post' !== get_post_type() ) {
			return;
		}

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'astroride' ) );

		if ( $categories_list ) {
			echo '<span class="post__categories">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}

	}
endif;

if ( ! function_exists( 'astroride_post_tags' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function astroride_post_tags() {

		// Hide category for pages.
		if ( 'post' !== get_post_type() ) {
			return;
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'astroride' ) );

		if ( $tags_list ) {
			echo '<span class="post__tags">' . $tags_list . '</span>'; // WPCS: XSS OK.
		}

	}
endif;

if ( ! function_exists( 'astroride_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function astroride_entry_footer() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'astroride' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

	}
endif;

if ( ! function_exists( 'astroride_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function astroride_post_thumbnail( $size = 'medium' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post__featured">
				<?php
				the_post_thumbnail( $size, array(
					'class' => 'post__featured-img',
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
				?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post__thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( $size, array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'astroride_related_posts' ) ) :
	/**
	 * Related posts for single post
	 */
	function astroride_related_posts() {

		// Get the data set in customizer
		$related = get_theme_mod( 'post_related', true );
		$number  = get_theme_mod( 'post_related_number', 3 );

		// Disable if user choose it.
		if ( true != $related ) {
			return;
		}

		if ( !is_single() ) {
			return;
		}

		// Get the taxonomy terms of the current page for the specified taxonomy.
		$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

		// Bail if the term empty.
		if ( empty( $terms ) ) {
			return;
		}

		// Posts query arguments.
		$query = array(
			'post__not_in' => array( get_the_ID() ),
			'tax_query'    => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $terms,
					'operator' => 'IN'
				)
			),
			'posts_per_page' => (int)$number,
			'post_type'      => 'post',
		);

		// Allow dev to filter the query.
		$args = apply_filters( 'astroride_related_posts_args', $query );

		// The post query
		$related = new WP_Query( $args );

		if ( $related->have_posts() ) : ?>

			<aside class="post__related">
				<div class="post__related-wrapper">

					<h3 class="post__related-header"><?php esc_html_e( 'Related Posts', 'astroride' ); ?></h3>

					<div class="post__related-items">

						<?php while ( $related->have_posts() ) : $related->the_post(); ?>

							<article class="post__related-item">

								<figure class="post__related-img">
									<a class="post__related-img-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
										<?php
										the_post_thumbnail( 'medium', array(
											'alt' => the_title_attribute( array(
												'echo' => false,
											) ),
										) );
										?>
									</a>
								</figure>

								<div class="post__related-content">

									<?php
										the_title( '<a class="post__related-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
									?>

									<div class="post__meta">
										<?php astroride_posted_on(); ?>
									</div>

								</div>

							</article><!-- .post__related-item -->

						<?php endwhile; ?>

					</div>

				</div>
			</aside>

		<?php endif;

		// Restore original Post Data.
		wp_reset_postdata();

	}
endif;

if ( ! function_exists( 'astroride_share_buttons' ) ) :
	/**
	 * Social Share Buttons
	 */
	function astroride_share_buttons() { ?>
		<div class="post__share">
			<div class="post__share-title screen-reader-text"><?php esc_html_e( 'Share:', 'astroride' ); ?></div>
			<div class="post__share-items">
				<a class="post__share-item" href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>&url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><?php echo astroride_get_social_icon_svg( 'twitter' ); ?></a>
				<a class="post__share-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><?php echo astroride_get_social_icon_svg( 'facebook' ); ?></a>
				<a class="post__share-item" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><?php echo astroride_get_social_icon_svg( 'linkedin' ); ?></a>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'astroride_featured_posts' ) ) :
	/**
	 * Featured Posts
	 */
	function astroride_featured_posts() {

		// On home page only.
		if ( !is_home() ) {
			return;
		}

		// Get the customizer data
		$enable = get_theme_mod( 'featured_enable', 1 );

		// Return early if disabled
		if ( !$enable ) {
			return;
		}

		// Main post query
		$query = array(
			'post_type'           => 'post',
			'posts_per_page'      => 3,
		);

		// Get the sticky post ids
		$sticky = get_option( 'sticky_posts' );

		// Get the tag id
		$tag_id = get_theme_mod( 'featured_tag', 'featured' );

		// Set an empty variable
		$term = '';

		if ( $tag_id ) {
			$term = get_term_by( 'name', $tag_id, 'post_tag' );
		}

		// Adds the custom arguments to the main query
		if ( $term ) {
			$query['tag_id'] = $term->term_id;
		} else {
			$query['post__in'] = $sticky;
		}

		// Allow dev to filter the query.
		$query = apply_filters( 'astroride_featured_posts_args', $query );

		// Perform query
		$featured = new WP_Query( $query );

		// Wrapper classes
		$wrap_classes = array( 'featured' );
		$wrap_classes = implode( ' ', $wrap_classes ); ?>

		<?php if ( $featured->have_posts() ) : ?>

			<div class="<?php echo esc_attr( $wrap_classes ); ?>">
				<div class="featured__container">
					<div class="featured__wrapper">

						<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

							<?php $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>

							<?php if ( $featured->current_post == 0 ) : ?>

								<div class="featured__big">

									<article class="featured__post featured__post-big" style="background-image: url('<?php echo esc_url( $featured_img_url ); ?>');">
										<a class="featured__post-link" href="<?php the_permalink(); ?>"></a>
										<div class="featured__content">
											<?php the_title( '<h2 class="featured__title"><a class="featured__title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
											<div class="post__meta">
												<?php astroride_posted_on(); ?>
												<?php astroride_post_category(); ?>
											</div>
										</div>
									</article>

								</div>

								<div class="featured__small">
							<?php else : ?>

									<article class="featured__post featured__post-small" style="background-image: url('<?php echo esc_url( $featured_img_url ); ?>');">
										<a class="featured__post-link" href="<?php the_permalink(); ?>"></a>
										<div class="featured__content">
											<?php the_title( '<h2 class="featured__title"><a class="featured__title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
											<div class="post__meta">
												<?php astroride_posted_on(); ?>
												<?php astroride_post_category(); ?>
											</div>
										</div>
									</article>

							<?php endif; ?>

						<?php endwhile; ?>

							</div><!-- .featured__small -->

					</div>
				</div>
			</div>

		<?php endif; wp_reset_postdata(); ?>

		<?php

	}
endif;

if ( ! function_exists( 'astroride_post_author_box' ) ) :
	/**
	 * Author post informations.
	 */
	function astroride_post_author_box() {

		// Get the data from Customizer
		$show = get_theme_mod( 'post_author_box', true );

		if ( true != $show ) {
			return;
		}

		// Bail if not on the single post.
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		// Bail if user hasn't fill the Biographical Info field.
		if ( ! get_the_author_meta( 'description' ) ) {
			return;
		}

		// Get the author social information.
		$url       = get_the_author_meta( 'url' );
		$twitter   = get_the_author_meta( 'twitter' );
		$facebook  = get_the_author_meta( 'facebook' );
		$instagram = get_the_author_meta( 'instagram' );
		$pinterest = get_the_author_meta( 'pinterest' );
		$linkedin  = get_the_author_meta( 'linkedin' );
		$dribbble  = get_the_author_meta( 'dribbble' );
	?>

		<div class="author-bio">

			<div class="author-bio__avatar">
				<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'astroride_author_bio_avatar_size', 90 ), '', strip_tags( get_the_author() ) ); ?>
			</div>

			<div class="author-bio__details">

				<h3 class="author-bio__name">
					<a class="author-bio__name-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo strip_tags( get_the_author() ); ?></a>
				</h3>

				<p class="author-bio__desc">
					<?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?>
				</p>

				<?php if ( $url || $twitter || $facebook || $gplus || $instagram || $pinterest || $linkedin || $dribbble ) : ?>
					<div class="author-bio__social">
						<?php if ( $url ) { ?>
							<a class="author-bio__social-link website" href="<?php echo esc_url( $url ); ?>"><?php echo astroride_get_icon_svg( 'link' ); ?></a>
						<?php } ?>
						<?php if ( $twitter ) { ?>
							<a class="author-bio__social-link twitter" href="<?php echo esc_url( $twitter ); ?>"><?php echo astroride_get_social_icon_svg( 'twitter' ); ?></a>
						<?php } ?>
						<?php if ( $facebook ) { ?>
							<a class="author-bio__social-link facebook" href="<?php echo esc_url( $facebook ); ?>"><?php echo astroride_get_social_icon_svg( 'facebook' ); ?></a>
						<?php } ?>
						<?php if ( $instagram ) { ?>
							<a class="author-bio__social-link instagram" href="<?php echo esc_url( $instagram ); ?>"><?php echo astroride_get_social_icon_svg( 'instagram' ); ?></a>
						<?php } ?>
						<?php if ( $pinterest ) { ?>
							<a class="author-bio__social-link pinterest" href="<?php echo esc_url( $pinterest ); ?>"><?php echo astroride_get_social_icon_svg( 'pinterest' ); ?></a>
						<?php } ?>
						<?php if ( $linkedin ) { ?>
							<a class="author-bio__social-link linkedin" href="<?php echo esc_url( $linkedin ); ?>"><?php echo astroride_get_social_icon_svg( 'linkedin' ); ?></a>
						<?php } ?>
						<?php if ( $dribbble ) { ?>
							<a class="author-bio__social-link dribbble" href="<?php echo esc_url( $dribbble ); ?>"><?php echo astroride_get_social_icon_svg( 'dribbble' ); ?></a>
						<?php } ?>
					</div>
				<?php endif; ?>

			</div>

		</div><!-- .author-bio -->

	<?php
	}
endif;

if ( ! function_exists( 'astroride_next_prev_post' ) ) :
	/**
	 * Custom next post link
	 */
	function astroride_next_prev_post() {

		// Get the data set in customizer
		$nav = get_theme_mod( 'post_navigation', true );

		if ( true != $nav ) {
			return;
		}

		// Display on single post page.
		if ( ! is_single() ) {
			return;
		}

		// Get the next and previous post id.
		$next = get_adjacent_post( false, '', false );
		$prev = get_adjacent_post( false, '', true );
	?>
		<div class="post-pagination">
			<div class="post-pagination__wrapper">

				<?php if ( $prev ) : ?>
					<div class="post-pagination__prev">

						<?php if ( has_post_thumbnail( $prev->ID ) ) : ?>
							<a class="post-pagination__link" href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>"><?php echo get_the_post_thumbnail( $prev->ID, 'thumbnail', array( 'class' => 'post-pagination__img', 'alt' => esc_attr( get_the_title( $prev->ID ) ) ) ) ?></a>
						<?php endif; ?>

						<div class="post-pagination__detail">
							<span><?php esc_html_e( 'Previous Post', 'astroride' ); ?></span>
							<a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="post-pagination__title"><?php echo esc_attr( get_the_title( $prev->ID ) ); ?></a>
						</div>

					</div>
				<?php endif; ?>

				<?php if ( $next ) : ?>
					<div class="post-pagination__next">

						<?php if ( has_post_thumbnail( $next->ID ) ) : ?>
							<a class="post-pagination__link" href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"><?php echo get_the_post_thumbnail( $next->ID, 'thumbnail', array( 'class' => 'post-pagination__img', 'alt' => esc_attr( get_the_title( $next->ID ) ) ) ) ?></a>
						<?php endif; ?>

						<div class="post-pagination__detail">
							<span><?php esc_html_e( 'Next Post', 'astroride' ); ?></span>
							<a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="post-pagination__title"><?php echo esc_attr( get_the_title( $next->ID ) ); ?></a>
						</div>

					</div>
				<?php endif; ?>

			</div>
		</div>
	<?php
	}
endif;

if ( ! function_exists( 'astroride_footer_text' ) ) :
	/**
	 * Footer Text
	 */
	function astroride_footer_text() {

		// Get the customizer data
		$default = 'Site by <a href="https://www.happythemes.com">HappyThemes</a>';
		$footer_text = get_theme_mod( 'copyrights_text', $default );

		// Display the data
		echo '<p class="copyright">' . wp_kses_post( $footer_text ) . '</p>';

	}
endif;

if ( ! function_exists( 'astroride_back_to_top' ) ) :
	/**
	 * Back to top button.
	 */
	function astroride_back_to_top() {

		// Get the customizer data.
		if ( true == get_theme_mod( 'backtotop', true )  ) : ?>

			<a href="#" class="back-to-top" title="<?php esc_html_e( 'Back to top', 'astroride' ); ?>">
				<?php echo astroride_get_icon_svg( 'expand_less' ); ?>
			</a>

		<?php endif; ?>

	<?php
	}
endif;
