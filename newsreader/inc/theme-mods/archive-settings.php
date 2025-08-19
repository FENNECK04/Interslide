<?php
/**
 * Archive Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'archive_settings',
	array(
		'title' => esc_html__( 'Archive Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_common',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Common', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'archive_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'newsreader' ),
		'section'  => 'archive_settings',
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
		'settings' => 'archive_layout',
		'label'    => esc_html__( 'Layout', 'newsreader' ),
		'section'  => 'archive_settings',
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
		'settings'        => 'archive_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'archive_layout',
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
		'settings'        => 'archive_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'newsreader' ),
		'section'         => 'archive_settings',
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
					'setting'  => 'archive_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'archive_layout',
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
		'settings'        => 'archive_image_size',
		'label'           => esc_html__( 'Image Size', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
					'operator' => '==',
					'value'    => 'list',
				),
				array(
					'setting'  => 'archive_layout',
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
		'settings'        => 'archive_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'newsreader' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
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
		'settings'        => 'archive_summary',
		'label'           => esc_html__( 'Full Post Summary', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'newsreader' ),
			'content' => esc_html__( 'Use Read More Tag', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
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
		'settings' => 'archive_pagination_type',
		'label'    => esc_html__( 'Pagination', 'newsreader' ),
		'section'  => 'archive_settings',
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
		'settings'    => 'archive_collapsible_post_meta',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Post Meta', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'archive_post_meta',
		'label'    => esc_html__( 'Post Meta', 'newsreader' ),
		'section'  => 'archive_settings',
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
		'settings'        => 'archive_collapsible_number_of_olumns',
		'section'         => 'archive_settings',
		'label'           => esc_html__( 'Number of Columns', 'newsreader' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 3,
		'input_attrs'     => array(
			'min'  => 2,
			'max'  => 4,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_gap_between_rows',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Gap between Rows', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'archive_divider',
		'label'           => esc_html__( 'Display Divider between Rows', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '!=',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_gap_between_rows_desktop',
		'label'    => esc_html__( 'Desktop', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '40px',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__archive',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_gap_between_rows_laptop',
		'label'    => esc_html__( 'Laptop', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '40px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_gap_between_rows_tablet',
		'label'    => esc_html__( 'Tablet', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '40px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_gap_between_rows_mobile',
		'label'    => esc_html__( 'Mobile', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '24px',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'archive_collapsible_gap_between_columns',
		'section'         => 'archive_settings',
		'label'           => esc_html__( 'Gap between Columns', 'newsreader' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_title_size',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Title Font Size', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_title_size_desktop',
		'label'    => esc_html__( 'Desktop', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'  => '.cs-posts-area__archive',
				'property' => '--cs-entry-title-font-size',
			),
			array(
				'element'  => '.cs-posts-area__read-next',
				'property' => '--cs-entry-title-font-size',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_title_size_laptop',
		'label'    => esc_html__( 'Laptop', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 1199.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_title_size_tablet',
		'label'    => esc_html__( 'Tablet', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '1.5rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'archive_title_size_mobile',
		'label'    => esc_html__( 'Mobile', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => '1.25rem',
		'output'   => array(
			array(
				'element'     => '.cs-posts-area__archive',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 767.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_header_collapsible',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Featured Posts', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'archive_header',
		'label'    => esc_html__( 'Default Featured Posts', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => 'disabled',
		'choices'  => array(
			'enabled'  => esc_html__( 'Enabled', 'newsreader' ),
			'disabled' => esc_html__( 'Disabled', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'archive_header_post_meta',
		'label'    => esc_html__( 'Post Meta', 'newsreader' ),
		'section'  => 'archive_settings',
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
		'type'     => 'checkbox',
		'settings' => 'archive_header_excerpt',
		'label'    => esc_html__( 'Display excerpt', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'archive_header_image_orientation',
		'label'    => esc_html__( 'Image Orientation', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => 'landscape-16-9',
		'choices'  => array(
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
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_banner_section',
		'label'       => esc_html__( 'Banner Section', 'newsreader' ),
		'section'     => 'archive_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'archive_banner',
		'label'    => esc_html__( 'Display Banner', 'newsreader' ),
		'section'  => 'archive_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'archive_banner_html',
		'label'             => esc_html__( 'HTML Code', 'newsreader' ),
		'section'           => 'archive_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'archive_banner_width_divider' ),
		'section'  => 'archive_settings',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'heading',
		'settings' => 'archive_width_heading',
		'label'    => esc_html__( 'Banner Width', 'newsreader' ),
		'section'  => 'archive_settings',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_banner_width_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'  => '.cs-banner-archive',
				'property' => '--cs-banner-width',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_banner_width_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-archive',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_banner_width_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-archive',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_banner_width_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-archive',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'archive_banner_label_divider' ),
		'section'  => 'archive_settings',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'archive_banner_label',
		'label'           => esc_html__( 'Display Label', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'archive_banner',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'archive_banner_label_text',
		'label'           => esc_html__( 'Label', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 'Advertisement',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_banner',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'archive_banner_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'archive_banner_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'newsreader' ),
		'section'         => 'archive_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'newsreader' ),
			'center' => esc_html__( 'Center', 'newsreader' ),
			'right'  => esc_html__( 'Right', 'newsreader' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-archive',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_banner',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'archive_banner_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
