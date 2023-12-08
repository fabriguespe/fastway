<?php 
// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = fw_theme_mod('layout-main');
if ( (is_home() && ! is_front_page() ) || is_single() || is_archive()){
  $sidebar_pos = fw_theme_mod('layout-blog');
}

if(is_plugin_active("woocommerce/woocommerce.php")){
  if(is_shop() || is_tax())$sidebar_pos = fw_theme_mod('shop-layout');
  else if(is_product())$sidebar_pos = fw_theme_mod('product-page-layout');
}

?>

<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

  <?php get_sidebar( 'right' ); ?>

<?php endif; ?>
