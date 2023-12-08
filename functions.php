<?php



load_theme_textdomain( 'fastway', get_template_directory() . '/languages' );
require get_template_directory() . '/inc/builder.php';
if ( ! function_exists( 'fw_theme_mod' ) ) {
  function fw_theme_mod( $field_id, $default_value = '' ) {
    if ( $field_id ) {
      if ( !$default_value ) {
        if ( class_exists( 'Kirki' ) && isset( Kirki::$fields[ $field_id ] ) && isset( Kirki::$fields[ $field_id ]['default'] ) ) {
          $default_value = Kirki::$fields[ $field_id ]['default'];
        }
      }
      $value = get_theme_mod( $field_id, $default_value );
      return $value;
    }
    return false;
  }
  if(!fw_theme_mod('fw_forceupdate_1')){
    //Force update 
    update_option('woocommerce_allowed_countries','all');
    update_option('woocommerce_ship_to_countries','all');
    update_option('woocommerce_default_customer_address','geolocation');
    
    set_theme_mod('fw_forceupdate_1',true);
  }
}

require get_template_directory() . '/functions/emails/fw-emails.php';
require get_template_directory() . '/functions/emails/fw-email-settings-page.php';
require get_template_directory() . '/functions/fw-roles.php';

add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_empty_array',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_empty_array', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

function remove_extra_image_sizes() {
  foreach ( get_intermediate_image_sizes() as $size ) {
      if ( !in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
          remove_image_size( $size );
      }
  }
}

//add_action('init', 'remove_extra_image_sizes');

