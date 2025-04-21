<?php
/**
 * The template for displaying the hero 3 layout
 *
 * @package Revision
 */

$args           = csco_get_hero_query_args();
$hero_post_meta = get_theme_mod( 'home_hero_meta', array( 'category', 'author', 'date', 'reading_time' ) );
$counter        = 0;

?>

<section class="cs-home-hero cs-hero-type-3">
	<div class="cs-container">
		<div class="cs-hero-type-3__container" >
			<?php
			$query_test = new \WP_Query( $args );

			if ( $query_test->have_posts() ) {
				while ( $query_test->have_posts() ) {
					$query_test->the_post();
					++$counter;

					if ( 1 === $counter ) {
						$featured_excerpt = csco_get_the_excerpt( 160 );
						?>
						<article class="cs-entry cs-entry__featured" >
							<div class="cs-entry__outer ">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="cs-entry__inner cs-entry__thumbnail cs-entry__overlay cs-overlay-ratio cs-ratio-landscape-16-9" data-scheme="inverse">
										<div class="cs-overlay-post-meta cs-meta-overlay-transparent">
											<?php csco_get_post_meta( array( 'category', 'reading_time' ), true, $hero_post_meta ); ?>
										</div>
										<div class="cs-overlay-background cs-overlay-transparent">
											<?php the_post_thumbnail( 'csco-large-uncropped' ); ?>
											<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
										</div>
									</div>
								<?php } ?>

								<div class="cs-entry__inner cs-entry__content">

									<?php csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $hero_post_meta ); ?>

									<h2 class="cs-entry__title">
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<?php echo esc_html( get_the_title() ); ?>
										</a>
									</h2>

									<?php if ( $featured_excerpt ) { ?>
										<div class="cs-entry__subtitle">
											<span><?php echo esc_html( $featured_excerpt ); ?></span>
										</div>
									<?php } ?>

								</div>

							</div>
						</article>
						<?php
					} else {
						$excerpt = csco_get_the_excerpt();
						?>
						<article class="cs-entry cs-entry__list">
							<div class="cs-entry__outer">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="cs-entry__inner cs-entry__thumbnail cs-entry__overlay cs-overlay-ratio" data-scheme="inverse">
										<div class="cs-overlay-post-meta">
											<?php csco_get_post_meta( array( 'reading_time' ), true, $hero_post_meta ); ?>
										</div>
										<div class="cs-overlay-background cs-overlay-transparent">
											<?php the_post_thumbnail( 'csco-thumbnail' ); ?>
										</div>
										<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
									</div>
								<?php } ?>

								<div class="cs-entry__inner cs-entry__content">

									<?php csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $hero_post_meta ); ?>

									<h2 class="cs-entry__title">
										<a href="<?php echo esc_url( get_permalink() ); ?>">
											<?php echo esc_html( get_the_title() ); ?>
										</a>
									</h2>

									<?php if ( $excerpt ) { ?>
										<div class="cs-entry__excerpt">
											<?php echo esc_html( $excerpt ); ?>
										</div>
									<?php } ?>

									<?php csco_get_post_meta( array( 'category' ), true, $hero_post_meta ); ?>

								</div>
							</div>
						</article>
						<?php
					}
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
