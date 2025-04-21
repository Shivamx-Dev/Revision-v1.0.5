<?php
/**
 * ==================================
 * Category Options
 *
 * @package Revision
 * ==================================
 */

/**
 * Add fields to Category
 *
 * @param string $taxonomy The taxonomy slug.
 */
function csco_mb_category_options_add( $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );
	?>
		<div class="form-field">
			<label><?php esc_html_e( 'Category Logo', 'revision' ); ?></label>
			<div class="category-upload-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'revision' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'revision' ); ?>">
				<p class="icon-description">
					<?php esc_html_e( 'The category logo is displayed in its original dimensions on your website. Please upload the 2x version of your icon via the Media Library with @2x suffix for Retina display support. For example, logo@2x.png. Recommended maximum size is 100px (200px for Retina version).', 'revision' ); ?>
				</p>
				<p class="uploaded-img-box">
					<span class="uploaded-image"></span>
					<input id="csco_category_logo" class="uploaded-img-id" name="csco_category_logo" type="hidden"/>
				</p>
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary" href="#"><?php esc_html_e( 'Upload image', 'revision' ); ?></a>
					<a class="delete-img-link button button-secondary hidden" href="#"><?php esc_html_e( 'Remove image', 'revision' ); ?></a>
				</p>
			</div>
		</div><br>
		<hr>
		<div class="form-field">
			<label><?php esc_html_e( 'Icon', 'revision' ); ?></label>
			<div class="category-icon-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'revision' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'revision' ); ?>">
				<p class="icon-description">
					<?php esc_html_e( 'The category icon is displayed in its original dimensions on your website. Please upload the 2x version of your icon via the Media Library with @2x suffix for Retina display support. For example, icon@2x.png. Recommended maximum size is 24px (48px for Retina version).', 'revision' ); ?>
				</p>
				<p class="uploaded-img-box">
					<span class="uploaded-image"></span>
					<input id="csco_category_icon" class="uploaded-img-id" name="csco_category_icon" type="hidden"/>
				</p>
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary" href="#"><?php esc_html_e( 'Upload image', 'revision' ); ?></a>
					<a class="delete-img-link button button-secondary hidden" href="#"><?php esc_html_e( 'Remove image', 'revision' ); ?></a>
				</p>
			</div>
		</div><br><br>
	<?php
}
add_action( 'category_add_form_fields', 'csco_mb_category_options_add', 10 );

/**
 * Edit fields from Category
 *
 * @param object $term     Current taxonomy term object.
 * @param string $taxonomy Current taxonomy slug.
 */
