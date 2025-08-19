<?php
/**
 * Newsreader functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsreader
 */

if ( ! class_exists( 'Newsreader' ) ) {
	/**
	 * Main Core Class
	 */
	class Newsreader {

		/**
		 * __construct
		 *
		 * This function will initialize the initialize
		 */
		public function __construct() {
			$this->init();
			$this->theme_files();
		}

		/**
		 * Init
		 */
		public function init() {
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		}

		/**
		 * Theme support
		 */
		public function theme_support() {
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'custom-logo' );
			add_theme_support( 'custom-header' );
			add_theme_support( 'custom-background' );
			add_editor_style();
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function theme_setup() {
			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on Newsreader, use a find and replace
			* to change 'newsreader' to the name of your theme in all the template files.
			*/
			load_theme_textdomain( 'newsreader', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
			add_theme_support( 'title-tag' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(
				array(
					'primary'        => esc_html__( 'Primary', 'newsreader' ),
					'bottombar'      => esc_html__( 'Header Bottombar', 'newsreader' ),
					'mobile'         => esc_html__( 'Mobile', 'newsreader' ),
					'mobile_bottom'  => esc_html__( 'Mobile Secondary', 'newsreader' ),
					'burger'         => esc_html__( 'Burger Menu', 'newsreader' ),
					'burger_bottom'  => esc_html__( 'Burger Secondary', 'newsreader' ),
					'footer_columns' => esc_html__( 'Footer Columns', 'newsreader' ),
					'footer'         => esc_html__( 'Footer', 'newsreader' ),
				)
			);

			/*
			* Switch default core markup for search form, comment form, comments, etc.
			* to output valid HTML5.
			*/
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				)
			);

			// Supported Appearance Tools.
			add_theme_support( 'custom-line-height' );
			add_theme_support( 'custom-spacing' );
			add_theme_support( 'custom-units' );
			add_theme_support( 'appearance-tools' );
			add_theme_support( 'border' );
			add_theme_support( 'link-color' );

			// Add support for responsive embeds.
			add_theme_support( 'responsive-embeds' );

			// Supported Formats.
			add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Add support for full and wide align images.
			add_theme_support( 'align-wide' );

			/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			*/
			add_theme_support( 'post-thumbnails' );

			// Register custom thumbnail sizes.
			add_image_size( 'csco-small', 72, 72, true );
			add_image_size( 'csco-small-2x', 144, 144, true );

			add_image_size( 'csco-thumbnail', 332, 186, true );
			add_image_size( 'csco-thumbnail-2x', 664, 372, true );
			add_image_size( 'csco-thumbnail-uncropped', 332, 0, false );
			add_image_size( 'csco-thumbnail-uncropped-2x', 664, 0, false );

			add_image_size( 'csco-medium', 688, 387, true );
			add_image_size( 'csco-medium-2x', 1376, 774, true );
			add_image_size( 'csco-medium-uncropped', 688, 0, false );

			add_image_size( 'csco-large', 1044, 587, true );
			add_image_size( 'csco-large-2x', 2088, 1174, true );
			add_image_size( 'csco-large-uncropped', 1044, 0, false );

			add_image_size( 'csco-extra-large', 1400, 650, true );
			add_image_size( 'csco-extra-large-2x', 2800, 1300, true );
			add_image_size( 'csco-extra-large-uncropped', 1400, 0, false );

			add_image_size( 'csco-fullwidth', 1920, 520, true );
			add_image_size( 'csco-fullwidth-2x', 3840, 1040, true );
			add_image_size( 'csco-fullwidth-uncropped', 1920, 0, false );
		}

		/**
		 * Include theme files
		 */
		public function theme_files() {
			require_once get_theme_file_path( '/inc/deprecated.php' );
			require_once get_theme_file_path( '/inc/elementor.php' );
			require_once get_theme_file_path( '/inc/theme-setup.php' );
			require_once get_theme_file_path( '/core/theme-dashboard/class-theme-dashboard.php' );
			require_once get_theme_file_path( '/core/theme-demos/class-theme-demos.php' );
			require_once get_theme_file_path( '/core/customizer/class-customizer.php' );
			require_once get_theme_file_path( '/core/promo-banner/class-promo-banner.php' );
			require_once get_theme_file_path( '/inc/assets.php' );
			require_once get_theme_file_path( '/inc/widgets-init.php' );
			require_once get_theme_file_path( '/inc/theme-functions.php' );
			require_once get_theme_file_path( '/inc/theme-demos.php' );
			require_once get_theme_file_path( '/inc/theme-mods.php' );
			require_once get_theme_file_path( '/inc/filters.php' );
			require_once get_theme_file_path( '/inc/gutenberg.php' );
			require_once get_theme_file_path( '/inc/actions.php' );
			require_once get_theme_file_path( '/inc/partials.php' );
			require_once get_theme_file_path( '/inc/theme-tags.php' );
			require_once get_theme_file_path( '/inc/post-meta.php' );
			require_once get_theme_file_path( '/inc/load-more.php' );
			require_once get_theme_file_path( '/inc/load-nextpost.php' );
			require_once get_theme_file_path( '/inc/mega-menu.php' );
			require_once get_theme_file_path( '/inc/custom-menu.php' );
			require_once get_theme_file_path( '/inc/custom-content.php' );
			require_once get_theme_file_path( '/inc/metabox.php' );
		}
	}

	// Initialize.
	new Newsreader();
}