if( !function_exists('is_plugin_active') ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if(!is_plugin_active('kirki/kirki.php')){
  echo "KIRKI MISSING";
  return;
}

function fw_company_data($type, $link=false,$cant=1) {
  $type=trim($type);$link=trim($link);$pre="";

  if($type=="whatsapp" && $link)$pre="https://api.whatsapp.com/send?text=".fw_theme_mod('fw_share_message')."&phone=";
  else if($type=="phone" && $link)$pre="tel:";
  else if($type==="email" && $link)$pre="mailto:";
  $value=fw_theme_mod('short-fw_company'.$type);
  //fix whatsapp +
  if($type=="whatsapp" && empty($value))$value=fw_theme_mod('short-fw_company'.'phone');
  if($type=="whatsapp" && $link)$value=str_replace("+",'',$value);
      
  if(empty($value))return "";
  
  
  if($cant==0)$cant=1;
  $value=explode("|", $value)[$cant-1];
  if(empty($value))return false;
  preg_match('#\((.*?)\)#', $value, $match);
  $link_en_parentesis= $match[1];
  if($link_en_parentesis=='#'){//Si hay link en parentesis
      return "";
  }else if(!empty($link_en_parentesis)  && !$link){//Si hay link en parentesis
      $value=$pre.str_replace("(".$link_en_parentesis.")","",$value);
  }else if(!empty($link_en_parentesis) && $link){
      $value=$pre.$link_en_parentesis;
  }else if(empty($link_en_parentesis) && $link){
      $value=$pre.$value;
  }

  /*prevent dobles*/
  if( strpos( $value, 'tel:tel:' ) !== false) {
      $value=str_replace('tel:tel:','tel:',$value);
  }else if( strpos( $value, 'mailto:mailto:' ) !== false) {
      $value=str_replace('mailto:mailto:','mailto:',$value);
  }
  
  return $value;
}
function isAltoweb(){
  //Altoweb is my web design company. I develop fastway while building altoweb and testing it with all my clients.
  return fw_theme_mod('fw_fork_name')=='altoweb';}
if(is_plugin_active('kirki/kirki.php'))require get_template_directory() . '/functions/fw-theme-options.php';

function formatear($string){
  return strtolower(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
}






function fw_hide_selected_terms( $terms, $taxonomies, $args ) {
  $new_terms = array();
  $ocultar=explode(",",fw_theme_mod('fw_hide_cates'));

  if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && (is_shop() || is_tax() ) ) {
      foreach ( $terms as $key => $term ) {

            if (  ( ! in_array( $term->slug, $ocultar ) )) {
              $new_terms[] = $term;
            }
      }
      $terms = $new_terms;
  }
  return $terms;
}
add_filter( 'get_terms', 'fw_hide_selected_terms', 10, 3 );
add_filter( 'get_terms_args', 'checklist_args', 10, 2 );
function checklist_args( $args, $taxonomies ){
  $menu_taxonomies = array('product_cat', 'page', 'category','post');
  if(in_array($taxonomies[0], $menu_taxonomies)){
      $args['number'] = 1000;
  }
  return $args;
}


add_filter('wp_handle_upload_prefilter', 'whero_limit_image_size');
function whero_limit_image_size($file) {
    if(is_super_admin())return $file;
   //if(is_admin())return $file;
   // Calculate the image size in KB
   $image_size = $file['size']/1024;

   // File size limit in KB
   $limit = fw_theme_mod('fw_max_media_upload');

   // Check if it's an image
   $is_image = strpos($file['type'], 'image');

   if ( ( $image_size > $limit ) && ($is_image !== false) )
      $file['error'] = 'La imagen es muy pesada, supera los '. $limit .'KB. Subí una imagen mas liviana o de un tamaño entre 500x500 y 1000x1000. Esto es para asegurar que la web cargue rapido. te recomendamos usar un compresor de imagenes como <a href="https://tinypng.com/">tinypng</a>';

   return $file;

}



function fw_vc_get_posts($type) {
    $args = array(
    'taxonomy'   => $type,
    'orderby'    => 'name',
    'order'    => 'ASC',/*,
    'number'     => $number,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids*/
    );
    $product_categories = get_terms($args);
    
    $result = array();
    foreach ( $product_categories as $post ) {
      if($post && $post->slug){

        $cat=array($post->slug => $post->slug);
        $result=array_merge($result,$cat);
      }
        
    }
    return $result;
}
if(get_locale()=='es_ES'){
  update_option('timezone_string','America/Argentina/Buenos_Aires');
  update_option('date_format','d/m/Y');
  update_option('time_format','H:i');
}

function isLocalhost(){
  return false;
  return $_SERVER['HTTP_HOST']==='fastway';
}

function fw($string){
  fw_log($string);
}
function fwa($string){
  fw_log($string);
}

function esMultitienda(){
  //Devuelve true si es una multitienda y e rol es otro que minorista
  if(fw_theme_mod('fw_is_multitienda') && !(check_user_role('administrator') || check_user_role('customer') || check_user_role('shop_manager') || check_user_role('subscriber') || check_user_role('guest') )) return true;
  return false;
}

function fw_log($string){
    if(isLocalhost())error_log("fwlog_ : ".$string);
}

if(fw_theme_mod('fw_blog_per_page')!=get_option('posts_per_page'))update_option('posts_per_page',fw_theme_mod('fw_blog_per_page'));

function fw_loop_blog(){
  echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_blog_code'))));
}

function fastway_get_stblock( $cats = array('all') ){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->post_name;

        $res_args[$slug] = $slug;//get_the_title($block->ID);
    }
    return $res_args;
}




//remove_filter( 'the_content', 'wpautop' );
//remove_filter( 'the_excerpt', 'wpautop' );

add_filter( 'map_meta_cap', 'multisite_custom_css_map_meta_cap', 20, 2 );
function multisite_custom_css_map_meta_cap( $caps, $cap ) {
	if ( 'edit_css' === $cap && is_multisite() ) {
		$caps = array( 'edit_theme_options' );
	}
	return $caps;
}


