<?php
/**
 * The template for displaying comments
 *
 * @package Newsreader
 */

?>

<?php
/**
 * The csco_comments_before hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_comments_before' );
?>

<div class="cs-entry__comments" id="comments">

	<div class="cs-entry__comments-toggle-outer">
		<span class="cs-entry__comments-toggle" role="button" aria-label="<?php echo esc_html__( 'Comments', 'newsreader' ); ?>">
			<?php

			$button_text     = '';
			$comments_number = get_comments_number();

			if ( $comments_number > 0 ) {
				$button_text = $comments_number . ' comments';
			} else {
				$button_text = 'Add a comment';
			}

			echo wp_kses( $button_text, 'content' );

			?>
		</span>
	</div>

	<div class="cs-entry__comments-inner">

		<?php if ( have_comments() ) { ?>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 60,
					)
				);
				?>
			</ol>

			<?php the_comments_navigation(); ?>

		<?php } ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'newsreader' ); ?></p>

			<?php
		}
		?>

		<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
				'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />' . esc_html__( 'Submit Comment', 'newsreader' ) . ' </button>',
			)
		);
		?>

	</div>

</div>

<?php
/**
 * The csco_comments_after hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_comments_after' );
?>
