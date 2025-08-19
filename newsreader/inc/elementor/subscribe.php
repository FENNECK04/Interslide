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
class CSCO_Subscribe extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cs-subscribe';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Subscribe', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cs-icon-el-input';
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
			'type',
			array(
				'label'   => esc_html__( 'Type', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'type-1',
				'options' => array(
					'type-1' => esc_html__( 'Type 1', 'newsreader' ),
					'type-2' => esc_html__( 'Type 2', 'newsreader' ),
				),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => esc_html__( 'Heading', 'newsreader' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Keep Up to Date with the Most Important News', 'newsreader' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form',
			array(
				'label' => esc_html__( 'Subscribe Form', 'newsreader' ),
			)
		);

		$this->add_control(
			'subscribe_mailchimp',
			array(
				'label' => esc_html__( 'Mailchimp Form Link', 'newsreader' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'button_label',
			array(
				'label'   => esc_html__( 'Button Label', 'newsreader' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Subscribe',
			)
		);

		$this->add_control(
			'description',
			array(
				'label' => esc_html__( 'Description', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::WYSIWYG,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image',
			array(
				'label'      => esc_html__( 'Image', 'newsreader' ),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_settings',
			array(
				'label'      => esc_html__( 'Lightmode', 'newsreader' ),
				'type'       => \Elementor\Controls_Manager::HEADING,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_settings_dark',
			array(
				'label'      => esc_html__( 'Darkmode', 'newsreader' ),
				'type'       => \Elementor\Controls_Manager::HEADING,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_dark',
			array(
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'           => esc_html__( 'Height', 'newsreader' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'           => array(
					'px' => array(
						'min'  => 100,
						'max'  => 500,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 220,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 220,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 220,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 200,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 200,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-subscribe-height: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'type-2',
						),
					),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'default'   => 'csco-extra-large-uncropped',
				'separator' => 'none',
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
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Heading', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-subscribe__heading',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Description', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-subscribe__description',
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
			'heading_color',
			array(
				'label'     => esc_html__( 'Heading color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-subscribe-heading: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'color_heading_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Description color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-subscribe-description: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description_link_color',
			array(
				'label'     => esc_html__( 'Description Link color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-subscribe-description-link: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description_link_hover_color',
			array(
				'label'     => esc_html__( 'Description Link hover color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-subscribe-description-link-hover: {{VALUE}}',
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

		$this->add_responsive_control(
			'content_padding',
			array(
				'type'            => \Elementor\Controls_Manager::DIMENSIONS,
				'label'           => esc_html__( 'Padding', 'newsreader' ),
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'top'      => 24,
					'right'    => 64,
					'bottom'   => 24,
					'left'     => 64,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'desktop_default' => array(
					'top'      => 24,
					'right'    => 64,
					'bottom'   => 24,
					'left'     => 64,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'laptop_default'  => array(
					'top'      => 24,
					'right'    => 40,
					'bottom'   => 24,
					'left'     => 40,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'tablet_default'  => array(
					'top'      => 24,
					'right'    => 24,
					'bottom'   => 24,
					'left'     => 24,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'mobile_default'  => array(
					'top'      => 24,
					'right'    => 24,
					'bottom'   => 24,
					'left'     => 24,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-subscribe-content-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'type'            => \Elementor\Controls_Manager::DIMENSIONS,
				'label'           => esc_html__( 'Border Radius', 'newsreader' ),
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'top'      => 2,
					'right'    => 2,
					'bottom'   => 2,
					'left'     => 2,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'desktop_default' => array(
					'top'      => 2,
					'right'    => 2,
					'bottom'   => 2,
					'left'     => 2,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'laptop_default'  => array(
					'top'      => 2,
					'right'    => 2,
					'bottom'   => 2,
					'left'     => 2,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'tablet_default'  => array(
					'top'      => 2,
					'right'    => 2,
					'bottom'   => 2,
					'left'     => 2,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'mobile_default'  => array(
					'top'      => 2,
					'right'    => 2,
					'bottom'   => 2,
					'left'     => 2,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-subscribe-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'section_background_color',
			array(
				'label'     => esc_html__( 'Background', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-subscribe-background-color: {{VALUE}}',
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

		$section_class = 'cs-subscribe-elementor cs-subscribe-elementor-' . $settings['type'];

		$alt_text = '';

		if ( isset( $settings['image']['alt'] ) && $settings['image']['alt'] ) {
			$alt_text = $settings['image']['alt'];
		}

		?>

		<section class="<?php echo esc_attr( $section_class ); ?>">

			<div class="cs-subscribe__content">
				<?php if ( $settings['heading'] ) { ?>
					<div class="cs-subscribe__header">
						<<?php echo esc_attr( $settings['heading_tag'] ); ?> class="cs-subscribe__heading">
							<?php echo wp_kses( $settings['heading'], 'post' ); ?>
						</<?php echo esc_attr( $settings['heading_tag'] ); ?>>
					</div>
				<?php } ?>

				<?php if ( $settings['subscribe_mailchimp'] ) { ?>
					<form class="cs-subscribe__form" action="<?php echo wp_kses( $settings['subscribe_mailchimp'], 'post' ); ?>" method="post" name="mc-embedded-subscribe-form-el" class="validate" target="_blank" novalidate="novalidate">
						<div class="cs-subscribe__form-group" data-scheme="light">
							<input type="email" placeholder="E-mail" name="EMAIL">
							<button type="submit" value="<?php echo esc_attr( $settings['button_label'] ); ?>" name="subscribe"><?php echo esc_attr( $settings['button_label'] ); ?></button>
						</div>

						<div class="cs-subscribe__form-response clear" id="mce-responses">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>

						<?php if ( $settings['description'] ) { ?>
							<div class="cs-subscribe__description">
								<?php echo wp_kses( $settings['description'], 'post' ); ?>
							</div>
						<?php } ?>
					</form>
				<?php } ?>
			</div>

			<?php if ( 'type-2' === $settings['type'] ) { ?>
				<div class="cs-subscribe__image cs-display-only-light">
					<?php if ( isset( $settings['image']['id'] ) && $settings['image']['id'] ) { ?>
						<?php echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size'], false, array( 'loading' => 'lazy', ) ); ?>
					<?php } elseif ( isset( $settings['image']['url'] ) && $settings['image']['url'] ) { ?>
						<img loading="lazy" src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
					<?php } ?>
				</div>

				<div class="cs-subscribe__image cs-display-only-dark">
					<?php if ( isset( $settings['image']['id'] ) && $settings['image']['id'] ) { ?>
						<?php echo wp_get_attachment_image( $settings['image_dark']['id'], $settings['image_size'], false, array( 'loading' => 'lazy', ) ); ?>
					<?php } elseif ( isset( $settings['image']['url'] ) && $settings['image']['url'] ) { ?>
						<img loading="lazy" src="<?php echo esc_url( $settings['image_dark']['url'] ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
					<?php } ?>
				</div>
			<?php } ?>

		</section>

		<?php
	}
}
