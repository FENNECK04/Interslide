<?php
/**
 * Widgets Init
 *
 * Register sitebar locations for widgets.
 *
 * @package Newsreader
 */

if ( ! function_exists( 'csco_widgets_init' ) ) {
	/**
	 * Register sidebars
	 */
	function csco_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Default Sidebar', 'newsreader' ),
				'id'            => 'sidebar-main',
				'before_widget' => '<div class="widget %1$s %2$s">',
				'after_widget'  => '</div>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Off-canvas', 'newsreader' ),
				'id'            => 'sidebar-offcanvas',
				'before_widget' => '<div class="widget %1$s %2$s">',
				'after_widget'  => '</div>',
			)
		);
	}
	add_action( 'widgets_init', 'csco_widgets_init' );
}
