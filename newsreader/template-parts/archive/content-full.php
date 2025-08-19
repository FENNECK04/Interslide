<?php
/**
 * Template part for displaying full posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newsreader
 */

// Thumbnail size.
$thumbnail_size_mobile = 'csco-thumbnail-uncropped';
$thumbnail_size        = 'csco-large';

if ( 'uncropped' === csco_get_page_preview() ) {
	$thumbnail_size = sprintf( '%s-uncropped', $thumbnail_size );
}
?>

<article <?php post_class(); ?>>
	<div class="cs-entry__full-header">
		<div class="cs-entry__container">
			<?php if ( has_post_thumbnail() ) { ?>
				<figure class="cs-entry__inner cs-entry__thumbnail">
					<div class="cs-overlay-background">
						<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</div>

					<?php csco_get_video_background( 'archive' ); ?>

					<?php csco_the_post_format_icon(); ?>

					<a class="cs-overlay-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title() ); ?>"></a>
				</figure>
			<?php } ?>

			<div class="cs-entry__header-info">
				<?php
				csco_get_post_meta( array( 'category' ), true, $options['meta'] );

				the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '"><span>', '</span></a></h2>' );

				csco_get_post_meta( array( 'author', 'date', 'comments' ), true, $options['meta'] );
				?>
			</div>
		</div>
	</div>

	<div class="cs-entry__wrap">
		<div class="cs-entry__container">
			<div class="cs-entry__content-wrap">
				<div class="cs-entry-type-<?php echo esc_attr( $options['summary_type'] ); ?> ">
					<?php
					if ( 'summary' === $options['summary_type'] ) {
						the_excerpt();
					} else {
						$more_link_text = false;


						$more_link_text = sprintf(
							/* translators: %s: Name of current post */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'newsreader' ),
							get_the_title()
						);

						the_content( $more_link_text );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</article>
