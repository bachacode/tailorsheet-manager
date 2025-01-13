(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$( document ).ready(function() {
		$('select[multiple]').select2({
			placeholder: 'Selecciona una o mas expresiones...',
			width: '100%',
		});

		var classes = [
			'post-type-expresiones-appsheet', 
			'post-type-ejemplos-appsheet', 
			'taxonomy-categoria-de-expresion', 
			'taxonomy-ejemplo-de-expresion', 
			'taxonomy-relacion-de-expresion', 
			'taxonomy-categoria-de-ejemplo', 
			'taxonomy-sector-de-ejemplo', 
			'taxonomy-func-de-ejemplo', 
			'taxonomy-integracion-de-ejemplo', 
			'taxonomy-etiqueta-de-ejemplo', 
			'toplevel_page_tailorsheet-manager-admin'
		];
		var settings_parent = $('.ts-manager-settings-menu-title').closest('li');
		
		settings_parent.addClass('ts-manager-settings-option');

		if ($('body').is("." + classes.join(', .'))) {
			$('#adminmenu > li').removeClass('wp-has-current-submenu wp-menu-open').find('wp-sumenu').css({
			  'margin-right': 0
			});
			$('#toplevel_page_tailorsheet-manager-admin').addClass('wp-has-current-submenu wp-menu-open').removeClass('wp-not-current-submenu');
			$('.toplevel_page_tailorsheet-manager-admin').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');
		  }

	});
})( jQuery );
