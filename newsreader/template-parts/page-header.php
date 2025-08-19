<?php
/**
 * The template part for displaying page header.
 *
 * @package Newsreader
 */

// Init clasfor header.
$class = null;

// If description exists.
if ( get_the_archive_description() ) {
	$class = 'cs-page__header-has-description';
}
?>

<?php
do_action( 'csco_page_header_before' );

if ( is_author() ) {

	$subtitle  = esc_html__( 'All Posts By', 'newsreader' );
	$author_id = get_queried_object_id();
	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<div class="cs-page__author">
			<div class="cs-page__author-container">
				<div class="cs-page__author-photo">
					<div class="cs-page__author-thumbnail">
						<?php echo get_avatar( $author_id, 148 ); ?>
					</div>
				</div>
				<div class="cs-page__author-info">
					<?php

					the_archive_title( '<h1 class="cs-page__title">', '</h1>' );

					csco_user_social_links();
					?>

				</div>

			</div>
			<?php csco_archive_post_description(); ?>
			<?php csco_archive_post_count(); ?>
		</div>
	</div>
	<?php

} elseif ( is_archive() ) {

	$archive_header_global = get_theme_mod( 'archive_header', 'disabled' );
	$category_id           = get_queried_object_id();
	$archive_header_local  = get_term_meta( $category_id, 'csco_category_header', true );

	if ( '1' === $archive_header_local || ( '2' !== $archive_header_local && 'enabled' === $archive_header_global ) ) {
		return;
	}

	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<?php
		the_archive_title( '<h1 class="cs-page__title">', '</h1>' );
		csco_archive_post_description();
		csco_archive_post_count();
		?>
	</div>
	<?php

} elseif ( is_search() ) {

	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<h1 class="cs-page__title"><span><?php esc_html_e( 'Search Results:', 'newsreader' ); ?> <?php echo get_search_query(); ?></span></h1>
		<?php
		get_template_part( 'searchform' );
		csco_archive_post_count();
		?>
	</div>
	<?php

} elseif ( is_404() ) {
	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<h1 class="cs-page__title"><?php esc_html_e( 'Page Not Found', 'newsreader' ); ?></h1>
	</div>
	<?php
}

do_action( 'csco_page_header_after' );
