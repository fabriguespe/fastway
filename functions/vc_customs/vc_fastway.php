<?php

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));

vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Columns Inside",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "100%" => "one_mobile_columns",
        "50%" => "two_mobile_columns",
        "33%" => "three_mobile_columns",
        "25%" => "four_mobile_columns",
    )
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Has a FW Slider In It? (Only in full width no paddings row)",
    "param_name" => "fw_swiper",
    "value" => array(
        "Select an option" => "",
        "Yes" => "fw_swiper",
    )
));
vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Columns Inside",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "100%" => "one_mobile_columns",
        "50%" => "two_mobile_columns",
        "33%" => "three_mobile_columns",
        "25%" => "four_mobile_columns",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Column In Mobile",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "100%" => "full_mobile",
        "50%" => "onehalf_mobile",
        "33%" => "onethird_mobile",
        "25%" => "onefourth_mobile",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Margin in Mobile",
    "param_name" => "fw_columns_margin",
    "value" => array(
        "Select an option" => "",
        "Top" => "withtopmargin",
        "Bottom" => "withbottommargin",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Is Flex?",
    "param_name" => "fw_is_flex",
    "value" => array(
        "Select an option" => "",
        "Flex" => "is_flex",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Is Flex?",
    "param_name" => "fw_is_flex",
    "value" => array(
        "Select an option" => "",
        "Flex" => "is_flex",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Margin in Mobile",
    "param_name" => "fw_columns_margin",
    "value" => array(
        "Select an option" => "",
        "Top" => "withtopmargin",
        "Bottom" => "withbottommargin",
    )
));
vc_add_param("vc_column_inner", 
    array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Column In Mobile",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "100%" => "full_mobile",
        "50%" => "onehalf_mobile",
        "33%" => "onethird_mobile",
        "25%" => "onefourth_mobile",
    )
));


add_action( 'vc_before_init', 'vc_fw_review_carousel' );
function vc_fw_review_carousel() {
  vc_map( 
        array(
            'name' => __('FW Reviews', 'fastway'),
            'base' => 'fw_review_carousel',
            'description' => __('FW Reviews', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
            'params' => array(
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
                    'heading' => __( 'Cols', 'fastway' ),
                    'param_name' => 'prodsperrow',
                    'value' => '4',
                    'std' => '4',
                    'admin_label' => false,
                    'weight' => 0,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Space', 'fastway' ),
                    'param_name' => 'space',
                    'value' => '10',
                    'std' => '10',
                    'admin_label' => false,
                    'weight' => 0,
                ),
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
                    'type' => 'textfield',
                    'heading' => __( 'Delay', 'js_composer' ),
                    'param_name' => 'slider_delay',
                    'description' => __( 'Delay in miliseconds', 'js_composer' ),
                    'std' => '4000',
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
            )
        )
    );
}


add_action( 'vc_before_init', 'fw_carousel' );
function fw_carousel() {
  vc_map( 
        array(
            'name' => __('FW Image Carousel', 'fastway'),
            'base' => 'fw_carousel_function',
            'description' => __('Image Carousel', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
            'params' => array(
                array(
                    "type"        => "attach_images",
                    "heading"     => "Imagenes",
                    "param_name"  => "slides_desktop",
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Links (separados con ,)"),
                    "param_name"  => "links_desktop",
                ),
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
                    'heading' => __( 'Cols', 'fastway' ),
                    'param_name' => 'prodsperrow',
                    'value' => '1',
                    'std' => '1',
                    'admin_label' => false,
                    'weight' => 0,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Space', 'fastway' ),
                    'param_name' => 'space',
                    'value' => '10',
                    'std' => '10',
                    'admin_label' => false,
                    'weight' => 0,
                ),
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
                    'type' => 'textfield',
                    'heading' => __( 'Delay', 'js_composer' ),
                    'param_name' => 'slider_delay',
                    'description' => __( 'Delay in miliseconds', 'js_composer' ),
                    'std' => '4000',
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
            )
        )
    );
}

