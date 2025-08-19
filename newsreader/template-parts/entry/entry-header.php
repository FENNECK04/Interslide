<?php
/**
 * Template part entry header
 *
 * @package Newsreader
 */

$header_type = csco_get_page_header_type();

if ( 'standard' === $header_type ) {

	$thumbnail_size_mobile = 'csco-thumbnail';
	$thumbnail_size        = 'csco-large';

	if ( 'uncropped' === csco_get_page_preview() ) {
		$thumbnail_size_mobile = sprintf( '%s-uncropped', $thumbnail_size_mobile );
		$thumbnail_size        = sprintf( '%s-uncropped', $thumbnail_size );
	}

	$caption = csco_post_thumbnail_caption();

	get_template_part( 'template-parts/entry/entry-header-secondary-info' );

	if ( has_post_thumbnail() ) {
		?>
		<div class="cs-entry__media">
			<div class="cs-entry__media-inner">
				<div class="cs-entry__thumbnail">
					<figure class="cs-entry__media-wrap ">
						<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</figure>
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
} elseif ( 'featured' === $header_type ) {
	$header_class = '';

	if ( has_post_thumbnail() ) {
		$header_class = 'cs-entry__header-has-image';
	}
	?>

	<div class="cs-entry__header cs-entry__header-featured <?php echo esc_attr( $header_class ); ?>">
		<div class="cs-entry__header-inner">
			<div class="cs-entry__outer">
				<div class="cs-entry__inner cs-entry__content">
					<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>

	<?php
} elseif ( 'overlay' === $header_type ) {
	?>

	<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>

	<?php
} elseif ( 'large_overlay' === $header_type ) {
	?>

	<?php get_template_part( 'template-parts/entry/entry-header-secondary-info' ); ?>

	<?php
} elseif ( 'title' === $header_type ) {
	?>
	<div class="cs-entry__header cs-entry__header-title-only">
		<div class="cs-entry__header-inner">
			<div class="cs-entry__outer">
				<div class="cs-entry__inner cs-entry__content">
					<?php the_title( '<h1 class="cs-entry__title"><span>', '</span></h1>' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
