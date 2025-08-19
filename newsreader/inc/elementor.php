<?php
/**
 * Support Elementor.
 *
 * @package Newsreader
 */

namespace ThemeElementor;

/**
 * Class CSCO_Theme_Elementor
 */
class CSCO_Theme_Elementor {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var CSCO_Theme_Elementor The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return CSCO_Theme_Elementor An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 */
	public function __construct() {
		add_action( 'activated_plugin', array( $this, 'activated_elementor' ) );
		add_action( 'template_redirect', array( $this, 'update_default_settings' ) );

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'elementor_enqueue_assets' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'elementor_enqueue_assets' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_enqueue_scripts' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_categories' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		add_action( 'elementor/element/before_section_end', array( $this, 'before_section_end' ), 10, 3 );
	}

	/**
	 * Editor styles
	 */
	public function editor_enqueue_scripts() {
		$version = csco_get_theme_data( 'Version' );

		wp_enqueue_style( 'cs-elementor-icons', get_template_directory_uri() . '/front-end/static/css/elementor-icons.css', array(), $version );
	}

	/**
	 * Fires after a plugin has been activated.
	 *
	 * @param string $plugin If a plugin is silently activated (such as during an update), this hook does not fire.
	 */
	public function activated_elementor( $plugin ) {

		if ( 'elementor/elementor.php' === $plugin ) {
			delete_option( 'csco_elementor_init' );
		}
	}

	/**
	 * Enqueue specific assets.
	 */
	public function elementor_enqueue_assets() {
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();

		wp_register_style( 'cs-elementor-editor', false );
		wp_enqueue_style( 'cs-elementor-editor' );

		$container_width        = $kit->get_settings( 'container_width' );
		$container_width_laptop = $kit->get_settings( 'container_width_laptop' );
		$container_width_tablet = $kit->get_settings( 'container_width_tablet' );
		$container_width_mobile = $kit->get_settings( 'container_width_mobile' );

		$styles_container_width = __return_empty_string();

		if ( is_array( $container_width ) && isset( $container_width['size'] ) ) {
			$styles_container_width .= sprintf( ' --cs-desktop-container: %spx;', $container_width['size'] );
		}
		if ( is_array( $container_width_laptop ) && isset( $container_width_laptop['size'] ) ) {
			$styles_container_width .= sprintf( ' --cs-laptop-container: %spx;', $container_width_laptop['size'] );
		}
		if ( is_array( $container_width_tablet ) && isset( $container_width_tablet['size'] ) ) {
			$styles_container_width .= sprintf( ' --cs-tablet-container: %spx;', $container_width_tablet['size'] );
		}
		if ( is_array( $container_width_mobile ) && isset( $container_width_mobile['size'] ) ) {
			$styles_container_width .= sprintf( ' --cs-mobile-container: %spx;', $container_width_mobile['size'] );
		}

		if ( $styles_container_width ) {
			wp_add_inline_style( 'cs-elementor-editor', sprintf( ':root { %s }', $styles_container_width ) );
		}
	}

