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
class CSCO_Tabs extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'cs-tabs';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Tabs', 'newsreader' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'cs-icon-el-tab';
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
			'type',
			array(
				'label'   => esc_html__( 'Type', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Numbered', 'newsreader' ),
					'style-2' => esc_html__( 'Tile & Horizontal', 'newsreader' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'grid',
			array(
				'label' => esc_html__( 'Grid Settings', 'newsreader' ),
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
					'relation' => 'and',
					'terms'    => array(
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
			'featured_post_attachment_settings',
			array(
				'label'      => esc_html__( 'Tile Post', 'newsreader' ),
				'type'       => \Elementor\Controls_Manager::HEADING,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'featured_attachment_orientation_type',
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
							'value'    => 'style-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'featured_attachment_orientation',
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
									'operator' => '==',
									'value'    => 'style-2',
								),
								array(
									'name'     => 'featured_attachment_orientation_type',
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
			'featured_attachment_orientation_custom',
			array(
				'label'           => esc_html__( 'Min Height', 'newsreader' ),
				'type'            => Controls_Manager::SLIDER,
				'size_units'      => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'           => array(
					'px' => array(
						'min'  => 100,
						'max'  => 720,
						'step' => 1,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 320,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 320,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 320,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 320,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 320,
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
							'value'    => 'style-2',
						),
						array(
							'name'     => 'featured_attachment_orientation_type',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
				),
			)
		);

		$this->add_control(
			'featured_attachment_size',
			array(
				'label'      => esc_html__( 'Size', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'csco-thumbnail',
				'options'    => csco_get_list_available_image_sizes(),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
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
					'top'      => 70,
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
							'value'    => 'style-2',
						),
					),
				),
			)
		);

		$this->add_control(
			'attachment_orientation_hr',
			array(
				'type'       => \Elementor\Controls_Manager::DIVIDER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
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
			'regular_posts_attachment_settings',
			array(
				'label'      => esc_html__( 'Horizontal Posts', 'newsreader' ),
				'type'       => \Elementor\Controls_Manager::HEADING,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
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
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
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
					'relation' => 'and',
					'terms'    => array(
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
			'attachment_size',
			array(
				'label'      => esc_html__( 'Size', 'newsreader' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'csco-thumbnail',
				'options'    => csco_get_list_available_image_sizes(),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'thumbnail',
							'operator' => '==',
							'value'    => 'true',
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
							'value'    => 'style-1',
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
							'value'    => 'style-1',
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
					'{{WRAPPER}}' => '--cs-post-numbered-gap: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-1',
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

		$this->add_control(
			'query_tab_1_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'query_tab_1_settings',
			array(
				'label' => esc_html__( 'Tab 1 Query', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'tab_heading',
			array(
				'label'   => esc_html__( 'Tab Heading', 'newsreader' ),
				'default' => esc_html__( 'Heading', 'newsreader' ),
				'type'    => Controls_Manager::TEXT,
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
			'query_tab_2_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'query_tab_2_settings',
			array(
				'label' => esc_html__( 'Tab 2 Query', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'tab_heading_2',
			array(
				'label'   => esc_html__( 'Tab Heading', 'newsreader' ),
				'default' => esc_html__( 'Heading', 'newsreader' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'filter_posts_2',
			array(
				'label'      => esc_html__( 'Filter by Posts', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
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
			'filter_categories_2',
			array(
				'label'      => esc_html__( 'Filter by Categories', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts_2',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_tags_2',
			array(
				'label'      => esc_html__( 'Filter by Tags', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts_2',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_offset_2',
			array(
				'label'      => esc_html__( 'Offset', 'newsreader' ),
				'type'       => Controls_Manager::NUMBER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts_2',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'orderby_2',
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
							'name'     => 'filter_posts_2',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'order_2',
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
							'name'     => 'filter_posts_2',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'query_tab_3_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'query_tab_3_settings',
			array(
				'label' => esc_html__( 'Tab 3 Query', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'tab_heading_3',
			array(
				'label'   => esc_html__( 'Tab Heading', 'newsreader' ),
				'default' => esc_html__( 'Heading', 'newsreader' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'filter_posts_3',
			array(
				'label'      => esc_html__( 'Filter by Posts', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
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
			'filter_categories_3',
			array(
				'label'      => esc_html__( 'Filter by Categories', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts_3',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_tags_3',
			array(
				'label'      => esc_html__( 'Filter by Tags', 'newsreader' ),
				'type'       => Controls_Manager::TEXT,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_post_type',
							'operator' => '==',
							'value'    => 'post',
						),
						array(
							'name'     => 'filter_posts_3',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'filter_offset_3',
			array(
				'label'      => esc_html__( 'Offset', 'newsreader' ),
				'type'       => Controls_Manager::NUMBER,
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'filter_posts_3',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'orderby_3',
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
							'name'     => 'filter_posts_3',
							'operator' => '==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'order_3',
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
							'name'     => 'filter_posts_3',
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
				'name'     => 'tab_heading_typography',
				'label'    => esc_html__( 'Tab Heading', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-tabs__tab',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'title_tile_typography',
				'label'      => esc_html__( 'Tile post Title', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-overlay-content .cs-entry__title',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'title_tile_typography_horizontal',
				'label'      => esc_html__( 'Horizontal posts Title', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-entry__content-horizontal .cs-entry__title',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-2',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'       => 'title_typography',
				'label'      => esc_html__( 'Title', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-entry__title',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-1',
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
				'name'       => 'post_number_typography',
				'label'      => esc_html__( 'Number', 'newsreader' ),
				'selector'   => '{{WRAPPER}} .cs-entry__content-wrapper:before',
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => 'type',
							'operator' => '==',
							'value'    => 'style-1',
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
			'tab_heading_color',
			array(
				'label'     => esc_html__( 'Tab Heading', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-tab-heading: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tab_heading_active_color',
			array(
				'label'     => esc_html__( 'Active Tab Heading', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-tab-heading-active: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'color_tab_heading_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title ', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-title: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title hover color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-title-hover: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'color_title_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => esc_html__( 'Category', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-category: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'category_hover_color',
			array(
				'label'     => esc_html__( 'Category hover color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-category-hover: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'color_category_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => esc_html__( 'Meta', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-meta: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_links_color',
			array(
				'label'     => esc_html__( 'Meta Links color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-meta-links: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'meta_links_hover_color',
			array(
				'label'     => esc_html__( 'Meta Links hover color', 'newsreader' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--cs-color-meta-links-hover: {{VALUE}}',
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
							'operator' => '==',
							'value'    => 'style-1',
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
							'value'    => 'style-1',
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

		// Section classes.
		$section_class = sprintf( 'cs-posts cs-tabs cs-tabs-%s', $settings['type'] );

		$grid_class = 'cs-posts-area__main';

		if ( 'true' === $settings['grid_divider'] ) {
			$grid_class .= ' cs-posts-area__main-divider';
		}

		$article_class = '';
		$entry_class   = 'cs-entry__outer';

		if ( 'true' === $settings['thumbnail'] ) {
			$entry_class .= sprintf( ' cs-entry__outer-small cs-entry__outer-thumbnail-%s', $settings['thumbnail_alignment'] );
		}

		// Section defaults.
		$settings['excerpt']              = false;
		$settings['image_width']          = 'small';
		$settings['image_width_numbered'] = 'small';
		$settings['thumbnail_position']   = 'right';

		// Section style.
		$post_template = '';

		if ( 'style-1' === $settings['type'] ) {
			$section_class .= sprintf( ' cs-posts__numbered' );

			if ( 'true' === $settings['post_number_color_accent'] ) {
				$entry_class .= ' cs-entry__outer-accent';
			}
		} elseif ( 'style-2' === $settings['type'] ) {
			$section_class .= sprintf( ' cs-posts__horizontal' );
		}

		// Add 'Avoid Duplicates'.
		global $featured_query_posts_ids;

		if ( ! $featured_query_posts_ids ) {
			$featured_query_posts_ids = array();
		}

		$options = $settings;

		$attributes = array();

		// Multitab Query arguments.
		$section_tabs = array(
			array(
				'heading'           => $settings['tab_heading'],
				'args'              => array(
					'post_type'      => $settings['filter_post_type'],
					'posts_per_page' => $settings['number_items'],
				),
				'filter_categories' => $settings['filter_categories'],
				'filter_tags'       => $settings['filter_tags'],
				'filter_posts'      => $settings['filter_posts'],
				'filter_offset'     => $settings['filter_offset'],
				'orderby'           => $settings['orderby'],
				'order'             => $settings['order'],
			),
			array(
				'heading'           => $settings['tab_heading_2'],
				'args'              => array(
					'post_type'      => $settings['filter_post_type'],
					'posts_per_page' => $settings['number_items'],
				),
				'filter_categories' => $settings['filter_categories_2'],
				'filter_tags'       => $settings['filter_tags_2'],
				'filter_posts'      => $settings['filter_posts_2'],
				'filter_offset'     => $settings['filter_offset_2'],
				'orderby'           => $settings['orderby_2'],
				'order'             => $settings['order_2'],
			),
			array(
				'heading'           => $settings['tab_heading_3'],
				'args'              => array(
					'post_type'      => $settings['filter_post_type'],
					'posts_per_page' => $settings['number_items'],
				),
				'filter_categories' => $settings['filter_categories_3'],
				'filter_tags'       => $settings['filter_tags_3'],
				'filter_posts'      => $settings['filter_posts_3'],
				'filter_offset'     => $settings['filter_offset_3'],
				'orderby'           => $settings['orderby_3'],
				'order'             => $settings['order_3'],
			),
		);

		// Multitab Query settings.
		foreach ( $section_tabs as &$section_tab ) {
			if ( 'post' === $settings['filter_post_type'] ) {

				// Filter by categories.
				if ( ! empty( $section_tab['filter_categories'] ) ) {
					$section_tab['filter_categories'] = array_map( 'trim', explode( ',', $section_tab['filter_categories'] ) );

					$section_tab['args']['tax_query'][] = array(
						'taxonomy'         => 'category',
						'field'            => 'id',
						'operator'         => 'IN',
						'terms'            => $section_tab['filter_categories'],
						'include_children' => true,
					);
				}

				// Filter by tags.
				if ( ! empty( $section_tab['filter_tags'] ) ) {
					$section_tab['args']['tax_query'][] = array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'operator' => 'IN',
						'terms'    => (array) $section_tab['filter_tags'],
					);
				}

				// Filter by posts.
				if ( ! empty( $section_tab['filter_posts'] ) ) {
					$section_tab['args']['post__in'] = explode( ',', str_replace( ' ', '', $section_tab['filter_posts'] ) );
				} elseif ( 'yes' === $settings['avoid_duplicate'] ) {
					$section_tab['args']['post__not_in'] = $featured_query_posts_ids;
				}

				// Offset.
				if ( ! empty( $section_tab['filter_offset'] ) ) {
					$section_tab['args']['offset'] = $section_tab['filter_offset'];
				}

				// Orderby.
				if ( ! empty( $section_tab['orderby'] ) ) {
					$section_tab['args']['orderby'] = $section_tab['orderby'];

					if ( 'views' === $section_tab['orderby'] && csco_post_views_enabled() ) {
						$section_tab['args']['orderby']                   = 'post_views';
						$section_tab['args']['views_query']['hide_empty'] = false;
					}
				}

				// Order.
				if ( ! empty( $section_tab['order'] ) ) {
					$section_tab['args']['order'] = $section_tab['order'];
				}
			}
		}

		unset( $section_tab );
		?>

		<section class="<?php echo esc_attr( $section_class ); ?>">
			<div class="cs-tabs__header">
				<?php
				$tab_counter = 1;
				$tab_class   = ' cs-tabs__tab-active';

				foreach ( $section_tabs as $section_tab ) {

					if ( 1 !== $tab_counter ) {
						$tab_class = '';
					}

					?>

					<div class="cs-tabs__tab <?php echo esc_attr( $tab_class ); ?>">
						<?php echo wp_kses( $section_tab['heading'], 'post' ); ?>
					</div>

					<?php
					++$tab_counter;
				}
				?>
			</div>

			<?php
			$section_counter = 1;
			$post_area_class = ' cs-posts-area-active';

			foreach ( $section_tabs as $section_tab ) {

				$query_args = $section_tab['args'];
				$query      = new \WP_Query( $query_args );

				if ( 1 !== $section_counter ) {
					$post_area_class = '';
				}

				if ( $query->have_posts() ) {

					if ( $section_tab['filter_posts'] ) {
						$post_ids = is_array( $section_tab['filter_posts'] ) ? $section_tab['filter_posts'] : array_map( 'trim', explode( ',', $section_tab['filter_posts'] ) );

						usort( $query->posts, function( $a, $b ) use ( $post_ids ) {
							$pos_a = array_search( $a->ID, $post_ids );
							$pos_b = array_search( $b->ID, $post_ids );
							return $pos_a - $pos_b;
						});
					}

					?>

					<div class="cs-posts-area cs-posts-area-elementor <?php echo esc_attr( $post_area_class ); ?>">
						<div class="cs-posts-area__outer">
							<div class="<?php echo esc_attr( $grid_class ); ?>" data-pc="1" data-lt="1" data-tb="1" data-mb="1">
								<?php
								$current = 1;

								while ( $query->have_posts() ) {
									$query->the_post();

									$featured_query_posts_ids[] = get_the_ID();

									$post_id = get_the_ID();

									// Section style.
									if ( 'style-1' === $settings['type'] ) {

										$post_template = 'elementor-numbered';

									}

									if ( 'style-2' === $settings['type'] && 1 === $current ) {

										$options['attachment_orientation_type'] = $settings['featured_attachment_orientation_type'];
										$options['attachment_orientation']      = $settings['featured_attachment_orientation'];
										$options['attachment_size']             = $settings['featured_attachment_size'];
										$post_template                          = 'elementor-tile';

									}

									if ( 'style-2' === $settings['type'] && 1 !== $current ) {

										$options['attachment_orientation'] = $settings['attachment_orientation'];
										$options['attachment_size']        = $settings['attachment_size'];
										$post_template                     = 'elementor-horizontal';

									}

									set_query_var( 'attributes', $attributes );
									set_query_var( 'options', $options );
									set_query_var( 'current', $current );
									set_query_var( 'article_class', $article_class );
									set_query_var( 'entry_class', $entry_class );

									get_template_part( 'template-parts/posts-area/' . $post_template );

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

				++$section_counter;
			}
			?>

		</section>

		<?php
	}
}
