<?php
function fix_templates($mail){
  $mail=preg_replace('/\\\\{2,}/', '',$mail);
  
  $mail=stripslashes(htmlspecialchars_decode($mail));
  return $mail;
}

if($_POST && $_POST['option_page']=='fw_email_options_group' && $_POST['action']=='update'){
  
  set_theme_mod('fw_email_subject_customer_processing_order', fix_templates( ($_POST['fw_email_subject_customer_processing_order'])));
  set_theme_mod('fw_email_content_customer_processing_order', fix_templates( ($_POST['fw_email_content_customer_processing_order'])));
  set_theme_mod('fw_email_subject_customer_completed_order', fix_templates( ($_POST['fw_email_subject_customer_completed_order'])));
  set_theme_mod('fw_email_content_customer_completed_order', fix_templates( ($_POST['fw_email_content_customer_completed_order'])));
  set_theme_mod('fw_email_subject_customer_on_hold_order', fix_templates( ($_POST['fw_email_subject_customer_on_hold_order'])));
  set_theme_mod('fw_email_content_customer_on_hold_order', fix_templates( ($_POST['fw_email_content_customer_on_hold_order'])));

  set_theme_mod('fw_email_subject_customer_new_account',fix_templates( ($_POST['fw_email_subject_customer_new_account'])));
  set_theme_mod('fw_email_content_customer_new_account',fix_templates( ($_POST['fw_email_content_customer_new_account'])));
  set_theme_mod('fw_email_subject_customer_reset_password',fix_templates( ($_POST['fw_email_subject_customer_reset_password'])));
  set_theme_mod('fw_email_content_customer_reset_password',fix_templates( ($_POST['fw_email_content_customer_reset_password'])));
  set_theme_mod('fw_email_subject_customer_new_password',fix_templates( ($_POST['fw_email_subject_customer_new_password'])));
  set_theme_mod('fw_email_content_customer_new_password',fix_templates( ($_POST['fw_email_content_customer_new_password'])));
  set_theme_mod('fw_email_subject_gf_activated',fix_templates( ($_POST['fw_email_subject_gf_activated'])));
  set_theme_mod('fw_email_content_gf_activated',fix_templates( ($_POST['fw_email_content_gf_activated'])));

  set_theme_mod('fw_email_content_confirmation_wholesale_form',fix_templates( ($_POST['fw_email_content_confirmation_wholesale_form'])));
  set_theme_mod('fw_email_content_product_summary',fix_templates( ($_POST['fw_email_content_product_summary'])));
  set_theme_mod('fw_email_subject_gf_pending',fix_templates( ($_POST['fw_email_subject_gf_pending'])));
  set_theme_mod('fw_email_content_gf_pending',fix_templates( ($_POST['fw_email_content_gf_pending'])));
  set_theme_mod('fw_email_subject_admin_new_order',fix_templates( ($_POST['fw_email_subject_admin_new_order'])));
  set_theme_mod('fw_email_content_admin_new_order',fix_templates( ($_POST['fw_email_content_admin_new_order'])));
  set_theme_mod('fw_email_content_thankyou',fix_templates( ($_POST['fw_email_content_thankyou'])));
  set_theme_mod('fw_email_subject_customer_await_verif_order',fix_templates( ($_POST['fw_email_subject_customer_await_verif_order'])));
  set_theme_mod('fw_email_content_customer_await_verif_order',fix_templates( ($_POST['fw_email_content_customer_await_verif_order'])));
  set_theme_mod('fw_email_subject_customer_preparacion_order',fix_templates( ($_POST['fw_email_subject_customer_preparacion_order'])));
  set_theme_mod('fw_email_content_customer_preparacion_order',fix_templates( ($_POST['fw_email_content_customer_preparacion_order'])));

}
function myplugin_register_settings() {register_setting( 'fw_email_options_group', 'fw_email_subject_customer_new_account', 'myplugin_callback' );}
add_action( 'admin_init', 'myplugin_register_settings' );
function myplugin_register_options_page() {add_options_page('Email Templates', 'Email Templates', 'manage_options', 'myplugin', 'myplugin_options_page');}
add_action('admin_menu', 'myplugin_register_options_page');

