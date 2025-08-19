<?php
/**
 * All core theme actions.
 *
 * Please do not modify this file directly.
 * You may remove actions in your child theme by using remove_action().
 *
 * Please see /inc/partials.php for the list of partials,
 * added to actions.
 *
 * @package Newsreader
 */

/**
 * Body
 */
add_action( 'csco_site_before', 'csco_site_branding', 1 );
add_action( 'csco_site_before', 'csco_offcanvas' );
add_action( 'csco_main_content_before', 'csco_theme_breadcrumbs', 1 );

/**
 * Main
 */
add_action( 'csco_main_before', 'csco_page_header', 100 );

/**
 * Singular
 */
add_action( 'csco_entry_content_before', 'csco_singular_post_type_before', 10 );
add_action( 'csco_entry_content_after', 'csco_singular_post_type_after', 999 );

/**
 * Entry Media
 */
add_action( 'csco_site_content_before', 'csco_entry_media_large', 10 );
add_action( 'csco_main_content_before', 'csco_entry_media', 20 );

/**
 * Entry Header
 */
add_action( 'csco_entry_container_start', 'csco_entry_header', 10 );

/**
 * Archive Header
 */
add_action( 'csco_main_content_before', 'csco_archives_header', 10 );

/**
 * Entry Sections
 */
add_action( 'csco_entry_content_after', 'csco_page_pagination', 10 );
add_action( 'csco_entry_content_after', 'csco_entry_tags', 20 );
add_action( 'csco_entry_content_after', 'csco_entry_footer', 30 );
add_action( 'csco_entry_content_after', 'csco_entry_comments', 40 );
add_action( 'csco_main_after', 'csco_entry_subscribe', 10 );
add_action( 'csco_main_after', 'csco_entry_banner', 20 );
add_action( 'csco_main_after', 'csco_entry_read_next', 30 );
