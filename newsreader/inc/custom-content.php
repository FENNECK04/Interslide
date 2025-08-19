<?php
/**
 * Additional Content.
 *
 * @package Newsreader
 */

/**
 * Define array of Additional Content Locations
 */
function csco_get_custom_content_locations() {
	$content = array(
		array(
			'slug'     => 'header',
			'name'     => esc_html__( 'Header', 'newsreader' ),
			'template' => array( 'home', 'front_page', 'single', 'page', 'archive' ),
		),
		array(
			'slug'     => 'site_content',
			'name'     => esc_html__( 'Site Content', 'newsreader' ),
			'template' => array( 'home', 'front_page', 'single', 'page', 'archive' ),
		),
		array(
			'slug'     => 'main',
			'name'     => esc_html__( 'Main', 'newsreader' ),
			'template' => array( 'home', 'front_page', 'single', 'page', 'archive' ),
		),
		array(
			'slug'     => 'post',
			'name'     => esc_html__( 'Post', 'newsreader' ),
			'template' => array( 'single' ),
		),
		array(
			'slug'     => 'post_content',
			'name'     => esc_html__( 'Post Content', 'newsreader' ),
			'template' => array( 'single' ),
		),
		array(
			'slug'     => 'page',
			'name'     => esc_html__( 'Page', 'newsreader' ),
			'template' => array( 'page' ),
		),
		array(
			'slug'     => 'page_content',
			'name'     => esc_html__( 'Page Content', 'newsreader' ),
			'template' => array( 'page' ),
		),
		array(
			'slug'     => 'author',
			'name'     => esc_html__( 'Post Author', 'newsreader' ),
			'template' => array( 'single' ),
		),
		array(
			'slug'     => 'pagination',
			'name'     => esc_html__( 'Post Pagination', 'newsreader' ),
			'template' => array( 'single' ),
		),
		array(
			'slug'     => 'comments',
			'name'     => esc_html__( 'Comments', 'newsreader' ),
			'template' => array( 'single', 'page' ),
		),
		array(
			'slug'     => 'footer',
			'name'     => esc_html__( 'Footer', 'newsreader' ),
			'template' => array( 'home', 'front_page', 'single', 'page', 'archive' ),
		),
	);
	return apply_filters( 'csco_custom_content_locations', $content );
}

/**
 * Define array of Additional Content Pages
 */
function csco_get_custom_content_pages() {
	$pages = array(
		'home'       => esc_html__( 'Homepage', 'newsreader' ),
		'front_page' => esc_html__( 'Front Page', 'newsreader' ),
		'single'     => esc_html__( 'Post', 'newsreader' ),
		'page'       => esc_html__( 'Page', 'newsreader' ),
		'archive'    => esc_html__( 'Archive', 'newsreader' ),
	);
	return $pages;
}

/**
 * Init Additional Content
 */
function csco_init_custom_content() {

	$locations = csco_get_custom_content_locations();
	$pages     = csco_get_custom_content_pages();

	/**
	 * Customizer Settings
	 */

	CSCO_Customizer::add_panel(
		'custom_content', array(
			'title'    => esc_html__( 'Additional Content', 'newsreader' ),
			'priority' => 200,
		)
	);

	CSCO_Customizer::add_section(
		'custom_content_general', array(
			'title' => esc_html__( 'General', 'newsreader' ),
			'panel' => 'custom_content',
		)
	);

	CSCO_Customizer::add_field(
		array(
			'type'        => 'checkbox',
			'settings'    => 'custom_content_adsense',
			'label'       => esc_html__( 'Load Google AdSense Scripts', 'newsreader' ),
			'description' => esc_html__( 'Enable this if you\'re using Google AdSense.', 'newsreader' ),
			'section'     => 'custom_content_general',
			'default'     => false,
		)
	);

	foreach ( $pages as $page_slug => $page_name ) {

		CSCO_Customizer::add_section(
			'custom_content_' . $page_slug, array(
				'title' => $page_name,
				'panel' => 'custom_content',
			)
		);

		foreach ( $locations as $location ) {

			// Check if ads location is supported by the current page template.
			if ( in_array( $page_slug, $location['template'], true ) ) {

				CSCO_Customizer::add_field(
					array(
						'type'              => 'textarea',
						'settings'          => 'custom_content_' . $page_slug . '_' . $location['slug'] . '_before',
						'label'             => esc_html__( 'Before', 'newsreader' ) . ' ' . $location['name'],
						'section'           => 'custom_content_' . $page_slug,
						'default'           => '',
						'sanitize_callback' => 'csco_unsanitize',
					)
				);

				CSCO_Customizer::add_field(
					array(
						'type'              => 'textarea',
						'settings'          => 'custom_content_' . $page_slug . '_' . $location['slug'] . '_after',
						'label'             => esc_html__( 'After', 'newsreader' ) . ' ' . $location['name'],
						'section'           => 'custom_content_' . $page_slug,
						'default'           => '',
						'sanitize_callback' => 'csco_unsanitize',
					)
				);
			}
		}
	}

	/**
	 * Removes Sanitizing
	 *
	 * @param string $content Initial content.
	 */
	function csco_unsanitize( $content ) {
		return $content;
	}

	/**
	 * Load Google AdSense scripts
	 */
	function csco_custom_content_enqueue_scripts() {

		if ( get_theme_mod( 'custom_content_adsense', false ) ) {
			// Register Google AdSense scripts.
			wp_register_script( 'csco_adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js' );

			// Enqueue Google AdSense.
			wp_enqueue_script( 'csco_adsense' );

		}
	}
	add_action( 'wp_enqueue_scripts', 'csco_custom_content_enqueue_scripts' );

	/**
	 * Actions
	 */
	function csco_custom_content_display() {

		// Get current action name.
		$current = current_filter();

		// Get ads pages.
		$pages = csco_get_custom_content_pages();

		foreach ( $pages as $page_slug => $page_name ) {

			$location = "is_$page_slug";

			// On normal pages only.
			if ( 'is_page' === $location ) {
				$location = is_front_page() || is_home() ? null : $location;
			}

			if ( $location && function_exists( $location ) && $location() ) {

				// Get ads locations.
				$locations = csco_get_custom_content_locations();

				// Loop through all locations.
				foreach ( $locations as $location ) {
					// Check if ads location is supported by the current page template.
					if ( in_array( $page_slug, $location['template'], true ) ) {
						// Before.
						if ( 'csco_' . $location['slug'] . '_before' === $current ) {
							$code = get_theme_mod( 'custom_content_' . $page_slug . '_' . $location['slug'] . '_before' );
							if ( $code ) {
								echo '<section class="cs-custom-content cs-custom-content-' . esc_html( $location['slug'] ) . '-before">' . do_blocks( do_shortcode( $code ) ) . '</section>';
							}
						}
						// After.
						if ( 'csco_' . $location['slug'] . '_after' === $current ) {
							$code = get_theme_mod( 'custom_content_' . $page_slug . '_' . $location['slug'] . '_after' );
							if ( $code ) {
								echo '<section class="cs-custom-content cs-custom-content-' . esc_html( $location['slug'] ) . '-after">' . do_blocks( do_shortcode( $code ) ) . '</section>';
							}
						}
					}
				}
			}
		}
	}

	foreach ( $locations as $location ) {
		add_action( 'csco_' . $location['slug'] . '_before', 'csco_custom_content_display', 5 );
		add_action( 'csco_' . $location['slug'] . '_after', 'csco_custom_content_display', 999 );
	}
}

add_action( 'init', 'csco_init_custom_content' );
