<?php
/**
 * Template part for displaying Archive Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Newsreader
 */

$args = csco_get_archive_header_query_args();
$meta = get_theme_mod( 'archive_header_post_meta', array( 'category', 'author', 'date' ) );

$counter               = 0;
$thumbnail_size_mobile = 'csco-thumbnail';
$thumbnail_size        = 'csco-thumbnail';

$attachment_orientation = get_theme_mod( 'archive_header_image_orientation', 'landscape-16-9' );

$excerpt = get_theme_mod( 'archive_header_excerpt', array( 'false' ) );

?>

<div class="cs-page__header">
	<?php
	the_archive_title( '<h1 class="cs-page__title">', '</h1>' );
	csco_archive_post_description();
	csco_archive_post_count();
	?>
</div>

<section class="cs-archive-header">
	<div class="cs-archive-header__grid">

		<?php
		$query_test = new \WP_Query( $args );

		if ( $query_test->have_posts() ) {
			while ( $query_test->have_posts() ) {
				$query_test->the_post();
				++$counter;

				if ( 1 === $counter ) {
					$excerpt        = 'true';
					$thumbnail_size = 'csco-large';

					?>
					<article <?php post_class(); ?>>
						<div class="cs-entry__outer">

							<?php if ( has_post_thumbnail() ) { ?>
								<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( $attachment_orientation ); ?>">

									<div class="cs-overlay-background">
										<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
										<?php the_post_thumbnail( $thumbnail_size ); ?>
									</div>

									<?php csco_get_video_background( 'archive' ); ?>

									<?php csco_the_post_format_icon(); ?>

									<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link"></a>
								</div>
							<?php } ?>
							<div class="cs-entry__inner cs-entry__content">
								<?php csco_get_post_meta( array( 'category' ), true, $meta ); ?>

								<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

								<?php if ( 'true' === $excerpt ) { ?>
									<div class="cs-entry__excerpt">
										<?php echo esc_attr( get_the_excerpt() ); ?>
									</div>
								<?php } ?>

								<?php csco_get_post_meta( array( 'author', 'date', 'views', 'comments' ), true, $meta ); ?>
							</div>

						</div>
					</article>
					<?php

				} elseif ( 2 === $counter || 3 === $counter ) {

					$excerpt        = get_theme_mod( 'archive_header_excerpt', array( 'false' ) );
					$thumbnail_size = 'csco-medium';

					?>
					<article <?php post_class(); ?> data-scheme="inverse">
						<div class="cs-entry__outer cs-entry__overlay cs-overlay-ratio cs-ratio-<?php echo esc_attr( $attachment_orientation ); ?>">

							<?php if ( has_post_thumbnail() ) { ?>
								<div class="cs-entry__inner cs-entry__thumbnail">

									<div class="cs-overlay-background">
										<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
										<?php the_post_thumbnail( $thumbnail_size ); ?>
									</div>

									<?php csco_get_video_background( 'archive' ); ?>

									<?php csco_the_post_format_icon(); ?>

									<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link"></a>
								</div>
							<?php } ?>
							<div class="cs-entry__inner cs-entry__content cs-overlay-content">
								<?php csco_get_post_meta( array( 'category' ), true, $meta ); ?>

								<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

								<?php if ( 'true' === $excerpt ) { ?>
									<div class="cs-entry__excerpt">
										<?php echo esc_attr( get_the_excerpt() ); ?>
									</div>
								<?php } ?>

								<?php csco_get_post_meta( array( 'author', 'date', 'views', 'comments' ), true, $meta ); ?>
							</div>

							<a class="cs-overlay-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>

						</div>
					</article>
					<?php

				} else {

					$excerpt        = get_theme_mod( 'archive_header_excerpt', array( 'false' ) );
					$thumbnail_size = 'csco-medium';

					?>
					<article <?php post_class(); ?>>
						<div class="cs-entry__outer">

							<?php if ( has_post_thumbnail() ) { ?>
								<div class="cs-entry__inner cs-entry__overlay cs-entry__thumbnail cs-overlay-ratio cs-ratio-<?php echo esc_attr( $attachment_orientation ); ?>">

									<div class="cs-overlay-background">
										<?php the_post_thumbnail( $thumbnail_size_mobile ); ?>
										<?php the_post_thumbnail( $thumbnail_size ); ?>
									</div>

									<?php csco_get_video_background( 'archive' ); ?>

									<?php csco_the_post_format_icon(); ?>

									<a href="<?php echo esc_url( get_permalink() ); ?>" class="cs-overlay-link"></a>
								</div>
							<?php } ?>
							<div class="cs-entry__inner cs-entry__content">
								<?php csco_get_post_meta( array( 'category' ), true, $meta ); ?>

								<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

								<?php if ( 'true' === $excerpt ) { ?>
									<div class="cs-entry__excerpt">
										<?php echo esc_attr( get_the_excerpt() ); ?>
									</div>
								<?php } ?>

								<?php csco_get_post_meta( array( 'author', 'date', 'views', 'comments' ), true, $meta ); ?>
							</div>

						</div>
					</article>

					<?php
				}
			}
		}
		wp_reset_postdata();
		?>
	</div>
</section>
