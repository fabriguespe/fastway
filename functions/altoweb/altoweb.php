<?php
/*
Plugin Name: Altoweb
Plugin URI: https://www.altoweb.ar
Description: Plugin de funcionalidades de altoweb.ar
Version: 1.9
Author: Fabrizio Guespe
Author URI: https://www.altoweb.ar
*/

include( plugin_dir_path( __FILE__ ) . '/woocommerce-taxomizer/woocommerce-taxomizer.php');
include( plugin_dir_path( __FILE__ ) . '/importer/enable-media-replace.php');

//Taxomizer
if(get_option('taxomizerwpai'))add_action('pmxi_after_xml_import', 'after_xml_import_init_cate', 10, 1);
function after_xml_import_init_cate($import_id){
    $varss="product_cat,".fw_theme_mod('fw_extra_tax');
    $args     = array( 'post_type' => 'product' , 'posts_per_page'=>-1, 'numberposts'=>-1);
    $products = get_posts( $args ); 
      
    foreach (explode(",",$varss) as $nombre ) {
      $nombre=strtolower($nombre);
      $tipo=$nombre;
      if(empty($nombre))break;
      foreach ($products as $prod) {
          wootax_procesar_producto(get_post($prod->ID),wootax_categorizacon_array(get_option('taxomizer_'.$nombre.'_vars')),$nombre); 
      }
    }  
}



if(fw_theme_mod('fw_action_init_mayorista')){

   update_option('woocommerce_enable_guest_checkout','no');
   update_option('woocommerce_enable_checkout_login_reminder','no');
   update_option('woocommerce_enable_signup_and_login_from_checkout','no');
   update_option('woocommerce_enable_myaccount_registration','no');
   
   set_theme_mod('fw_prices_visibility','logged');
   set_theme_mod('fw_purchases_visibility','logged');
   set_theme_mod('fw_action_init_mayorista',false);
}


if(fw_theme_mod('fw_action_woosettings')){
   update_option('woocommerce_price_num_decimals','0');
   update_option('fw_action_woosettings','0');//fix que no verifica el mail
   update_option('woocommerce_currency','ARS');
   update_option('woocommerce_default_country','AR:C');
   update_option('woocommerce_manage_stock','no');
   update_option('woocommerce_cart_redirect_after_add','no');
   update_option('woocommerce_enable_coupons','yes');
   update_option('woocommerce_enable_ajax_add_to_cart','no');
   update_option('shop_single_image_size','a:3:{s:5:"width";s:3:"500";s:6:"height";s:3:"500";s:4:"crop";i:1;}');
   update_option('woocommerce_enable_myaccount_registration','yes');
   update_option('woocommerce_enable_signup_and_login_from_checkout','yes');
   update_option('woocommerce_enable_guest_checkout','no');
   update_option('woocommerce_enable_checkout_login_reminder','yes');
   update_option('woocommerce_hide_out_of_stock_items','yes');
   update_option('woocommerce_registration_generate_username','yes');
   update_option('woocommerce_ship_to_destination','billing_only');
   update_option('woocommerce_registration_generate_password','yes');
   //Calc envios
   update_option('woocommerce_enable_shipping_calc','no');
   update_option('woocommerce_enable_reviews','no');
   update_option('woocommerce_shipping_cost_requires_address','no');
   //Envuios
   update_option('woocommerce_allowed_countries','all');
   update_option('woocommerce_ship_to_countries','all');
   update_option('woocommerce_default_customer_address','geolocation');

   //Para que no se cancelen los envios
   update_option('woocommerce_hold_stock_minutes','');

   $opts=get_option('woocommerce_mercadoenvios-gateway_settings');
   $opts['title']='Mercadopago';
   $opts['description']='Procesado por mercadopago
    <div class="mp_pago d-flex">
        <img alt="visa" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/visa.svg">
        <img alt="mastercard" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/mastercard.svg">
        <img alt="amex" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/amex.svg">
        <img alt="dinersclub" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/dinersclub.svg">
        <img alt="cabal" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/cabal.svg">
        <img alt="argencard" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/argencard.svg">
        <img alt="tarjeta-naranja" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/tarjeta-naranja.svg">
        <img alt="nativa" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/nativa.svg">
        <img alt="tarjeta-shopping" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/tarjeta-shopping.svg">
        <img alt="cencosud" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/cencosud.svg">
        <img alt="cabaldebit" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/cabaldebit.svg">
        <img alt="visadebit" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/visadebit.svg">
        <img alt="maestro" src="https://d1zxmlch3z83cq.cloudfront.net/production/1.6.20/_next/server/static/img/brands/maestro.svg">
   </div>
   ';
   $opts['method']='redirect';
   $opts['installment_paymentbutton_calculator']='no';
   $opts['installment_product_calculator']='no';
   $opts['shipping_product_calculator']='no';

   update_option('woocommerce_mercadoenvios-gateway_settings',$opts);

   set_theme_mod('fw_action_woosettings',false);
}

