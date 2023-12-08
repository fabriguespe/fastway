<?php

vc_add_shortcode_param( 'dropdown_multi', 'dropdown_multi_settings_field' );
function dropdown_multi_settings_field( $param, $value ) {
   $param_line = '';
   $param_line .= '<select multiple name="'. esc_attr( $param['param_name'] ).'" class="wpb_vc_param_value wpb-input wpb-select '. esc_attr( $param['param_name'] ).' '. esc_attr($param['type']).'">';
   foreach ( $param['value'] as $text_val => $val ) {
       if ( is_numeric($text_val) && (is_string($val) || is_numeric($val)) ) {
                    $text_val = $val;
                }
                $text_val = __($text_val, "js_composer");
                $selected = '';

                if(!is_array($value)) {
                    $param_value_arr = explode(',',$value);
                } else {
                    $param_value_arr = $value;
                }

                if ($value!=='' && in_array($val, $param_value_arr)) {
                    $selected = ' selected="selected"';
                }
                $param_line .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
            }
   $param_line .= '</select>';

   return  $param_line;
}




add_action( 'vc_before_init', 'vc_category_carousel' );//Prds de categoria
function vc_category_carousel() {

    vc_map( 
            array(
                'name' => __('Products by Category Carousel', 'fastway'),
                'base' => 'fw_category_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
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
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Categories', 'fastway' ),
                        'param_name' => 'category',
                        'weight' => 0,
                         "admin_label" => true,
                        'value'=>fw_vc_get_posts("product_cat"),
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
                        "type" => 'checkbox',
                        "heading"     => "Hide out of stock",
                        "param_name"  => "hideoutofstock",
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
                        'type' => 'textfield',
                        'heading' => __( 'Speed', 'js_composer' ),
                        'param_name' => 'slider_speed',
                        'description' => __( 'Speed in seconds, for transtitions', 'js_composer' ),
                        'std' => '4',
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
                ),
            )

            
        );          

}


add_action( 'vc_before_init', 'vc_products_by_brand_carousel' );//Prds de categoria
function vc_products_by_brand_carousel() {

    vc_map( 
            array(
                'name' => __('Products by Brand Carousel', 'fastway'),
                'base' => 'vc_products_by_brand_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
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
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Brands', 'fastway' ),
                        'param_name' => 'brand',
                        'weight' => 0,
                        "admin_label" => true,
                        'value'=>fw_vc_get_posts("brand"),
                    ), 
                    array(
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Categories', 'fastway' ),
                        'param_name' => 'category',
                        'weight' => 0,
                         "admin_label" => true,
                        'value'=>fw_vc_get_posts("product_cat"),
                    ), 
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Hide Uncategorized ', 'fastway' ),
                        'param_name' => 'uncategorized',
                        'std' => 'true',
                        'admin_label' => false,
                    ), 
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Slider', 'fastway' ),
                        'param_name' => 'slider',
                        'std' => 'true',
                        'admin_label' => false,
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
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
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
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}

add_action( 'vc_before_init', 'vc_products_by_tags_carousel' );//Prds de categoria
function vc_products_by_tags_carousel() {
    vc_map( 
            array(
                'name' => __('Products by Tags Carousel', 'fastway'),
                'base' => 'vc_products_by_tags_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
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
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Tags', 'fastway' ),
                        'param_name' => 'tag',
                        'weight' => 0,
                        "admin_label" => true,
                        'value'=>fw_vc_get_posts("product_tag"),
                    ), 
                    array(
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Categories', 'fastway' ),
                        'param_name' => 'category',
                        'weight' => 0,
                         "admin_label" => true,
                        'value'=>fw_vc_get_posts("product_cat"),
                    ), 
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Hide Uncategorized ', 'fastway' ),
                        'param_name' => 'uncategorized',
                        'std' => 'true',
                        'admin_label' => false,
                    ), 
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Slider', 'fastway' ),
                        'param_name' => 'slider',
                        'std' => 'true',
                        'admin_label' => false,
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
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
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
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}




