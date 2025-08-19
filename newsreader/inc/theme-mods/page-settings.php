<?php
/**
 * Page Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'page_settings',
	array(
		'title' => esc_html__( 'Page Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'page_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'newsreader' ),
		'section'  => 'page_settings',
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
		'settings' => 'page_header_type',
		'label'    => esc_html__( 'Page Header Type', 'newsreader' ),
		'section'  => 'page_settings',
		'default'  => 'standard',
		'choices'  => array(
			'standard'      => esc_html__( 'Standard', 'newsreader' ),
			'featured'      => esc_html__( 'Featured', 'newsreader' ),
			'overlay'       => esc_html__( 'Overlay', 'newsreader' ),
			'large_overlay' => esc_html__( 'Fullwidth Overlay', 'newsreader' ),
			'title'         => esc_html__( 'Page Title Only', 'newsreader' ),
			'none'          => esc_html__( 'None', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'page_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'newsreader' ),
		'section'         => 'page_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'newsreader' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'page_header_type',
				'operator' => '==',
				'value'    => 'standard',
			),
		),
	)
);