set_theme_mod('fw_action_woosettings',false);
if(fw_theme_mod('fw_action_clientimages')){
    set_theme_mod('ca-main-color', isAltoweb()?'#0c2e5c':'#0b6e99');
    set_theme_mod('ca-second-color', isAltoweb()?'#02b25f':'#FFD421');
    set_theme_mod('mobile-icon', "/wp-content/themes/fastway/assets/img/".fw_theme_mod('fw_dev_assetfolder')."favi.png");
    set_theme_mod('fw_dev_logo',"/wp-content/themes/fastway/assets/img/".fw_theme_mod('fw_dev_assetfolder')."logo.png");
    set_theme_mod('fw_dev_favi',"/wp-content/themes/fastway/assets/img/".fw_theme_mod('fw_dev_assetfolder')."favi.png");
    set_theme_mod('fw_action_clientimages',false);
}


  

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );
function my_custom_checkout_field_display_admin_order_meta($order){
    $dato=get_post_meta( $order->get_id(), '_billing_dni', true );
    if(!empty($dato))echo '<p><strong>'.__('CDI/VAT','fastway').':</strong> ' . $dato . '</p>';
    $dato=get_post_meta( $order->get_id(), '_billing_vendedor', true );
    if(!empty($dato))echo '<p><strong>'.__('Vendedor','fastway').':</strong> ' . $dato . '</p>';

    $dato = get_post_meta($order->get_id(), '_customer_user', true);
    $user = get_user_by( 'id', $dato ); 
    if(!empty($dato))echo '<p><strong>'.__('Usuario','fastway').':</strong> ' . $user->user_login . '</p>';
}


