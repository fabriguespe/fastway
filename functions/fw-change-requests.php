<?php

if(fw_theme_mod('fw_client_admin_columnarol')){
  add_filter('manage_edit-shop_order_columns', 'add_column_heading', 20, 1);
  function add_column_heading($array) {
      $res = array_slice($array, 0, 2, true) +
              array("customer_role" => "Rol") +
              array_slice($array, 2, count($array) - 1, true);

      return $res;
  }
  add_action('manage_posts_custom_column', 'add_column_data', 20, 2);
  function add_column_data($column_key, $order_id) {
      if ('customer_role' != $column_key)return;
      $customer = new WC_Order( $order_id );
      if($customer->user_id != ''){
              $user = new WP_User( $customer->user_id );
              if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
                $roles = ( array ) $user->roles;
                $role=$roles[0];
                if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest'  || $role == '' )$role='minorista';
                echo $role;
            }
      }
  }
}


if(fw_theme_mod('fw_crear_cuenta_a_sendy')){
  function fw_crear_cuenta_a_sendy( $user_id ) {
    $user    = get_userdata( $user_id );
    $email   = $user->user_email;
    $sendy_list=fw_theme_mod('fw_crear_cuenta_a_sendy');

    sendtoSendy($sendy_list,$email);
  }
  add_action('user_register', 'fw_crear_cuenta_a_sendy');
}

function sendtoSendy($sendy_list,$email){
	$your_installation_url = 'https://mailer.altoweb.ar';
	$api_key = 'JUu2WMpouY4wjSFvc2SF'; //Can be retrieved from your Sendy's main settings
	//Subscribe
	$postdata = http_build_query(
	    array(
        'email' => $email,
        'list' => $sendy_list,
        'api_key' => $api_key,
        'boolean' => 'true'
	    )
	);
	$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
	$context  = stream_context_create($opts);
	$result = file_get_contents($your_installation_url.'/subscribe', false, $context);
}



if(fw_theme_mod('fw_forms_a_sendy')){
  add_action('gform_after_submission', 'post_to_third_party', 10, 2);
  function post_to_third_party($entry, $form) {
    $integraciones=explode("|",trim(fw_theme_mod('fw_forms_a_sendy')));
    foreach ($integraciones as $forma){
      $formm=explode(",",$forma);
      $form_id=$formm[0];
      $field_number=$formm[1];
      $sendy_list=$formm[2];
      $email=$entry[$field_number];

      if(fw_theme_mod('fw_crear_cuenta_a_sendy') && email_exists($email))continue;
      else if($form_id==$entry['form_id']){
        error_log("manda a sendy");
        sendtoSendy($sendy_list,$email);
      }
    }
  }
}


if(fw_theme_mod('fw_gift_fields')){
  add_action( 'woocommerce_admin_order_data_after_shipping_address', 'fw_gift_fields_admin', 10, 1 );
  add_action( 'woocommerce_email_order_meta', 'fw_gift_fields_admin', 10, 3 );
}

function fw_gift_fields_admin($order){
  if( $order->get_billing_address_1() != $order->get_shipping_address_1() ) {
    $r1=get_post_meta( $order->get_id(), '_shipping_phone', true );
    $r2=get_post_meta( $order->get_id(), '_shipping_date', true );
    $r5=get_post_meta( $order->get_id(), '_shipping_mensaje', true );
    echo '<div class="regalo" style="border:1px solid pink;padding:10px;margin-bottom:10px;">
    <p><strong style="color:pink !important;">'.fw_theme_mod('fw_order_gift_note_placeholder').'</strong></p>
    <p><strong>'.__('Message','fastway').'</strong> ' . $r5 . '</p>
    <p><strong>'.__('Phone number','fastway').'</strong> ' . $r1 . '</p>
    <p><strong>'.__('Shipping date','fastway').'</strong> ' . $r2 . '</p>
    </div>';
  } 
}


