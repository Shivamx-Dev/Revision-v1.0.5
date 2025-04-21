<?php
/**
 * The template for displaying the hero 2 layout
 *
 * @package Revision
 */

$args               = csco_get_hero_query_args();
$hero_post_meta     = get_theme_mod( 'home_hero_meta', array( 'category', 'author', 'date', 'reading_time' ) );
$hero_discover_more = get_theme_mod( 'home_hero_discover_more', true );

$parallax       = 'yes' === get_theme_mod( 'home_hero_slider_parallax', 'yes' ) ? true : false;
$autoplay       = 'yes' === get_theme_mod( 'home_hero_slider_autoplay', 'yes' ) ? true : false;
$autoplay_delay = 5000;

if ( $autoplay ) {
	$autoplay_delay = get_theme_mod( 'home_hero_slider_delay', 5000 );
}

$counter   = 0;
$hero_type = get_theme_mod( 'home_hero_layout', 'hero-type-2' );
$gap       = 32;

?>

<section class="cs-home-hero cs-hero-type-2">
	<div
		class="cs-hero-type-2__slider"
		data-cs-autoplay="<?php echo esc_attr( $autoplay ); ?>"
		data-cs-autoplay-delay="<?php echo esc_attr( $autoplay_delay ); ?>"
		data-cs-parallax="<?php echo esc_attr( $parallax ); ?>"
		data-cs-gap="<?php echo esc_attr( $gap ); ?>"
	>
		<div class="cs-hero-type-2__wrapper" data-scheme="inverse">

			<?php
			$query = new \WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					++$counter;
					?>

					<article class="cs-hero-type-2__item cs-entry">

						<div class="cs-entry__outer cs-entry__overlay cs-overlay-ratio cs-ratio-landscape-16-9">
							<div class="cs-entry__inner cs-entry__thumbnail">
								<div class="cs-overlay-background">
									<?php the_post_thumbnail( 'csco-large-uncropped' ); ?>
								</div>
							</div>

							<div class="cs-entry__inner cs-entry__content cs-overlay-content" data-swiper-parallax-x="-400" data-swiper-parallax-duration="800" >

								<div class="cs-entry__content-top">
									<div class="cs-overlay-post-meta cs-meta-overlay-transparent">
										<?php csco_get_post_meta( array( 'category', 'reading_time' ), true, $hero_post_meta ); ?>
									</div>
								</div>

								<div class="cs-entry__content-body">
									<?php csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $hero_post_meta ); ?>

									<h2 class="cs-entry__title">
										<?php echo esc_html( get_the_title() ); ?>
									</h2>

									<?php
									$excerpt = csco_get_the_excerpt( 150 );
									if ( $excerpt ) {
										?>
										<div class="cs-entry__subtitle">
											<?php echo esc_html( $excerpt ); ?>
										</div>
									<?php } ?>

									<?php if ( $hero_discover_more ) { ?>
										<?php csco_component( 'discover_more_button' ); ?>
									<?php } ?>
								</div>

							</div>

							<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
						</div>

					</article>

					<?php
				}
				wp_reset_postdata();
			}
			?>
		</div>

		<?php if ( $counter > 1 ) { ?>
			<?php if ( $counter <= 5 ) { ?>
				<div class="cs-hero-type-2__pagination" data-scheme="inverse"></div>
			<?php } ?>
			<div class="cs-hero-type-2__button-prev"></div>
			<div class="cs-hero-type-2__button-next"></div>
		<?php } ?>
	</div>
</section>
