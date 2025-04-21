<?php
/**
 * The template for displaying the footer layout
 *
 * @package Revision
 */

?>

<footer class="cs-footer">
	<div class="cs-container">
		<div class="cs-footer__item">
			<div class="cs-footer__item-inner">
				<div class="cs-footer__col cs-col-left">
					<?php csco_component( 'footer_logo' ); ?>
					<?php csco_component( 'footer_description' ); ?>
					<?php csco_component( 'misc_social_links' ); ?>
				</div>
				<?php if ( csco_component( 'footer_nav_menu', false ) ) { ?>
					<div class="cs-footer__col cs-col-right">
						<?php csco_component( 'footer_nav_menu' ); ?>
					</div>
				<?php } ?>
			</div>
			<?php if ( get_theme_mod( 'footer_copyright', esc_html__( '© 2024 — Revision. All Rights Reserved.', 'revision' ) ) ) { ?>
				<div class="cs-footer__item-inner-bottom">
					<?php csco_component( 'footer_copyright' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</footer>

<?php csco_component( 'scroll_to_top' ); ?>
