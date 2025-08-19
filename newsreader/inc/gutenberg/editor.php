<?php
/**
 * Editor Settings.
 *
 * @package Newsreader
 */

/**
 * Enqueue editor scripts
 */
function csco_block_editor_scripts() {
	wp_enqueue_script(
		'cs-editor-scripts',
		get_template_directory_uri() . '/assets/jsx/editor-scripts.js',
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_scripts' );

/**
 * Adds classes to <div class="editor-styles-wrapper"> tag
 */
function csco_block_editor_wrapper() {

	$script_handle = 'cs-editor-wrapper';
	$script_file   = 'editor-wrapper.js';

	if ( 'enqueue_block_assets' === current_filter() ) {
		if ( ! ( is_admin() && ! is_customize_preview() ) ) {
			return;
		}

		$script_handle = 'cs-editor-iframe';
		$script_file   = 'editor-iframe.js';
	}

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	// Set post type.
	$post_type = sprintf( 'post-type-%s', get_post_type( $post_id ) );

	// Set page layout.
	$default_layout = csco_get_page_sidebar( $post_id, 'default' );
	$page_layout    = csco_get_page_sidebar( $post_id, false );

	if ( 'disabled' === $default_layout ) {
		$default_layout = 'cs-sidebar-disabled';
	} else {
		$default_layout = 'cs-sidebar-enabled';
	}

	if ( 'disabled' === $page_layout ) {
		$page_layout = 'cs-sidebar-disabled';
	} else {
		$page_layout = 'cs-sidebar-enabled';
	}

	// Set breakpoints.
	$breakpoints = array(
		'cs-breakpoint-up-576px'  => 576,
		'cs-breakpoint-up-768px'  => 768,
		'cs-breakpoint-up-992px'  => 992,
		'cs-breakpoint-up-1200px' => 1200,
		'cs-breakpoint-up-1336px' => 1336,
		'cs-breakpoint-up-1920px' => 1920,
	);

	wp_enqueue_script(
		$script_handle,
		get_template_directory_uri() . '/assets/jsx/' . $script_file,
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	wp_localize_script(
		$script_handle,
		'cscoGWrapper',
		array(
			'post_type'      => $post_type,
			'default_layout' => $default_layout,
			'page_layout'    => $page_layout,
			'breakpoints'    => $breakpoints,
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_wrapper' );
add_action( 'enqueue_block_assets', 'csco_block_editor_wrapper' );

/**
 * Change editor color palette.
 */
function csco_change_editor_color_palette() {
	// Editor Color Palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Blue', 'newsreader' ),
				'slug'  => 'blue',
				'color' => '#59BACC',
			),
			array(
				'name'  => esc_html__( 'Green', 'newsreader' ),
				'slug'  => 'green',
				'color' => '#58AD69',
			),
			array(
				'name'  => esc_html__( 'Orange', 'newsreader' ),
				'slug'  => 'orange',
				'color' => '#FFBC49',
			),
			array(
				'name'  => esc_html__( 'Red', 'newsreader' ),
				'slug'  => 'red',
				'color' => '#e32c26',
			),
			array(
				'name'  => esc_html__( 'Pale Pink', 'newsreader' ),
				'slug'  => 'pale-pink',
				'color' => '#f78da7',
			),
			array(
				'name'  => esc_html__( 'White', 'newsreader' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
			array(
				'name'  => esc_html__( 'Gray 50', 'newsreader' ),
				'slug'  => 'gray-50',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => esc_html__( 'Gray 100', 'newsreader' ),
				'slug'  => 'gray-100',
				'color' => '#f8f9fb',
			),
			array(
				'name'  => esc_html__( 'Gray 200', 'newsreader' ),
				'slug'  => 'gray-200',
				'color' => '#E0E0E0',
			),
			array(
				'name'  => esc_html__( 'Primary', 'newsreader' ),
				'slug'  => 'primary',
				'color' => get_theme_mod( 'color_primary', '#161616' ),
			),
			array(
				'name'  => esc_html__( 'Secondary', 'newsreader' ),
				'slug'  => 'secondary',
				'color' => get_theme_mod( 'color_secondary', '#585858' ),
			),
			array(
				'name'  => esc_html__( 'Layout', 'newsreader' ),
				'slug'  => 'layout',
				'color' => get_theme_mod( 'color_layout_background', '#f9f9f9' ),
			),
			array(
				'name'  => esc_html__( 'Border', 'newsreader' ),
				'slug'  => 'border',
				'color' => get_theme_mod( 'color_border', '#D9D9D9' ),
			),
			array(
				'name'  => esc_html__( 'Divider', 'newsreader' ),
				'slug'  => 'divider',
				'color' => get_theme_mod( 'color_divider', '#1D1D1F' ),
			),
			array(
				'name'  => esc_html__( 'Black', 'newsreader' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		)
	);
}
add_action( 'after_setup_theme', 'csco_change_editor_color_palette' );
