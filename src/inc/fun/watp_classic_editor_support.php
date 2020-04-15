<?php
/**
 * Modify classic editor
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'watp_classic_editor_support' ) ) {
	function watp_classic_editor_support( $current_screen ) {

		// get out if block editor, prevents composer to autoload the class if unnecessary
		if ( $current_screen->is_block_editor )
			return;

		watp\Classic_Editor_Support::get_instance();
	}
}
add_action( 'current_screen', 'watp_classic_editor_support', 1 );
