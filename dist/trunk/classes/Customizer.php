<?php

namespace watp;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// https://codex.wordpress.org/Theme_Customization_API

class Customizer {

	protected static $instance = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	protected function __construct() {
		// register settings
		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'customize_register', array( $this, 'register_theme' ) );
		// Scripts for Preview
		add_action( 'customize_preview_init', array( $this, 'preview_js' ) );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	}

	/**
	 * Select sanitization function
	 *
	 * @param string               $input   Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 */
	public function theme_slug_sanitize_select( $input, $setting ) {
		// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
		$input = sanitize_key( $input );

		// Get the list of possible select options.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	public function register_theme( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'watp_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'watp' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'watp' ),
				'priority'    => 160,
			)
		);

		$wp_customize->add_setting(
			'watp_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => array( $this, 'theme_slug_sanitize_select' ),
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'watp_container_type',
				array(
					'label'       => __( 'Container Width', 'watp' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'watp' ),
					'section'     => 'watp_theme_layout_options',
					'settings'    => 'watp_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'watp' ),
						'container-fluid' => __( 'Full width container', 'watp' ),
					),
					'priority'    => '10',
				)
			)
		);

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * Setup JS integration for live previewing.
	 */
	public function preview_js() {
		$handle = 'watp_customizer';
		$_src = '/js/' . $handle . '.min.js';
		$src = namespace\Watp::get_instance()->dir_url . $_src;
		$ver = namespace\Watp::get_instance()->version . '.' . filemtime( namespace\Watp::get_instance()->dir_path . $_src );
		wp_enqueue_script(
			$handle,
			$src,
			array( 'customize-preview' ),
			$ver,
			true
		);
	}

}