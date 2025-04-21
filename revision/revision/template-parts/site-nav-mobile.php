<?php
/**
 * The template for displaying the header mobile
 *
 * @package Revision
 */

?>

<div class="cs-header__inner cs-header__inner-mobile">
	<div class="cs-header__col cs-col-left">
		<?php csco_component( 'header_offcanvas_toggle', true, array( 'mobile' => true ) ); ?>
	</div>
	<div class="cs-header__col cs-col-center">
		<?php csco_component( 'header_logo', true, array( 'tag' => 'div' ) ); ?>
	</div>
	<?php if ( get_theme_mod( 'header_search_button', true ) ) { ?>
		<div class="cs-header__col cs-col-right">
			<?php csco_component( 'header_search_toggle' ); ?>
		</div>
	<?php } ?>
</div>
