<?php
/**
 * Filters
 *
 * Filtering native WordPress and third-party plugins' functions.
 *
 * @package Newsreader
 */

if ( ! function_exists( 'csco_body_class' ) ) {
	/**
	 * Adds classes to <body> tag
	 *
	 * @param array $classes is an array of all body classes.
	 */
	function csco_body_class( $classes ) {

		// Page Layout.
		$classes[] = 'cs-page-layout-' . csco_get_page_sidebar();

		// Sticky Navbar.
		if ( get_theme_mod( 'navbar_sticky', true ) ) {
			$classes['navbar_sticky'] = 'cs-navbar-sticky-enabled';

			// Smart Navbar.
			if ( get_theme_mod( 'navbar_smart_sticky', true ) ) {
				$classes['navbar_sticky'] = 'cs-navbar-smart-enabled';
			}
		}

		// Sticky Sidebar.
		if ( get_theme_mod( 'misc_sticky_sidebar', true ) ) {
			$classes[] = 'cs-sticky-sidebar-enabled';

			$classes[] = get_theme_mod( 'misc_sticky_sidebar_method', 'cs-stick-to-top' );
		} else {
			$classes[] = 'cs-sticky-sidebar-disabled';
		}

		// Display Header Overlay.
		if ( csco_is_display_header_overlay() ) {
			$classes[] = 'cs-display-header-overlay';
		}

		// Site Branding.
		if ( 'top' === get_theme_mod( 'branding_enable', 'disabled' ) ) {
			$classes[] = 'cs-branding-top';
		} elseif ( 'wallpaper' === get_theme_mod( 'branding_enable', 'disabled' ) ) {
			$classes[] = 'cs-branding-wallpaper';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'csco_body_class' );

if ( ! function_exists( 'csco_kses_allowed_html' ) ) {
	/**
	 * Filters the HTML that is allowed for a given context.
	 *
	 * @param array  $tags    Tags by.
	 * @param string $context Context name.
	 */
	function csco_kses_allowed_html( $tags, $context ) {

		if ( 'content' === $context ) {
			$tags = array(
				'a'      => array(
					'class'  => true,
					'href'   => true,
					'title'  => true,
					'target' => true,
					'rel'    => true,
				),
				'div'    => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'span'   => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'img'    => array(
					'class'  => true,
					'id'     => true,
					'src'    => true,
					'rel'    => true,
					'srcset' => true,
					'size'   => true,
					'alt'    => true,
				),
				'br'     => array(),
				'b'      => array(),
				'strong' => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'i'      => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'p'      => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h1'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h2'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h3'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h4'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h5'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'h6'     => array(
					'class' => true,
					'id'    => true,
					'style' => true,
				),
				'script' => array(
					'src'         => true,
					'type'        => true,
					'async'       => true,
					'crossorigin' => true,
				),
				'ins' => array(
					'class'          => true,
					'style'          => true,
					'data-ad-layout' => true,
					'data-ad-format' => true,
					'data-ad-client' => true,
					'data-ad-slot'   => true,
				),
			);
		}

		if ( 'common' === $context ) {
			$tags = wp_kses_allowed_html( 'post' );
		}

		return $tags;
	}
	add_filter( 'wp_kses_allowed_html', 'csco_kses_allowed_html', 10, 2 );
}

if ( ! function_exists( 'csco_sitecontent_class' ) ) {
	/**
	 * Adds the classes for the site-content element.
	 *
	 * @param array $classes Classes to add to the class list.
	 */
	function csco_sitecontent_class( $classes ) {

		// Page Sidebar.
		if ( 'disabled' !== csco_get_page_sidebar() ) {
			$classes[] = 'cs-sidebar-enabled cs-sidebar-' . csco_get_page_sidebar();
		} else {
			$classes[] = 'cs-sidebar-disabled';
		}

		return $classes;
	}
}
add_filter( 'csco_site_content_class', 'csco_sitecontent_class' );

if ( ! function_exists( 'csco_add_entry_class' ) ) {
	/**
	 * Add entry class to post_class
	 *
	 * @param array $classes One or more classes to add to the class list.
	 */
	function csco_add_entry_class( $classes ) {
		array_push( $classes, 'cs-entry', 'cs-video-wrap' );

		return $classes;
	}
}
add_filter( 'post_class', 'csco_add_entry_class' );

if ( ! function_exists( 'csco_remove_hentry_class' ) ) {
	/**
	 * Remove hentry from post_class
	 *
	 * @param array $classes One or more classes to add to the class list.
	 */
	function csco_remove_hentry_class( $classes ) {
		return array_diff( $classes, array( 'hentry' ) );
	}
}
add_filter( 'post_class', 'csco_remove_hentry_class' );

if ( ! function_exists( 'csco_max_srcset_image_width' ) ) {
	/**
	 * Changes max image width in srcset attribute
	 *
	 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '1600'.
	 * @param array $size_array Array of width and height values in pixels (in that order).
	 */
	function csco_max_srcset_image_width( $max_width, $size_array ) {
		return 3840;
	}
}
add_filter( 'max_srcset_image_width', 'csco_max_srcset_image_width', 10, 2 );

if ( ! function_exists( 'csco_get_the_archive_title' ) ) {
	/**
	 * Archive Title
	 *
	 * Removes default prefixes, like "Category:" from archive titles.
	 *
	 * @param string $title Archive title.
	 */
	function csco_get_the_archive_title( $title ) {
		if ( is_category() ) {

			$title = single_cat_title( '', false );

		} elseif ( is_tag() ) {

			$title = single_tag_title( '', false );

		} elseif ( is_author() ) {

			$title = get_the_author( '', false );

		}

		return $title;
	}
}
add_filter( 'get_the_archive_title', 'csco_get_the_archive_title' );

if ( ! function_exists( 'csco_excerpt_length' ) ) {
	/**
	 * Excerpt Length
	 *
	 * @param string $length of the excerpt.
	 */
	function csco_excerpt_length( $length ) {
		return 18;
	}
}
add_filter( 'excerpt_length', 'csco_excerpt_length' );

if ( ! function_exists( 'csco_strip_shortcode_from_excerpt' ) ) {
	/**
	 * Strip shortcodes from excerpt
	 *
	 * @param string $content Excerpt.
	 */
	function csco_strip_shortcode_from_excerpt( $content ) {
		$content = strip_shortcodes( $content );
		return $content;
	}
}
add_filter( 'the_excerpt', 'csco_strip_shortcode_from_excerpt' );

if ( ! function_exists( 'csco_strip_tags_from_excerpt' ) ) {
	/**
	 * Strip HTML from excerpt
	 *
	 * @param string $content Excerpt.
	 */
	function csco_strip_tags_from_excerpt( $content ) {
		$content = wp_strip_all_tags( $content );
		return $content;
	}
}
add_filter( 'the_excerpt', 'csco_strip_tags_from_excerpt' );

if ( ! function_exists( 'csco_excerpt_more' ) ) {
	/**
	 * Excerpt Suffix
	 *
	 * @param string $more suffix for the excerpt.
	 */
	function csco_excerpt_more( $more ) {
		return '&hellip;';
	}
}
add_filter( 'excerpt_more', 'csco_excerpt_more' );

if ( ! function_exists( 'csco_post_meta_process' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param array $data Post meta list.
	 */
	function csco_post_meta_process( $data ) {
		if ( csco_post_views_enabled() ) {
			$data['views'] = esc_html__( 'Views', 'newsreader' );
		}
		return $data;
	}
}
add_filter( 'csco_post_meta_choices', 'csco_post_meta_process' );

if ( ! function_exists( 'csco_search_only_posts' ) ) {
	/**
	 * Search only posts.
	 *
	 * @param object $query The WP_Query instance (passed by reference).
	 */
	function csco_search_only_posts( $query ) {
		if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
			$query->set( 'post_type', 'post' );
		}
	}
	add_action( 'pre_get_posts', 'csco_search_only_posts' );
}

if ( ! function_exists( 'csco_register_block_styles' ) ) {
	/**
	 * Register block styles.
	 */
	function csco_register_block_styles() {
		if ( ! function_exists( 'register_block_style' ) ) {
			return;
		}

		register_block_style( 'core/heading', array(
			'name'  => 'cs-heading-primary',
			'label' => esc_html__(  'Primary', 'newsreader' ),
		) );

		register_block_style( 'core/latest-posts', array(
			'name'  => 'cs-numbered-layout',
			'label' => esc_html__( 'Numbered', 'newsreader' ),
		) );

		register_block_style( 'core/latest-posts', array(
			'name'  => 'cs-tile-layout',
			'label' => esc_html__( 'Tile', 'newsreader' ),
		) );
	}
	add_action( 'init', 'csco_register_block_styles' );
}

if ( ! function_exists( 'csco_comment_form_defaults' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	function csco_comment_form_defaults( $defaults ) {

		$label = esc_html__( 'Comment', 'newsreader' ) . ( ' <span class="required">*</span>' );

		$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . $label . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';

		return $defaults;
	}
}
add_filter( 'comment_form_defaults', 'csco_comment_form_defaults' );

if ( ! function_exists( 'csco_comment_form_default_fields' ) ) {
	/**
	 * Pre processing post meta choices
	 *
	 * @param string[] $fields Array of the default comment fields.
	 */
	function csco_comment_form_default_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$user      = wp_get_current_user();
		$req       = get_option( 'require_name_email' );
		$html_req  = ( $req ? " required='required'" : '' );

		$label_author = esc_html__( 'Your Name', 'newsreader' ) . ( $req ? ' <span class="required">*</span>' : '' );
		$label_email  = esc_html__( 'Your E-mail', 'newsreader' ) . ( $req ? ' <span class="required">*</span>' : '' );
		$label_url    = esc_html__( 'Website', 'newsreader' );

		$fields['author'] = '<p class="comment-form-author"><label for="author">' . $label_author . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245" ' . wp_kses( $html_req, 'csco' ) . '></p>';
		$fields['email']  = '<p class="comment-form-email"><label for="email">' . $label_email . '</label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" ' . wp_kses( $html_req, 'csco' ) . '></p>';
		$fields['url']    = '<p class="comment-form-url"><label for="url">' . $label_url . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200"></p>';
		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'csco_comment_form_default_fields' );

if ( ! function_exists( 'csco_singular_register_options' ) ) {
	/**
	 * Register options for single and page
	 */
	function csco_singular_register_options() {
		$function = sprintf( 'add_meta_%s', 'box' );

		$function( 'csco_singular_options', esc_html__( 'Singular Options', 'newsreader' ), function () {
			return __return_empty_string();
		}, array( 'post', 'page' ), 'side' );
	}
	add_action( sprintf( 'add_meta_%s', 'boxes' ), 'csco_singular_register_options' );
}

if ( ! function_exists( 'csco_exclude_archive_header_posts_from_query' ) ) {
	/**
	 * Exclude Archive Header posts from the Main Query
	 *
	 * @param array $query Default query.
	 */
	function csco_exclude_archive_header_posts_from_query( $query ) {
		if ( is_admin() ) {
			return $query;
		}

		if ( ! $query->is_category ) {
			return $query;
		}

		if ( ! $query->is_main_query() ) {
			return $query;
		}

		$archive_header_global = get_theme_mod( 'archive_header', 'disabled' );
		$category_id           = get_queried_object_id();
		$archive_header_local  = get_term_meta( $category_id, 'csco_category_header', true );

		if ( '2' === $archive_header_local || ( '1' !== $archive_header_local && 'disabled' === $archive_header_global ) ) {
			return $query;
		}

		$args = csco_get_archive_header_query_args();

		$args['fields'] = 'ids';

		$query_to_exclude = new WP_Query( $args );

		if ( isset( $query_to_exclude->posts ) && $query_to_exclude->posts ) {
			$post_ids = $query_to_exclude->posts;
		}

		if ( ! isset( $post_ids ) || ! $post_ids ) {
			return $query;
		}

		$query->set( 'post__not_in', array_merge( $query->get( 'post__not_in' ), $post_ids ) );

		return $query;
	}
}
add_action( 'pre_get_posts', 'csco_exclude_archive_header_posts_from_query', 9999 );

/**
 * -------------------------------------------------------------------------
 * Banner in Post
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'csco_insert_banner_in_post_content' ) ) {
	/**
	 * Wrapper function to insert banner in post content.
	 *
	 * @param string $content The post content.
	 */
	function csco_insert_banner_in_post_content( $content ) {
		if ( ! is_singular( 'post' ) ) {
			return $content;
		}

		if ( true === get_theme_mod( 'post_banner_inside', false ) ) {

			$after_paragraph = get_theme_mod( 'post_banner_inside_after_paragraph', 3 );

			ob_start();

			$settings = array(
				'banner_section'    => 'post-inner',
				'banner_html'       => get_theme_mod( 'post_banner_inside_html_content' ),
				'banner_label'      => get_theme_mod( 'post_banner_inside_label', true ),
				'banner_label_text' => get_theme_mod( 'post_banner_inside_label_text', 'Advertisement' ),
				'banner_alignment'  => get_theme_mod( 'post_banner_inside_section_alignment', 'default' ),
				'banner_code'       => '<a href="https://1.envato.market/newsreader" title="Ad Banner"><img src="http://publisher.test/wp-content/uploads/2024/03/demo-banner-horizontal-0004.webp" alt="test banner"></a>',

			);

			csco_banner( $settings );

			$banner_html_content = ob_get_clean();

			if ( $banner_html_content ) {
				$paragraphs = explode( '</p>', $content );

				foreach ( $paragraphs as $index => $paragraph ) {
					if ( trim( $paragraph ) && $index + 1 == $after_paragraph ) {
						$paragraphs[ $index ] .= $banner_html_content;
					}
				}

				$content = implode( '</p>', $paragraphs );
			}
		}

		return $content;
	}
}
add_filter( 'the_content', 'csco_insert_banner_in_post_content' );

/**
 * -------------------------------------------------------------------------
 * Render Blocks
 * -------------------------------------------------------------------------
 */

if ( ! function_exists( 'csco_custom_render_block_categories' ) ) {
	/**
	 * Block Render Categories
	 *
	 * @param string $block_content The content.
	 * @param array  $block         The block.
	 */
	function csco_custom_render_block_categories( $block_content, $block ) {

		if ( 'core/categories' === $block['blockName'] && false !== strpos( $block_content, 'is-style-cs-tiles' ) ) {
			$block_content = preg_replace_callback( '|<a(.*?)href="(.*?)">(.*?)<\/a> \((.*?)\)|', function ( $matches ) {
				return '<a' . $matches[1] . 'href="' . $matches[2] . '">' . $matches[3] . ' <span>' . $matches[4] . '</span></a>';
			}, $block_content );
		}

		return $block_content;
	}
}
add_filter( 'render_block', 'csco_custom_render_block_categories', 10, 2 );

if ( ! function_exists( 'csco_custom_render_block_social_links' ) ) {
	/**
	 * Block Render Social Links
	 *
	 * @param string $block_content The content.
	 * @param array  $block         The block.
	 */
	function csco_custom_render_block_social_links( $block_content, $block ) {

		if ( 'core/social-links' === $block['blockName'] ) {
			$block_content = preg_replace_callback( '|<a(.*?)href="([^"]+)"|', function ( $matches ) {

				$domain = parse_url( $matches[2], PHP_URL_HOST );

				$title = explode( '.', str_replace( 'www.', '', $domain ) )[0];

				return '<a' . $matches[1] . 'href="' . $matches[2] . '"' . ( $title ? ' title="' . ucfirst( $title ) . '"' : '' );
			}, $block_content );
		}

		return $block_content;
	}
}
add_filter( 'render_block', 'csco_custom_render_block_social_links', 10, 2 );

if ( ! function_exists( 'csco_custom_render_block_latest_posts' ) ) {
	/**
	 * Block Render Latest Posts
	 *
	 * @param string $block_content The content.
	 * @param array  $block         The block.
	 */
	function csco_custom_render_block_latest_posts( $block_content, $block ) {

		if ( 'core/latest-posts' === $block['blockName'] ) {

			$has_numbered_layout_class = isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'is-style-cs-numbered-layout' ) !== false;
			$has_tile_layout_class     = isset( $block['attrs']['className'] ) && strpos( $block['attrs']['className'], 'is-style-cs-tile-layout' ) !== false;

			if ( $has_numbered_layout_class || $has_tile_layout_class ) {

				// Add author Link.
				$block_content = preg_replace_callback( '|(<a class="wp-block-latest-posts__post-title" href=".*?">([^<]*?)</a>)<div class="wp-block-latest-posts__post-author">([^<]*?)<\/div>|', function ( $matches ) {

					$output = $matches[0];

					$items = get_posts( array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						's'              => html_entity_decode( $matches[2] ),
						'posts_per_page' => 1,
					) );

					if ( ! empty( $items ) ) {
						$author_id  = $items[0]->post_author;
						$author_url = get_author_posts_url( $author_id );
						$full_name  = trim( str_replace( 'by', '', $matches[3] ) );

						if ( $author_url && $full_name ) {

							$output = str_replace( $full_name, sprintf( '<a href="%s">%s</a>', $author_url, $full_name ), $output );
						}
					}

					return $output;
				}, $block_content );

				// Add Meta container.
				$block_content = preg_replace_callback( '|(<div class="wp-block-latest-posts__post-author">.*?<\/div><time datetime=".*?" class="wp-block-latest-posts__post-date">.*?</time>)|', function ( $matches ) {

					$output = $matches[0];

					$items = get_posts( array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => 1,
					) );

					if ( ! empty( $items ) ) {
						$output = '<div class="wp-block-latest-posts__meta">' . $output . '</div>';
					}

					return $output;

				}, $block_content );
			}

			if ( $has_tile_layout_class ) {

				// Add Category.
				$block_content = preg_replace_callback( '|(<a class="wp-block-latest-posts__post-title" href=".*?">([^<]*?)</a>)|', function ( $matches ) {

					$output     = $matches[0];
					$post_title = html_entity_decode( $matches[1] );

					$items = get_posts( array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'name'           => sanitize_title($post_title),
						'posts_per_page' => 1,
					) );

					if ( ! empty( $items ) ) {
						// Fetch current post category.
						$categories        = get_the_category( $items[0]->ID );
						$post_category_url = ! empty( $categories ) ? get_category_link( $categories[0]->term_id ) : '';
						$post_category     = ! empty( $categories ) ? '<div class="wp-block-latest-posts__category"><a href="' . $post_category_url . '">' . $categories[0]->name . '</a></div>' : '';

						$output = $post_category . $output;
					}

					return $output;

				}, $block_content );

				// Add Content container & overlay link.
				$block_content = preg_replace_callback( '|(<div class="wp-block-latest-posts__category">.*?</div><a class="wp-block-latest-posts__post-title" href="([^<]*?)">.*?</a><div class="wp-block-latest-posts__meta">.*?<time datetime=".*?" class="wp-block-latest-posts__post-date">.*?</time></div>)|', function ( $matches ) {

					$output = $matches[0];

					$items = get_posts( array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => 1,
					) );

					if ( ! empty( $items ) ) {
						$post_permalink = $matches[2];

						$output = '<div class="wp-block-latest-posts__content" data-scheme="inverse"><a class="wp-block-latest-posts__link" href="' . esc_url( $post_permalink ) . '"></a><div class="wp-block-latest-posts__content-inner">' . $output . '</div></div>';
					}

					return $output;

				}, $block_content );
			}
		}

		return $block_content;
	}
}
add_filter( 'render_block', 'csco_custom_render_block_latest_posts', 10, 2 );

/**
 * -------------------------------------------------------------------------
 * Breadcrumbs separator
 * -------------------------------------------------------------------------
 */
if ( ! function_exists( 'csco_replace_breadcrumb_separator' ) ) {
	/**
	 * Change the breadcrumbs HTML output.
	 *
	 * @param string $html HTML output.
	 */
	function csco_replace_breadcrumb_separator( $html ) {
		$breadcrumbs_separators = array(
			'#<span class="separator">(.*?)</span>#',
			'#<span class="aioseo-breadcrumb-separator">(.*?)</span>#',
		);
		$html = preg_replace( $breadcrumbs_separators, '<span class="cs-separator"></span>', $html );

		return $html;
	}
}
add_filter( 'rank_math/frontend/breadcrumb/html', 'csco_replace_breadcrumb_separator' );
add_filter( 'aioseo_breadcrumbs_separator', 'csco_replace_breadcrumb_separator' );
