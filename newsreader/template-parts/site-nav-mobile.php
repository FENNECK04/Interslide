<?php
/**
 * The template for displaying the header mobile
 *
 * @package Newsreader
 */

?>

<div class="cs-header__inner cs-header__inner-mobile">
	<div class="cs-header__col cs-col-left">
		<?php csco_component( 'header_offcanvas_toggle', true, array( 'mobile' => true ) ); ?>
		<?php csco_component( 'mobile_logo' ); ?>
	</div>
	<div class="cs-header__col cs-col-right">
		<?php csco_component( 'header_search_toggle' ); ?>
	</div>
</div>
