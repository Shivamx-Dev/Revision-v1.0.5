<?php
/**
 * The template part for displaying post prev next section.
 *
 * @package Revision
 */

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( $prev_post || $next_post ) {
	?>

	<div class="cs-entry-prev-next">
		<?php
		// Prev post.
		if ( $prev_post ) {
			$query = new WP_Query(
				array(
					'posts_per_page' => 1,
					'p'              => $prev_post->ID,
				)
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
					<div class="cs-entry-prev-next__item cs-entry__prev">
						<a class="cs-entry-prev-next__link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>"></a>

						<div class="cs-entry-prev-next__label">
							<span class="cs-entry-prev-next__icon cs-prev-icon"><i class="cs-icon cs-icon-chevron-left"></i></span>
							<span><?php echo esc_html__( 'Previous Article', 'revision' ); ?></span>
						</div>

						<div class="cs-entry">
							<div class="cs-entry__outer">
								<div class="cs-entry__inner cs-entry__content">
									<h2 class="cs-entry__title"><?php echo esc_html( $prev_post->post_title ); ?></h2>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			wp_reset_postdata();
		}

		// Next post.
		if ( $next_post ) {
			$query = new WP_Query(
				array(
					'posts_per_page' => 1,
					'p'              => $next_post->ID,
				)
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
					<div class="cs-entry-prev-next__item cs-entry__next">
						<a class="cs-entry-prev-next__link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>"></a>

						<div class="cs-entry-prev-next__label">
							<span><?php echo esc_html__( 'Next Article', 'revision' ); ?></span>
							<span class="cs-entry-prev-next__icon cs-next-icon"><i class="cs-icon cs-icon-chevron-right"></i></span>
						</div>

						<div class="cs-entry">
							<div class="cs-entry__outer">
								<div class="cs-entry__inner cs-entry__content ">
									<h2 class="cs-entry__title"><?php echo esc_html( $next_post->post_title ); ?></h2>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			wp_reset_postdata();
		}
		?>
	</div>
	<?php
}
