<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="fw-woocommerce-shipping-totals">
	<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
	<?php wc_cart_totals_shipping_html(); ?>
	<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
</div>