add_action( 'vc_before_init', 'vc_categories_carousel' );//Cates en general
function vc_categories_carousel() {

    vc_map( 
            array(
                'name' => __('Categories Carousel', 'fastway'),
                'base' => 'fw_categories_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
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
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Categories', 'fastway' ),
                        'param_name' => 'cats',
                        'weight' => 0,
                         "admin_label" => true,
                        'value'=>fw_vc_get_posts("product_cat"),
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
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Hide Empty ', 'fastway' ),
                        'param_name' => 'hideempty',
                        'std' => 'true',
                        'admin_label' => false,
                    ), 
                    array(
                        "type" => 'checkbox',
                        "heading"     => "Loop",
                        "param_name"  => "loop",
                        'std' => 'true',
                    ),
                    array(
                        "type" => 'checkbox',
                        "heading"     => "Autoplay ",
                        "param_name"  => "autoplay",
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
                    ),   array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}



add_action( 'vc_before_init', 'vc_brands_carousel' );//Cates en general
function vc_brands_carousel() {

    vc_map( 
            array(
                'name' => __('Brands Carousel', 'fastway'),
                'base' => 'fw_brands_carousel',
                'description' => __('Carousel of brands', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
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
                        'type' => 'dropdown_multi',
                        'heading' => __( 'Brands', 'fastway' ),
                        'param_name' => 'brands',
                        'weight' => 0,
                        "admin_label" => true,
                        'value'=>fw_vc_get_posts("brand"),
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
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( 'Hide Uncategorized ', 'fastway' ),
                        'param_name' => 'uncategorized',
                        'std' => 'true',
                        'admin_label' => false,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'js_composer' ),
                        'param_name' => 'el_class',
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                    ),   array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}

add_action( 'vc_before_init', 'vc_featured_products' );
function vc_featured_products() {

  vc_map( 
            array(
                'name' => __('Featured Products Carousel', 'fastway'),
                'base' => 'fw_featured_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                'params' => get_slider_fields(),
            )

            
        );          

}
add_action( 'vc_before_init', 'vc_sale_products' );
function vc_sale_products() {

  vc_map( 
            array(
                'name' => __('Sale Products Carousel', 'fastway'),
                'base' => 'fw_sale_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                'params' => get_slider_fields(),
            )

            
        );          

}
add_action( 'vc_before_init', 'vc_bestselling_products' );
function vc_bestselling_products() {

  vc_map( 
            array(
                'name' => __('Best Selling Products Carousel', 'fastway'),
                'base' => 'fw_bestselling_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                'params' => get_slider_fields(),
            )

            
        );          

}


add_action( 'vc_before_init', 'vc_recent_products' );
function vc_recent_products() {

  vc_map( 
            array(
                'name' => __('Recent Products Carousel', 'fastway'),
                'base' => 'fw_recent_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway Products', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'favi.png',            
                'params' => get_slider_fields(),
            )

            
        );          

}
function get_slider_fields(){
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
        ),/*
        array(
            'type' => 'textfield',
            'heading' => __( 'Space Between ', 'fastway' ),
            'param_name' => 'space',
            'value' => '10',
            'std' => '10',
            'admin_label' => false,
            'weight' => 0,
        ),*/
        array(
            'type' => 'textfield',
            'heading' => __( 'Max Quantiy', 'fastway' ),
            'param_name' => 'maxcant',
            'value' => '12',
            'std' => '12',
            'admin_label' => false,
            'weight' => 0,
        ), 
        array(
            'type' => 'checkbox',
            'heading' => __( 'Hide Uncategorized ', 'fastway' ),
            'param_name' => 'uncategorized',
            'std' => 'true',
            'admin_label' => false,
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
            "type" => 'checkbox',
            "heading"     => "Hide out of stock",
            "param_name"  => "hideoutofstock",
            'std' => 'true',
        ),
        
        /*
        array(
            "type"        => "dropdown",
            "heading"     => __("Select category"),
            "param_name"  => "type",
            "admin_label" => true,
            "value"       => array(
                'Featured'   => 'featured',
                'Recent'   => 'recent',
                'Best Selling' => 'bestselling',
                'Sale' => 'bestselling',
                'Best Selling' => 'bestselling',
            ), //value
            'std' => 'Recent',
            'admin_label' => false,
            'weight' => 0,
        ),   
        */
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

?>