add_action( 'vc_before_init', 'vc_fw_empty_space' );
function vc_fw_empty_space() {
    // Title
    vc_map(
        array(
            'name' => __( 'FW Space' ),
            'base' => 'fw_empty_space',
            'description' => __('FW Space', 'fastway'), 
            'category' => __('Fastway', 'fastway'), 
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',  
            'params' => array(
                
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Size"),
                    "param_name"  => "height",
                    "value" => array(
                        "X Large (Casos raros)" =>"220px"  ,
                        "Large (Casos raros)" =>"120px"  ,
                        "Medium (Para separar filas)" =>"64px"  ,
                        "Small (Para dentro de filas)" =>"32px"  ,
                        "X Small (Para otros casos mas pequeños)" =>"16px"  ,
                    ),
                    'admin_label' => true,
                    "std" => '64px', //Default Red color
                ),
            )
    
        )
    );
}


add_shortcode('fw_info_block','fw_info_block');
function fw_info_block($atts,$content){
    $atts = shortcode_atts(
    array(
        'icon'      =>  '',
        'title'      =>  '',
        'subtitle'      =>  '',
        'desc'      =>  '',
        'code'      =>  '',
    ), $atts );

    $code=do_shortcode(rawurldecode( base64_decode( $atts['code'] ) ));
    $jaja = '<div class="capsula-blanca"><i class="fad fa-'.$atts['icon'].'" aria-hidden="true"></i><h2>'.$atts['title'].'</h2><h3>'.$atts['subtitle'].'</h3><div class="specs">'.$atts['desc'].'</div>';
    $jaja.= '<div class="specs">'.$code.'</div>';
    $jaja.= '</div>';

    return $jaja;
}
add_action( 'vc_before_init', 'vc_fw_info_block' );
function vc_fw_info_block() {
    // Title
    vc_map(
        array(
            'name' => __( 'FW Info Block' ),
            'base' => 'fw_info_block',
            'description' => __('FW Info Block', 'fastway'), 
            'category' => __('Fastway', 'fastway'), 
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',  
            'params' => array(
                array(
                    "type" => 'textfield',
                    "heading"     => __("Icon"),
                    "param_name"  => "icon",
                    'admin_label' => true,
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Title"),
                    "param_name"  => "title",
                    'admin_label' => true,
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Big text"),
                    "param_name"  => "subtitle",
                    'admin_label' => true,
                ),
                array(
                    "type" => 'textarea',
                    "heading"     => __("Small text desc + html"),
                    "param_name"  => "desc",
                    'admin_label' => true,
                ),

                array(
                    "type" => 'textarea_raw_html',
                    "heading"     => __("Extra Code"),
                    "param_name"  => "code",
                    'admin_label' => true,
                ),

                )
            )
        );
}
    
add_action( 'vc_before_init', 'fw_slider' );
function fw_slider() {
    // Title
    vc_map(
        array(
            'name' => __( 'FW Image Slider' ),
            'base' => 'fw_slider_function',
            'description' => __('FW Image Slider', 'fastway'), 
            'category' => __('Fastway', 'fastway'), 
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',  
            'params' => array(
                array(
                    "type"        => "attach_images",
                    "heading"     => __("Desktop",'fastway'),
                    "param_name"  => "slides_desktop",
                    'description' => __( '1600 recommended width in PX', 'js_composer' ),
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Links (separated with ,)"),
                    "param_name"  => "links_desktop",
                ),
                array(
                    "type"        => "attach_images",
                    "heading"     => __("Mobile",'fastway'),
                    'description' => __( '600x275 recomended', 'js_composer' ),
                    "param_name"  => "slides_mobile",
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Links (separated with ,)",'fastway'),
                    "param_name"  => "links_mobile",
                ),
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
                    'std' => 'false',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Delay', 'js_composer' ),
                    'param_name' => 'slider_delay',
                    'description' => __( 'Delay in miliseconds', 'js_composer' ),
                    'std' => '4000',
                ),  
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Speed', 'js_composer' ),
                    'param_name' => 'slider_speed',
                    'description' => __( 'Speed in seconds, for transtitions', 'js_composer' ),
                    'std' => '4',
                ),  
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                ),  

            )

        )
    );
}

