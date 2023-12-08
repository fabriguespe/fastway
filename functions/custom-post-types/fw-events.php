<?php 


add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {

/**
 * Post Type: Webinars.
 */

$labels = [
    "name" => __( "Events", "fastway" ),
    "singular_name" => __( "Event", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Events", "fastway" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "fw_event", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail" ],
];

register_post_type( "fw_event", $args );

register_taxonomy( 'fw_event_cat',array( 'fw_event' ),array(
    'hierarchical'  => false,
    'labels'        => array(
        'name'              => __( 'Categories'             ,'fastway'),
        'singular_name'     => __( 'Category'               ,'fastway'),
        'search_items'      => __( 'Search Categories'      ,'fastway'),
        'all_items'         => __( 'All Categories'         ,'fastway'),
        'parent_item'       => __( 'Parent Category'        ,'fastway'),
        'parent_item_colon' => __( 'Parent Category:'       ,'fastway'),
        'edit_item'         => __( 'Edit Category'          ,'fastway'),
        'update_item'       => __( 'Update Category'        ,'fastway'),
        'add_new_item'      => __( 'Add New Category'       ,'fastway'),
        'new_item_name'     => __( 'New Category Name'      ,'fastway'),
        'popular_items'     => NULL,
        'menu_name'         => __( 'Categories'             ,'fastway'),
    ),
    'show_ui'       => true,
    'public'        => true,
    'query_var'     => true,
    'hierarchical'  => true,
    'rewrite'       => array( 'slug' => 'fw_event_cat' ),
));

}


add_shortcode( 'fw_event_carousel', 'fw_event_carousel' ); 
function fw_event_carousel( $atts, $content ) {
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
          'type'    => '',
          'date_from_now'    => '',
          'prodsperrow' => 4,
    ), $atts );

    if(!$atts['date_from_now'])$atts['date_from_now']='>=';
    else if($atts['date_from_now']=='after')$atts['date_from_now']='>=';
    else if($atts['date_from_now']=='previous')$atts['date_from_now']='<=';
    
    if(!$atts['loop'])$atts['loop']='false';
    if(!$atts['autoplay'])$atts['autoplay']='false';
    //Desktop
  
    ob_start();
    error_log($atts['date_from_now']);
    
    $tax_query   = WC()->query->get_tax_query();
    if($atts['type']){
        $tax_query[] = array(
            'taxonomy' => 'fw_event_cat',
            'field'    => 'slug', // Or 'name' or 'term_id'
            'terms'    => array($atts['type']),
            'operator' => 'IN', // Excluded
        );
    }

    $date_now = date('Y-m-d H:i:s');
    $args = array(
        'post_type' => 'fw_event',
        'order'          => 'ASC',
        'orderby'        => 'meta_value',
        'meta_key'       => 'start_date',
        'meta_type'      => 'DATETIME',
        'tax_query' =>  $tax_query,
        'meta_query' => array(
            array(
                'key'           => 'start_date',
                'compare'       => $atts['date_from_now'],
                'value'         => $date_now,
                'type'          => 'DATETIME',
            )
        )
    );

    $posts = new WP_Query($args);
    fw_get_template('fw-event-carousel.php',$atts,$posts);
    
    return ob_get_clean();
  
}   


add_shortcode( 'fw_event_carousel_nodate', 'fw_event_carousel_nodate' ); 
function fw_event_carousel_nodate( $atts, $content ) {
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
          'type'    => '',
          'prodsperrow' => 4,
    ), $atts );

    
   // if(!$atts['loop'])$atts['loop']='false';
    //if(!$atts['autoplay'])$atts['autoplay']='false';
    //Desktop
  
    ob_start();
    $tax_query   = WC()->query->get_tax_query();
    if($atts['type']){
        $tax_query[] = array(
            'taxonomy' => 'fw_event_cat',
            'field'    => 'slug', // Or 'name' or 'term_id'
            'terms'    => array($atts['type']),
            'operator' => 'IN', // Excluded
        );
    }

    $args = array(
        'post_type' => 'fw_event',
        'order'          => 'DESC',
        'orderby'        => 'meta_value',
        'tax_query' =>  $tax_query,
    );

    $posts = new WP_Query($args);
    fw_get_template('fw-event-carousel.php',$atts,$posts);
    return ob_get_clean();
  
}   

function fw_loop_event(){
	global $preset_code;
	$code=$preset_code?$preset_code:fw_theme_mod('woo_loop_event_code');
	echo do_shortcode(stripslashes(htmlspecialchars_decode( $code)));
  }



