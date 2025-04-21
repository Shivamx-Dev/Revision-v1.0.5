<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revision
 */

$options = get_query_var( 'options' );

// Set post class.
$post_class = __return_empty_string();

?>

<?php if ( 'list' === $options['layout'] || 'grid' === $options['layout'] ) { ?>
	<article <?php post_class( $post_class ); ?>>
		<div class="cs-entry__outer">
			<?php
			if ( has_post_thumbnail() ) {
				?>
				<div class="cs-entry__inner cs-entry__thumbnail cs-entry__overlay cs-overlay-ratio cs-ratio-<?php echo esc_attr( $options['image_orientation'] ); ?>" data-scheme="inverse">

					<div class="cs-overlay-post-meta cs-meta-overlay-background"><?php csco_get_post_meta( array( 'category', 'reading_time' ), true, $options['meta'] ); ?></div>

					<div class="cs-overlay-background cs-overlay-transparent">
						<?php the_post_thumbnail( $options['image_size'] ); ?>
					</div>

					<?php csco_the_post_format_icon(); ?>

					<a class="cs-overlay-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title() ); ?>"></a>
				</div>
			<?php } ?>

			<div class="cs-entry__inner cs-entry__content">
				<?php csco_get_post_meta( array( 'author', 'date', 'comments', 'views' ), true, $options['meta'] ); ?>

				<?php the_title( '<h2 class="cs-entry__title"><a href="' . esc_url( get_permalink() ) . '"><span>', '</span></a></h2>' ); ?>

				<?php
				if ( $options['excerpt'] ) {
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

				<?php if ( $options['discover_more'] ) { ?>
					<?php csco_discover_more_button(); ?>
				<?php } ?>
			</div>
		</div>
	</article>
<?php } ?>
