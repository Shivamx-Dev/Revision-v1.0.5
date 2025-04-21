<?php
/**
 * Template part for displaying full posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revision
 */

$options = get_query_var( 'options' );

// Thumbnail size.
$thumbnail_size = 'csco-large';

if ( 'uncropped' === csco_get_page_preview() ) {
	$thumbnail_size = sprintf( '%s-uncropped', $thumbnail_size );
}
?>

<article <?php post_class(); ?>>
	<div class="cs-entry__full-header">
		<div class="cs-entry__container">
			<?php if ( has_post_thumbnail() ) { ?>
				<figure class="cs-entry__inner cs-entry__thumbnail " data-scheme="inverse">
					<div class="cs-overlay-post-meta cs-meta-overlay-background"><?php csco_get_post_meta( array( 'category', 'reading_time' ), true, $options['meta'] ); ?></div>
					<div class="cs-overlay-transparent">
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</div>
					<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"></a>
				</figure>
			<?php } ?>
		</div>
	</div>

	<div class="cs-entry__wrap">
		<div class="cs-entry__container">
			<div class="cs-entry__content-wrap">
				<?php
				csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $options['meta'] );
				the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '"><span>', '</span></a></h2>' );
				?>
				<div class="cs-entry-type-<?php echo esc_attr( $options['summary_type'] ); ?> ">
					<?php
					if ( 'summary' === $options['summary_type'] ) {
						the_excerpt();
					} else {
						$more_link_text = sprintf(
							/* translators: %s: Name of current post */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'revision' ),
							get_the_title()
						);

						the_content( $more_link_text );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</article>
