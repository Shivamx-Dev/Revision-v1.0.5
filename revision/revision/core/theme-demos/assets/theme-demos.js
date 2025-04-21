
( function( $ ) {
	"use strict";

	/** ----------------------------------------------------------------------------
	 * Theme Demos */

	var cscoThemeDemos = {};

	( function() {
		var $this;

		cscoThemeDemos = {

			/** Initialize */
			init: function( e ) {

				$this = cscoThemeDemos;

				// Init events.
				$this.events( e );
			},

			/** Events */
			events: function( e ) {
				$( document ).on( 'click', '.cs-demo-import-open', function( e ) {
					$this.openImportDemo( e, this );
				});
				$( document ).on( 'click', '.cs-demo-import-close, .cs-import-overlay', function( e ) {
					$this.closeImportDemo( e, this );
				});
				$( document ).on( 'click', '.cs-demo-import-start', function( e ) {
					$this.startImportDemo( e, this );
				});
				$( document ).on( 'click', '.cs-demo-item', function( e ) {
					$this.openPreviewDemo( e, this );
				});
				$( document ).on( 'click', '.cs-prev-demo', function( e ) {
					$this.openPreviewPrevDemo( e, this );
				});
				$( document ).on( 'click', '.cs-next-demo', function( e ) {
					$this.openPreviewNextDemo( e, this );
				});
				$( document ).on( 'click', '.cs-preview-cancel a', function( e ) {
					$this.closePreviewDemo( e, this );
				});
			},

			/** Open import demo */
			openImportDemo: function( e, object ) {

				// Get demo id.
				var $demo_id = $( object ).data( 'id' );

				// Body import.
				$( 'body' ).addClass( 'cs-import-theme-active' );

				// Variables.
				var data = {
					'action': 'csco_html_import_data',
					'nonce': cscoThemeDemosConfig.nonce,
					'demo_id': $demo_id,
				};

				// Reset current step.
				$( '.cs-import-step' ).removeClass( 'cs-import-step-active' );
				$( '.cs-import-step' ).first().addClass( 'cs-import-step-active' );

				// Remove warning.
				$( '.cs-import-theme .cs-msg-warning' ).remove();

				// Reset variables.
				$( '.cs-import-start .cs-import-output' ).html( '' );

				$( '.cs-import-start .cs-import-output' ).addClass( 'cs-import-load' );

				$( '.cs-import-process .cs-import-progress-label' ).html( '' );

				$( '.cs-import-process .cs-import-progress-indicator' ).attr( 'style', '--cs-indicator: 0%;' );

				$( '.cs-import-process .cs-import-progress-sublabel' ).html( '0%' );

				// Send Request.
				$.post( cscoThemeDemosConfig.ajax_url, data, function( response ) {

					$( '.cs-import-start .cs-import-output' ).removeClass( 'cs-import-load' );

					if ( response.success ) {

						$( '.cs-import-start .cs-import-output' ).html( response.data );

					} else if ( response.data ) {

						$( '.cs-import-start .cs-import-output' ).html( `<div class="cs-msg-warning">${response.data}</div>` );
					} else {

						$( '.cs-import-start .cs-import-output' ).html( `<div class="cs-msg-warning">${cscoThemeDemosConfig.failed_message}</div>` );
					}

				} ).fail( function( xhr, textStatus, e ) {

					$( '.cs-import-start .cs-import-output' ).removeClass( 'cs-import-load' );

					$( '.cs-import-start .cs-import-output' ).html( `<div class="cs-msg-warning">${cscoThemeDemosConfig.failed_message}</div>` );
				} );

				e.preventDefault();
			},

			/** Close import demo */
			closeImportDemo: function( e, object ) {

				// Remove import from body.
				$( 'body' ).removeClass( 'cs-import-theme-active' );

				e.preventDefault();
			},

			/** Start import demo */
			startImportDemo: function( e, object ) {
				// Change process.
				$( '.cs-import-step' ).removeClass( 'cs-import-step-active' );
				$( '.cs-import-process' ).addClass( 'cs-import-step-active' );

				// Run Import.
				setTimeout( function() {
					$this.importContent( e, object );
				}, 10 );

				e.preventDefault();
			},

			/** Open preview demo */
			openPreviewDemo: function( e, object ) {
				if ( ! $( e.target ).is( '.cs-demo-import-open, .cs-demo-import-url' ) ) {
					$this.openPreview( e, object );

					e.preventDefault();
				}
			},

			/** Open preview prev demo */
			openPreviewPrevDemo: function( e, object ) {

				var prev = $( '.cs-demo-item-open' ).prev( '.cs-demo-item-active' );

				if ( prev.length > 0 ) {
					$this.openPreview( e, prev );
				}

				e.preventDefault();
			},

			/** Open preview next demo */
			openPreviewNextDemo: function( e, object ) {
				var next = $( '.cs-demo-item-open' ).next( '.cs-demo-item-active' );

				if ( next.length > 0 ) {
					$this.openPreview( e, next );
				}

				e.preventDefault();
			},

			/** Close preview */
			closePreviewDemo: function( e, object ) {
				// Remove current class from items.
				$( '.cs-demo-item' ).removeClass( 'cs-demo-item-open' );

				// Remove preview from body.
				$( 'body' ).removeClass( 'cs-preview-active' );

				// Remove url from iframe.
				$( '.cs-preview .cs-preview-iframe' ).removeAttr( 'src' );

				e.preventDefault();
			},

			/** Import indicator */
			importIndicator: function( e, object, $data ) {
				// Set indicator.
				var indicator = Math.round( 100 / $data.steps * $data.index );

				// Change indicator.
				$( '.cs-import-process .cs-import-progress-indicator' ).attr( 'style', `--cs-indicator: ${indicator}%;` );
				$( '.cs-import-process .cs-import-progress-sublabel' ).html( `${indicator}%` );
			},

			/** Import step */
			importStep: function( e, object, $data ) {

				if ( ! $( 'body' ).hasClass( 'cs-import-theme-active' ) ) {
					return;
				}

				// Done.
				if ( $data.index >= $data.steps ) {
					// Change step.
					setTimeout(function(){
						$( '.cs-import-step' ).removeClass( 'cs-import-step-active' );
						$( '.cs-import-finish' ).addClass( 'cs-import-step-active' );

						$( document ).trigger( 'DOMImportFinish' );
					}, 200 );

					return;
				}

				var currentAction  = $( $data.forms ).eq( $data.index ).find( 'input[name="action"]').val();

				// Set progress label.
				$( '.cs-import-progress-label' ).html( $( $data.forms ).eq( $data.index ).find( 'input[name="step_name"]').val()  );

				// Send Request.
				$.post( {
					url: cscoThemeDemosConfig.ajax_url,
					type: 'POST',
					data: $( $data.forms ).eq( $data.index ).serialize(),
					timeout: 0,
				} ).done( function( response ) {

					if ( response.success || 'elementor_recreate_kit' === currentAction ) {

						if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {

							$this.importStep( e, object, $data );

						} else {
							$data.index = $data.index + 1;

							$this.importIndicator( e, object, $data );
							$this.importStep( e, object, $data );
						}

					} else if ( response.data ) {

						$( '.cs-import-progress' ).after( `<div class="cs-msg-warning">${response.data}</div>` );
					} else {

						$( '.cs-import-progress' ).after( `<div class="cs-msg-warning">${cscoThemeDemosConfig.failed_message}</div>` );
					}

				} ).fail( function( xhr, textStatus, e ) {

					// Pre import.
					if ( 'elementor_recreate_kit' === currentAction ) {
						$data.index = $data.index + 1;

						$this.importIndicator( e, object, $data );
						$this.importStep( e, object, $data );
					} else {
						$( '.cs-import-progress' ).after( `<div class="cs-msg-warning">${cscoThemeDemosConfig.failed_message}</div>` );
					}

				} );
			},

			/** Import content */
			importContent: function( e, object ) {
				var forms = $( '.cs-import-start form' ).filter(function( index, element ){
					if ( $( element ).find( '.cs-checkbox' ).prop( 'checked' ) ) {
						return true;
					} else {
						return false;
					}
				});

				var steps = forms.length;

				if ( steps <= 0 ) {
					return
				}

				$this.importStep( e, object, {
					'forms': forms,
					'steps': steps,
					'index': 0
				} );
			},

			/** Open preview */
			openPreview: function( e, object ) {
				let demo_id = $( object ).data( 'id' );
				let preview = $( object ).data( 'preview' );
				let name = $( object ).data( 'name' );
				let type = $( object ).data( 'type' );

				if ( 'false' === preview ) {
					return;
				}

				// Remove current class from siblings items.
				$( object ).siblings().removeClass( 'cs-demo-item-open' );

				// Current item.
				$( object ).addClass( 'cs-demo-item-open' );

				// Set demo id.
				$( '.cs-preview .cs-demo-import-open' ).attr( 'data-id', demo_id );

				// Prev Next Buttons.
				$( '.cs-preview' ).find( '.cs-prev-demo, .cs-next-demo' ).removeClass( 'cs-inactive' );

				let prev = $( object ).prev( '.cs-demo-item-active' );
				if ( prev.length <= 0 ) {
					$( '.cs-preview .cs-prev-demo' ).addClass( 'cs-inactive' );
				}

				let next = $( object ).next( '.cs-demo-item-active' );
				if ( next.length <= 0 ) {
					$( '.cs-preview .cs-next-demo' ).addClass( 'cs-inactive' );
				}

				// Reset header info.
				$( '.cs-preview .cs-header-info' ).html( '' );

				// Add name to info.
				if ( name ) {
					$( '.cs-preview .cs-header-info' ).prepend( `<div class="cs-demo-name">${name}</div>` );
				}

				$( '.cs-preview .cs-preview-actions' ).html( $( object ).find( '.cs-demo-actions' ).html() );

				// Set url in iframe.
				$( '.cs-preview .cs-preview-iframe' ).attr( 'src', preview );

				// Body preview.
				$( 'body' ).addClass( 'cs-preview-active' );
			},
		};

	} )();

	// Initialize.
	cscoThemeDemos.init();

} )( jQuery );
