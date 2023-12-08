<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="fw_post_loop vertical row d-flex flex-row" >
            <div class="col-xs-12 col-sm-3 foto">
                  <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
            </div>
            <div class="col-xs-12 col-sm-9">
                  <h4 class="title"><?php  the_title();?></h4>
                  <p class="desc"><?php the_excerpt(); ?></p>
                  <a href="<?php echo get_permalink()?>" class="vermas" target="_blank">Leer más</a>
            </div>
        </div>

</article><!-- #post-## -->
