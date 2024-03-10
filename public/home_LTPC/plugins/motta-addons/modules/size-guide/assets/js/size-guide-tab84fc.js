jQuery( document ).ready( function( $ ) {
	$( '.motta-size-guide-tabs' ).on( 'click', '.motta-size-guide-tabs__nav li', function() {
        var $tab = $( this ),
            index = $tab.data( 'target' ),
            $panels = $tab.closest( '.motta-size-guide-tabs' ).find( '.motta-size-guide-tabs__panels' ),
            $panel = $panels.find( '.motta-size-guide-tabs__panel[data-panel="' + index + '"]' );

        if ( $tab.hasClass( 'active' ) ) {
            return;
        }

        $tab.addClass( 'active' ).siblings( 'li.active' ).removeClass( 'active' );

        if ( $panel.length ) {
            $panel.addClass( 'active' ).siblings( '.motta-size-guide-tabs__panel.active' ).removeClass( 'active' );
        }
    } );
} );