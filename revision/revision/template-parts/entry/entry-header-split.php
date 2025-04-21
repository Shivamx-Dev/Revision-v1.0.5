<?php
/**
 * The template part for displaying header split.
 *
 * @package Revision
 */

?>

	<div class="cs-entry__inner cs-entry__content">
		<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
	</div>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="cs-entry__inner cs-entry__overlay cs-overlay-ratio cs-ratio-landscape-16-9">
			<div class="cs-entry__thumbnail">
				<div class="cs-overlay-background cs-overlay-transparent">
					<?php the_post_thumbnail( 'csco-medium' ); ?>
				</div>
			</div>
		</div>
	<?php } ?>