/** add this to your function.php child theme to remove ugly short code on excerpt */
/** add by Paolo Rudelli aka Paul Corneille 09-06-2014 */
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
      $patterns = "/\[[\/]?vc_[^\]]*\]/";
      $replacements = "";
      return preg_replace($patterns, $replacements, $excerpt);
  }
}
/** * Original elision function mod by Paolo Rudelli */
if(!function_exists('qode_excerpt')) {
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined in qode_set_blog_word_count function */
function qode_excerpt() {
global $qode_options_elision, $word_count, $post;
$word_count = isset($word_count) && $word_count != "" ? $word_count : $qode_options_elision['number_of_chars'];
$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
$clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
/** add by PR */
$clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
/** end PR mod */
$excerpt_word_array = explode (' ',$clean_excerpt);
$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
$excerpt = implode (' ', $excerpt_word_array).'...'; echo ''.$excerpt.'';

}
}

if(!is_plugin_active( 'wordpress-seo/wp-seo.php' ) )add_filter ('get_the_excerpt','wpse240352_filter_excerpt');
function wpse240352_filter_excerpt ($post_excerpt) { 
  if(empty($post_excerpt))$post_excerpt=qode_excerpt();
  $post_excerpt = '<p class="desc">' . $post_excerpt . '</p>';
  return $post_excerpt;
}  

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

add_action('wp_enqueue_scripts', function() {
    if (function_exists('gravity_form_enqueue_scripts')) {
        // newsletter subscription form
        gravity_form_enqueue_scripts(5);
    }
});
/*
if ( !function_exists( 'fw_checkPlugin' ) ):
function fw_checkPlugin( $path = '' ){
        if( strlen( $path ) == 0 ) return false;
        $_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
        if ( in_array( trim( $path ), $_actived ) ) return true;
        else return false;
}
endif;
*/

$THEME_DIR= get_template_directory() . '/';
$CHILDTHEME_DIR= get_stylesheet_directory() . '/';
$THEME_URI = get_template_directory_uri() . '/';
$TEMPLATE_DIR=$THEME_DIR."templates/";
$CHILDTEMPLATE_DIR=$CHILDTHEME_DIR."templates/";
$TEMPLATE_URI=$THEME_URI."templates/";
$THEME_IMG_URI= $THEME_URI . 'assets/img/';
$THEME_CSS_URI= $THEME_URI . 'css/';
$THEME_JS_URI= $THEME_URI . 'js/';



require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/class-staticblocks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/functions/fw-extra-functions.php';
require get_template_directory() . '/functions/fw-shortcodes.php';
require get_template_directory() . '/functions/fw-icon-shortcodes.php';
require get_template_directory() . '/functions/fw-user-account.php';
require get_template_directory() . '/functions/fw-blog-options.php';
require get_template_directory() . '/functions/shortcodes/fw-class-woo-shortcodes.php' ;
require get_template_directory() . '/functions/shortcodes/fw-class-shortcodes.php' ;
require get_template_directory() . '/functions/fw-faq.php';

if(fw_theme_mod('fw_cpt_reviews'))require get_template_directory() . '/functions/custom-post-types/fw-review.php';
if(fw_theme_mod('fw_cpt_events'))require get_template_directory() . '/functions/custom-post-types/fw-events.php';
if(fw_theme_mod('fw_dev_phpfile'))require get_template_directory() . '/'.fw_theme_mod('fw_dev_phpfile');
if(is_plugin_active('js_composer/js_composer.php')){
    require get_template_directory() . '/functions/vc_customs/vc_blog.php';
    require get_template_directory() . '/functions/vc_customs/vc_fastway.php';
}

