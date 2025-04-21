<?php
/**
 * The template for displaying the header layout
 *
 * @package Revision
 */

?>

<div class="cs-header-before"></div>

<header class="cs-header cs-header-stretch">
	<div class="cs-container">
		<div class="cs-header__inner cs-header__inner-desktop">
			<div class="cs-header__col cs-col-left">
				<?php csco_component( 'header_offcanvas_toggle' ); ?>
				<?php csco_component( 'header_logo' ); ?>
			</div>

			<?php if ( get_theme_mod( 'header_navigation_menu', true ) ) { ?>
				<div class="cs-header__col cs-col-center">
					<?php csco_component( 'header_nav_menu' ); ?>
				</div>
			<?php } ?>

			<?php
			if (
				get_theme_mod( 'header_search_button', true ) ||
				get_theme_mod( 'color_scheme_toggle', true ) ||
				get_theme_mod( 'header_custom_button', false )
			) {
				?>
				<div class="cs-header__col cs-col-right">
					<?php
					csco_component( 'header_search_toggle' );
					csco_component( 'header_scheme_toggle' );
					csco_component( 'header_custom_button' );
					?>
				</div>
			<?php } ?>
		</div>

		<?php csco_site_nav_mobile(); ?>
		<?php csco_site_search(); ?>
	</div>
</header>
