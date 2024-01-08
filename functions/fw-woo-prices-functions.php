<?php


function get_currency_conversion($iscartcalc=false) {
    if(fw_is_admin())return 1;
    if(!fw_theme_mod('fw_currency_conversion'))return 1;
    $price=floatval(fw_theme_mod('fw_currency_conversion'));
    return $price; // x2 for testing
}

function fw_is_admin(){
    //si estoy en el dashboard
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
    $screen = get_current_screen();
    if ( $screen && $screen->parent_base == 'edit' ) return true;
    return false;
}





function fw_product_discount_multiplier($product,$iscartcalc=false){
    global $woocommerce;
    if(fw_is_admin())return 1;
    if(esMultitienda()) return 1;
    if (!empty($woocommerce->$cart->applied_coupons))return 1;
    if(!fw_theme_mod('fw_product_discount'))return 1;
    if(!fw_theme_mod('fw_product_discount_percentage'))return 1;
    
    if(fw_theme_mod('fw_product_discount_categories')){
        $esdelapromo=false;
        $terms = get_the_terms ( $product->id, 'product_cat' );
        $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories'));
        foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=true;
        if(!$esdelapromo)return 1;
    }else if(fw_theme_mod('fw_product_discount_categories_ext')){
        $esdelapromo=true;
        $terms = get_the_terms ( $product->id, 'product_cat' );
        $catespromo=explode(",",fw_theme_mod('fw_product_discount_categories_ext'));
        foreach ( $terms as $cat )if(in_array($cat->slug,$catespromo))$esdelapromo=false;
        if(!$esdelapromo)return 1;

    }
    if(fw_theme_mod('fw_product_discount_categories_ids_exc')){
        $esdelapromo=true;
        $arra=explode(",",fw_theme_mod('fw_product_discount_categories_ids_exc'));
        if(in_array($product->id,$arra))$esdelapromo=false;
        if(!$esdelapromo)return 1;
    }

    $multiplier=floatval(1-(fw_theme_mod('fw_product_discount_percentage')/100));
    return $multiplier;
}

if(fw_theme_mod('fw_currency_conversion') && !fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_price();
            $precio=$precio*get_currency_conversion();
            $value['data']->set_price($precio);
        }
    }


}else if(!fw_theme_mod('fw_currency_conversion') && fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_sale_price();
            $precio=$precio*get_currency_conversion();
            $value['data']->set_price($precio);
        }
    }
}else if(fw_theme_mod('fw_currency_conversion') && fw_theme_mod('fw_product_discount')){
    
    add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );
    function add_custom_price( $cart_object ) {
        foreach ( $cart_object->cart_contents as $key => $value ) {
            $product=wc_get_product($value['product_id']);
            if($value['variation_id'])$product=wc_get_product($value['variation_id']);
            $precio=$product->get_sale_price();
            $value['data']->set_price($precio);
        }
    }
}




add_filter( 'woocommerce_cart_item_price', 'fw_precio_item_carrito', 30, 3 );
function fw_precio_item_carrito( $price, $value, $cart_item_key ) {
    $product=wc_get_product($value['product_id']);
    if($value['variation_id'])$product=wc_get_product($value['variation_id']);
    $slashed_price = $product->get_price_html();
    $is_on_sale = $product->is_on_sale();
    if ( $is_on_sale ) $price = $slashed_price;
    return $price;
}



add_filter( 'woocommerce_product_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_regular_price', 'custom_dynamic_regular_price', 10, 2 );
function custom_dynamic_regular_price( $regular_price, $product ) {
    $devolver=$regular_price;
    if( empty($devolver) || $devolver == 0 )$devolver=$product->get_price();
    $devolver=round(floatval($devolver)*floatval(get_currency_conversion()),get_option('woocommerce_price_num_decimals'));
    return $devolver;
}


// Generating dynamically the product "sale price"
add_filter( 'woocommerce_product_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_sale_price', 'custom_dynamic_sale_price', 10, 2 );
function custom_dynamic_sale_price( $sale_price, $product ) {
    $devolver=$sale_price;
    $noteniasale=empty($devolver) || $devolver == 0;
    if(fw_is_admin() && $noteniasale)return;
    else if( $noteniasale )$devolver=floatval($product->get_price())*floatval(fw_product_discount_multiplier($product));
    $devolver=round($devolver*get_currency_conversion(),get_option('woocommerce_price_num_decimals'));
    return $devolver;

}


