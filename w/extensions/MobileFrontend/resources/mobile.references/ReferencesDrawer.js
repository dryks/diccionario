( function ( M ) {
	var Drawer = M.require( 'mobile.startup/Drawer' ),
		util = M.require( 'mobile.startup/util' ),
		icons = M.require( 'mobile.startup/icons' ),
		ReferencesGateway = M.require( 'mobile.references.gateway/ReferencesGateway' ),
		Icon = M.require( 'mobile.startup/Icon' );

	/**
	 * Drawer for references
	 * @class ReferencesDrawer
	 * @extends Drawer
	 * @uses Icon
	 */
	function ReferencesDrawer() {
		Drawer.apply( this, arguments );
	}

	OO.mfExtend( ReferencesDrawer, Drawer, {
		/**
		 * @cfg {Object} defaults Default options hash.
		 * @cfg {string} defaults.cancelButton HTML of the button that closes the drawer.
		 * @cfg {boolean} defaults.error whether an error message is being shown
		 */
		defaults: util.extend( {}, Drawer.prototype.defaults, {
			spinner: icons.spinner().toHtmlString(),
			cancelButton: new Icon( {
				name: 'overlay-close-gray',
				additionalClassNames: 'cancel',
				label: mw.msg( 'mobile-frontend-overlay-close' )
			} ).toHtmlString(),
			citation: new Icon( {
				isSmall: true,
				name: 'citation',
				additionalClassNames: 'text',
				hasText: true,
				label: mw.msg( 'mobile-frontend-references-citation' )
			} ).toHtmlString(),
			errorClassName: new Icon( {
				name: 'error',
				hasText: true,
				isSmall: true
			} ).getClassName()
		} ),
		events: {
			'click sup a': 'showNestedReference'
		},
		/** @inheritdoc */
		show: function () {
			return Drawer.prototype.show.apply( this, arguments );
		},
		className: 'drawer position-fixed text references',
		template: mw.template.get( 'mobile.references', 'Drawer.hogan' ),
		/**
		 * @inheritdoc
		 */
		closeOnScroll: false,
		/**
		 * @inheritdoc
		 */
		postRender: function () {
			var windowHeight = util.getWindow().height();

			Drawer.prototype.postRender.apply( this );

			// make sure the drawer doesn't take up more than 50% of the viewport height
			if ( windowHeight / 2 < 400 ) {
				this.$el.css( 'max-height', windowHeight / 2 );
			}

			this.on( 'show', this.onShow.bind( this ) );
			this.on( 'hide', this.onHide.bind( this ) );
		},
		/**
		 * Make body not scrollable
		 */
		onShow: function () {
			util.getDocument().find( 'body' ).addClass( 'drawer-enabled' );
		},
		/**
		 * Restore body scroll
		 */
		onHide: function () {
			util.getDocument().find( 'body' ).removeClass( 'drawer-enabled' );
		},
		/**
		 * Fetch and render nested reference upon click
		 * @param {string} id of the reference to be retrieved
		 * @param {Page} page to locate reference for
		 * @param {string} refNumber the number it identifies as in the page
		 * @return {jQuery.Deferred}
		 */
		showReference: function ( id, page, refNumber ) {
			var drawer = this,
				gateway = this.options.gateway;

			// Save the page in case we have to show a nested reference.
			this.options.page = page;
			// If API is being used we want to show the drawer with the spinner while query runs
			drawer.show();
			return gateway.getReference( id, page ).then( function ( reference ) {
				drawer.render( {
					title: refNumber,
					text: reference.text
				} );
			}, function ( err ) {
				if ( err === ReferencesGateway.ERROR_NOT_EXIST ) {
					drawer.hide();
				} else {
					drawer.render( {
						error: true,
						title: refNumber,
						text: mw.msg( 'mobile-frontend-references-citation-error' )
					} );
				}
			} );
		},
		/**
		 * Fetch and render nested reference upon click
		 * @param {jQuery.Event} ev
		 * @return {boolean} False to cancel the native event
		 */
		showNestedReference: function ( ev ) {
			var $dest = this.$( ev.target );

			this.showReference( $dest.attr( 'href' ), this.options.page, $dest.text() );
			// Don't hide the already shown drawer via propagation and stop default scroll behaviour.
			return false;
		}
	} );

	M.define( 'mobile.references/ReferencesDrawer', ReferencesDrawer ); // resource-modules-disable-line
}( mw.mobileFrontend ) );
