<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function watp_include_template_tags() {

	$paths = array(
		'inc/template_tags/watp_categorized_blog.php',
		'inc/template_tags/watp_entry_footer.php',
		'inc/template_tags/watp_pagination.php',
		'inc/template_tags/watp_post_nav.php',
		'inc/template_tags/watp_posted_on.php',
	);

	if ( count( $paths ) > 0 ) {
		foreach( $paths as $path ) {
			include_once( watp\Watp::get_instance()->dir_path . $path );
		}
	}

}

?>