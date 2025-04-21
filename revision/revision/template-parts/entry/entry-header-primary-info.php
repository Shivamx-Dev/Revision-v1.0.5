<?php
/**
 * The template part for displaying header primary info.
 *
 * @package Revision
 */

// Post Meta.
if ( is_singular( 'post' ) ) {
	global $post;

	setup_postdata( $post );

	csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, 'post_meta' );

	wp_reset_postdata();
}
?>
	<div class="cs-entry-title-and-subtitle">
		<?php
		// Title.
		the_title( '<h1 class="cs-entry__title"><span>', '</span></h1>' );

		// Subtitle.
		csco_post_subtitle();
		?>
	</div>
<?php
if ( is_singular( 'post' ) ) {
	global $post;

	setup_postdata( $post );

	csco_get_post_meta( array( 'category' ), true, 'post_meta' );

	wp_reset_postdata();
}
