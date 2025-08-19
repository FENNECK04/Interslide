<?php
/**
 * The template for displaying the header layout
 *
 * @package Newsreader
 */

switch ( get_theme_mod( 'header_layout', 'cs-header-4' ) ) {
	case 'cs-header-1':
		get_template_part( 'template-parts/headers/header-1' );
		break;
	case 'cs-header-2':
		get_template_part( 'template-parts/headers/header-2' );
		break;
	case 'cs-header-3':
		get_template_part( 'template-parts/headers/header-3' );
		break;
	case 'cs-header-4':
		get_template_part( 'template-parts/headers/header-4' );
		break;
}
