<?php

add_action( 'vc_before_init', 'vc_blog_carousel' );
function vc_blog_carousel() {
  vc_map( 
            array(
                'name' => __('FW Blog Carousel', 'fastway'),
                'base' => 'fw_blog_carousel',
                'description' => __('FW Blog Carousel', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',
                'params' => get_slider_fields_blog(),
            )
        );          
}

function get_slider_fields_blog(){
    return array(
          array(
              'type' => 'textfield',
              'heading' => __( 'Title', 'fastway' ),
              'param_name' => 'title',
              'value' => 'Title',
              'std' => 'Title',
              'admin_label' => true,
              'weight' => 0,
          ), 
          array(
              'type' => 'textfield',
              'heading' => __( 'Prods per row ', 'fastway' ),
              'param_name' => 'prodsperrow',
              'value' => '4',
              'std' => '4',
              'admin_label' => false,
              'weight' => 0,
          ),
          array(
              'type' => 'textfield',
              'heading' => __( 'Max Quantiy', 'fastway' ),
              'param_name' => 'maxcant',
              'value' => '12',
              'std' => '12',
              'admin_label' => false,
              'weight' => 0,
          ), 
          /*
          array(
              'type' => 'checkbox',
              'heading' => __( 'Hide Uncategorized ', 'fastway' ),
              'param_name' => 'uncategorized',
              'std' => 'true',
              'admin_label' => false,
          ), */
          array(
              "type" => 'checkbox',
              "heading"     => "Autoplay ",
              "param_name"  => "autoplay",
              'std' => 'true',
          ),
          array(
              "type" => 'checkbox',
              "heading"     => "Loop",
              "param_name"  => "loop",
              'std' => 'true',
          ),
          array(
              'type' => 'el_id',
              'heading' => __( 'Element ID', 'js_composer' ),
              'param_name' => 'el_id',
              'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
          ),
          array(
              'type' => 'textfield',
              'heading' => __( 'Extra class name', 'js_composer' ),
              'param_name' => 'el_class',
              'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
          ),   
          array(
              'type' => 'css_editor',
              'heading' => __( 'CSS box', 'js_composer' ),
              'param_name' => 'css',
              'group' => __( 'Design Options', 'js_composer' ),
          ),
    );
}


add_shortcode( 'fw_blog_carousel', 'fw_blog_carousel' ); 
function fw_blog_carousel( $atts, $content ) {
    $rand=generateRandomString(5);
    $atts = shortcode_atts(
        array(
            'loop'      =>  'false',
            'slider_speed'  => '250',
            'slider_delay'  => '4000',
            'autoplay'  => 'false',
            'maxcant' => '12',
            'el_class'  => '',
            'title'  => '',
            'prodsperrow' => 4,
        ), $atts );
    if(!$atts['loop'])$atts['loop']='false';
    if(!$atts['autoplay'])$atts['autoplay']='false';
    //Desktop
    
    ob_start();
    $posts = new WP_Query('showposts='.$atts['maxcant']);
    fw_get_template('fw-blog-posts-carousel.php',$atts,$posts);
		
    return ob_get_clean();
		
}   

?>