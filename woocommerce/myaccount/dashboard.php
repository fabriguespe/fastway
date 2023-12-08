<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<h1 style="text-transform:uppercase;"><?=fw_theme_mod('fw_label_bienvenido');?> <?php echo get_bloginfo('name');?></h1>
<h4><?php echo fw_theme_mod('fw_welcome_msg')?></h4>

<div class="botonesaccount d-flex align-items-center">
	<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?=fw_theme_mod('fw_label_ver_productos');?></a> 
	<!--<?php// if(is_user_logged_in()){?>
		<a href="/wp-login.php?action=logout">CERRAR SESIÓN</a> 
	<?php// } ?>
	<?php //if(fw_theme_mod('fw_activar_download_lista')){?>
		<a href="http://fastwp/wp-admin/admin.php?page=pmxe-admin-manage&id=1&action=get_file&_wpnonce=9383089113">Descargar lista de precios </a>
	<?php//  } ?>-->
</div>

<?php


do_action( 'woocommerce_account_dashboard' );

do_action( 'woocommerce_before_my_account' );

do_action( 'woocommerce_after_my_account' );
