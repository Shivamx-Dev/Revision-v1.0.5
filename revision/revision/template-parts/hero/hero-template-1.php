<?php
/**
 * The template for displaying the hero 1 layout
 *
 * @package Revision
 */

$home_hero_heading    = get_theme_mod( 'home_hero_heading' );
$home_hero_subheading = get_theme_mod( 'home_hero_subheading' );
$allowed_html         = array(
	'span' => array(),
);

?>

<?php if ( ! empty( $home_hero_heading ) || ! empty( $home_hero_subheading ) ) { ?>
	<section class="cs-home-hero cs-hero-type-1">
		<div class="cs-hero-type-1__wrapper">
			<div class="cs-hero__content">
				<?php if ( ! empty( $home_hero_heading ) ) { ?>
					<h1 class="cs-hero__heading"><?php echo wp_kses( $home_hero_heading, $allowed_html ); ?></h1>
				<?php } ?>
				<?php if ( ! empty( $home_hero_subheading ) ) { ?>
					<div class="cs-hero__subheading">
						<?php echo esc_html( $home_hero_subheading ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>
