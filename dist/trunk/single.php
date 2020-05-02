<?php
/**
 * The template for displaying all single posts.
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'watp_container_type' );
?>

<main class="site-main my-3" id="main">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">


		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template_parts/loop/content', 'single' ); ?>

			<?php watp_post_nav(); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</main><!-- #main -->


<?php get_footer(); ?>
