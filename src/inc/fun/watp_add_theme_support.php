<?php
/**
 * Theme basic setup.
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

use croox\wde\utils\Color;
use croox\wde\utils\Arr;

if ( ! function_exists ( 'watp_get_editor_color_palette_assoc' ) ) {
	/**
	 * Customize Block Color Palettes
	 *
	 * See
	 *	- Bootstrap variables												src/scss/watp_frontend/variables_site/_variables_bootstrap.scss
	 *	- Add background and text color classes for theme-color-palette 	src/scss/watp_frontend/_generic.scss
	 *	- Add background gradients classes for editor_gradient_presets		src/scss/watp_frontend/_generic.scss
	 *	- https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
	 */
	function watp_get_editor_color_palette_assoc() {
		$css_file_base = 'watp_frontend';
		$editor_color_palette_assoc = array(
			// bootstrap colors
			'primary'	=> array(
				'name' => __( 'Primary', 'watp' ),
				'slug' => 'primary',
				'color' => watp_get_css_property( 'primary', $css_file_base ),
			),
			'secondary'	=> array(
				'name' => __( 'Secondary', 'watp' ),
				'slug' => 'secondary',
				'color' => watp_get_css_property( 'secondary', $css_file_base ),
			),

			/* theme-colors */
			'success'	=> array(
				'name' => __( 'Success', 'watp' ),
				'slug' => 'success',
				'color' => watp_get_css_property( 'success', $css_file_base ),
			),
			'info'	=> array(
				'name' => __( 'Info', 'watp' ),
				'slug' => 'info',
				'color' => watp_get_css_property( 'info', $css_file_base ),
			),
			'warning'	=> array(
				'name' => __( 'Warning', 'watp' ),
				'slug' => 'warning',
				'color' => watp_get_css_property( 'warning', $css_file_base ),
			),
			'danger'	=> array(
				'name' => __( 'Danger', 'watp' ),
				'slug' => 'danger',
				'color' => watp_get_css_property( 'danger', $css_file_base ),
			),
			'light'	=> array(
				'name' => __( 'Light', 'watp' ),
				'slug' => 'light',
				'color' => watp_get_css_property( 'light', $css_file_base ),
			),
			'dark'	=> array(
				'name' => __( 'Dark', 'watp' ),
				'slug' => 'dark',
				'color' => watp_get_css_property( 'dark', $css_file_base ),
			),

			/* colors */
			'blue'	=> array(
				'name' => __( 'Blue', 'watp' ),
				'slug' => 'blue',
				'color' => watp_get_css_property( 'blue', $css_file_base ),
			),
			'indigo'	=> array(
				'name' => __( 'Indigo', 'watp' ),
				'slug' => 'indigo',
				'color' => watp_get_css_property( 'indigo', $css_file_base ),
			),
			'purple'	=> array(
				'name' => __( 'Purple', 'watp' ),
				'slug' => 'purple',
				'color' => watp_get_css_property( 'purple', $css_file_base ),
			),
			'pink'	=> array(
				'name' => __( 'Pink', 'watp' ),
				'slug' => 'pink',
				'color' => watp_get_css_property( 'pink', $css_file_base ),
			),
			'red'	=> array(
				'name' => __( 'Red', 'watp' ),
				'slug' => 'red',
				'color' => watp_get_css_property( 'red', $css_file_base ),
			),
			'orange'	=> array(
				'name' => __( 'Orange', 'watp' ),
				'slug' => 'orange',
				'color' => watp_get_css_property( 'orange', $css_file_base ),
			),
			'yellow'	=> array(
				'name' => __( 'Yellow', 'watp' ),
				'slug' => 'yellow',
				'color' => watp_get_css_property( 'yellow', $css_file_base ),
			),
			'green'	=> array(
				'name' => __( 'Green', 'watp' ),
				'slug' => 'green',
				'color' => watp_get_css_property( 'green', $css_file_base ),
			),
			'teal'	=> array(
				'name' => __( 'Teal', 'watp' ),
				'slug' => 'teal',
				'color' => watp_get_css_property( 'teal', $css_file_base ),
			),
			'cyan'	=> array(
				'name' => __( 'Cyan', 'watp' ),
				'slug' => 'cyan',
				'color' => watp_get_css_property( 'cyan', $css_file_base ),
			),

			/* grays */
			'white'	=> array(
				'name' => __( 'White', 'watp' ),
				'slug' => 'white',
				'color' => watp_get_css_property( 'white', $css_file_base ),
			),
			'gray'	=> array(
				'name' => __( 'Gray', 'watp' ),
				'slug' => 'gray',
				'color' => watp_get_css_property( 'gray', $css_file_base ),
			),
			'black'	=> array(
				'name' => __( 'Black', 'watp' ),
				'slug' => 'black',
				'color' => watp_get_css_property( 'black', $css_file_base ),
			),

		);

		// Remove duplicate colors
		$existing_colors = array();
		$editor_color_palette_assoc = array_filter( $editor_color_palette_assoc, function( $col ) use ( &$existing_colors ) {
			if ( in_array( $col['color'], $existing_colors ) )
				return false;
			$existing_colors[] = $col['color'];
			return true;
		} );

		return $editor_color_palette_assoc;
	}
}

