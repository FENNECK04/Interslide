<?php
/**
 * Theme Setup
 *
 * @package Newsreader
 */

/**
 * Add new custom fonts
 *
 * @param array $fonts The list custom fonts.
 */
function csco_register_theme_fonts( $fonts ) {

	$fonts['satoshi'] = array(
		'name'     => esc_html__( 'Satoshi', 'newsreader' ),
		'variants' => array( 'regular', '500', '700', '900' ),
	);

	$fonts['recia'] = array(
		'name'     => esc_html__( 'Recia', 'newsreader' ),
		'variants' => array( 'regular', 'italic', '500', '500italic', '700', '700italic' ),
	);

	$fonts['gambarino'] = array(
		'name'     => esc_html__( 'Gambarino', 'newsreader' ),
		'variants' => array( 'regular' ),
	);

	$fonts['generalsans'] = array(
		'name'     => esc_html__( 'General Sans', 'newsreader' ),
		'variants' => array( '500', '500italic' ),
	);

	return $fonts;
}
add_filter( 'csco_theme_fonts', 'csco_register_theme_fonts' );

/**
 * The function sets the default options to plugins.
 *
 * Set Post Views Counter location to manual.
 *
 * @param string $plugin Plugin name.
 */
function csco_plugin_set_options( $plugin ) {
	if ( 'post-views-counter' === $plugin ) {
		// Get display options.
		$display_options = get_option( 'post_views_counter_settings_display' );

		$display_options = $display_options ? $display_options : array();
		// Set position value.
		$display_options['position'] = 'manual';
		// Update options.
		update_option( 'post_views_counter_settings_display', $display_options );
	}

	if ( 'wp-seo' === $plugin ) {
		// Get display options.
		$display_options = get_option( 'wpseo_titles' );

		$display_options = $display_options ? $display_options : array();
		// Set position value.
		$display_options['breadcrumbs-sep'] = '<span class="cs-separator"></span>';
		// Update options.
		update_option( 'wpseo_titles', $display_options );
	}
}

/**
 * Hook into activated_plugin action.
 *
 * @param string $plugin Plugin path to main plugin file with plugin data.
 */
function csco_activated_plugin( $plugin ) {
	// Check if PVC constant is defined, use it to get PVC path anc compare to activated plugin.
	if ( 'post-views-counter/post-views-counter.php' === $plugin ) {
		csco_plugin_set_options( 'post-views-counter' );
	}

	// Check if WPSEO constant is defined, use it to get WPSEO path anc compare to activated plugin.
	if ( 'wordpress-seo/wp-seo.php' === $plugin ) {
		csco_plugin_set_options( 'wp-seo' );
	}
}
add_action( 'activated_plugin', 'csco_activated_plugin' );

/**
 * Hook into after_switch_theme action.
 */
function csco_activated_theme() {
	csco_plugin_set_options( 'post-views-counter' );
	csco_plugin_set_options( 'wp-seo' );
}
add_action( 'after_switch_theme', 'csco_activated_theme' );

/**
 * Remove AMP link.
 */
function csco_admin_remove_amp_link() {
	remove_action( 'admin_menu', 'amp_add_customizer_link' );
}
add_action( 'after_setup_theme', 'csco_admin_remove_amp_link', 20 );

/**
 * Remove AMP panel.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_customizer_remove_amp_panel( $wp_customize ) {
	$wp_customize->remove_panel( 'amp_panel' );
}
add_action( 'customize_register', 'csco_customizer_remove_amp_panel', 1000 );
