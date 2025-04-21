( function( $ ) {
	"use strict";

	/** ----------------------------------------------------------------------------
	 * Theme Dashboard */

	var cscoThemeDashboard = {};

	( function() {
		var $this;

		cscoThemeDashboard = {

			/** Initialize */
			init: function( e ) {

				$this = cscoThemeDashboard;

				// Init events.
				$this.events( e );
			},

			/** Events */
			events: function( e ) {

				$( document ).on( 'click', '.cs-panel-tabs .cs-panel-tab a', function( e ) {
					$this.activePanel( e, this );
				});
			},

			/** Active Panel */
			activePanel: function( e, object ) {
				let $index = $( object ).closest( '.cs-panel-tab' ).index();

				// Set location.
				window.history.replaceState( '', '', $( object ).attr( 'href' ) );

				// Nav Tabs.
				$( object ).closest( '.cs-panel-tab' ).addClass( 'cs-panel-tab-active' ).siblings().removeClass( 'cs-panel-tab-active' );

				// Content Tabs.
				$( '.cs-panel-content-tabs .cs-panel-tab' ).eq( $index ).addClass( 'cs-panel-tab-active' ).siblings().removeClass( 'cs-panel-tab-active' );

				e.preventDefault();
			},
		};

	} )();

	// Initialize.
	cscoThemeDashboard.init();

} )( jQuery );
