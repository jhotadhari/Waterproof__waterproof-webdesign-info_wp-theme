<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

		<?php if ( have_posts() ) : ?>

			<div class="page-header">
				<?php
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template_parts/loop/content', get_post_format() );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'template_parts/loop/content', 'none' ); ?>

		<?php endif; ?>


		<!-- The pagination component -->
		<?php watp_pagination(); ?>

	</div><!-- #content -->

</main><!-- #main -->

<?php get_footer(); ?>