if(fw_theme_mod('fw_trans_comprobantes') && fw_theme_mod('fw_trans_comprobantes_id')){
  add_action('init', 'init_falta_verif' );
  add_action('woocommerce_order_details_before_order_table','file_order_upload');
  add_filter('wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );
  add_action('woocommerce_admin_order_data_after_shipping_address', 'admin_display_comprobante', 10, 1 );
  add_action('gform_after_submission', 'trabajar_file',10,2);
  add_action("woocommerce_order_status_changed", "email_order_verif");
  
  
  function email_order_verif($order_id, $checkout=null) {
    global $woocommerce;
    $order = new WC_Order( $order_id );
    if($order->status === 'await-verif' ) {
        $subject= fw_parse_subject('customer_await_verif_order',fw_get_email_variables($order));
        $body= fw_parse_mail_return('customer_await_verif_order',$order);

        $mailer = $woocommerce->mailer();
        $message = $mailer->wrap_message(sprintf( $subject, $order->get_order_number() ), $body );
        $mailer->send( $order->billing_email, sprintf( $subject, $order->get_order_number() ), $message );
    }if($order->status === 'preparacion' ) {
      $subject= fw_parse_subject('customer_preparacion_order',fw_get_email_variables($order));
      $body= fw_parse_mail_return('customer_preparacion_order',$order);

      $mailer = $woocommerce->mailer();
      $message = $mailer->wrap_message(sprintf( $subject, $order->get_order_number() ), $body );
      $mailer->send( $order->billing_email, sprintf( $subject, $order->get_order_number() ), $message );
  }else if($order->status === 'despachado' ) {
      $subject= fw_parse_subject('customer_despachado_order',fw_get_email_variables($order));
      $body= fw_parse_mail_return('customer_despachado_order',$order);

      $mailer = $woocommerce->mailer();
      $message = $mailer->wrap_message(sprintf( $subject, $order->get_order_number() ), $body );
      $mailer->send( $order->billing_email, sprintf( $subject, $order->get_order_number() ), $message );
    }else if($order->status === 'processing' ) {//esto es un fix no se porque no se envia la transicion de await verif a processing
      $subject= fw_parse_subject('customer_processing_order',fw_get_email_variables($order));
      $body= fw_parse_mail_return('customer_processing_order',$order);

      $mailer = $woocommerce->mailer();
      $message = $mailer->wrap_message(sprintf( $subject, $order->get_order_number() ), $body );
      $mailer->send( $order->billing_email, sprintf( $subject, $order->get_order_number() ), $message );
    }
  }

  function file_order_upload($order){
    $order_id=$order->id;
    $url_comprobante = get_post_meta( $order_id, 'comprobante', true );
    if($url_comprobante){
      echo '<span class="fw_subir_comprobante">Comprobante: <a target="_blank" href="' . $url_comprobante . '">Abrir</a></span> ';
    }else{
      echo do_shortcode('[gravityform id="'.fw_theme_mod('fw_trans_comprobantes_id').'" title="false" description="false" ajax="true" field_values="order_id='.$order_id.'"]');
    }
  } 
  function trabajar_file($entry, $form) {
    $arra=explode('/',$entry['source_url']);
    $order_id=explode('/',$entry['source_url'])[count($arra)-2];
    $file=$entry[1];

    $order = new WC_Order($order_id);
    if($order){
      $order->update_status( 'await-verif', 'El pedido se ha actualiado', true );
    }

    update_post_meta( $order_id, 'comprobante', $file );
  }
  function add_awaiting_shipment_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-on-hold' === $key ) {
            $new_order_statuses['wc-on-hold'] ='Esperando comprobante';
            $new_order_statuses['wc-await-verif'] = 'Falta verificar';
            $new_order_statuses['wc-preparacion'] ='En preparación';
            $new_order_statuses['wc-despachado'] = 'Despachado';
        }
    }
    return $new_order_statuses;
  }

  function admin_display_comprobante( $order ){
    $url_comprobante = get_post_meta( $order->get_id(), 'comprobante', true );
    if($url_comprobante){
      echo '<span style="margin-top:20px;">Comprobante: <a target="_blank" href="' . $url_comprobante . '">Abrir</a></span>';
    }else{
      echo '<span style="margin-top:20px;">Comprobante: NO TIENE</span>';
    }
  }

}


function init_falta_verif() {
  register_post_status( 'wc-preparacion', array(
      'label'                     => 'En preparación',
      'public'                    => true,
      'show_in_admin_status_list' => true,
      'show_in_admin_all_list'    => true,
      'exclude_from_search'       => false,
      'label_count'               => _n_noop( 'En preparación <span class="count">(%s)</span>', 'En preparación <span class="count">(%s)</span>' )
  ));
  register_post_status( 'wc-await-verif', array(
      'label'                     => 'Falta verificar',
      'public'                    => true,
      'show_in_admin_status_list' => true,
      'show_in_admin_all_list'    => true,
      'exclude_from_search'       => false,
      'label_count'               => _n_noop( 'Falta verificar <span class="count">(%s)</span>', 'Falta verificar <span class="count">(%s)</span>' )
  ));
  register_post_status( 'wc-despachado', array(
    'label'                     => 'Despachado',
    'public'                    => true,
    'show_in_admin_status_list' => true,
    'show_in_admin_all_list'    => true,
    'exclude_from_search'       => false,
    'label_count'               => _n_noop( 'Despachado <span class="count">(%s)</span>', 'Despachado <span class="count">(%s)</span>' )
  ));
}
?>