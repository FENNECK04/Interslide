<?php
/**
 * Elementor Block
 *
 * @package Newsreader
 */

namespace ThemeElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Block
 *
 * @since 1.0.0
 */
class CSCO_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cs-banner';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cs-icon-el-wb_iridescent';
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
	 *
	 * @return array Widget categories.
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
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'General', 'newsreader' ),
			)
		);

		$this->add_control(
			'banner_html',
			array(
				'label'    => esc_html__( 'HTML Code', 'newsreader' ),
				'type'     => \Elementor\Controls_Manager::CODE,
				'language' => 'html',
				'rows'     => 20,
			)
		);

		$this->add_responsive_control(
			'banner_width',
			array(
				'label'           => esc_html__( 'Banner Width', 'newsreader' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'           => array(
					'px' => array(
						'min'  => 200,
						'max'  => 1400,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 250,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 250,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 250,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 250,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 250,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-banner-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'label_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'label_settings',
			array(
				'label' => esc_html__( 'Label', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'label',
			array(
				'label'        => esc_html__( 'Display Label', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'label_text',
			array(
				'label_block' => true,
				'label'       => esc_html__( 'Label', 'newsreader' ),
				'default'     => 'Advertisement',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'conditions'  => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'label',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'label_alignment',
			array(
				'label'      => esc_html__( 'Alignment', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => array(
					'left'   => esc_html__( 'Left', 'newsreader' ),
					'center' => esc_html__( 'Center', 'newsreader' ),
					'right'  => esc_html__( 'Right', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'label',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-banner-label-alignment: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'label_style',
			array(
				'label'      => esc_html__( 'Label Typography & Color', 'newsreader' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'label',
							'operator' => '=',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'label_typography',
				'label'      => esc_html__( 'Typography', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-banner__label',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'label',
							'operator' => '=',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'      => esc_html__( 'Color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-banner-label-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'label',
							'operator' => '=',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'Section Style', 'newsreader' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'section_container',
			array(
				'label'        => esc_html__( 'Enable Inner container', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_responsive_control(
			'section_banner_padding',
			array(
				'type'            => \Elementor\Controls_Manager::DIMENSIONS,
				'label'           => esc_html__( 'Padding', 'newsreader' ),
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'desktop_default' => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'laptop_default'  => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'tablet_default'  => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'mobile_default'  => array(
					'top'      => 0,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-banner-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'section_container',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'section_background',
			array(
				'label'        => esc_html__( 'Layout Background', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'section_background_color',
			array(
				'label'      => esc_html__( 'Custom Background', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-banner-background-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'section_background',
							'operator' => '==',
							'value'    => 'true',
						),
					),
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

		$main_class = 'cs-banner';
		if ( 'true' === $settings['section_background'] ) {
			$main_class = 'cs-banner cs-banner-background';
		}

		$container_class = '';

		if ( 'true' === $settings['section_container'] ) {
			$container_class = 'cs-container';
		}

		$alt_text = '';

		if ( isset( $settings['image']['alt'] ) && $settings['image']['alt'] ) {
			$alt_text = $settings['image']['alt'];
		}

		?>
		<section class="cs-banner-elementor">
			<div class="<?php echo esc_attr( $main_class ); ?>">
				<div class="cs-banner__container <?php echo esc_attr( $container_class ); ?>">
					<div class="cs-banner__content">
						<?php call_user_func( 'printf', '%s', $settings['banner_html'] ); ?>
					</div>
					<?php if ( 'true' === $settings['label'] && $settings['label_text'] ) { ?>
						<div class="cs-banner__label">
							<?php echo esc_attr( $settings['label_text'] ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php
	}
}
