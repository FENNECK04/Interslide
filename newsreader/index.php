<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsreader
 */

get_header(); ?>

<div id="primary" class="cs-content-area">

	<?php
	/**
	 * The csco_main_before hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_before' );
	?>

	<?php
	if ( have_posts() ) {
		// Set options.
		$options = csco_get_archive_options();

		// Location.
		$main_classes = ' cs-posts-area__' . $options['location'];

		// Layout.
		$main_classes .= ' cs-posts-area__' . $options['layout'];

		// Divider.
		$grid_divider = false;
		$grid_class   = '';

		if ( 'grid' === $options['layout'] || 'full' === $options['layout'] ) {

			$location = 'archive';

			if ( 'home' === $options['location'] ) {
				$location = 'home';
			}

			$grid_divider = get_theme_mod( $location . '_divider', true);
			$grid_class   = '';

			if ( 'grid' === $options['layout'] ) {
				$columns_dk = get_theme_mod( $location . '_columns_desktop', 3 );
				$columns_lt = get_theme_mod( $location . '_columns_laptop', 2 );
				$columns_tb = get_theme_mod( $location . '_columns_tablet', 2 );
				$columns_mb = get_theme_mod( $location . '_columns_mobile', 1 );
			}

			if ( $grid_divider ) {
				$grid_class = 'cs-posts-area__main-divider';
			}
		}

		// Archives Banner.
		if ( 'archive' === $options['location'] ) {
			$archive_columns_desktop = (int) get_theme_mod( 'archive_columns_desktop', 3 );
		}

		?>

		<div class="cs-posts-area cs-posts-area-posts">
			<div class="cs-posts-area__outer">

				<div
				class="cs-posts-area__main cs-archive-<?php echo esc_attr( $options['layout'] ); ?> <?php echo esc_attr( $main_classes ); ?> <?php echo esc_attr( $grid_class ); ?>"
				<?php if ( 'grid' === $options['layout'] ) { ?>
					data-pc="<?php echo esc_attr( $columns_dk ); ?>"
					data-lt="<?php echo esc_attr( $columns_lt ); ?>"
					data-tb="<?php echo esc_attr( $columns_tb ); ?>"
					data-mb="<?php echo esc_attr( $columns_mb ); ?>"
				<?php } ?>
				>
					<?php
					$counter = 1;
					// Start the Loop.
					while ( have_posts() ) {
						the_post();

						set_query_var( 'options', $options );

						if ( 'full' === $options['layout'] ) {
							get_template_part( 'template-parts/archive/content-full' );
						} else {
							get_template_part( 'template-parts/archive/entry' );
						}

						if ( 'archive' === $options['location'] && true === get_theme_mod( 'archive_banner', false ) && $archive_columns_desktop === $counter ) {

							$settings = array(
								'banner_section'    => 'archive',
								'banner_html'       => get_theme_mod( 'archive_banner_html' ),
								'banner_label'      => get_theme_mod( 'archive_banner_label', true ),
								'banner_label_text' => get_theme_mod( 'archive_banner_label_text', 'Advertisement' ),
							);

							csco_banner( $settings );
						}

						++$counter;
					}
					?>
				</div>
			</div>

			<?php
			/* Posts Pagination */
			if ( 'standard' === get_theme_mod( csco_get_archive_option( 'pagination_type' ), 'load-more' ) ) {
				?>
				<div class="cs-posts-area__pagination">
					<?php
						the_posts_pagination(
							array(
								'prev_text' => '',
								'next_text' => '',
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} elseif ( ! get_query_var( 'csco_have_search' ) ) {
		?>
		<div class="entry-content cs-content-not-found">

			<?php if ( is_search() ) { ?>
				<div class="cs-content-not-found-content">
					<?php esc_html_e( 'It seems we cannot find what you are looking for. Please check the spelling or rephrase.', 'newsreader' ); ?>
				</div>
			<?php } elseif ( is_404() ) { ?>
				<div class="cs-content-not-found-content">
					<?php esc_html_e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place. Perhaps searching can help.', 'newsreader' ); ?>
				</div>
				<a class="cs-button" href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Back to Home Page', 'newsreader' ); ?></a>
			<?php } ?>

		</div>
		<?php
	}
	?>

	<?php
	/**
	 * The csco_main_after hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_after' );
	?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
