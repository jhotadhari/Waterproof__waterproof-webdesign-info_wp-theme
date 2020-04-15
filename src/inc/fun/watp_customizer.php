<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'watp_customizer' ) ) {
	/**
	 * Load Customizer customizations
	 */
	function watp_customizer() {

		// get out if not in customizer, prevents composer to autoload the class if unnecessary
		if ( ! is_customize_preview() )
			return;

		watp\Customizer::get_instance();
	}
}
watp_customizer();