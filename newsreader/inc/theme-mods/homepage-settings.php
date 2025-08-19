<?php
/**
 * Homepage Settings
 *
 * @package Newsreader
 */

/**
 * Removes default WordPress Static Front Page section
 * and re-adds it in our own panel with the same parameters.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_reorder_customizer_settings( $wp_customize ) {

	// Get current front page section parameters.
	$static_front_page = $wp_customize->get_section( 'static_front_page' );

	// Remove existing section, so that we can later re-add it to our panel.
	$wp_customize->remove_section( 'static_front_page' );

	// Re-add static front page section with a new name, but same description.
	$wp_customize->add_section(
		'static_front_page',
		array(
			'title'           => esc_html__( 'Static Front Page', 'newsreader' ),
			'description'     => $static_front_page->description,
			'panel'           => 'home_panel',
			'active_callback' => $static_front_page->active_callback,
		)
	);
}
add_action( 'customize_register', 'csco_reorder_customizer_settings' );

CSCO_Customizer::add_panel(
	'home_panel',
	array(
		'title' => esc_html__( 'Front Page Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_section(
	'home_settings',
	array(
		'title' => esc_html__( 'Latest Posts Layout', 'newsreader' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_common',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Common', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'home_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => 'right',
		'choices'  => array(
			'right'    => esc_html__( 'Right Sidebar', 'newsreader' ),
			'left'     => esc_html__( 'Left Sidebar', 'newsreader' ),
			'disabled' => esc_html__( 'No Sidebar', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'home_layout',
		'label'    => esc_html__( 'Layout', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => 'grid',
		'choices'  => array(
			'grid' => esc_html__( 'Grid Layout', 'newsreader' ),
			'list' => esc_html__( 'List Layout', 'newsreader' ),
			'full' => esc_html__( 'Full Post Layout', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 'landscape-16-9',
		'choices'         => array(
			'original'       => esc_html__( 'Original', 'newsreader' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'newsreader' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'newsreader' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'newsreader' ),
			'landscape-21-9' => esc_html__( 'Landscape 21:9', 'newsreader' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'newsreader' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'newsreader' ),
			'portrait-6-7'   => esc_html__( 'Portrait 6:7', 'newsreader' ),
			'square'         => esc_html__( 'Square', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'home_image_size',
		'label'           => esc_html__( 'Image Size', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'newsreader' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_summary',
		'label'           => esc_html__( 'Full Post Summary', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'newsreader' ),
			'content' => esc_html__( 'Use Read More Tag', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'home_pagination_type',
		'label'    => esc_html__( 'Pagination', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => 'load-more',
		'choices'  => array(
			'standard'  => esc_html__( 'Standard', 'newsreader' ),
			'load-more' => esc_html__( 'Load More Button', 'newsreader' ),
			'infinite'  => esc_html__( 'Infinite Load', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_post_meta',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Post Meta', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'home_post_meta',
		'label'    => esc_html__( 'Post Meta', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => array( 'category', 'date', 'author' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
			'csco_post_meta_choices',
			array(
				'category' => esc_html__( 'Category', 'newsreader' ),
				'date'     => esc_html__( 'Date', 'newsreader' ),
				'author'   => esc_html__( 'Author', 'newsreader' ),
				'comments' => esc_html__( 'Comments', 'newsreader' ),
			)
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_collapsible_number_of_columns',
		'section'         => 'home_settings',
		'label'           => esc_html__( 'Number of Columns', 'newsreader' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 3,
		'input_attrs'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_gap_between_rows',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Gap between Rows', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_divider',
		'label'           => esc_html__( 'Display Divider between Rows', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '!=',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_gap_between_rows_desktop',
		'label'    => esc_html__( 'Desktop', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '24px',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__home',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_gap_between_rows_laptop',
		'label'    => esc_html__( 'Laptop', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '24px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_gap_between_rows_tablet',
		'label'    => esc_html__( 'Tablet', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '24px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_gap_between_rows_mobile',
		'label'    => esc_html__( 'Mobile', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '24px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_collapsible_gap_between_columns',
		'section'         => 'home_settings',
		'label'           => esc_html__( 'Gap between Columns', 'newsreader' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_gap_between_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_title_size',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Title Font Size', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_title_size_desktop',
		'label'    => esc_html__( 'Desktop', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__home',
				'property' => '--cs-entry-title-font-size',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_title_size_laptop',
		'label'    => esc_html__( 'Laptop', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_title_size_tablet',
		'label'    => esc_html__( 'Tablet', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'home_title_size_mobile',
		'label'    => esc_html__( 'Mobile', 'newsreader' ),
		'section'  => 'home_settings',
		'default'  => '1.25rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__home',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);
