<?php
/**
 * The template part for displaying site section.
 *
 * @package Revision
 */

$header_search_heading           = get_theme_mod( 'header_search_heading', esc_html__( 'What are You Looking For?', 'revision' ) );
$header_search_show_categories   = get_theme_mod( 'header_search_show_categories', true );
$header_search_filter_categories = get_theme_mod( 'header_search_filter_categories' );
$header_search_categories_limit  = get_theme_mod( 'header_search_categories_limit', 8 );
$search_categories               = ! empty( $header_search_filter_categories ) ? explode( ',', $header_search_filter_categories ) : array();

$args = array(
	'taxonomy' => 'category',
	'orderby'  => 'count',
	'order'    => 'DESC',
	'exclude'  => array( 1 ),
	'number'   => $header_search_categories_limit,
);

if ( ! empty( $search_categories ) ) {
	$args['slug']    = $search_categories;
	$args['orderby'] = 'slug__in';
	$args['order']   = 'ASC';
	$args['number']  = 0;
}

$categories = get_categories( $args );

?>

<div class="cs-search-overlay"></div>

<div class="cs-search">
	<div class="cs-search__header">
		<?php if ( $header_search_heading ) { ?>
		<h2><?php echo esc_html( $header_search_heading ); ?></h2>
		<?php } ?>

		<span class="cs-search__close" role="button" aria-label="<?php echo esc_attr__( 'Close search button', 'revision' ); ?>">
			<i class="cs-icon cs-icon-x"></i>
		</span>
	</div>

	<div class="cs-search__form-container">
		<?php get_template_part( 'searchform' ); ?>
	</div>

	<?php if ( $categories && $header_search_show_categories ) { ?>
		<div class="cs-search__content">
			<div class="cs-entry__post-meta">
				<div class="cs-meta-category">
					<ul class="post-categories">
						<?php foreach ( $categories as $category ) { ?>
							<li>
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" rel="category tag">
									<?php echo esc_html( $category->name ); ?>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
