<?php
/**
 * Miscellaneous Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'miscellaneous',
	array(
		'title' => esc_html__( 'Miscellaneous Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_published_date',
		'label'    => esc_html__( 'Display published date instead of modified date', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_social_links',
		'label'       => esc_html__( 'Social Links', 'newsreader' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_1',
		'label'    => esc_html__( 'Display Social Link 1', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_label',
		'label'           => esc_html__( 'Social 1 Label', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_1',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_link',
		'label'           => esc_html__( 'Social 1 Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_1',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_1_icon',
		'label'           => esc_html__( 'Social 1 Icon', 'newsreader' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'newsreader' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'newsreader' ) . '<code>logo@2x.png</code>' . esc_html__( '. Recommended width and height is 26px (56px for Retina version).', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_1',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_2',
		'label'    => esc_html__( 'Display Social Link 2', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_label',
		'label'           => esc_html__( 'Social 2 Label', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_2',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_link',
		'label'           => esc_html__( 'Social 2 Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_2',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_2_icon',
		'label'           => esc_html__( 'Social 2 Icon', 'newsreader' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'newsreader' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'newsreader' ) . '<code>logo@2x.png</code>' . esc_html__( '. Recommended width and height is 26px (52px for Retina version).', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_2',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_3',
		'label'    => esc_html__( 'Display Social Link 3', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_label',
		'label'           => esc_html__( 'Social 3 Label', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_3',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_link',
		'label'           => esc_html__( 'Social 3 Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_3',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_3_icon',
		'label'           => esc_html__( 'Social 3 Icon', 'newsreader' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'newsreader' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'newsreader' ) . '<code>logo@2x.png</code>' . esc_html__( '. Recommended width and height is 26px (52px for Retina version).', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_3',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_4',
		'label'    => esc_html__( 'Display Social Link 4', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_label',
		'label'           => esc_html__( 'Social 4 Label', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_4',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_link',
		'label'           => esc_html__( 'Social 4 Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_4',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_4_icon',
		'label'           => esc_html__( 'Social 4 Icon', 'newsreader' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'newsreader' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'newsreader' ) . '<code>logo@2x.png</code>' . esc_html__( '. Recommended width and height is 26px (52px for Retina version).', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_4',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_5',
		'label'    => esc_html__( 'Display Social Link 5', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_label',
		'label'           => esc_html__( 'Social 5 Label', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_5',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_link',
		'label'           => esc_html__( 'Social 5 Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_5',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
        array(
                'type'            => 'image',
                'settings'        => 'misc_social_5_icon',
                'label'           => esc_html__( 'Social 5 Icon', 'newsreader' ),
		'description'     => esc_html__( 'Please upload the 2x version of your icon via Media Library with ', 'newsreader' ) . '<code>@2x</code>' . esc_html__( ' suffix for Retina screens support. For example ', 'newsreader' ) . '<code>logo@2x.png</code>' . esc_html__( '. Recommended width and height is 26px (52px for Retina version).', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_5',
				'operator' => '==',
				'value'    => true,
			),
                ),
        )
);

CSCO_Customizer::add_field(
       array(
               'type'     => 'checkbox',
               'settings' => 'misc_social_instagram',
               'label'    => esc_html__( 'Display Instagram link', 'newsreader' ),
               'section'  => 'miscellaneous',
               'default'  => false,
       )
);

CSCO_Customizer::add_field(
       array(
               'type'            => 'text',
               'settings'        => 'misc_social_instagram_url',
               'label'           => esc_html__( 'Instagram URL', 'newsreader' ),
               'section'         => 'miscellaneous',
               'default'         => '',
               'active_callback' => array(
                       array(
                               'setting'  => 'misc_social_instagram',
                               'operator' => '==',
                               'value'    => true,
                       ),
               ),
       )
);

CSCO_Customizer::add_field(
       array(
               'type'     => 'checkbox',
               'settings' => 'misc_social_tiktok',
               'label'    => esc_html__( 'Display TikTok link', 'newsreader' ),
               'section'  => 'miscellaneous',
               'default'  => false,
       )
);

CSCO_Customizer::add_field(
       array(
               'type'            => 'text',
               'settings'        => 'misc_social_tiktok_url',
               'label'           => esc_html__( 'TikTok URL', 'newsreader' ),
               'section'         => 'miscellaneous',
               'default'         => '',
               'active_callback' => array(
                       array(
                               'setting'  => 'misc_social_tiktok',
                               'operator' => '==',
                               'value'    => true,
                       ),
               ),
       )
);

CSCO_Customizer::add_field(
       array(
               'type'     => 'checkbox',
               'settings' => 'misc_social_youtube',
               'label'    => esc_html__( 'Display YouTube link', 'newsreader' ),
               'section'  => 'miscellaneous',
               'default'  => false,
       )
);

CSCO_Customizer::add_field(
       array(
               'type'            => 'text',
               'settings'        => 'misc_social_youtube_url',
               'label'           => esc_html__( 'YouTube URL', 'newsreader' ),
               'section'         => 'miscellaneous',
               'default'         => '',
               'active_callback' => array(
                       array(
                               'setting'  => 'misc_social_youtube',
                               'operator' => '==',
                               'value'    => true,
                       ),
               ),
       )
);

CSCO_Customizer::add_field(
        array(
                'type'        => 'collapsible',
                'settings'    => 'misc_sticky_sidebar_section',
		'label'       => esc_html__( 'Sticky Sidebar', 'newsreader' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_sticky_sidebar',
		'label'    => esc_html__( 'Enable Sticky Sidebar', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'misc_sticky_sidebar_method',
		'label'           => esc_html__( 'Sticky Method', 'newsreader' ),
		'section'         => 'miscellaneous',
		'default'         => 'cs-stick-to-top',
		'choices'         => array(
			'cs-stick-to-top'    => esc_html__( 'Sidebar top edge', 'newsreader' ),
			'cs-stick-to-bottom' => esc_html__( 'Sidebar bottom edge', 'newsreader' ),
			'cs-stick-last'      => esc_html__( 'Last widget top edge', 'newsreader' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_sticky_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_scroll_to_top_section',
		'label'       => esc_html__( 'Scroll to Top', 'newsreader' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_scroll_to_top',
		'label'    => esc_html__( 'Enable Scroll to Top button', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'footer_collapsible_subscribe',
		'label'       => esc_html__( 'Subscribe', 'newsreader' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_subscribe',
		'label'    => esc_html__( 'Display subscribe section', 'newsreader' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_subscribe_heading',
		'label'           => esc_html__( 'Heading', 'newsreader' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_subscribe_mailchimp',
		'label'           => esc_html__( 'Mailchimp Form Link', 'newsreader' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'misc_subscribe_description',
		'label'             => esc_html__( 'Description', 'newsreader' ),
		'section'           => 'miscellaneous',
		'sanitize_callback' => function( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
