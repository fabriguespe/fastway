jQuery(document).ready(function(){
wp.customize( 'css_editor-header', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-header' ).text(newval );
  } );
} );
wp.customize( 'css_editor-body', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-body' ).text(newval );
  } );
} );
wp.customize( 'css_editor-footer-copywright', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-footer-copywright' ).text(newval );
  } );
} );
wp.customize( 'css_editor-footer', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-footer' ).text(newval );
  } );
} );
wp.customize( 'css_loop_review', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_loop_review' ).text(newval );
  } );
} );

wp.customize( 'css_event_review', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_event_review' ).text(newval );
  } );
} );
wp.customize( 'css_loop_blog', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_loop_blog' ).text(newval );
  } );
} );
wp.customize( 'css_editor-forms', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-forms' ).text(newval );
  } );
} );
wp.customize( 'css_editor-general', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-general' ).text(newval );
  } );
} );
wp.customize( 'css_editor-mobile', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-mobile' ).text(newval );
  } );
} );
wp.customize( 'css_loop_cat', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_loop_cat' ).text(newval );
  } );
} );
wp.customize( 'css_editor-loop', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-loop' ).text(newval );
  } );
} );

wp.customize( 'general-logo', function( value ) {
  value.bind( function( newval ) {
    jQuery( '.logo img' ).attr("src",newval);
  } );
} );
wp.customize( 'css_editor-single', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-single' ).text(newval );
  } );
} );
wp.customize( 'css_editor_blog_page', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor_blog_page' ).text(newval );
  } );
} );
wp.customize( 'css_editor_blog', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor_blog' ).text(newval );
  } );
} );
wp.customize( 'css_editor_shop', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor_shop' ).text(newval );
  } );
} );
wp.customize( 'css_editor-header-headerwidget', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-widget' ).text(newval );
  } );
} );
wp.customize( 'css_editor-roles', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-roles' ).text(newval );
  } );
} );
wp.customize( 'css_editor-logged_in', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_editor-logged_in' ).text(newval );
  } );
} );
wp.customize( 'css_loop_brand', function( value ) {
  value.bind( function( newval ) {
    jQuery( '#css_loop_brand' ).text(newval );
  } );
} );
});

