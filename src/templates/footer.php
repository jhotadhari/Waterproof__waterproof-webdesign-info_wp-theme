<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'watp_container_type' );
$container = strlen( $container ) > 0 ? $container . '-fluid' : '';
?>

<footer id="colophon" class="site-footer">
	<div class="site-footer-inner <?php echo esc_attr( $container ); ?>">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'depth'          => 1,
				'fallback_cb'    => false
			) ); ?>
			</nav><!-- .footer-navigation -->
		<?php endif; ?>

		<div class="site-info">
			<?php watp_site_info(); ?>
		</div><!-- .site-info -->
	</div>

</footer><!-- #colophon -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