if( function_exists('acf_add_local_field_group') && fw_theme_mod('fw_cpt_events_default')):
    acf_add_local_field_group(array(
        'key' => 'group_602d0e7189796',
        'title' => 'Data',
        'fields' => array(
            array(
                'key' => 'field_602d0e7919f88',
                'label' => __( 'Start Date'      ,'fastway'),
                'name' => 'start_date',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_602d0e7919f81',
                'label' =>  __('End Date','fastway'),
                'name' => 'end_date',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_602d0ea849f89',
                'label' =>  __('When','fastway'),
                'name' => 'date_desc',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_602d0ea819f89',
                'label' =>  __('City','fastway'),
                'name' => 'city',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_602d0f2c6b8ff',
                'label' =>  __('Description','fastway'),
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_602d10d0134d3',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_602d10d0134d1',
                'label' =>  __('Replay Webinar','fastway'),
                'name' => 'replay_webinar',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array(
                'key' => 'field_603e6c10144b3',
                'label' =>  __('File','fastway'),
                'name' => 'file',
                'type' => 'file',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_size' => 0,
                'max_size' => 0,
                'mime_types' => '',
            ),
            array(
                'key' => 'field_602d0ea119f89',
                'label' =>  __('Label','fastway'),
                'name' => 'btn_label',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'label' =>  __('Read more','fastway'),
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'fw_event',
                ),
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'excerpt',
        ),
        'active' => true,
        'description' => '',
    ));
    
endif;

add_shortcode('fw_event_container', 'fw_event_container');
function fw_event_container($atts = [], $content = null){
    global $fw_loop_event;
    echo '<li class="fw_event_loop">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</li>';
}
add_shortcode('fw_event_container_wl', 'fw_event_container_wl');
function fw_event_container_wl($atts = [], $content = null){
    global $fw_loop_event;
    echo '<li class="fw_event_loop"><a href="'.esc_url( get_field('link',$fw_loop_event->ID)).'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</a></li>';
}

add_shortcode('fw_event_image', 'fw_event_image');
function fw_event_image(){
  global $fw_loop_event;
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $fw_loop_event->ID ), 'medium' ); 
  $image_url = $image[0]; 
  echo '<div class="loopimg_container"><img src="'.$image_url.'" width="100%" height="auto"/></div>';
}
add_shortcode('fw_event_title', 'fw_event_title');
function fw_event_title(){
  global $fw_loop_event;
  echo '<h2 class="event_title" >'.$fw_loop_event->post_title.'</h2>' ;
}

add_shortcode('fw_event_desc', 'fw_event_desc');
function fw_event_desc(){
  global $fw_loop_event;
  if(function_exists('get_field'))echo '<p class="desc" >'.get_field('description',$fw_loop_event->ID).'</p>';
}

add_shortcode('fw_event_date', 'fw_event_date');
function fw_event_date(){
  global $fw_loop_event;
  if(function_exists('get_field'))echo '<label class="date" >'.get_field('date_desc',$fw_loop_event->ID).'</label>';
}


add_shortcode('fw_event_url', 'fw_event_url');
function fw_event_url(){
  global $fw_loop_event;
  if(function_exists('get_field'))  echo '<a href="'.get_field('link',$fw_loop_event->ID).'" class="vermas" target="_blank" >'.(get_field('btn_label',$fw_loop_event->ID)?get_field('btn_label',$fw_loop_event->ID):"Ver video").'</a>';
  if(function_exists('get_field') && get_field('file',$fw_loop_event->ID))echo '<a  href="'.get_field('file',$fw_loop_event->ID)['url'].'" class="descarga" target="_blank" ><i class="fal fa-download"></i> '.__('Download','fastway').'</a>';
  if(function_exists('get_field') && get_field('replay_webinar',$fw_loop_event->ID))echo '<a  href="'.get_field('replay_webinar',$fw_loop_event->ID).'" class="vervideo" target="_blank" ><i class="fal fa-undo"></i> '.__('Replay','fastway').'</a>';
}


function my_page_columns($columns) {
    $columns = array(
     'cb' => '< input type="checkbox" />',
     'title' =>  __( 'Title'      ,'fastway'),
     'city' => __( 'City'      ,'fastway'),
     'date_desc' =>  __( 'When'      ,'fastway'),
     'start_date' => __( 'Start Date'      ,'fastway'),
     'end_date' =>  __( 'End Date'      ,'fastway'),
     'category' =>  __( 'Category'      ,'fastway'),
    );
    return $columns;
   }
   function my_custom_columns($column) {
    global $post;
    $cates=wp_get_post_terms( $post->ID, 'fw_event_cat' );
    if($column == 'city' || $column == 'start_date' || $column == 'end_date' || $column == 'date_desc')echo get_field($column, $post->ID);
    else if($column=='category')  foreach( $cates as $cate ) echo $cate->name . ' ';
    else echo '';
    
   }
   add_action("manage_fw_event_posts_custom_column", "my_custom_columns");
   add_filter("manage_edit-fw_event_columns", "my_page_columns");
   
?>