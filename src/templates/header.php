<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'watp_container_type' );

$custom_header = get_custom_header();
$header_width = $custom_header && property_exists( $custom_header, 'width' ) ? $custom_header->width : 1200;
$header_height = $custom_header && property_exists( $custom_header, 'height' ) ? $custom_header->height : 400;
$header_image_class = 'header-image';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<header>

		<div
			id="wrapper-header-image"
		>
			<div class="header-image-overlay">
				<div class="header-image-overlay-mountains"></div>
				<div class="header-image-overlay-trees"></div>
			</div>

			<?php if ( has_custom_header() ) : ?>
				<img
					class="<?php echo $header_image_class; ?>"
					src="<?php header_image(); ?>"
					height="<?php echo $header_height; ?>"
					width="<?php echo $header_width; ?>"
					alt=""
				/>
			<?php endif; ?>

		</div><!-- #wrapper-header-image end -->

		<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'watp' ); ?></a>

			<nav class="navbar navbar-expand-md navbar-dark">

				<div class="<?php echo 'container' === $container ? 'container' : 'd-flex'; ?> w-100">


					<!-- Your site title as branding in the menu -->
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?><!-- end custom logo -->


					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'watp' ); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse ',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new watp\WP_Bootstrap_Navwalker(),
						)
					); ?>

				</div>

			</nav><!-- .site-navigation -->

		</div><!-- #wrapper-navbar end -->

		<div
			id="wrapper-header-meta"
			class="header-meta bg-primary p-2"
		>
			<div
				class="d-flex <?php echo 'container' === $container ? 'container' : ''; ?>"
			>
				<?php echo get_search_form( true ); ?>
			</div>
		</div>


	</header>
