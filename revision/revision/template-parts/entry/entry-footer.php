<?php
/**
 * The template part for displaying post footer section.
 *
 * @package Revision
 */

?>

<div class="cs-entry__footer">
	<div class="cs-entry__footer-top">
		<div class="cs-entry__footer-top-left">
			<?php csco_get_post_meta( array( 'author', 'date', 'views' ), true, array( 'author', 'date', 'views' ) ); ?>
		</div>
		<div class="cs-entry__footer-top-right">
			<?php csco_get_post_meta( array( 'category' ), true, array( 'category' ) ); ?>
		</div>
	</div>
	<?php
	if ( get_theme_mod( 'post_metabar', true ) ) {
		?>
		<div class="cs-entry__metabar-item cs-entry__metabar-share">
			<span><?php echo esc_html__( 'Share', 'revision' ); ?></span><?php csco_component( 'share_links' ); ?>
		</div>
	<?php } ?>
</div>
