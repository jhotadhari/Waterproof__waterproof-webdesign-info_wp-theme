<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function watp_include_template_functions() {

	$paths = array(
		'inc/template_functions/watp_adjust_body_class.php',
		'inc/template_functions/watp_body_classes.php',
		'inc/template_functions/watp_bootstrap_comment_form_fields.php',
		'inc/template_functions/watp_bootstrap_comment_form.php',
		'inc/template_functions/watp_change_logo_class.php',
		'inc/template_functions/watp_excerpt_get_more_link.php',
		'inc/template_functions/watp_excerpt_more.php',
		'inc/template_functions/watp_mobile_web_app_meta.php',
		'inc/template_functions/watp_pingback.php',
	);

	if ( count( $paths ) > 0 ) {
		foreach( $paths as $path ) {
			include_once( watp\Watp::get_instance()->dir_path . $path );
		}
	}

}

?>