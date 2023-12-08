<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

woocommerce_breadcrumb();
do_action( 'woocommerce_before_single_product' );

?>

<?php woo_single(); ?>

<script>
//Fix fancybox
jQuery( document ).ready(function( $ ) {
   $.fancybox.defaults.hash = false;
});
</script>