// Displayed formatted regular price + sale price
add_filter( 'woocommerce_get_price_html', 'custom_dynamic_sale_price_html', 20, 2 );
function custom_dynamic_sale_price_html( $price_html, $product ) {
    if(fw_is_admin()) return $price_html;
    $symbol=get_woocommerce_currency_symbol();
    $rate=get_post_meta($product->id,"_iva",true);
    $valuetac="+ IVA ".$rate."%";
    $item_rate = fw_theme_mod('fw_show_taxrate')?$valuetac:'';

    if(esMultitienda()) {
        $regular_price=$product->get_price();
        return  '<span class="fw_price price1 notsale" data-precio="'.$product->get_price().'"><span class="precio">'.$symbol.$regular_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').$item_rate.'</span></span></span>';
    }

    
    if( $product->is_type('variable') ){
        // Searching for the default variation
        $default_attributes = $product->get_default_attributes();
        // Loop through available variations
        foreach($product->get_available_variations() as $variation){
            $found = true; // Initializing
            // Loop through variation attributes
            foreach( $variation['attributes'] as $key => $value ){
                $taxonomy = str_replace( 'attribute_', '', $key );
                // Searching for a matching variation as default
                if( isset($default_attributes[$taxonomy]) && $default_attributes[$taxonomy] != $value ){
                    $found = false;
                    break;
                }
            }
            // When it's found we set it and we stop the main loop
            if( $found ) {
                $default_variaton = $variation;
                break;
            } // If not we continue
            else {
                continue;
            }
        }
        // Get the default variation prices or if not set the variable product min prices
        $regular_price = isset($default_variaton) ? $default_variaton['display_regular_price']: $product->get_variation_regular_price( 'min', true );
        $sale_price = isset($default_variaton) ? $default_variaton['display_price']: $product->get_variation_sale_price( 'min', true );
        if(!$sale_price || $sale_price==$regular_price)$sale_price=$regular_price*fw_product_discount_multiplier($product);
        $sale_price=round($sale_price*get_currency_conversion(),get_option('woocommerce_price_num_decimals'));
        
    }else if(fw_theme_mod('fw_format_numbers')) {
        $regular_price = number_format($product->get_regular_price(), 0, ',', '.');
        $sale_price    = number_format($product->get_sale_price(), 0, ',', '.');
    }else {
        $regular_price = $product->get_regular_price();
        $sale_price    = $product->get_sale_price();
    }
    if($regular_price){
        $percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100),get_option('woocommerce_price_num_decimals'));
    }

    if(empty($product->get_price()) || fw_check_hide_prices()){
        if(is_product()){
            return '<button type="button"  onclick="location.href=\''.fw_theme_mod('fw_consultar_link').'\'" class=" btn fw_add_to_cart_button" data-product_id="'.$product->id.'">
            <i class="fa fa-life-ring"></i>
            <span>'. fw_theme_mod('fw_consultar_price').'</span>
            </button>';
        }else{
            return '<a href=\''.fw_theme_mod('fw_consultar_link').'\'"><span class="fw_price price1"><span class="precio">'.fw_theme_mod('fw_consultar_price').'</span></span></a>';
        }
        
    }

    if ( $sale_price<$regular_price) {
        return '<span class="fw_price price1 sale" data-precio="'.$product->get_price().'">
                    <span class="precio">'.$symbol.$sale_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').$item_rate.'</span></span>
                    <span class="tachado">
                        <span class="precio-anterior"><del>'.$symbol.$regular_price.'</del></span>
                        <span class="badge badge-success ofertita"><span class="ofertita_numero" style="display:inline;color:inherit;font-size:inherit;line-height:inherit;font-weight:inherit;">'.$percentage.'% </span><span class="ofertita_texto" style="display:inline;color:inherit;font-size:inherit;line-height:inherit;font-weight:inherit;">'.fw_theme_mod('fw_off_text').'</span></span>
                    </span>
                </span>';
    }else{
        return '<span class="fw_price price1 notsale" data-precio="'.$product->get_price().'"><span class="precio">'.$symbol.$regular_price.' <span class="suffix">'.fw_theme_mod('fw_price_suffix').$item_rate.'</span></span></span>';
    }      

}




function my_woo_custom_price_field() {
    $roles=fw_theme_mod('ca_extra_roles');
    $roles=explode(",",$roles);

    foreach ($roles as $rol) {
        woocommerce_wp_text_input(  array(
            'id' => '_price_'.$rol,
            'label' => __( 'Price '.$rol, 'textdomain' ),
            'data_type' => 'price' //Let WooCommerce formats our field as price field
        ) );
    }
}

function misha_save_fields( $id, $post ){
    $roles=fw_theme_mod('ca_extra_roles');
    $roles=explode(",",$roles);
    foreach ($roles as $rol) {
        update_post_meta( $id, '_price_'.$rol, $_POST['_price_'.$rol] );
    }
}
/*
if(isLocalhost()){
    add_action( 'woocommerce_product_options_pricing', 'my_woo_custom_price_field' );
    add_action( 'woocommerce_process_product_meta', 'misha_save_fields', 10, 2 );
    add_filter( 'woocommerce_product_get_price', 'pr_reseller_price', 10, 2 );
    add_filter( 'woocommerce_product_variation_get_price', 'pr_reseller_price', 10, 2 );
    add_filter( 'woocommerce_product_get_regular_price', 'pr_reseller_price', 10, 2 );
    add_filter( 'woocommerce_product_get_sale_price', 'pr_reseller_price', 10, 2 );
    function pr_reseller_price(){
        return 2;
    }
}*/
?>