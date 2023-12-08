<?php



add_action('wp_ajax_nopriv_fw_ajax_logout', 'fw_ajax_logout');
add_action('wp_ajax_fw_ajax_logout', 'fw_ajax_logout');
function fw_ajax_logout(){
  wp_logout();
  wp_clear_auth_cookie();
  wp_logout();
  ob_clean(); // probably overkill for this, but good habit
  wp_die();
  die();
}

add_action('wp_ajax_nopriv_fw_ajax_email_exists', 'fw_ajax_email_exists');
add_action('wp_ajax_fw_ajax_email_exists', 'fw_ajax_email_exists');
function fw_ajax_email_exists(){
  $result = wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' );
  $email = $_POST['email'];
  if ( email_exists($email) ) {
    echo json_encode(array('result'=>true, 'message'=>__('User exists.')));
  }else {
    echo json_encode(array('result'=>false, 'message'=>__('User doesnt exists.')));
  }
  die();
}


add_action('wp_ajax_nopriv_fw_ajax_login', 'fw_ajax_login');
add_action('wp_ajax_fw_ajax_login', 'fw_ajax_login');
function fw_ajax_login(){
  $result = wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' );
  if($result){
    error_log('login exitoso');
  }else{
    fw_log('Nonce is less than 12 hours old');
    die();
  }
  $info = array();
  $info['user_login'] = $_POST['username'];
  $info['user_password'] = $_POST['password'];
  $info['remember'] = true;

  $user_signon = wp_signon( $info, false );
  if ( is_wp_error($user_signon) ){
      echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
  } else {
      echo json_encode(array('loggedin'=>true,'email'=>$user_signon->user_email, 'message'=>__('Login successful, redirecting...')));
  }
  die();
}

add_action('wp_ajax_nopriv_fw_get_cart_totals', 'fw_get_cart_totals');
add_action('wp_ajax_fw_get_cart_totals', 'fw_get_cart_totals');
function fw_get_cart_totals(){  
    $shipping_method_id=$_GET['shipping_method_id'];
    WC()->session->set('chosen_shipping_methods', array($shipping_method_id));
    WC()->cart->calculate_shipping();
    WC()->cart->calculate_totals();
    $totals=WC()->cart->get_totals();
    echo json_encode($totals);
    exit();
}



add_filter( 'woocommerce_get_item_data', 'fw_get_item_data', 10, 2 );
function fw_get_item_data( $item_data, $cart_item_data ) {
  $product=wc_get_product($cart_item_data['product_id']);
  if($cart_item['variation_id'])$product=wc_get_product($cart_item['variation_id']);
  
  if(function_exists('fw_extra_line_info')){
    $item_data[] = array(
      'key' => 'fw_extra',
      'value' => fw_extra_line_info($product->id)
    );
  }
  if($product->get_stock_status()=='onbackorder'){
    $item_data[] = array(
      'key'     => "Estado",
      'value'   => fw_theme_mod('fw_backorder_text')
    );
  }
  return $item_data;
 }
 
 