function myplugin_options_page(){
  $customer_emails_vars.='
  <a href="'.fw_theme_mod('fw_dev_docsurl').'">'.__('Docs','fastway').'</a><br>
  <b>'.__('Variables','fastway').':</b>
  <br><small>{{blogname}} {{customer_email}} {{customer_name}} {{order_number}} {{order_url}} {{order_details}} {{order_meta}} {{customer_details}} {{shipping_method_title}} {{shipping_method_type}} {{shipping_method_id}} {{payment_method_id}} {{role}} {{bank_info}} {{payment_method_title}} </small>
  <br><b>'.__('Payment Methods','fastway').'('.__('values','fastway').')</b>
  <br><small>';
  foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway ) {
      if( $gateway->enabled == 'yes' ) {
          $customer_emails_vars.=$gateway->title.' ('.$gateway->id.') , ';
      }
  }
  if(empty(WC()->payment_gateways->get_available_payment_gateways()))$customer_emails_vars.='No payment methods yet';
  /*$customer_emails_vars.='<br><b>'.__('Shipping Methods','fastway').'('.__('values','fastway').')</b>
  <br><small>';
  foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway ) {
      if( $gateway->enabled == 'yes' ) {
          $customer_emails_vars.=$gateway->title.' ('.$gateway->id.') , ';
      }
  }
  if(empty(WC()->payment_gateways->get_available_payment_gateways()))$customer_emails_vars.='No payment methods yet';*/
  $customer_emails_vars.='</small><br><b>'.__('Roles','fastway').' ('.__('values','fastway').'):</b>
  <br><small>';
  $roles=array();
  foreach ( get_editable_roles() as $role => $value ) {
    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' || $role == '' )$role='minorista';
    if(!in_array($role,$roles))array_push($roles,$role.',');
  }
  $customer_emails_vars.=implode(' ',$roles).'</small>';
?>
<div>

<style>
.valinfo{
  background:white !important;
  padding:5px;
}
/* Style the tab */
.tab {
margin-top:20px;
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 0px;
  border: 0px solid #ccc;
  border-top: none;
}
</style>
<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<?php screen_icon(); ?>
<form method="post" class="wrap" action="options.php">
<?php settings_fields( 'fw_email_options_group' ); ?>
<div class="tab">
  <button type="button" class="tablinks active" onclick="openCity(event, 'customer_emails')"><?=__('Orders','fastway')?></button>
  <button type="button" class="tablinks " onclick="openCity(event, 'account_emails')"><?=__('Authentication','fastway')?></button>
  <?php
if(is_plugin_active('gravityformsuserregistration/userregistration.php')){
?>
  <button type="button" class="tablinks" onclick="openCity(event, 'wholesale')"><?=__('Wholesale','fastway')?></button>
<?php } ?>
  <button type="button" class="tablinks" onclick="openCity(event, 'other')"><?=__('Other','fastway')?></button>
</div>

