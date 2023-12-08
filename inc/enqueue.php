<?php

if ( ! function_exists( 'fw_scripts' ) ) {
	function fw_scripts() {
		$version=wp_get_theme("fastway")->get( 'Version' ) ;
		wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css');

		wp_enqueue_script('jquery');
		wp_enqueue_script( 'jquery-migrate', get_template_directory_uri() . '/assets/js/jquery.migrate.js', array(),'',true );
		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/assets/js/fastway.min.js', array ( 'jquery' ),$version , true);
		wp_enqueue_script( 'bootstrap-scripts', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(),'',true );
		wp_enqueue_script( 'swiper-script', get_template_directory_uri() . '/assets/js/swiper.min.js'  );
		wp_enqueue_style( 'swiper-styles', get_template_directory_uri() . '/assets/css/swiper.min.css');
		wp_enqueue_script( 'jqcookie-script', get_template_directory_uri() . '/assets/js/jquery.cookie.js'  );
			
		if(is_plugin_active("woocommerce/woocommerce.php")){
			if(is_product()){
				wp_enqueue_style( 'fancybox-styles', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css');
				wp_enqueue_script( 'fancy-script', get_template_directory_uri() . '/assets/js/fancybox.min.js');	
			}
		}
		wp_localize_script( 'theme-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ),1 );	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}



		//Fastway main css file, using SASS
		wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/assets/css/theme.min.css', false,$version);
		wp_enqueue_style( 'playground-styles', get_template_directory_uri() . '/assets/css/builder.css', false,$version);
		wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css');
   
	}
} 
add_action( 'wp_enqueue_scripts', 'fw_scripts' );


function admincustojs(){
	wp_enqueue_script( 'custo-scripts', get_template_directory_uri() . '/assets/js/fw-customizer.js', array(), true );

}
add_action( 'customize_preview_init', 'admincustojs' );
