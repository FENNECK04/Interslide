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
               $instagram     = get_theme_mod( 'misc_social_instagram', false );
               $instagram_url = get_theme_mod( 'misc_social_instagram_url' );
               $tiktok        = get_theme_mod( 'misc_social_tiktok', false );
               $tiktok_url    = get_theme_mod( 'misc_social_tiktok_url' );
               $youtube       = get_theme_mod( 'misc_social_youtube', false );
               $youtube_url   = get_theme_mod( 'misc_social_youtube_url' );

               if ( ! (
                       ( $instagram && $instagram_url ) ||
                       ( $tiktok && $tiktok_url ) ||
                       ( $youtube && $youtube_url ) ||
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
                       <?php if ( $instagram && $instagram_url ) { ?>
                               <a class="cs-social__link cs-social__link--instagram" href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener">
                                       <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077"/></svg>
                                       <span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'newsreader' ); ?></span>
                               </a>
                       <?php } ?>
                       <?php if ( $tiktok && $tiktok_url ) { ?>
                               <a class="cs-social__link cs-social__link--tiktok" href="<?php echo esc_url( $tiktok_url ); ?>" target="_blank" rel="noopener">
                                       <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                       <span class="screen-reader-text"><?php esc_html_e( 'TikTok', 'newsreader' ); ?></span>
                               </a>
                       <?php } ?>
                       <?php if ( $youtube && $youtube_url ) { ?>
                               <a class="cs-social__link cs-social__link--youtube" href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener">
                                       <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                       <span class="screen-reader-text"><?php esc_html_e( 'YouTube', 'newsreader' ); ?></span>
                               </a>
                       <?php } ?>
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