add_action( 'vc_before_init', 'fw_image' );
function fw_image() {
    // Title

    $static_block_args = fastway_get_stblock();
    $static_block_args=array_merge(array("Select an option" => "",),$static_block_args);
    vc_map(
        array(
            'name' => __( 'FW Image' ),
            'base' => 'fw_image_function',
            'description' => __('FW Image', 'fastway'), 
            'category' => __('Fastway', 'fastway'), 
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',  
            'params' => array(
                array(
                    "type"        => "attach_image",
                    "heading"     => "Imagen normal",
                    "param_name"  => "image",
                    "value"       => "",
                    'dependency' => array(
                        'element' => 'source',
                        'value' => 'media_library',
                    ),
                    'admin_label' => true,
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Size Desktop"),
                    "param_name"  => "size_desktop",
                    "value"       => "100% auto",
                    'description' => 'width height (100% 100% or auto auto)'
                ),
                array(
                    "type"        => "attach_image",
                    "heading"     => "Imagenes Mobile",
                    'description' => __( 'If empty, shows desktop, if not , priorizes mobile image', 'js_composer' ),
                    "param_name"  => "image_mobile",
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Size Mobile"),
                    "param_name"  => "size_mobile",
                    "value"       => "100% auto",
                    'description' => 'width height (100% 100% or auto auto)'
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Link Type"),
                    "param_name"  => "link_type",
                    "value" => array(
                        "Misma ventana" => "_self",
                        "Nueva pestaña" =>"_blank" ,
                    ),
                    "std" => '_self', //Default Red color
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Link"),
                    "param_name"  => "link",
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Text Type"),
                    "param_name"  => "text_type",
                    "value" => array(
                        "Encima de la imagen" => "floating",
                        "Abajo de la imagen" =>"below" ,
                    ),
                    "std" => 'floating', //Default Red color
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Title"),
                    "param_name"  => "title",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Sub Title"),
                    "param_name"  => "subtitle",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => __("Select Block"),
                    "param_name"  => "sblock",
                    "value"       => $static_block_args,
                    "std"         => " ",
                    'description' => "Verificar fila del block este en Predeterminado de ancho"
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                ),  

            )
        )
    );
}


add_shortcode( 'fw_carousel_function', 'fw_carousel_function' ); 
function fw_carousel_function( $atts, $content ) {
    $rand=generateRandomString(5);
    $atts = shortcode_atts(
        array(
            'slides_desktop'      =>  '',
            'links_desktop'      =>  '',
            'slider_speed'  => '250',
            'slider_delay'  => '4000',
            'prodsperrow'  => '4',
            'space'  => '10',
            'autoplay'  => 'true',
            'loop'  => 'true',
            'el_id'  => '',
            'el_class'  => ''
        ), $atts );
    //Desktop
    $image_ids = explode(',',$atts['slides_desktop']);
    $return='';
    $links = explode(',',$atts['links_desktop']);
    $return = '
    <div id="swiper-fwslider-'.$rand.'" class="swiper-fwslider-'.$rand.' '.$atts['el_class'].'  over-hidden relative" >
    <div class="swiper-wrapper clear-ul">';
    $cant=0;
    foreach( $image_ids as $image_id ){
        $images = wp_get_attachment_image_src( $image_id, '' );
        $link=$links[$cant];
        $image=$images[0];
        if(!$link)$link="#";
        $return .= '<div class="swiper-slide fwslider" data-swiper-autoplay="'.$atts['slider_delay'].'" style="width:100% !important;"> ';
        $return .= '<a href="'.$link.'" ><div class="item product-category">';
        $return .= '<img src="'.$image.'" width="100%"  height="auto"/>';
        $return .= '</div></a></div>';    
        $cant++;
    }
    $return .='</div>';
    $return .='<div class="swiper-prev swiper-fwslider-'.$rand.'-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-fwslider-'.$rand.'-next"><i class="fa fa-angle-right"></i></div>';
    $return .='</div>
    <script>
    var ProductSwiper2 = new Swiper(\'.swiper-fwslider-'.$rand.'\', {
        navigation: {
            nextEl: \'.swiper-fwslider-'.$rand.'-next\',
            prevEl: \'.swiper-fwslider-'.$rand.'-prev\',
        }, 
        slidesPerView: '.$atts['prodsperrow'].',
        slidesPerGroup: 1,
        paginationClickable: true,
        preventClicks: false,
        preventClicksPropagation: false,
        spaceBetween: 80,
        loop: '.$atts['loop'].',
        touchRatio: 0 ,
        autoplay: '.$atts['autoplay'].',
        autoplayDisableOnInteraction: false,
        breakpoints: {
        // when window width is <= 320px
            900:    {slidesPerView: 2,slidesPerGroup:2},
            1000:   {slidesPerView: 3,slidesPerGroup:3},            
            1200:    {slidesPerView: 4,slidesPerGroup:4}
        }
    });
    </script>';
    return $return;
}   

