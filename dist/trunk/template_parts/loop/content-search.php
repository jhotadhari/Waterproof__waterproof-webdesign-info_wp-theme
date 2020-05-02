<?php
/**
 * Search results partial template.
 *
 * @package Waterproof__waterproof-webdesign-info_wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-header">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">

				<?php watp_posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

	</div><!-- .entry-header -->

	<div class="entry-summary">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<div class="entry-footer">

		<?php watp_entry_footer(); ?>

	</div><!-- .entry-footer -->

</article><!-- #post-## -->
