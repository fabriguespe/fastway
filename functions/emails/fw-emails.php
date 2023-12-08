<?php

add_shortcode('getMailQueRecibe','getMailQueRecibe');
function getMailQueRecibe(){
    if(!empty(fw_theme_mod("fw_mail_desde_mails")))return fw_theme_mod("fw_mail_desde_mails");
    else return getMailQueEnvia();
}
function getMailQueEnvia(){
    if(fw_theme_mod("fw_general_from_email"))return fw_theme_mod("fw_general_from_email");
    else if(count(explode(",",fw_theme_mod("fw_mail_desde_mails")))>1){
        return explode(",",fw_theme_mod("fw_mail_desde_mails"))[0];
    }else if(!empty(fw_theme_mod("fw_mail_desde_mails"))){
        return fw_theme_mod("fw_mail_desde_mails");
    }else if(count(explode(",",fw_theme_mod("short-fw_companyemail")))>1){
        return explode(",",fw_theme_mod("short-fw_companyemail"))[0];
    }else if(!empty(fw_theme_mod("short-fw_companyemail"))){
        return fw_theme_mod("short-fw_companyemail");
    }else {
        return "";
    }
}

function getNombreQueEnvia(){
if(fw_theme_mod("fw_general_from_name"))return fw_theme_mod("fw_general_from_name");
else if(fw_theme_mod("fw_mail_desde_nombre"))return fw_theme_mod("fw_mail_desde_nombre");
else return get_bloginfo( 'name' );
}

// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
function wpb_sender_email( $original_email_address ) {
    return getMailQueEnvia();
}
 
// Function to change sender name
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
function wpb_sender_name( $original_email_from ) {
    return getNombreQueEnvia();
}



add_filter('woocommerce_email_recipient_backorder', 'change_stock_email_recipient', 10, 2 ); // For Backorders notification
add_filter('woocommerce_email_recipient_low_stock', 'change_stock_email_recipient', 10, 2 ); // For Low stock notification
add_filter('woocommerce_email_recipient_no_stock', 'change_stock_email_recipient', 10, 2 ); // For No stock notification
add_filter('woocommerce_email_recipient_new_order', 'change_stock_email_recipient', 1, 2);
add_filter('woocommerce_email_recipient_failed_order', 'change_stock_email_recipient', 1, 2);
add_filter('woocommerce_email_recipient_cancelled_order', 'change_stock_email_recipient', 1, 2);

 
if(fw_theme_mod('fw_mail_bcc'))add_filter( 'woocommerce_email_headers', 'fw_add_bcc_to_all', 9999, 3 );
function fw_add_bcc_to_all( $headers, $email_id, $order ) {
    $headers .= "Bcc: ".get_bloginfo('name')." <".fw_theme_mod('fw_mail_bcc').">" . "\r\n";
    //$headers .= "Bcc: ".get_bloginfo('name')." <".$email_id.">" . "\r\n";
    return $headers;
}


if(fw_theme_mod("fw_action_resetmails_notis")){
    update_option("woocommerce_new_order_recipient",getMailQueRecibe());
    update_option("woocommerce_cancelled_order_recipient",getMailQueRecibe());
    update_option("woocommerce_failed_order_recipient",getMailQueRecibe());
    update_option("woocommerce_product_enquiry_send_to",getMailQueRecibe());
    update_option("woocommerce_stock_email_recipient",getMailQueRecibe());
    update_option("sendgrid_from_email",getMailQueEnvia());
    update_option("woocommerce_email_from_address",getMailQueEnvia());
    update_option("woocommerce_email_from_name",getNombreQueEnvia());
    update_option("sendgrid_from_name",getNombreQueEnvia());

    set_theme_mod('fw_action_resetmails_notis',false);
}


if(fw_theme_mod("fw_action_resetmails_styling")){
    //Mail woocommerce
    update_option("woocommerce_email_header_image",fw_theme_mod('fw-email-logo')?fw_theme_mod('fw-email-logo'):fw_theme_mod('general-logo') );
    update_option("woocommerce_email_footer_text","Powered by ".fw_theme_mod('fw_dev_name'));
    update_option("woocommerce_email_base_color",fw_theme_mod('opt-color-main'));

    set_theme_mod('fw_action_resetmails_styling',false);
}






function change_stock_email_recipient( $recipient, $product ) {
    return getMailQueRecibe();
}


