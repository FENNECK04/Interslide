<?php
/**
 * Template part entry media large
 *
 * @package Newsreader
 */

$header_type = csco_get_page_header_type();

$media_display = has_post_thumbnail();

if ( 'large_overlay' === $header_type ) {
	$media_display = __return_true();
}

$caption = csco_post_thumbnail_caption();

if ( $media_display ) {
	$thumbnail_size_mobile = 'csco-large-uncropped';
	$thumbnail_size        = 'csco-fullwidth-uncropped';

	?>
		<div class="cs-entry__header cs-entry__header-overlay">
			<div class="cs-entry__media cs-entry__media-large cs-entry__media-overlay cs-video-wrap">
				<div class="cs-entry__media-inner">
					<div class="cs-entry__media-wrap cs-overlay-ratio cs-ratio-fullwidth" data-scheme="inverse">

						<figure class="cs-overlay-background">
							<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
							<?php the_post_thumbnail( $thumbnail_size ); ?>

							<?php csco_get_video_background( 'large-header', null, 'large', true, true ); ?>
						</figure>

						<?php csco_breadcrumbs(); ?>

						<div class="cs-entry__media-content">
							<div class="cs-container">
								<div class="cs-entry__header-content cs-overlay-content">
									<div class="cs-entry__header-content-inner">
										<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
									</div>
								</div>
							</div>
						</div>

					</div>
					<?php if ( $caption ) { ?>
						<div class="cs-entry__thumbnail-caption">
							<?php echo esc_attr( $caption ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php
}