if(is_plugin_active('woocommerce/woocommerce.php')){
    require get_template_directory() . '/functions/fw-ajax-search.php';
    require get_template_directory() . '/functions/fw-mayoristas.php';
    require get_template_directory() . '/functions/fw-extra-woo-functions.php';
    require get_template_directory() . '/functions/woo-free-shipping-per-product/free-shippging-pre-product.php';
    if(isLocalhost())require get_template_directory() . '/functions/fw-extra-woo-clients.php';
    require get_template_directory() . '/functions/fw-woo-prices-functions.php';
    require get_template_directory() . '/functions/fw-change-requests.php';
    require get_template_directory() . '/functions/fw-woo-marketing.php';
    require get_template_directory() . '/functions/fw-ajax-woo-functions.php';
    require get_template_directory() . '/functions/shipping-calculator/shipping-calculator.php';
    if(is_plugin_active('js_composer/js_composer.php')){
        require get_template_directory() . '/functions/vc_customs/vc_woo_carousels.php';
    }
    require get_template_directory() . '/functions/fw-custom-related.php';
    if(fw_theme_mod('fw_ml_on') || isLocalhost()){
      require get_template_directory() . '/functions/meli/meli.php';
      require get_template_directory() . '/functions/meli/funciones.php';
      require get_template_directory() . '/functions/meli/fw-ml.php';
    }

}

init_hooks();
function init_hooks(){
    if( is_request( 'frontend' ) ) {
        $shortcode = new fw_Shortcodes();
        add_action( 'init', array( $shortcode, 'init' ) );
    }    
}

if(fw_theme_mod('fw_search_priced_only'))add_action( 'woocommerce_product_query', 'fw_hide_products_higher_than_zero' );
if(fw_theme_mod('fw_search_priced_only'))add_action( 'woocommerce_product_query', 'fw_hide_products_without_price' );
function fw_hide_products_higher_than_zero( $q ){

   $meta_query = $q->get( 'meta_query' );
   $meta_query[] = array(
      'key'       => '_price',
      'value'     => 0,
      'compare'   => '>'
   );
   $q->set( 'meta_query', $meta_query );
}
function fw_hide_products_without_price( $q ){
   $meta_query = $q->get( 'meta_query' );
   $meta_query[] = array(
      'key'       => '_price',
      'value'     => '',
      'compare'   => '!='
   );
   $q->set( 'meta_query', $meta_query );
}

function is_request( $type ) {
  switch ( $type ) {
      case 'admin' :
          return is_admin();
      case 'ajax' :
          return defined( 'DOING_AJAX' );
      case 'cron' :
          return defined( 'DOING_CRON' );
      case 'frontend' :
          return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
  }
}

register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'fastway' ),
    'vertical' => __( 'Vertical Menu', 'fastway' ),
    'mobile' => __( 'Mobile Menu', 'fastway' ),
    'mobile_bottom' => __( 'Bottom Mobile Menu', 'fastway' ),
) );


if(is_plugin_active('kirki/kirki.php')){
    require get_template_directory() . '/functions/client-area/fw-dashboard.php';
    require get_template_directory() . '/functions/client-area/client-area.php';  
}
add_action( 'init', 'fw_login_dev_logo', 999 );
function fw_login_dev_logo(){
    add_action( 'login_footer', 'fw_login_footer' );
}
function fw_login_footer() {
    ?>
    <script type="text/javascript">
        var backToBlog = document.getElementById( 'backtoblog' ).getElementsByTagName( 'a' )[0];
        backToBlog.innerHTML='<div width="100%" style="margin:0 auto;text-align:center;"><a href="<?=fw_theme_mod('fw_dev_url')?>"><img width="200" align="center" style="margin:0 auto;text-align:center;" src="<?php echo fw_theme_mod('fw_dev_logo');?>"></a></div>';
    </script>
    <?php
}


function template_sredirect() {
        $url=fw_theme_mod("mobile-redirect");
        if(empty($url))return;
        if(!wp_is_mobile())return;
        if(!is_front_page())return;
        wp_redirect( $url);

    }
add_action( 'template_redirect', 'template_sredirect' );



add_action( 'after_setup_theme', 'understrap_woocommerce_support' );
if ( ! function_exists( 'understrap_woocommerce_support' ) ) {

	function understrap_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
}



