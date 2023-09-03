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
$the_theme = wp_get_theme();
// Namensnennung, nicht kommerziell, Weitergabe unter gleichen Bedingungen
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
			<?php echo implode( '<span class="sep"> | </span>', array(
				sprintf(
					esc_html__( '%s – %s', 'watp' ),
					sprintf(
						'<a title="%s" href="%s">' . implode( '', array_map( function( $icon_var ) {
							return '<i class="fa ' . $icon_var . ' mr-1 text-body"></i>';
						}, array(
							'fa-cc-custom',
							'fa-cc-by',
							'fa-cc-nc',
							'fa-cc-sa',
						) ) ) . '%s</a>',
						sprintf(
							esc_html__( 'Creative Commons, Attribution (BY), Non-commercial (NC), Share-alike (SA), %s', 'watp' ),
							get_bloginfo('name')
						),
						get_bloginfo('url'),
						get_bloginfo('name') ),
					date('Y')
				),
				sprintf(
					'%1$s (%2$s)',
					sprintf( // WPCS: XSS ok.
						/* translators:*/
						esc_html__( 'Theme: %1$s', 'watp' ),
						sprintf( '<a href="%s">%s</a>', 'https://github.com/jhotadhari/Waterproof__waterproof-webdesign-info_wp-theme', $the_theme->get( 'Name' ) )
					),
					sprintf( // WPCS: XSS ok.
						/* translators:*/
						esc_html__( 'Version: %1$s', 'watp' ),
						$the_theme->get( 'Version' )
					)
				),
			) ); ?>
		</div><!-- .site-info -->

		<div class="site-info">
			<?php echo sprintf(
				'<a href="%1$s">%2$s</a><span class="sep">',
				esc_url( __( 'http://wordpress.org/', 'watp' ) ),
				sprintf(
					/* translators:*/
					esc_html__( 'Proudly powered by %s', 'watp' ),
					'WordPress'
				)
			); ?>
		</div><!-- .site-info -->
	</div>

</footer><!-- #colophon -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
