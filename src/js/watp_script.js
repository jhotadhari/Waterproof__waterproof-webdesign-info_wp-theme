/**
 * External dependencies
 */
import $ from 'jquery';

/**
 * WordPress dependencies
 */
// const {	__ } = wp.i18n;

/**
 * Internal dependencies
 */
// import customized bootstrap, may be stripped.
import './watp_script/bootstrapCustom';
import './watp_script/skip_link_focus_fix';
import './watp_script/theme_support_align_full';
import './watp_script/contact_hcaptcha';

$( document ).ready( function( $ ) {

	/**
	 * Donate page, paypal button
	 */
	const $form = $( '.paypal-donate' ).first();
	$form.prevAll( '.wp-block-cover' ).find( '.wp-block-cover__inner-container' ).append( $form );

	/**
	 * Cookie Notice for GDPR & CCPA
	 * change revoke btn lang
	 */
	const str = 'Cookie-Zustimmung widerrufen';
	$( '.lang-de_DE .cn-revoke-cookie' ).html( str ).prop( 'title', str );

} );
