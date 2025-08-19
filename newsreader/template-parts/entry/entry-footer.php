<?php
/**
 * The template part for displaying post footer section.
 *
 * @package Newsreader
 */

?>

<div class="cs-entry__footer">
	<div class="cs-entry__footer-top">
		<div class="cs-entry__footer-top-left">
			<?php csco_get_post_meta( array( 'author' ), true, array( 'author' ), array( 'author_avatar' => true ) ); ?>
			<div class="cs-entry__footer-date">
				<div class="cs-entry__footer-date-inner">
					<?php if ( ! get_theme_mod( 'misc_published_date', true ) ) { ?>
						<span class="cs-entry__footer-title"><?php esc_html_e( 'Updated', 'newsreader' ); ?></span>
						<time class="cs-entry__footer-value"><?php echo esc_html( get_the_modified_date( 'F d, Y' ) ); ?></time>
					<?php } else { ?>
						<span class="cs-entry__footer-title"><?php esc_html_e( 'Published', 'newsreader' ); ?></span>
						<time class="cs-entry__footer-value"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></time>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
