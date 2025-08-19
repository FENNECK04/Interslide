<?php
/**
 * The template for displaying the header layout
 *
 * @package Newsreader
 */

?>

<div class="cs-header-before"></div>

<header class="cs-header cs-header-stretch" <?php csco_header_attr(); ?>>
	<div class="cs-header__outer">
		<div class="cs-container">
			<div class="cs-header__inner cs-header__inner-desktop">
				<div class="cs-header__col cs-col-left">
					<?php
						csco_component( 'header_offcanvas_toggle' );
						csco_component( 'header_logo' );
						csco_component( 'mobile_logo' );
						csco_component( 'header_nav_menu' );
					?>
				</div>

				<div class="cs-header__col cs-col-right">
					<div class="cs-header__toggles">
						<?php
							csco_component( 'header_follow' );
							csco_component( 'header_scheme_toggle' );
							csco_component( 'header_search_toggle' );
						?>
					</div>
					<?php csco_component( 'header_custom_button' ); ?>
				</div>
			</div>

			<?php csco_site_nav_mobile(); ?>
			<?php csco_site_search(); ?>
			<?php csco_burger_menu(); ?>
		</div>
	</div>
	<div class="cs-header-overlay"></div>
</header>

<?php csco_component( 'header_bottombar' ); ?>
