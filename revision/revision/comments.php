<?php
/**
 * The template for displaying comments
 *
 * @package Revision
 */

?>

<?php
/**
 * The csco_comments_before hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_comments_before' );

$button_text     = '';
$button_class    = '';
$comments_number = get_comments_number();

if ( $comments_number > 0 ) {
	$button_text = sprintf( __( 'View Comments (%s)', 'revision' ), $comments_number );
} else {
	$button_text  = __( 'Write a Comment', 'revision' );
	$button_class = 'cs-button';
}
?>

<div class="cs-entry__comments" id="comments">

	<div class="cs-entry__comments-header">
		<div class="cs-entry__comments-header-top">
			<div class="cs-entry__comments-header-comment-view-toggle">
				<span class="cs-entry__comments-view-toggle <?php echo esc_attr( $button_class ); ?>"><?php echo esc_html( $button_text ); ?></span>
			</div>
		</div>
	</div>

	<div class="cs-entry__comments-inner">

		<?php if ( have_comments() ) { ?>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'callback'    => 'csco_comments_callback',
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 30, // Use 0 to disable avatar.
					)
				);
				?>
			</ol>

			<?php the_comments_navigation(); ?>

		<?php } ?>

		<?php
		comment_form(
			array(
				'title_reply'        => esc_html__( 'Leave a Comment', 'revision' ),
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
				'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">' . esc_html__( 'Submit Comment', 'revision' ) . ' </button>',
				'submit_field'       => '<p class="form-submit">%1$s %2$s <span class="cs-cancel-reply-button"></span></p>',
				'cancel_reply_link'  => esc_html__( 'Cancel', 'revision' ),
			)
		);
		?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'revision' ); ?></p>

			<?php
		}
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
