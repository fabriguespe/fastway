<?php
// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = fw_theme_mod('layout-main');
$ratio=10;
$ratioboth=8;
if ( (is_home() && ! is_front_page() ) || is_single() || is_archive()){
	$sidebar_pos = fw_theme_mod('layout-blog');
	$ratio=12-fw_theme_mod('fw_blog_sidebar_ratio');
	$ratioboth=$ratio-fw_theme_mod("fw_blog_sidebar_ratio");
}

if(is_plugin_active("woocommerce/woocommerce.php")){
	if(is_shop() || is_tax())$sidebar_pos = fw_theme_mod('shop-layout');
	else if(is_product())$sidebar_pos = fw_theme_mod('product-page-layout');
	if(is_shop() || is_tax() || is_product()){
		$ratio=12-fw_theme_mod("sidebar-ratio");
		$ratioboth=$ratio-fw_theme_mod("sidebar-ratio");
	}
}


?>
<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
	<?php get_sidebar( 'left' ); ?>
<?php endif; ?>

<?php 
$html = '';
if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {?>
	<div class="col-md-<?php echo $ratio;?> content-area" id="primary">
<?php } elseif ( 'both' === $sidebar_pos ) {?>
	<div class="col-md-<?php echo $ratioboth;?> content-area" id="primary">
<?php } else {?>
    <div class="col-md-12 content-area" id="primary">
<?php }?>

