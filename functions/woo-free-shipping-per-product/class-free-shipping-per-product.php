<?php

if (! defined('ABSPATH')) {
    exit;
}


if (! class_exists('WC_Free_Shipping_Per_Product_Method')) :

    class WC_Free_Shipping_Per_Product_Method extends WC_Shipping_Method
    {
        private $shipping_class = 'free-shipping';
        /**
         * WC_Free_Shipping_Per_Product_Method constructor.
         *
         * @param int $instance_id
         */
        public function __construct($instance_id = 0)
        {
            $this->id = 'free_shipping_per_product';
            $this->instance_id = absint($instance_id);
            $this->method_title = __('Free Shipping Per Product', 'fastway');
            $this->title = __('Free Shipping', 'fastway');

            $this->supports  = array(
                'shipping-zones',
                'shipping-zones',
                'instance-settings',
            );
            $this->init_form_fields();
            $this->init_settings();


            $this->enabled = $this->get_option('enabled');
            $this->title = $this->get_option('title');
            $this->hide_other_methods = $this->get_option('hide_other_methods');

            add_action('woocommerce_update_options_shipping_'.$this->id, array($this, 'process_admin_options'));
            add_filter('woocommerce_package_rates', array($this, 'hide_shipping_when_free_is_available'), 10, 2);
        }


        public function init_form_fields()
        {
            $this->instance_form_fields = array(
                'title' => array(
                    'title' 		=> __('Method Title', 'free-shipping-per-product-for-woocommerce'),
                    'type' 			=> 'text',
                    'description' 	=> __('The method name at Checkout.', 'free-shipping-per-product-for-woocommerce'),
                    'default'		=> __('Free Shipping', 'fastway'),
                    'desc_tip'		=> false,
                ),
                'hide_other_methods' => array(
                    'title' 		=> __('Hide other methods', 'free-shipping-per-product-for-woocommerce'),
                    'type' 			=> 'checkbox',
                    'description' 	=> __('Hide other shipping methods if free shipping is available', 'free-shipping-per-product-for-woocommerce'),
                    'default'		=> 'yes',
                    'desc_tip'		=> false,
                ),
         );
        }



        /**
         * @param array $package
         *
         * @return bool
         */
        public function is_available($package)
        {
            if (isset($package['contents'])) {
                foreach ($package['contents'] as $item) {
                    /** @var WC_Product_Simple $product */
                    $product = $item['data'];
                    if (! in_array($product->get_shipping_class(), [$this->shipping_class])) {
                        // this item doesn't have the right class. return default availability
                        return false;
                    }
                }
            }
            return true;
        }

        /**
         * @param array $package
         */
        public function calculate_shipping($package = array())
        {
            $this->add_rate([
                'label'     => $this->title, // Label for the rate
                'cost'      => '0', // Amount or array of costs (per item shipping)
            ]);
        }

        /**
         * Hide shipping rates when free shipping is available
         *
         * @param array $rates Array of rates found for the package
         * @param array $package The package array/object being shipped
         * @return array of modified rates
         */
        public function hide_shipping_when_free_is_available($rates, $package)
        {
            if ($this->hide_other_methods !== 'yes') {
                return $rates;
            }

            if ($this->is_available($package)) {
                $new_rates = array();
                /**
                 * @var string $key
                 * @var WC_Shipping_Rate $rate
                 */
                foreach ($rates as $key => $rate) {
                    if ($rate->get_method_id() === 'free_shipping_per_product') {
                        // To unset all methods except for free_shipping, do the following
                        $free_shipping          = $rate;
                        $new_rates[$key] = $free_shipping;
                    }
                }
                return $new_rates;
            }
            return $rates;
        }

        /**
         * Admin Panel Options
         * - Options for bits like 'title' and availability on a country-by-country basis
         *
         * @since 1.0.0
         * @return void
         */
        public function admin_options()
        {
            ?>
            <h3><?php _e('Free Shipping per Product Settings', 'free-shipping-per-product-for-woocommerce'); ?></h3>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <table class="form-table">
						    <?php echo $this->get_admin_options_html(); ?>
                        </table><!--/.form-table-->
                    </div>
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable">
                            <div class="postbox shipping-class">
                                <div class="handlediv" title="Click to toggle"><br></div>
                                <h3 class="hndle"><span><i class="fa fa-question-circle"></i>&nbsp;&nbsp;How it works!</span></h3>
                                <div class="inside">
                                    <div class="support-widget">
                                        <p>
                                            To apply shipping for certain product, please create a shipping class and name it <code>free-shipping</code> and then assign it to that product.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="postbox ">
                                <div class="handlediv" title="Click to toggle"><br></div>
                                <h3 class="hndle"><span><i class="fa fa-question-circle"></i>&nbsp;&nbsp;Plugin Support</span></h3>
                                <div class="inside">
                                    <div class="support-widget">
                                        <p>
                                            <img style="width:100%;" src="https://wpruby.com/wp-content/uploads/2016/03/wpruby_logo_with_ruby_color-300x88.png">
                                            <br/>
                                            Got a Question, Idea, Problem or Praise?</p>
                                        <ul>
                                            <li>» <a href="https://wpruby.com/knowledgebase_category/free-shipping-per-product-for-woocommerce/" target="_blank">Documentation and Common issues</a></li>
                                            <li>» <a href="https://wpruby.com/plugins/" target="_blank">Our Plugins Shop</a></li>
                                            <li>» If you like the plugin please leave us a <a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/free-shipping-per-product-for-woocommerce?filter=5#postform">★★★★★</a> rating.</li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div class="postbox rss-postbox">
                                <div class="handlediv" title="Click to toggle"><br></div>
                                <h3 class="hndle"><span><i class="fa fa-wordpress"></i>&nbsp;&nbsp;WPRuby Blog</span></h3>
                                <div class="inside">
                                    <div class="rss-widget">
									    <?php
                                        wp_widget_rss_output(array(
                                            'url' => 'https://wpruby.com/feed/',
                                            'title' => 'WPRuby Blog',
                                            'items' => 3,
                                            'show_summary' => 0,
                                            'show_author' => 0,
                                            'show_date' => 1,
                                        )); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <style type="text/css">
                #postbox-container-1 .shipping-class{
                    background: #ffba00;
                    color:#ffffe0;
                }
            </style>
		    <?php
        }
    }
endif;
?>