add_shortcode( 'fw_empty_space', 'fw_empty_space' ); 
function fw_empty_space( $atts, $content ) {
    $atts = shortcode_atts(array('height'      =>  '64px'), $atts );
    
    return '<div class="vc_empty_space" style="height: '.$atts['height'].'"><span class="vc_empty_space_inner"></span></div>';

}

add_shortcode( 'fw_slider_function', 'fw_slider_function' ); 
function fw_slider_function( $atts, $content ) {
    $rand=generateRandomString(5);
    $atts = shortcode_atts(
        array(
            'slides_desktop'      =>  '',
            'links_desktop'      =>  '',
            'slides_mobile'      =>  '',
            'links_mobile'      =>  '',
            'slider_speed'  => '250',
            'slider_delay'  => '4000',
            'autoplay'  => 'true',
            'loop'  => 'false',
            'el_id'  => '',
            'el_class'  => ''
        ), $atts );
    if(!$atts['loop'])$atts['loop']='false';
    if(!$atts['autoplay'])$atts['autoplay']='false';
    //Desktop
    $image_ids = explode(',',$atts['slides_desktop']);
    $claserespo=' d-none d-md-block ';
    $tiene_mobile_images=!empty($atts['slides_mobile']);
    if(!$tiene_mobile_images)$claserespo=' ';
    $return='';

    if(!wp_is_mobile() || (!$tiene_mobile_images && wp_is_mobile()) || is_user_logged_in()){
        $links = explode(',',$atts['links_desktop']);
        $return = '
        <div id="swiper-fwslider-'.$rand.'" class="swiper-fwslider-'.$rand.'  '.$claserespo.' '.$atts['el_class'].'  over-hidden relative" >
        <div class="swiper-wrapper clear-ul">';
        $cant=0;
        foreach( $image_ids as $image_id ){
            $images = wp_get_attachment_image_src( $image_id, '' );
            $link=$links[$cant];
            $image=$images[0];
            if(!$link)$link="#";
            $return .= '<div class="swiper-slide fwslider" data-swiper-autoplay="'.$atts['slider_delay'].'" style="width:100% !important;"> ';
            $return .= '<a href="'.$link.'" ><div class="item product-category">';
            $return .= '<img src="'.$image.'" width="100%"  height="auto"/>';
            $return .= '</div></a></div>';    
            $cant++;
        }
        $return .='</div>';
        if($cant>1){
            $return .='<div class="swiper-prev swiper-fwslider-'.$rand.'-prev"><i class="fa fa-angle-left"></i></div>
            <div class="swiper-next swiper-fwslider-'.$rand.'-next"><i class="fa fa-angle-right"></i></div>';
        }
        $return .='</div>
        <script>
        var swiper_desktop = new Swiper("#swiper-fwslider-'.$rand.'", {
            slidesPerView: 1,
            spaceBetween: 0,
            touchRatio: 0 ,
            preventClicks: false,
            preventClicksPropagation: false,
            centeredSlides: true ,
            loop: '.$atts['loop'].',
            autoplay: '.$atts['autoplay'].',
            speed:'.$atts['slider_speed'].',
            navigation: {
            nextEl: ".swiper-fwslider-'.$rand.'-next",
            prevEl: ".swiper-fwslider-'.$rand.'-prev",
            }
        });
        </script>';
    }
    if((!$tiene_mobile_images || !wp_is_mobile()) && !is_user_logged_in())return $return;
    //Mobile
    $rand=generateRandomString(5);
    $image_ids = explode(',',$atts['slides_mobile'])?explode(',',$atts['slides_mobile']):$image_ids;
    $links = explode(',',$atts['links_mobile']);
    $cant=0;
    $return .= '
    <div class="swiper-fwslider-'.$rand.' d-md-none   over-hidden relative">
    <div class="swiper-wrapper clear-ul">';
    foreach( $image_ids as $image_id ){
        $images = wp_get_attachment_image_src( $image_id, '' );
        $link=$links[$cant];
        $image=$images[0];
        $return .= '<div class="swiper-slide data-swiper-autoplay="'.$atts['slider_delay'].'">';
        $return .= '<a href="'.$link.'" ><div class="item">';
        $return .= '<img src="'.$image.'" width="100%"  height="auto"/>';
        $return .= '</div></a></div>';    
        $cant++;
    }
    $return .='</div>';
    if($cant>1){
        $return .='<div class="swiper-prev swiper-fwslider-'.$rand.'-prev"><i class="fa fa-angle-left"></i></div>
        <div class="swiper-next swiper-fwslider-'.$rand.'-next"><i class="fa fa-angle-right"></i></div>';
    }
    $return .='</div>
    <script>
    var swiper_mobile = new Swiper(".swiper-fwslider-'.$rand.'", {
        slidesPerView: 1,
        spaceBetween: 30,
        touchRatio: 0 ,
        preventClicks: false,
        preventClicksPropagation: false,
        loop: '.$atts['loop'].',
        autoplay: '.$atts['autoplay'].',
        speed:'.$atts['slider_speed'].',
        navigation: {
          nextEl: ".swiper-fwslider-'.$rand.'-next",
          prevEl: ".swiper-fwslider-'.$rand.'-prev",
        }
    });
    </script>';
    return $return;
}   



