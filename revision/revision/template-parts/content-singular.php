<?php
/**
 * Template part singular content
 *
 * @package Revision
 */

?>

<div class="cs-entry__wrap">

	<?php
	/**
	 * The csco_entry_wrap_start hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_entry_wrap_start' );
	?>

	<div class="cs-entry__container">

		<?php
		/**
		 * The csco_entry_container_start hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_entry_container_start' );
		?>

		<div class="cs-entry__content-wrap">
			<?php
			/**
			 * The csco_entry_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_entry_content_before' );
			?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<?php
			/**
			 * The csco_entry_content_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_entry_content_after' );
			?>
		</div>

		<?php
		/**
		 * The csco_entry_container_end hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_entry_container_end' );
		?>

	</div>

	<?php
	/**
	 * The csco_entry_wrap_end hook.
	 *
	 * @since 1.0.0
	 */
	do_action( 'csco_entry_wrap_end' );
	?>
</div>
