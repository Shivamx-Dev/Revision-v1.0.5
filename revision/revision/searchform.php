<?php
/**
 * The template for displaying search form.
 *
 * @package Revision
 */

?>

<form role="search" method="get" class="cs-search__form cs-form-box" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="cs-search__group cs-form-group">
		<input required class="cs-search__input" type="search" value="<?php the_search_query(); ?>" name="s" placeholder="<?php echo esc_attr__( 'Start Typing', 'revision' ); ?>" role="searchbox">

		<button class="cs-search__submit" aria-label="Search" type="submit">
			<?php echo esc_html__( 'Search', 'revision' ); ?>
		</button>
	</div>
</form>
