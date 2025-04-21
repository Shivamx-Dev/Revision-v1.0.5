<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "cs-site" div.
 *
 * @package Revision
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php csco_site_scheme(); ?>>

<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<?php
/**
 * The csco_site_before hook.
 *
 * @since 1.0.0
 */
do_action( 'csco_site_before' );
?>

<div id="page" class="cs-site">

	<?php
	/**
	 * The csco_site_start hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_site_start' );
	?>

	<div class="cs-site-inner">

		<?php
		/**
		 * The csco_header_before hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_header_before' );
		?>

		<?php get_template_part( 'template-parts/header' ); ?>

		<?php
		/**
		 * The csco_header_after hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_header_after' );
		?>

		<main id="main" class="cs-site-primary">

			<?php
			/**
			 * The csco_site_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_site_content_before' );
			?>

			<div <?php csco_site_content_class(); ?>>

				<?php
				/**
				 * The csco_site_content_start hook.
				 *
				 * @since 1.0.0
				 */
				do_action( 'csco_site_content_start' );
				?>

				<div class="cs-container">

					<?php
					/**
					 * The csco_main_content_before hook.
					 *
					 * @since 1.0.0
					 */
					do_action( 'csco_main_content_before' );
					?>

					<div id="content" class="cs-main-content">

						<?php
						/**
						 * The csco_main_content_start hook.
						 *
						 * @since 1.0.0
						 */
						do_action( 'csco_main_content_start' );
						?>
