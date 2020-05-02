<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function watp_include_fun() {

	$paths = array(
		'inc/fun/watp_add_theme_support.php',
		'inc/fun/watp_customizer.php',
		'inc/fun/watp_setup_theme_default_settings.php',
	);

	if ( count( $paths ) > 0 ) {
		foreach( $paths as $path ) {
			include_once( watp\Watp::get_instance()->dir_path . $path );
		}
	}

}

?>