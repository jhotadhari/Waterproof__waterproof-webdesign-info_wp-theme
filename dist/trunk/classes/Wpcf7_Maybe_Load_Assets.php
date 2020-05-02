<?php

namespace watp;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Wpcf7_Maybe_Load_Assets {

	protected static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	public function hooks() {
		add_filter( 'wpcf7_load_js', array( $this, 'maybe_load_assets' ) );
		add_filter( 'wpcf7_load_css', array( $this, 'maybe_load_assets' ) );
		add_action( 'wp', array( $this, 'maybe_remove_recaptcha' ) );
		// add_action( 'wp_footer', array( $this, 'hide_recaptcha_anchor' ), 100 );
	}

	/**
	 * Check if current page is contact page
	 *
	 * @return boolean
	 */
	protected function is_contact_page() {
		global $post;

		// contact page slugs
		$slugs = array(
			'kontakt',
			'contact',
		);

		return ! is_admin() && is_singular() && $post instanceof \WP_Post && in_array( $post->post_name, $slugs )
			? true
			: false;
	}

	/**
	 * Loading JavaScript and Stylesheet Only on contact-page
	 *
	 * @see https://contactform7.com/loading-javascript-and-stylesheet-only-when-it-is-necessary/
	 * @return boolean
	 */
	public function maybe_load_assets( $load ) {
		return $this->is_contact_page() ? $load : false;
	}

	/**
	 * hide recaptcha anchor
	 *
	 * not allowed to hide! https://policies.google.com/terms?hl=en
	 */
	public function hide_recaptcha_anchor() {
		if ( $this->is_contact_page() ) {
			echo '<style type="text/css">.grecaptcha-badge { display: none !important; }</style>';
		}
	}

	/**
	 * removes recaptcha enqueue action/filters
	 */
	public function maybe_remove_recaptcha() {
		if ( ! $this->is_contact_page() ) {
			remove_filter( 'wpcf7_form_hidden_fields', 'wpcf7_recaptcha_add_hidden_fields', 100 );
			remove_filter( 'wpcf7_spam', 'wpcf7_recaptcha_verify_response', 9 );
			remove_action( 'wpcf7_init', 'wpcf7_recaptcha_register_service', 10 );
			remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', 10 );
			remove_action( 'wp_footer', 'wpcf7_recaptcha_onload_script', 40 );
			remove_action( 'wpcf7_init', 'wpcf7_recaptcha_add_form_tag_recaptcha', 10 );
		}
	}


}