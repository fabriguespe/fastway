<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

//REset shipping
//REset shipping NO TOCAR!
/*
$method='local_pickup_plus';//EE
foreach ( WC()->shipping->get_packages() as $key => $package ) {
  foreach($package['rates'] as $rate_id => $rate ){
      if($rate->cost==0)$method=$rate->id;
  }
}
WC()->session->set('chosen_shipping_methods',[$method]);*/


$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>
<tr class="woocommerce-shipping-totals shipping">
	<a class="shipping_volver" onclick="jQuery('.paso-shipping').removeClass('inside')" style="display:none;" ><i class="fad fa-chevron-left"></i> Volver </a>
	<td data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( $available_methods ) : ?>
			<div id="shipping_method" class="woocommerce-shipping-methods">
			<?php foreach ( $available_methods as $method ) : 
				$titulo=$method->label;
				$id=$method->method_id;
				$value=$method->id;
				$value=str_replace(",","",$value);
				$instance=$method->instance_id;
				
				$desc=get_option('woocommerce_flat_rate_'.$instance.'_settings')['fw_shipping_desc'];
				$costo=$method->cost;
				if($costo==0  && $id=='flat_rate')$costo='A cargo del cliente';
				else if($costo==0 || $costo=='0'  /*&& $id=='local_pickup'*/)$costo=fw_theme_mod('fw_shipping_free_label');
				//else if($costo==0  && $id=='free_shipping')$costo=fw_theme_mod('fw_shipping_free_label');
				else $costo="$".$costo;
				$active=checked( $method->id, $chosen_method, false )?"active":""
				?>	
					<li class="capsula shipping <?=$active?> <?=$id?>" for="shipping_method_0_<?=$id?><?=$instance?>"  data-radio="shipping_method_0_<?=$value?>" data-costo="<?=$method->cost?>" data-label="<?=$titulo?>" data-value="<?=$value?>" >
						<?php printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) );?>
						<span class="checkmark"></span>
						<label class="title"><?=$titulo?></span> <?=$desc?'<small class="desc">'.$desc.'</small>':'';?> </label>
						<small  class="costo"><?=fw_theme_mod('fw_label_costos_envio')?>: <?=$costo?></small> 
						<?php /*if($id!=='mercadoenvios-shipping'){  }*/ ?>
						<div class="extras extras_shipping" ><?php do_action( 'woocommerce_after_shipping_rate', $method, $index );?></div>
					</li>
				<?php endforeach; ?>
			</div>
			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'woocommerce' ) ) );
					}
					?>
				</p>
			<?php endif; ?>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
			}
		elseif ( ! is_cart() ) :
			?>
			<li class="capsula  " style="padding-left:5px;cursor:not-allowed !important;"  >
				<label class="title"><?=__('No shipping options available','fastway');?></label>
				<small  class="costo"><?=wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) )?></small> 
			</li>
			<?php
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( $show_shipping_calculator ) : ?>
			<?php woocommerce_shipping_calculator( $calculator_text ); ?>
		<?php endif; ?>
	</td>
</tr>
<script>

</script>