// The email function hooked that display the text
add_action( 'woocommerce_email_order_details', 'fw_display_applied_coupons', 10, 4 );
function fw_display_applied_coupons( $order, $sent_to_admin, $plain_text, $email ) {
    $coupon_codes=[];
    // Only for admins and when there at least 1 coupon in the order
    if ( ! $sent_to_admin && count($order->get_items('coupon') ) == 0 ) return;

    foreach( $order->get_items('coupon') as $coupon ){
        $coupon_codes[] = $coupon->get_code();
    }
    // For one coupon
    if( count($coupon_codes) == 1 ){
        $coupon_code = reset($coupon_codes);
        echo '<p>'.__('Code:','fastway').$coupon_code.'<p>';
    } 
    // For multiple coupons
    else if(count($coupon_codes) >1) {
        $coupon_codes = implode( ', ', $coupon_codes);
        echo '<p>'.__('Code:','fastway').$coupon_codes.'<p>';
    }
}



function fw_parse_subject($tipo,$emailValues){
    $subject=fw_theme_mod('fw_email_subject_'.$tipo);
    foreach ($emailValues as $key => $value) $subject = str_replace("{{". $key . "}}", $value, $subject);
    return $subject;
}

function fw_parse_mail_accounts($tipo,$emailValues){
  $html=fw_theme_mod('fw_email_content_'.$tipo);
  $html=conditionals($html,$emailValues);
  foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
  return wp_kses_post( wpautop( wptexturize($html)));

}
function fw_parse_mail_return($tipo,$order){
  $emailValues = fw_get_email_variables($order);
  $html=fw_theme_mod('fw_email_content_'.$tipo);
  $html=conditionals($html,$emailValues);
  foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
  return wp_kses_post( wpautop( wptexturize($html)));
}
function fw_parse_mail($tipo,$order, $sent_to_admin=false, $plain_text=false,$email_heading=false,$email=false){
  do_action( 'woocommerce_email_header', $email_heading, $email ); 
  $emailValues = fw_get_email_variables($order, $sent_to_admin, $plain_text, $email);
  $html=fw_theme_mod('fw_email_content_'.$tipo);
  $html=conditionals($html,$emailValues);
  foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
  echo wp_kses_post( wpautop( wptexturize($html)));
}

function fw_get_email_variables($order, $sent_to_admin=false, $plain_text=false, $email=false){

    if($sent_to_admin || $plain_text || $email){
        ob_start();
        do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
        $order_details = ob_get_contents();
        ob_end_clean();
    
        ob_start(); 
        do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
        $order_meta = ob_get_contents();
        ob_end_clean();
    
        ob_start();
        do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
        $customer_details = ob_get_contents();
        ob_end_clean();
    }

    $shipping_method = @array_shift($order->get_shipping_methods());
    $shipping_method_type = $shipping_method['method_id'];
    $shipping_method_id = $shipping_method['instance_id'];
    $shipping_method_title = $shipping_method['method_title'];
    if($order->get_customer_id()){
        $the_user = get_user_by( 'id', $order->get_customer_id() ); // 54 is a user ID
        $roles = ( array ) $the_user->roles;
        $role=$roles[0];
    }else if(!$order->get_customer_id() && get_option('woocommerce_enable_guest_checkout')){
        $role='guest';
    }else{
        $role='';
    }

    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest'  || $role == '' )$role='minorista';
    $customer_name=$order->billing_first_name.' '.$order->billing_last_name;

    $arra= array(
        'blogname' => get_bloginfo( 'name' ),
        'email' => '<a href="mailto:'.getMailQueEnvia().'">'.getMailQueEnvia().'</a>',
        'order_number' => '#'.$order->get_order_number(),
        'shipping_tracking_url' => '<a target="_blank" href="'.$order->get_meta('_tracking_url').'">'.$order->get_meta('_tracking_url').'</a>' ,
        'shipping_method_title' => $shipping_method_title,
        'shipping_method_type' => $shipping_method_type,
        'shipping_method_id' => $shipping_method_id,
        'payment_method_id' => $order->payment_method,
        'payment_method_title' => $order->payment_method_title,
        'order_details' => $order_details,
        'order_url' => $order->get_view_order_url(),
        'role' => $role,
        'real_role' => $role,
        'order_meta' => $order_meta,
        'customer_email' => $order->billing_email,
        'customer_name' => $customer_name,
        'customer_details' => $customer_details
    );
    if(isAltoweb())$arra['bank_info']=altoweb_bancos();
    return $arra;
}


