<?php
/**
 * Header Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'header',
	array(
		'title' => esc_html__( 'Header Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'header_collapsible_common',
		'section'     => 'header',
		'label'       => esc_html__( 'Common', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'header_layout',
		'label'    => esc_html__( 'Layout', 'newsreader' ),
		'section'  => 'header',
		'default'  => 'cs-header-4',
		/**
		 * The csco_header hook.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
			'csco_header_layouts',
			array(
				'cs-header-1' => esc_html__( 'Header 1', 'newsreader' ),
				'cs-header-2' => esc_html__( 'Header 2', 'newsreader' ),
				'cs-header-3' => esc_html__( 'Header 3', 'newsreader' ),
				'cs-header-4' => esc_html__( 'Header 4', 'newsreader' ),
			)
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_initial_height',
		'label'    => esc_html__( 'Header Initial Height', 'newsreader' ),
		'section'  => 'header',
		'default'  => '60px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-initial-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_height',
		'label'    => esc_html__( 'Header Height', 'newsreader' ),
		'section'  => 'header',
		'default'  => '60px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'header_topbar_height',
		'label'           => esc_html__( 'Header Topbar Height', 'newsreader' ),
		'section'         => 'header',
		'default'         => '74px',
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'cs-header-3',
			),
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-topbar-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_border_width',
		'label'    => esc_html__( 'Header Border Width', 'newsreader' ),
		'section'  => 'header',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-border-width',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'navbar_sticky',
		'label'       => esc_html__( 'Make navigation bar sticky', 'newsreader' ),
		'description' => esc_html__( 'Enabling this option will make navigation bar visible when scrolling.', 'newsreader' ),
		'section'     => 'header',
		'default'     => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'navbar_smart_sticky',
		'label'           => esc_html__( 'Enable the smart sticky feature', 'newsreader' ),
		'description'     => esc_html__( 'Enabling this option will reveal navigation bar when scrolling up and hide it when scrolling down.', 'newsreader' ),
		'section'         => 'header',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'navbar_sticky',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_offcanvas',
		'label'    => esc_html__( 'Display offcanvas toggle button', 'newsreader' ),
		'section'  => 'header',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_navigation_menu',
		'label'    => esc_html__( 'Display navigation menu', 'newsreader' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_navigation_secondary_menu',
		'label'    => esc_html__( 'Display navigation secondary menu', 'newsreader' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_bottombar',
		'section'  => 'header',
		'label'    => esc_html__( 'Bottombar', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'header_bottombar',
		'label'       => esc_html__( 'Display bottombar', 'newsreader' ),
		'description' => esc_html__( 'Enabling this option will display navigation bottombar menu which can be configured using Wordpress "Appearance / Menu" section. Location - "Header Bottombar".', 'newsreader' ),
		'section'     => 'header',
		'default'     => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_bottombar_type',
		'label'           => esc_html__( 'Type', 'newsreader' ),
		'section'         => 'header',
		'default'         => 'standard',
		'choices'         => apply_filters(
			'csco_header_layouts',
			array(
				'standard' => esc_html__( 'Standard', 'newsreader' ),
				'carousel' => esc_html__( 'Carousel', 'newsreader' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_bottombar',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_bottombar_alignment',
		'label'           => esc_html__( 'Menu alignment', 'newsreader' ),
		'section'         => 'header',
		'default'         => 'flex-start',
		'choices'         => apply_filters(
			'csco_header_layouts',
			array(
				'flex-start' => esc_html__( 'Left', 'newsreader' ),
				'center'     => esc_html__( 'Center', 'newsreader' ),
				'flex-end'   => esc_html__( 'Right', 'newsreader' ),
			)
		),
		'output'          => array(
			array(
				'element'  => '.cs-header-bottombar',
				'property' => '--cs-header-bottombar-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_bottombar',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'header_bottombar_type',
					'operator' => '==',
					'value'    => 'standard',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_search',
		'section'  => 'header',
		'label'    => esc_html__( 'Search', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_search_button',
		'label'    => esc_html__( 'Display search button', 'newsreader' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'header_collapsible_follow',
		'section'         => 'header',
		'label'           => esc_html__( 'Follow', 'newsreader' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '!=',
				'value'    => 'cs-header-3',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_follow',
		'label'           => esc_html__( 'Display Follow section', 'newsreader' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '!=',
				'value'    => 'cs-header-3',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'follow_text',
		'label'             => esc_html__( 'Follow text', 'newsreader' ),
		'section'           => 'header',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'cs-header-3',
				),
			),
			array(
				array(
					'setting'  => 'header_follow',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_follow_subscribe',
		'label'           => esc_html__( 'Enable Subscribe form', 'newsreader' ),
		'description'     => esc_html__( 'Enabling this option will display the subscribe form specified in the Miscellaneous settings section.', 'newsreader' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'cs-header-3',
				),
			),
			array(
				array(
					'setting'  => 'header_follow',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_social_links',
		'label'           => esc_html__( 'Enable social links', 'newsreader' ),
		'description'     => esc_html__( 'Enabling this option will display social links specified in the Miscellaneous settings section.', 'newsreader' ),
		'section'         => 'header',
		'default'         => false,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_layout',
					'operator' => '!=',
					'value'    => 'cs-header-3',
				),
			),
			array(
				array(
					'setting'  => 'header_follow',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_custom_button',
		'section'  => 'header',
		'label'    => esc_html__( 'Custom button', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_custom_button',
		'label'    => esc_html__( 'Display custom button', 'newsreader' ),
		'section'  => 'header',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_label',
		'label'           => esc_html__( 'Button label', 'newsreader' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_link',
		'label'           => esc_html__( 'Button link', 'newsreader' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_mega_menu',
		'section'  => 'header',
		'label'    => esc_html__( 'Mega Menu', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'mega_menu_image_orientation',
		'label'    => esc_html__( 'Image Orientation', 'newsreader' ),
		'section'  => 'header',
		'default'  => 'landscape-3-2',
		'choices'  => array(
			'original'       => esc_html__( 'Original', 'newsreader' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'newsreader' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'newsreader' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'newsreader' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'newsreader' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'newsreader' ),
			'square'         => esc_html__( 'Square', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'select',
		'settings' => 'mega_menu_image_size',
		'label'    => esc_html__( 'Image Size', 'newsreader' ),
		'section'  => 'header',
		'default'  => 'csco-thumbnail-uncropped',
		'choices'  => csco_get_list_available_image_sizes(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'mega_menu_post_meta',
		'label'    => esc_html__( 'Post Meta', 'newsreader' ),
		'section'  => 'header',
		'default'  => array( 'date', 'author' ),
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
