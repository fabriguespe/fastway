<?php

defined( 'ABSPATH' ) || exit;

$items=[];
if(is_object($order) && $order->get_items()){

	foreach ( $order->get_items() as $item_id => $item ) {
		$product=wc_get_product($item['product_id']);
		if($item->variation_id)$product=wc_get_product($item['variation_id']);
		$producto['price']=$product->price;
		$producto['quantity']=$item['quantity'];
		$producto['sku']=$product->sku;
		$producto['name']=$product->name;
	  
		$cant=0;
		foreach( $product->category_ids as $cat_id ) {
		  $term = get_term_by( 'id', $cat_id, 'product_cat' );
		  $producto['category'].= $term->name;
		  if($cant<(count($product->category_ids)-1))$producto['category'].= ' > ';
		  $cant++;
		}
		array_push($items,$producto);
	}
}

$items=json_encode($items);
$laorder['id']=$order->id;
$laorder['revenue']=$order->total;
$laorder['shipping']=$order->shipping_total;
$laorder=json_encode($laorder);

?>

<script>
let order=JSON.parse('<?=$laorder?>');
let items=JSON.parse('<?=$items?>');
let isFbqActive='<?=is_plugin_active('facebook-for-woocommerce/facebook-for-woocommerce.php')?>';
let isPixelLoaded='<?=fw_theme_mod('fbpixel_id')?>';
console.log('eventAction:purchase, isPluginActive:',isFbqActive );
if(!isFbqActive && isPixelLoaded && window.fbq){
	console.log('fbq emitido')
	fbq('track', 'Purchase', {value: 0.00, currency: 'USD'});
}
if(window.gtag)gtag('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'purchase', eventLabel: 'Compra'});
if(window.ga)ga('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'purchase', eventLabel: 'Compra'});
if(window.dataLayer){
	let datala={
		'event': 'Purchase',
		'ecommerce': {
			'purchase': {
				'actionField': {
					'id': ''+order.id+'',               
					'revenue': order.revenue,  
					'tax':'',
					'shipping': order.shipping,
					'coupon': ''
				},                      
				'products': items
			}
		}
	}
	console.log(datala)
	dataLayer.push(datala);
}

</script>


<div class="woocommerce-order">

	<?php if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<section class="container pagoexitoso" style="width:100%;">
				<i class="fad fa-check-circle"></i>
				<?php echo fw_parse_mail('thankyou',$order);?>
				
				<?php 
				do_action( 'woocommerce_thankyou',$order->get_id());
				do_action( 'woocommerce_admin_order_data_after_shipping_address',$order);
				do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
				 ?><!--por si hay algo intersante para haer en el futuro....-->

				<a class="seguir" href="<?=fw_theme_mod('fw_seguircomprando_url')?>"><?=fw_theme_mod('fw_label_checkout_thank_4')?></a>
			</section>
			
		<?php endif; ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null );?></p>

	<?php endif; ?>

</div>
