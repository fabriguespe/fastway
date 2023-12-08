<?php

function fw_product_search_join( $join, $query ) {
	if ( ! $query->is_main_query() || is_admin() || ! is_search() || ! is_woocommerce() ) 	return $join;
	
	global $wpdb;
	$join .= " LEFT JOIN {$wpdb->postmeta} fw_post_meta ON {$wpdb->posts}.ID = fw_post_meta.post_id ";
	return $join;
}
function fw_product_search_where( $where, $query ) {

	if ( ! $query->is_main_query() || is_admin() || ! is_search() || ! is_woocommerce() ) return $where;
  if( is_search() )  $query->set( 'category__not_in' , array( 'sin-categorizar' ) ); // Category ID
	global $wpdb;
	$where = preg_replace(
		"/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
		"({$wpdb->posts}.post_title LIKE $1) OR (fw_post_meta.meta_key = '_sku' AND fw_post_meta.meta_value LIKE $1) OR (fw_post_meta.meta_key = '_codigo' AND fw_post_meta.meta_value LIKE $1)", $where );

	return $where;
}


add_filter( 'posts_where', 'fw_product_search_where', 10, 2 );
add_filter( 'posts_join', 'fw_product_search_join', 10, 2 );


function ajax_search() {
      // Get search term from search field
      $search = sanitize_text_field( $_POST[ 'query' ] );
      // Set up query using search string, limit to 8 results
      $meta_query  = WC()->query->get_meta_query();
     /* $meta_query[] = array(
        array(
          'key' => '_sku',
          'value' => $search,
          'compare' => '=',
      ));*/
      
      $tax_query   = WC()->query->get_tax_query();

      if(fw_theme_mod('fw_search_categorized_only')){
        $tax_query[] = array('relation'=> 'AND');
        $tax_query[] = array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug', // Or 'name' or 'term_id'
          'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
          'operator' => 'NOT IN', // Excluded
        );
      }
      
      $query = new WP_Query(
        array(
          'posts_per_page' => 8,
          's' => $search,
          'post_type'           => 'product',
          'post_status'         => 'publish',
          'ignore_sticky_posts' => 1,
          //'orderby'             => $ordering_args['orderby'],
          //'order'               => $ordering_args['order'],
          'posts_per_page'      => 5,
          'suppress_filters'    => false,
          'meta_query' => array(
                      array(
                      'key' => '_price',
                      'value' => 0,
                      'compare' => '>',
                      'type' => 'NUMERIC'
                    )
          ),
          'tax_query'           => $tax_query,
        )
      );
      
      $output = '';
      
      // Run search query
      if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
          /* Output a link to each result
            This is where the post thumbnail, excerpt, or anything else could be added */
          echo '<a class="autocomplete-suggestion" href="' . get_permalink() . '">' . get_the_title() . '</a>';
        
        endwhile;        
        
        // If there is more than one page of results, add link to the full results page
        if ( $query->max_num_pages > 1 ) {
          // We use urlencode() here to handle any spaces or odd characters in the search string
          echo '<a class="see-all-results" href="' . get_site_url() . '?s=' . urlencode( $search ) . '&post_type=product">Ver todos.</a>';
        }
        
      } else {
        
        // There are no results, output a message
        echo '<p class="no-results">'._e("Sin resultados...","fastway").'</p>';
      
      }
      
      // Reset query
      wp_reset_query();
      
      die();
}

/* We need to hook into both wp_ajax and wp_ajax_nopriv_ in order for
  the search to work for both logged in and logged out users. */
add_action( 'wp_ajax_ajax_search', 'ajax_search' );
add_action( 'wp_ajax_nopriv_ajax_search', 'ajax_search' );

if( !function_exists( 'fw_search_form' ) ) {
    add_shortcode('fw_search_form', 'fw_search_form');
    function fw_search_form($atts){
        if(!is_numeric($atts)){
          $atts = shortcode_atts(array('id' => 1 ), $atts );
          $id=$atts['id'];
        }else $id=$atts;
      
        $rand_id = wp_rand();
        $check_woo = is_plugin_active('woocommerce/woocommerce.php');
        $_placeholder=fw_theme_mod('fw_label_search');
        $class="input-group fw_search_form fw-searchform ";
        if($id==3)$class.="mobile";
        else $class.="desktop";

        $elid="form_".$id."_";
        if($id==3)$elid.="mobile";
        else $elid.="desktop";
        
        $devolver= 
        '<form id="'.$elid.'" class="'.$class.'" method="get" action="'.esc_url( home_url( '/' ) ).'">
        <input type="search" class="search-field form-control u-from__input u-search-push-top__input" placeholder="'.esc_attr($_placeholder).'" value="'.get_search_query().'" name="s" id="s_'.esc_attr($rand_id).'">';
        if($check_woo)$devolver.='<input type="hidden" name="post_type" value="product" />';
        $devolver.='<div class="input-group-append icon">';
        if ( defined( 'ICL_LANGUAGE_CODE' ) ){
          $devolver.='<input type="hidden" name="lang" value="'.(ICL_LANGUAGE_CODE).'" />';
        }else if ( $id==0 || $id==2){
          $devolver.='<button type="submit" class="">Buscar</button>';
        }else if ( $id==1){
          $devolver.='<button type="submit" class=""><i class="fa fa-search"></i></button>';
        }
        $devolver.='</div></form>';
        return $devolver;
    }
}



//Oculto los sin categoria

if(fw_theme_mod('fw_search_categorized_only'))add_action( 'woocommerce_product_query', 'fw_search_categorized_only' );
if(fw_theme_mod('fw_search_priced_only'))add_action( 'pre_get_posts', 'fw_search_priced_only' );

function fw_search_priced_only( $q ){
  if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
    $q->set( 'meta_query', array(array(
      'key' => '_price',
      'value' => 1,
      'compare' => '>',
      'type' => 'NUMERIC'
    )));

  }

}
function fw_search_categorized_only( $q ){
  if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
    
    $q->set( 'tax_query', array(array(
      'taxonomy' => 'product_cat',
      'field' => 'slug',
      'terms' => array( 'sin-categorizar','sin-categoria','uncategorized' ), 
      'operator' => 'NOT IN'
    )));

  }
}

add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args');

function custom_woocommerce_get_catalog_ordering_args( $args ) {
    global $wp_query;
        // Changed the $_SESSION to $_GET
    if (isset($_GET['orderby'])) {
       // switch ($_GET['orderby']) :
           // case 'pa_pub-year' :
                $args['order'] = 'ASC';
                //$args['meta_key'] = 'pa_pub-year';
                $args['orderby'] = 'title';
           // break;
        //endswitch;
    }
    return $args;
}


?>