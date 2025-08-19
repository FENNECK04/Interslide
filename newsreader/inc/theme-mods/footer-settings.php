<?php
/**
 * Footer Settings
 *
 * @package Newsreader
 */

CSCO_Customizer::add_section(
	'footer',
	array(
		'title' => esc_html__( 'Footer Settings', 'newsreader' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'footer_subscribe',
		'label'    => esc_html__( 'Display Subscribe section', 'newsreader' ),
		'section'  => 'footer',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'footer_copyright',
		'label'             => esc_html__( 'Footer Copyright', 'newsreader' ),
		'section'           => 'footer',
		'default'           => sprintf( esc_html__( '© %s Newsreader. All Rights Reserved.', 'newsreader' ), date( 'Y' ) ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
	)
);


