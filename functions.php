<?php
/**
 * Astroride functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astroride
 */

/**
 * Astroride only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function astroride_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on _s, use a find and replace
		* to change 'astroride' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'astroride', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1280, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'astroride' ),
		'social' => esc_html__( 'Social', 'astroride' ),
	) );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 320,
			'width'       => 190,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'astroride_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

}
add_action( 'after_setup_theme', 'astroride_theme_setup' );

/**
 * Block Editor Settings (Gutenberg).
 */
function astroride_block_editor() {

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style-editor.css' );

	// Add custom editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => esc_html__( 'Small', 'astroride' ),
				'shortName' => esc_html__( 'S', 'astroride' ),
				'size'      => 16,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Normal', 'astroride' ),
				'shortName' => esc_html__( 'M', 'astroride' ),
				'size'      => 20,
				'slug'      => 'normal',
			),
			array(
				'name'      => esc_html__( 'Large', 'astroride' ),
				'shortName' => esc_html__( 'L', 'astroride' ),
				'size'      => 24,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'astroride' ),
				'shortName' => esc_html__( 'XL', 'astroride' ),
				'size'      => 28,
				'slug'      => 'huge',
			),
		)
	);

	// Editor color palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Accent Color', 'astroride' ),
				'slug'  => 'accent',
				'color' => '#32a0e5',
			),
			array(
				'name'  => __( 'Primary', 'astroride' ),
				'slug'  => 'primary',
				'color' => '#35383a',
			),
			array(
				'name'  => __( 'Secondary', 'astroride' ),
				'slug'  => 'secondary',
				'color' => '#0f0f0f',
			),
			array(
				'name'  => __( 'Light Gray', 'astroride' ),
				'slug'  => 'light-gray',
				'color' => '#767676',
			),
			array(
				'name'  => __( 'White', 'astroride' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
		)
	);

}
add_action( 'after_setup_theme', 'astroride_block_editor' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function astroride_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'astroride_content_width', 1280 );
}
add_action( 'after_setup_theme', 'astroride_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function astroride_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'astroride-fonts', astroride_fonts_url(), array(), null );

	wp_enqueue_style( 'astroride-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'astroride-style', 'rtl', 'replace' );

	wp_enqueue_script( 'astroride-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '1.0.0', true );

	wp_enqueue_script( 'astroride-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0.0', true );

	wp_enqueue_script( 'astroride-custom-js', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'astroride_scripts' );

if ( ! function_exists( 'astroride_fonts_url' ) ) :
	/**
	 * Register Google fonts.
	 */
	function astroride_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Nunito, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Nunito font: on or off', 'astroride' ) ) {
			$fonts[] = 'Nunito:400,600,700,800';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Lora, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Lora font: on or off', 'astroride' ) ) {
			$fonts[] = 'Lora:400,400i,700,700i';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => urlencode( 'swap' ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/classes/class-svg-icons.php';
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Theme customizer.
 */
require get_template_directory() . '/inc/customizer.php';