add_action('wp_ajax_nopriv_fw_get_minicart', 'fw_get_minicart');
add_action('wp_ajax_fw_get_minicart', 'fw_get_minicart');
function fw_get_minicart(){  
    $carta=array();

    $fw_min_purchase = fw_theme_mod('fw_min_purchase');  
    if(fw_get_customer_orders()>0 && fw_theme_mod('fw_min_purchase2'))$fw_min_purchase = fw_theme_mod('fw_min_purchase2');  
   

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product=wc_get_product($cart_item['product_id']);
        if($cart_item['variation_id'])$product=wc_get_product($cart_item['variation_id']);
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $cart_item['product_id'] ), 'medium' ); 
        $image_url = $image[0];
        $nombre = $product->get_name();
        $cant=$cart_item['quantity'];
        $extra=function_exists('fw_extra_line_info')?fw_extra_line_info($cart_item['product_id']):'';
        $stock_status=$product->get_stock_status()=='onbackorder'?fw_theme_mod('fw_backorder_text'):'';
        $id=$product->get_ID();
        $precio=fw_get_price($id,$product->get_price());

        $role=fw_get_current_user_role();

        $arr = array(
        'role'=>$role,
        'id'=>$id,
        'nombre' => $nombre,
        'extra' => $extra,
        'maximum_quantity' => $product->get_stock_quantity(),
        'stock_status'=>$stock_status,
        'link'=> get_permalink($cart_item['product_id']),
        'precio'=> $precio, 
        'quantity' => $cant, 
        'url' => $image_url, 
        'cart_item_key' => $cart_item_key
        );
        array_push($carta,$arr);
    }

    $totals=WC()->cart->get_totals();
    
    $totales=array('cart' => $carta, 'totals'=> $totals,'items'=>WC()->cart->cart_contents_count,'min'=>$fw_min_purchase);
    echo json_encode($totales);
    exit();
}


if( !function_exists( 'fw_shopping_cart' ) ) {
  add_shortcode('fw_shopping_cart', 'fw_shopping_cart');

  function fw_shopping_cart($style = "link"){
      if(fw_check_hide_purchases())return;
      
      $style='link';
      if( !is_plugin_active('woocommerce/woocommerce.php') ) return;
      global $woocommerce;
      if(empty($style))$style=fw_theme_mod('cart-style');
      $rand=generateRandomString(5);
      $cant=$woocommerce->cart->cart_contents_count;
      $carturl=wc_get_cart_url();
      $istyle='fa';
      $cant='<span class="cant">('.$cant.')</span>';
      if($style==="link" || $style==="modal"){
      return '
      <!--<a class="fw-header-icon minicart"  href="'.$carturl.'" role="button">-->
      <a class="fw-header-icon minicart"  data-toggle="modal" data-target="#modal_carrito" role="button">
      <i class="'.$istyle.' fa-cart-plus"></i>'.$cant.'
      </a>';
      }
  }
}

function fw_product_is_purchasable($product){
  //echo '0';
  //if(get_option('woocommerce_manage_stock')=='yes'){
  $count_in_stock = 0;

  if ( $product->is_type( 'variable' ) ) {
      $variation_ids = $product->get_children();
      foreach( $variation_ids as $variation_id ){
          $variation = wc_get_product($variation_id);
          if($variation && $variation->is_in_stock() )
              $count_in_stock++;
      }
  }
  if($count_in_stock==0 && !$product->is_in_stock()  && !$product->backorders_allowed())return false;
 // }
 // echo '1';
  if(empty($product->get_price()))return false;
  return true;
}


add_shortcode('fw_loop_cart', 'fw_loop_btn');
add_shortcode('fw_loop_ajax', 'fw_loop_btn');
add_shortcode('fw_loop_btn', 'fw_loop_btn');
function fw_loop_btn( $atts ) {
  $atts = shortcode_atts(array('type' => 'ajax' ), $atts );
  $type=$atts['type'];

  global $product;
  if(fw_check_hide_purchases())return;
  if(!fw_product_is_purchasable($product))return;
  if ( $product->is_type( 'variable' ) ) {
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="location.href=\''.$product->get_permalink($product->id).'\'" class="fw_add_to_cart_button loop '.$type.'">
    <i class="fad fa-eye "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'.fw_theme_mod('add-to-cart-link-text').'</span>
    </button>';
  }else if($type=='ajax'){
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="add_to_minicart('. $product->id.')" class="fw_add_to_cart_button loop '.$type.'">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'.fw_theme_mod('add-to-cart-text').'</span>
    </button>';
  }else if($type=='link' && fw_theme_mod('sold-alone')){
    $addtocart_url =esc_url(wc_get_checkout_url().'?add-to-cart='.$product->get_id());
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="location.href=\''.$addtocart_url.'\'" class="fw_add_to_cart_button loop '.$type.'">
    <i class="fad fa-cart-plus "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'.fw_theme_mod('add-to-cart-text').'</span>
    </button>';
  }else{
    echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="location.href=\''.$product->get_permalink($product->id).'\'" class="fw_add_to_cart_button loop '.$type.' ">
    <i class="fad fa-eye "></i>
    <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
    <span>'.fw_theme_mod('add-to-cart-link-text').'</span>
    </button>';
  }

}

