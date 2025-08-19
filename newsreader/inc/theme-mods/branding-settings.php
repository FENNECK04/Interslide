<?php
/**
 * Branding Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'branding_settings',
	array(
		'title' => esc_html__( 'Branding Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'branding_enable',
		'label'    => esc_html__( 'Site Branding', 'newsreader' ),
		'section'  => 'branding_settings',
		'default'  => 'disabled',
		'choices'  => array(
			'disabled'  => esc_html__( 'Disabled', 'newsreader' ),
			'top'       => esc_html__( 'Top Banner', 'newsreader' ),
			'wallpaper' => esc_html__( 'Wallpaper', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'branding_banner_top',
		'label'           => esc_html__( 'Top Banner', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '==',
				'value'    => 'top',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'branding_banner_wallpaper',
		'label'           => esc_html__( 'Wallpaper', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '==',
				'value'    => 'wallpaper',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'branding_background',
		'label'           => esc_html__( 'Site Background', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '#f0f0f0',
		'alpha'           => true,
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '==',
				'value'    => 'wallpaper',
			),
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-branding-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'branding_background_is_dark',
		'label'           => esc_html__( 'Site Background Dark', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '#343434',
		'alpha'           => true,
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '==',
				'value'    => 'wallpaper',
			),
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-branding-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'branding_top_divider' ),
		'section'         => 'branding_settings',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'branding_top_desktop',
		'label'           => esc_html__( 'Height', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '15%',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-branding-top',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'branding_title_divider' ),
		'section'         => 'branding_settings',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'branding_desc',
		'label'             => esc_html__( 'Title', 'newsreader' ),
		'section'           => 'branding_settings',
		'sanitize_callback' => function( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'branding_link_divider' ),
		'section'         => 'branding_settings',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'branding_link',
		'label'           => esc_html__( 'Link', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'branding_target',
		'label'           => esc_html__( 'Link Target', 'newsreader' ),
		'section'         => 'branding_settings',
		'default'         => '_self',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'newsreader' ),
			'_blank' => esc_html__( 'In a new tab', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'branding_enable',
				'operator' => '!=',
				'value'    => 'disabled',
			),
		),
	)
);
