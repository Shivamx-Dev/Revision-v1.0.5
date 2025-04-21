<?php
/**
 * Template part entry header
 *
 * @package Revision
 */

$header_type = csco_get_page_header_type();

if ( 'title' === $header_type ) {

	$header_class = 'cs-entry__header-title';
	?>

	<div class="cs-entry__header <?php echo esc_attr( $header_class ); ?>">
		<div class="cs-entry__header-inner">
			<?php the_title( '<h1 class="cs-entry__title"><span>', '</span></h1>' ); ?>
		</div>
	</div>

	<?php

} elseif ( 'none' === $header_type ) {

	return;

} elseif ( 'standard' === $header_type ) {

	$header_class = 'cs-entry__header-standard';
	?>

	<div class="cs-entry__header <?php echo esc_attr( $header_class ); ?>">
		<?php get_template_part( 'template-parts/entry/entry-header-standard' ); ?>
	</div>

	<?php

} elseif ( 'split' === $header_type ) {

	$header_class = 'cs-entry__header-split';
	?>

	<div class="cs-entry__header <?php echo esc_attr( $header_class ); ?>">
		<?php get_template_part( 'template-parts/entry/entry-header-split' ); ?>
	</div>

	<?php

} elseif ( 'overlay' === $header_type ) {

	$header_class = 'cs-entry__header-image-overlay';
	?>

	<div class="cs-entry__header <?php echo esc_attr( $header_class ); ?>">
		<?php get_template_part( 'template-parts/entry/entry-header-overlay' ); ?>
	</div>

	<?php

} else {

	$header_class = 'cs-entry__header-primary';
	?>
	<div class="cs-entry__header <?php echo esc_attr( $header_class ); ?>">
		<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
	</div>
	<?php
}
