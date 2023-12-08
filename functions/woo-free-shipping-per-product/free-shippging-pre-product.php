<?php
/* @wordpress-plugin
 * Plugin Name:       WooCommerce Free Shipping Per Product
 * Plugin URI:        https://wpruby.com/
 * Description:       Free Shipping for certain product
 * Version:           1.1.0
 * WC requires at least: 2.6
 * WC tested up to: 3.8
 * Author:            WPRuby
 * Author URI:        https://wpruby.com
 * Text Domain:       free-shipping-per-product-for-woocommerce
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/WPRuby/free-shipping-per-product-for-woocommerce
 */


/**
 *
 * @since 1.0.0
 *
 */
class WPRuby_Free_Shipping_Product
{
    public function __construct()
    {
        //info: Only add the shipping method actions only if WooCommerce is activated.
        if ($this->is_plugin_active('woocommerce/woocommerce.php')) {
            add_filter('woocommerce_shipping_methods', array($this, 'add_method'));
            add_action('woocommerce_shipping_init', array($this, 'init_method'));
	        add_filter('woocommerce_cart_shipping_packages', array($this, 'filter_woocommerce_cart_shipping_packages'));

        }
    }

	/**
	 * @param $packages
	 *
	 * @return mixed
	 */
	public function filter_woocommerce_cart_shipping_packages($packages){
	    foreach ($packages as $package_key => $package){
		    if (isset($package['contents']) && $this->zone_has_free_shipping_method($package)) {
		    	/** @var WC_Shipping_Zone $shipping_zone */
			    foreach ($package['contents'] as $item_key => $item) {
				    /** @var WC_Product_Simple $product */
				    $product = $item['data'];
				    if (in_array($product->get_shipping_class(), ['free-shipping'])) {
					    // this item doesn't have the right class. return default availability
					    unset($packages[$package_key]['contents'][$item_key]);
				    }
			    }
		    }
	    }

	    return $packages;

    }

	/**
	 * @param $package
	 *
	 * @return bool
	 */
	private function zone_has_free_shipping_method( $package ){
	    $shipping_zone =  wc_get_shipping_zone( $package );
	    $shipping_methods = $shipping_zone->get_shipping_methods(true);
	    foreach ($shipping_methods as $shipping_method){
	    	if($shipping_method instanceof WC_Free_Shipping_Per_Product_Method){
	    		return true;
		    }
	    }
	    return false;
    }

    /**
     * @param $methods
     *
     * @return mixed
     */
    public function add_method($methods)
    {
        $methods['free_shipping_per_product'] = 'WC_Free_Shipping_Per_Product_Method';
        return $methods;
    }

    /**
     *
     */
    public function init_method()
    {
        require dirname(__FILE__). '/class-free-shipping-per-product.php';
    }

    /**
     * @param $slug
     *
     * @return bool
     */
    private function is_plugin_active($slug)
    {
        $active_plugins = (array) get_option('active_plugins', array());
        if (is_multisite()) {
            $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
        }
        return in_array($slug, $active_plugins) || array_key_exists($slug, $active_plugins);
    }
}


new WPRuby_Free_Shipping_Product();
?>