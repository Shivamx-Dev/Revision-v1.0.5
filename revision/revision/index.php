<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revision
 */

get_header(); ?>

<div id="primary" class="cs-content-area">

	<?php
	/**
	 * The csco_main_before hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_before' );
	?>

	<?php
	if ( have_posts() ) {
		// Set options.
		$options = csco_get_archive_options();

		$grid_columns_desktop = $options['columns'];

		$columns_desktop = 'cs-desktop-column-' . $grid_columns_desktop;

		// Location.
		$main_classes = ' cs-posts-area__' . $options['location'];

		// Layout.
		$main_classes .= ' cs-posts-area__' . $options['layout'];

		?>

		<div class="cs-posts-area cs-posts-area-posts">
			<div class="cs-posts-area__outer">

				<div class="cs-posts-area__main cs-archive-<?php echo esc_attr( $options['layout'] ); ?> <?php echo esc_attr( $main_classes ); ?> <?php echo ( 'list' === $options['layout'] || 'grid' === $options['layout'] ) ? esc_attr( $columns_desktop ) : ''; ?>">
					<?php
					// Start the Loop.
					while ( have_posts() ) {
						the_post();

						set_query_var( 'options', $options );

						if ( isset( $options['layout'] ) && 'full' === $options['layout'] ) {
							get_template_part( 'template-parts/archive/content-full' );
						} elseif ( 'overlay' === $options['layout'] ) {
							get_template_part( 'template-parts/archive/entry-overlay' );
						} else {
							get_template_part( 'template-parts/archive/entry' );
						}
					}
					?>
				</div>
			</div>

			<?php
			/* Posts Pagination */
			if ( 'standard' === get_theme_mod( csco_get_archive_option( 'pagination_type' ), 'standard' ) ) {
				?>
				<div class="cs-posts-area__pagination">
					<?php
						the_posts_pagination(
							array(
								'prev_text' => __( 'Previous', 'revision' ),
								'next_text' => __( 'Next', 'revision' ),
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} elseif ( ! get_query_var( 'csco_have_search' ) ) {
		?>
		<div class="entry-content cs-content-not-found">

			<?php if ( is_search() ) { ?>
				<div class="cs-content-not-found-content">
					<?php esc_html_e( 'It seems we cannot find what you are looking for. Please check the spelling or rephrase.', 'revision' ); ?>
				</div>
			<?php } elseif ( is_404() ) { ?>
				<div class="cs-content-not-found-content">
					<?php esc_html_e( 'Unfortunately the page you are looking for is not available.', 'revision' ); ?>
				</div>
				<a class="cs-button" href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Back to Home', 'revision' ); ?></a>
			<?php } ?>

		</div>
		<?php
	}
	?>

	<?php
	/**
	 * The csco_main_after hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_main_after' );
	?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
