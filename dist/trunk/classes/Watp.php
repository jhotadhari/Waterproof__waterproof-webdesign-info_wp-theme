<?php

namespace watp;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use croox\wde;

class Watp extends wde\Theme {

	public function hooks(){
        parent::hooks();

        // Fix WPML global active language variable for REST Requests.
        // if ( class_exists( 'SitePress' ) ) {
        // 	add_action( 'after_setup_theme', array( 'croox\wde\utils\Wpml', 'rest_setup_switch_lang' ) );
        // }

		// add_action( 'init', array( $this, 'do_something_on_init' ), 10 );

		if ( ! is_admin() ) {
			Wpcf7_Maybe_Load_Assets::get_instance();
			Wpseo_Breadcrumb_Customize::get_instance();
		}

		add_action( 'current_screen', array( $this, 'enqueue_style_editor' ), 10 );
	}

	// public function do_something_on_init(){
	// 	// ...
	// }

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

        $this->register_script( array(
			'handle'	=> $handle,
			'deps'		=> array(
				'jquery',
				// 'wp-i18n',

			),
			'in_footer'	=> true,	// default false
			'enqueue'	=> true,
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