add_shortcode('fw_cart_ajax', 'fw_single_cart');//dejar!
add_shortcode('fw_single_cart', 'fw_single_cart');
function fw_single_cart() {
    global $product;
    if(fw_check_hide_purchases())return;
    echo wc_get_stock_html( $product );
    do_action( 'woocommerce_before_add_to_cart_button' );
    if(!fw_product_is_purchasable($product))return;
	  if ( $product->is_type( 'variable' ) ) {
      // Enqueue variation scripts.
      wp_enqueue_script( 'wc-add-to-cart-variation' );
      $available_variations=$product->get_available_variations();
      if ( empty( $available_variations ) && false !== $available_variations ) return;
      $attributes=$product->get_variation_attributes();
      $variations_json = wp_json_encode( $available_variations );
      $variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
      echo '<form class="variations_form cart" action="'.esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ).'" method="post" enctype="multipart/form-data" data-product_id="'.absint( $product->get_id() ).'" data-product_variations="'.$variations_attr.'">';
      echo '<table class="fw_variations variations" cellspacing="0" data-product_variations="'.$variations_attr.'">';
      foreach ( $attributes as $attribute_name=>$options) {
        $label=ucfirst(wc_attribute_label( $attribute_name ));
        echo '<tr><td class="label"><label for="'.esc_attr( sanitize_title( $attribute_name ) ).'">'.$label.'</label></td>';
        echo '<td class="value">';
        wc_dropdown_variation_attribute_options( array(
          'options'   => $options,
          'attribute' => $attribute_name,
          'product'   => $product,
        ) );
        //echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
        echo '</td>';
      }
      echo '</table></form>';
    }
	
    if(fw_theme_mod('sold-alone')){
      $addtocart_url =esc_url(wc_get_checkout_url().'?add-to-cart='.$product->get_id());
      echo '<button id="fw_add_to_cart_button_'.$product->id.'" onclick="location.href=\''.$addtocart_url.'\'" class="btn fw_add_to_cart_button  data-product_id="'.$product->id.'">
      <i class="fad fa-cart-plus "></i>
      <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
      <span>'.fw_theme_mod('add-to-cart-text').'</span>
      </button>';
    }else{
      echo '<button id="fw_add_to_cart_button_'.$product->id.'"  onclick="add_to_minicart('. $product->id.')" class=" btn fw_add_to_cart_button" data-product_id="'.$product->id.'">
      <i class="fad fa-cart-plus "></i>
      <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
      <span>'.fw_theme_mod('add-to-cart-text').'</span>
      </button>';

    }

    do_action( 'woocommerce_after_add_to_cart_button' );

}

add_action('wp_ajax_nopriv_cart_remove_item', 'cart_remove_item');
add_action('wp_ajax_cart_remove_item', 'cart_remove_item');
function cart_remove_item(){
  $key=$_GET['cart_item_key'];
  WC()->cart->remove_cart_item($key );
  exit();
}