if ( ! function_exists ( 'watp_get_editor_gradient_presets' ) ) {
	/**
	 * Example: Configure the predefined set of gradients.
	 * See function watp_add_theme_support `add_theme_support( 'editor-gradient-presets', $editor_gradient_presets );`
	 */
	function watp_get_editor_gradient_presets( $editor_color_palette_assoc = null ) {
		if ( null === $editor_color_palette_assoc )
			$editor_color_palette_assoc = watp_get_editor_color_palette_assoc();
		return Color::build_editor_gradient_presets( array(
			array(
				'type' => 'linear',
				'deg' => '90',
				'steps' => array(
					// 		slug 			alpha 	step
					array( 'primary', 		1,		0 ),
					array( 'secondary', 	1, 		100 ),
				),
			),
			array(
				'type' => 'radial',
				'steps' => array(
					// 		slug 			alpha 	step
					array( 'white',			1, 		0 ),
					array( 'black', 		1, 		100 ),
				),
			),
		), $editor_color_palette_assoc );
	}
}

if ( ! function_exists ( 'watp_add_theme_support' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function watp_add_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'watp' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		$editor_color_palette_assoc = watp_get_editor_color_palette_assoc();
		add_theme_support( 'editor-color-palette', array_values( $editor_color_palette_assoc ) );

		/**
		 * Example: Add editor-gradient-presets and inline style for generic css classes.
		 * Configure them in function watp_get_editor_gradient_presets
		 */
		/*
		$editor_gradient_presets = watp_get_editor_gradient_presets( $editor_color_palette_assoc );
		add_theme_support( 'editor-gradient-presets', $editor_gradient_presets );
		add_action( is_admin() ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts', function() use ( $editor_gradient_presets ) {
			wp_add_inline_style(
				is_admin() ? 'watp_editor' : 'watp_frontend',
				Color::build_gradient_presets_css( $editor_gradient_presets )
			);
		}, 20 );
		*/

		// Add Support For Block Editor Alignments
		// https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
		add_theme_support( 'align-wide' );
		add_theme_support( 'align-full' );

		// Check and setup theme default settings.
		watp_setup_theme_default_settings();

		/**
		 * Filter Waterproof__waterproof-webdesign-info_wp-theme custom-header support arguments.
		 *
		 * @param array $args {
		 *     An array of custom-header support arguments.
		 *
		 *     @type string $default-image          Default image of the header.
		 *     @type string $default_text_color     Default color of the header text.
		 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
		 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
		 *     @type string $wp-head-callback       Callback function used to styles the header image and text
		 *                                          displayed on the blog.
		 *     @type string $flex-height            Flex support for height of header.
		 * }
		 */
		add_theme_support(
			'custom-header',
			apply_filters(
				'watp_custom_header_args',
				array(
					'default-image' => watp\Watp::get_instance()->dir_url . '/images/header.jpg',
					'width'         => 2000,
					'height'        => 300,
					'flex-height'   => true,
					'header-text'	=> false,
				)
			)
		);

		register_default_headers(
			array(
				'default-image' => array(
					'url'           => '%s/images/header.jpg',
					'thumbnail_url' => '%s/images/header.jpg',
					'description'   => __( 'Default Header Image', 'watp' ),
				),
			)
		);

	}
}

add_action( 'after_setup_theme', 'watp_add_theme_support' );