add_shortcode( 'fw_image_function', 'fw_image_function' ); 
function fw_image_function( $atts, $content ) {
 
    $atts = shortcode_atts(
        array(
            'image'      =>  '',
            'link'      =>  '',
            'sblock'      =>  '',
            'text_type'      =>  'floating',
            'link_type'      =>  '_self',
            'title'      =>  '',
            'subtitle'      =>  '',
            'image_mobile'      =>  '',
            'el_class'  => '',
            'size'  => '',
            'size_desktop'      =>  '100% auto',
            'size_mobile'      =>  '100% auto',
        ), $atts );
        
    //Desktop
    $h_desktop=explode(' ',$atts['size_desktop'])[1];
    $w_desktop=explode(' ',$atts['size_desktop'])[0];
    $h_mobile=explode(' ',$atts['size_mobile'])[1];
    $w_mobile=explode(' ',$atts['size_mobile'])[0];
    if($atts['size'] && $atts['size']!='100% auto'){//old fix
        $h_desktop=explode(' ',$atts['size'])[1];
        $w_desktop=explode(' ',$atts['size'])[0];
        $h_mobile=explode(' ',$atts['size'])[1];
        $w_mobile=explode(' ',$atts['size'])[0];
    }

    $image = wp_get_attachment_image_src( $atts['image'], '' )[0];
    $image_mobile = wp_get_attachment_image_src( $atts['image_mobile'], '' )[0];
    $claserespo=' d-none d-md-block ';
    $ismobile=!empty($atts['image_mobile']);

    if(!$ismobile)$claserespo=' ';
    $link = $atts['link'];
    if($link)$return .= '<a class="fw_image_container '.$claserespo.' '.$atts['el_class'].'" target="'.$atts['link_type'].'" style="text-align:center" href="'.$link.'" >';
    else $return .= '<div class="fw_image_container '.$claserespo.' '.$atts['el_class'].'" style="text-align:center" >';
    $return .= '<div class="imagen"><img src="'.$image.'" style="max-width:100%;width:'.$w_desktop.';height:'.$h_desktop.';"/></div>';   
    if($atts['title'])$return .= '<div class="texts '.$atts['text_type'].'"><div class="title">'.$atts['title'].'</div><div class="subtitle">'.$atts['subtitle'].'</div></div>';
    if($link)$return .= '</a>';
    else $return .= '</div>'; 
    if($ismobile){
        if($link)$return .= '<a class="fw_image_container d-md-none '.$atts['el_class'].'" target="'.$atts['link_type'].'" style="text-align:center" href="'.$link.'" >';
        else $return .= '<div class="fw_image_container d-md-none '.$atts['el_class'].'" style="text-align:center" >';
        $return .= '<div class="imagen"><img src="'.$image_mobile.'" style="max-width:100%;width:'.$w_mobile.' ;height:'.$h_mobile.';"/></div>';   
        if($atts['title'])$return .= '<div class="texts '.$atts['text_type'].'"><div class="title">'.$atts['title'].'</div><div class="subtitle">'.$atts['subtitle'].'</div></div>';
        if($link)$return .= '</a>';
        else $return .= '</div>'; 
    }
    
    //Implementar acciones
    if(!empty($atts['sblock'])){
        $return='<a target="'.$atts['link_type'].'" data-toggle="modal" data-target="#'.$atts['sblock'].'" class="fancybox">'.$return;
        $return.= "</a>".fw_modal_block($atts['sblock'],$atts['sblock']);
    }else if(!empty($atts['iframe'] )){
        $rand=generateRandomString();
        $return='<a target="'.$atts['link_type'].'" data-toggle="modal" data-target="#'.$rand.'" class="fw_icon_link fancybox">'.$return;
        $return.= "</a>".fw_modal_block($rand,$atts['iframe'],true);
    }else if(!empty($atts['modal'] )){
        $return='<a target="'.$atts['link_type'].'" data-toggle="modal" data-target="#'.$atts['modal'].'" class="fw_icon_link fancybox">'.$return;
        $return.= "</a>";
    }
    
    return $return;
}   


