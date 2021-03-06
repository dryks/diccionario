( function ( M ) {
	var Button = M.require( 'mobile.startup/Button' ),
		util = M.require( 'mobile.startup/util' ),
		Overlay = M.require( 'mobile.startup/Overlay' );

	/**
	 * Overlay that shows a message about abuse. This overlay is rendered when the error code from the API
	 * is related to the abusefilter extension.
	 * @class AbuseFilterOverlay
	 * @extends Overlay
	 */
	function AbuseFilterOverlay() {
		Overlay.apply( this, arguments );
	}

	OO.mfExtend( AbuseFilterOverlay, Overlay, {
		/**
		 * @inheritdoc
		 * @cfg {Object} defaults Default options hash.
		 * @cfg {Object} defaults.confirmButton options for a confirm Button
		 */
		defaults: util.extend( {}, Overlay.prototype.defaults, {
			confirmButton: new Button( {
				additionalClassNames: 'cancel',
				progressive: true
			} ).options
		} ),
		templatePartials: util.extend( {}, Overlay.prototype.templatePartials, {
			button: Button.prototype.template,
			content: mw.template.get( 'mobile.editor.common', 'AbuseFilterOverlay.hogan' )
		} ),
		className: 'overlay abusefilter-overlay',

		/** @inheritdoc */
		postRender: function () {
			Overlay.prototype.postRender.apply( this );
			// make links open in separate tabs
			this.$( 'a' ).attr( 'target', '_blank' );
		}
	} );

	M.define( 'mobile.editor.common/AbuseFilterOverlay', AbuseFilterOverlay )
		.deprecate( 'mobile.abusefilter/AbuseFilterOverlay' );
}( mw.mobileFrontend ) );
