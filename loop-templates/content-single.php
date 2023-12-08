
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-met">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</div><!-- .entry-header -->

	<?php 
	if(fw_theme_mod('fw_blog_featured_switch')){
		echo get_the_post_thumbnail( $post->ID, 'large' );
	}
	?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'fastway' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

	<?php 
	if(fw_theme_mod('fw_blog_footer_switch')){
		understrap_entry_footer();
	}
	?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
