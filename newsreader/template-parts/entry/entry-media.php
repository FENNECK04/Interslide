<?php
/**
 * The template part for displaying overlay entry header.
 *
 * @package Newsreader
 */

$thumbnail_size_mobile = 'csco-thumbnail-uncropped';
$thumbnail_size        = 'csco-extra-large-uncropped';

$caption = csco_post_thumbnail_caption();
?>

<div class="cs-entry__header cs-entry__header-overlay">
	<div class="cs-entry__outer cs-entry__overlay cs-overlay-ratio cs-ratio-wide cs-video-wrap" data-scheme="inverse">
		<div class="cs-entry__inner cs-entry__thumbnail">
			<div class="cs-overlay-background">
				<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
				<?php the_post_thumbnail( $thumbnail_size ); ?>

				<?php
				if ( 'overlay' === csco_get_page_header_type() ) {
					csco_get_video_background( 'large-header', null, 'large', true, true );
				}
				?>
			</div>
		</div>
		<div class="cs-entry__inner cs-entry__content cs-overlay-content">
			<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
		</div>
	</div>
	<?php if ( $caption ) { ?>
		<div class="cs-entry__thumbnail-caption">
			<?php echo esc_attr( $caption ); ?>
		</div>
	<?php } ?>
</div>