add_action( 'vc_before_init', 'vc_static_block' );//Prds de categoria
function vc_static_block() {

    $static_block_args = fastway_get_stblock();
    $static_block_args=array_merge(array(
        "Select an option" => "",),$static_block_args);

    vc_map( array(
            "name" => __("Static Block", 'fastway'),
            'base' => 'fw_shortcode_stblock',
            'description' => __('FW Static Block', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                "params" => array(
                array(
                  "type"        => "dropdown",
                  "heading"     => __("Select Block"),
                  "param_name"  => "slug",
                  "admin_label" => true,
                  "value"       => $static_block_args,
                  "std"         => " ",
                  'description' => "Verificar fila del block este en Predeterminado de ancho"
                ),
            )
    ) );

}

add_action( 'vc_before_init', 'vc_fw_shorts' );//Prds de categoria
function vc_fw_shorts() {

    $static_block_args = fastway_get_stblock();
    $static_block_args=array_merge(array(
        "Select an option" => "",),$static_block_args);

    vc_map( array(
            "name" => __("FW Data Icon", 'fastway'),
            'base' => 'fw_data',
            'description' => __('FW Icon', 'fastway'), 
            'category' => __('Fastway Icons', 'fastway'),   
            "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                "params" => array(
                array(
                  "type" => 'textfield',
                  "heading"     => __("Type"),
                  "param_name"  => "type",
                  'description' => 'Variables: fbX,twitterX,youtubeX,whatsappX,igX,emailX,phoneX,addressX <br> 
                  FA Class: or fa-icon ,fal fa-icon<br>
                  ',
                  "admin_label" => true,
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Type"),
                    "param_name"  => "format",
                    
                    "value" => array(
                        "Select an option" => "",
                        "Icono Izq,Texto Arriba Grande y Texto Chiquito Abajo (stext)" =>"isli"  ,
                        "Icono Izq,Texto Abajo Grande y Texto Chiquito Arriba (stext)"=>"isli_i",
                        "Solo Icono/s (Separar con ,)"=>"iconsnext",
                        "Icono arriba, Texto Arriba Grande y Texto Chiquito Abajo (stext)"=>"iconbox",
                        "Icono arriba, Texto Abajo Grande y Texto Chiquito Arriba (stext)"=>"iconbox_i",
                    ),
                    "std" => '', //Default Red color
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Alignment"),
                    "param_name"  => "text_align",
                    
                    "value" => array(
                        "Left" =>"left",
                        "Center"=>"center",
                        "Right"=>"right",
                    ),
                    "std" => 'left', //Default Red color
                ),
                array(
                    "type" => 'checkbox',
                    "heading"     => "Hide Icon",
                    "param_name"  => "only_text",
                    "std"         => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => "Texto",
                    'description' => '(Por default pone company data solo)',
                    "param_name"  => "text",
                    "admin_label" => true,
                ),
                
                array(
                    "type" => 'textfield',
                    "heading"     => 'Subtext',
                    'description' => '(Por default pone company data solo (en los de icono arriba)',
                    "param_name"  => "stext",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Link"),
                    "param_name"  => "link",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Cant"),
                    "param_name"  => "cant",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("iframe"),
                    "param_name"  => "iframe",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => __("Select Block"),
                    "param_name"  => "sblock",
                    "admin_label" => true,
                    "value"       => $static_block_args,
                    "std"         => " ",
                    'description' => "Verificar fila del block este en Predeterminado de ancho"
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
                    'description' =>  'fw_page_title para los titulos de pagina' ,
                ),  
                  
                
                
            )
    ) );

}

