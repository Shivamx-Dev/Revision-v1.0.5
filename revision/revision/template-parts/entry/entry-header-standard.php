<?php
/**
 * The template part for displaying header standard.
 *
 * @package Revision
 */

$thumbnail_size          = 'csco-large';
$thumbnail_overlay_class = 'cs-overlay-ratio cs-ratio-landscape-16-9';

if ( 'uncropped' === csco_get_page_preview() ) {
	$thumbnail_size          = sprintf( '%s-uncropped', $thumbnail_size );
	$thumbnail_overlay_class = '';
}
?>

<div class="cs-entry__inner cs-entry__content">
	<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
</div>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="cs-entry__inner cs-entry__overlay <?php echo esc_attr( $thumbnail_overlay_class ); ?>">
		<div class="cs-entry__thumbnail">
			<div class="cs-overlay-background cs-overlay-transparent">
				<?php the_post_thumbnail( $thumbnail_size ); ?>
			</div>
		</div>
	</div>
<?php } ?>
