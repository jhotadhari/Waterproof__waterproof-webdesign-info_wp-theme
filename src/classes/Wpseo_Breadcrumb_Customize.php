<?php

namespace watp;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use croox\wde;

class Wpseo_Breadcrumb_Customize {

	protected static $instance = null;

	protected $wpseo_breadcrumbs = null;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->initialize();
		}
		return self::$instance;
	}

	protected function initialize() {
		if ( defined( 'WPSEO_FILE' ) ) {
			$this->hooks();
		}
	}

	public function hooks() {
		add_filter( 'wpseo_breadcrumb_links', array( $this, 'add_remove_breadcrumbs' ) );
		add_filter( 'wpseo_breadcrumb_single_link', array( $this, 'markup_to_bootstrap' ), 10, 2 );
		add_filter( 'wpseo_breadcrumb_output', array( $this, 'remove_whitespace_between' ) );
		add_filter( 'wpseo_breadcrumb_output', array( $this, 'output_wrapper_add_class' ) );
		add_filter( 'wpseo_breadcrumb_single_link_wrapper', array( $this, 'div_wrapper' ) );
		add_filter( 'wpseo_breadcrumb_output_wrapper', array( $this, 'div_wrapper' ) );
		add_filter( 'wpseo_breadcrumb_output_wrapper', array( $this, 'ol_wrapper' ) );
	}

	/**
	 * Remove whitespace beween crumbs
	 */
	public function remove_whitespace_between( $output ) {
		$element = apply_filters( 'wpseo_breadcrumb_single_link_wrapper', 'div' );
		return preg_replace(
			'/<\/' . $element . '>\s*</',
			'</' . $element . '><',
			$output
		);
	}

	/**
	 * Add a class to the output wrapper element
	 */
	public function output_wrapper_add_class( $output ) {
		$element = apply_filters( 'wpseo_breadcrumb_output_wrapper', 'ol' );
		$class = 'breadcrumb wpseo-breadcrumbs-output-wrapper';
		return str_replace(
			'<' . $element . '>',
			'<' . $element . ' class="' . $class . '">',
			$output
		);
	}

	/**
	 *
	 */
	public function markup_to_bootstrap(  $link_output, $link  ) {

		preg_match( '/class=\"breadcrumb_last\"/', $link_output, $matches );
		$is_last = ! empty( $matches );
		$element = esc_attr( apply_filters( 'wpseo_breadcrumb_single_link_wrapper', 'div' ) );

		$link_output = '';
		if ( isset( $link['text'] ) && ( is_string( $link['text'] ) && $link['text'] !== '' ) ) {

			$link['text'] = trim( $link['text'] );
			if ( ! isset( $link['allow_html'] ) || $link['allow_html'] !== true ) {
				$link['text'] = esc_html( $link['text'] );
			}

			if ( ! $is_last && ( isset( $link['url'] ) && ( is_string( $link['url'] ) && $link['url'] !== '' ) )
			) {
				$link_output .= '<' . $element . ' class="breadcrumb-item">';
				$title_attr   = isset( $link['title'] ) ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
				$link_output .= '<a href="' . esc_url( $link['url'] ) . '" ' . $title_attr . '>' . $link['text'] . '</a>';
				$link_output .= '</' . $element . '>';
			}
			else {
				$inner_elm = $element;
				if ( $is_last && \WPSEO_Options::get( 'breadcrumbs-boldlast' ) === true ) {
					// $inner_elm = 'strong';
					$inner_elm = 'h1';
				}
				$link_output .= '<' . $inner_elm . ' class="breadcrumb-item breadcrumb-item-active" aria-current="page">' . $link['text'] . '</' . $inner_elm . '>';
			}

		}

		return $link_output;
	}


	/**
	 * Return div
	 * Used to wrap single elements in div
	 */
	public function div_wrapper( $wrapper ) {
		return 'div';
	}

	/**
	 * Return ol
	 * Used to wrap wrapper in ol
	 */
	public function ol_wrapper( $wrapper ) {
		return 'ol';
	}

	public function add_remove_breadcrumbs( $crumbs ) {

		// // first crumb is home crumb
		// // $crumbs = count( $crumbs ) > 1 ? $crumbs : array();
		// $lang = apply_filters( 'wpml_current_language', NULL );

		/**
		 * Remove home link
		 * if it is frist one
		 * if more crumbs than one
		 *
		 */
		if ( count( $crumbs ) > 1
			&& $crumbs['0']['allow_html']
			&& ( array_key_exists( 'url', $crumbs['0'] )
				&& ! empty( $crumbs['0']['url'] )
				&& \WPSEO_Utils::home_url() === $crumbs['0']['url']
			)
		) {
			array_splice( $crumbs, 0, 1 );
		/**
		 * Change home link
		 * to post_title
		 * if it is the only crumb
		 *
		 */
		} elseif ( 0 === count( $crumbs ) && is_front_page() ) {
			$crumbs = array(
				array(
					'id' => get_option('page_on_front'),
				),
			);
		}

		return $crumbs;
	}

}