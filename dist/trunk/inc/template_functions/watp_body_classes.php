<?php
/**
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'watp_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function watp_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( function_exists( 'pll_current_language' ) ){
			$lang = pll_current_language( 'locale' );
			$classes[] = 'lang-' . $lang;
		}

		return $classes;
	}
}
add_filter( 'body_class', 'watp_body_classes' );
