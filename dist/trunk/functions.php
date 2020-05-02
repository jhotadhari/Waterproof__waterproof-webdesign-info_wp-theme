<?php
/**
 * Waterproof Webdesign Theme Theme init
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

include_once( dirname( __FILE__ ) . '/vendor/autoload.php' );

function watp_init() {

	$init_args = array(
		'version'		=> '1.0.0',
		'slug'			=> 'Waterproof__waterproof-webdesign-info_wp-theme',
		'name'			=> 'waterproof-webdesign Theme',
		'prefix'		=> 'watp',
		'textdomain'	=> 'watp',
		'project_kind'	=> 'theme',
		'FILE_CONST'	=> __FILE__,
		'db_version'	=> 0,
		'wde'			=> array(
			'generator-wp-dev-env'	=> '0.14.2',
			'wp-dev-env-grunt'		=> '0.9.7',
			'wp-dev-env-frame'		=> '0.8.0',
		),
		'deps'			=> array(
			'php_version'	=> '5.6.0',		// required php version
			'wp_version'	=> '5.0.0',			// required wp version
			'plugins'    	=> array(
				/*
				'woocommerce' => array(
					'name'              => 'WooCommerce',               // full name
					'link'              => 'https://woocommerce.com/',  // link
					'ver_at_least'      => '3.0.0',                     // min version of required plugin
					'ver_tested_up_to'  => '3.2.1',                     // tested with required plugin up to
					'class'             => 'WooCommerce',               // test by class
					//'function'        => 'WooCommerce',               // test by function
				),
				*/
			),
			'php_ext'     => array(
				/*
				'xml' => array(
					'name'              => 'Xml',                                           // full name
					'link'              => 'http://php.net/manual/en/xml.installation.php', // link
				),
				*/
			),
		),
	);

	// see ./classes/Watp.php
	return watp\Watp::get_instance( $init_args );
}
watp_init();

?>