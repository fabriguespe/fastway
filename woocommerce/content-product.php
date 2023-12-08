<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$classname_desktop="fw_product_loop desktop ";
global $preset_class;
$classname_desktop.=$preset_class?$preset_class:fw_theme_mod('fw_builder_pl_class');
$classname_desktop.=get_attrClasses($product);
?>

<li <?php wc_product_class($classname_desktop, $product ); ?>>
<?php woo_loop_code(); ?>
</li>