// Adds initial meta to each attachment
function add_initial_file_size_postmeta($column_name, $post_id) {
    static $query_ran;
    if($query_ran !== null) {
      $all_imgs = new WP_Query(array(
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => -1,
        'fields'         => 'ids'
      ));
      $all_imgs_array = $all_imgs->posts;
      foreach($all_imgs_array as $a) {
        if(!get_post_meta($a, 'filesize', true)) {
          $file = get_attached_file($a);
          update_post_meta($a, 'filesize', filesize($file));
        }
      }
      $query_ran = true;
    }
  }
  //add_action('manage_media_custom_column', __NAMESPACE__.'\\add_initial_file_size_postmeta');
 
// Ensure file size meta gets added to new uploads
function add_filesize_metadata_to_images($meta_id, $post_id, $meta_key, $meta_value) {
    if('_wp_attachment_metadata' == $meta_key) {
      $file = get_attached_file($post_id);
      update_post_meta($post_id, 'filesize', filesize($file));
    }
}
add_action('added_post_meta', 'add_filesize_metadata_to_images', 10, 4);
// Add the column
function add_column_file_size($posts_columns) {
  $posts_columns['filesize'] = __('File Size');
  return $posts_columns;
}
add_filter('manage_media_columns', 'add_column_file_size');
// Populate the column
function add_column_value_file_size($column_name, $post_id) {
  if('filesize' == $column_name) {
    if(!get_post_meta($post_id, 'filesize', true)) {
      $file      = get_attached_file($post_id);
      $file_size = filesize($file);
      update_post_meta($post_id, 'filesize', $file_size);
    } else {
      $file_size = get_post_meta($post_id, 'filesize', true);
    }
    echo size_format($file_size, 2);
  }
  return false;
}
add_action('manage_media_custom_column', 'add_column_value_file_size', 10, 2);
// Make column sortable
function add_column_sortable_file_size($columns) {
  $columns['filesize'] = 'filesize';
  return $columns;
}
add_filter('manage_upload_sortable_columns', 'add_column_sortable_file_size');
// Column sorting logic (query modification)
function sortable_file_size_sorting_logic($query) {
  global $pagenow;
  if(is_admin() && 'upload.php' == $pagenow && $query->is_main_query() && !empty($_REQUEST['orderby']) && 'filesize' == $_REQUEST['orderby']) {
    $query->set('order', 'ASC');
    $query->set('orderby', 'meta_value_num');
    $query->set('meta_key', 'filesize');
    if('desc' == $_REQUEST['order']) {
      $query->set('order', 'DSC');
    }
  }
}
add_action('pre_get_posts', 'sortable_file_size_sorting_logic');


/**
 *  Add a blank option to a Gravity Forms dropdown
 *
 *  @param   object  $form  The Gravity Form
 *  @return  object  $form  The modified Gravity Form
 */
function wp_gravity_forms_add_empty_dropdown_option( $form ) {
  // Loop through the form fields
  foreach( $form['fields'] as &$field ) {

      if( $field->type == 'select' ) {
          // Add blank first element
          $items = array(
              'text' => '',
              'value' => '',
              'isSelected' => true,
              'price' => ''
          );
          // Add to the top of the array
          array_unshift( $field->choices, $items );
      } else {
          continue;
      }
  }
  return $form;
}
add_filter( 'gform_pre_render', 'wp_gravity_forms_add_empty_dropdown_option' );
add_filter( 'gform_pre_submission_filter', 'wp_gravity_forms_add_empty_dropdown_option' );




function mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
  foreach( $caps as $key => $capability ){

      if( $capability != 'do_not_allow' )
          continue;

      switch( $cap ) {
          case 'edit_user':
          case 'edit_users':
              $caps[$key] = 'edit_users';
              break;
          case 'delete_user':
          case 'delete_users':
              $caps[$key] = 'delete_users';
              break;
          case 'create_users':
              $caps[$key] = $cap;
              break;
      }
  }

  return $caps;
}
add_filter( 'map_meta_cap', 'mc_admin_users_caps', 1, 4 );

remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');

