<?php
/**
 * The template for displaying the footer layout
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

<footer class="cs-footer" <?php csco_footer_attr(); ?>>
	<div class="cs-container">
		<?php if ( csco_component( 'footer_columns_nav_menu', false ) || csco_component( 'footer_subscribe', false ) ) { ?>
			<div class="cs-footer__item cs-footer__item-top-bar">
				<div class="cs-footer__item-inner">
					<?php if ( csco_component( 'footer_columns_nav_menu', false ) ) { ?>
						<div class="cs-footer__col cs-col-left">
							<?php csco_component( 'footer_columns_nav_menu' ); ?>
						</div>
					<?php } ?>

					<?php if ( csco_component( 'footer_subscribe', false ) ) { ?>
						<?php csco_component( 'footer_subscribe' ); ?>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<div class="cs-footer__item cs-footer__item-bottom-bar">
			<div class="cs-footer__item-inner">
				<div class="cs-footer__col cs-col-left">
					<?php csco_component( 'footer_logo' ); ?>
					<?php csco_component( 'footer_copyright' ); ?>
					<?php csco_component( 'footer_nav_menu' ); ?>
				</div>
				<?php if ( $social ) { ?>
					<div class="cs-footer__col cs-col-right">
						<?php csco_component( 'misc_social_links' ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</footer>

<?php csco_component( 'scroll_to_top' ); ?>
