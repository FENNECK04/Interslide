<?php
/**
 * The template part for displaying burger-menu area.
 *
 * @package Newsreader
 */

$social = false;
if ( 
	get_theme_mod( 'misc_social_1', false ) ||
	get_theme_mod( 'misc_social_2', false ) ||
	get_theme_mod( 'misc_social_3', false ) ||
	get_theme_mod( 'misc_social_4', false ) ||
	get_theme_mod( 'misc_social_5', false )
	) {
	$social = true;
}
?>
<div class="cs-burger-menu">
	<div class="cs-container">
		<?php if ( has_nav_menu( 'burger' ) ) { ?>
			<div class="cs-burger-menu__inner">
				<?php csco_component( 'burger_nav_menu' ); ?>
			</div>
		<?php } ?>

		<?php if ( has_nav_menu( 'burger_bottom' )  || $social ) { ?>
			<div class="cs-burger-menu__bottombar">
				<?php csco_component( 'misc_social_links' ); ?>
				<?php csco_component( 'burger_bottom_menu' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php