/**
* Checks that both the editing user and the user being edited are
* members of the blog and prevents the super admin being edited.
*/
function mc_edit_permission_check() {
  global $current_user, $profileuser;

  $screen = get_current_screen();

  wp_get_current_user();

  if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
      if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
          wp_die( __( 'You do not have permission to edit this user.' ) );
      } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
          wp_die( __( 'You do not have permission to edit this user.' ) );
      }
  }

}
add_filter( 'admin_head', 'mc_edit_permission_check', 1, 4 );

function fw_precio_vacio($x) {
  if(empty($x))return 0;
  return $x;
}




if(is_plugin_active('woocommerce-mercadoenvios/woocommerce-mercadoenvios.php' )){
				
function get_metsadata( $order_id, $key ) {
  global $wpdb;
  $table_name = $wpdb->prefix . 'woo_mercadoenvios';
  $data = $wpdb->get_var($wpdb->prepare(
    "SELECT `data` FROM
    $table_name
  WHERE
      `order_id` = %d
    AND
      `key` = '%s'
  LIMIT 1",
    (int) $order_id,
    $key
  ));
  $data =str_replace('"','',$data);
  $data =str_replace(';','',$data);
  $data = end(explode(':',$data));
  return $data;
}


function get_mp_api_data( $response, $object, $request ) {
 
  if( empty( $response->data ) )
      return $response;
  $oid= $response->data['id'];
  $response->data['mercadopago']['mp_op_id']= get_metsadata($oid,'mp_op_id');
  $response->data['mercadopago']['last_mp_status']= get_metsadata($oid,'last_mp_status');
  $response->data['mercadopago']['mp_order_id']= get_metsadata($oid,'mp_order_id');

  return $response;
} 

add_filter( "woocommerce_rest_prepare_shop_order_object",  "get_mp_api_data", 10, 3 );

}



function fw_get_term_by_name( $product_id,$name ){
  $terms = wp_get_post_terms( $product_id, $name);
  if( $terms && ! is_wp_error( $terms ))foreach ($terms as $categoria)  return $categoria->name;
}
function fw_get_template( $template_name, $args = array(), $posts = null ){
  if ( $args && is_array( $args ) )extract( $args );
  $located = get_template_directory() . '/functions/shortcodes/'.$template_name;
  ob_start();
  if ( $posts->have_posts() )include( $located );
  wp_reset_postdata();
}


/**
* Sorting out of stock WooCommerce products - Order product collections by stock status, in-stock products first.
*/
class iWC_Orderby_Stock_Status
{
public function __construct()
{
// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
add_filter('posts_clauses', array($this, 'order_by_stock_status'), 2000);
}
}
public function order_by_stock_status($posts_clauses)
{
global $wpdb;
// only change query on WooCommerce loops
if (is_woocommerce() && (is_shop() || is_tax() || is_product_tag())) {
$posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
$posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
$posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
}
return $posts_clauses;
}
}
new iWC_Orderby_Stock_Status;

function get_options_by_wildcard($prefix = '') {
  if (empty($prefix)) return false;
  global $wpdb;
  $ret = array();
  $options = $wpdb->get_results(
    $wpdb->prepare("SELECT option_name,option_value FROM {$wpdb->options} WHERE option_name LIKE %s",$prefix.'%'),
    ARRAY_A
  );
  if (!empty($options)) {
    foreach ($options as $v) {
      $ret[$v['option_name']] = maybe_unserialize($v['option_value']);
    }
  }
  return (!empty($ret)) ? $ret : false;
}
/*saca acentos wpallimport*/
add_filter( 'is_xml_preprocess_enabled', 'wpai_is_xml_preprocess_enabled', 10, 1 );
function wpai_is_xml_preprocess_enabled( $is_enabled ) {
    return false;
}




## ---- 1. Backend ---- ##