function remove_dashboard_meta2() {
    //Saca las ordenes de la network
    remove_meta_box( 'woocommerce_network_orders', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta2' );



add_action('admin_menu', 'my_menu_pagess');
function my_menu_pagess(){
    add_submenu_page('my-menu', 'Opciones', 'Exito', 'manage_options', 'exitofile', 'exitofile_page');
}

function exitofile_page(){
   ?>
   <div class="paginaopciones">
   <style type="text/css">
   .paginaopciones{
   text-align:center;
   }
   </style>
   <img src="<?php echo get_template_directory_uri().'/assets/img/altoweb/exitofile.png';?>" width="600">
   </div>
   <?php
   } 
   




/*GENERICOS*/
add_filter('gettext', 'bancos_arg', 10, 3);
function bancos_arg($translation, $text, $domain) {
    
    if ($domain == 'woocommerce' && get_locale()=='es_ES') {
        switch ($text) {
            case 'Sort code':
                $translation = 'ALIAS';
                break;
    
            case 'IBAN':
                $translation = 'CUIT';
                break;

            case 'BIC / Swift':
                $translation = 'CBU';
                break;

            case 'BIC':
                $translation = 'CBU';
                break;
                
        }
    }

    return $translation;
}

    

// Utility function, to display BACS accounts details
function get_bacs_account_details_html( $echo = true, $type = 'list' ) {
    $devolver='';
    $bacs_info  = get_option( 'woocommerce_bacs_accounts');
    if(!empty($bacs_info)){
        foreach ( $bacs_info as $account ) {
            $account_name   = esc_attr( wp_unslash( $account['account_name'] ) );
            $bank_name      = esc_attr( wp_unslash( $account['bank_name'] ) );
            $account_number = esc_attr( $account['account_number'] );
            $sort_code      = esc_attr( $account['sort_code'] );
            $iban_code      = esc_attr( $account['iban'] );
            $bic_code       = esc_attr( $account['bic'] );
            $devolver.=$bank_name.'<br>';
            $devolver.=$account_name.'<br>';
            $devolver.=$account_number.'<br>';
            $devolver.=$sort_code.'<br>';
            $devolver.=$iban_code.'<br>';
            $devolver.=$bic_code.'<br>';
        }
    }
    return $devolver;
}

//VERFW

add_action('wp_ajax_nopriv_register_wp', 'fw_register_wp');
add_action('wp_ajax_register_wp', 'fw_register_wp');
function fw_register_wp(){
  $domain=$_SERVER['HTTP_HOST'];
  $fecha=date('m/d/Y h:i:s a', time());
  try{
    global $wpdb;
    $table = 'wp_altoweb_visits';
    $data = array('site'=>get_current_blog_id(),'fecha' => $fecha, 'dominio' => $domain,'type'=>'wp');
    $format = array('%s','%s');
    $wpdb->insert($table,$data,$format);
    $my_id = $wpdb->insert_id;
    
  }catch (Exception $e) {
    error_log('Excepción capturada: ',  $e->getMessage(), "\n"); 
  }
}
add_action('wp_ajax_nopriv_register_visit', 'fw_register_visit');
add_action('wp_ajax_register_visit', 'fw_register_visit');
function fw_register_visit(){
  $domain=$_SERVER['HTTP_HOST'];
  $fecha=date('m/d/Y h:i:s a', time());
  try{
    global $wpdb;
    $table = 'wp_altoweb_visits';
    $data = array('site'=>get_current_blog_id(),'fecha' => $fecha, 'dominio' => $domain,'type'=>'visit');
    $format = array('%s','%s');
    $wpdb->insert($table,$data,$format);
    $my_id = $wpdb->insert_id;
    
  }catch (Exception $e) {
    error_log('Excepción capturada: ',  $e->getMessage(), "\n"); 
  }
}

add_shortcode('altoweb_bancos','altoweb_bancos');
function altoweb_bancos(){
    return get_bacs_account_details_html();
}

add_shortcode('altoweb_financiacion','altoweb_financiacion');
function altoweb_financiacion(){
    global $product;
    $cuotas=fw_theme_mod('fw_cuotas_general');
    
    $texto="<big>".str_replace('fw_cuotas',$cuotas,fw_theme_mod('fw_label_cuotas_mp'))."</big>";
    $htmlcuotas=(fw_theme_mod('fw_label_cuotas_mp'))."</big>";//<small>".$cuotas." cuotas sin interes de $".$calc."</small>";
    //else $html="<big>Pagá en hasta 12 cuotas</big>";

    
    $return= <<<HTML
    <div class="altoweb_financiacion ja" >
    <a target="_blank" data-toggle="modal" data-target="#modal_modalmp" class="fw_icon_link fancybox">
        <li class=" fw_icon  fw-medios modalmp d-flex isli" > 
        <span class="icon">
            <i class="fa fa-credit-card"></i>
        </span> 
        <span class="text"> 
            $htmlcuotas
            <img style="display:block;" src="/wp-content/themes/fastway/assets/img/altoweb/iconitopagos.png" width="97"/>
            <small style="color:#3483fa !important;">Más información</small> 
        </span>
        </li>
        </a>
    <div class="modal modal_modalmp fade" id="modal_modalmp" tabindex="-1" role="dialog" aria-labelledby="modal_modalmpTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <iframe height="1000" width="100%" frameborder="0" title="Promociones bancarias" scrolling="no" src="https://www.mercadolibre.com.ar/gz/home/payments/methods?modal=true"></iframe>
            </div>
        </div>
    </div>
    </div>
HTML;
   $return.=do_shortcode('[fw_data type="fa fa-credit-card" isli="true" text="Cuotas sin interes" stext="'.fw_theme_mod('fw_label_calcular_cuotas').'" modal="modal_cuotas" el_class="fw-medios calculadora downlink"]');
   $return.= do_shortcode('[fw_data type="fa fa-shipping-fast" isli="true" text="Envío a domicilio" stext="'.fw_theme_mod('fw_label_calcular_envios').'" modal="modal_envio" el_class="fw-medios envio downlink"]');
   $return.= ' </div>';
   return $return;
}



add_shortcode('altoweb_pagos','altoweb_pagos');
function altoweb_pagos(){
    $devuelve.='[vc_row][vc_column][vc_empty_space][vc_column_text]<h2 style="text-align: center;">'.fw_theme_mod('fw_label_medios_pago').'</h2>[/vc_column_text][vc_empty_space][/vc_column][/vc_row]';
    $devuelve.='<div class="row">';
    for($i=1;$i<=6;$i++)if(fw_theme_mod('fw_payment_method_'.$i.'_on'))$devuelve.= '<div class="col-md-6 col-12"><div class="capsula-blanca"><i class="'.fw_theme_mod('fw_payment_method_'.$i.'_icon').'"></i><h2>'.fw_theme_mod('fw_payment_method_'.$i.'_title').'</h2>'.fw_theme_mod('fw_payment_method_'.$i.'_desc').'</div></div>';
    $devuelve.='</div>';
    $devuelve.='[vc_row][vc_column][vc_empty_space][/vc_column][/vc_row]';
    $devuelve=do_shortcode($devuelve);
    return $devuelve;
}

add_shortcode('altoweb_envios','altoweb_envios');
function altoweb_envios(){
    $devuelve.='[vc_row][vc_column][vc_empty_space][vc_column_text]<h2 style="text-align: center;">'.fw_theme_mod('fw_label_medios_envio').'</h2>[/vc_column_text][vc_empty_space][/vc_column][/vc_row]';
    $devuelve.='<div class="row">';
    for($i=1;$i<=6;$i++)if(fw_theme_mod('fw_shipping_method_'.$i.'_on'))$devuelve.= '<div class="col-md-6 col-12"><div class="capsula-blanca"><i class="'.fw_theme_mod('fw_shipping_method_'.$i.'_icon').'"></i><h2>'.fw_theme_mod('fw_shipping_method_'.$i.'_title').'</h2>'.fw_theme_mod('fw_shipping_method_'.$i.'_desc').'</div></div>';
    $devuelve.='</div>';
    $devuelve.='[vc_row][vc_column][vc_empty_space][/vc_column][/vc_row]';
    $devuelve=do_shortcode($devuelve);
    return $devuelve;
}
