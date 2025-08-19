<?php
/**
 * Elementor Block
 *
 * @package Newsreader
 */

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
class CSCO_Featured_Posts extends Widget_Base {

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
		return 'cs-featured-posts';
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
		return esc_html__( 'Featured Posts', 'newsreader' );
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
		return 'cs-icon-el-local_attraction';
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
			'post_format',
			array(
				'label'        => esc_html__( 'Enable post format', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
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
				'default'      => 'true',
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
			'meta',
			array(
				'label' => esc_html__( 'Meta Settings', 'newsreader' ),
			)
		);

		$this->add_control(
			'featured_meta_settings',
			array(
				'label' => esc_html__( 'Featured Post', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'featured_meta_category',
			array(
				'label'        => esc_html__( 'Category', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'featured_meta_author',
			array(
				'label'        => esc_html__( 'Author', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'featured_meta_date',
			array(
				'label'        => esc_html__( 'Date', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'featured_meta_views',
			array(
				'label'        => esc_html__( 'Views', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'featured_meta_comments',
			array(
				'label'        => esc_html__( 'Comments', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
			)
		);

		$this->add_control(
			'meta_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'regular_meta_settings',
			array(
				'label' => esc_html__( 'Inline Posts', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
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
				'default'      => 'false',
			)
		);

		$this->add_control(
			'meta_date',
			array(
				'label'        => esc_html__( 'Date', 'newsreader' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'false',
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
				'label' => esc_html__( 'Thumbnail Settings', 'newsreader' ),
			)
		);

		$this->add_control(
			'featured_post_attachment_settings',
			array(
				'label' => esc_html__( 'Featured Post', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'featured_attachment_orientation_type',
			array(
				'label'   => esc_html__( 'Orientation type', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'preset',
				'options' => array(
					'preset' => esc_html__( 'Preset', 'newsreader' ),
					'custom' => esc_html__( 'Custom', 'newsreader' ),
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
							'name'     => 'featured_attachment_orientation_type',
							'operator' => '==',
							'value'    => 'preset',
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
						'min' => 360,
						'max' => 750,
					),
				),
				'devices'         => array( 'desktop', 'laptop', 'tablet', 'mobile' ),
				'default'         => array(
					'size' => 650,
					'unit' => 'px',
				),
				'desktop_default' => array(
					'size' => 650,
					'unit' => 'px',
				),
				'laptop_default'  => array(
					'size' => 480,
					'unit' => 'px',
				),
				'tablet_default'  => array(
					'size' => 360,
					'unit' => 'px',
				),
				'mobile_default'  => array(
					'size' => 360,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .cs-featured-posts' => '--cs-featured-post-image-height: {{SIZE}}{{UNIT}};',
				),
				'conditions'      => array(
					'relation' => 'and',
					'terms'    => array(
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
				'label'   => esc_html__( 'Size', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'csco-extra-large',
				'options' => csco_get_list_available_image_sizes(),
			)
		);

		$this->add_control(
			'attachment_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'regular_posts_attachment_settings',
			array(
				'label' => esc_html__( 'Inline Posts', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'attachment_orientation',
			array(
				'label'   => esc_html__( 'Orientation', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'landscape-16-9',
				'options' => array(
					'original'       => esc_html__( 'Original', 'newsreader' ),
					'landscape'      => esc_html__( 'Landscape 4:3', 'newsreader' ),
					'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'newsreader' ),
					'landscape-16-9' => esc_html__( 'Landscape 16:9', 'newsreader' ),
					'landscape-21-9' => esc_html__( 'Landscape 21:9', 'newsreader' ),
					'portrait'       => esc_html__( 'Portrait 3:4', 'newsreader' ),
					'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'newsreader' ),
					'square'         => esc_html__( 'Square', 'newsreader' ),
				),
			)
		);

		$this->add_control(
			'attachment_size',
			array(
				'label'   => esc_html__( 'Size', 'newsreader' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'csco-thumbnail',
				'options' => csco_get_list_available_image_sizes(),
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
			'featured_style',
			array(
				'label' => esc_html__( 'Featured Post', 'newsreader' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'featured_post_typography_settings',
			array(
				'label' => esc_html__( 'Typography', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'featured_title_typography',
				'label'    => esc_html__( 'Title', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__content-featured > .cs-entry__title',
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
				'name'     => 'featured_meta_typography',
				'label'    => esc_html__( 'Meta', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__content-featured > .cs-entry__post-meta',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'featured_category_typography',
				'label'    => esc_html__( 'Category', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-entry__content-featured > .cs-entry__post-meta .cs-meta-category a',
			)
		);

		$this->add_control(
			'featured_padding_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'featured_post_content_settings',
			array(
				'label' => esc_html__( 'Content', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_responsive_control(
			'featured_content_padding',
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
					'right'    => 40,
					'bottom'   => 40,
					'left'     => 40,
					'unit'     => 'px',
					'isLinked' => true,
				),
				'desktop_default' => array(
					'top'      => 70,
					'right'    => 40,
					'bottom'   => 40,
					'left'     => 40,
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
					'{{WRAPPER}}' => '--cs-featured-post-content-padding-top: {{TOP}}{{UNIT}}; --cs-featured-post-content-padding-right: {{RIGHT}}{{UNIT}}; --cs-featured-post-content-padding-bottom: {{BOTTOM}}{{UNIT}}; --cs-featured-post-content-padding-left: {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'regular_style',
			array(
				'label' => esc_html__( 'Inline Posts', 'newsreader' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'regular_posts_typography_settings',
			array(
				'label' => esc_html__( 'Typography', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-posts-area__main .cs-entry__title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Meta', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-posts-area__main .cs-entry__post-meta',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Category', 'newsreader' ),
				'selector' => '{{WRAPPER}} .cs-posts-area__main .cs-entry__post-meta .cs-meta-category a',
			)
		);

		$this->add_control(
			'regular_padding_hr',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'regular_posts_content_settings',
			array(
				'label' => esc_html__( 'Content', 'newsreader' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
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
		$grid_class    = 'cs-posts-area__main';
		$article_class = '';
		$entry_class   = 'cs-entry__outer';

		// Add 'Avoid Duplicates'.
		global $featured_query_posts_ids;

		if ( ! $featured_query_posts_ids ) {
			$featured_query_posts_ids = array();
		}

		$options = $settings;

		$attributes = array();

		// Default args.
		$args = array(
			'post_type'      => $settings['filter_post_type'],
			'posts_per_page' => 5,
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

		// Featured Meta.
		$featured_meta = array();

		if ( 'true' === $options['featured_meta_author'] ) {
			$featured_meta[] = 'author';
		}

		if ( 'true' === $options['featured_meta_date'] ) {
			$featured_meta[] = 'date';
		}

		if ( 'true' === $options['featured_meta_category'] ) {
			$featured_meta[] = 'category';
		}

		if ( 'true' === $options['featured_meta_comments'] ) {
			$featured_meta[] = 'comments';
		}

		if ( 'true' === $options['featured_meta_views'] ) {
			$featured_meta[] = 'views';
		}

		// Thumbnail size.
		$thumbnail_size_mobile = 'csco-thumbnail-uncropped';
		$thumbnail_size        = $options['featured_attachment_size'];

		$featured_thumbnail_orientation = $options['featured_attachment_orientation'];

		if ( 'custom' === $options['featured_attachment_orientation_type'] ) {
			$featured_thumbnail_orientation = 'custom';
		}

		$query = new \WP_Query( $args );

		?>

			<section class="cs-featured-posts">
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

					$current = 1;

					?>
						<div class="cs-posts-area cs-posts-area-elementor">
							<div class="cs-posts-area__outer">
								<?php
								$query->the_post();
								?>

								<div class="cs-posts-area__featured">
									<div <?php post_class(); ?>>
										<div class="<?php echo esc_attr( $entry_class ); ?> cs-entry__overlay cs-overlay-ratio cs-ratio-<?php echo esc_attr( $featured_thumbnail_orientation ); ?>" data-scheme="inverse">

											<div class="cs-entry__inner cs-entry__thumbnail">
												<div class="cs-overlay-background">
													<?php
													if ( has_post_thumbnail() ) {
														the_post_thumbnail( $thumbnail_size_mobile );
														the_post_thumbnail( $thumbnail_size );
													}

													if ( 'true' === $options['video'] ) {
														csco_get_video_background( 'elementor', null, 'default', 'true' === $options['video_controls'] ? true : false );
													}

													if ( 'true' === $options['post_format'] ) {
														csco_the_post_format_icon();
													}
													?>
												</div>
											</div>

											<a class="cs-overlay-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>

											<div class="cs-entry__inner cs-entry__content cs-overlay-content cs-entry__content-featured">

												<?php csco_get_post_meta( array( 'category' ), true, $featured_meta ); ?>

												<?php the_title( '<h2 class="cs-entry__title">', '</h2>' ); ?>

												<?php
												if ( 'true' === $options['excerpt'] ) {
													$content = csco_get_the_excerpt( $options['excerpt_length'] );

													if ( $content ) {
														?>
														<div class="cs-entry__excerpt">
															<?php echo esc_html( $content ); ?>
														</div>
														<?php
													}
												}
												?>

												<?php csco_get_post_meta( array( 'author', 'date', 'views', 'comments' ), true, $featured_meta ); ?>

												<div class="cs-posts-area__main">
													<?php
													wp_reset_postdata();

													$options['excerpt']                     = 'false';
													$options['attachment_orientation_type'] = 'preset';

													while ( $query->have_posts() ) {
														$query->the_post();

														$featured_query_posts_ids[] = get_the_ID();

														set_query_var( 'attributes', $attributes );
														set_query_var( 'options', $options );
														set_query_var( 'article_class', $article_class );
														set_query_var( 'entry_class', $entry_class );

														get_template_part( 'template-parts/posts-area/elementor-tile' );

														++$current;
													}

													wp_reset_postdata();

													?>
												</div>

											</div>

										</div>
									</div>
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
