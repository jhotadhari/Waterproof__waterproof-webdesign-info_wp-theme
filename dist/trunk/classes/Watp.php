<?php

namespace watp;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use croox\wde;

class Watp extends wde\Theme {

	public function initialize() {

		// // Run Updates when theme version changes.
		// add_filter( $this->prefix . '_update_version', function( $success, $new_version, $old_version ) {
		// 	return $success;
		// }, 10, 3 );

		// // Run Updates when theme db_version changes.
		// add_filter( $this->prefix . '_update_db_version', function( $success, $new_db_version, $old_db_version ) {
		// 	return $success;
		// }, 10, 3 );

		parent::initialize();
	}

	public function hooks(){
        parent::hooks();

		$this->_include( 'css_properties' ); // Includes function watp_get_css_property, see watp_add_theme_support

        // Fix WPML global active language variable for REST Requests.
        // if ( class_exists( 'SitePress' ) ) {
        // 	add_action( 'after_setup_theme', array( 'croox\wde\utils\Wpml', 'rest_setup_switch_lang' ) );
        // }

		// add_action( 'init', array( $this, 'do_something_on_init' ), 10 );

		if ( ! is_admin() ) {
			Wpcf7_Maybe_Load_Assets::get_instance();
			Wpseo_Breadcrumb_Customize::get_instance();
		}

		if ( function_exists( 'hcaptcha' ) ) {
			Hcaptcha_acll::init();
		}

		add_action( 'current_screen', array( $this, 'enqueue_style_editor' ), 10 );
	}

	// public function do_something_on_init(){
	// 	// ...
	// }

	public function enqueue_script_editor( $screen ){
		if ( ! is_admin() || 'post' !== $screen->base ) {
			return;
		}

		$handle = $this->prefix . '_script_editor';

		$deps = array(
			'wp-blocks',
			'wp-dom-ready',
			'wp-edit-post',
		);

		// // If script contains lapo customization, enqueue it after lapo script.
		// if ( class_exists( 'lapo\Block_Latest_Posts' ) ) {
		// 	$deps[] = 'lapo_block_latest_posts_admin';
		// }

		$this->register_script( array(
			'handle'		=> $handle,
			'deps'			=> $deps,
			'in_footer'		=> true,	// default false
			'enqueue'		=> true,
			// 'localize_data'	=> array(),
		) );
	}

	public function enqueue_style_editor( $screen ){
		if ( ! is_admin() || 'post' !== $screen->base ) {
			return;
		}
		$handle = $this->prefix . '_editor';
		$this->register_style( array(
			'handle'	=> $handle,
			'enqueue'	=> true,
		) );
	}

	public function enqueue_scripts(){
        parent::enqueue_scripts();

		$handle = $this->prefix . '_script';

		$deps = array(
			'jquery',
			// 'wp-i18n',
		);

		if ( is_plugin_active( 'Croox__asset-cleaner-loader_wp-plugin/Croox__asset-cleaner-loader_wp-plugin.php' ) ) {
			$deps[] = 'acll_loader';
		}

        $this->register_script( array(
			'handle'	=> $handle,
			'deps'		=> $deps,
			'in_footer'	=> true,	// default false
			'enqueue'	=> true,
			'localize_data'	=> apply_filters( 'watp_script_localize_data', array() ),

		) );
	}

	// public function enqueue_scripts_admin(){
    //     parent::enqueue_scripts_admin();

    //     $handle = $this->prefix . '_script_admin';

    //     $this->register_script( array(
	// 		'handle'	=> $handle,
	// 		'deps'		=> array(
	// 			'jquery',
	// 			// 'wp-hooks',
	// 			// 'wp-api',
	// 			// 'wp-data',
	// 			// 'wp-i18n',
	// 		),
	// 		'in_footer'	=> true,	// default false
	// 		'enqueue'	=> true,
	// 	) );

	// }

}
