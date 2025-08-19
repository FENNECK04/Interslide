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
class CSCO_Heading extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'cs-heading';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Heading', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'cs-icon-el-text_fields';
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

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'newsreader' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Heading',
			)
		);

		$this->add_control(
			'heading_tag',
			array(
				'label'   => esc_html__( 'Heading Tag', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'  => esc_html__( 'h1', 'newsreader' ),
					'h2'  => esc_html__( 'h2', 'newsreader' ),
					'h3'  => esc_html__( 'h3', 'newsreader' ),
					'h4'  => esc_html__( 'h4', 'newsreader' ),
					'h5'  => esc_html__( 'h5', 'newsreader' ),
					'h6'  => esc_html__( 'h6', 'newsreader' ),
					'p'   => esc_html__( 'p', 'newsreader' ),
					'div' => esc_html__( 'div', 'newsreader' ),
				),
			)
		);

		$this->add_control(
			'heading_link_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'heading_link',
			array(
				'label'        => esc_html__( 'Enable link', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'heading_link_label',
			array(
				'label'      => esc_html__( 'Link Label', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'heading_link_url',
			array(
				'label'      => esc_html__( 'Link URL', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'heading_link_target',
			array(
				'label'      => esc_html__( 'Link Target', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '_self',
				'options'    => array(
					'_self'  => esc_html__( 'In the active tab', 'newsreader' ),
					'_blank' => esc_html__( 'In a new tab', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'typography_style',
			array(
				'label' => esc_html__( 'Typography', 'newsreader' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Heading', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-heading__content',
			)
		);

		$this->add_control(
			'typography_link_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'       => 'link_typography',
				'label'      => esc_html__( 'Link', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-heading__link',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color_style',
			array(
				'label' => esc_html__( 'Color', 'newsreader' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_color_accent',
			array(
				'label'        => esc_html__( 'Use Accent color', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Heading', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-heading-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'color_link_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'      => esc_html__( 'Link', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-heading-link-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'link_color_hover',
			array(
				'label'      => esc_html__( 'Link hover color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-heading-link-color-hover: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'heading_link',
							'operator' => '==',
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
					'{{WRAPPER}}' => '--cs-heading-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}' => '--cs-heading-background-color: {{VALUE}}',
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

		$section_class = 'cs-heading';

		if ( 'true' === $settings['section_background'] ) {
			$section_class .= ' cs-heading-background';
		}

		if ( 'true' === $settings['heading_color_accent'] ) {
			$section_class .= ' cs-heading-accent';
		}

		$container_class = '';

		if ( 'true' === $settings['section_container'] ) {
			$container_class = 'cs-container';
		}

		?>
		<?php if ( $settings['heading'] ) { ?>
			<section class="<?php echo esc_attr( $section_class ); ?>">
				<div class="cs-heading__container <?php echo esc_attr( $container_class ); ?>">
					<<?php echo esc_attr( $settings['heading_tag'] ); ?> class="cs-heading__content">
						<?php echo wp_kses( $settings['heading'], 'post' ); ?>
					</<?php echo esc_attr( $settings['heading_tag'] ); ?>>

					<?php if ( 'true' === $settings['heading_link'] && $settings['heading_link_label'] && $settings['heading_link_url'] ) { ?>
						<a class="cs-heading__link" href="<?php echo esc_url( $settings['heading_link_url'] ); ?>" target="<?php echo esc_attr( $settings['heading_link_target'] ); ?>">
							<span>	
								<?php echo wp_kses( $settings['heading_link_label'], 'post' ); ?>
							</span>
						</a>
					<?php } ?>
				</div>
			</section>
		<?php } ?>
		<?php
	}
}