add_action( 'add_meta_boxes', 'create_custom_meta_box' );
if ( ! function_exists( 'create_custom_meta_box' ) )
{
    function create_custom_meta_box()
    {
        add_meta_box(
            'custom_product_meta_box',
            __( 'Productos', 'fastway' ),
            'add_custom_content_meta_box',
            'product',
            'side',
            'high'
        );
    }
}
//  Custom metabox content in admin product pages
if ( ! function_exists( 'add_custom_content_meta_box' ) ){
    function add_custom_content_meta_box( $post ){
        $prefix = '_bhww_'; // global $prefix;
        $ingredients = get_post_meta($post->ID, $prefix.'ingredients_wysiwyg', true) ? get_post_meta($post->ID, $prefix.'ingredients_wysiwyg', true) : '';
        $args['textarea_rows'] = 6;
        echo '<p class="search-box" style="display:block;float:none">
        <input type="text" name="nama" id="nama" >
        <input type="button" onclick="buscador()" class="button" value="'.__('Buscar','fastway').'"></p>
        <script type="text/javascript">
        function buscador(){
          let value=jQuery("#nama").val()
          location.href="/wp-admin/edit.php?post_type=product&s="+value
        }
        jQuery("#nama").on("keypress", function (event) {
          var keyPressed = event.keyCode || event.which;
          if (keyPressed === 13) {
              buscador()
              event.preventDefault();
              return false;
          }
        });
        </script>
        <style>
        .search-box input#nama{
          width:65% !important;
          margin:0px !important;
          padding:0px !important;
          display:inline !important;
          }
          .search-box input.button{
          width:30% !important;
          margin:0px !important;
          padding:0px !important;
          display:inline !important;
          }
          </style>
        ';
    }
}
//Save the data of the Meta field

add_action( 'save_post', 'save_custom_content_meta_box', 10, 1 );
if ( ! function_exists( 'save_custom_content_meta_box' ) )
{
    function save_custom_content_meta_box( $post_id ) {
        $prefix = '_bhww_'; // global $prefix;
        // We need to verify this with the proper authorization (security stuff).
        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'custom_product_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'custom_product_field_nonce' ];
        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // Check the user's permissions.
        if ( 'product' == $_POST[ 'post_type' ] ){
            if ( ! current_user_can( 'edit_product', $post_id ) )
                return $post_id;
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) )
                return $post_id;
        }
        // Sanitize user input and update the meta field in the database.
        update_post_meta( $post_id, $prefix.'ingredients_wysiwyg', wp_kses_post($_POST[ 'ingredients_wysiwyg' ]) );
    }
}
## ---- 2. Front-end ---- ##
// Create custom tabs in product single pages
add_filter( 'woocommerce_product_tabs', 'custom_product_tabs' );
function custom_product_tabs( $tabs ) {
    global $post;
    $product_ingredients = get_post_meta( $post->ID, '_bhww_ingredients_wysiwyg', true );
    if ( ! empty( $product_ingredients ) )
        $tabs['ingredients_tab'] = array(
            'title'    => __( 'Ingredients', 'woocommerce' ),
            'priority' => 1,
            'callback' => 'ingredients_product_tab_content'
        );
    return $tabs;
}
// Add content to custom tab in product single pages (1)
function ingredients_product_tab_content() {
    global $post;
    $product_ingredients = get_post_meta( $post->ID, '_bhww_ingredients_wysiwyg', true );
    if ( ! empty( $product_ingredients ) ) {
        echo '<h2>' . __( 'Product Ingredients', 'woocommerce' ) . '</h2>';
        // Updated to apply the_content filter to WYSIWYG content
        echo apply_filters( 'the_content', $product_ingredients );
    }
}
 
add_filter( 'woocommerce_checkout_fields', 'bbloomer_checkout_phone_us_format' );
   
function bbloomer_checkout_phone_us_format( $fields ) {
    $fields['billing']['billing_phone']['placeholder'] = '(011) 1111111111';
    $fields['billing']['billing_phone']['maxlength'] = 19; // 123-456-7890 is 12 chars long
    return $fields;
}
 
?>