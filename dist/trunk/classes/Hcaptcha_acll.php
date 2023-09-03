<?php

namespace watp;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Hcaptcha_acll {

    protected static $handle = 'watp_hcaptcha_loader';

    public static function init() {
        // Stop the inline script... But this will unfortunately stop enqueueing the hcaptcha script as well.
        remove_action( 'wp_print_footer_scripts', [ hcaptcha(), 'print_footer_scripts' ], 0 );
        // Do not enqueue the hcaptcha script, if it was enqueued.
		add_filter( 'acll_cleaner_scripts', [ __CLASS__, 'acll_cleaner_scripts' ], 10, 1 );
        // Hook methods that register the scripts and add it to acll loader.
        add_action( 'wp', [ __CLASS__, 'maybe_load' ], 10, 0 );
    }

    public static function maybe_load() {
        if ( Wpcf7_Maybe_Load_Assets::get_instance()->is_contact_page() ) {
            add_filter( 'hcap_print_hcaptcha_scripts', '__return_true', 10, PHP_INT_MAX );
            add_action( 'wp_enqueue_scripts', [ __CLASS__, 'register_hcaptcha_scripts' ] );
            add_filter( 'watp_script_localize_data', [ __CLASS__, 'watp_script_localize_data' ], 10, 1 );
            add_filter( 'acll_loader_script_handles_footer', [ __CLASS__, 'acll_loader_script_handles_footer' ], 10, 1 );
        }
    }

    public static function watp_script_localize_data( $localize_data ) {
        $localize_data['hcaptcha_scripts'] = array(
            self::$handle,
            \HCaptcha\Main::HANDLE,
        );
        return $localize_data;
    }

    public static function register_hcaptcha_scripts() {

        $hcaptcha = hcaptcha();

        // Call $hcaptcha->print_footer_scripts() to register the hcaptcha script. But inside a buffer, because we do not want the inline script.
        ob_start();
        $hcaptcha->print_footer_scripts();
        $out = ob_get_clean();

        // Register the script that hcaptcha would load by the stopped inline script.
        wp_register_script(
			self::$handle,
			$hcaptcha->get_api_src(),
			[
                \HCaptcha\Main::HANDLE,
            ],
			'',
			true
		);
	}

    public static function acll_cleaner_scripts( $handles ) {
        $handles[] = \HCaptcha\Main::HANDLE;
        return $handles;
    }

    public static function acll_loader_script_handles_footer( $handles ) {
        $handles[] = self::$handle;
        $handles[] = \HCaptcha\Main::HANDLE;
        return $handles;
    }
}