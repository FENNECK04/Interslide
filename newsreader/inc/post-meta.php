<?php
/**
 * Post Meta Helper Functions
 *
 * These helper functions return post meta, if its enabled in WordPress Customizer.
 *
 * @package Newsreader
 */

if ( ! function_exists('csco_get_post_meta' ) ) {
	/**
	 * Post Meta
	 *
	 * A wrapper function that returns all post meta types either
	 * in an ordered list <ul> or as a single element <span>.
	 *
	 * @param mixed $meta     Contains post meta types.
	 * @param bool  $output   Output or return.
	 * @param mixed $allowed  Allowed meta types (array: list types, true: auto definition, option name: get value of option).
	 * @param array $settings The advanced settings.
	 */
	function csco_get_post_meta( $meta, $output = true, $allowed = null, $settings = array() ) {

		// Return if no post meta types provided.
		if ( ! $meta ) {
			return;
		}

		$meta = (array) $meta;

		// Set default settings.
		$settings = array_merge( array(
			'category_type' => 'default',
			'author_avatar' => false,
		), $settings );

		if ( is_string( $allowed ) || true === $allowed ) {
			$option_default = null;

			$option_name = is_string( $allowed ) ? $allowed : csco_get_archive_option( 'post_meta' );

			if ( isset( CSCO_Customizer::$fields[ $option_name ]['default'] ) ) {
				$option_default = CSCO_Customizer::$fields[ $option_name ]['default'];
			}

			$allowed = get_theme_mod( $option_name, $option_default );
		}

		// Set default allowed post meta types.
		if ( ! is_array( $allowed ) && ! $allowed ) {
			/**
			 * The csco_post_meta hook.
			 *
			 * @since 1.0.0
			 */
			$allowed = apply_filters( 'csco_post_meta', array( 'category', 'author', 'comments', 'date' ) );
		}

		// Intersect provided and allowed meta types.
		if ( is_array( $meta ) ) {
			$meta = array_intersect( $meta, $allowed );
		}

		// Build meta markup.
		$markup = __return_null();

		if ( is_array( $meta ) && $meta ) {

			// Add normal meta types to the list.
			foreach ( $meta as $type ) {
				$markup .= call_user_func( "csco_get_meta_$type", 'div', $settings );
			}

			/**
			 * The csco_post_meta_scheme hook.
			 *
			 * @since 1.0.0
			 */
			$scheme = apply_filters( 'csco_post_meta_scheme', null, $settings );

			$markup = sprintf( '<div class="cs-entry__post-meta" %s>%s</div>', $scheme, $markup );

		} elseif ( in_array( $meta, $allowed, true ) ) {
			// Markup single meta type.
			$markup .= call_user_func( "csco_get_meta_$meta", 'div', $settings );
		}

		// If output is enabled.
		if ( $output ) {
			return call_user_func( 'printf', '%s', $markup );
		}

		return $markup;
	}
}

if ( ! function_exists( 'csco_get_meta_category' ) ) {
	/**
	 * Post Сategory
	 *
	 * @param string $tag      Element tag, i.e. div or span.
	 * @param array  $settings The advanced settings.
	 */
	function csco_get_meta_category( $tag = 'div', $settings = array() ) {

		if ( 'line' === $settings['category_type'] ) {
			$output = '<' . esc_html( $tag ) . ' class="cs-entry__category">';
		} else {
			$output = '<' . esc_html( $tag ) . ' class="cs-meta-category">';
		}

		$output .= get_the_category_list( '', '', get_the_ID() );

		$output .= '</' . esc_html( $tag ) . '>';

		return $output;
	}
}

if ( ! function_exists( 'csco_get_meta_date' ) ) {
	/**
	 * Post Date
	 *
	 * @param string $tag      Element tag, i.e. div or span.
	 * @param array  $settings The advanced settings.
	 */
	function csco_get_meta_date( $tag = 'div', $settings = array() ) {

		$output = '<' . esc_html( $tag ) . ' class="cs-meta-date">';

		$time_string = get_the_date();

		if ( get_the_time( 'd.m.Y H:i' ) !== get_the_modified_time( 'd.m.Y H:i' ) ) {
			if ( ! get_theme_mod( 'misc_published_date', true ) ) {
				$time_string = get_the_modified_date();
			}
		}

		/**
		 * The csco_post_meta_date_output hook.
		 *
		 * @since 1.0.0
		 */
		$output .= apply_filters( 'csco_post_meta_date_output', $time_string );

		$output .= '</' . esc_html( $tag ) . '>';

		return $output;
	}
}

if ( ! function_exists( 'csco_get_meta_author' ) ) {
	/**
	 * Post Author
	 *
	 * @param string $tag      Element tag, i.e. div or span.
	 * @param array  $settings The advanced settings.
	 */
	function csco_get_meta_author( $tag = 'div', $settings = array() ) {

		$output = '<' . esc_attr( $tag ) . ' class="cs-meta-author">';

		if ( isset( $settings['author_avatar'] ) && $settings['author_avatar'] ) {
			$author_avatar = get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'csco_meta_avatar_size', 34 ) );

			$output .= '<picture class="cs-meta-author-avatar">' . $author_avatar . '</picture>';
		}

		$output .= '<span class="cs-meta-author-by">' . esc_html__( 'by', 'newsreader' ) . '</span>';

		$output .= '<a class="cs-meta-author-link url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">';

		$output .= '<span class="cs-meta-author-name">' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span>';

		$output .= '</a>';

		$output .= '</' . esc_html( $tag ) . '>';

		return $output;
	}
}

if ( ! function_exists( 'csco_get_meta_comments' ) ) {
	/**
	 * Post Comments
	 *
	 * @param string $tag      Element tag, i.e. div or span.
	 * @param array  $settings The advanced settings.
	 */
	function csco_get_meta_comments( $tag = 'div', $settings = array() ) {

		if ( ! comments_open( get_the_ID() ) ) {
			return;
		}

		$output = '<' . esc_html( $tag ) . ' class="cs-meta-comments">';

		ob_start();
		comments_popup_link( '0', '1', '%', 'comments-link', '' );
		$output .= ob_get_clean();

		$output .= '</' . esc_html( $tag ) . '>';

		return $output;
	}
}

if ( ! function_exists( 'csco_get_meta_views' ) ) {
	/**
	 * Post Views
	 *
	 * @param string $tag      Element tag, i.e. div or span.
	 * @param array  $settings The advanced settings.
	 */
	function csco_get_meta_views( $tag = 'div', $settings = array() ) {

		switch ( csco_post_views_enabled() ) {
			case 'post_views':
				$views = pvc_get_post_views();
				break;
			default:
				return;
		}

		/**
		 * Don't display if minimum threshold is not met.
		 *
		 * @since 1.0.0
		 */
		if ( $views < apply_filters( 'csco_minimum_views', 1 ) ) {
			return;
		}

		$output  = '<' . esc_html( $tag ) . ' class="cs-meta-views">';
		$output .= '<span class="cs-meta-icon"><i class="cs-icon cs-icon-eye"></i></span>';

		$views_rounded = csco_get_round_number( $views );

		if ( $views > 1000 ) {
			$output .= $views_rounded . ' ' . esc_html__( 'views', 'newsreader' );
		} else {
			/* translators: %s number of post views */
			$output .= esc_html( sprintf( _n( '%s view', '%s views', $views, 'newsreader' ), $views ) );
		}

		$output .= '</' . esc_html( $tag ) . '>';

		return $output;
	}
}
