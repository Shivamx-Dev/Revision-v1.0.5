<?php
/**
 * The template part for displaying header overlay.
 *
 * @package Revision
 */

?>

<div class="cs-entry__outer cs-entry__overlay cs-overlay-ratio cs-ratio-landscape-16-9">
		<div class="cs-entry__inner cs-entry__thumbnail">
			<div class="cs-overlay-background">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'csco-large' );
				}
				?>
			</div>
		</div>
	<div class="cs-entry__inner cs-entry__content cs-overlay-content" data-scheme="inverse">
		<?php get_template_part( 'template-parts/entry/entry-header-primary-info' ); ?>
	</div>
</div>

<?php
