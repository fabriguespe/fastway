<?php

function kirki_sidebars_select_example() { 
  	do_action('widgets_init');
 	$sidebars = array(); 
 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) { 
 		$sidebars = $GLOBALS['wp_registered_sidebars']; 
 	} 
 	$sidebars_choices = array(); 
 	foreach ( $sidebars as $sidebar ) { 
 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name']; 
 	}  
 	return $sidebars_choices; 
}  

function urlforimages(){
	$stri=str_replace(site_url(), "", get_template_directory_uri() );
	return $stri;

}
$static_block_args = fastway_get_stblock();

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( 'panel_fastwaystyle', array(

    'title'       => __( 'Fastway Styling', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastwaylayout', array(

    'title'       => __( 'Fastway Layouts', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastwayclient', array(

    'title'       => __( 'Fastway Client Area', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

if(is_plugin_active('woocommerce/woocommerce.php')){
	Kirki::add_panel( 'panel_fastwaywoo', array(
		'title'       => __( 'Fastway Woocommerce', 'fastway' ),
	) );
}

Kirki::add_panel( 'panel_fastway', array(

    'title'       => __( 'Fastway Settings', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastwayemails', array(

    'title'       => __( 'Fastway Emails', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );
Kirki::add_panel( 'panel_fastway_labels', array(

    'title'       => __( 'Fastway Labels', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );


Kirki::add_section( 'section_general', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_csscond', array(
    'title'          => __( 'Conditional CSS', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_email', array(
    'title'          => __( 'Email', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_images', array(
    'title'          => __( 'Images', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
if(isAltoweb()){

	Kirki::add_section( 'section_meli', array(
		'title'          => __( 'Mercadolibre', 'fastway' ),
		//'description'    => __( 'My section description.', 'fastway' ),
		'panel'          => 'panel_fastway',
	
	) );
	
}
Kirki::add_section( 'preset_section', array(
    'title'          => __( 'Preset (beta)', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );


Kirki::add_section( 'section_woo_shop', array(
    'title'          => __( 'Shop Page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
) );

Kirki::add_section( 'section_popup', array(
    'title'          => __( 'Popup', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_scripts', array(
    'title'          => __( 'Scripts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );


Kirki::add_section( 'section_seo', array(
    'title'          => __( 'SEO', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_layouts', array(
    'title'          => __( 'Layouts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );
Kirki::add_section( 'section_buttons', array(
    'title'          => __( 'Buttons', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );
Kirki::add_section( 'section_colors', array(
    'title'          => __( 'Color Scheme', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );

Kirki::add_section( 'section_typos', array(
    'title'          => __( 'Typography', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );

Kirki::add_section( 'section_header', array(
    'title'          => __( 'Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_mobile_header', array(
    'title'          => __( 'Mobile', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
) );


Kirki::add_section( 'section_mobile', array(
    'title'          => __( 'Mobile Menu', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_woo_loop', array(
    'title'          => __( 'Product Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_cat', array(
    'title'          => __( 'Category Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_single_layout', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_brand', array(
    'title'          => __( 'Brand Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );

Kirki::add_section( 'section_woo_loop_blog', array(
    'title'          => __( 'Blog Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_review', array(
    'title'          => __( 'Review Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );

Kirki::add_section( 'section_woo_loop_event', array(
    'title'          => __( 'Event Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );

Kirki::add_section( 'section_footer', array(
    'title'          => __( 'Footer', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_thnkyoupage', array(
    'title'          => __( 'Thank you page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );


Kirki::add_section( 'section_blog', array(
    'title'          => __( 'Blog', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_labels', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_account', array(
    'title'          => __( 'Accounts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_payments', array(
    'title'          => __( 'Payments', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
) );

Kirki::add_section( 'section_labels_single_products', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_products', array(
    'title'          => __( 'Products', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_cart', array(
    'title'          => __( 'Cart', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_shipping', array(
    'title'          => __( 'Shipping', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_checkout', array(
    'title'          => __( 'Checkout', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
) );

Kirki::add_section( 'section_labels_thankyou', array(
    'title'          => __( 'Thank you page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_blog', array(
    'title'          => __( 'Blog labels', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_panel( 'panel_fastwayblog', array(
    'title'       => __( 'Fastway Blog', 'fastway' ),
) );

Kirki::add_section( 'section_blog_general', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_blog_page', array(
    'title'          => __( 'Post Page', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_woo', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );





Kirki::add_section( 'section_woo_single', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_shippings', array(
    'title'          => __( 'Shipping ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_payments', array(
    'title'          => __( 'Payment Methods', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

if(isAltoweb()){
	Kirki::add_section( 'section_woo_discount', array(
		'title'          => __( 'Discounts', 'fastway' ),
		'panel'          => 'panel_fastwaywoo',
	
	) );
}


Kirki::add_section( 'section_woo_cart', array(
    'title'          => __( 'Cart ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
) );



Kirki::add_section( 'section_woo_roles', array(
    'title'          => __( 'Roles', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );
Kirki::add_section( 'section_woo_checkout', array(
    'title'          => __( 'Checkout ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_vars', array(
    'title'          => __( 'Other', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
) );

/*LABELs*/

if(isAltoweb()){
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_checkout_todopago_label',
	'label'       => __( 'TodoPago Label', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_labels_payments',
	'default'     => 'Tarjeta de crédito y débito',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_checkout_todopago_desc',
	'label'       => __( 'TodoPago Descripción', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_labels_payments',
	'default' => 'Procesado por todopago'
) );
}

/*tp*/

if(isAltoweb()){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_checkout_eposnet_label',
		'label'       => __( 'ePosnet Label', 'fastway' ),
		'description'	=>	'Nombre del rol, separados con ",".',
		'section'     => 'section_labels_payments',
		'default'     => 'Tarjeta de crédito y débito',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'textarea',
		'settings'    => 'fw_checkout_eposnet_desc',
		'label'       => __( 'ePosnet Descripción', 'fastway' ),
		'description'=>'Display a messsage on the my account page',
		'section'     => 'section_labels_payments',
		'default' => 'Paga en 3 CUOTAS SIN INTERÉS. Procesado por e-Posnet'
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_label_medios_pago',
		'label'    => __( 'Medios de Pago', 'fastway' ),
		'section'     => 'section_labels_payments',
		'default'	=> 'Metodos de Pago',
	) );

}

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'checkout-msg',
	'label'       => __( 'Checkout message', 'fastway' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_labels_checkout',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_order_gift_note_placeholder',
	'label'       => __( 'Leave a gift message', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default' 		=>__('Leave a gift message', 'fastway')
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_order_notes_placeholder',
	'label'       => __( 'Additional comments', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default' 		=>	__('Additional comments', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_continuar',
	'label'    => __( 'Continue', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Continue', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_aplicar',
	'label'    => __( 'Apply', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Apply', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_agregar_mas',
	'label'    => __( 'Add more products', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Add more products', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_no_hay',
	'label'    => __( 'No products', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'No products', 'fastway' ),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_terms_acepto',
	'label'    => __( 'I Accept the', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'I Accept the', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_terms_name',
	'label'    => __( 'Terms & Conditions', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Terms & Conditions', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_1',
	'label'    => __( 'Your account', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Your account', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_2',
	'label'    => __( 'Your information', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Your information', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_datos_1',
	'label'    => __( 'Invoice information', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Invoice information', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_datos_2',
	'label'    => __( 'Shipping information', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Shipping information', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_ship_to_other',
	'label'    => __( 'Ship to different address (checkbox)', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Ship to different address', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_3',
	'label'    => __( 'Shipping question', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'How do you want to receive your product', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_4',
	'label'    => __( 'Payment question', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'How will you pay?', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_desc',
	'label'    => __( 'Select the correct option', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Select the correct option', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_init',
	'label'    => __( 'Logg In', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Logg In', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_close',
	'label'    => __( 'Logout', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Logout', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_loading',
	'label'    => __( 'Loading...', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'We are processing your order...please wait', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_enter',
	'label'    => __( 'Go to your account', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Go to your account', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_already',
	'label'    => __( 'Already have an account?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Already have an account?', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_forgot',
	'label'    => __( 'Forgot your password?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Forgot your password?', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_change',
	'label'    => __( 'modify', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'modify', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_back',
	'label'    => __( 'Go back', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Go back', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_already_not',
	'label'    => __( 'Still no account?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Still no account?', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_checkout_verde_1',
	'label'    => __( 'Safe Purchase', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Safe Purchase', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_checkout_verde_2',
	'label'    => __( '100% Protected', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( '100% Protected', 'fastway' )
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_read_more',
	'label'       => __( 'Read more label', 'fastway' ),
	'section'     => 'section_labels_blog',
	'description' => 'If empty, is hidden',
	'default'       => __( 'Read more', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_0',
	'label'    => __( 'Thank you for your purchase', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'    => __( 'Thank you for your purchase', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_1',
	'label'    => __( 'The order was completed with number #', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'    => __( 'The order was completed with number #', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_2',
	'label'    => __( 'We sent you an email to', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'    => __( 'we sent you an email to', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_3',
	'label'    => __( 'with details and follow-up instructions.', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'    => __( 'with details and follow-up instructions.', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_4',
	'label'    => __( 'Continue buying', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'    => __( 'Continue buying', 'fastway' ),
) );


 
//Layouts

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_general_ratio',
	'label'       => __( 'Default border radius', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 0,
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'fastway' ),
	'section'     => 'section_layouts',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
	'default'     => 'container',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-blog',
	'label'       => __( 'Blog Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-main',
	'label'       => __( 'Main layout: wide or boxed', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	
	'choices'     => array(
		'container-fluid'   => 'Wide',
		'container-mid'   => 'Medium',
		'container'   => 'Boxed',
		'container-small'   => 'Small',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-main',
	'label'       => __( 'Sidebars Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-shop',
	'label'       => __( 'Shop Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop-layout',
	'label'       => __( 'Shop Pages Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );
/*SINGLE*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product-page-layout',
	'label'       => __( 'Product Page Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer-width',
	'label'       => __( 'Footer Width', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
) );

/*BLOG*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_title_switch',
	'label'       => __( 'Blog title', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'blog-stblock',
	'label'       => __( 'Blog Page Header Section', 'fastway' ),
	'section'     => 'section_blog_general',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_sidebar_ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_per_page',
	'label'       => esc_attr__( 'News Per Page', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 12,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_columns',
	'label'       => esc_attr__( 'Columns', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '1',
	),
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog',
	'label'       => __( 'CSS Blog Page ', 'fastway' ),
	'section'     => 'section_blog_general',
	'description' => 'Classes: .fw_post_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


/*BLOG PAGE*/



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_date_switch',
	'label'       => __( 'Date data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_author_switch',
	'label'       => __( 'Author data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_featured_switch',
	'label'       => __( 'Featured Image', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_comment_switch',
	'label'       => __( 'Comments', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog_page',
	'label'       => __( 'CSS Post Page ', 'fastway' ),
	'section'     => 'section_blog_page',
	'description' => 'Classes: .post_page',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-forms',
	'label'       => __( 'CSS Forms', 'fastway' ),
	'section'     => 'section_forms',
	'description' => 'Css de los gravity forms',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*IMAGES*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-logo',
	'label'       => __( 'Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_images',
	'default'     => urlforimages()."/assets/img/".fw_theme_mod('fw_dev_assetfolder')."logo.png",
	'transport'=>'postMessage',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_favicon',
	'label'       => __( 'Favicon', 'fastway' ),
	'description' => 'Users site identify as default',
	'section'     => 'section_images',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'dark-logo',
	'label'       => __( 'Dark Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_images',
	'default'     => urlforimages()."/assets/img/".fw_theme_mod('fw_dev_assetfolder')."logo.png"
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_mobile_logo',
	'label'       => __( 'Mobile Logo', 'fastway' ),
	'description' => __( 'Replaces general logo on mobile. Defaults take it from general logo', 'fastway' ),
	'section'     => 'section_images'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw-email-logo',
	'label'       => __( 'Email Logo', 'fastway' ),
	'description' => 'Logo for emails. Defaults take it from general logo',
	'section'     => 'section_images',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'mobile-icon',
	'label'       => __( 'Mobile App Icon', 'fastway' ),
	'section'     => 'section_images',
	'default'     => '',
) );



//General


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_seo',
	'label'       => __( 'FW Meta Tags', 'fastway' ),
	'description' => 'Disable fastway metatags if you are using external seo plugins',
	'section'     => 'section_seo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'social_media_image',
	'label'       => __( 'Social Media Image', 'fastway' ),
	'description' => 'Size: 1200x630 <= 1MB',
	'section'     => 'section_seo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => __( 'Meta Description', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-keywords',
	'label'       => __( 'Keywords', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );



/*HEAADER*/
Kirki::add_field( 'theme_config_id', [
	'type'        => 'select',
	'settings'    => 'color_scheme_radio',
	'label'       => 'Preset Loader',
	'description' => 'It will bring all necesary codes',
	'section'     => 'preset_section',
	'choices'     => builder_labels(),
	'preset'  => presets()
] );

Kirki::add_field( 'theme_config_id', [
	'type'     => 'textarea',
	'settings' => 'preset_field',
	'label'    => esc_html__( 'Textarea Control', 'kirki' ),
	'section'  => 'preset_section',
	'default'  => esc_html__( 'This is a default value', 'kirki' ),
	'priority' => 10,
] );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_header_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'sticky-menu',
	'label'       => __( 'Deactivate Sticky', 'fastway' ),
	'section'     => 'section_header',
	'default'     => array('fw_header.middle', 'fw_header.bottom'),
	'choices'     => array(
		'fw_header.top' => __( 'Top', 'fastway' ),
		'fw_header.middle' => __( 'Middle', 'fastway' ),
		'fw_header.bottom' => __( 'Bottom', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_floating_trans_header',
	'label'       => __( 'Floating Transparent', 'fastway' ),
	'section'     => 'section_header',
	'description' => __('Only works for homepage','fastway'),
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-padding',
	'label'       => __( 'Header Padding', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices'     => array(
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
		'1.5' => 4,
		'3' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header_icons_size',
	'label'       => __( 'Header Icons Size', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.desktop .fw-header-icon i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.desktop .fw-header-icon .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'logo-width',
	'label'       => __( 'Logo Width', 'fastway' ),
	'section'     => 'section_header',
	'default'     => '180',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'logo-height',
	'label'       => __( 'Logo Height', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 'auto',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop .logo img',
			'property'	=> 'height',
			'units'=>'px'
		),
	),
) );
/*MELI*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_id_ml',
	'label'       => __( 'ID Mercadolibre ', 'fastway' ),
	'description'	=>	'Sirve tambien para el dashboard help',
	'section'     => 'section_meli',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_ml_on',
	'label'       => __( 'ML Sync ML->WEB', 'fastway' ),
	'section'     => 'section_meli',
	'description' => 'Pasarle el link al cliente: <a href="'.'https://'.$_SERVER['HTTP_HOST'].'/wp-content/themes/fastway/functions/meli/'.'">LINK</a><br>'.json_encode(get_option('fw_ml_app_'.get_theme_mod('fw_id_ml'))),
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_ml_appid',
	'label'       => __( 'App Id ', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_meli',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_ml_appsecret',
	'label'       => __( 'App Secret ', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_meli',
	'default'     => '',
) );



/*EMAIL*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_woosettings',
	'label'       => __( 'Init Woocommerce', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Restarts woocommmerce with fastway default settings. *You must refresh for chances to apply',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_init_mayorista',
	'label'       => __( 'Init Mayorista', 'fastway' ),
	'description' => 'Restarts wholesale mode with fastway default settings. *You must refresh for chances to apply',
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_resetmails_notis',
	'label'       => __( 'Reset Email Notifications', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Restarts woocommmerce emails with fastway default settings. *You must refresh for chances to apply',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_resetmails_styling',
	'label'       => __( 'Reset Email Styling', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Restarts woocommmerce emails with fastway default settings. *You must refresh for chances to apply',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_resetmails_templates',
	'label'       => __( 'Reset Email Templates', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Restarts woocommmerce emails with fastway default settings. *You must refresh for chances to apply',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_clientimages',
	'label'       => __( 'Client Area Images', 'fastway' ),
	'description' => 'Restarts admin images (branding) with fastway default settings. *You must refresh for chances to apply.',
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

/*DEVELOPER*/
Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_fork_name',
	'label'    	=> __( 'Fork code', 'fastway' ),
	'description' 	=>	'A name so you can programably show/hide things in the source code calling fw_theme_mod("fw_fork_name"). <br><b>IMPORTANT: First save this field and then refresh to edit the fields below</b>',
	'section'   => 'section_developer',
	'default' => 'fastway'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_name',
	'label'       => __( 'Display Name', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"Altoweb":"Fastway"),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_email',
	'label'       => __( 'Support Email', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"soporte@altoweb.ar":"fguespe@gmail.com"),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_url',
	'label'       => __( 'Website Url', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"https://www.altoweb.ar":"https://www.buymeacoffee.com/fabriguespe"),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_docsurl',
	'label'       => __( 'Docs Url', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"https://altoweb.freshdesk.com/a/solutions/articles/36000237973":"https://www.notion.so/fabrizio/Fastway-6285d2b579a0483b81aac82b86c38b37"),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_phpfile',
	'label'       => __( 'Extra php file path', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"functions/altoweb/altoweb.php":""),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_assetfolder',
	'label'       => __( 'Custom assets folder', 'fastway' ),
	'description'	=>	'IMPORTANT: End it with /',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"altoweb/":""),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_dev_logo',
	'label'       => __( 'Dev Logo', 'fastway' ),
	'description' => __( 'This logo will appear in the login , the client area and maintenance mode.', 'fastway' ),
	'section'     => 'section_developer',
	'default'     => urlforimages()."/assets/img/".fw_theme_mod('fw_dev_assetfolder')."logo.png",
	'transport'=>'postMessage',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_dev_favi',
	'label'       => __( 'Dev Favicon', 'fastway' ),
	'description' => __( 'This logo will appear in the login , the client area and maintenance mode.', 'fastway' ),
	'section'     => 'section_developer',
	'default'     => urlforimages()."/assets/img/".fw_theme_mod('fw_dev_assetfolder')."favi.png",
	'transport'=>'postMessage',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_dev_adminuser',
	'label'       => __( 'Admin username', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_developer',
	'default'     => (isAltoweb()?"webaltoweb":""),
) );



if(is_devadmin()){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_ml_stock_web_a_ml',
		'label'       => __( 'Descontar stock web->ml', 'fastway' ).(isAltoweb()?'(CR)':''),
		'section'     => 'section_meli',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_ml_stock_web_a_ml',
		'label'       => __( 'Descontar stock web->ml', 'fastway' ).(isAltoweb()?'(CR)':''),
		'section'     => 'section_meli',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	) );
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_ml_stock_slm_test',
		'label'       => __( 'Stock ml->web (Exp)', 'fastway' ).(isAltoweb()?'(CR)':''),
		'section'     => 'section_meli',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	) );
	
}

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_ml_debug',
	'label'       => __( 'Debug', 'fastway' ).(isAltoweb()?'(CR)':''),
	'section'     => 'section_meli',
	'description'	=> 'Activar esto para que se logee todo',
	'default'     => 0,
	'choices' => array(
		'on'  => __( 'Enable', 'fastway' ),
		'off' => __( 'Disable', 'fastway' )
	)
) );

if(is_devadmin()){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_shipping_groups',
		'label'       => __( 'Shipping Groups', 'fastway' ).(isAltoweb()?'(CR)':''),
		'description'	=> 'Groups pickup locations under pick-up option',
		'section'     => 'section_woo_checkout',
		'default'     => 0,
		'choices' => array(
			0  => __( 'Disable', 'fastway' ),
			1 => __( 'Enable', 'fastway' )
		)
	) );
}

Kirki::add_section( 'section_email_general', array(
	'title'          => __( 'General', 'fastway' ),
	//'description'    => __( 'My section description.', 'fastway' ),
	'panel'          => 'panel_fastwayemails'
) );
Kirki::add_panel( 'section_email_templates', array(
	'title'          => __( 'Email Templates', 'fastway' ),
	//'description'    => __( 'My section description.', 'fastway' ),
	'panel'          => 'panel_fastwayemails'
) );

Kirki::add_section( 'section_email_templates_orders', array(
	'title'          => __( 'Orders', 'fastway' ),
	//'description'    => __( 'My section description.', 'fastway' ),
	'panel'          => 'section_email_templates'
) );

Kirki::add_section( 'section_email_templates_auth', array(
	'title'          => __( 'Authentication', 'fastway' ),
	//'description'    => __( 'My section description.', 'fastway' ),
	'panel'          => 'section_email_templates'
) );

Kirki::add_section( 'section_email_templates_other', array(
	'title'          => __( 'Other', 'fastway' ),
	//'description'    => __( 'My section description.', 'fastway' ),
	'panel'          => 'section_email_templates'
) );



Kirki::add_section( 'section_email_styles', array(
    'title'          => __( 'Email Styling', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwayemails',

) );


if(is_devadmin()){
	Kirki::add_section( 'section_actions', array(
		'title'          => __( 'Actions', 'fastway' ),
		//'description'    => __( 'My section description.', 'fastway' ),
		'panel'          => 'panel_fastway',
	
	) );
	Kirki::add_section( 'section_developer', array(
		'title'          => __( 'Developer', 'fastway' ),
		//'description'    => __( 'My section description.', 'fastway' ),
		'panel'          => 'panel_fastway',

	) );
}


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'my_setting_2',
	'label'       => __( 'INFO', 'textdomain' ),
	'section'     => 'section_email_general',
	'default'     => '<div style="padding: 10px;background-color: #fff; color:black; border: 1px solid #1E73BE;">
	<h4>Default values</h4>
	The default values are taken from company data. Works with gravity forms.
	</div>',
	'priority'    => 10,
) );


Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_nombre',
	'label'    	=> __( 'From Name', 'fastway' ),
	'description' 	=>	'The name of the company in emails',
	'section'   => 'section_email_general',
	'default' => '',
	'input_attrs' => array(
		'placeholder' => get_bloginfo( 'name' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_mails',
	'label'    	=> __( 'Admin Notification Emails', 'fastway' ),
	'description' 	=>	' Email addresses that will receive all website notifations. Separated with comma (,).',
	'section'   => 'section_email_general',
	'default' => '',
	'input_attrs' => array(
		'placeholder' => getMailQueEnvia()
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_name',
	'label'    	=> __( 'Admin Notifications From Name', 'fastway' ),
	'default' => '',
	'description' 	=>	'Name that shows in the notification emails. Can be different to customer notifications.)',
	'section'   => 'section_email_general',
	'input_attrs' => array(
		'placeholder' => get_bloginfo( 'name' )
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_email',
	'label'    	=> __( 'Email From', 'fastway' ),
	'default' => '',
	'description' 	=>	'',
	'section'   => 'section_email_general',
	'input_attrs' => array(
		'placeholder' => getMailQueEnvia()
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_bcc',
	'label'    	=> __( 'bcc default', 'fastway' ),
	'description' 	=>	' *You can put and admin email so they can monitor all emails sent to customers.',
	'section'   => 'section_email_general',
	'default' => '',
) );


/*EMAIL*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_logo_width',
	'label'       => __( 'Email Logo Width', 'fastway' ),
	'section'     => 'section_email_styles',
	'default'     => '100%'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-email',
	'label'       => __( 'CSS in Emails', 'fastway' ),
	'section'     => 'section_email_styles',
	'default'     => ''
) );
/*MOBILE*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_mheader_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_mobile_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width-mobile',
	'label'       => __( 'Mobile Logo Width', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 110,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile  .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'fw_mobile_max_height',
	'label'       => __( 'Mobile Space max Height', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 40,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.mobile_body  .vc_empty_space',
			'property'	=> 'max-height',
			'units'=>'px'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header__mobile_icons_size',
	'label'       => __( 'Mobile Header Icons Size', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.mobile i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.fw_header.mobile .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header_padding_mobile',
	'label'       => __( 'Header Padding Mobile', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 1,
	'choices'     => array(
		'0'  => 0,
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_mobile_code',
	'label'       => __( 'Header Mobile Code', 'fastway' ),
	'description' => '[fw_m_header id="bottom,top,middle"][fw_logo][fw_m_menu][fw_user_account type="1(only icon)/2(only text)/3(username)][fw_m_search_form][fw_shopping_cart type="1(only icon)/2(only text)/3(username)][/fw_m_header]',
	'section'     => 'section_mobile_header',
	'default'     => '[fw_m_header]<div class="col-3 row align-items-center justify-content-around px-0">
	[fw_m_menu][fw_m_search_form id="3"]
</div>
<div class="col-6 row align-items-center justify-content-center">
	[fw_logo]
</div>
<div class="col-3 row align-items-center justify-content-center">
	[fw_shopping_cart]
</div>[/fw_m_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-mobile',
	'label'       => __( 'CSS Mobile', 'fastway' ),
	'description'	=> 'Put everything inside @media',
	'section'     => 'section_mobile_header',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );






Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu',
	'label'       => __( 'Mega Menu', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'mega_menu_cols',
	'label'       => __( 'Mega Menu Layout', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 3,
	'choices'     => array(
		6 => __( '2 cols', 'fastway' ),
		4 => __( '3 cols', 'fastway' ),
		3 => __( '4 cols', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu_overlay',
	'label'       => __( 'Overlay', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_code',
	'label'       => __( 'Header Code', 'fastway' ),
	'description' => '
					[fw_header id="bottom,top,middle"]
					[fw_logo][fw_menu id="XXX/empty for main"][fw_user_account type="1(only icon)/2(only text)/3(username)][fw_search_form id="1"][fw_data type="phone" isli="true" stext="Atencion Telefonica"][fw_shopping_cart]
					[/fw_header]',
	'section'     => 'section_header',
	'default'     => '[fw_header][fw_logo][fw_menu][/fw_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header',
	'label'       => __( 'CSS Header', 'fastway' ),
	'section'     => 'section_header',
	'description' => 'Clases: .fw_header.top,  .fw_header.bottom,  .fw_header.middle,<br> Ids: #header, #fw_menu ,<br>Elements: .fw_search_form, .fw_logo',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*BUTTONS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_b_color',
	'label'       => __( 'Primary background color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-background);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-background',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_color',
	'label'       => __( 'Primary color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-color);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-color',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_b_color_hover',
	'label'       => __( 'Primary background color (hover)', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--second)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-background-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-background-hover',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_color_hover',
	'label'       => __( 'Primary color (hover) ', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-color-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-color-hover',
		),
	),
) );





Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_b_color',
	'label'       => __( 'Secondary background color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-background);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-background',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_color',
	'label'       => __( 'Secondary color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-color);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-color',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_b_color_hover',
	'label'       => __( 'Secondary background color (hover)', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-background-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-background-hover',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_color_hover',
	'label'       => __( 'Secondary color (hover) ', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--man)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-color-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-color-hover',
		),
	),
) );












/*COLOR SCHEME*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-main',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#0b6e99',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--main);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--main',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-second',
	'label'       => __( 'Secondary Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#FFD421',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--second);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--second-color',
		),
		array(
			'element'  => ':root',
			'property' => '--second',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-iconheader',
	'label'       => __( 'Icons', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#0b6e99',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--icon-header); Its a color for all icons in header. Can be owewritten in css.',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--icon-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-topheader',
	'label'       => __( 'Top Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--top-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--top-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-middheader',
	'label'       => __( 'Middle Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--middle-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--middle-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'color-sticky-header',
	'label'       => __( 'Header Sticky Color ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'description'=>' var(--sticky-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--sticky-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bottheader',
	'label'       => __( 'Bottom Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--bottom-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--bottom-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bodycolor',
	'label'       => __( 'Body Background', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--body);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--body',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-shopcolor',
	'label'       => __( 'Shop Background ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#ffffff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--shop);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--shop',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-footer',
	'label'       => __( 'Footer ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => 'var(--main);',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--footer);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--footer',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-copyright',
	'label'       => __( 'Copyright ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--copyright);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--copyright',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_body_dark_mode',
	'label'       => __( 'Dark Mode Body', 'fastway' ),
	'description'       =>'Black website',
	'section'     => 'section_colors',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_thankyou',
	'label'    => __('Thank you page','fastway'),
	'section'     => 'section_thnkyoupage',
	'default'	=> __('
<h2 style="text-align: center;">Thank you for your order!</h2>

<p style="text-align: center;">Your purchase has been submitted with order number: {{order_number}}</p>

<p style="text-align: center;">We will follow up with an email with your purchase details.</p>

<p style="text-align: center;">When our expert team has processed and assembled your order, we will update you once more with a shipping confirmation and tracking information.</p>

<p style="text-align: center;">Questions? Concerns? Compliments? Please contact {{customer_email}}</p>','fastway'),
'choices'     => array('language' => 'html',),
) );

/*MOBILE*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-ctas-switch',
	'label'       => __( 'CTAs Active', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw-ctas',
	'label'       => __( 'CTAs', 'fastway' ),
	'description'	=>	'(icon class, url or company-data,button class, text)',
	'section'     => 'section_mobile',
	'default'     => 'fab fa-whatsapp,whatsapp,wp,Consultanos | fal fa-phone,phone,fb,Llamar ahora'
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_mobile_dark_mode',
	'label'       => __( 'Menu Dark Mode', 'fastway' ),
	'description'       =>'Automatically adjusts font size to screen',
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'responsive-typo',
	'label'       => __( 'Responsive Typo ', 'fastway' ),
	'description'       =>'Automatically adjusts font size to screen',
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-quicklinks',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'description'     => __( 'Custom call to action items in mobile menu', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_quickmenu_links',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'section'     => 'section_mobile',
	'default' => 'fb,youtube,whatsapp,ig,email,phone,address'
) );





Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'mobile-redirect',
	'label'       => __( 'Redirect Mobile', 'fastway' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_mobile',
	'default'     => '',
) );



if(isAltoweb()){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_is_multitienda',
		'label'       => __( 'Multilist', 'fastway' ),
		'description'	=> 'More than one list price by role',
		'section'     => 'section_woo',
		'default'     => 0,
		'choices' => array(
			0  => __( 'Disable', 'fastway' ),
			1 => __( 'Enable', 'fastway' )
		)
	) );

}

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_shop_state',
	'label'       => __( 'Shop State', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'Purchases Off: Hides purchase button so no one can buy<br>Only enquiry: Hides prices and purchase button and replaces it with a contact button.',
	'default'     => 'normal',
	'choices'     => array(
		'normal' => __( 'Normal', 'fastway' ),
		'hidepurchases' => __( 'Purchases Off', 'fastway' ),
		'hideprices' => __( 'Only enquiry', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_prices_visibility',
	'label'       => __( 'Prices', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show' => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_purchases_visibility',
	'label'       => __( 'Purchases', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show'   => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_taxrate',
	'label'       => __( 'Show Taxrate', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_format_numbers',
	'label'       => __( 'Format Numbers Manually', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_categorized_only',
	'label'       => __( 'Exclude uncategorized', 'fastway' ),
	'description'	=> 'Excludes uncategorized products from the search',
	'section'     => 'section_woo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_priced_only',
	'label'       => __( 'Exclude unpriced', 'fastway' ),
	'description'	=> 'Excludes unpriced products from the search',
	'section'     => 'section_woo',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_hide_cates',
	'label'       => __( 'Hide categorys', 'fastway' ),
	'description'	=>	'Categories to hide on the store. Separated with comma.',
	'section'     => 'section_woo',
	'default'     => 'sin-categorizar,sin-categoria,uncategorized',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_placeh_image',
	'label'       => __( 'Placeh image', 'fastway' ),
	'description'	=>	'Categories to hide on the store. Separated with comma.',
	'section'     => 'section_woo',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_consultar_link',
	'label'    => __( 'Enquiry Button Link', 'fastway' ),
	'section'     => 'section_woo',
	'default' => '/contact'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase',
	'label'    => __( 'Min Purchase', 'fastway' ),
	'description' => 'Min purchase ammount. Also you can specify roles. Eg: 1400 (role1,role2) '.strtolower(implode(", ",fw_get_all_roles())),
	'section'     => 'section_woo_cart',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase2',
	'description' => 'Min re-purchase ammount. Also you can specify roles. Eg: 1400 (role1,role2) '.strtolower(implode(", ",fw_get_all_roles())),
	'label'    => __( 'Min Re-Purchase', 'fastway' ),
	'section'     => 'section_woo_cart',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_modal_cart_calltoa',
	'label'       => __( 'Modal Cart Call to Action', 'fastway' ),
	'section'     => 'section_woo_cart',
	'default'     => 'checkout',
	'choices'     => array(
		'checkout'   => __( 'Checkout', 'fastway' ),
		'cart' => __( 'Cart ', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_show_cross_sells',
	'label'       => __( 'Cross Sells', 'fastway' ),
	'description'	=> 'Shows cross-sells in the cart page. Category \'cross-sells\' is the default if you want to set them manually.',
	'section'     => 'section_woo_cart',
	'default'     => 'none',
	'choices'     => array(
		'none'   	=> 	'None',
		'auto'   	=> 	'Products',
		'manual'   	=> 	'Category/Manual',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_code_modalcart',
	'label'       => __( 'Custom code modal', 'fastway' ),
	'description' => 'Add custom code or shortcodes to the modal cart',
	'section'     => 'section_woo_cart',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_price_suffix',
	'label'    => __( 'Price Suffix', 'fastway' ),
	'description' =>'Goes next to the right of the price.',
	'section'     => 'section_woo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_conversion',
	'label'    => __( 'Currency Conversion', 'fastway' ),
	'description' => __('This conversion will convert all prices the especified multiplier. Eg: if conversion is 10 and price is $2. It will show $20.','fastway'),
	'section'     => 'section_woo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_seguircomprando_url',
	'label'    => __( 'Keep Purchasing', 'fastway' ),
	'description' => 'Url in the modal cart that redirects you to keep butin',
	'default' 	=>	 '/',
	'section'     => 'section_woo',
) );


/*

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'bread-enabled',
	'label'       => __( 'Breadcrumb', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_sell_dni',
	'label'       => __( 'Identity Number', 'fastway' ),
	'description'	=> __( 'Requires indentity number' ),
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_gift_fields',
	'label'       => __( 'Gift Fields', 'fastway' ).(isAltoweb()?'(CR)':''),
	'description'	=> 'Adds field for a gift message to be put on the packaging.',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
		0  => __( 'Disable', 'fastway' ),
		1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_terms_required',
	'label'       => __( 'Terms', 'fastway' ),
	'description'	=> 'Shows terms and condition acceptance. The links is set in woo settings..',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_sell_to_business',
	'label'       => __( 'Sell to business', 'fastway' ),
	'description'	=> 'Asks for company name and VAT',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_hide_coupon',
	'label'       => __( 'Show coupon input', 'fastway' ),
	'description'	=> 'Shows the coupon in checkout',
	'section'     => 'section_woo_checkout',
	'default'     => 1,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_checkout_field_address_2',
	'label'       => __( 'Extra address field', 'fastway' ),
	'description'	=> 'Extra address field for multiple purposes. Go to Fastway->labels to set it up.',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_opt_color_checkout',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--checkout); (por default toma el color primario (--main)',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--checkout',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_opt_color_checkout_back',
	'label'       => __( 'Background Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#ECECEC',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'#ECECEC',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--checkout_back',
		),
	),
) );

/*tp*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_symbol',
	'label'    => __( 'Currency Symbol', 'fastway' ),
	'description' => 'Only affecs main currecy. Leave empty for default.',
	'section'     => 'section_woo_vars',
) );

if(isAltoweb()){
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_todopago',
	'label'    => __( 'Cuotas Todopago', 'fastway' ),
	'section'     => 'section_woo_vars',
	'description' => '',
	'default' => 6
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_todopago_calculador',
	'label'    => __( 'TodoPago Installments', 'fastway' ),
	'section'     => 'section_woo_vars',
	'description' => 'This shows in the Select Dropdown of Installment Calculator.Separate with comma (,)',
	'default' => '1,2,3,4,5,6'
) );

}


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_general',
	'label'    => __( 'Installments', 'fastway' ),
	'description' => 'Installment variable. Can be useful in many places. [fw_cuotas_general]',
	'section'     => 'section_woo_vars',
	'default' => 12
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_general_message',
	'label'       => __( 'General message', 'fastway' ),
	'description'=>'Display a messsage on the top bar for important notificacions',
	'section'     => 'section_woo_vars',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_mensaje_sec',
	'label'       => __( 'Secondary message', 'fastway' ),
	'description'=>'Display a messsage on the top bar for important notificacions',
	'section'     => 'section_woo_vars',
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_welcome_msg',
	'label'       => __( 'Welcome message', 'fastway' ),
	'description'=> 'Display a messsage on the my account page',
	'section'     => 'section_woo',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'sold-alone',
	'label'       => __( 'Sold Individually', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'Redirects to checkout directly *redirect to cart has to be activated in woocommerce product options',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );






Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_extra_tax',
	'label'       => __( 'Custom Taxonomies', 'fastway' ),
	'description'	=>	'Taxonomy names. Eg: Brand, Genre',
	'section'     => 'section_woo',
	'default'     => '',
) );
/*EMAILS*/




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'ca_extra_roles',
	'label'       => __( 'Extra roles', 'fastway' ),
	'description'	=>	'Extra roles names, separated with ",". Ej: Wholesale',
	'section'     => 'section_woo_roles',
	'default'     => '',
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'ca_roles_css',
	'label'       => esc_attr__( 'CSS Roles', 'fastway' ),
	'description' => 'Roles para editar para tambien el shop_manager.',
	'section'     => 'section_woo_roles',
    'choices'     => fw_getme_roles(),
	'default'     => ''
) );
*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-roles',
	'label'       => __( 'CSS For Roles ', 'fastway' ),
	'section'     => 'section_woo_roles',
	'description' => 'Roles can have custom css for logged in users. Adds a class to the body: '.get_role_body_classes(),
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'sidebar-ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 2,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_per_page',
	'label'       => esc_attr__( 'Products Per Page', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 40,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_columns',
	'label'       => esc_attr__( 'Shop Columns', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 4,
	'choices'     => array(
		'min'  => '1',
		'max'  => '12',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_columns_mobile',
	'label'       => esc_attr__( 'Shop Columns Mobile', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 2,
	'choices'     => array(
		'min'  => '1',
		'max'  => '12',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'fw_shop_stblock_header',
	'label'       => __( 'Shop Page Header Section', 'fastway' ),
	'section'     => 'section_woo_shop',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_shop',
	'label'       => __( 'CSS Shop Page ', 'fastway' ),
	'section'     => 'section_woo_shop',
	'description' => 'Classes: .woocommerce-shop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );



if(isAltoweb()){
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_only_mercadoenvios',
	'label'       => __( 'Calculate Only Mercadoenvios', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Refrescar despues de activar',
	'default'     => 0,
	'choices' => array(
		'on'  => __( 'Enable', 'fastway' ),
		'off' => __( 'Disable', 'fastway' )
	)
) );
}

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_define_shipping_default',
	'label'       => __( 'Default shipping paramaters', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Sets default width, height y weight to all products (for shipping plugins to work).',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_free_shipping_only_first_order',
	'label'       => __( 'Free Shipping First Order', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'This gives the freeshipping options only for the first purchase of a customer',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_only_free_shipping',
	'label'       => __( 'Show only Free Shipping', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Hides other options if free shipping is available, it doesnt hide local pickups',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fa fa-motorcycle',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'En el día, en moto',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_1_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>CABA / GBA consultar costos</h3>
	<div class="specs">Para recibirlo en el día solicitarlo antes de las 13hs, 50% de recargo día de lluvia.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fa fa-bus',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envío a terminal',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_2_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Despachamos sin cargo</h3><div class="specs">Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fa fa-shipping-fast',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envíos a todo el país',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_3_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Consulta el costo con tu código postal en el producto a comprar.</h3><div class="specs">Despachamos dentro de las 24hs de realizada la compra. Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fa fa-truck-container',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Flete',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_4_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Fletes a todo el país.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fa fa-store',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Retiro en el local',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_5_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Retiralo en nuestro local [fw_data type="address" only_text="true"]</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_icon',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_title',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_6_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fa fa-credit-card',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Tarjeta de Crédito',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_1_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<h3>Pagá Online con MercadoPago</h3>
	<a target="_blank" data-toggle="modal" data-target="#modal_modalmp" class="btn fw_icon_link fancybox">Ver promociones</a>
	<div class="modal modal_modalmp fade" id="modal_modalmp" tabindex="-1" role="dialog" aria-labelledby="modal_modalmpTitle" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				<iframe height="1000" width="100%" frameborder="0" title="Promociones bancarias" scrolling="no" src="https://www.mercadolibre.com.ar/gz/home/payments/methods?modal=true"></iframe>
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fa fa-hand-holding-usd',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Efectivo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_2_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Podés pagar al contado en nuestras sucursales.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fa fa-money-check-alt',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Depósito / Transferencia',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_3_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Puede demorar hasta 72hs hábiles en acreditarse.</div>
	<a target="_blank" data-toggle="modal" data-target="#modal_bancos" class="btn fw_icon_link fancybox">Ver datos</a>
	<div class="modal modal_bancos fade" id="modal_bancos" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				[altoweb_bancos]
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fa fa-barcode-read',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Cupón de Pago',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_4_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<img stclass="aligncenter" width="60%" src="/wp-content/themes/fastway/assets/img/cupones.png">
	<div class="specs">Imprmí el cupón o copiá el código, vas a RapiPago, Pago Fácil, Provincia Net o Bapro Pago y listo!</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_5_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_6_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_single_product_layout',
	'label'       => __( 'Layout', 'fastway' ),
	'section'     => 'section_woo_single_layout',
	'default'     => 'layout1',
	'choices'     => array(
		'layout1'   	=> 	'Default',
		'layout2'   	=> 	'50/50'
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'related_columns',
	'label'       => __( 'Related Products Columns', 'fastway' ),
	'section'     => 'section_woo_single_layout',
	'default'     => 6,
	'choices'     => array(
		'min'  => '3',
		'max'  => '12',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_tab_additional',
	'label'       => __( 'Specs tab', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => '*Refresh customizer to see it',
	'default'     => 'off',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_tab_hide_specs',
	'label'       => __( 'Show product measurements', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => 'off',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_related_auto',
	'label'       => __( 'Show automatic related products', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => 'on',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_single_code',
	'label'    => __( 'Single Product Code', 'fastway' ),     
	'section'     => 'section_woo_single_layout',
	'description'     => '[fw_single_container]
	[fw_single_gallery]
	[fw_single_summary]
	[fw_single_title]
	[fw_single_qty](stock)
	[fw_single_price]
	[fw_single_cart]
	[fw_single_cf]
	[fw_short_desc]
	[fw_single_share]
	[altoweb_financiacion]
	[fw_product_form_cta]
	[/fw_single_summary]
	[fw_single_tabs]
	[/fw_single_container]
	[fw_single_related]
	Customer Edits:
	[fw_customer_product_summary]',
	'default'     => '[fw_single_container]
	[fw_single_gallery]
	[fw_single_summary]
	[fw_single_title]
	[fw_single_price]
	[fw_single_cart]
	[fw_single_cf]
	[/fw_single_summary]
	[fw_single_tabs]
	[/fw_single_container]
	[fw_single_related]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'fastway' ), 
	'description' => 'Everything goes inside .fw_single_product',
	'section'     => 'section_woo_single_layout',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_product_summary',
	'label'       => __( 'General Info', 'fastway' ), 
	'description' => __( 'General info section that goes in all product pages in the short description. Editable from client area -> templates', 'fastway' ), 
	'section'     => 'section_woo_single_layout',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'html',
	),
) );


//}
/*FOOTER*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_footer_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_footer',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'footer-stblock',
	'label'       => __( 'Static Block', 'fastway' ),
	'section'     => 'section_footer',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer',
	'label'       => __( 'CSS Footer', 'fastway' ),
	'description' => 'Everything goes inside #footer',
	'section'     => 'section_footer',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

if(get_locale()=='es_ES'){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_arrepentimiento_link',
		'label'       => __( 'Link Arrepentimiento', 'fastway' ),
		'description' => 'Link al que redirige el arrepentimiento. ',
		'section'     => 'section_footer',
		'default'     => 'mailto:'.getMailQueRecibe(),
	) );
}

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'footer-copyright-switch',
	'label'       => __( 'Show Footer Copyright', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-copyright-text',
	'label'       => __( 'Footer Copyright HTML', 'fastway' ),
	'description'       => __( 'Not all headers have Header Widget', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => '<div id="fw_footercopy" style="border-top:1px solid #d3d3d3;" class="container-fluid d-flex justify-content-between align-items-center"><div class="izquierda" style="font-size:15px !important;">Powered by <a style="margin-left:5px;" href="'.fw_theme_mod('fw_dev_url').'" target="_blank" rel="noopener"><img class="logofirma"  height="28" src="/wp-content/themes/fastway/assets/img/'.fw_theme_mod('fw_dev_assetfolder').'logo.png"/></a></div><div class="copyright d-none d-md-block" style="font-size:15px !important;">Copyright ©  [fw_data  type="name" only_text="true" size="15"] | Todos los derechos reservados.</div>  </div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

/*TYPOGRAPHY*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-header',
	'label'       => __( 'Main Navigation', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.navbar-nav li > a',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h1',
	'label'       => __( 'H1', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '44px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h1',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h2',
	'label'       => __( 'H2', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '32px',
		'line-height'    => '36px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h2',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h3',
	'label'       => __( 'H3', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '25px',
		'line-height'    => '30px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h3',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h4',
	'label'       => __( 'H4', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '24px',
		'line-height'    => '28px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h4',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-body',
	'label'       => __( 'Body', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body a',
		),
		array(
			'element' => 'body p',
		),
		array(
			'element' => 'body div',
		),
		array(
			'element' => 'body span',
		),
		array(
			'element' => 'body li',
		),
		
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );



/*Section CSS*/
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-general',
	'label'       => __( 'CSS General', 'fastway' ),
	'section'     => 'section_css_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-body',
	'label'       => __( 'CSS Body', 'fastway' ),
	'section'     => 'section_css_body',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

*/


/*LOOP*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_pl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_code',
	'label'       => __( ' Product Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description'     => '[fw_loop_container][fw_loop_image][fw_short_desc][fw_loop_title][fw_if][fw_cuotas cant="X/general"][fw_loop_price][fw_loop_stock][fw_loop_cart][/fw_loop_container][fw_loop_btn type="ajax/link"]',
	'default'     => '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][/fw_loop_container][fw_loop_btn]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => __( 'CSS Product Loop', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description' => 'Classes: .fw_product_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_prod_custom_url',
	'label'       => __( 'Custom Url Field', 'fastway' ),
    'description' => '*hansgbr',
	'section'     => 'section_woo_loop',
	'default'     => '',
));


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_cl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_cat',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_cat_code',
	'label'       => __( ' Category Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'description'     => '[fw_cat_container][fw_cat_image][fw_cat_title][fw_cat_desc][/fw_cat_container]',
	'default'     => '[fw_cat_container][fw_cat_image]<div class="contenedor">[fw_cat_title][fw_cat_desc]</div>[/fw_cat_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_cat',
	'label'       => __( 'CSS Category Loop', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'description' => 'Classes: .fw_cat_loop',
	'default'     => '
	.fw_cat_loop .title {
		text-align: center;
		font-size: 22px!important;
		text-transform: uppercase;
		background-color: #F5F5F5;
		border-top: 3px solid var(--main);
		padding: 10px;
	}',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_bl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_blog',
	'default'     => '',
));
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_blog_code',
	'label'       => __( ' Blog Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_blog',
	'description'     => '[fw_blog_container][fw_blog_image][fw_blog_title][fw_blog_desc][fw_blog_logo][fw_blog_url][fw_blog_button][/fw_blog_container]',
	'default'     => '[fw_blog_container][fw_blog_image][fw_blog_title][fw_blog_desc][fw_blog_button][/fw_blog_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_blog',
	'label'       => __( 'CSS Blog Loop', 'fastway' ),
	'section'     => 'section_woo_loop_blog',
	'description' => 'Classes: .fw_post_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_rl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_review',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_review_code',
	'label'       => __( ' Review Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_review',
	'description'     => '[fw_review_container][fw_review_image][fw_review_title]
	[fw_review_desc]
	[fw_review_logo]
	[fw_review_url]
	[fw_review_position]
	[fw_review_company][/fw_review_container]',
	'default'     => '[fw_review_container][fw_review_image][fw_review_title][fw_review_desc][/fw_review_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_review',
	'label'       => __( 'CSS Review Loop', 'fastway' ),
	'section'     => 'section_woo_loop_review',
	'description' => 'Classes: .fw_review_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_ev_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_event',
	'default'     => '',
));


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_event_code',
	'label'       => __( ' Event Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_event',
	'description'     => '[fw_event_container][fw_event_image][fw_event_title][fw_event_date][fw_event_desc][fw_event_url][/fw_event_container]',
	'default'     => '[fw_event_container][fw_event_image][fw_event_title][fw_event_date][fw_event_desc][fw_event_url][/fw_event_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_event_review',
	'label'       => __( 'CSS Event Loop', 'fastway' ),
	'section'     => 'section_woo_loop_event',
	'description' => 'Classes: .fw_event_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_brl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_brand',
	'default'     => '',
));
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_brand_code',
	'label'       => __( ' Brand Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description'     => '[fw_brand_container][fw_brand_image][fw_brand_title][fw_brand_desc][/fw_brand_container]',
	'default'     => '[fw_brand_container][fw_brand_image][fw_brand_title][/fw_brand_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_brand',
	'label'       => __( 'CSS Brand Loop', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description' => 'Classes: .fw_brand_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*Company DATA*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'my_setting',
	'label'       => __( 'INFO', 'textdomain' ),
	'section'     => 'section_data',
	'default'     => '<div style="padding: 10px;background-color: #fff; color:black; border: 1px solid #1E73BE;">
	<h4>Company Data</h4>
	Company Data is a useful framework for storing all contact data about the business or client inside this fields. So it centralizes the data and makes it more restistant to errors in the future and also allows to modify easily accross all site.
	<h4>LABEL & VALUE</h4>
	You can specify a different value for the data when clicked.   <br>LABEL (VALUE) <br>Eg:1154999795(+5491154999795) ->  Result: <a href="+5491154999795">1154999795</a> 
	<h4>MULTIPLE VALUES</h4>
	We can specify multiple values for a variable using  "|" and then is access it throught its index. <br>
	Eg. Address 1 (gmaps url) | Address 2 (gpams url)<br>
	Then the shortcode type (address) is appended to the index. Eg: address1 </div>',
	'priority'    => 10,
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyname',
	'label'    => __( 'Company Name', 'fastway' ),
    'description'     => __( '[fw_data type="name"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyphone',
	'label'    => __( 'Company Phone', 'fastway' ),
    'description'     => __( '[fw_data type="phone"]<br>*tel: auto-populates ', 'fastway' ),            
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyaddress',
	'label'    => __( 'Company Address', 'fastway' ),
    'description'     => __( '[fw_data type="address"] ', 'fastway' ),
	'section'     => 'section_data',
) );

/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companygooglemaps',
	'label'    => __( 'Google Maps Url', 'fastway' ),
    'description'     => __( '[fw_companygooglemaps] ', 'fastway' ),
	'section'     => 'section_data',
) );
*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyemail',
	'label'    => __( 'Company Email', 'fastway' ),
    'description'     => __( '[fw_data type="email"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyfb',
	'label'    => __( 'Company Facebook', 'fastway' ),
    'description'     => __( '[fw_data type="fb"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Facebook (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyig',
	'label'    => __( 'Company Instagram', 'fastway' ),
    'description'     => __( '[fw_data type="ig"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Instagram (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companygoogle',
	'label'    => __( 'Company Google Page', 'fastway' ),
    'description'     => __( '[fw_data type="google"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Google (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companytripadvisor',
	'label'    => __( 'Company Tripadvisor', 'fastway' ),
    'description'     => __( '[fw_data type="tripadvisor"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Tripadvisor (#)'
) );
//Ohojo el. nombre
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companylinkedin',
	'label'    => __( 'Company Linkedin', 'fastway' ),
    'description'     => __( '[fw_data type="linkedin"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Linkedin (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyyoutube',
	'label'    => __( 'Company Youtube', 'fastway' ),
   	'description'     => __( '[fw_data type="youtube"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Youtube (#)'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companytwitter',
	'label'    => __( 'Company Twitter Url', 'fastway' ),
   	'description'     => __( '[fw_data type="twitter"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Twitter (#)'
) );
/*Extras*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'maintainance-mode',
	'description'     => __( 'Puts the website into maintaince mode and show the code below', 'fastway' ),
	'label'       => __( 'Maintainance Mode', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'maintainance_code',
	'label'       => __( 'Under Maintainance/Construction Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div class="maintainance_code">[fw_logo]<h1 style="font-size:30px;">'.__('Site under maintenance','fastway').'</h1><div><p>'.__('Sorry for the trouble, will be back soon!','fastway').'</p></div></div><br><br><div class="" style="font-size:10px !important;">'.__('This site is maintained by','fastway').':<br><br>  <a href="'.fw_theme_mod('fw_dev_url').'" target="_blank" rel="noopener"><img class="logofirma"  height="30" src="'.fw_theme_mod('fw_dev_logo').'"/></a></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'fw_max_media_upload',
	'label'    => __( 'Max Media Size Upload (500KB)', 'fastway' ),       
	'section'     => 'section_general',
	'default'	=>	500,
	'description'=>'Maximum upload file size for customers.'
) );

//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'darklogo_sticky',
	'label'       => __( 'Dark Logo on Sticky', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_popup_type',
	'label'       => __( 'Popup', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 'off',
	'description' => '<a href="/?testmodal=yes" target="_blank">Test Modal</a>'.__('  link to test it how it shows. Default behaviour is to show once per day.','fastway'),
	'choices'     => array(
		'off' => __( 'Disable', 'fastway' ),
		'image' => __( 'Image', 'fastway' ),
		'html' => __( 'Html', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_popup_html',
	'label'       => __( 'HTML', 'fastway' ),
	'section'     => 'section_popup',
	'default'	=> __('<h1>
	Subscribe to our newsletter!
</h1>
<p class="subtitle">
	We will notify you of launches and discounts
</p>
','fastway'),
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_popup_img',
	'label'       => __( 'Popup Img', 'fastway' ),
	'section'     => 'section_popup',

) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_popup_link',
	'label'    => __( 'Link', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => __('Leave empty if there is no link','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_popup_form_mode',
	'label'       => __( 'Form', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_pupup_form_id',
	'label'    => __( 'Form ID', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => __('Gravity Forms ID','fastway'),
	'default' => 5
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'popup-size',
	'label'       => __( 'Modal Size', 'fastway' ),
	'section'     => 'section_popup',
	'choices'     => array(
		'modal-sm'   => 'Small',
		'modal-md'   => 'Medium',
		'modal-lg'	 => 'Large',
	),
	'default'     => 'modal-md',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => '404_code',
	'label'       => __( '404 Page Code', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div class="container" id="content">
	<div class="content-detalle row" style="margin:0 auto;margin-top:40px;">
		<div class="col-3">
            <i class="fal fa-debug" style="color:var(--main);font-size:200px;"></i>
		</div>
		<div class="col-9">
			<h1 class="txt-24 t2 tit-pagina" style="font-weight: 400;">'.__('Sorry, we didn\'t find what you are looking for. ','fastway').'</h1>
			<br>
			<b>'.__('Lets improve your aim','fastway').'</b>
			<ul class="t1 txt-16">
				<li>'.__('Check the spelling for gramatical errors','fastway').'</li>
				<li>'.__('Use shorter and simpler words','fastway').'</li>
				<li>'.__('Use the menu and the navigation to help you','fastway').'</li>
			</ul>
		</div>
	</div>
		<div class="woo" style="margin-top:40px;">
[fw_recent_products title="'.__('This weeks trending products','fastway').'" prodsperrow="'.fw_theme_mod('related_columns').'"]</div>
</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


/*SCRIPTS*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_site_verification',
	'label'    => __( 'Google Site Verif. ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_fb_verification',
	'label'    => __( 'FB Site Verif. ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'analytics-id',
	'label'    => __( 'Analyitics ID', 'fastway' ),       
	'description' => 'Include letters. Ej AW-1020651316',
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'mixpanel-id',
	'label'    => __( 'Mixpanel ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fbpixel_id',
	'label'    => __( 'Facebook Pixel ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagmanager_id',
	'label'    => __( 'Google Tag Manager (Global)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagcheckout_id',
	'label'    => __( ' Tag Manager Conversion ID (Checkout)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>__('Refresh cache after saving!','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'opt-ace-editor-js',
	'label'       => __( 'JS Code', 'fastway' ),
	'description'       => __( 'Paste your JS code here.', 'fastway' ),
	'section'     => 'section_scripts',
	'default'  => 'jQuery(document).ready(function(){
		
	});',
	'choices'     => array(
		'language' => 'js',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'thankyou_insert',
	'label'    => __( 'Thank You Page Scripts', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' => __( 'Allows you to insert scripts for marketing in the thank you page.','fastway'),
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_header_scripts',
	'label'    => __( 'Insert Scripts Header', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' => 'With the script tags',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_footer_scripts',
	'label'    => __( 'Insert Scripts Footer', 'fastway' ),       
	'section'     => 'section_scripts',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_product_discount',
	'label'       => __( 'Descuento Tienda', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => 'Se aplica a todos los productos',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_percentage',
	'label'    => __( '%', 'fastway' ),
	'description' => 'Porcentage de descuento a toda la tienda, se aplica a nivel producto, no aplica a los que ya tienen descuento',
	'section'     => 'section_woo_discount',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories',
	'label'       => __( 'Categories', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ext',
	'label'       => __( 'Categories Exclude', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ids_exc',
	'label'       => __( 'Exclude Products', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'El id se obtiene editando el producto, desde la URL, donde dice post=XXXX. IDs separados con ","'
) );

/*LILI1*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount',
	'label'       => __( '1-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo',
	
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );




/*LILI_2*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_2',
	'label'       => __( '2-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label_2',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo 2',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories_2',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant_2',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones_2',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage_2',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );


/*LILI_3*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_3',
	'label'       => __( '3-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label_3',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo 3'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories_3',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant_3',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones_3',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage_3',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );











Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-logged_in',
	'label'       => __( 'CSS Logged In', 'fastway' ),
	'description'     => __( 'CSS Showed only for logged in users', 'fastway' ),
	'section'     => 'section_csscond',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-admin',
	'label'       => __( 'CSS Admin', 'fastway' ),
	'description'     => __( 'CSS Showed only for Wordpress Backend', 'fastway' ),
	'section'     => 'section_csscond',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );




/*LABELS*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_seleccionar_opcion',
	'label'    	=> __( 'Select variation', 'fastway' ),
	'description'    => 'Alert that shows in product page if no variation is selected',
	'section'     => 'section_labels_products',
	'default'    => __( 'Select variation', 'fastway' )
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'in-stock-text',
	'label'    => __( 'In Stock', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'    => __( 'In Stock', 'fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_off_text',
	'label'    => __( 'OFF Discount', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'    => __( 'OFF', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_backorder_text',
	'label'    => __( 'Reserve product', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'    => __( 'Reserve', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'out-of-stock-text',
	'label'    => __( 'Out of Stock', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Out of stock', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_qty_selector_label',
	'label'    => __( 'Select Quantity', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Select Quantity', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-link-text',
	'label'    => __( 'See details', 'fastway' ).'(Loop)',
	'section'     => 'section_labels_products',
	'default'	=>__( 'See details', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-text',
	'label'    => __( 'Add to cart', 'fastway' ).'(Loop)',
	'section'     => 'section_labels_products',
	'default'	=>__( 'Add to cart', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_vaciar_carrito',
	'label'    => __( 'Empty cart', 'fastway' ),
	'section'     => 'section_labels_cart',
	'default'	=>__( 'Empty cart', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'proceed-to-checkout-text',
	'label'    => __( 'Buy Button', 'fastway' ),
	'section'     => 'section_labels_cart',
	'default'    => __( 'Buy', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_crosssell_text',
	'label'    => __( 'Suggestions for you', 'fastway' ),
	'description' => 'Esto va en la pagina de single products',
	'section'     => 'section_labels_cart',
	'default'	=>__( 'Suggestions for you', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_free_label',
	'label'    => __( 'Free Shipping', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> __('Free Shipping', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_no_cost',
	'label'    => __( 'Free of charge', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> __('Free', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_client_cost',
	'label'    => __( 'On behalf of customer', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> __('On behalf of customer', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_address_2_label',
	'label'    => __( 'Extra address', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'    => __( 'Extra address field', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_envio',
	'label'    => __( 'Shipping', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'    => __( 'Shipping', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_shipping_grouptitle',
	'label'    => __( 'Pickup in our stores', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'    => __( 'Pickup in our stores', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_shipping_groupdesc',
	'label'    => __( 'See variations', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'    => __( 'See variations', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_costos_envio',
	'label'    => __( 'Shipping costs', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'    => __( 'Shipping costs', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_medios_envio',
	'label'    => __( 'Shipping Methods', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'    => __( 'Shipping Methods', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_place_order_text',
	'label'    => __( 'Complete purchase', 'fastway' ),
	'section'     => 'section_labels_cart',
	'default'	=> __( 'Complete purchase', 'fastway' ),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_ir_carrito',
	'label'    => __( 'Go to cart', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'    => __( 'Go to cart', 'fastway' ),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_mi_pedido',
	'label'    => __( 'My order', 'fastway' ),
	'section'     => 'section_labels',
	'default'    => __( 'My order', 'fastway' )
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuit_label',
	'label'       => 'DNI/CUIT',
	'section'     => 'section_labels_checkout',
	'default'     => __('CDI/VAT','fastway'),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_text',
	'label'    => __( 'Login Text', 'fastway' ),
	/*'description' => '"username" para que tome el username si inicio',*/
	'section'     => 'section_labels_account',
	'default'    => __( 'Logg in', 'fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_myaccount',
	'label'    => __( 'My Account', 'fastway' ),
	'section'     => 'section_labels_account',
	'default'    => __( 'My Account', 'fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_bienvenido',
	'label'    => __( 'Welcome to', 'fastway' ),
	'section'     => 'section_labels_account',
	'default'    => __( 'Welcome to', 'fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_ver_productos',
	'label'    => __( 'See products', 'fastway' ),
	'section'     => 'section_labels_account',
	'default'    => __( 'See products', 'fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_cuotas_mp',
	'label'    => __( 'Max installments', 'fastway' ),
	'section'     => 'section_labels_single_products',
	'default'	=> 'Pagá en hasta [fw_cuotas] cuotas sin interés'
	) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_related_text',
	'label'    => __( 'Related Products', 'fastway' ),
	'section'     => 'section_labels_single_products',
	'default'	=>__( 'People who searched fo this producto also search', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_descriptiontab_text',
	'label'    => __( 'Description Tab', 'fastway' ),
	'section'     => 'section_labels_single_products',
	'default'	=> __( 'Description','fastway' )
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_envios',
	'label'    => __( '¡Calcular envío', 'fastway' ),
	'section'     => 'section_labels_single_products',
	'default'	=> '¡Calcular envío!',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_ccuotas',
	'label'    => __( '¡Calcular cuotas', 'fastway' ),
	'section'     => 'section_labels_single_products',
	'default'	=> '¡Calcular cuotas!',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_search',
	'label'    => __( 'Search Placeholder', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>__( 'What are you looking for', 'fastway' ),	
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_sale',
	'label'    => __( 'Sale Message', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>__( 'Sale!', 'fastway' ),		
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_consultar_price',
	'label'    => __( 'Contact us', 'fastway' ),	 
	'section'     => 'section_labels',
	'default' 		=>	__( 'Contact us', 'fastway' ),		
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_cuotas',
	'label'    => __( 'Installment calculator', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>	__( 'Installment calculator', 'fastway' ),	
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_costo_envio',
	'label'    => __( 'Calculate shipping', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>	__('Calculate shipping', 'fastway' ),	
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_debajo_checkout_message',
	'label'    => __( 'Message', 'fastway' ),       
	'description'    => __( 'Below Complete Purchase Button ', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default' 		=>	'',
) );

/*EMAILS*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_processing_order',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default' 		=>__('Processing Order','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_processing_order',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default'	=> __('Hello {{customer_name}},

Thank you for your order!

Your purchase has been submitted with order number: {{order_number}}

Your order details are shown below for your reference,

{{order_details}}

{{order_meta}}

{{customer_details}}

Thank you for choosing us.
	','fastway'),
'choices'     => array('language' => 'html',),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_completed_order',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default' 		=>__('Your order was completed!','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_completed_order',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default'	=> __('Dear {{customer_name}},

Good news! We are happy to inform you that your order has been shipped.

Your order details are shown below for your reference,

{{order_details}}

{{order_meta}}

{{customer_details}}

We hope to see you again soon!

Thank you for choosing us.
	','fastway'),
'choices'     => array('language' => 'html',),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_on_hold_order',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default' 		=>__('Order on-hold','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_on_hold_order',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_orders',
	'default'	=>__('Hello {{customer_name}},

Once your order & payment has been verified, your order will be completed.

Below are the details of your purchase,

{{order_details}}

{{order_meta}}

We will be in touch with you as soon as we start processing the order.

Best Regards,
','fastway'),
'choices'     => array('language' => 'html',),
) );


/*AUTH*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_new_account',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default' 	  => __('Welcome to {{blogname}}','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_new_account',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default'	=> __('Hello {{user_name}}

You now have access to your online account to check order status, track a delivery, view order details, and more by clicking: {{myaccount}}

Thank you for signing up at our site {{user_name}}

The password you are using is auto-generated for your account, Check here to change it {{user_pass}}

Glad to have you on board!
Best Regards,','fastway'),
'choices'     => array('language' => 'html',),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_new_password',
	'label'    => __('New Password','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default' 	  => __("Password Reset",'fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_new_password',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default'	=> __('Someone has requested a new password for you:

Username: prueba

If this is an error, please ignore this message.

To set up your password please visit the following  <a href="{{new_pass_link}}">LINK</a>

Glad to have you on board!
Best Regards,','fastway'),
'choices'     => array('language' => 'html',),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_customer_reset_password',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default' 	  => __('Reset your password','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_customer_reset_password',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default'	=> __('Hello {{user_name}},

We received a request to reset your password.

To complete your password reset, click the following link within the next 30 minutes: {{reset_link}}

<small>*If you did not request a password reset, please ignore this email.</small>','fastway'),
'choices'     => array('language' => 'html',),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_gf_activated',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default' 	  => __('You have been approved','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_gf_activated',
	'label'    => __('Body','fastway'),      
	'section'     => 'section_email_templates_auth',
	'default'	=> __('Your account is almost ready,

To activate your account, please click the following link:
{{activation_url}}

After you activate, you will receive *another email* with your login.
Once your order has been verified, your order will be completed.
Below are the details of your purchase,
We will be in touch with you as soon as we start processing the order.

Best Regards,','fastway'),
'choices'     => array('language' => 'html',),
) );

/*WHOLESALE*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_confirmation_wholesale_form',
	'label'    => __('Form Confirmation Page','fastway'),      
	'section'     => 'section_email_templates_other',
	'default'	=> __('

<p style="text-align: center;">Thank you for registering.<br>
Your Account is under review. Please check back into your email for updates</p>

','fastway'),
'choices'     => array('language' => 'html',),
) );



/*OTHER*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_gf_pending',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_other',
	'default' 	  => __('Pending User','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_gf_pending',
	'label'    => __('Activation','fastway'),      
	'section'     => 'section_email_templates_other',
	'default'	=> __('Hello!

Welcome {{blogname}}

We have received your request for the registration on our website!

Our team is reviewing your information and will approve your submission shortly!

Thank you for signing up at our site

Glad to have you on board!

Best Regards,

','fastway'),
'choices'     => array('language' => 'html',),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_subject_admin_new_order',
	'label'    => __('Subject','fastway'),      
	'section'     => 'section_email_templates_other',
	'default' 	  => __('New Order {{order_number}}','fastway')
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_email_content_admin_new_order',
	'label'    => __( 'New order', 'woocommerce' ),
	'section'     => 'section_email_templates_other',
	'default'	=> __('

You received an order from : {{customer_name}}

Below are the details of the purchase,

{{order_details}}

{{order_meta}}

{{customer_details}}','fastway'),
'choices'     => array('language' => 'html',),
) );







if(isAltoweb() && fw_theme_mod('fw_trans_comprobantes') && fw_theme_mod('fw_trans_comprobantes_id')){


	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_email_subject_customer_despachado_order',
		'label'    => __('Subject','fastway'),      
		'section'     => 'section_email_templates_other',
		'default' 	  => __('Pedido Despachado','fastway')
	) );
	
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'code',
		'settings'    => 'fw_email_content_customer_despachado_order',
		'label'    => __( 'New order', 'woocommerce' ),
		'section'     => 'section_email_templates_other',
		'default'	=> __('Hola {{customer_name}},

solo para que estés informado, tu pedido {{order_number}} fue despachado
al transporte tal cual como lo solicitaste.','fastway'),
	'choices'     => array('language' => 'html',),
	) );
	
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_email_subject_customer_await_verif_order',
		'label'    => __('Subject','fastway'),      
		'section'     => 'section_email_templates_other',
		'default' 	  => __('Recibimos tu comprobante','fastway')
	) );
	
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'code',
		'settings'    => 'fw_email_content_customer_await_verif_order',
		'label'    => __( 'New order', 'woocommerce' ),
		'section'     => 'section_email_templates_other',
		'default'	=> __('Hola {{customer_name}},
  
Solo para que estés informado — hemos recibido tu comprobante para la orden {{order_number}}

Estaremos verificandolo y te notificaremos cuando este aprobado.

Gracias por tu compra.','fastway'),
	'choices'     => array('language' => 'html',),
	) );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'text',
		'settings'    => 'fw_email_subject_customer_preparacion_order',
		'label'    => __('Subject','fastway'),      
		'section'     => 'section_email_templates_other',
		'default' 	  => __('Pedido en preparación','fastway')
	) );
	
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'code',
		'settings'    => 'fw_email_content_customer_preparacion_order',
		'label'    => __( 'New order', 'woocommerce' ),
		'section'     => 'section_email_templates_other',
		'default'	=> __('Hola {{customer_name}},
  
Solo para que estés informado — tu pedido ya se empezó a preparar

Gracias por tu compra.','fastway'),
	'choices'     => array('language' => 'html',),
	) );
}



add_shortcode('fwcf', 'fwcf');
function fwcf($atts = [], $content = null){
	/*trae a modo shortcode cualquier variable de fw*/
	$atts = shortcode_atts(array('field' => '' ), $atts );
	$custom=fw_theme_mod($atts['field']);
	return $custom;
}

function my_customizer_styles() { ?>
	<style>
	.customize-control-kirki-multicheck ul {
		display:flex;
		flex-wrap: wrap;
	}

	.customize-control-kirki-multicheck ul li {
	  	width: 100%;
	}
	#customize-control-sticky-menu ul li{
		width:33.3%;
	}
	.customize-control-kirki-multicheck ul li label {
		  background: rgba(0, 0, 0, 0.1);
		  border: 1px rgba(0, 0, 0, 0.1);
		  color: #555d66;
		  margin: 0;
		  text-align: center;
		  padding: 0.5em 1em;
		  display: block;
	}

	.customize-control-kirki-multicheck ul li label.checked {
	  	background-color: #00a0d2;
	  	color: rgba(255, 255, 255, 0.8);
	}

	.customize-control-kirki-multicheck ul li input {
	  display: none;
	}
	.CodeMirror {
	  border: 1px solid #eee;
	  height: 400px !important;
	}
	.CodeMirror-gutters, .CodeMirror-gutter-wrapper{
		display:none !important;
	}
	.CodeMirror-sizer{
		margin:0px !important;
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'my_customizer_styles', 999 );




?>