add_shortcode('fw_email_content_confirmation_wholesale_form','fw_email_content_confirmation_wholesale_form');
function fw_email_content_confirmation_wholesale_form(){
  return fw_theme_mod('fw_email_content_confirmation_wholesale_form');
}   
function get_account_variables_for_templates($user=null,$u_login=null,$key=null){
  global $woocommerce;
  if($user){
    $key = get_password_reset_key( $user );
    $user_login=$user->user_login;
    $user_pass=$user->user_pass;
    $activation_url=wc_get_page_permalink('myaccount')."?action=rp&key=".$key."&login=" . rawurlencode($user_login);
    //$activation_url=network_site_url("wp-login.php?action=rp&key=".$key."&login=" . rawurlencode($user_login), 'login') ;
  }else if($key){//activation por wpmu
    global $current_user;
    $activation_url=site_url( "wp-activate.php?key=$key" );
    if(!$user_login && $u_login)$user_login=$u_login;
    error_log(print_r($user_login,true));
    $new_pass_link=wc_get_page_permalink('myaccount')."?action=rp&key=".$key."&login=".rawurlencode($user_login);
  }

  $emailValues = array(
    'blogname' => get_bloginfo('name'),
    'user_name' => esc_html( $user_login),
    'user_pass' => esc_html( $user_pass),
    'activation_url'=> $activation_url,
    'new_pass_link'=> $new_pass_link
  );
  
  if(is_plugin_active('woocommerce/woocommerce.php'))$emailValues['myaccount']=make_clickable( esc_url( wc_get_page_permalink('myaccount')));
  return $emailValues;
}

add_filter('woocommerce_email_subject_customer_reset_password', 'woocommerce_email_subject_customer_reset_password', 1, 2);
function woocommerce_email_subject_customer_reset_password( $subject, $order ) {
    return fw_parse_subject('customer_reset_password',get_account_variables_for_templates());
}

add_filter('woocommerce_email_subject_customer_new_account', 'woocommerce_email_subject_customer_new_account', 1, 2);
function woocommerce_email_subject_customer_new_account( $subject, $order ) {
  return fw_parse_subject('customer_new_account',get_account_variables_for_templates());
}
//ORDERs
add_filter('woocommerce_email_subject_customer_completed_order', 'woocommerce_email_subject_customer_completed_order', 1, 2);
function woocommerce_email_subject_customer_completed_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_completed_order',$vars);
}

add_filter('woocommerce_email_subject_customer_on_hold_order', 'woocommerce_email_subject_customer_on_hold_order', 1, 2);
function woocommerce_email_subject_customer_on_hold_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_on_hold_order',$vars);
}

add_filter('woocommerce_email_subject_customer_processing_order', 'woocommerce_email_subject_customer_processing_order', 1, 2);
function woocommerce_email_subject_customer_processing_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('customer_processing_order',$vars);
}

add_filter('woocommerce_email_subject_admin_new_order', 'woocommerce_email_subject_admin_new_order', 1, 2);
function woocommerce_email_subject_admin_new_order( $subject, $order ) {
    $vars = fw_get_email_variables($order);
    return fw_parse_subject('admin_new_order',$vars);
}

/*CSS*/
add_filter( 'woocommerce_email_styles', 'bbloomer_add_css_to_emails', 9999, 2 );
function bbloomer_add_css_to_emails( $css, $email ) { 
   $css .= fw_theme_mod('css_editor-email');
   return $css;
}

//Emails

