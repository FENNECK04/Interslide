<?php
/**
 * The template part for displaying off-canvas area.
 *
 * @package Newsreader
 */

if ( csco_offcanvas_exists() ) {
	?>

	<div class="cs-site-overlay"></div>

	<div class="cs-offcanvas" <?php csco_offcanvas_attr(); ?>>

		<div class="cs-offcanvas__header">
			<?php
			/**
			 * The csco_offcanvas_header_start hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_offcanvas_header_start' );
			?>

			<?php csco_component( 'mobile_logo' ); ?> 

			<nav class="cs-offcanvas__nav">
				<span class="cs-offcanvas__toggle" role="button" aria-label="<?php echo esc_html__( 'Close mobile menu button', 'newsreader' ); ?>">
					<i class="cs-icon cs-icon-x"></i>
				</span>
			</nav>

			<?php
			/**
			 * The csco_offcanvas_header_end hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_offcanvas_header_end' );
			?>
		</div>

		<div class="cs-offcanvas__search cs-container">
			<?php get_template_part( 'searchform' ); ?>
		</div>

		<aside class="cs-offcanvas__sidebar">
			<div class="cs-offcanvas__inner cs-offcanvas__area cs-widget-area cs-container">

				<?php
				$locations = get_nav_menu_locations();

				// Get menu by location.
				if ( isset( $locations['primary'] ) || isset( $locations['mobile'] ) ) {

					if ( isset( $locations['primary'] ) ) {
						$location = $locations['primary'];
					}
					if ( isset( $locations['mobile'] ) ) {
						$location = $locations['mobile'];
					}

					the_widget( 'WP_Nav_Menu_Widget', array( 'nav_menu' => $location ), array(
						'before_widget' => '<div class="widget %s">',
						'after_widget'  => '</div>',
					) );
				}
				?>

				<?php dynamic_sidebar( 'sidebar-offcanvas' ); ?>

				<div class="cs-offcanvas__bottombar">
					<?php csco_component( 'mobile_bottom_menu' ); ?>

					<?php
						csco_component( 'misc_social_links' );
						csco_component( 'off_canvas_scheme_toggle' );
					?>
				</div>
			</div>
		</aside>

	</div>
	<?php
}
