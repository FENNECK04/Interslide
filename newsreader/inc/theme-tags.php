<?php
/**
 * Template Tags
 *
 * Functions that are called directly from template parts or within actions.
 *
 * @package Newsreader
 */

if ( ! function_exists( 'csco_header_nav_menu' ) ) {
	class CSCO_NAV_Walker extends Walker_Nav_Menu {
		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
		 *              to match parent class for PHP 8 named parameter support.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output            Used to append additional content (passed by reference).
		 * @param WP_Post  $data_object       Menu item data object.
		 * @param int      $depth             Depth of menu item. Used for padding.
		 * @param stdClass $args              An object of wp_nav_menu() arguments.
		 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
		 */
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			// Restores the more descriptive, specific name for use within this method.
			$menu_item = $data_object;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
			$classes[] = 'menu-item-' . $menu_item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param WP_Post  $menu_item Menu item data object.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
			$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
			if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
				$atts['rel'] = 'noopener';
			} else {
				$atts['rel'] = $menu_item->xfn;
			}
			$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
			$atts['aria-current'] = $menu_item->current ? 'page' : '';

			if ( '#' === trim( $menu_item->url ) ) {
					$atts['class'] = 'menu-item-without-link';
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria-current The aria-current attribute.
			 * }
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/**
			 * The the_title hook.
			 *
			 * @since 1.0.0
			 */
			$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title     The menu item's title.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

			$link_tag = 'a';

			$item_output  = $args->before;
			$item_output .= '<' . $link_tag . $attributes . '>';
			$item_output .= $args->link_before . '<span>' . $title . '</span>' . $args->link_after;
			$item_output .= '</' . $link_tag . '>';
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $menu_item   Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
		}
	}

	/**
	 * Header Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_nav_menu( $settings = array() ) {
		if ( ! get_theme_mod( 'header_navigation_menu', true ) ) {
			return;
		}

		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__nav-inner',
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'container_class' => 'cs-header__nav',
					'walker'          => new CSCO_NAV_Walker(),
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_nav_secondary_menu' ) ) {
	class CSCO_NAV_Secondary_Walker extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @since 3.0.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			$classes = array( 'sub-menu' );

			$scheme = csco_color_scheme(
				get_theme_mod( 'color_header_submenu_background', '#0e131a' ),
				get_theme_mod( 'color_headerr_submenu_background_is_dark', '#161616' )
			);

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since 4.8.0
			 *
			 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}<ul$class_names {$scheme}>{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
		 *              to match parent class for PHP 8 named parameter support.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output            Used to append additional content (passed by reference).
		 * @param WP_Post  $data_object       Menu item data object.
		 * @param int      $depth             Depth of menu item. Used for padding.
		 * @param stdClass $args              An object of wp_nav_menu() arguments.
		 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
		 */
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			// Restores the more descriptive, specific name for use within this method.
			$menu_item = $data_object;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
			$classes[] = 'menu-item-' . $menu_item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param WP_Post  $menu_item Menu item data object.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
			$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
			if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
				$atts['rel'] = 'noopener';
			} else {
				$atts['rel'] = $menu_item->xfn;
			}
			$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
			$atts['aria-current'] = $menu_item->current ? 'page' : '';

			if ( '#' === trim( $menu_item->url ) ) {
					$atts['class'] = 'menu-item-without-link';
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria-current The aria-current attribute.
			 * }
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/**
			 * The the_title hook.
			 *
			 * @since 1.0.0
			 */
			$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title     The menu item's title.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

			$link_tag = 'a';

			$item_output  = $args->before;
			$item_output .= '<' . $link_tag . $attributes . '>';
			$item_output .= $args->link_before . '<span>' . $title . '</span>' . $args->link_after;
			$item_output .= '</' . $link_tag . '>';
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $menu_item   Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
		}
	}

	/**
	 * Header Nav Secondary Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_nav_secondary_menu( $settings = array() ) {

		if ( has_nav_menu( 'secondary' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__nav-inner',
					'theme_location'  => 'secondary',
					'container'       => 'nav',
					'container_class' => 'cs-nav-secondary',
					'walker'          => new CSCO_NAV_Secondary_Walker(),
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_header_additional_menu' ) ) {
	/**
	 * Header Additional Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_additional_menu( $settings = array() ) {
		if ( has_nav_menu( 'additional' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__top-nav',
					'theme_location'  => 'additional',
					'container'       => '',
					'container_class' => '',
					'depth'           => 1,
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_header_logo' ) ) {
	/**
	 * Header Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_logo( $settings = array() ) {

		$logo_default_name = 'logo';
		$logo_dark_name    = 'logo_dark';
		$logo_class        = null;

		$settings = array_merge(
			array(
				'variant' => null,
			),
			$settings
		);

		// For hide logo.
		if ( 'hide' === $settings['variant'] ) {
			$logo_class = 'cs-logo-hide';
		}

		// Get default logo.
		$logo_url = get_theme_mod( $logo_default_name );

		$logo_id = attachment_url_to_postid( $logo_url );

		// Set mode of logo.
		$logo_mode = 'cs-logo-once';

		// Check display mode.
		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo cs-logo-desktop">
			<a class="cs-header__logo <?php echo esc_attr( $logo_mode ); ?> <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {

				$logo_dark_url = get_theme_mod( $logo_dark_name ) ? get_theme_mod( $logo_dark_name ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-header__logo cs-logo-dark <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_offcanvas_toggle' ) ) {
	/**
	 * Header Offcanvas Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_offcanvas_toggle( $settings = array() ) {

		if ( csco_offcanvas_exists() ) {

			if ( ! isset( $settings['mobile'] ) ) {
				if ( ! get_theme_mod( 'header_offcanvas', false ) ) {
					return;
				}
			}

			$class = __return_empty_string();
			?>
				<span class="cs-header__burger-toggle <?php echo esc_attr( $class ); ?>" role="button" aria-label="<?php echo esc_html__( 'Burger menu button', 'newsreader' ); ?>">
					<i class="cs-icon cs-icon-menu"></i>
					<i class="cs-icon cs-icon-x"></i>
				</span>
				<span class="cs-header__offcanvas-toggle <?php echo esc_attr( $class ); ?>" role="button" aria-label="<?php echo esc_html__( 'Mobile menu button', 'newsreader' ); ?>">
					<i class="cs-icon cs-icon-menu"></i>
				</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_misc_social_links' ) ) {
	/**
	 * Social Links
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_misc_social_links( $settings = array() ) {
		if ( ! (
			get_theme_mod( 'misc_social_1', false ) ||
			get_theme_mod( 'misc_social_2', false ) ||
			get_theme_mod( 'misc_social_3', false ) ||
			get_theme_mod( 'misc_social_4', false ) ||
			get_theme_mod( 'misc_social_5', false )
			) ) {
			return;
		}

		$social_1       = get_theme_mod( 'misc_social_1', false );
		$social_1_url   = get_theme_mod( 'misc_social_1_link' );
		$social_1_image = get_theme_mod( 'misc_social_1_icon' );
		$social_1_alt   = get_theme_mod( 'misc_social_1_label' );
		if ( $social_1_image ) {
			$social_1_id = attachment_url_to_postid( $social_1_image );
		}

		$social_2       = get_theme_mod( 'misc_social_2', false );
		$social_2_url   = get_theme_mod( 'misc_social_2_link' );
		$social_2_image = get_theme_mod( 'misc_social_2_icon' );
		$social_2_alt   = get_theme_mod( 'misc_social_2_label' );
		if ( $social_2_image ) {
			$social_2_id = attachment_url_to_postid( $social_2_image );
		}

		$social_3       = get_theme_mod( 'misc_social_3', false );
		$social_3_url   = get_theme_mod( 'misc_social_3_link' );
		$social_3_image = get_theme_mod( 'misc_social_3_icon' );
		$social_3_alt   = get_theme_mod( 'misc_social_3_label' );
		if ( $social_3_image ) {
			$social_3_id = attachment_url_to_postid( $social_3_image );
		}

		$social_4       = get_theme_mod( 'misc_social_4', false );
		$social_4_url   = get_theme_mod( 'misc_social_4_link' );
		$social_4_image = get_theme_mod( 'misc_social_4_icon' );
		$social_4_alt   = get_theme_mod( 'misc_social_4_label' );
		if ( $social_4_image ) {
			$social_4_id = attachment_url_to_postid( $social_4_image );
		}

		$social_5       = get_theme_mod( 'misc_social_5', false );
		$social_5_url   = get_theme_mod( 'misc_social_5_link' );
		$social_5_image = get_theme_mod( 'misc_social_5_icon' );
		$social_5_alt   = get_theme_mod( 'misc_social_5_label' );
		if ( $social_5_image ) {
			$social_5_id = attachment_url_to_postid( $social_5_image );
		}
		?>
		<div class="cs-social">
			<?php if ( $social_1 && ( isset( $social_1_id ) && $social_1_id ) && $social_1_url ) { ?>
				<a class="cs-social__link" href="<?php echo esc_url( $social_1_url ); ?>" target="_blank">
					<?php csco_get_retina_image( $social_1_id, array( 'alt' => $social_1_alt ) ); ?>
				</a>
			<?php } ?>
			<?php if ( $social_2 && ( isset( $social_2_id ) && $social_2_id ) && $social_2_url ) { ?>
				<a class="cs-social__link" href="<?php echo esc_url( $social_2_url ); ?>" target="_blank">
					<?php csco_get_retina_image( $social_2_id, array( 'alt' => $social_2_alt ) ); ?>
				</a>
			<?php } ?>
			<?php if ( $social_3 && ( isset( $social_3_id ) && $social_3_id ) && $social_3_url ) { ?>
				<a class="cs-social__link" href="<?php echo esc_url( $social_3_url ); ?>" target="_blank">
					<?php csco_get_retina_image( $social_3_id, array( 'alt' => $social_3_alt ) ); ?>
				</a>
			<?php } ?>
			<?php if ( $social_4 && ( isset( $social_4_id ) && $social_4_id ) && $social_4_url ) { ?>
				<a class="cs-social__link" href="<?php echo esc_url( $social_4_url ); ?>" target="_blank">
					<?php csco_get_retina_image( $social_4_id, array( 'alt' => $social_4_alt ) ); ?>
				</a>
			<?php } ?>
			<?php if ( $social_5 && ( isset( $social_5_id ) && $social_5_id ) && $social_5_url ) { ?>
				<a class="cs-social__link" href="<?php echo esc_url( $social_5_url ); ?>" target="_blank">
					<?php csco_get_retina_image( $social_5_id, array( 'alt' => $social_5_alt ) ); ?>
				</a>
			<?php } ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_misc_subscribe' ) ) {
	/**
	 * Subscribe section
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_misc_subscribe( $settings = array() ) {
		$misc_subscribe = get_theme_mod( 'misc_subscribe', true );

		if ( ! $misc_subscribe ) {
			return;
		}

		$subscribe_heading     = get_theme_mod( 'misc_subscribe_heading' );
		$subscribe_mailchimp   = get_theme_mod( 'misc_subscribe_mailchimp' );
		$subscribe_description = get_theme_mod( 'misc_subscribe_description' );

		?>
		<div class="cs-subscribe">
			<div class="cs-subscribe__content">

				<?php if ( $subscribe_heading ) { ?>
					<div class="cs-subscribe__header">
						<h2 class="cs-subscribe__heading">
							<?php echo esc_html( $subscribe_heading ); ?>
						</h2>
					</div>
				<?php } ?>

				<?php if ( $subscribe_mailchimp ) { ?>
					<form class="cs-subscribe__form" action="<?php echo esc_url( $subscribe_mailchimp ); ?>" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="novalidate">
						<div class="cs-subscribe__form-group" data-scheme="light">
							<input type="email" placeholder="<?php esc_attr_e( 'E-mail', 'newsreader' ); ?>" name="EMAIL">
							<button type="submit" value="Subscribe" name="subscribe"><?php esc_html_e( 'Subscribe', 'newsreader' ); ?></button>
						</div>
						<div class="cs-subscribe__form-response clear" id="mce-responses">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>

						<?php if ( $subscribe_description ) { ?>
							<div class="cs-subscribe__description">
								<?php echo do_shortcode( $subscribe_description ); ?>
							</div>
						<?php } ?>
					</form>
				<?php } ?>

			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_entry_subscribe' ) ) {
	/**
	 * Entry Subscribe section
	 */
	function csco_entry_subscribe() {

		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$entry_subscribe = get_theme_mod( 'post_subscribe', false );

		if ( ! $entry_subscribe ) {
			return;
		}

		?>
		<section class="cs-subscribe-entry">
			<?php csco_component( 'misc_subscribe' ); ?>
		</section>
		<?php
	}
}

