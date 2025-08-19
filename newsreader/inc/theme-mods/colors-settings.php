<?php
/**
 * Colors
 *
 * @package Newsreader
 */

CSCO_Customizer::add_panel(
	'colors',
	array(
		'title' => esc_html__( 'Colors', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'color_scheme',
		'label'    => esc_html__( 'Site Color Scheme', 'newsreader' ),
		'section'  => 'colors',
		'default'  => 'system',
		'choices'  => array(
			'system' => esc_html__( 'User’s system preference', 'newsreader' ),
			'light'  => esc_html__( 'Light', 'newsreader' ),
			'dark'   => esc_html__( 'Dark', 'newsreader' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_scheme_toggle',
		'label'    => esc_html__( 'Enable dark/light mode toggle', 'newsreader' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background',
		'label'    => esc_html__( 'Site Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-site-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_is_dark',
		'label'    => esc_html__( 'Site Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-site-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background',
		'label'    => esc_html__( 'Header Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#0e131a',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background_is_dark',
		'label'    => esc_html__( 'Header Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background',
		'label'    => esc_html__( 'Header Submenu Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#0e131a',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background_is_dark',
		'label'    => esc_html__( 'Header Submenu Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_header_topbar_background',
		'label'           => esc_html__( 'Header Topbar Background', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#ffffff',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'cs-header-3',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_header_topbar_background_is_dark',
		'label'           => esc_html__( 'Header Topbar Background Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#161616',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'cs-header-3',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_footer_background',
		'label'    => esc_html__( 'Footer Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#0e131a',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-footer-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_footer_background_is_dark',
		'label'    => esc_html__( 'Footer Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-footer-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background',
		'label'    => esc_html__( 'Offcanvas Menu Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#0e131a',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background_is_dark',
		'label'    => esc_html__( 'Offcanvas Menu Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background',
		'label'    => esc_html__( 'Layout Background', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#f6f6f6',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background_is_dark',
		'label'    => esc_html__( 'Layout Background Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#232323',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary',
		'label'    => esc_html__( 'Primary Color', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#161616',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary_color_is_dark',
		'label'    => esc_html__( 'Primary Color Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary',
		'label'    => esc_html__( 'Secondary Color', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#585858',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary_color_is_dark',
		'label'    => esc_html__( 'Secondary Color Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#CDCDCD',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent',
		'label'    => esc_html__( 'Accent Color', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#0038ff',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent_color_is_dark',
		'label'    => esc_html__( 'Accent Color Dark', 'newsreader' ),
		'section'  => 'colors',
		'default'  => '#ffffff',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_settings',
		'label'    => esc_html__( 'Display advanced color settings', 'newsreader' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => false,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background',
		'label'           => esc_html__( 'Input Background', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background_is_dark',
		'label'           => esc_html__( 'Input Background Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input',
		'label'           => esc_html__( 'Input Color', 'newsreader' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_color_is_dark',
		'label'           => esc_html__( 'Input Color Dark', 'newsreader' ),
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background',
		'label'           => esc_html__( 'Button Background', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#0038ff',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_is_dark',
		'label'           => esc_html__( 'Button Background Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#0038ff',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button',
		'label'           => esc_html__( 'Button Color', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_color_is_dark',
		'label'           => esc_html__( 'Button Color Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover',
		'label'           => esc_html__( 'Button Hover Background', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#0033e9',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_is_dark',
		'label'           => esc_html__( 'Button Hover Background Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#0033e9',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover',
		'label'           => esc_html__( 'Button Hover Color', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover_color_is_dark',
		'label'           => esc_html__( 'Button Hover Color Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border',
		'label'           => esc_html__( 'Border Color', 'newsreader' ),
		'description'     => esc_html__( 'Used on Form Inputs, Separators etc.', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#D9D9D9',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border_color_is_dark',
		'label'           => esc_html__( 'Border Color Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#343434',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay',
		'label'           => esc_html__( 'Overlay Background', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#161616',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-overlay-background',
				'context'  => array( 'editor', 'front' ),
			),
			array(
				'element'  => ':root, [data-scheme="light"]',
				'property' => '--cs-light-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay_color_is_dark',
		'label'           => esc_html__( 'Overlay Background Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#161616',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-overlay-background',
				'context'  => array( 'editor', 'front' ),
			),
			array(
				'element'  => ':root, [data-scheme="dark"]',
				'property' => '--cs-dark-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_video_icon',
		'label'           => esc_html__( 'Video Icon Color', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#161616',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-video-icon-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_video_icon_color_is_dark',
		'label'           => esc_html__( 'Video Icon Color Dark', 'newsreader' ),
		'section'         => 'colors',
		'default'         => '#161616',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-video-icon-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_border_settings',
		'label'    => esc_html__( 'Display border radius settings', 'newsreader' ),
		'section'  => 'colors',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'color_border_settings',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_layout elements_border_radius',
		'label'             => esc_html__( 'Layout Elements Border Radius', 'newsreader' ),
		'description'       => esc_html__( 'Used on Form Elements, Blockquotes, Block Groups etc.', 'newsreader' ),
		'section'           => 'colors',
		'default'           => '2px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-layout-elements-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_thumbnail_border_radius',
		'label'             => esc_html__( 'Thumbnail Border Radius', 'newsreader' ),
		'section'           => 'colors',
		'default'           => '0px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-thumbnail-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_input_border_radius',
		'label'             => esc_html__( 'Input Border Radius', 'newsreader' ),
		'section'           => 'colors',
		'default'           => '4px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-input-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_button_border_radius',
		'label'             => esc_html__( 'Button Border Radius', 'newsreader' ),
		'section'           => 'colors',
		'default'           => '4px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-button-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
