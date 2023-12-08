<?php 
add_action( 'init', 'fw_faq_create' );

function fw_faq_create() {

    register_post_type( 'fw_faq',array(
      'description'           => __('FAQ Articles','pressapps-accordion-faq'),
      'labels'                => array(
        'name'                  => __('FAQ'                     ,'pressapps-accordion-faq'),
        'all_items'             => __('All FAQs'                 ,'pressapps-accordion-faq'),
        'singular_name'         => __('FAQ'                     ,'pressapps-accordion-faq'),
        'add_new'               => __('Add New'                 ,'pressapps-accordion-faq'),
        'add_new_item'          => __('Add New FAQ'             ,'pressapps-accordion-faq'),
        'edit_item'             => __('Edit FAQ'                ,'pressapps-accordion-faq'),
        'new_item'              => __('New FAQ'                 ,'pressapps-accordion-faq'),
        'view_item'             => __('View FAQ'                ,'pressapps-accordion-faq'),
        'search_items'          => __('Search FAQ'              ,'pressapps-accordion-faq'),
        'not_found'             => __('No FAQ found'            ,'pressapps-accordion-faq'),
        'not_found_in_trash'    => __('No FAQ found in Trash'   ,'pressapps-accordion-faq'),
      ),
      'public'                => true,
      'menu_position'         => 5,
      'rewrite'               => array( 'slug' => 'fw_faq' ),
      'supports'              => array( 'title', 'editor' /*,'page-attributes' */),
      'public'                => true,
      'show_ui'               => true,
      'publicly_queryable'    => true,
      'exclude_from_search'   => false,
      'menu_icon'				=> 'dashicons-editor-help',
    ));
    register_taxonomy( 'fw_faq_category',array( 'fw_faq' ),array(
			'hierarchical'  => false,
			'labels'        => array(
				'name'              => __( 'Categories'             ,'pressapps-accordion-faq'),
				'singular_name'     => __( 'Category'               ,'pressapps-accordion-faq'),
				'search_items'      => __( 'Search Categories'      ,'pressapps-accordion-faq'),
				'all_items'         => __( 'All Categories'         ,'pressapps-accordion-faq'),
				'parent_item'       => __( 'Parent Category'        ,'pressapps-accordion-faq'),
				'parent_item_colon' => __( 'Parent Category:'       ,'pressapps-accordion-faq'),
				'edit_item'         => __( 'Edit Category'          ,'pressapps-accordion-faq'),
				'update_item'       => __( 'Update Category'        ,'pressapps-accordion-faq'),
				'add_new_item'      => __( 'Add New Category'       ,'pressapps-accordion-faq'),
				'new_item_name'     => __( 'New Category Name'      ,'pressapps-accordion-faq'),
				'popular_items'     => NULL,
				'menu_name'         => __( 'Categories'             ,'pressapps-accordion-faq'),
			),
			'show_ui'       => true,
			'public'        => true,
			'query_var'     => true,
			'hierarchical'  => true,
			'rewrite'       => array( 'slug' => 'fw_faq_category' ),
		));
}

if( !function_exists( 'fw_faqs' ) ) {
  add_shortcode('fw_faqs', 'fw_faqs');
  function fw_faqs(){
    
    $qry_args= array(  
      'post_type'     =>'fw_faq',
      'numberposts'   => -1,
      'orderby'       => 'menu_order',
      'order'         => 'ASC',
    );
    $faq_preguntas = new WP_Query( $args ); 
    $pressapps_terms        = get_terms('fw_faq_category',
      array(
        'orderby'   => 'term_group',
        'order'     => 'ASC'
      )
    );

    $devolver='<div class="pressapps_faq_accordion fw_faqs">';
    foreach($pressapps_terms as $cate){
        $devolver.= '<div class="pafa-accordion-cat">
        <h2 class="cat_title">'.$cate->name.'</h2>';
        
        $qs = get_posts( array_merge( $qry_args,
					array('tax_query'     =>
						array(
							array(
								'taxonomy'  => 'fw_faq_category',
								'field'     => 'id',
								'terms'     => $cate->term_id,
							)
						)
					)
        ));
        foreach($qs as $preg){
          $devolver.='<div class="pafa-accordion pafa-icon">
              <h3 class="pafa-accordion-q pafa-accordion-open">
              <span class="cuadro_suma"><i class="fa fa-plus" style="color: #ffffff"></i>
              </span>'.$preg->post_title.'</h3>
              <div class="pafa-accordion-a" style="display: none;">
                  <p>'.$preg->post_content.'</p>
              </div>
          </div>';
        } 
        $devolver.='</div>';
    }
    $devolver.='</div>';
    
    return $devolver;

  }
}
?>
