<?php 
add_action( 'init', 'fw_review_create' );
function fw_review_create() {
    register_post_type( 'fw_review',array(
      'description'           => __('Reviews','fastway'),
      'labels'                => array(
        'name'                  => __('Reviews'                     ,'fastway'),
        'all_items'             => __('All Reviews'                ,'fastway'),
        'singular_name'         => __('Review'                     ,'fastway'),
        'add_new'               => __('Add New'                    ,'fastway'),
        'add_new_item'          => __('Add New Review'             ,'fastway'),
        'edit_item'             => __('Edit Review'                ,'fastway'),
        'new_item'              => __('New Review'                 ,'fastway'),
        'view_item'             => __('View Review'                ,'fastway'),
        'search_items'          => __('Search Review'              ,'fastway'),
        'not_found'             => __('No Review found'            ,'fastway'),
        'not_found_in_trash'    => __('No Review found in Trash'   ,'fastway'),
      ),
      'public'                => true,
      'menu_position'         => 5,
      'rewrite'               => array( 'slug' => 'fw_review' ),
      'supports'              => array( 'title' ,'thumbnail'),
      'public'                => true,
      'show_ui'               => true,
      'publicly_queryable'    => true,
      'exclude_from_search'   => false,
      'menu_icon'				=> 'dashicons-star-empty',
    ));
    register_taxonomy( 'fw_review_category',array( 'fw_review' ),array(
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
			'rewrite'       => array( 'slug' => 'fw_review_category' ),
    ));
}





add_shortcode( 'fw_review_carousel', 'fw_review_carousel' ); 
function fw_review_carousel( $atts, $content ) {
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
  $qry_args= array(  
      'post_type'     =>'fw_review',
      'numberposts'   => -1,
      'orderby'       => 'menu_order',
      'order'         => 'ASC',
  );
  $posts = new WP_Query($qry_args);
  fw_get_template('fw-review-carousel.php',$atts,$posts);
  
  return ob_get_clean();
  
}   

function fw_loop_review(){
	global $preset_code;
	$code=$preset_code?$preset_code:fw_theme_mod('woo_loop_review_code');
	echo do_shortcode(stripslashes(htmlspecialchars_decode( $code)));
  }


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5f591afcb07e5',
	'title' => 'Fields',
	'fields' => array(
    array(
			'key' => 'field_5f59266929626',
			'label' => 'Company',
			'name' => 'company',
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
			'key' => 'field_5f591b0579c2c',
			'label' => 'Position',
			'name' => 'position',
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
			'key' => 'field_5f591b2079c2d',
			'label' => 'Review',
			'name' => 'review',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
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
			'key' => 'field_5f591b2a79c2e',
			'label' => 'Logo',
			'name' => 'logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5f591b3e79c30',
			'label' => 'URL',
			'name' => 'url',
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
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'fw_review',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;


add_shortcode('fw_review_container', 'fw_review_container');
function fw_review_container($atts = [], $content = null){
    $classname_desktop=" fw_review_loop ";
    global $preset_class;
    $classname_desktop.=$preset_class?$preset_class:fw_theme_mod('fw_builder_rl_class');
	
	
    echo '<li class="'.$classname_desktop.' ">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</li>';
}

add_shortcode('fw_review_image', 'fw_review_image');
function fw_review_image(){
  global $fw_loop_rev;
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $fw_loop_rev->ID ), 'medium' ); 
  $image_url = $image[0]; 
  return '<div class="thumbnail"><div class="shadow-overlay"></div><img src="'.$image_url.'" width="100%" height="auto" /></div>';
}
add_shortcode('fw_review_title', 'fw_review_title');
function fw_review_title(){
  global $fw_loop_rev;
  return '<div class="review_title" >'.$fw_loop_rev->post_title.'</div>' ;
}

add_shortcode('fw_review_desc', 'fw_review_desc');
function fw_review_desc(){
  global $fw_loop_rev;
  if(function_exists('get_field'))return get_field('review',$fw_loop_rev->ID);
}

add_shortcode('fw_review_logo', 'fw_review_logo');
function fw_review_logo(){
  global $fw_loop_rev;
  if(function_exists('get_field'))return '<img src="'.get_field('logo',$fw_loop_rev->ID)['url'].'" class="review_logo" />';
}

add_shortcode('fw_review_url', 'fw_review_url');
function fw_review_url(){
  global $fw_loop_rev;
  if(function_exists('get_field'))return get_field('url',$fw_loop_rev->ID);
}

add_shortcode('fw_review_position', 'fw_review_position');
function fw_review_position(){
  global $fw_loop_rev;
  if(function_exists('get_field'))return get_field('position',$fw_loop_rev->ID);
}
add_shortcode('fw_review_company', 'fw_review_company');
function fw_review_company(){
  global $fw_loop_rev;
  if(function_exists('get_field'))return get_field('company',$fw_loop_rev->ID);
}


?>
