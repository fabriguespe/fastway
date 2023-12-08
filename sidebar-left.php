<?php

$sidebarname='left-sidebar';
$ratio=2;

if ( (is_home() && ! is_front_page() ) || is_single() || (is_archive() && !is_tax())){
	$ratio=3;
}

if(is_plugin_active("woocommerce/woocommerce.php")){
	if(is_shop() || is_tax()){
		$sidebarname='s-'.$sidebarname;
		$ratio=fw_theme_mod("sidebar-ratio");
	}else if(is_product()){
		$sidebarname='sp-'.$sidebarname;
		$ratio=fw_theme_mod("sidebar-ratio");
	}
}

?>
<div class="col-md-<?php echo $ratio;?> widget-area d-none d-md-block" id="left-sidebar" role="complementary">
	<?php do_action('fw_before_shop_sidebar');?>
	<?php dynamic_sidebar( $sidebarname ); ?>
</div>
<button class="navbar-toggler fw-header-icon toggler btn-bars-mobile-cats d-md-none" type="button" style="float:right;"><i class="fa fa-filter"></i> Filtrar</button>
<div class="sidebar-mobile-cats d-md-none">
   <div class=" sub-menu-mobile cats"> 
	   <div class="container">
	   <?php do_action('fw_before_shop_sidebar');?>
		   <?php dynamic_sidebar( $sidebarname ); ?>
		   </div>   
	</div>      
</div>