add_action('wp_ajax_nopriv_cart_get_subtotal', 'cart_get_subtotal');
add_action('wp_ajax_cart_get_subtotal', 'cart_get_subtotal');
function cart_get_subtotal(){
  $result=array("total"=>WC()->cart->total,"subtotal"=>WC()->cart->subtotal);
  echo json_encode($result);
  exit();
}
add_action('wp_ajax_nopriv_add_to_cart', 'fw_add_to_cart');
add_action('wp_ajax_add_to_cart', 'fw_add_to_cart');
function fw_add_to_cart(){
  global $woocommerce;
  $id= $_GET['id'];
  $var_id= $_GET['var_id'];
  $qty= $_GET['qty'];
  WC()->cart->add_to_cart( $id,$qty, $var_id);

  $product=wc_get_product($id);
  if($var_id)$product=wc_get_product($var_id);

  $producto['price']=$product->price;
  $producto['qty']=$qty;
  $producto['sku']=$product->sku;
  $producto['name']=$product->name;

  $cant=0;
  foreach( $product->category_ids as $cat_id ) {
    $term = get_term_by( 'id', $cat_id, 'product_cat' );
    $producto['category'].= $term->name;
    if($cant<(count($product->category_ids)-1))$producto['category'].= ' > ';
    $cant++;
  }

  echo json_encode($producto);
  exit();
}

add_action('wp_ajax_nopriv_get_items_cant', 'get_items_cant');
add_action('wp_ajax_get_items_cant', 'get_items_cant');
function get_items_cant(){
  global $woocommerce;
  $key= $_GET['cart_item_key'];
  $total= $_GET['total'];

  WC()->cart->set_quantity( $key, $total );
  exit();
}


add_action('wp_ajax_nopriv_sum_cart_qty', 'sum_cart_qty');
add_action('wp_ajax_sum_cart_qty', 'sum_cart_qty');
function sum_cart_qty(){
  global $woocommerce;
  $key= $_GET['cart_item_key'];
  $total= $_GET['total'];

  WC()->cart->set_quantity( $key, $total );
  exit();
}


add_action('wp_ajax_nopriv_get_variation_price', 'get_variation_price');
add_action('wp_ajax_get_variation_price', 'get_variation_price');
function get_variation_price(){
  global $woocommerce;
  $variation_id=$_GET['variation_id'];
  $variable_product = wc_get_product($variation_id);
  echo $variable_product->get_price_html();
  exit();
}

function price_array($product){
    
    $price = $product->get_price_html();
    $del = array('<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>', '</span>','<del>','<ins>');
    $price = str_replace($del, '', $price);
    $price = str_replace('</del>', '|', $price);
    $price = str_replace('</ins>', '|', $price);
    $price = str_replace('"', '', $price);
    $price = str_replace(',', '', $price);
    $price_arr = explode('|', $price);
    $price_arr = array_filter($price_arr);
    return $price_arr;
}

function fw_dropdown_variation_attribute_options( $args = array() ) { 
  $args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array( 
      'options' => false,  
      'attribute' => false,  
      'product' => false,  
      'selected' => false,  
      'name' => '',  
      'id' => '',  
      'class' => '',  
      'show_option_none' => __( 'Choose an option', 'woocommerce' ),  
) ); 

  $options = $args['options']; 
  $product = $args['product']; 
  $attribute = $args['attribute']; 
  $name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute ); 
  $id = $args['id'] ? $args['id'] : sanitize_title( $attribute ); 
  $class = $args['class']; 
  $show_option_none = $args['show_option_none'] ? true : false; 
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options. 

  if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) { 
      $attributes = $product->get_variation_attributes(); 
      $options = $attributes[ $attribute ]; 
  } 

  $html = '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
  $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>'; 

  if ( ! empty( $options ) ) { 
      if ( $product && taxonomy_exists( $attribute ) ) { 
          // Get terms if this is a taxonomy - ordered. We need the names too. 
          $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) ); 

          foreach ( $terms as $term ) { 
              if ( in_array( $term->slug, $options ) ) { 
                  $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</option>'; 
              } 
          } 
      } else { 
          foreach ( $options as $option ) { 
              // This handles < 2.4.0 bw compatibility where text attributes were not sanitized. 
              $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false ); 
              $html .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>'; 
          } 
      } 
  } 

  $html .= '</select>'; 
  //return $html;
  return apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); 
} 


function load_wp_media_files3() {
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files3' );
  
  
?>