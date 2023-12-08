<?php

if ( ! function_exists( 'get_editable_roles' ) ) {
  require_once ABSPATH . 'wp-admin/includes/user.php';
}

function is_devadmin(){
  if(!fw_theme_mod('fw_dev_adminuser'))return true;
  if(wp_get_current_user()->user_login==fw_theme_mod('fw_dev_adminuser') && is_super_admin())return true;
  return false;
}
add_action( 'plugins_loaded', 'fw_get_current_user_role' );
function fw_get_current_user_role() {
  if( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    return $roles[0];
  } else {
    return false;
  }
}

function fw_get_price($id,$priceor){
  
  if(is_plugin_active('woocommerce-prices-by-user-role/plugin.php') || is_plugin_active('woocommerce-prices-by-user-role-new/plugin.php')){
    $role=fw_get_current_user_role();
    if(empty(fw_get_current_user_role()) || fw_get_current_user_role()=='subscriber' || $role=='administrator' || $role=='shop_manager')$role='customer';
    $priceor= floatval(parser_mayorista(get_post_meta( $id, 'festiUserRolePrices', true ),$role));
    if(!$price && $role=='customer')$priceor = get_post_meta( $id, '_regular_price', true);
  }
  return $priceor;
}
function fw_filter_listas_precios_by_role($title,$id) {
    $log=5;
    $role=fw_get_current_user_role();
    if(fw_theme_mod('fw_search_priced_only') && (is_plugin_active('woocommerce-prices-by-user-role/plugin.php') || is_plugin_active('woocommerce-prices-by-user-role-new/plugin.php'))){
      if(empty(fw_get_current_user_role()) || fw_get_current_user_role()=='subscriber' || $role=='administrator' || $role=='shop_manager')$role='customer';
      $product=json_decode(get_post_meta($id,'festiUserRolePrices',true)[0],true);
      $price=$product[$role];
      /*if($title=='Body splash 30' || $title=='Guest 2'){
        echo $log.$title.' '.$price;
      }*/
      if(!$price && $role=='customer')$price = get_post_meta( $id, '_regular_price', true);
      if(!$price)return true;	

    }
    return false;
}
function get_is_role_or_name_before(){
  $users=explode(",", fw_theme_mod('ca_users'));
  if(in_array(wp_get_current_user()->user_login,$users))return wp_get_current_user()->user_login;
  return fw_get_current_user_role();
}
function get_role_body_classes(){
  $roles=array();
  foreach ( get_editable_roles() as $role => $value ) {
    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' || $role == '' )$role='minorista';
    if(!in_array($role,$roles))array_push($roles,$role);
  }
  return implode(",",$roles);

}
function fw_getmeroles_and_names(){
      $usuarios=explode(",", fw_theme_mod('ca_users'));
      $devolver=fw_getme_roles();
      foreach ($usuarios as $key) {
          $devolver=array_merge($devolver,array($key=>$key));
      }
      return $devolver;
}


add_filter( 'body_class','fw_role_body_classes' );
function fw_role_body_classes( $classes ) {
    
    $the_user = wp_get_current_user(); // 54 is a user ID
    $roles = ( array ) $the_user->roles;
    $role=$roles[0];
    $classes[]=$role;
    if($role == 'administrator' || $role == 'customer' || $role == 'shop_manager' || $role == 'subscriber' || $role == 'guest' || $role == ''){
      $role='minorista';
      $classes[]=$role;
    }

    /*
    $roles=fw_get_all_roles();
    if(is_string($roles))$roles=explode(",",$roles);
    
    foreach ($roles as $key=>$nombre) {
      if ( check_user_role( strtolower($key) )) {
        $classes[]= strtolower($key); //or your name
      }
    }*/
    return $classes;
}



add_filter( 'body_class','fw_filter_body_class' );
function fw_filter_body_class( $classes ) {
    if($_GET['filter_marca'])$classes[]='filter_marca';
    if($_GET['filter_categoria'])$classes[]='filter_categoria';
    if($_GET['filter_ocasion'])$classes[]='filter_ocasion';
    if($_GET['filter_bodega'])$classes[]='filter_bodega';
    if($_GET['filter_tipo'])$classes[]='filter_tipo';
    if($_GET['filter_nombre'])$classes[]='filter_nombre';
    if($_GET['filter_ocultar'])$classes[]='filter_ocultar';
    if($_GET['filter_tipo-de-uva'])$classes[]='filter_tipo-de-uva';
    $sclas=implode(" ",$classes);
    if(strpos($sclas, 'filter_') !== false )$classes[]='filter';
    return $classes;
}



