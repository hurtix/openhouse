<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package openhouse
 */

?>
<div class="bg-[var(--dark)] h-[35vh]">
    <div class="container mx-auto flex justify-center items-start h-full flex-col pt-20 text-white px-4 md:px-0">
        <h2 class="font-bold text-4xl"><?php the_title(); ?></h2>
        <p>Explora nuestra selección de proyectos destacados y encuentra el lugar ideal para vivir, trabajar o invertir.</p>
    </div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class('py-16 md:py-32 px-4 md:px-0'); ?>>

	<!-- <header class="entry-header">
		<?php
		// if ( ! is_front_page() ) {
		// 	the_title( '<h1 class="entry-title">', '</h1>' );
		// } else {
		// 	the_title( '<h2 class="entry-title">', '</h2>' );
		// }
		?>
	</header> -->

	<?php openhouse_post_thumbnail(); ?>

	<div <?php openhouse_content_class( 'entry-content' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages:', 'openhouse' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						__( 'Edit <span class="sr-only">%s</span>', 'openhouse' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