add_filter( 'gform_notification', 'change_autoresponder_email',10,3);
function change_autoresponder_email( $notification, $form, $entry ) {
    //code nuevo
    $user=get_user_by( 'email', $notification['to']);
    error_log(print_r($user,true));
    if ( $notification['event']=='gfur_user_activation' ||  $notification['name'] == 'User Pending' || $notification['name'] == 'Alta Mayorista' ) {
        $notification['subject'] = fw_parse_subject('gf_pending',get_account_variables_for_templates($user));
        $notification['message'] =  fw_parse_mail_accounts('gf_pending',get_account_variables_for_templates($user));
    }else if ( $notification['event']=='gfur_user_activated' ||  $notification['name'] == 'User Activation' ) {
        $notification['subject'] = fw_parse_subject('gf_activated',get_account_variables_for_templates($user));
        $notification['message'] =  fw_parse_mail_accounts('gf_activated',get_account_variables_for_templates($user));
        //Aca esta la clave para desactivar default! cambiar el nombre!
    }else if ( ($notification['name'] == 'Admin Notification' || $notification['name'] == 'Notificación del administrador' || $notification['name'] == 'Contacto Mayorista') && $notification['toType']=='email' ) {
        $notification['to'] = getMailQueRecibe();
    }
    //Admin Notification
    //Notificación del administrador
    //Contacto Mayorista    
    return $notification;
}
function was_form_signup($key){
    global $wpdb;
    $signup = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->signups WHERE activation_key = %s", $key ) );

    return strpos($signup->meta, 'entry_id') !== false;
}

//Este se manda creando un nuevo usuario desde el admin
add_filter( 'wpmu_signup_user_notification', 'edit_user_notification_email2', 10, 4 );
function edit_user_notification_email2($user_login, $user_email, $key, $meta = '') {
        if(was_form_signup($key))return false;
        $wp_new_user_notification_email=[];
        $wp_new_user_notification_email['subject'] = fw_parse_subject('gf_activated',get_account_variables_for_templates());
        $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('gf_activated',get_account_variables_for_templates(null,$user_login,$key));
        $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($user_email, $wp_new_user_notification_email['subject'], $wp_new_user_notification_email['message'], $wp_new_user_notification_email['headers']);
        return false;
}
    
//Este se manda creando un nuevo usuario desde el admin y dps de activar la cuenta
add_filter( 'wpmu_welcome_user_notification', 'edit_user_notification_email3', 10, 3 );
function edit_user_notification_email3($user_id, $password, $meta = '') {
        $user = new WP_User($user_id);
        $user->user_pass=$password;
        $wp_new_user_notification_email=[];
        $wp_new_user_notification_email['subject'] = fw_parse_subject('customer_new_account',get_account_variables_for_templates());
        $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('customer_new_account',get_account_variables_for_templates($user));
        $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($user->user_email, $wp_new_user_notification_email['subject'], $wp_new_user_notification_email['message'], $wp_new_user_notification_email['headers']);
        return false;
}


//Este se manda para los aprovaciones del formulario
add_filter( 'wp_new_user_notification_email' , 'edit_user_notification_email', 10, 3 );
function edit_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
    $wp_new_user_notification_email['subject'] = fw_parse_subject('gf_activated',get_account_variables_for_templates());
    $wp_new_user_notification_email['message'] =  fw_parse_mail_accounts('gf_activated',get_account_variables_for_templates($user));
    $wp_new_user_notification_email['headers'] = array('Content-Type: text/html; charset=UTF-8');
   
    return $wp_new_user_notification_email;
}

function se_comment_moderation_recipients( $emails, $comment_id ) {
    $emails[0]=getMailQueRecibe();
    return $emails;
}
add_filter( 'comment_moderation_recipients', 'se_comment_moderation_recipients', 11, 2 );
add_filter( 'comment_notification_recipients', 'se_comment_moderation_recipients', 11, 2 );


