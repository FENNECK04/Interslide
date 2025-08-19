<?php
/**
 * The template part for displaying featured entry header.
 *
 * @package Newsreader
 */

$thumbnail_size        = 'csco-extra-large-uncropped';
$thumbnail_size_mobile = 'csco-thumbnail-uncropped';

$caption = csco_post_thumbnail_caption();

?>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="cs-entry__media cs-entry__media-featured">
		<div class="cs-entry__media-inner">
			<div class="cs-entry__thumbnail">
				<div class="cs-entry__media-wrap cs-overlay-ratio cs-ratio-wide">
					<figure class="cs-overlay-background cs-overlay-transparent">
						<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</figure>
				</div>
				<?php if ( $caption ) { ?>
					<div class="cs-entry__thumbnail-caption">
						<?php echo esc_attr( $caption ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>

<?php
