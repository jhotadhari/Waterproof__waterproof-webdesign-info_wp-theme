/**
 * External dependencies
 */
import $ from 'jquery';

/**
 * Internal dependencies
 */
const { loadAssets } = acll_loader;

$( document ).ready( function( $ ) {

	if ( window.watp_script_data && window.watp_script_data.hcaptcha_scripts && Array.isArray( window.watp_script_data.hcaptcha_scripts ) && window.watp_script_data.hcaptcha_scripts.length ) {
		let loaded = false;
		const loadHcaptcha = function() {
			if ( ! loaded && $( this ).prop( 'checked' ) ) {
				loadAssets( {
					scripts: window.watp_script_data.hcaptcha_scripts,
				} ).then( () => {
					loaded = true;
				} );
			}
		};
		$( 'input[name="hcaptcha"]' ).on( 'click', loadHcaptcha ).each( loadHcaptcha );
	}

} );
