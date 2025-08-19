<?php
namespace ThemeElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Block
 *
 * @since 1.0.0
 */
class CSCO_Section_Divider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'cs-divider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Divider', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'cs-icon-el-horizontal_rule';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'theme' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'newsreader' ),
			)
		);

		$this->add_responsive_control(
			'type',
			array(
				'label'           => esc_html__( 'Type', 'newsreader' ),
				'type'            => \Elementor\Controls_Manager::CHOOSE,
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => 'horizontal',
				'desktop_default' => 'horizontal',
				'laptop_default'  => 'horizontal',
				'tablet_default'  => 'horizontal',
				'mobile_default'  => 'horizontal',
				'options'         => array(
					'horizontal' => array(
						'title' => 'horizontal',
						'icon'  => 'eicon-v-align-stretch',
					),
					'vertical'   => array(
						'title' => 'vertical',
						'icon'  => ' eicon-h-align-stretch',
					),
				),
				'prefix_class'    => 'cs-divider%s',
			)
		);

		$this->add_responsive_control(
			'thikness',
			array(
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'label'           => esc_html__( 'Divider Thickness (px)', 'newsreader' ),
				'range'           => array(
					'px' => array(
						'min' => 1,
						'max' => 5,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 1,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 1,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 1,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 1,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 1,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-divider-section-thikness: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'divider_color',
			array(
				'label'     => esc_html__( 'Divider Color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-divider-section-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$section_class = sprintf( 'cs-divider cs-divider-%s', $settings['type'] );

		?>
		<section class="<?php echo esc_attr( $section_class ); ?>"></section>
		<?php
	}
}