function check_user_role($role){
    $user = wp_get_current_user();
    if($role=='administrator' && is_super_admin())return true;
    if($role=='guest' && empty((array) $user->roles ))return true;
    if ( in_array( $role, (array) $user->roles ) ) {
      return true;
    }
	return false;
}

function fw_get_all_roles() {

    global $wp_roles;
    
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
    
    return $wp_roles->get_names();
  }
  function fw_get_all_roles_string(){
    $roles=fw_get_all_roles();
    return strtolower(implode(", ",fw_get_all_roles()));
  }
  function fw_getme_roles(){
      $editable_roles = get_editable_roles();
      $roles=array();
      foreach ($editable_roles as $role => $details) {
          $rol = esc_attr($role);
          if($rol=='administrator')continue;
          $name = translate_user_role($details['name']);
          $roles=array_merge($roles,array($rol => $name));
         
      }
      return $roles;
  }
  


function fw_editable_roles( $roles ) {
  $arr=fw_get_all_roles();
  if(is_string($arr))$arr=explode(",",$arr);
  foreach ($arr as $key => $nombre) {
    if($key=='administrator' || empty($key)  || empty($nombre))continue;
    $roles[] = $key;
  }
  return $roles;
}

add_filter( 'woocommerce_shop_manager_editable_roles', 'fw_editable_roles' ); 
 
add_action( 'admin_init', 'fw_allow_users_to_shopmanager');
function fw_allow_users_to_shopmanager() {
    /*supuestamente funciona*/
    $role = get_role( 'shop_manager' );
    if($role){
      $role->add_cap( 'edit_theme_options' ); 
      $role->add_cap( 'manage_options' ); 
      $role->add_cap( 'manage_email_logs' ); 
      $role->add_cap( 'add_users' ); 
      $role->add_cap( 'edit_dashboard' ); 
      $role->add_cap( 'create_users' ); 
      $role->add_cap( 'edit_users' ); 
      $role->add_cap( 'gravityforms_create_form' ); 
      $role->add_cap( 'gravityforms_edit_forms' ); 
      $role->add_cap( 'gravityforms_view_entries' ); 
      $role->add_cap( 'gravityforms_user_registration');

    }/*
    $role = get_role( 'subscriber' );
    if($role){
      $role->add_cap( 'edit_posts' ); 
    }

    $role = get_role( 'customer' );
    if($role){
      $role->add_cap( 'edit_posts' ); 
    }
    $role = get_role( 'mayorista' );
    if($role){
      $role->add_cap( 'edit_posts' ); 
    }*/
}

// Remove Administrator role from roles list
add_action( 'editable_roles' , 'hide_adminstrator_editable_roles' );
function hide_adminstrator_editable_roles( $roles ){
  $role=fw_get_current_user_role();
  $username=wp_get_current_user()->user_login;
  if(is_super_admin() || is_devadmin())return $roles;

  if(!is_plugin_active('woocommerce/woocommerce.php'))unset($roles['shop_manager'] );
  unset( $roles['author'] );
  unset( $roles['subscriber'] );
  unset( $roles['contributor'] );

  if($role=='administrator' ||  is_super_admin() || is_devadmin())return $roles;

  unset( $roles['editor'] );
  unset( $roles['administrator'] );
  return $roles;
}
if(!empty(fw_theme_mod('ca_extra_roles'))) {
    
    function fw_create_roles() {  
        $roles=fw_theme_mod('ca_extra_roles');
        $roles=explode(",",$roles);
        foreach ($roles as $nombre) {
            //add the new user role
            $field= str_replace(" ","_",strtolower($nombre));
            add_role(
                $field,
                $nombre,
                array(
                    'read'         => true,
                    'delete_posts' => false
                )
            );
        }

    }
    add_action('admin_init', 'fw_create_roles');
  
}