<?php
if(!is_plugin_active('kirki/kirki.php')){
  echo "KIRKI Missing ";
  return;
}
?>
<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php if(fw_theme_mod('fw_seo') && !is_plugin_active('wordpress-seo/wp-seo.php') && !is_plugin_active('seo-by-rank-math/rank-math.php')){ ?>
    <!-- FW SEO -->
    <meta name="description" content="<?=fw_theme_mod('seo-desc');?>">
    <meta name="keywords" content="<?=fw_theme_mod('seo-keywords');?>">
    <meta property="og:title" conten="<?=bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?=fw_theme_mod('seo-desc');?>">
    <meta property="og:image" content="<?=get_the_post_thumbnail_url()?get_the_post_thumbnail_url():fw_theme_mod('social_media_image');?>">
    <meta property="og:url" content="<?='https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    <?php } ?>
    <meta name="google-site-verification" content="<?=fw_theme_mod('fw_site_verification');?>">
    <meta name="facebook-domain-verification" content="<?=fw_theme_mod('fw_fb_verification');?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- APPLE -->
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" type="image/png" href="<?php echo fw_theme_mod('fw_favicon').'?v2'?>">
    <link rel="apple-touch-icon" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--loading -->
    <link rel="apple-touch-startup-image" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--barra -->
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <?php wp_head(); ?>
    <style type="text/css" id="css_editor-header"><?php echo fw_theme_mod('css_editor-header')?></style>
    <style type="text/css" id="css_editor_shop"><?php echo fw_theme_mod('css_editor_shop')?></style>
    <style type="text/css" id="css_editor_blog"><?php echo fw_theme_mod('css_editor_blog')?></style>
    <style type="text/css" id="css_editor_blog_page"><?php echo fw_theme_mod('css_editor_blog_page')?></style>
    <style type="text/css" id="css_editor-loop"><?php echo fw_theme_mod('css_editor-loop')?></style>
    <style type="text/css" id="css_loop_cat"><?php echo fw_theme_mod('css_loop_cat')?></style>
    <style type="text/css" id="css_editor-single"><?php echo fw_theme_mod('css_editor-single')?></style>
    <style type="text/css" id="css_editor-forms"><?php echo fw_theme_mod('css_editor-forms')?></style>
    <style type="text/css" id="css_editor-mobile"><?php echo fw_theme_mod('css_editor-mobile')?></style>
    <style type="text/css" id="css_editor-roles"><?php echo fw_theme_mod('css_editor-roles')?></style>
    <style type="text/css" id="css_loop_brand"><?php echo fw_theme_mod('css_loop_brand')?></style>
    <style type="text/css" id="css_editor-footer"><?php echo fw_theme_mod('css_editor-footer')?></style>
    <style type="text/css" id="css_loop_review"><?php echo fw_theme_mod('css_loop_review')?></style>
    <style type="text/css" id="css_event_review"><?php echo fw_theme_mod('css_event_review')?></style>
    <style type="text/css" id="css_loop_blog"><?php echo fw_theme_mod('css_loop_blog')?></style>
    <style ><?php echo fw_custom_css(); ?></style>
    <style type="text/css" id="css_editor-logged_in"><?php if(is_user_logged_in())echo fw_theme_mod('css_editor-logged_in')?></style>
    <style type="text/css" id="css_editor-admin"><?php if(current_user_can("administrator"))echo fw_theme_mod('css_editor-admin')?></style>
    <style>
        /*FIXf SHIPPING*/
.cart_totals .shipping,
.cart_totals .shipping p,
.cart_totals .shipping a,
.cart_totals .shipping span,
.cart_totals .shipping input,
.cart_totals .shipping label {
  font-size: 12px !important;
}

.cart_totals .shipping-calculator-form .button {
  background: var(--main) !important;
  color: white !important;
  border: 0px;
  padding: 3px 10px 3px 10px !important;
}


.woocommerce-shipping-totals,
.woocommerce-shipping-totals  p,
.woocommerce-shipping-totals  a,
.woocommerce-shipping-totals span,
.woocommerce-shipping-totals input,
.woocommerce-shipping-totals label {
  text-align:left !important;
  font-size: 11px !important;
}
.woocommerce-shipping-totals .button {
  text-align:left !important;
  background: var(--main) !important;
  color: white !important;
  border: 0px;
  padding: 3px 10px 3px 10px !important;
}
</style>
    <?php echo fw_theme_mod('fw_header_scripts');?>
</head>
<?php
$clasesbody='';
if(fw_theme_mod('fw_body_dark_mode'))$clasesbody.=' fw_body_dark_mode ';
if(fw_theme_mod("fw_general_message"))$clasesbody.=' fw_general_message ';
$nombreurl=is_front_page()?'home':basename(get_permalink());?>
<body <?php body_class("page-".$nombreurl.' '.$clasesbody.' '); ?>>
<?php  if(fw_theme_mod("gtagmanager_id")){ ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=fw_theme_mod("gtagmanager_id")?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php }  ?>
<header id="header" class="<?=fw_theme_mod('fw_floating_trans_header')?'fw_floating':''?> <?=fw_theme_mod('fw_builder_header_class')?>">
<?php 
if(fw_theme_mod("maintainance-mode")){
    if(!current_user_can('administrator'))wp_die(do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('maintainance_code')))));
    else echo '<div class="maintainance-notice" style="background:red;color:white;text-align:center;"> TU WEB ESTA EN MANTENIMIENTO, LOS USUARIOS NO PODRAN VERLA </div>';
}