add_action( 'vc_before_init', 'vc_social_icons' );//Prds de categoria
function vc_social_icons() {
    vc_map( array(
            "name" => __("FW Social Icons", 'fastway'),
            'base' => 'fw_social_icons',
            'description' => __('FW Social Icon', 'fastway'), 
            'category' => __('Fastway Icons', 'fastway'),   
            "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                "params" => array(
                array(
                  "type" => 'textfield',
                  "heading"     => __("Type"),
                  "param_name"  => "type",
                  'description' => 'fb,twitter,youtube,linkedin,whatsapp,ig,email,phone,address <br>
                  or fa-icon ,fal fa-icon',
                  "admin_label" => true,
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Alignment"),
                    "param_name"  => "icon_align",
                    
                    "value" => array(
                        "Left" =>"left",
                        "Center"=>"center",
                        "Right"=>"right",
                    ),
                    "std" => 'left', //Default Red color
                ),/*
                array(
                    "type" => 'textfield',
                    "heading"     => __("size"),
                    "param_name"  => "icon_size",
                    "std"  => "20",
                ),*//*
                array(
                    "type" => "textfield",
                    "heading" => __( "Icon color", "fastway" ),
                    "param_name" => "icon_color",
                    "value" => '', //Default Red color
                    "description" => __( "Choose text color", "fastway" )
                ),*/
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
                  
                
                
            )
    ) );

}


