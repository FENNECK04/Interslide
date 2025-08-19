<?php
/**
 * Template part for displaying post tile
 *
 * @package Newsreader
 */

$options     = get_query_var( 'options' );
$entry_class = get_query_var( 'entry_class' );

$meta = array();

if ( 'true' === $options['meta_author'] ) {
	$meta[] = 'author';
}

if ( 'true' === $options['meta_date'] ) {
	$meta[] = 'date';
}

if ( 'true' === $options['meta_category'] ) {
	$meta[] = 'category';
}

if ( 'true' === $options['meta_comments'] ) {
	$meta[] = 'comments';
}

if ( 'true' === $options['meta_views'] ) {
	$meta[] = 'views';
}

$thumbnail_orientation = $options['attachment_orientation'];

if ( 'custom' === $options['attachment_orientation_type'] ) {
	$thumbnail_orientation = 'custom';
}

// Thumbnail size.
$thumbnail_size_mobile = 'csco-thumbnail-uncropped';
$thumbnail_size        = $options['attachment_size'];

?>

<article <?php post_class(); ?>>
	<div
	class="<?php echo esc_attr( $entry_class ); ?> cs-entry__overlay cs-overlay-ratio cs-ratio-<?php echo esc_attr( $thumbnail_orientation ); ?>"
	data-scheme="inverse"
	>

		<div class="cs-entry__inner cs-entry__thumbnail cs-entry__tile">

			<div class="cs-overlay-background">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
					<?php the_post_thumbnail( $thumbnail_size ); ?>
				<?php } ?>
			</div>

			<?php
			if ( 'true' === $options['video'] ) {
				csco_get_video_background( 'elementor', null, 'default', 'true' === $options['video_controls'] ? true : false );
			}
			?>

			<?php
			if ( 'true' === $options['post_format'] ) {
				csco_the_post_format_icon();
			}
			?>

		</div>

		<div class="cs-entry__inner cs-entry__content cs-overlay-content">

			<?php csco_get_post_meta( array( 'category' ), true, $meta ); ?>

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

			<?php csco_get_post_meta( array( 'author', 'date', 'views', 'comments' ), true, $meta ); ?>
		</div>

		<a class="cs-overlay-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
	</div>
</article>
