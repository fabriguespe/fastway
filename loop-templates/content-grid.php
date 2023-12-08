<?php

if(fw_theme_mod('fw_blog_columns')==2)$clase="col-md-6";
else if(fw_theme_mod('fw_blog_columns')==3)$clase="col-md-4";
else if(fw_theme_mod('fw_blog_columns')==4)$clase="col-md-3";
else if(fw_theme_mod('fw_blog_columns')==5)$clase="col-md-2";
if(fw_theme_mod('fw_blog_columns')==2)$clase="col-md-6";
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
$image_url = $image[0];
?>
<li class="fw_post_loop <?php echo $clase;?> col-sm-6"  id="post-<?php the_ID(); ?>">
    <a href="<?php echo esc_url( get_permalink($post->ID) )?>">
        <div class="loopimg_container"><img src="<?php echo $image_url; ?>" /></div>
        <h2 class="blog_title"><?php  the_title();?></h4>
        <p class="desc"><?php the_excerpt(); ?></p>
        <a class="vermas" target="_blank"><?php echo fw_theme_mod('fw_label_read_more')?> </a>
    </a>
</li>