add_action( 'vc_before_init', 'vc_fw_button' );//Prds de categoria
function vc_fw_button() {
    vc_map( array(
            "name" => __("FW Button", 'fastway'),
            'base' => 'fw_btn',
            'description' => __('FW Button', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                "params" => array(

                array(
                    "type" => 'textfield',
                    "heading"     => __("Icon"),
                    "param_name"  => "icon",
                    'description' => 'Font awesome icon name: https://fontawesome.com/icons',
                    "admin_label" => true,
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Text"),
                    "param_name"  => "text",
                    "admin_label" => true,
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Type"),
                    "param_name"  => "btn_type",
                    
                    "value" => array(
                        "Primary" =>"primary",
                        "Secondary"=>"secondary"
                    ),
                    "std" => 'primary', 
                ),
                   
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Alignment"),
                    "param_name"  => "icon_align",
                    
                    "value" => array(
                        "Left" =>"left",
                        "Center"=>"center",
                        "Right"=>"right",
                    ),
                    "std" => 'center', //Default Red color
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Link Type"),
                    "param_name"  => "link_type",
                    "value" => array(
                        "Misma ventana" => "_self",
                        "Nueva pestaña" =>"_blank" ,
                    ),
                    "std" => '_self', //Default Red color
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Link"),
                    "param_name"  => "link",
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
                  
                
                
            )
    ) );

}

add_action( 'vc_before_init', 'vc_only_icon' );//Prds de categoria
function vc_only_icon() {
    vc_map( array(
            "name" => __("FW Icon Only", 'fastway'),
            'base' => 'fw_only_icon',
            'description' => __('FW Icon Only', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                "params" => array(
                array(
                  "type" => 'textfield',
                  "heading"     => __("Type"),
                  "param_name"  => "type",
                  'description' => 'Font awesome icon name: https://fontawesome.com/icons',
                  "admin_label" => true,
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Alignment"),
                    "param_name"  => "icon_align",
                    
                    "value" => array(
                        "Left" =>"left",
                        "Center"=>"center",
                        "Right"=>"right",
                    ),
                    "std" => 'center', //Default Red color
                ),/*
                array(
                    "type" => 'textfield',
                    "heading"     => __("Sie"),
                    "param_name"  => "icon_size",
                    "std"  => "50",
                ),*/
                /*
                array(
                    "type" => 'textfield',
                    "heading"     => __("Color"),
                    "param_name"  => "icon_color",
                    "std"  => "var(--main)",
                ),*/
                    
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
                  
                
                
            )
    ) );

}
// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );
 
function vc_after_init_actions() {
     
    
 
    // Add Params
    $vc_single_image_params = array(
         
        // Example
        array(
            'type' => 'textfield',
            'heading' => __( 'Image size', 'js_composer' ),
            'param_name' => 'img_size',
            'value' => 'full',
            'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'js_composer' ),
        ),  
        array(
                'type' => 'dropdown',
                'heading' => __( 'Image alignment', 'js_composer' ),
                'param_name' => 'alignment',
                'value' => array(
                    __( 'Left', 'js_composer' ) => '',
                    __( 'Right', 'js_composer' ) => 'right',
                    __( 'Center', 'js_composer' ) => 'center',
                ),
                'std'=>'center',
                'description' => __( 'Select image alignment.', 'js_composer' ),
        ),    
     
    );
    $vc_empty_space_params = array(
         
        // Example
        array(
            'type' => 'textfield',
            'heading' => __( 'Height', 'js_composer' ),
            'param_name' => 'height',
            'value' => '64px',
        ),  
        
     
    );
    $vc_row_params = array(
         
        // Example
        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'js_composer' ),
            'param_name' => 'full_width',
            'value' => array(
                __( 'Contenido y fondo boxed', 'js_composer' ) => '',
                __( 'Contenido boxed y fondo ancho', 'js_composer' ) => 'stretch_row',
                __( 'Contenido y fondo anchos (con padding)', 'js_composer' ) => 'stretch_row_content',
                __( 'Contenido y fondo full width (con padding)', 'js_composer' ) => 'stretch_row_content_no_spaces',
            ),
            'std'=>'stretch_row',
            'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property'), 
        ),
        
     
    );
     
    vc_add_params( 'vc_single_image', $vc_single_image_params ); 
    //vc_add_params( 'vc_empty_space', $vc_empty_space_params ); 
    vc_add_params( 'vc_row', $vc_row_params ); 
         
}
?>