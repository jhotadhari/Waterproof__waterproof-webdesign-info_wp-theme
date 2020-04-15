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
?>

<footer id="colophon" class="site-footer <?php echo esc_attr( $container ); ?>">

	<div class="site-info">

		<?php watp_site_info(); ?>

	</div><!-- .site-info -->

</footer><!-- #colophon -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
