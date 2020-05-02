<?php
/**
 * Single post partial template.
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
		// echo get_the_post_thumbnail( $post->ID, 'large' );
	?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'watp' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<div class="entry-footer">

		<?php watp_entry_footer(); ?>

	</div><!-- .entry-footer -->

</article><!-- #post-## -->
