<?php
/**
 * The template part for displaying header secondary info.
 *
 * @package Newsreader
 */

// Post Meta.
if ( is_singular( 'post' ) ) {

	if ( get_theme_mod( 'post_meta', array( 'author', 'date', 'comments' ) ) ) {
		$display_post_meta = __return_true();
	}

	if ( isset( $display_post_meta ) || isset( $display_share_buttons ) ) {
		?>
		<div class="cs-entry__infobar">
			<div class="cs-entry__infobar-inner">
				<div class="cs-entry__content">
					<?php
					if ( isset( $display_post_meta ) ) {
						csco_get_post_meta( array( 'author', 'date', 'comments' ), true, 'post_meta', array( 'author_avatar' => true ) );
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	<?php
}
