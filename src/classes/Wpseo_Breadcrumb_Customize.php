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
		// add_filter( 'wpseo_breadcrumb_links', array( $this, 'add_remove_breadcrumbs' ) );
		add_filter( 'wpseo_breadcrumb_single_link', array( $this, 'markup_not_recursive' ), 10, 2 );
		add_filter( 'wpseo_breadcrumb_output', array( $this, 'remove_whitespace_between' ) );
		add_filter( 'wpseo_breadcrumb_output', array( $this, 'output_wrapper_add_class' ) );
		add_filter( 'wpseo_breadcrumb_single_link_wrapper', array( $this, 'div_wrapper' ) );
		add_filter( 'wpseo_breadcrumb_output_wrapper', array( $this, 'div_wrapper' ) );
		add_filter( 'wpseo_breadcrumb_output_wrapper', array( $this, 'ol_wrapper' ) );
		// add_filter( 'wpseo_breadcrumb_links', array( $this, 'translate_search_title' ), 20 );
		// ... and function weit_maybe_hide_title_fix_breadcrumb hooked into wpseo_breadcrumb_single_link_info
	}

	/**
	 * Remove whitespace beween crumbs
	 */
	public function remove_whitespace_between( $output ) {
		$element = apply_filters( 'wpseo_breadcrumb_single_link_wrapper', 'div' );
		// $class = 'breadcrumb wpseo-breadcrumbs-output-wrapper';
		// $class = 'breadcrumb wpseo-breadcrumbs-output-wrapper';
		return preg_replace(
			'/<\/' . $element . '>\s*</',
			// '<' . $element . ' class="' . $class . '">',
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
	public function markup_not_recursive(  $link_output, $link  ) {

		preg_match( '/class=\"breadcrumb_last\"/', $link_output, $matches );
		$is_last = ! empty( $matches );
		$element = esc_attr( apply_filters( 'wpseo_breadcrumb_single_link_wrapper', 'div' ) );

		// <nav aria-label="breadcrumb">
		//   <ol class="breadcrumb">
		//     <li class="breadcrumb-item"><a href="#">Home</a></li>
		//     <li class="breadcrumb-item"><a href="#">Library</a></li>
		//     <li class="breadcrumb-item active" aria-current="page">Data</li>
		//   </ol>
		// </nav>


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

		// // ??? debug
		// ob_start();
		// // print('<pre>');
		// print_r( 'link_output ' );
		// print_r( $link_output );
		// print_r( PHP_EOL );
		// // var_dump( $test );
		// // print('</pre>');
		// $out_blabla = ob_get_clean();
		// error_log( $out_blabla );
		// // die( $out_blabla );



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

	// /**
	//  * Return span
	//  * Used as output wrapper element
	//  */
	// public function span_wrapper( $wrapper ) {
	// 	return 'span';
	// }

	// public function add_remove_breadcrumbs( $crumbs ) {

	// 	// first crumb is home crumb
	// 	$crumbs = count( $crumbs ) > 1 ? $crumbs : array();
	// 	$lang = apply_filters( 'wpml_current_language', NULL );

	// 	/**
	// 	 * Remove home link, if it is frist one
	// 	 *
	// 	 */
	// 	if ( count( $crumbs ) > 0
	// 		&& $crumbs['0']['allow_html']
	// 		&& ( array_key_exists( 'url', $crumbs['0'] )
	// 			&& ! empty( $crumbs['0']['url'] )
	// 			&& \WPSEO_Utils::home_url() === $crumbs['0']['url']
	// 		)
	// 	) {
	// 		array_splice( $crumbs, 0, 1 );
	// 	}

	// 	/**
	// 	 * singular weit_location
	// 	 *
	// 	 */
	// 	if ( is_singular( 'weit_location' )
	// 		|| is_tax( 'weit_location_category' )
	// 	) {
	// 		// add standorte page as first item
	// 		array_splice( $crumbs, 0, 0, array( array(
	// 			'id' => 151,	// ??? !!! hardcoded page id
	// 		) ) ) ;
	// 	}

	// 	/**
	// 	 * singular post
	// 	 *
	// 	 */
	// 	$post_type = 'post';
	// 	if ( is_singular( 'post' ) && class_exists( __NAMESPACE__ . '\Block_Simple_Post_List' ) ) {

	// 		// get first post containing the Block_Simple_Post_List listing post_type post
	// 		$posts = get_posts( array(
	// 			'posts_per_page' 	=> 1,
	// 			'post_type' 	 	=> 'any',
	// 			'lang' 	 		 	=> $lang,
	// 			'meta_key' 		 	=> Block_Simple_Post_List::get_instance()->meta_key,
	// 			'meta_value' 	 	=> $post_type,
	// 			'fields' 	 	 	=> 'id=>parent',
	// 			'suppress_filters'  => false,
	// 		) );

	// 		if ( ! empty( $posts ) ) {
	// 			// Add breadrumb for that post
	// 			array_splice( $crumbs, 0, 0, array( array(
	// 				'id' => array_keys( $posts )[0],
	// 			) ) );
	// 			// Add breadrumb for that post parent
	// 			$parent_id = array_values( $posts )[0];
	// 			if ( 0 !== $parent_id ) {
	// 				array_splice( $crumbs, 0, 0, array( array(
	// 					'id' => $parent_id,
	// 				) ) );
	// 			}
	// 		}
	// 	}

	// 	/**
	// 	 * singular weit_job_offer
	// 	 *
	// 	 */
	// 	$post_type = 'weit_job_offer';
	// 	if ( is_singular( 'weit_job_offer' ) && class_exists( __NAMESPACE__ . '\Block_Simple_Post_List' ) ) {

	// 		// get first post containing the Block_Simple_Post_List listing post_type post
	// 		$posts = get_posts( array(
	// 			'posts_per_page' 	=> 1,
	// 			'post_type' 	 	=> 'any',
	// 			'lang' 	 		 	=> $lang,
	// 			'meta_key' 		 	=> Block_Simple_Post_List::get_instance()->meta_key,
	// 			'meta_value' 	 	=> $post_type,
	// 			'fields' 	 	 	=> 'id=>parent',
	// 			'suppress_filters'  => false,
	// 		) );

	// 		if ( ! empty( $posts ) ) {
	// 			// Add breadrumb for that post
	// 			array_splice( $crumbs, 0, 0, array( array(
	// 				'id' => array_keys( $posts )[0],
	// 			) ) );
	// 			// Add breadrumb for that post parent
	// 			$parent_id = array_values( $posts )[0];
	// 			if ( 0 !== $parent_id ) {
	// 				array_splice( $crumbs, 0, 0, array( array(
	// 					'id' => $parent_id,
	// 				) ) );
	// 			}
	// 		}
	// 	}

	// 	/**
	// 	 * weit_taxonomies archives
	// 	 *
	// 	 */
	// 	foreach( apply_filters( 'weit_taxonomies', array() ) as $tax_slug ) {
	// 		if ( ! is_tax( $tax_slug ) )
	// 			continue;

	// 		// add first position
	// 		// taxonomy label string (without link)
	// 		$tax = get_taxonomy( $tax_slug );
	// 		if ( $tax ) {
	// 			array_splice( $crumbs, 0, 0, array( array(
	// 				'text'       => $tax->labels->name,
	// 				'url'        => '',
	// 				'allow_html' => true,
	// 			) ) ) ;
	// 		}
	// 	}

	// 	/**
	// 	 * singular  weit_prjct, weit_publication
	// 	 *
	// 	 */
	// 	if ( class_exists( __NAMESPACE__ . '\Block_Infinite_Post_List' ) ) {
	// 		foreach( array(
	// 			'weit_prjct',
	// 			'weit_publication',
	// 		) as $post_type_slug ) {

	// 			if ( ! is_singular( $post_type_slug ) )
	// 				continue;

	// 			// add first position
	// 			// references|referenzen
	// 			$references_post_id = 871; // 'references' post_id, will find the right translation
	// 			$element_type = 'post_page';
	// 			$trid = apply_filters( 'wpml_element_trid', NULL, $references_post_id , $element_type );
	// 			if ( null !== $trid ) {
	// 				$translations = apply_filters( 'wpml_get_element_translations', NULL, $trid, $element_type );
	// 				$current_translation = $translations[$lang];
	// 				$title = get_the_title( $current_translation->element_id );
	// 				$link = get_the_permalink( $current_translation->element_id );
	// 				if ( ! empty ( $title ) ) {
	// 					array_splice( $crumbs, 0, 0, array( array(
	// 						'text'       => $title,
	// 						'url'        => $link,
	// 						'allow_html' => true,
	// 					) ) ) ;
	// 				}
	// 			}

	// 			// add second position
	// 			// references/projects | referenzen/projekte | references/publications | referenzen/publicationen
	// 			array_splice( $crumbs, 1, 0, array( array(
	// 				'text'       => get_post_type_object( $post_type_slug )->labels->name,
	// 				'url'        => isset( $link ) && ! empty( $link )
	// 					? $link . wde\utils\Arr::get( Block_Infinite_Post_List::get_instance()->post_types, $post_type_slug . '.url_pretty.' . $lang, '' )
	// 					: '',
	// 				'allow_html' => true,
	// 			) ) ) ;

	// 		}
	// 	}

	// 	/**
	// 	 * singular weit_member
	// 	 *
	// 	 */
	// 	if ( is_singular( 'weit_member' ) && class_exists( __NAMESPACE__ . '\Block_Simple_Post_List' ) ) {

	// 		// get first post containing the Block_Simple_Post_List listing post_type weit_member
	// 		$posts = get_posts( array(
	// 			'posts_per_page' 	=> 1,
	// 			'post_type' 	 	=> 'any',
	// 			'lang' 	 		 	=> $lang,
	// 			'meta_key' 		 	=> Block_Simple_Post_List::get_instance()->meta_key,
	// 			'meta_value' 	 	=> 'weit_member',
	// 			'fields' 	 	 	=> 'id=>parent',
	// 			'suppress_filters'  => false,
	// 		) );

	// 		if ( ! empty( $posts ) ) {
	// 			// Add breadrumb for that post
	// 			array_splice( $crumbs, 0, 0, array( array(
	// 				'id' => array_keys( $posts )[0],
	// 			) ) );
	// 			// Add breadrumb for that post parent
	// 			array_splice( $crumbs, 0, 0, array( array(
	// 				'id' => array_values( $posts )[0],
	// 			) ) );
	// 		}
	// 	}

	// 	return $crumbs;
	// }



	// public function translate_search_title( $crumbs ) {
	// 	if ( ! is_search() )
	// 		return $crumbs;

	// 	// home crumb already removed
	// 	$crumbs = empty( $crumbs ) ? array() : $crumbs;

	// 	$crumbs = array_map( function( $crumb ) {
	// 		// check if crumb is_a search crumb (~has the default text)
	// 		preg_match( '/You searched for “.*”/', $crumb['text'], $matches );

	// 		if ( empty( $matches ) )
	// 			return $crumb;

	// 		if ( $crumb['text'] !== $matches[0] )
	// 			return $crumb;

	// 		// get the search string
	// 		preg_match( '/“.*”/', $crumb['text'], $search_strings );
	// 		$search_string = empty( $search_strings ) ? '' : $search_strings[0];
	// 		// remove first and last `"`
	// 		$search_string = mb_substr( $search_string, 1 );
	// 		$search_string = mb_substr( $search_string, 0, -1 );

	// 		$crumb['text'] = sprintf( __( 'You searched for "%s"', 'weit' ), $search_string );
	// 		return $crumb;
	// 	}, $crumbs );

	// 	return $crumbs;
	// }

}