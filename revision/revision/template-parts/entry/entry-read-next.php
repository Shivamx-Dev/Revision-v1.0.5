<?php
/**
 * The template part for displaying post read next section.
 *
 * @package Revision
 */

$options = array(
	'image_orientation' => get_theme_mod( 'post_read_next_image_orientation', 'landscape-16-9' ),
	'image_size'        => get_theme_mod( 'post_read_next_image_size', 'csco-thumbnail' ),
);

$read_next_posts     = get_theme_mod( 'post_read_next_posts', 'after' );
$read_next_post_meta = get_theme_mod( 'post_read_next_meta', array( 'category', 'author', 'date' ) );
$read_next_class     = 'cs-read-next__grid';
$limit               = 3;


$read_next_post_ids = csco_get_read_next_post_ids( $limit, $read_next_posts );

if ( ! empty( $read_next_post_ids ) ) {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'post__in'       => $read_next_post_ids,
		'orderby'        => 'post__in',
	);

	$next_posts_query = new WP_Query( $args );

	if ( $next_posts_query->have_posts() ) {
		?>
		<div class="cs-read-next">
			<div class="cs-container">
				<div class="cs-read-next__heading">
					<h2>
						<?php esc_html_e( 'Read Next', 'revision' ); ?>
					</h2>
				</div>
				<div class="cs-posts-area__read-next <?php echo esc_attr( $read_next_class ); ?>">
					<?php
					while ( $next_posts_query->have_posts() ) {
						$next_posts_query->the_post();
						?>

						<article class="cs-entry">
							<div class="cs-entry__outer">
								<?php
								if ( has_post_thumbnail() ) {
									?>
									<div class="cs-entry__inner cs-entry__thumbnail cs-entry__overlay cs-overlay-ratio cs-ratio-<?php echo esc_attr( $options['image_orientation'] ); ?>" data-scheme="inverse">

										<div class="cs-overlay-post-meta cs-meta-overlay-background"><?php csco_get_post_meta( array( 'category', 'reading_time' ), true, $read_next_post_meta ); ?></div>

										<div class="cs-overlay-background cs-overlay-transparent">
											<?php the_post_thumbnail( $options['image_size'] ); ?>
										</div>

										<?php csco_the_post_format_icon(); ?>

										<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title() ); ?>"></a>
									</div>
								<?php } ?>

								<div class="cs-entry__inner cs-entry__content">
									<?php csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $read_next_post_meta ); ?>

									<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '"><span>', '</span></a></h2>' ); ?>

									<?php
									if ( get_theme_mod( 'read_next_excerpt', true ) ) {
										$excerpt = csco_get_the_excerpt( 150 );
										if ( $excerpt ) {
											?>
											<div class="cs-entry__excerpt">
												<?php echo esc_html( $excerpt ); ?>
											</div>
											<?php
										}
									}
									?>

									<?php if ( get_theme_mod( 'read_next_discover_more', false ) ) { ?>
										<?php csco_discover_more_button(); ?>
									<?php } ?>
								</div>
							</div>
						</article>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}
	wp_reset_postdata();

}
