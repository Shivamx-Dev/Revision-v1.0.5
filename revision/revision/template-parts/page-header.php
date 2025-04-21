<?php
/**
 * The template part for displaying page header.
 *
 * @package Revision
 */

// Init clasfor header.
$class = null;

// If description exists.
if ( get_the_archive_description() ) {
	$class = 'cs-page__header-has-description';
}
?>

<?php
do_action( 'csco_page_header_before' );

if ( is_author() ) {

	$subtitle  = esc_html__( 'All Posts By', 'revision' );
	$author_id = get_queried_object_id();
	$position  = get_user_meta( $author_id, 'csco_position', true );
	$location  = get_user_meta( $author_id, 'csco_location', true );
	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<div class="cs-page__author">
			<div class="cs-page__author-container">
				<div class="cs-page__author-photo">
					<div class="cs-page__author-thumbnail">
						<?php echo get_avatar( $author_id, 130 ); ?>
					</div>
				</div>
				<div class="cs-page__author-info">
					<?php the_archive_title( '<h1 class="cs-page__title">', '</h1>' ); ?>
					<?php if ( $position && ! empty( $position ) ) { ?>
						<div class="cs-page__author-position"><?php echo esc_html( $position ); ?></div>
					<?php } ?>
					<?php csco_user_social_links(); ?>
				</div>
			</div>
			<?php csco_archive_post_description(); ?>
			<?php if ( $location && ! empty( $location ) ) { ?>
				<div class="cs-page__author-location"><i class="cs-icon cs-icon-location-fill"></i> <?php echo esc_attr( $location ); ?></div>
			<?php } ?>
		</div>
	</div>
	<?php

} elseif ( is_archive() ) {

	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<?php
		csco_archive_category_thumbnail();
		the_archive_title( '<h1 class="cs-page__title">', '</h1>' );
		csco_archive_post_description();
		?>
	</div>
	<?php

} elseif ( is_search() ) {

	?>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<h1 class="cs-page__title"><span><?php esc_html_e( 'Search Results:', 'revision' ); ?> <?php echo get_search_query(); ?></span></h1>
		<?php
		get_template_part( 'searchform' );
		?>
	</div>
	<?php

} elseif ( is_404() ) {
	?>
	<div class="cs-page-404__icon">
		<i class="cs-icon cs-icon-not-found"></i>
	</div>
	<div class="cs-page__header <?php echo esc_attr( $class ); ?>">
		<h1 class="cs-page__title"><?php esc_html_e( 'Page Not Found', 'revision' ); ?></h1>
	</div>
	<?php
}

do_action( 'csco_page_header_after' );
?>
