<?php
/**
 * Menu Customization.
 *
 * @package Newsreader
 */

/**
 * -------------------------------------------------------------------------
 * [ Primary Menu ]
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'csco_primary_menu_item_args' ) ) {
	/**
	 * Filters the arguments for a single nav menu item.
	 *
	 * @param object $args  An object of wp_nav_menu() arguments.
	 * @param object $item  (WP_Post) Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 */
	function csco_primary_menu_item_args( $args, $item, $depth ) {
		$args->link_before = '';
		$args->link_after  = '';
		if ( 'primary' === $args->theme_location && 0 === $depth ) {
			$args->link_before = '<span>';
			$args->link_after  = '</span>';
		}
		return $args;
	}
	add_filter( 'nav_menu_item_args', 'csco_primary_menu_item_args', 10, 3 );
}

if ( version_compare( get_bloginfo( 'version' ), '5.4', '>=' ) ) {
	/**
	 * Add style custom fields to menu item
	 *
	 * @param int $id object id.
	 */
	function csco_menu_item_style_fields( $id ) {

		wp_nonce_field( 'csco_menu_meta_nonce', 'csco_menu_meta_nonce_name' );

		$item_style = get_post_meta( $id, '_csco_menu_item_style', true );

		$item_styles = array(
			'none'   => esc_html__( 'None', 'newsreader' ),
			'icon'   => esc_html__( 'Icon', 'newsreader' ),
			'accent' => esc_html__( 'Accent', 'newsreader' ),
		);
		?>
		<p class="description description-thin">
			<label for="<?php echo esc_attr( $id ); ?>"><?php esc_html_e( 'Style', 'newsreader' ); ?></label>
			<select class="widefat" name="csco_menu_item_style[<?php echo esc_attr( $id ); ?>]">
				<?php
				foreach ( $item_styles as $value => $label ) {
					?>
					<option value="<?php echo esc_attr( $value ); ?>" class="csco-item-style-<?php echo esc_attr( $value ); ?>" <?php selected( $item_style, $value ); ?>><?php echo esc_html( $label ); ?></option>
					<?php
				}
				?>
			</select>
		</p>
		<?php
	}
	add_action( 'wp_nav_menu_item_custom_fields', 'csco_menu_item_style_fields' );

	/**
	 * Save the style menu item meta
	 *
	 * @param int $menu_id menu id.
	 * @param int $menu_item_db_id menu item db id.
	 */
	function csco_menu_item_style_fields_update( $menu_id, $menu_item_db_id ) {

		// Check ajax.
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		// Security.
		check_admin_referer( 'csco_menu_meta_nonce', 'csco_menu_meta_nonce_name' );

		// Save style.
		if ( isset( $_POST['csco_menu_item_style'][ $menu_item_db_id ] ) ) {
			$sanitized_data = sanitize_text_field( $_POST['csco_menu_item_style'][ $menu_item_db_id ] );
			update_post_meta( $menu_item_db_id, '_csco_menu_item_style', $sanitized_data );
		} else {
			delete_post_meta( $menu_item_db_id, '_csco_menu_item_style' );
		}
	}
	add_action( 'wp_update_nav_menu_item', 'csco_menu_item_style_fields_update', 10, 2 );

	/**
	 * Filters the CSS class(es) applied to a menu item's list item element.
	 *
	 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $item    The current menu item.
	 * @param stdClass $args    An object of wp_nav_menu() arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 * @return array (Maybe) modified CSS classes.
	 */
	function csco_menu_item_classes( $classes, $item, $args, $depth ) {
		$item_style = get_post_meta( $item->ID, '_csco_menu_item_style', true );

		if ( $item_style ) {
			$classes[] = 'csco-menu-item-style-' . $item_style;
		}

		return $classes;
	}
	add_filter( 'nav_menu_css_class', 'csco_menu_item_classes', 10, 4 );
}
