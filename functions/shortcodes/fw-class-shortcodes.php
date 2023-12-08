<?php 
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'fw_Shortcodes' ) ) :

class fw_Shortcodes extends fw_Woo_Shortcodes {

	public function init() {

		$shortcodes = array();
			
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$woo_args = parent::shortcodeArgs();
			$shortcodes = array_merge( $shortcodes, $woo_args );
		}
		
		foreach ( $shortcodes as $shortcode => $function ) {
			
			add_shortcode( $shortcode, $function );
		}
		
	}
	
}

endif;