echo fw_mensaje_barra();

echo fw_header_html();
echo fw_header_html_mobile();
$clasesmenu=fw_theme_mod('fw_mobile_dark_mode')?'sub-menu-mobile darkmode':'sub-menu-mobile';


?>
<div class="mobile-menu-overlay d-md-none">&nbsp;</div>
<div class="fw_menu_mobile ">
        <div class="<?=$clasesmenu?>"> 
        <div class="telefono-header t1 txt-16 text-left">      
          <?php if(fw_theme_mod('fw-ctas-switch')){
            ctas();?>
            <div class="separa-menu-mobile">&nbsp;</div>

        </div>
        <?php 
        }
        echo fw_menu_mobilenew(array('id' => 'mobile' )); 
        $bottommneu=fw_menu_vertical(array('id' => 'mobile_bottom' )); 
        if(!empty($bottommneu)){
            echo '<div class="separa-menu-mobile">&nbsp;</div>';
            echo '<div class="mobile_bottom">'.$bottommneu.'</div>';
        }
        if(fw_theme_mod('fw-quicklinks'))quicklinks();?>
      </div>
    </div>
    <div class="collapse" id="navbarsExample02">
      <?php echo fw_search_form(3);?>
    </div>
</div>
</header>
<style>
.telefono-header .btn{
  color:white !important;
  background:var(--main);
  font-size:20px !important;
}
.telefono-header .btn.wp{
background:#25d366;
}
.telefono-header .btn.wp i{
color:white !important;
}

.telefono-header .btn.fb{
background:#307BFF;
}

a.bluelink,
a.link,
a.linkazul{    
		color: #007bff;
	  text-decoration:underline;
    background-color: transparent;
}
</style>

<script >
function mostrar_submenu (id) {
  jQuery('#submenu_'+id).addClass('opened');
}
jQuery('.submenu-layer-1 .menu-mobile-back').click(function(){
  jQuery('.submenu-layer-1').removeClass('opened');
});
jQuery('.submenu-layer-2 .menu-mobile-back').click(function(){
  jQuery('.submenu-layer-2').removeClass('opened');
});
jQuery(window).on('load', function() {
    if(jQuery(document).height()>1400){
        jQuery(window).scroll(function() {
            var sticky = jQuery('header')
            var sticky_addto = jQuery('.fw_single_product .fw_add_to_cart_button')
            scroll = jQuery(window).scrollTop();
            if (scroll >= 171) { 
                sticky.addClass('fw_sticky_header'); 
                //sticky_addto.addClass('sticky'); 
                jQuery('.fw_single_product .summary').addClass('fixed');
                if(<?=fw_theme_mod('darklogo_sticky')?'true':'false'?>  && <?=!empty(fw_theme_mod('dark-logo'))?'true':'false'?>){
                    jQuery('.logo .fastway-image').attr('src','<?=fw_theme_mod('dark-logo')?>');
                }
            }else{ 
                //sticky_addto.removeClass('sticky'); 
                sticky.removeClass('fw_sticky_header');
                jQuery('.fw_single_product .summary').removeClass('fixed');
                if(<?=fw_theme_mod('darklogo_sticky')?'true':'false'?>){
                    jQuery('.logo .fastway-image').attr('src','<?=fw_theme_mod('general-logo')?>');
                }
            }
        });
    }
});

jQuery('form').submit(function(e){
    jQuery('#form_3_mobile').submit();
    if(jQuery('.search-field').val().length < 1) e.preventDefault()
});

</script>