	/**
	 * Update default settings.
	 */
	public function update_default_settings() {
		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		if ( get_option( 'csco_elementor_init' ) ) {
			return;
		}

		// Set global settings.
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();

		if ( ! $kit ) {
			return;
		}

		$kit->update_settings(
			array(
				'active_breakpoints'     => array(
					'viewport_mobile',
					'viewport_tablet',
					'viewport_laptop',
				),
				'container_width'        => array(
					'size' => 1448,
				),
				'container_width_laptop' => array(
					'size' => 1200,
				),
				'container_width_tablet' => array(
					'size' => 992,
				),
				'container_width_mobile' => array(
					'size' => 768,
				),
				'space_between_widgets'  => array(
					'size' => 40,
				),
				'viewport_laptop'        => 1199,
				'viewport_tablet'        => 991,
				'viewport_mobile'        => 767,
			)
		);

		// Active custom breakpoints.
		update_option( 'elementor_experiment-additional_custom_breakpoints', 'active' );
		update_option( 'elementor_additional_custom_breakpoints', 'active' );

		// Set elementor init.
		update_option( 'csco_elementor_init', true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 */
	private function include_widgets_files() {
		require_once get_template_directory() . '/inc/elementor/heading.php';
		require_once get_template_directory() . '/inc/elementor/hero.php';
		require_once get_template_directory() . '/inc/elementor/carousel.php';
		require_once get_template_directory() . '/inc/elementor/featured-posts.php';
		require_once get_template_directory() . '/inc/elementor/posts.php';
		require_once get_template_directory() . '/inc/elementor/tabs.php';
		require_once get_template_directory() . '/inc/elementor/divider.php';
		require_once get_template_directory() . '/inc/elementor/banner.php';
		require_once get_template_directory() . '/inc/elementor/subscribe.php';
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files.
		$this->include_widgets_files();

		// Register Widgets.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Hero() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Featured_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Section_Divider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\CSCO_Subscribe() );
	}

	/**
	 * Register Categories
	 *
	 * Register new Elementor categories.
	 *
	 * @param object $elements_manager Elements manager.
	 */
	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'theme',
			array(
				'title' => esc_html__( 'Theme', 'newsreader' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Before section end.
	 *
	 * Fires before Elementor section ends in the editor panel.
	 *
	 * @since 1.4.0
	 *
	 * @param Controls_Stack $object     The control.
	 * @param string         $section_id Section ID.
	 * @param array          $args       Section arguments.
	 */
	public function before_section_end( $object, $section_id, $args ) {

		// Change layout section.
		if ( 'section_settings-layout' === $section_id ) {
			$object->update_control(
				'container_width',
				array(
					'default'        => array(
						'size' => '1448',
					),
					'laptop_default' => array(
						'size' => '1200',
					),
					'tablet_default' => array(
						'size' => '992',
					),
					'mobile_default' => array(
						'size' => '768',
					),
					'description'    => esc_html__( 'Sets the default width of the content area (Default: 1336)', 'newsreader' ),
				)
			);

			$object->update_control(
				'space_between_widgets',
				array(
					'default'     => array(
						'size' => 40,
					),
					'description' => esc_html__( 'Sets the default space between widgets (Default: 40)', 'newsreader' ),
				)
			);
		}

		// Change breakpoints section.
		if ( 'section_breakpoints' === $section_id ) {
			$object->update_control(
				'active_breakpoints',
				array(
					'default'       => array(
						'viewport_mobile',
						'viewport_tablet',
						'viewport_laptop',
					),
					'lockedOptions' => array(
						'viewport_mobile',
						'viewport_tablet',
						'viewport_laptop',
					),
					'description'   => esc_html__( 'Mobile, Tablet, Laptop options cannot be deleted.', 'newsreader' ),
				)
			);

			// Set breakpoints placeholder.

			$default_breakpoints_config = \Elementor\Core\Breakpoints\Manager::get_default_config();

			$prefix = \Elementor\Core\Breakpoints\Manager::BREAKPOINT_SETTING_PREFIX;

			foreach ( $default_breakpoints_config as $breakpoint_key => $default_breakpoint_config ) {

				if ( 'viewport_laptop' === $prefix . $breakpoint_key ) {
					$default_breakpoint = 1199;
				}
				if ( 'viewport_tablet' === $prefix . $breakpoint_key ) {
					$default_breakpoint = 991;
				}
				if ( 'viewport_mobile' === $prefix . $breakpoint_key ) {
					$default_breakpoint = 767;
				}

				if ( isset( $default_breakpoint ) && $default_breakpoint ) {
					$object->update_control(
						$prefix . $breakpoint_key,
						array(
							'placeholder' => $default_breakpoint,
						)
					);
				}
			}
		}
	}
}

// Instantiate CSCO_Theme_Elementor Class.
CSCO_Theme_Elementor::instance();