function conditionals($template,$data) {
    $conditionals=array();
    //https://gist.github.com/nathanpitman/3721008
    if (preg_match_all('#'.'{{'.'if (.+)'.'}}'.'(.+)'.'{{'.'/if'.'}}'.'#sU', $template, $conditionals, PREG_SET_ORDER)) {

        if(count($conditionals) > 0) {

            foreach($conditionals AS $condition) {

                $raw_code = (isset($condition[0])) ? $condition[0] : FALSE;
                $cond_str = (isset($condition[1])) ? $condition[1] : FALSE;
                $insert = (isset($condition[2])) ? $condition[2] : '';

                if(!preg_match('/('.'{{'.'|'.'}}'.')/', $cond_str, $problem_cond)) {
                    // If the the conditional statment is formated right, lets procoess it!
                    if(!empty($raw_code) OR $cond_str != FALSE OR !empty($insert)) {
                        // Get the two values
                        $cond = preg_split("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str);
                        // Do we have a valid if statment?
                        if(count($cond) == 8) {
                            preg_match_all("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
                            $cond_m=$cond_m[0];
                            array_push($cond, ($cond_m[0]));
                            array_push($cond, ($cond_m[1]));
                            array_push($cond, ($cond_m[2]));
                            array_push($cond, ($cond_m[3]));
                            array_push($cond, ($cond_m[4]));
                            array_push($cond, ($cond_m[5]));
                            array_push($cond, ($cond_m[6]));
                            
                            // Remove quotes - they cause to many problems! 
                            $cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0]))); 
                            $cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));
                            $cond[2]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[2])));
                            $cond[3]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[3])));
                            $cond[4]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[4])));
                            $cond[5]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[5])));
                            $cond[6]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[6])));
                            $cond[7]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[7])));
                            $cond[8]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[8])));
                            $cond[9]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[9])));
                            $cond[10]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[10])));
                            $cond[11]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[11])));
                            $cond[12]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[12])));
                            $cond[13]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[13])));
                            $cond[14]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[14])));
  

                            eval("\$result1 = (\"".$data[$cond[0]]."\" ".$cond[8]." \"".$cond[1]."\") ? TRUE : FALSE;");
                            eval("\$result2 = (\"".$data[$cond[2]]."\" ".$cond[10]." \"".$cond[3]."\") ? TRUE : FALSE;");
                            eval("\$result3 = (\"".$data[$cond[4]]."\" ".$cond[12]." \"".$cond[5]."\") ? TRUE : FALSE;");
                            eval("\$result4 = (\"".$data[$cond[6]]."\" ".$cond[14]." \"".$cond[7]."\") ? TRUE : FALSE;");

                            
                            if($cond[9]=='OR')$cond[9]="||";
                            if($cond[9]=='AND')$cond[9]="&&";
                            if($cond[11]=='OR')$cond[11]="||";
                            if($cond[11]=='AND')$cond[11]="&&";
                            if($cond[13]=='OR')$cond[13]="||";
                            if($cond[13]=='AND')$cond[13]="&&";

                            eval("\$result = \$result1 ".$cond[9]." \$result2 ".$cond[11]." \$result3 ".$cond[13]." \$result4;");
                            //error_log("\$result = \$result1 ".$cond[9]." \$result2 ".$cond[11]." \$result3 ".$cond[13]." \$result4;");

                        }else if(count($cond) == 6) {
                            preg_match_all("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
                            $cond_m=$cond_m[0];
                            array_push($cond, ($cond_m[0]));
                            array_push($cond, ($cond_m[1]));
                            array_push($cond, ($cond_m[2]));
                            array_push($cond, ($cond_m[3]));
                            array_push($cond, ($cond_m[4]));
                            
                            // Remove quotes - they cause to many problems! 
                            $cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0]))); 
                            $cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));
                            $cond[2]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[2])));
                            $cond[3]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[3])));
                            $cond[4]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[4])));
                            $cond[5]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[5])));
                            $cond[6]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[6])));
                            $cond[7]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[7])));
                            $cond[8]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[8])));
                            $cond[9]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[9])));
                            $cond[10]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[10])));
                            
                            //error_log(print_r($cond,true));   

                            eval("\$result1 = (\"".$data[$cond[0]]."\" ".$cond[6]." \"".$cond[1]."\") ? TRUE : FALSE;");
                            eval("\$result2 = (\"".$data[$cond[2]]."\" ".$cond[8]." \"".$cond[3]."\") ? TRUE : FALSE;");
                            eval("\$result3 = (\"".$data[$cond[4]]."\" ".$cond[10]." \"".$cond[5]."\") ? TRUE : FALSE;");
                            //error_log("\$result1 = (\"".$data[$cond[0]]."\" ".$cond[6]." \"".$cond[1]."\") ? TRUE : FALSE;");
                            //error_log("\$result2 = (\"".$data[$cond[2]]."\" ".$cond[8]." \"".$cond[3]."\") ? TRUE : FALSE;");
                            //error_log("\$result3 = (\"".$data[$cond[4]]."\" ".$cond[10]." \"".$cond[5]."\") ? TRUE : FALSE;");


                            if($cond[7]=='OR')$cond[7]="||";
                            if($cond[7]=='AND')$cond[7]="&&";
                            if($cond[9]=='OR')$cond[9]="||";
                            if($cond[9]=='AND')$cond[9]="&&";

                            eval("\$result = \$result1 ".$cond[7]." \$result2 ".$cond[9]." \$result3;");
                            //error_log("\$result = \$result1 ".$cond[7]." \$result2 ".$cond[9]." \$result3;");
                            //error_log($result);

                        }else if(count($cond) == 4) {
                            preg_match_all("/(\!=|==|<=|>=|<>|<|>|AND|OR|&&)/", $cond_str, $cond_m);
                            $cond_m=$cond_m[0];
                            array_push($cond, ($cond_m[0]));
                            array_push($cond, ($cond_m[1]));
                            array_push($cond, ($cond_m[2]));
                            
                            // Remove quotes - they cause to many problems! 
                            $cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0]))); 
                            $cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));
                            $cond[2]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[2])));
                            $cond[3]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[3])));
                            $cond[4]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[4])));

                            //error_log(print_r($cond,true));   

                            eval("\$result1 = (\"".$data[$cond[0]]."\" ".$cond[4]." \"".$cond[1]."\") ? TRUE : FALSE;");
                            eval("\$result2 = (\"".$data[$cond[2]]."\" ".$cond[6]." \"".$cond[3]."\") ? TRUE : FALSE;");

                            if($cond[5]=='OR')$result=$result1 || $result2;
                            if($cond[5]=='AND')$result=$result1 && $result2;

                        }else if(count($cond) == 2) {
                            // Get condition
                            preg_match("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
                            array_push($cond, strtolower($cond_m[0]));

                            // Remove quotes - they cause to many problems! 
                            $cond[0]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[0]))); 
                            $cond[1]=str_replace('"', "", str_replace("'", "", str_replace(" ", "", $cond[1])));

                            // Test condition
                            eval("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");

                            //error_log("\$result = (\"".$data[$cond[0]]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");
                        } else {

                            //aca solo entra si no hay comparacion
                            // Looks like a if 'variable' conditional, let's make sure the variable is set
                            
                            if (isset($data->$cond_str)) {
                                // Check the variable isn't empty...
                                if (!empty($data->$cond_str)) {
                                    // This adds support for using {if var}then this{/if}
                                    $result = TRUE;
                                } else {
                                    $result = FALSE;
                                }
                            } else {
                                $result = FALSE;
                            }

                            $result = (isset($data->$cond_str)) ? TRUE : FALSE;

                        }
                    }

                    // If the condition is TRUE then show the text block
                    $insert = preg_split('#'.'{{'.'else'.'}}'.'#sU', $insert);
                    if($result == TRUE){
                        $template = str_replace($raw_code, $insert[0], $template);
                    } else {
                        // Do we have an else statment?
                        if(is_array($insert)){
                            $insert = (isset($insert[1])) ? $insert[1] : '';
                            $template = str_replace($raw_code, $insert, $template);
                        } else {
                            $template = str_replace($raw_code, '', $template);
                        }
                    }

                } elseif(!$show_errors) {
                    // Remove any if statments we can't process
                    $template = str_replace($raw_code, '', $template);
                }
            
            }

        }
    }
    return $template;
}





// fixes other password reset related urls
add_filter( 'network_site_url', function($url, $path, $scheme) {
if (stripos($url, "action=lostpassword") !== false)return wc_get_page_permalink('myaccount').'?action=lostpassword';
return $url;
}, 10, 3 );
  
function wp_set_html_mail_content_type() {return 'text/html';}
add_filter( 'wp_mail_content_type', 'wp_set_html_mail_content_type' );

add_filter("retrieve_password_message", "mapp_custom_password_reset", 99, 4);
function mapp_custom_password_reset($message, $key, $user_login, $user_data )    {
    return fw_parse_mail_accounts('customer_new_password',get_account_variables_for_templates(null,$user_login,$key));
}


// fixes email title
add_filter("retrieve_password_title", function($title) {return fw_parse_subject('customer_new_password',get_account_variables_for_templates());});
  
  

function kia_display_email_order_user_meta( $order, $sent_to_admin, $plain_text ) {
    if(get_post_meta( $order->get_id(), '_billing_dni', true ))echo "CUIT: ".get_post_meta( $order->get_id(), '_billing_dni', true ).'<br>';
}
add_action('woocommerce_email_customer_details', 'kia_display_email_order_user_meta', 30, 3 );

?>