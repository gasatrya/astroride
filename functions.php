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

if ( ! function_exists( 'astroride_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function astroride_setup() {
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
		// set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'astroride' ),
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
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'astroride_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for custom color scheme.
		// add_theme_support( 'editor-color-palette', array(
		// 	array(
		// 		'name'  => esc_html__( 'Blue', 'astroride' ),
		// 		'slug'  => 'blue',
		// 		'color' => '#417cd6',
		// 	),
		// 	array(
		// 		'name'  => esc_html__( 'Dark Gray', 'astroride' ),
		// 		'slug'  => 'dark-gray',
		// 		'color' => '#383838',
		// 	),
		// 	array(
		// 		'name'  => esc_html__( 'Light Gray', 'astroride' ),
		// 		'slug'  => 'light-gray',
		// 		'color' => '#f9f9f9',
		// 	),
		// ) );

		// Add support for custom font sizes.
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' => esc_html__( 'Small', 'astroride' ),
				'size' => 14,
				'slug' => 'small'
			),
			array(
				'name' => esc_html__( 'Normal', 'astroride' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => esc_html__( 'Medium', 'astroride' ),
				'size' => 24,
				'slug' => 'medium'
			),
			array(
				'name' => esc_html__( 'Large', 'astroride' ),
				'size' => 36,
				'slug' => 'large'
			),
			array(
				'name' => esc_html__( 'Huge', 'astroride' ),
				'size' => 48,
				'slug' => 'huge'
			)
		) );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

	}
endif;
add_action( 'after_setup_theme', 'astroride_setup' );

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
	$GLOBALS['content_width'] = apply_filters( 'astroride_content_width', 640 );
}
add_action( 'after_setup_theme', 'astroride_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function astroride_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'astroride' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'astroride' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'astroride_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function astroride_scripts() {
	wp_enqueue_style( 'astroride-style', get_stylesheet_uri() );

	wp_enqueue_script( 'astroride-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), wp_get_theme()->get( 'Version' ), true );

	wp_enqueue_script( 'astroride-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'astroride_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

