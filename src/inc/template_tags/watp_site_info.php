<?php
/**
 * Display site info.
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'watp_site_info' ) ) {

	/**
	 * Display site info.
	 *
	 * Adds site info hooks to WP hook library.
	 */
	function watp_site_info() {

		do_action( 'watp_site_info_before' );

		$the_theme = wp_get_theme();

		$site_info = implode( '<span class="sep"> | </span>', array(
			sprintf(
				esc_html__( '%s %s – %s', 'watp' ),
				'&copy;',
				sprintf( '<a href="%s">%s</a>', get_bloginfo('url'), get_bloginfo('name') ),
				date('Y')
			),
			sprintf(
				'%1$s (%2$s)',
				sprintf( // WPCS: XSS ok.
					/* translators:*/
					esc_html__( 'Theme: %1$s', 'watp' ),
					sprintf( '<a href="%s">%s</a>', 'https://github.com/jhotadhari/Waterproof__waterproof-webdesign-info_wp-theme', $the_theme->get( 'Name' ) )
				),
				sprintf( // WPCS: XSS ok.
					/* translators:*/
					esc_html__( 'Version: %1$s', 'watp' ),
					$the_theme->get( 'Version' )
				)
			),
			sprintf(
				'<a href="%1$s">%2$s</a><span class="sep">',
				esc_url( __( 'http://wordpress.org/', 'watp' ) ),
				sprintf(
					/* translators:*/
					esc_html__( 'Proudly powered by %s', 'watp' ),
					'WordPress'
				)
			),
		) );

		echo apply_filters( 'watp_site_info_content', $site_info ); // WPCS: XSS ok.

		do_action( 'watp_site_info_after' );
	}
}