<div class="valinfo"><?=$customer_emails_vars;?></div>
<!-- Tab content -->
<div id="account_emails" class="tabcontent" style=";">
<div class="tipomail">
<h3 class="titulo"><?=__( 'New Account', 'fastway' )?></h3>
<small><?=__( 'Customer "new account" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_new_account" name="fw_email_subject_customer_new_account" value="<?php echo fw_theme_mod('fw_email_subject_customer_new_account'); ?>" />
<small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}}</small><br>
<?php
$content = fw_theme_mod('fw_email_content_customer_new_account');
wp_editor( $content, 'fw_email_content_customer_new_account', $settings = array('textarea_rows'=> '10') );
?>
</div>
<!-- Tab content -->
<div class="tipomail">
<h3 class="titulo"><?=__( 'New Password', 'fastway' )?></h3>
<small><?=__( 'Customer "new account" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_new_password" name="fw_email_subject_customer_new_password" value="<?php echo fw_theme_mod('fw_email_subject_customer_new_password'); ?>" />
<small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}}</small><br>
<?php
$content = fw_theme_mod('fw_email_content_customer_new_password');
wp_editor( $content, 'fw_email_content_customer_new_password', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Reset password', 'woocommerce' )?></h3>
<small><?=__( 'Customer "reset password" emails are sent when customers reset their passwords.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_reset_password" name="fw_email_subject_customer_reset_password" value="<?php echo fw_theme_mod('fw_email_subject_customer_reset_password'); ?>" /><br>
<small>Variables: {{blogname}} {{user_name}} {{user_pass}} {{myaccount}} {{reset_link}}</small><br>
<?php
$content = fw_theme_mod('fw_email_content_customer_reset_password');
wp_editor( $content, 'fw_email_content_customer_reset_password', $settings = array('textarea_rows'=> '10') );
?>
</div>

<div class="tipomail">
<h3 class="titulo"><?=__('Activation','fastway')?></h3>
<small><?=__('Sent after the user is approved internally and a link for generating a password is sent to him','fastway')?></small>
<input type="text" class="w100" id="fw_email_subject_gf_activated" name="fw_email_subject_gf_activated" value="<?php echo fw_theme_mod('fw_email_subject_gf_activated'); ?>" /><br>
<small>Variables:{{user_login}} {{activation_url}}</small>
<?php
$content = fw_theme_mod('fw_email_content_gf_activated');
wp_editor( $content, 'fw_email_content_gf_activated', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>
<div id="customer_emails" class="tabcontent" style="display:block;">
<div class="tipomail">
<h3 class="titulo"><?=__( 'Processing order', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after payment.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_processing_order" name="fw_email_subject_customer_processing_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_processing_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_processing_order');
wp_editor( $content, 'fw_email_content_customer_processing_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Completed order', 'woocommerce' )?></h3>
<small><?=__( 'Order complete emails are sent to customers when their orders are marked completed and usually indicate that their orders have been shipped.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_completed_order" name="fw_email_subject_customer_completed_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_completed_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_completed_order');
wp_editor( $content, 'fw_email_content_customer_completed_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Order on-hold', 'woocommerce' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing order details after an order is placed on_hold.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_on_hold_order" name="fw_email_subject_customer_on_hold_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_on_hold_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_on_hold_order');
wp_editor( $content, 'fw_email_content_customer_on_hold_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<?php

if(fw_theme_mod('fw_trans_comprobantes') && fw_theme_mod('fw_trans_comprobantes_id')){
?>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Verification pending', 'fastway' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing information about uploading the file.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_await_verif_order" name="fw_email_subject_customer_await_verif_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_await_verif_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_await_verif_order');
wp_editor( $content, 'fw_email_content_customer_await_verif_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Pedido en preparación', 'fastway' )?></h3>
<small><?=__( 'This is an order notification sent to customers containing information about uploading the file.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_preparacion_order" name="fw_email_subject_customer_preparacion_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_preparacion_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_preparacion_order');
wp_editor( $content, 'fw_email_content_customer_preparacion_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__( 'Order shipped', 'fastway' )?></h3>
<small><?=__( 'This is an order notification sent to customers after order is marked as shipped.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_customer_despachado_order" name="fw_email_subject_customer_despachado_order" value="<?php echo fw_theme_mod('fw_email_subject_customer_despachado_order'); ?>" /><br>

<?php
$content = fw_theme_mod('fw_email_content_customer_despachado_order');
wp_editor( $content, 'fw_email_content_customer_despachado_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<?php } ?>

</div>

<div id="wholesale" class="tabcontent">
<div class="tipomail">
<h3 class="titulo"><?=__('Form Confirmation Page','fastway')?></h3>
<small><?=__('The message that is presented after completing the form','fastway')?></small>
<?php
$content = fw_theme_mod('fw_email_content_confirmation_wholesale_form');
wp_editor( $content, 'fw_email_content_confirmation_wholesale_form', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__('User Pending','fastway')?></h3>
<small><?=__('Sent after the user completes the wholesale form','fastway')?></small>
<input type="text" class="w100" id="fw_email_subject_gf_pending" name="fw_email_subject_gf_pending" value="<?php echo fw_theme_mod('fw_email_subject_gf_pending'); ?>" /><br>
<?php
$content = fw_theme_mod('fw_email_content_gf_pending');
wp_editor( $content, 'fw_email_content_gf_pending', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>
<div id="other" class="tabcontent">
<!--NEW ORDER ADMIN -->
<div class="tipomail">
<h3 class="titulo"><?=__( 'New order', 'woocommerce' )?></h3>
<small><?=__( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'woocommerce' );?></small>
<input type="text" class="w100" id="fw_email_subject_admin_new_order" name="fw_email_subject_admin_new_order" value="<?php echo fw_theme_mod('fw_email_subject_admin_new_order'); ?>" /><br>
<?php
$content = fw_theme_mod('fw_email_content_admin_new_order');
wp_editor( $content, 'fw_email_content_admin_new_order', $settings = array('textarea_rows'=> '10') );
?>
</div>
<!--THANK YOU PAGE-->
<div class="tipomail">
<h3 class="titulo"><?=__('Thank you page','fastway')?></h3>
<small><?=__('Text that appears in the checkout page, after finishing','fastway')?></small>

<?php
$content = fw_theme_mod('fw_email_content_thankyou');
wp_editor( $content, 'fw_email_content_thankyou', $settings = array('textarea_rows'=> '10') );
?>
</div>
<div class="tipomail">
<h3 class="titulo"><?=__('Product Info','fastway')?></h3>
<small><?=__('Info shared by all products. Can appear in the product page as a shortcode.[fw_customer_product_summary]','fastway')?></small>
<small></small>
<?php
$content = fw_theme_mod('fw_email_content_product_summary');
wp_editor( $content, 'fw_email_content_product_summary', $settings = array('textarea_rows'=> '10') );
?>
</div>
</div>



<?php submit_button(); ?>
</form>
</div>
<style>
.tipomail{

margin-bottom:20px;
}
input.w100{
width:100%;
}
h3.titulo{
margin-top:20px;
margin-bottom:0px;
}
</style>
<?php
} 

?>