if ( ! function_exists( 'csco_header_subscribe' ) ) {
	/**
	 * Footer Subscribe section
	 */
	function csco_header_subscribe() {

		$header_subscribe = get_theme_mod( 'header_follow_subscribe', false );

		if ( ! $header_subscribe ) {
			return;
		}

		?>
			<?php csco_component( 'misc_subscribe' ); ?>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_subscribe' ) ) {
	/**
	 * Footer Subscribe section
	 */
	function csco_footer_subscribe() {

		$footer_subscribe = get_theme_mod( 'footer_subscribe', false );

		if ( ! $footer_subscribe ) {
			return;
		}

		?>
		<div class="cs-footer__col cs-col-right">
			<?php csco_component( 'misc_subscribe' ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_search_toggle' ) ) {
	/**
	 * Header Search Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_search_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		?>
		<span class="cs-header__search-toggle" role="button" aria-label="<?php echo esc_html__( 'Search', 'newsreader' ); ?>">
			<i class="cs-icon cs-icon-search"></i>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_follow' ) ) {
	/**
	 * Header Follow
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_follow( $settings = array() ) {
		if ( ! get_theme_mod( 'header_follow', false ) ) {
			return;
		}

		$follow_text      = get_theme_mod( 'follow_text' );
		$social_links     = get_theme_mod( 'header_social_links', false );
		$follow_subscribe = get_theme_mod( 'header_follow_subscribe', false );

		?>
		<div class="cs-follow">
			<div class="cs-follow__toggle">
				<?php if ( $follow_text ) { ?>
					<div class="cs-follow__toggle-name">
						<?php echo do_shortcode( $follow_text ); ?>
					</div>
				<?php } ?>
				<div class="cs-follow__toggle-icon">
					<span>
						<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="1.23522" cy="1.23529" r="1.23529" />
							<circle cx="5.70581" cy="1.23529" r="1.23529" />
							<circle cx="10.1764" cy="1.23529" r="1.23529" />
							<circle cx="1.23522" cy="5.706" r="1.23529" />
							<circle cx="5.70581" cy="5.706" r="1.23529" />
							<circle cx="10.1764" cy="5.706" r="1.23529" />
							<circle cx="1.23522" cy="10.1767" r="1.23529" />
							<circle cx="5.70581" cy="10.1767" r="1.23529" />
							<circle cx="10.1764" cy="10.1767" r="1.23529" />
						</svg>
					</span>
				</div>
			</div>
			<div class="cs-follow__dropdown">

				<div class="cs-follow__content">
					<div class="cs-follow__content-inner">
						<?php if ( $follow_subscribe && csco_component( 'header_subscribe', false ) ) { ?>
							<?php csco_component( 'header_subscribe' ); ?>
						<?php } ?>

						<?php if ( $follow_text || $social_links ) { ?>
							<div class="cs-follow__content-footer">
								<?php if ( $follow_text ) { ?>
									<div class="cs-follow__content-text">
										<?php echo do_shortcode( $follow_text ); ?>
									</div>
								<?php } ?>

								<?php if ( $social_links ) { ?>
									<div class="cs-follow__content-icons">
										<?php csco_component( 'misc_social_links' ); ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle' ) ) {
	/**
	 * Header Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
			<span class="cs-site-scheme-toggle cs-header__scheme-toggle" role="button" aria-label="<?php echo esc_html__( 'Dark mode toggle button', 'newsreader' ); ?>">
				<span class="cs-header__scheme-toggle-icons">
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
				</span>
			</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle_mobile' ) ) {
	/**
	 * Header Scheme Toggle Mobile
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle_mobile( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
		<span class="cs-header__scheme-toggle cs-header__scheme-toggle-mobile cs-site-scheme-toggle" role="button" aria-label="<?php echo esc_html__( 'Scheme Toggle', 'newsreader' ); ?>">
			<span class="cs-header__scheme-toggle-icons">
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
				<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
			</span>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_custom_button' ) ) {
	/**
	 * Header Custom Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_custom_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', false ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );

		if ( $button && $link ) {
			?>
			<a class="cs-button cs-header__custom-button" href="<?php echo esc_url( $link ); ?>" target="_blank">
				<?php echo wp_kses( $button, 'content' ); ?>
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_mobile_logo' ) ) {
	/**
	 * Mobile Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_mobile_logo( $settings = array() ) {
		$logo_url = get_theme_mod( 'mobile_logo' );

		$logo_id = attachment_url_to_postid( $logo_url );

		$logo_mode = 'cs-logo-once';

		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo cs-logo-mobile">
			<a class="cs-header__logo cs-header__logo-mobile <?php echo esc_attr( $logo_mode ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {

				$logo_dark_url = get_theme_mod( 'mobile_logo_dark' ) ? get_theme_mod( 'mobile_logo_dark' ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-header__logo cs-logo-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_logo' ) ) {
	/**
	 * Footer Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_logo( $settings = array() ) {
		$logo_url = get_theme_mod( 'footer_logo' );

		$logo_id = attachment_url_to_postid( $logo_url );

		$logo_mode = 'cs-logo-once';

		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo">
			<a class="cs-footer__logo <?php echo esc_attr( $logo_mode ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {

				$logo_dark_url = get_theme_mod( 'footer_logo_dark' ) ? get_theme_mod( 'footer_logo_dark' ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-footer__logo cs-logo-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_copyright' ) ) {
	/**
	 * Footer Copyright
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_copyright( $settings = array() ) {
		$footer_copyright = get_theme_mod( 'footer_copyright', sprintf( esc_html__( '© %s Newsreader. All Rights Reserved.', 'newsreader' ), date( 'Y' ) ) );
		if ( $footer_copyright ) {
			?>
			<div class="cs-footer__copyright">
				<?php echo do_shortcode( $footer_copyright ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_bottombar_nav_menu' ) ) {
	/**
	 * Footer Columns Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_bottombar_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'bottombar' ) ) {

			wp_nav_menu(
				array(
					'theme_location'  => 'bottombar',
					'container_class' => '',
					'menu_class'      => sprintf( 'cs-header-bottombar__nav %s', $settings['menu_class'] ),
					'container'       => '',
					'depth'           => 1,
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_burger_nav_menu' ) ) {
	/**
	 * Burger Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_burger_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'burger' ) ) {
			?>
			<div class="cs-burger-menu__nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'burger',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-burger-menu__nav-menu %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 2,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_burger_menu' ) ) {
	/**
	 * Burger Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_burger_menu( $settings = array() ) {
		if ( has_nav_menu( 'burger' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__top-nav',
					'theme_location'  => 'burger',
					'container'       => '',
					'container_class' => '',
					'depth'           => 1,
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_burger_bottom_menu' ) ) {
	/**
	 * Burger bottom menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_burger_bottom_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'burger_bottom' ) ) {
			?>
			<div class="cs-burger-menu__bottombar-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'burger_bottom',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-burger-menu__bottombar-nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_mobile_bottom_menu' ) ) {
	/**
	 * Mobile bottom menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_mobile_bottom_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'mobile_bottom' ) ) {
			?>
			<div class="cs-mobile-menu__bottombar-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'mobile_bottom',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-mobile-menu__bottombar-nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_columns_nav_menu' ) ) {
	/**
	 * Footer Columns Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_columns_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'footer_columns' ) ) {
			?>
			<div class="cs-footer-columns__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer_columns',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer-columns__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 2,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_nav_menu' ) ) {
	/**
	 * Footer Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'footer' ) ) {
			?>
			<div class="cs-footer__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_secondary_nav_menu' ) ) {
	/**
	 * Footer Secondary Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_secondary_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'footer_secondary' ) ) {
			?>
			<div class="cs-footer-secondary__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer_secondary',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 1,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_off_canvas_button' ) ) {
	/**
	 * Off-Canvas Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', false ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );

		if ( $button && $link ) {
			?>
			<div class="cs-offcanvas__button">
				<a class="cs-button cs-offcanvas__button" href="<?php echo esc_url( $link ); ?>" target="_blank">
					<?php echo wp_kses( $button, 'content' ); ?>
				</a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_scroll_to_top' ) ) {
	/**
	 * Scroll to Top
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_scroll_to_top( $settings = array() ) {
		if ( ! get_theme_mod( 'misc_scroll_to_top', true ) ) {
			return;
		}
		?>
			<button class="cs-scroll-top" role="button" aria-label="<?php echo esc_html__( 'Scroll to top button', 'newsreader' ); ?>">
				<i class="cs-icon-chevron-up"></i>
				<div class="cs-scroll-top-border">
					<svg width="52" height="52" viewBox="0 0 52 52">
						<path d="M26,2 a24,24 0 0,1 0,48 a24,24 0 0,1 0,-48" style="stroke-width: 2; fill: none;"></path>
					</svg>
				</div>
				<div class="cs-scroll-top-progress">
					<svg width="52" height="52" viewBox="0 0 52 52">
						<path d="M26,2 a24,24 0 0,1 0,48 a24,24 0 0,1 0,-48" style="stroke-width: 2; fill: none;"></path>
					</svg>
				</div>
			</button>
		<?php
	}
}

if ( ! function_exists( 'csco_off_canvas_scheme_toggle' ) ) {
	/**
	 * Offcanvas Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
			<span class="cs-site-scheme-toggle cs-offcanvas__scheme-toggle" role="button" aria-label="<?php echo esc_html__( 'Scheme Toggle', 'newsreader' ); ?>">
				<span class="cs-header__scheme-toggle-icons">
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i>
					<i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i>
				</span>
			</span>
		<?php
	}
}

if ( ! function_exists( 'csco_the_post_format_icon' ) ) {
	/**
	 * Post Format Icon
	 *
	 * @param string $content After content.
	 */
	function csco_the_post_format_icon( $content = null ) {
		$post_format = get_post_format();

		if ( 'gallery' === $post_format ) {
			$attachments = count(
				(array) get_children(
					array(
						'post_parent' => get_the_ID(),
						'post_type'   => 'attachment',
					)
				)
			);

			$content = $attachments ? sprintf( '<span>%s</span>', $attachments ) : '';
		}

		if ( $post_format ) {
			?>
			<span class="cs-entry-format">
				<i class="cs-format-icon cs-format-<?php echo esc_attr( $post_format ); ?>"></i>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_post_subtitle' ) ) {
	/**
	 * Post Subtitle
	 */
	function csco_post_subtitle() {
		if ( ! is_single() ) {
			return;
		}

		if ( get_theme_mod( 'post_subtitle', true ) ) {
			/**
			 * The plugins/wp_subtitle/get_subtitle hook.
			 *
			 * @since 1.0.0
			 */
			$subtitle = apply_filters( 'plugins/wp_subtitle/get_subtitle', '', array(
				'before'  => '',
				'after'   => '',
				'post_id' => get_the_ID(),
			) );

			if ( $subtitle ) {
				?>
				<div class="cs-entry__subtitle">
					<?php echo wp_kses( $subtitle, 'content' ); ?>
				</div>
				<?php
			} elseif ( has_excerpt() ) {
				?>
				<div class="cs-entry__subtitle">
					<?php the_excerpt(); ?>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'csco_archive_post_description' ) ) {
	/**
	 * Post Description in Archive Pages
	 */
	function csco_archive_post_description() {
		$description = get_the_archive_description();
		if ( $description ) {
			?>
			<div class="cs-page__archive-description">
				<?php echo do_shortcode( $description ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_archive_post_count' ) ) {
	/**
	 * Post Count in Archive Pages
	 */
	function csco_archive_post_count() {
		global $wp_query;
		$found_posts = $wp_query->found_posts;

		if ( $found_posts > 0 ) {
			?>
			<div class="cs-page__archive-count">
				<?php
				/* translators: 1: Singular, 2: Plural. */
				$found_posts_count = sprintf( _n( '%s post', '%s posts', $found_posts, 'newsreader' ), $found_posts );

				/**
				 * The csco_article_full_count hook.
				 *
				 * @since 1.0.0
				 */
				echo esc_html( apply_filters( 'csco_article_full_count', $found_posts_count, $found_posts ) );
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_site_branding' ) ) {
	/**
	 * Site Branding
	 */
	function csco_site_branding() {
		$branding_enable           = get_theme_mod( 'branding_enable', 'disabled' );
		$branding_banner_top       = get_theme_mod( 'branding_banner_top' );
		$branding_banner_wallpaper = get_theme_mod( 'branding_banner_wallpaper' );
		$branding_url              = get_theme_mod( 'branding_link' );
		$branding_desc             = get_theme_mod( 'branding_desc' );
		$branding_target           = get_theme_mod( 'branding_target', '_self' );

		if ( 'top' === $branding_enable ) {

			$branding_banner = $branding_banner_top;

		} elseif ( 'wallpaper' === $branding_enable ) {

			$branding_banner = $branding_banner_wallpaper;

		} else {
			$branding_banner = __return_empty_string();
		}

		$desktop = filter_var( get_theme_mod( 'branding_top_desktop', '15%' ), FILTER_SANITIZE_NUMBER_INT );

		if ( 'disabled' !== $branding_enable && $branding_banner ) {
			$banner_id = attachment_url_to_postid( $branding_banner );

			if ( $banner_id ) {
				?>
				<div class="cs-branding" data-pc="<?php echo esc_attr( $desktop ); ?>">
					<div class="cs-branding__image">
						<?php csco_get_retina_image( $banner_id, array( 'alt' => $branding_desc ) ); ?>
					</div>

					<?php if ( $branding_url ) { ?>
						<a class="cs-branding__link" href="<?php echo esc_attr( $branding_url ); ?>" target="<?php echo esc_attr( $branding_target ); ?>" title="<?php echo esc_attr( $branding_desc ); ?>"></a>
					<?php } ?>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'csco_banner' ) ) {
	/**
	 * Banner Section
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_banner( $settings ) {
		$section_class = 'cs-banner-entry cs-banner-' . $settings['banner_section'];

		if ( 'post-inner' === $settings['banner_section'] ) {
			'default' !== $settings['banner_alignment'] ? $section_class .= ' ' . $settings['banner_alignment'] : '';
		}

		$container_class = '';
		?>
		<section class="<?php echo esc_attr( $section_class ); ?>">
			<div class="cs-banner cs-banner-background">
				<div class="cs-banner__container <?php echo esc_attr( $container_class ); ?>">
					<div class="cs-banner__content">
						<?php echo do_shortcode( $settings['banner_html'] ); ?>
					</div>

					<?php if ( true === $settings['banner_label'] && $settings['banner_label_text'] ) { ?>
						<div class="cs-banner__label">
							<?php echo esc_attr( $settings['banner_label_text'] ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php
	}
}