function csco_mb_category_options_edit( $term, $taxonomy ) {
	wp_nonce_field( 'category_options', 'csco_mb_category_options' );

	$csco_category_logo     = get_term_meta( $term->term_id, 'csco_category_logo', true );
	$csco_category_logo_url = wp_get_attachment_image_url( $csco_category_logo, 'thumbnail' );

	$csco_category_icon     = get_term_meta( $term->term_id, 'csco_category_icon', true );
	$csco_category_icon_url = wp_get_attachment_image_url( $csco_category_icon, 'thumbnail' );

	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="csco_category_logo"><?php esc_html_e( 'Category Logo', 'revision' ); ?></label></th>
		<td>
			<div class="category-upload-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'revision' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'revision' ); ?>">
				<p class="icon-description">
					<?php esc_html_e( 'The category logo is displayed in its original dimensions on your website. Please upload the 2x version of your icon via the Media Library with @2x suffix for Retina display support. For example, logo@2x.png. Recommended maximum size is 100px (200px for Retina version).', 'revision' ); ?>
				</p>
				<p class="uploaded-img-box">
					<span class="uploaded-image">
						<?php if ( $csco_category_logo_url ) { ?>
							<img src="<?php echo esc_url( $csco_category_logo_url ); ?>" style="max-width:100%;" />
						<?php } ?>
					</span>
					<input id="csco_category_logo" class="uploaded-img-id" name="csco_category_logo" type="hidden" value="<?php echo esc_attr( $csco_category_logo ); ?>" />
				</p>
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary <?php echo esc_attr( $csco_category_logo_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Upload image', 'revision' ); ?></a>
					<a class="delete-img-link button button-secondary <?php echo esc_attr( ! $csco_category_logo_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Remove image', 'revision' ); ?></a>
				</p>
			</div>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="csco_category_icon"><?php esc_html_e( 'Category Icon', 'revision' ); ?></label></th>
		<td>
			<div class="category-icon-image upload-img-container" data-frame-title="<?php esc_attr_e( 'Select or upload image', 'revision' ); ?>" data-frame-btn-text="<?php esc_attr_e( 'Set image', 'revision' ); ?>">
				<p class="icon-description">
					<?php esc_html_e( 'The category icon is displayed in its original dimensions on your website. Please upload the 2x version of your icon via the Media Library with @2x suffix for Retina display support. For example, icon@2x.png. Recommended maximum size is 24px (48px for Retina version).', 'revision' ); ?>
				</p>
				<p class="uploaded-img-box">
					<span class="uploaded-image">
						<?php if ( $csco_category_icon_url ) { ?>
							<img src="<?php echo esc_url( $csco_category_icon_url ); ?>" style="max-width:100%;" />
						<?php } ?>
					</span>
					<input id="csco_category_icon" class="uploaded-img-id" name="csco_category_icon" type="hidden" value="<?php echo esc_attr( $csco_category_icon ); ?>" />
				</p>
				<p class="hide-if-no-js">
					<a class="upload-img-link button button-primary <?php echo esc_attr( $csco_category_icon_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Upload image', 'revision' ); ?></a>
					<a class="delete-img-link button button-secondary <?php echo esc_attr( ! $csco_category_icon_url ? 'hidden' : '' ); ?>" href="#"><?php esc_html_e( 'Remove image', 'revision' ); ?></a>
				</p>
			</div>
		</td>
	</tr>
	<?php
}
add_action( 'category_edit_form_fields', 'csco_mb_category_options_edit', 10, 2 );

/**
 * Save meta box
 *
 * @param int    $term_id  ID of the term about to be edited.
 * @param string $taxonomy Taxonomy slug of the related term.
 */
function csco_mb_category_options_save( $term_id, $taxonomy ) {

	// Bail if we're doing an auto save.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// if our nonce isn't there, or we can't verify it, bail.
	if ( ! isset( $_POST['csco_mb_category_options'] ) || ! wp_verify_nonce( $_POST['csco_mb_category_options'], 'category_options' ) ) { // Input var ok; sanitization ok.
		return;
	}

	if ( isset( $_POST['csco_category_logo'] ) ) { // Input var ok; sanitization ok.
		$csco_category_logo = sanitize_text_field( $_POST['csco_category_logo'] ); // Input var ok; sanitization ok.
		update_term_meta( $term_id, 'csco_category_logo', $csco_category_logo );
		update_term_meta( $term_id, '_csco_category_logo', wp_get_attachment_image_url( $csco_category_logo, 'full' ) );
	}

	if ( isset( $_POST['csco_category_icon'] ) ) { // Input var ok; sanitization ok.
		$csco_category_icon = sanitize_text_field( $_POST['csco_category_icon'] ); // Input var ok; sanitization ok.
		update_term_meta( $term_id, 'csco_category_icon', $csco_category_icon );
		update_term_meta( $term_id, '_csco_category_icon', wp_get_attachment_image_url( $csco_category_icon, 'full' ) );
	}
}
add_action( 'created_category', 'csco_mb_category_options_save', 10, 2 );
add_action( 'edited_category', 'csco_mb_category_options_save', 10, 2 );

/**
 * Meta box Enqunue Scripts
 *
 * @param string $page Current page.
 */
function csco_mb_category_enqueue_scripts( $page ) {
	$screen = get_current_screen();

	if ( null !== $screen && 'edit-category' !== $screen->id ) {
		return;
	}

	ob_start();
	?>

	<?php
	wp_enqueue_script( 'jquery' );

	// Init Media Control.
	wp_enqueue_media();

	ob_start();
	?>
	<script>
	jQuery( document ).ready(function( $ ) {

		var powerkitMediaFrame;
		/* Set all variables to be used in scope */
		var metaBox = '.category-upload-image, .category-icon-image';

		/* Add Image Link */
		$( metaBox ).find( '.upload-img-link' ).on( 'click', function( event ){
			event.preventDefault();

			var parentContainer = $( this ).parents( metaBox );

			// Options.
			var options = {
				title: parentContainer.data( 'frame-title' ) ? parentContainer.data( 'frame-title' ) : 'Select or Upload Media',
				button: {
					text: parentContainer.data( 'frame-btn-text' ) ? parentContainer.data( 'frame-btn-text' ) : 'Use this media',
				},
				library : { type : 'image' },
				multiple: false // Set to true to allow multiple files to be selected.
			};

			// Create a new media frame
			powerkitMediaFrame = wp.media( options );

			// When an image is selected in the media frame...
			powerkitMediaFrame.on( 'select', function() {

				// Get media attachment details from the frame state.
				var attachment = powerkitMediaFrame.state().get('selection').first().toJSON();

				// Send the attachment URL to our custom image input field.
				parentContainer.find( '.uploaded-image' ).html( '<img src="' + attachment.url + '" style="max-width:25%;"/>' );
				parentContainer.find( '.uploaded-img-id' ).val( attachment.id ).change();
				parentContainer.find( '.upload-img-link' ).addClass( 'hidden' );
				parentContainer.find( '.delete-img-link' ).removeClass( 'hidden' );

				powerkitMediaFrame.close();
			});

			// Finally, open the modal on click.
			powerkitMediaFrame.open();
		});


		/* Delete Image Link */
		$( metaBox ).find( '.delete-img-link' ).on( 'click', function( event ){
			event.preventDefault();

			$( this ).parents( metaBox ).find( '.uploaded-image' ).html( '' );
			$( this ).parents( metaBox ).find( '.upload-img-link' ).removeClass( 'hidden' );
			$( this ).parents( metaBox ).find( '.delete-img-link' ).addClass( 'hidden' );
			$( this ).parents( metaBox ).find( '.uploaded-img-id' ).val( '' ).change();
		});
	});

	jQuery( document ).ajaxSuccess(function(e, request, settings){
		let action   = settings.data.indexOf( 'action=add-tag' );
		let screen   = settings.data.indexOf( 'screen=edit-category' );
		let taxonomy = settings.data.indexOf( 'taxonomy=category' );

		if( action > -1 && screen > -1 && taxonomy > -1 ){
			jQuery( '.delete-img-link' ).click();
		}
	});
	</script>
	<?php
	wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', ob_get_clean() ) );
}
add_action( 'admin_enqueue_scripts', 'csco_mb_category_enqueue_scripts' );


if ( ! function_exists( 'csco_post_categories' ) ) {
	/**
	 * Categories list with icon.
	 */
	function csco_post_categories() {

		$home_show_categories    = get_theme_mod( 'home_show_categories', false );
		$home_categories_heading = get_theme_mod( 'home_categories_heading', esc_html__( 'Explore Trending Topics', 'revision' ) );
		$home_categories_filter  = get_theme_mod( 'home_categories_filter' );
		$home_categories_limit   = get_theme_mod( 'home_categories_limit', 8 );
		$home_categories         = ! empty( $home_categories_filter ) ? explode( ',', $home_categories_filter ) : array();

		$args = array(
			'taxonomy' => 'category',
			'orderby'  => 'count',
			'order'    => 'DESC',
			'number'   => $home_categories_limit,
		);

		if ( ! empty( $home_categories ) ) {
			$args['slug']    = $home_categories;
			$args['orderby'] = 'slug__in';
			$args['order']   = 'ASC';
			$args['number']  = 0;
		}

		$categories = get_categories( $args );

		if ( $home_show_categories && ! empty( $categories ) && is_home() ) {
			?>
			<div class="cs-categories-list cs-categories-list-container">
				<?php if ( $home_categories_heading ) { ?>
					<h2 class="cs-categories-list__heading"><?php echo esc_html( $home_categories_heading ); ?></h2>
				<?php } ?>
				<div class="cs-categories-list__wrapper">
					<?php
					foreach ( $categories as $category ) {
						$csco_category_icon_id = get_term_meta( $category->term_id, 'csco_category_icon', true );
						?>
						<div class="cs-category-item">
							<?php if ( $csco_category_icon_id ) { ?>
								<div class="cs-category-item__icon-box">
									<div class="cs-category-item__icon">
									<?php
									csco_get_retina_image(
										$csco_category_icon_id,
										array(
											'alt'   => esc_attr( $category->name ),
											'title' => esc_attr( $category->name ),
										)
									);
									?>
									</div>
								</div>
							<?php } ?>
							<div class="cs-category-item__title"><a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></div>
							<a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>" class="cs-category-item__link" title="<?php echo esc_attr( $category->name ); ?>"></a>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
