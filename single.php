<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = fw_theme_mod('container-main');
?>
<div class="wrapper post_page" id="single-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row">
			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<main class="site-main" id="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'loop-templates/content', 'single' ); ?>
						<?php understrap_post_nav(); ?>
					<?php
					
					if(fw_theme_mod('fw_blog_comment_switch')){
						//if ( comments_open() || get_comments_number() ) :
							comments_template();
						//endif;
					}
					?>
				<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
	</div><!-- .row -->
</div><!-- Container end -->
</div><!-- Wrapper end -->
<?php get_footer(); ?>
