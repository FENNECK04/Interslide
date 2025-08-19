<?php
/**
 * Assets
 *
 * All enqueues of scripts and styles.
 *
 * @package Newsreader
 */

if ( ! function_exists( 'csco_content_width' ) ) {
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function csco_content_width() {
		/**
		 * The csco_content_width hook.
		 *
		 * @since 1.0.0
		 */
		$GLOBALS['content_width'] = apply_filters( 'csco_content_width', 1200 );
	}
}
add_action( 'after_setup_theme', 'csco_content_width', 0 );

if ( ! function_exists( 'csco_enqueue_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function csco_enqueue_scripts() {

		$version = csco_get_theme_data( 'Version' );

		// Register theme scripts.
		wp_register_script( 'csco-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), $version, true );

		// Localization array.
		$localize = array(
			'siteSchemeMode'   => get_theme_mod( 'color_scheme', 'system' ),
			'siteSchemeToogle' => get_theme_mod( 'color_scheme_toggle', true ),
		);

		// Localize the main theme scripts.
		wp_localize_script( 'csco-scripts', 'csLocalize', $localize );

		// Enqueue theme scripts.
		wp_enqueue_script( 'csco-scripts' );

		// Enqueue comment reply script.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );

			wp_register_script( 'csco-comment-reply', get_template_directory_uri() . '/assets/static/js/comment-reply.js', array(), $version, true );
			wp_enqueue_script( 'csco-comment-reply' );
		}

		wp_register_script( 'csco-swiper', get_template_directory_uri() . '/assets/static/js/swiper-bundle.min.js', array(), $version, true );
		wp_enqueue_script( 'csco-swiper' );

		wp_dequeue_script( sprintf( '%s-reply', 'comment' ) );

                // Enqueue theme styles early to prevent missing CSS on fresh installs.
                $style_uri = csco_style( get_stylesheet_uri() );
                wp_enqueue_style( 'csco-styles', $style_uri, array(), $version );

		// Add RTL support.
		wp_style_add_data( 'csco-styles', 'rtl', 'replace' );

		// Enqueue typography styles.
		csco_enqueue_typography_styles( 'csco-styles' );

		// Dequeue Contact Form 7 styles.
		wp_dequeue_style( 'contact-form-7' );
	}
}
add_action( 'wp_enqueue_scripts', 'csco_enqueue_scripts', 99 );
