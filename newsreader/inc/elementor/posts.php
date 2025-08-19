<?php
namespace ThemeElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
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
class CSCO_Posts extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cs-posts';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Posts', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cs-icon-el-view_quilt';
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
	 * @access public
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
			'posts_content',
			array(
				'label' => esc_html__( 'Posts', 'newsreader' ),
			)
		);

		$this->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard'   => esc_html__( 'Standard', 'newsreader' ),
					'horizontal' => esc_html__( 'Horizontal', 'newsreader' ),
					'tile'       => esc_html__( 'Tile', 'newsreader' ),
					'numbered'   => esc_html__( 'Numbered', 'newsreader' ),
				),
			)
		);

		$this->add_control(
			'number_items',
			array(
				'label'   => esc_html__( 'Number of Items', 'newsreader' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 1,
			)
		);

		$this->add_control(
			'pagination',
			array(
				'label'        => esc_html__( 'Enable pagination', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'post_format',
			array(
				'label'        => esc_html__( 'Enable post format', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'thumbnail',
			array(
				'label'        => esc_html__( 'Enable thumbnail', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'video',
			array(
				'label'        => esc_html__( 'Enable video backgrounds', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'video_controls',
			array(
				'label'        => esc_html__( 'Enable video controls', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
				'conditions'   => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'video',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'excerpt',
			array(
				'label'        => esc_html__( 'Display item excerpt', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'excerpt_length',
			array(
				'label'      => esc_html__( 'Excerpt length', 'newsreader' ),
				'type'       => Controls_Manager::NUMBER,
				'min'        => 1,
				'max'        => 1000,
				'step'       => 1,
				'default'    => 200,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'excerpt',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'grid',
			array(
				'label' => esc_html__( 'Grid Settings', 'newsreader' ),
			)
		);

		$this->add_control(
			'regular_meta_settings',
			array(
				'label' => esc_html__( 'Number of Columns', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'columns_desktop',
			array(
				'label'     => esc_html__( 'Desktop', 'newsreader' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'#' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => '#',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-posts-columns-desktop: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'columns_laptop',
			array(
				'label'     => esc_html__( 'Laptop', 'newsreader' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'#' => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => '#',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-posts-columns-laptop: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'columns_tablet',
			array(
				'label'     => esc_html__( 'Tablet', 'newsreader' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'#' => array(
						'min'  => 1,
						'max'  => 3,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => '#',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-posts-columns-tablet: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'columns_mobile',
			array(
				'label'     => esc_html__( 'Mobile', 'newsreader' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'#' => array(
						'min'  => 1,
						'max'  => 2,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => '#',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-posts-columns-mobile: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'grid_hr_bottom',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'grid_column_gap',
			array(
				'label'           => esc_html__( 'Gap between Columns', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 250,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 24,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 24,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 24,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 20,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-posts-column-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'grid_row_gap',
			array(
				'label'           => esc_html__( 'Gap between Rows', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 250,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 16,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 16,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 24,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 16,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 16,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-posts-row-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'grid_divider',
			array(
				'label'        => esc_html__( 'Divider between rows', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'meta',
			array(
				'label' => esc_html__( 'Meta Settings', 'newsreader' ),
			)
		);

		$this->add_control(
			'meta_category',
			array(
				'label'        => esc_html__( 'Category', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'meta_author',
			array(
				'label'        => esc_html__( 'Author', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'meta_date',
			array(
				'label'        => esc_html__( 'Date', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'meta_views',
			array(
				'label'        => esc_html__( 'Views', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'meta_comments',
			array(
				'label'        => esc_html__( 'Comments', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'thumbnail_settings',
			array(
				'label'      => esc_html__( 'Thumbnail Settings', 'newsreader' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'thumbnail_alignment',
			array(
				'label'      => esc_html__( 'Alignment', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => array(
					'left'  => esc_html__( 'Left', 'newsreader' ),
					'right' => esc_html__( 'Right', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'horizontal',
						),
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'thumbnail_position',
			array(
				'label'      => esc_html__( 'Position', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'top',
				'options'    => array(
					'top'   => esc_html__( 'Top', 'newsreader' ),
					'left'  => esc_html__( 'Left', 'newsreader' ),
					'right' => esc_html__( 'Right', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_width',
			array(
				'label'      => esc_html__( 'Image Width', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'small',
				'options'    => array(
					'small'  => esc_html__( 'Small', 'newsreader' ),
					'medium' => esc_html__( 'Medium', 'newsreader' ),
					'large'  => esc_html__( 'Large', 'newsreader' ),
					'xlarge' => esc_html__( 'Extra Large', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'horizontal',
						),
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'image_width_numbered',
			array(
				'label'      => esc_html__( 'Image Width', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'small',
				'options'    => array(
					'small'  => esc_html__( 'Small', 'newsreader' ),
					'medium' => esc_html__( 'Medium', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
						array(
							'name'     => 'thumbnail_position',
							'operator' => '!=',
							'value'    => 'top',
						),
					),
				),
			)
		);

		$this->add_control(
			'attachment_orientation_type',
			array(
				'label'      => esc_html__( 'Orientation type', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'preset',
				'options'    => array(
					'preset' => esc_html__( 'Preset', 'newsreader' ),
					'custom' => esc_html__( 'Custom', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'attachment_orientation',
			array(
				'label'      => esc_html__( 'Orientation', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'landscape-16-9',
				'options'    => array(
					'original'       => esc_html__( 'Original', 'newsreader' ),
					'landscape'      => esc_html__( 'Landscape 4:3', 'newsreader' ),
					'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'newsreader' ),
					'landscape-16-9' => esc_html__( 'Landscape 16:9', 'newsreader' ),
					'landscape-21-9' => esc_html__( 'Landscape 21:9', 'newsreader' ),
					'portrait'       => esc_html__( 'Portrait 3:4', 'newsreader' ),
					'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'newsreader' ),
					'square'         => esc_html__( 'Square', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'relation' => 'and',
							'terms'    => array(
								array(
									'name'     => 'type',
									'operator' => '!=',
									'value'    => 'tile',
								),
								array(
									'name'     => 'thumbnail',
									'operator' => '==',
									'value'    => 'true',
								),
							),
						),
						array(
							'relation' => 'and',
							'terms'    => array(
								array(
									'name'     => 'type',
									'operator' => '==',
									'value'    => 'tile',
								),
								array(
									'name'     => 'attachment_orientation_type',
									'operator' => '==',
									'value'    => 'preset',
								),
							),
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'attachment_orientation_custom',
			array(
				'label'           => esc_html__( 'Height', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 200,
						'max' => 750,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 520,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 520,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 520,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 520,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 520,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-post-image-height: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
						),
						array(
							'name'     => 'attachment_orientation_type',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
				),
			)
		);

		$this->add_control(
			'attachment_size',
			array(
				'label'      => esc_html__( 'Size', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'csco-thumbnail',
				'options'    => csco_get_list_available_image_sizes(),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'attachment_margin',
			array(
				'label'           => esc_html__( 'Margin bottom', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 32,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 12,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 12,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 12,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 12,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 12,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-post-image-margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'standard',
						),
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'           => esc_html__( 'Padding', 'newsreader' ),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'top'      => 70,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'desktop_default' => array(
					'top'      => 70,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'laptop_default'  => array(
					'top'      => 70,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'tablet_default'  => array(
					'top'      => 60,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'mobile_default'  => array(
					'top'      => 60,
					'right'    => 20,
					'bottom'   => 20,
					'left'     => 20,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-posts-tile-padding-top: {{TOP}}{{UNIT}}; --cs-posts-tile-padding-right: {{RIGHT}}{{UNIT}}; --cs-posts-tile-padding-bottom: {{BOTTOM}}{{UNIT}}; --cs-posts-tile-padding-left: {{LEFT}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'numbered_seetings',
			array(
				'label'      => esc_html__( 'Numbered Settings', 'newsreader' ),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'number_width',
			array(
				'label'           => esc_html__( 'Number max-width', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 12,
						'max' => 64,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 14,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 14,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 14,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 14,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 14,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-post-number-width: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
					),
				),
			)
		);

		$this->add_responsive_control(
			'numbered_gap',
			array(
				'label'           => esc_html__( 'Gap', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 32,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 6,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 6,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 6,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 6,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 6,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}}' => '--cs-post-numbered-gap: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'query',
			array(
				'label' => esc_html__( 'Query Settings', 'newsreader' ),
			)
		);

		$this->add_control(
			'filter_post_type',
			array(
				'label'   => esc_html__( 'Filter by Post Type', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => csco_get_post_types_stack(),
			)
		);

		$this->add_control(
			'filter_posts',
			array(
				'label'       => esc_html__( 'Filter by Posts', 'newsreader' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Add comma-separated list of post IDs. For example: 12, 34, 145. Leave empty for all posts.', 'newsreader' ),
				'conditions'  => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_categories',
			array(
				'label'       => esc_html__( 'Filter by Categories', 'newsreader' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Add comma-separated list of category IDs. For example: 12, 34, 145. Leave empty for all categories.', 'newsreader' ),
				'conditions'  => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_tags',
			array(
				'label'       => esc_html__( 'Filter by Tags', 'newsreader' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Add comma-separated list of tag IDs. For example: 12, 34, 145. Leave empty for all tags.', 'newsreader' ),
				'conditions'  => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_offset',
			array(
				'label'      => esc_html__( 'Offset', 'newsreader' ),
				'type'       => Controls_Manager::NUMBER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'      => esc_html__( 'Order By', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'date',
				'options'    => array(
					'date'          => esc_html__( 'Published Date', 'newsreader' ),
					'modified'      => esc_html__( 'Modified Date', 'newsreader' ),
					'title'         => esc_html__( 'Title', 'newsreader' ),
					'rand'          => esc_html__( 'Random', 'newsreader' ),
					'views'         => esc_html__( 'Views', 'newsreader' ),
					'comment_count' => esc_html__( 'Comment Count', 'newsreader' ),
					'ID'            => esc_html__( 'ID', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'      => esc_html__( 'Order', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'DESC',
				'options'    => array(
					'DESC' => esc_html__( 'Descending', 'newsreader' ),
					'ASC'  => esc_html__( 'Ascending', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'avoid_duplicate',
			array(
				'label'        => esc_html__( 'Avoid Duplicate Posts', 'newsreader' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'newsreader' ),
				'label_off'    => esc_html__( 'no', 'newsreader' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'conditions'   => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts',
							'operator' => '==',
							'value'    => '',
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
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Category', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__post-meta .cs-meta-category a',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Meta', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__post-meta',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'excerpt_typography',
				'label'      => esc_html__( 'Excerpt', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-entry__excerpt',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'excerpt',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'post_number_typography',
				'label'      => esc_html__( 'Number', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-entry__outer:before',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
					),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color_style',
			array(
				'label'      => esc_html__( 'Color', 'newsreader' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'      => esc_html__( 'Title ', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-title: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'      => esc_html__( 'Title hover color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-title-hover: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'color_title_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'      => esc_html__( 'Category', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-category: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'category_hover_color',
			array(
				'label'      => esc_html__( 'Category hover color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-category-hover: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'color_category_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'      => esc_html__( 'Meta', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-meta: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'meta_links_color',
			array(
				'label'      => esc_html__( 'Meta Links color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-meta-links: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'meta_links_hover_color',
			array(
				'label'      => esc_html__( 'Meta Links hover color', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-meta-links-hover: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'color_meta_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'      => esc_html__( 'Excerpt', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-excerpt: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'excerpt',
							'operator' => '==',
							'value'    => 'true',
						),
						array(
							'name'     => 'type',
							'operator' => '!=',
							'value'    => 'tile',
						),
					),
				),
			)
		);

		$this->add_control(
			'color_excerpt_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
						),
						array(
							'name'     => 'excerpt',
							'operator' => '==',
							'value'    => 'true',
						),
					),
				),
			)
		);

		$this->add_control(
			'post_number_color_accent',
			array(
				'label'        => esc_html__( 'Enable accent color', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'post_number_color',
			array(
				'label'      => esc_html__( 'Number', 'newsreader' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}}' => '--cs-color-post-number: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'numbered',
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
					'{{WRAPPER}}' => '--cs-posts-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}}' => '--cs-posts-background-color: {{VALUE}}',
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

		$this->add_control(
			'content_alignment',
			array(
				'label'      => esc_html__( 'Content alignment', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => array(
					'left'   => esc_html__( 'Left', 'newsreader' ),
					'center' => esc_html__( 'Center', 'newsreader' ),
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'tile',
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
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Section classes.
		$section_class = sprintf( 'cs-posts cs-posts__%s', $settings['type'] );

		if ( 'true' === $settings['section_background'] ) {
			$section_class .= ' cs-posts-background';
		}

		$container_class = '';

		if ( 'true' === $settings['section_container'] ) {
			$container_class = 'cs-container';
		}

		$grid_class = 'cs-posts-area__main';

		if ( 'true' === $settings['grid_divider'] ) {
			$grid_class .= ' cs-posts-area__main-divider';
		}

		$article_class = '';
		$entry_class   = 'cs-entry__outer';

		// Add horizontal type image size.
		if ( 'horizontal' === $settings['type'] ) {

			$entry_class .= sprintf( ' cs-entry__outer-%s', $settings['image_width'] );

			// Add horizontal type image alignment.
			if ( 'left' === $settings['thumbnail_alignment'] ) {

				$entry_class .= ' cs-entry__outer-thumbnail-left';

			} elseif ( 'right' === $settings['thumbnail_alignment'] ) {

				$entry_class .= ' cs-entry__outer-thumbnail-right';

			}
		}

		// Add numbered type image position.
		if ( 'numbered' === $settings['type'] ) {

			if ( $settings['thumbnail'] ) {

				$entry_class .= sprintf( ' cs-entry__outer-thumbnail-%s', $settings['thumbnail_position'] );
				$entry_class .= sprintf( ' cs-entry__outer-%s', $settings['image_width_numbered'] );

			}

			if ( 'true' === $settings['post_number_color_accent'] ) {

				$entry_class .= ' cs-entry__outer-accent';

			}
		}

		// Add tile type content alignment.
		if ( 'tile' === $settings['type'] ) {

			if ( 'center' === $settings['content_alignment'] ) {

				$entry_class .= sprintf( ' cs-entry__outer-content-%s', $settings['content_alignment'] );

			}
		}

		// Grid columns.
		$columns_desktop = 1;
		$columns_laptop  = 1;
		$columns_tablet  = 1;
		$columns_mobile  = 1;

		if ( isset( $settings['columns_desktop']['size'] ) && $settings['columns_desktop']['size'] ) {
			$columns_desktop = $settings['columns_desktop']['size'];
		}

		if ( isset( $settings['columns_laptop']['size'] ) && $settings['columns_laptop']['size'] ) {
			$columns_laptop = $settings['columns_laptop']['size'];
		}

		if ( isset( $settings['columns_tablet']['size'] ) && $settings['columns_tablet']['size'] ) {
			$columns_tablet = $settings['columns_tablet']['size'];
		}

		if ( isset( $settings['columns_mobile']['size'] ) && $settings['columns_mobile']['size'] ) {
			$columns_mobile = $settings['columns_mobile']['size'];
		}

		// Add 'Avoid Duplicates'.
		global $featured_query_posts_ids;

		if ( ! $featured_query_posts_ids ) {
			$featured_query_posts_ids = array();
		}

		// Meta.
		$meta = array();
		if ( isset( $settings['meta_author'] ) && 'true' === $settings['meta_author'] ) {
			$meta[] = 'author';
		}
		if ( isset( $settings['meta_date'] ) && 'true' === $settings['meta_date'] ) {
			$meta[] = 'date';
		}
		if ( isset( $settings['meta_category'] ) && 'true' === $settings['meta_category'] ) {
			$meta[] = 'category';
		}
		if ( isset( $settings['meta_comments'] ) && 'true' === $settings['meta_comments'] ) {
			$meta[] = 'comments';
		}
		if ( isset( $settings['meta_views'] ) && 'true' === $settings['meta_views'] ) {
			$meta[] = 'views';
		}

		// Options.
		$options = $settings;

		$options['location']          = 'elementor';
		$options['layout']            = "elementor-{$settings['type']}";
		$options['image_size']        = $settings['attachment_size'];
		$options['image_orientation'] = $settings['attachment_orientation'];
		$options['meta']              = $meta;
		$options['entry_class']       = $entry_class;

		$attributes = array();

		// Set layout.
		$attributes['layout'] = "elementor-{$settings['type']}";

		// Default args.
		$args = array(
			'post_type'      => $settings['filter_post_type'],
			'posts_per_page' => $settings['number_items'],
		);

		// Filter by posts.
		if ( $settings['filter_posts'] ) {
			$args['post__in'] = explode( ',', str_replace( ' ', '', $settings['filter_posts'] ) );
		} elseif ( 'yes' === $settings['avoid_duplicate'] ) {
			$args['post__not_in'] = $featured_query_posts_ids;
		}

		// Categories.
		if ( 'post' === $settings['filter_post_type'] && $settings['filter_categories'] ) {
			$settings['filter_categories'] = array_map( 'trim', explode( ',', $settings['filter_categories'] ) );

			$args['tax_query'] = array(
				array(
					'taxonomy'         => 'category',
					'field'            => 'id',
					'operator'         => 'IN',
					'terms'            => $settings['filter_categories'],
					'include_children' => true,
				),
			);
		}

		// Filter by tags.
		if ( $settings['filter_tags'] ) {
			$args['tax_query'] = isset( $args['tax_query'] ) && is_array( $args['tax_query'] ) ? $args['tax_query'] : array();

			$args['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'id',
				'operator' => 'IN',
				'terms'    => (array) $settings['filter_tags'],
			);
		}

		// Offset.
		if ( $settings['filter_offset'] ) {
			$args['offset'] = $settings['filter_offset'];
		}

		// Orderby.
		if ( $settings['orderby'] ) {
			$args['orderby'] = $settings['orderby'];

			if ( 'views' === $settings['orderby'] && csco_post_views_enabled() ) {
				$args['orderby'] = 'post_views';

				$args['views_query']['hide_empty'] = false;
			}
		}

		// Order.
		if ( $settings['order'] ) {
			$args['order'] = $settings['order'];
		}

		$query = new \WP_Query( $args );

		?>
			<section class="<?php echo esc_attr( $section_class ); ?>">
				<?php

				if ( $query->have_posts() ) {

					if ( $settings['filter_posts'] ) {
						$post_ids = is_array( $args['post__in'] ) ? $args['post__in'] : array_map( 'trim', explode( ',', $args['post__in'] ) );

						usort( $query->posts, function( $a, $b ) use ( $post_ids ) {
							$pos_a = array_search( $a->ID, $post_ids );
							$pos_b = array_search( $b->ID, $post_ids );
							return $pos_a - $pos_b;
						});
					}

					// Load more data.
					$load_more_data = __return_null();

					if ( 'true' === $settings['pagination'] && $query->max_num_pages > 1 ) {

						// Theme data.
						$data = array(
							'infinite_load' => false,
							'query_vars'    => $query->query,
						);

						$query_args = csco_get_load_more_args( $data, $options );

						// Set area count.
						$query_args['posts_per_page'] = $args['posts_per_page'];

						$load_more_data = csco_encode_data( $query_args );
					}
					?>
						<div class="cs-posts-area cs-posts-area-elementor <?php echo esc_attr( $container_class ); ?>" data-posts-area="<?php echo esc_attr( $load_more_data ); ?>">
							<div class="cs-posts-area__outer">
								<div
								class="<?php echo esc_attr( $grid_class ); ?>"
								data-pc="<?php echo esc_attr( $columns_desktop ); ?>"
								data-lt="<?php echo esc_attr( $columns_laptop ); ?>"
								data-tb="<?php echo esc_attr( $columns_tablet ); ?>"
								data-mb="<?php echo esc_attr( $columns_mobile ); ?>"
								>
									<?php
									$current = 1;
									while ( $query->have_posts() ) {
										$query->the_post();

										$featured_query_posts_ids[] = get_the_ID();

										$options['current_post'] = $current;

										set_query_var( 'attributes', $attributes );
										set_query_var( 'options', $options );
										set_query_var( 'current', $current );
										set_query_var( 'article_class', $article_class );
										set_query_var( 'entry_class', $entry_class );

										get_template_part( 'template-parts/posts-area/' . $attributes['layout'] );

										++$current;
									}

									wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					<?php
				} else {
					?>
					<div class="cs-items-not-found">
						<p><?php esc_html_e( 'Nothing found!', 'newsreader' ); ?></p>
					</div>
					<?php
				}
				?>
			</section>
		<?php
	}
}
