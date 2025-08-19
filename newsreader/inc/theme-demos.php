<?php
/**
 * Theme Demos
 *
 * @package Newsreader
 */

/**
 * Register Demos of Theme
 */
function csco_demos_list() {

	$plugins = array(
		array(
			'name'     => 'Elementor',
			'slug'     => 'elementor',
			'path'     => 'elementor/elementor.php',
			'required' => true,
			'desc'     => esc_html__( 'The Elementor Website Builder has it all: drag and drop page builder, pixel perfect design, mobile responsive editing, and more. Get started now!', 'newsreader' ),
		),
		array(
			'name'     => 'Regenerate Thumbnails',
			'slug'     => 'regenerate-thumbnails',
			'path'     => 'regenerate-thumbnails/regenerate-thumbnails.php',
			'required' => false,
			'desc'     => esc_html__( 'Regenerate the thumbnails for one or more of your image uploads. Useful when changing their sizes or your theme.', 'newsreader' ),
		),
	);

	$demos = array(
		'gear'     => array(
			'name'      => esc_html__( 'Gear', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/gear/',
			'thumbnail' => get_template_directory_uri() . '/import/gear.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/gear-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/gear-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'news'     => array(
			'name'      => esc_html__( 'News', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/news/',
			'thumbnail' => get_template_directory_uri() . '/import/news.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/news-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/news-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'startups' => array(
			'name'      => esc_html__( 'Startups', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/startups/',
			'thumbnail' => get_template_directory_uri() . '/import/startups.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/startups-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/startups-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'sports'   => array(
			'name'      => esc_html__( 'Sports', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/sports/',
			'thumbnail' => get_template_directory_uri() . '/import/sports.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/sports-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/sports-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'auto'     => array(
			'name'      => esc_html__( 'Auto', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/auto/',
			'thumbnail' => get_template_directory_uri() . '/import/auto.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/auto-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/auto-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'city'     => array(
			'name'      => esc_html__( 'City', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/city/',
			'thumbnail' => get_template_directory_uri() . '/import/city.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/city-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/city-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
		'media'    => array(
			'name'      => esc_html__( 'Media', 'newsreader' ),
			'preview'   => 'https://newsreader.codesupply.co/media/',
			'thumbnail' => get_template_directory_uri() . '/import/media.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/newsreader/media-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/newsreader/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'newsreader' ),
					),
					array(
						'label' => esc_html__( 'Homepage', 'newsreader' ),
						'url'   => 'https://cloud.codesupply.co/import/newsreader/media-homepage.xml',
						'type'  => 'homepage',
					),
				),
			),
		),
	);

	return $demos;
}
add_filter( 'csco_register_demos_list', 'csco_demos_list' );

/**
 * Import Homepage
 *
 * @param int   $post_id New post ID.
 * @param array $data    Raw data imported for the post.
 */
function csco_hook_import_homepage( $post_id, $data ) {
	if ( isset( $data['post_title'] ) && 'Homepage' === $data['post_title'] ) {
		// Set show_on_front.
		update_option( 'show_on_front', 'page' );

		// Set page_on_front.
		update_option( 'page_on_front', (int) $post_id );
	}
}
add_action( 'wxr_importer.db.post', 'csco_hook_import_homepage', 10, 2 );

/**
 * Clear data of elementor.
 *
 * @param array $data The data.
 */
function csco_demo_elementor_data_clear( $data ) {

	if ( ! function_exists( 'caco_recursive_array_walk' ) ) {
		function caco_recursive_array_walk( &$array, $callback, &$result = array() ) {
			foreach ( $array as $key => &$value ) {
				if ( is_array( $value ) ) {
					caco_recursive_array_walk( $value, $callback, $result );
				}

				$return_value = call_user_func( $callback, $value, $key );
				if ( null !== $return_value ) {
					$array[ $key ] = $return_value;
				}
			}
		}
	}

	caco_recursive_array_walk(
		$data,
		function( $el, $key ) {
			if ( is_array( $el ) && isset( $el['image'] ) ) {
				$el['image']['source'] = 'url';
				$el['image']['id']     = '';
			}

			if ( is_array( $el ) && isset( $el['item_image'] ) ) {
				$el['item_image']['source'] = 'url';
				$el['item_image']['id']     = '';
			}

			return $el;
		}
	);

	return $data;
}

/**
 * Finish Import
 */
function csco_hook_finish_import() {

	/* Set menu locations. */
	$nav_menu_locations = array();

	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	if ( $main_menu ) {
		$nav_menu_locations['primary'] = $main_menu->term_id;
		$nav_menu_locations['mobile']  = $main_menu->term_id;
	}

	$secondary_menu = get_term_by( 'name', 'Secondary', 'nav_menu' );
	if ( $secondary_menu ) {
		$nav_menu_locations['secondary'] = $secondary_menu->term_id;
	}

	$bottombar_menu = get_term_by( 'name', 'Bottombar', 'nav_menu' );
	if ( $bottombar_menu ) {
		$nav_menu_locations['bottombar'] = $bottombar_menu->term_id;
	}

	$burger_menu = get_term_by( 'name', 'Burger Menu', 'nav_menu' );
	if ( $burger_menu ) {
		$nav_menu_locations['burger'] = $burger_menu->term_id;
	}

	$footer_columns_menu = get_term_by( 'name', 'Footer Columns', 'nav_menu' );
	if ( $footer_columns_menu ) {
		$nav_menu_locations['footer_columns'] = $footer_columns_menu->term_id;
	}

	$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	if ( $footer_menu ) {
		$nav_menu_locations['footer']        = $footer_menu->term_id;
		$nav_menu_locations['burger_bottom'] = $footer_menu->term_id;
		$nav_menu_locations['mobile_bottom'] = $footer_menu->term_id;
	}

	if ( $nav_menu_locations ) {
		set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
	}

	/* Adaptive content */
	$search_pages = array(
		'Homepage',
	);

	foreach ( $search_pages as $search_title ) {

		$query = new WP_Query();

		$pages = $query->query(
			array(
				'post_type' => 'page',
				'title'     => $search_title,
			)
		);

		foreach ( $pages as $find_page ) {
			wp_update_post(
				wp_slash(
					array(
						'ID'           => $find_page->ID,
						'post_content' => '',
					)
				)
			);

			// Fix elementor.
			$elementor_data = get_post_meta( $find_page->ID, '_elementor_data', true );

			if ( $elementor_data ) {
				$elementor_data = json_decode( $elementor_data, true );

				$elementor_data = csco_demo_elementor_data_clear( $elementor_data );

				update_post_meta( $find_page->ID, '_elementor_data', wp_slash( wp_json_encode( $elementor_data ) ) );
			}

			delete_post_meta( $find_page->ID, '_elementor_css' );
		}
	}

	/* Add items to main menu */
	update_option( 'once_finished_import', true );
}
add_action( 'csco_finish_import', 'csco_hook_finish_import' );
