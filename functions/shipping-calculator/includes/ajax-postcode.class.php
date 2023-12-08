<?php 

class Correios_Shipping_Ajax_Postcode {

	public function __construct() {

		add_action( 'wp_ajax_wscp_ajax_postcode', array($this,'wscp_ajax_postcode') );
		add_action( 'wp_ajax_nopriv_wscp_ajax_postcode', array($this,'wscp_ajax_postcode') );
	}

	public function wscp_ajax_postcode() {

		check_ajax_referer( 'wscp-nonce', 'nonce' );

		$data = $_POST;

		$shipping_response = $this->get_product_shipping_estimate( $data );



		if( !is_array($shipping_response) ){

			echo "<small>".( $shipping_response ? $shipping_response : 'No hay metodos de envio disponibles.' )."</small>";
			
		} else {
			$opts=get_option('woocommerce_mercadoenvios-shipping_settings');
			$product = wc_get_product( sanitize_text_field( $_POST['product'] ) );

			$freeship=10000000;
			if(!$opts['shipping_free_shipping'])$freeship=$opts['free_shipping_amount'];
			
			$cant=0;
			foreach ($shipping_response as $key => $shipping) {
				//Saca los que no son mercadoenvios
				if(is_plugin_active('woocommerce-mercadoenvios/woocommerce-mercadoenvios.php') && fw_theme_mod("fw_only_mercadoenvios") && $shipping->method_id!='mercadoenvios-shipping' )continue;
				
				$cant++;
				$precio=$shipping->cost;
				if($precio==0  && $shipping->method_id=='flat_rate')$precio=fw_theme_mod('fw_shipping_client_cost');
				else if($precio==0)$precio=fw_theme_mod('fw_shipping_no_cost');
				else $precio= wc_price( $shipping->cost );
				$impri='<p class="'.$shipping->method_id.'">'.$shipping->label.' <span class="precio_en_cart '.$shipping->method_id.'">('.$precio.')</span></p>';
				//if($shipping->method_id=='mercadoenvios-shipping' && $opts['free_shipping_amount'] && $product->get_price()>=$freeship )$impri='<p class="'.$shipping->method_id.' free">Envio Gratis Por Correo A Domicilio.</p>';

				echo $impri;
			}
			if( $cant==0 )echo "<small>No hay metodos de envio disponibles</small>";
				
			echo
				'</tbody>
			</table>';
		}

		wp_die();
	}

	public function get_product_shipping_estimate( array $request ) {

	    $product = wc_get_product( sanitize_text_field( $request['product'] ) );
	    
	    if (!$product->needs_shipping() || get_option('woocommerce_calc_shipping') === 'no' )
	        return 'No fue posible calcular el envio';
	    
	    if( !$product->is_in_stock() )
	    	return 'No fue posible calcular el envio, no tiene stock.';

	    if( !WC_Validation::is_postcode( $request['postcode'], WC()->customer->get_shipping_country() ) )
	    	return 'Por favor, ingresr un CP válido.';

	    $products = [$product];

	    if (WC()->customer->get_shipping_country()) {

	        $destination = [
	            'country' => WC()->customer->get_shipping_country(),
	            'state' => WC()->customer->get_shipping_state(),
	            'postcode' => sanitize_text_field( $request['postcode'] ),
	            'city' => WC()->customer->get_shipping_city(),
	            'address' => WC()->customer->get_shipping_address(),
	            'address_2' => WC()->customer->get_shipping_address_2(),
	        ];

	    } else {

	        $destination = wc_get_customer_default_location();
	    }

	    $package = [
	        'destination' => $destination,
	        'applied_coupons' => WC()->cart->applied_coupons,
	        'user' => ['ID' => get_current_user_id()],
	    ];

	    foreach ($products as $data) {

	        $cartId = WC()->cart->generate_cart_id($data->id, $product->is_type('variable') ? $data->variation_id : 0);

	        $price = $data->get_price_excluding_tax();

	        $tax = $data->get_price_including_tax() - $price;

	        $package['contents'] = [
	            $cartId => [
	                'product_id' => $data->id,
	                'data' => $data,
	                'quantity' => sanitize_text_field( $request['qty'] ),
	                'line_total' => $price,
	                'line_tax' => $tax,
	                'line_subtotal' => $price,
	                'line_subtotal_tax' => $tax,
	                'contents_cost' => $price,
	            ]
	        ];

	        if( class_exists('WC_Correios_Webservice') ):

				add_filter( 'woocommerce_correios_shipping_args', function( $array, $this_id, $this_instance_id, $this_package ) use( $price ){
					
					$option_id = 'woocommerce_'.$this_id.'_'.$this_instance_id.'_settings';

					$settings = get_option( $option_id );

					if( 'yes' == $settings['declare_value'] ) {

						$array['nVlValorDeclarado'] = $price;
					}

					return $array;
				
				},10,4 ); 

			endif;
		    
		$methods = WC_Shipping::instance()->load_shipping_methods($package);

	        foreach ($methods as $key => $method) {
	        	
	        	if( "free_shipping" == $method->id && 'yes' == $method->enabled ) {
	        			
	        		$GLOBALS['method'] = $method;

	        		$has_coupon = $has_met_min_amount = false;

	        		if ( in_array( $method->requires, array( 'coupon', 'either', 'both' ) ) ) {

			            if ( $coupons = WC()->cart->get_coupons() ) {
			                foreach ( $coupons as $code => $coupon ) {
			                    if ( $coupon->is_valid() && $coupon->get_free_shipping() ) {
			                        $has_coupon = true;
			                        break;
			                    }
			                }
			            }
			        }

			        if ( in_array( $method->requires, array( 'min_amount', 'either', 'both' ) ) ) {

			            $_total = $price * $request['qty'];

			            if ( $_total >= $method->min_amount ) {
			                $has_met_min_amount = true;
			            }
			        }

			        switch ( $method->requires ) {

			            case 'min_amount' :
			                $is_available = $has_met_min_amount;
			                break;
			            case 'coupon' :
			                $is_available = $has_coupon;
			                break;
			            case 'both' :
			                $is_available = $has_met_min_amount && $has_coupon;
			                break;
			            case 'either' :
			                $is_available = $has_met_min_amount || $has_coupon;
			                break;
			            default :
			                $is_available = false;
			                break;
			        }


	        		break;
	        	}
	        }


	        if( $is_available ) {

	        	$rates[] = (object) [
	        		'cost' => 0,
	        		'label' => $method->method_title
	        	];
	        }


	        $packageRates = WC_Shipping::instance()->calculate_shipping_for_package($package);

	        foreach ($packageRates['rates'] as $rate) {
			
		    $meta =  $rate->get_meta_data();

	            if( isset( $meta['_delivery_forecast'] ) )
	        	$rate->set_label( $rate->get_label() . " (Entrega em " . $meta['_delivery_forecast'] . " dias úteis)" );

	            $rates[] = $rate;
	        }

	        if( $rates ){
			WC()->customer->set_shipping_postcode( $request['postcode'] );
			WC()->customer->set_billing_postcode( $request['postcode'] );
		}
	    }
	    return $rates;
	}
}

new Correios_Shipping_Ajax_Postcode();
