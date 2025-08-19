<?php
/**
 * Post Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'post_settings',
	array(
		'title' => esc_html__( 'Post Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_collapsible_common',
		'section'     => 'post_settings',
		'label'       => esc_html__( 'Common', 'newsreader' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'post_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'newsreader' ),
		'section'  => 'post_settings',
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
		'settings' => 'post_header_type',
		'label'    => esc_html__( 'Default Page Header Type', 'newsreader' ),
		'section'  => 'post_settings',
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
		'type'     => 'multicheck',
		'settings' => 'post_meta',
		'label'    => esc_html__( 'Post Meta', 'newsreader' ),
		'section'  => 'post_settings',
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
		'type'            => 'radio',
		'settings'        => 'post_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'uncropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'newsreader' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_header_type',
					'operator' => '==',
					'value'    => 'standard',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_subtitle',
		'label'    => esc_html__( 'Display excerpt as post subtitle', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_tags',
		'label'    => esc_html__( 'Display tags', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_footer',
		'label'    => esc_html__( 'Display post footer', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_subscribe',
		'label'    => esc_html__( 'Display Subscribe section', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_read_next',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Read More', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_read_next',
		'label'    => esc_html__( 'Enable Read More section', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'post_read_next_heading',
		'label'             => esc_html__( 'Section Heading', 'newsreader' ),
		'section'           => 'post_settings',
		'default'           => 'Read more',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_posts',
		'label'           => esc_html__( 'Display posts', 'newsreader' ),
		'description'     => esc_html__( 'The section will display posts from the current category, published after the current post\'s date, before it, or the newest posts. In case fewer than six posts meet the requirements, the section will display other posts from the current category. In case there are fewer than six posts in the current category, the section will display posts from other categories.', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'after',
		'choices'         => apply_filters(
			'csco_header_layouts',
			array(
				'after'  => esc_html__( 'After current post date', 'newsreader' ),
				'before' => esc_html__( 'Before current post date', 'newsreader' ),
				'new'    => esc_html__( 'Newest posts', 'newsreader' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'newsreader' ),
		'section'         => 'post_settings',
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
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_size',
		'label'           => esc_html__( 'Image Size', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'read_next_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'post_read_next_meta',
		'label'           => esc_html__( 'Post Meta', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => array( 'category', 'date', 'author' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category' => esc_html__( 'Category', 'newsreader' ),
				'date'     => esc_html__( 'Date', 'newsreader' ),
				'author'   => esc_html__( 'Author', 'newsreader' ),
				'comments' => esc_html__( 'Comments', 'newsreader' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_load_nextpost',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Auto Load Next Post', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_load_nextpost',
		'label'    => esc_html__( 'Enable the Auto Load Next Post feature', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_same_category',
		'label'           => esc_html__( 'Auto load posts from the same category only', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_reverse',
		'label'           => esc_html__( 'Auto load previous posts instead of next ones', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

// Banner inside Post content.
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_banner_inside_collapsible',
		'label'       => esc_html__( 'Banner Inside the Post', 'newsreader' ),
		'section'     => 'post_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_banner_inside',
		'label'    => esc_html__( 'Display in Post content', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'post_banner_inside_html_content',
		'label'             => esc_html__( 'HTML Code', 'newsreader' ),
		'section'           => 'post_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'post_banner_inside_after_paragraph',
		'label'           => esc_html__( 'Insert After Paragraph', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 3,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 100,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'post_banner_inside_divider' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'post_banner_inside_section_alignment',
		'label'           => esc_html__( 'Section Container', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'content',
		'choices'         => array(
			'content'   => esc_html__( 'Post Content width', 'newsreader' ),
			'alignwide' => esc_html__( 'Wide width', 'newsreader' ),
			'alignfull' => esc_html__( 'Full width', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'post_banner_inside_width_heading',
		'label'           => esc_html__( 'Banner Width', 'newsreader' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_inisde_width_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-inner',
				'property' => '--cs-banner-width',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_inside_width_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-inner',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_inside_width_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-inner',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_inside_width_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-inner',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'post_banner_inside_label_divider' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_banner_inside_label',
		'label'           => esc_html__( 'Display Label', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'post_banner_inside_label_text',
		'label'           => esc_html__( 'Label', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'Advertisement',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'post_banner_inside_label',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'post_banner_inside_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'newsreader' ),
			'center' => esc_html__( 'Center', 'newsreader' ),
			'right'  => esc_html__( 'Right', 'newsreader' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-inner',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_inside',
				'operator' => '==',
				'value'    => true,
			),

			array(
				'setting'  => 'post_banner_inside_label',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_banner_after_collapsible',
		'label'       => esc_html__( 'Banner After Post', 'newsreader' ),
		'section'     => 'post_settings',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

// Banner after Post.
CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_banner_after',
		'label'    => esc_html__( 'Display after Post', 'newsreader' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'post_banner_after_html',
		'label'             => esc_html__( 'HTML Code', 'newsreader' ),
		'section'           => 'post_settings',
		'default'           => '',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'post_banner_width_divider' ),
		'section'         => 'post_banner_after_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'settings'        => 'post_banner_after_width_heading',
		'label'           => esc_html__( 'Banner Width', 'newsreader' ),
		'section'         => 'post_settings',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_desktop',
		'label'           => esc_html__( 'Desktop', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-after',
				'property' => '--cs-banner-width',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_laptop',
		'label'           => esc_html__( 'Laptop', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '970px',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 1199.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_tablet',
		'label'           => esc_html__( 'Tablet', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'post_banner_after_width_mobile',
		'label'           => esc_html__( 'Mobile', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => '100%',
		'output'          => array(
			array(
				'element'     => '.cs-banner-post-after',
				'property'    => '--cs-banner-width',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'post_banner_after_label_divider' ),
		'section'  => 'post_settings',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_banner_after_label',
		'label'           => esc_html__( 'Display Label', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'post_banner_after_label_text',
		'label'           => esc_html__( 'Label', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'Advertisement',
		'active_callback' => array(
			array(
				'setting'  => 'post_banner_after',
				'operator' => '==',
				'value'    => true,
			),

			array(
				'setting'  => 'post_banner_after_label',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'post_banner_after_label_alignment',
		'label'           => esc_html__( 'Label alignment', 'newsreader' ),
		'section'         => 'post_settings',
		'default'         => 'left',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'newsreader' ),
			'center' => esc_html__( 'Center', 'newsreader' ),
			'right'  => esc_html__( 'Right', 'newsreader' ),
		),
		'output'          => array(
			array(
				'element'  => '.cs-banner-post-after',
				'property' => '--cs-banner-label-alignment',
			),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_banner_after',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'post_banner_after_label',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
