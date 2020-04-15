<?php
/**
 * Check and setup theme's default settings
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'watp_setup_theme_default_settings' ) ) {
	function watp_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$watp_posts_index_style = get_theme_mod( 'watp_posts_index_style' );
		if ( '' == $watp_posts_index_style ) {
			set_theme_mod( 'watp_posts_index_style', 'default' );
		}

		// Container width.
		$watp_container_type = get_theme_mod( 'watp_container_type' );
		if ( '' == $watp_container_type ) {
			set_theme_mod( 'watp_container_type', 'container' );
		}
	}
}
