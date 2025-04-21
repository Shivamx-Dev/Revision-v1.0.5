<?php
/**
 * The template for displaying all single posts and attachments.
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
	while ( have_posts() ) :
		the_post();
		?>

		<?php
		/**
		 * The csco_post_before hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_post_before' );
		?>

			<?php get_template_part( 'template-parts/content-singular' ); ?>

		<?php
		/**
		 * The csco_post_after hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_post_after' );
		?>

	<?php endwhile; ?>

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
