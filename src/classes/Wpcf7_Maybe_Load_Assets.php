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
		// add_action( 'wp_footer', array( $this, 'hide_recaptcha_anchor' ), 100 );
	}

	/**
	 * Check if current page is contact page
	 *
	 * @return boolean
	 */
	public function is_contact_page() {
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

}