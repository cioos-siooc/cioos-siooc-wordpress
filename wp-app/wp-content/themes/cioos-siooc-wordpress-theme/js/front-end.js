jQuery( document ).ready( function() {
	jQuery( '#header-search a' ).click( function() {
		if ( ! jQuery( '#header-search' ).hasClass( 'active' ) ) {
			jQuery( '#header-search' ).addClass( 'active' );
		} else {
			jQuery( '#header-search' ).removeClass( 'active' );
		}
	} );
} );
