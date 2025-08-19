<?php
/**
 * Template part for displaying post numbered
 *
 * @package Newsreader
 */

$options     = get_query_var( 'options' );
$current     = get_query_var( 'current' );
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

// Thumbnail size.
$thumbnail_size_mobile = 'csco-thumbnail-uncropped';
$thumbnail_size        = $options['attachment_size'];

?>


<article <?php post_class(); ?>>
	<div class="<?php echo esc_attr( $entry_class ); ?>">

		<?php if ( has_post_thumbnail() && $options['thumbnail'] ) { ?>
			<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( $options['attachment_orientation'] ); ?>">

				<div class="cs-overlay-background">
					<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
					<?php the_post_thumbnail( $thumbnail_size ); ?>
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

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
			</div>
		<?php } ?>

		<div class="cs-entry__inner cs-entry__content-wrapper">
			<div class="cs-entry__content">

				<?php csco_get_post_meta( array( 'category' ), true, $meta ); ?>

				<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

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
		</div>

	</div>
</article>
