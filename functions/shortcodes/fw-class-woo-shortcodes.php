<?php 
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'fw_Woo_Shortcodes' ) ) :

class fw_Woo_Shortcodes {

	private static $classes = array('nth-shortcode', 'woocommerce');
	
	public static function get_template( $template_name, $args = array(), $products = null ){
		
		
		if ( $args && is_array( $args ) ) {
			extract( $args );
		}
		
		$located = get_template_directory() . '/functions/shortcodes/'.$template_name;
		
		if ( ! file_exists( $located ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );
			return;
		}
		
		include( $located );
	}
	
	
	public static function shortcodeArgs(){
		
		return array(
			'fw_featured_products'				=> __CLASS__ . '::featured_products',
			'fw_sale_products'				=> __CLASS__ . '::sale_products',
			'fw_bestselling_products'				=> __CLASS__ . '::best_selling_products',
			'fw_toprated_products'				=> __CLASS__ . '::top_rated_products',
			'fw_recent_products'				=> __CLASS__ . '::recent_products',
			'fw_category_carousel'				=> __CLASS__ . '::vc_products_by_cat_carousel',
			'fw_categories_carousel'			=> __CLASS__ . '::product_cats',
			'fw_brands_carousel'			=> __CLASS__ . '::product_brands_carousel',
			'vc_products_by_tags_carousel'			=> __CLASS__ . '::vc_products_by_tags_carousel',
			'vc_products_by_brand_carousel'			=> __CLASS__ . '::vc_products_by_brand_carousel',
		);
	}
	private static function pareShortcodeClass( $class = '' ){
		$classes = self::$classes;
		if( strlen($class) > 0 )
			$classes[] = $class;
		return $classes;
	}
	public static function blog_carousel( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> '0',
			"auto_play"		=> '0',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 		isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => isset($atts["hideoutofstock"])&& !empty($atts["hideoutofstock"])?'false':'true',
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
        $meta_query  = WC()->query->get_meta_query();
		$tax_query   = WC()->query->get_tax_query();
		
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'post_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}
		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
            'meta_query'          => $meta_query,
            'tax_query'           => $tax_query,
		);

		
		
		ob_start();

		$posts = new WP_Query('showposts='.fw_theme_mod('fw_blog_per_page'));

		if ( $posts->have_posts() ) :
			self::get_template( 'fw-woo-posts-carousel.php', $atts, $posts );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}
	public static function featured_products( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> '0',
			"auto_play"		=> '0',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => isset($atts["hideoutofstock"])&& !empty($atts["hideoutofstock"])?'false':'true',
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
        $meta_query  = WC()->query->get_meta_query();
        $tax_query   = WC()->query->get_tax_query();
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN'
		);
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}
		if($atts['hideoutofstock'])$args['meta_query'][] = array('key'     => '_stock_status','value'   => 'instock',);

		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
            'meta_query'          => $meta_query,
            'tax_query'           => $tax_query,
		);

		
		
		ob_start();
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) :
			self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
		else:
			return fw_Woo_Shortcodes::recent_products($atts);
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}
	public static function recent_products( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> '0',
			"auto_play"		=> '0',
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => 	isset($atts["hideoutofstock"])&& !empty($atts["hideoutofstock"])?'false':'true',
			
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
        $meta_query  = WC()->query->get_meta_query();
        $tax_query   = WC()->query->get_tax_query();
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}

		if($atts['hideoutofstock'])$args['meta_query'][] = array('key'     => '_stock_status','value'   => 'instock',);
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
            'meta_query'          => $meta_query,
            'tax_query'           => $tax_query,
		);

		
		
		ob_start();
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) 
			self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
		
		
		wp_reset_postdata();
		
		
		
		
		return ob_get_clean();
	}

	public static function sale_products( $atts ) {
		global $woocommerce_loop, $woocommerce;
		
		$atts = shortcode_atts(array(
			'title' 		=> '',
			'item_style'	=> 'grid',
			'is_slider'		=> '1',
			"is_biggest"	=> 0,
			'cats'			=> '',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'auto_play'		=> '0',
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => 	isset($atts["hideoutofstock"])&& !empty($atts["hideoutofstock"])?'false':'true',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			'orderby'		=> 'title',
			'is_deal'		=> 0,
			'supper_style'	=> 0,
			'order'			=> 'asc',
			'as_widget'		=> 0,
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			'excerpt_limit' => 10,
			'hide_free'		=> 0,
			'show_hidden'	=> 0
		),$atts);
		
		$args = array(
			'posts_per_page'	=> $atts['per_page'],
			'orderby' 			=> $atts['orderby'],
			'order' 			=> $atts['order'],
			'no_found_rows' 	=> 1,
			'post_status' 		=> 'publish',
			'post_type' 		=> 'product',
            'meta_query'        => WC()->query->get_meta_query(),
            'tax_query'         => WC()->query->get_tax_query(),
			'post__in'			=> array_merge( array( 0 ), wc_get_product_ids_on_sale() ),

		);
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}

		if($atts['hideoutofstock'])$args['meta_query'][] = array('key'     => '_stock_status','value'   => 'instock',);

		if( strlen(trim($atts['cats'])) > 0 ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['cats'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			);
		}
		
		if( absint($atts['as_widget']) ) {
			if ( !absint($atts['show_hidden']) ) {
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                );
                $query_args['post_parent']  = 0;
			}
			
			if ( absint( $atts['hide_free'] ) ) {
				$args['meta_query'][] = array(
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				);
			}
			
		} else {
			//$args['meta_query'] = WC()->query->get_meta_query();
			if( absint($atts['is_deal']) ) {
				$fil_date = strtotime ("now");
				$args['meta_query'] = array(
					array(
						'key' => '_sale_price_dates_from',
						'value' => $fil_date,
						'compare' => '<=',
						'type' => 'numeric'
					),
					array(
						'key' => '_sale_price_dates_to',
						'value' => $fil_date,
						'compare' => '>=',
						'type' => 'numeric'
					)
				);
			} else {
				$args['meta_query'] = WC()->query->get_meta_query();
			}

		}
		
		ob_start();
		
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}
	
	public static function vc_products_by_cat_carousel( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => 	isset($atts["outofstock"])&& !empty($atts["outofstock"])?'false':'true',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			'slider_delay' => 	isset($atts["slider_delay"])&& !empty($atts["slider_delay"])?$atts["slider_delay"]:4000,
			'slider_speed' => 	isset($atts["slider_delay"])&& !empty($atts["slider_speed"])?$atts["slider_speed"]:4,
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"category" 		=> '',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
		
		$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
		$meta_query    = WC()->query->get_meta_query();
	
		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
			'posts_per_page' 		=> $atts['per_page'],
			'meta_query' 			=> $meta_query,
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			)
		);
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}
		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}
		
		
		//Ocultar agotados
		if($atts['hideoutofstock'])$args['meta_query'][] = array('key'     => '_stock_status','value'   => 'instock',);
		
		
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) :
			self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	
	
	public static function product_cats( $atts ){
		$atts = shortcode_atts( array(
			'title'			=> '',
			'cats' 			=> '',
			'terms' 			=> '',
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'hideempty' => isset($atts["hideempty"])&& !empty($atts["hideempty"])?false:true,

			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'slider_delay' => 	isset($atts["slider_delay"])&& !empty($atts["slider_delay"])?$atts["slider_delay"]:4000,
			'slider_speed' => 	isset($atts["slider_delay"])&& !empty($atts["slider_speed"])?$atts["slider_speed"]:4,

			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
		), $atts );
		
		if( strlen( trim( $atts['cats'] ) ) == 0 ) return;
		
		$cats = explode( ',', $atts['cats'] );
	
		$args = array(
			'slug' => $cats,
			'orderby'	=> 'slug',
			'order'		=> 'ASC',
		);

		ob_start();
		$cates=array();
		foreach($cats as $cat){
			$term=get_term_by('slug' , $cat,'product_cat');
			if($atts["hideempty"] && $term->count==0)continue;
			array_push($cates,$term);
			//$atts['terms'][]=  $term;
		}
		$atts['terms']=$cates;
		if(!empty($atts['terms']))self::get_template( 'fw-woo-cats-carousel.php', $atts,$atts['terms']  );
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function product_brands_carousel( $atts ){
		$atts = shortcode_atts( array(
			'title'			=> '',
			'brands' 			=> '',
			'terms' 			=> '',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,

		), $atts );
		
		if( strlen( trim( $atts['brands'] ) ) == 0 ) return;
		
		$brands = explode( ',', $atts['brands'] );
	
		$args = array(
			'slug' => 	$brands,
			'orderby'	=> 'slug',
			'order'		=> 'ASC',
		);

		ob_start();
		$marcas=array();
		foreach($brands as $brand){
			$term=get_term_by('slug' , $brand,'brand');
			array_push($marcas,$term);
		}
		$atts['terms']=$marcas;
		if(!empty($atts['terms']))self::get_template( 'fw-woo-brands-carousel.php', $atts,$atts['terms']  );
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function vc_products_by_brand_carousel( $atts ){

		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => 	isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' 		=> 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			"per_page"		=> 	isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> 	isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"category" 		=> '',
			"brand" 		=> '',
			"hide_free"		=> 0,
			"slider"		=> 1,
			"show_hidden"	=> 0
		), $atts );


		$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
		$meta_query    = WC()->query->get_meta_query();

		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
			'posts_per_page' 		=> $atts['per_page'],
			'meta_query' 			=> $meta_query,
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'brand',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['brand'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				),
				
			)
		);
		
		if($atts["category"]){
			$args['tax_query'][] = array('relation'=> 'AND');
			$args['tax_query'][] = array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
				'field' 		=> 'slug',
				'operator' 		=> 'IN'
			);
		}
		
		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			if($atts['slider']){
			
				self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
			}else{
				echo ' <ul class = "products columns-'.$atts['columns'].'">';		
				while ( $products->have_posts() ) : 
					$products->the_post(); 
					wc_get_template_part( 'content','product' ); 
				endwhile; 
				echo '</ul>';
			}
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function vc_products_by_tags_carousel( $atts ){

		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"space"			=> isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,
			'autoplay' 		=> isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"category" 		=> '',
			"tag" 		=> '',
			"hide_free"		=> 0,
			"slider"		=> 1,
			"show_hidden"	=> 0
		), $atts );


		$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
		$meta_query    = WC()->query->get_meta_query();
		
		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
			'posts_per_page' 		=> $atts['per_page'],
			'meta_query' 			=> $meta_query,
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_tag',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['tag'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				),
				
			)
		);
		if($atts["category"]){
			$args['tax_query'][] = array('relation'=> 'AND');
			$args['tax_query'][] = array(
				'taxonomy' 		=> 'product_cat',
				'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
				'field' 		=> 'slug',
				'operator' 		=> 'IN'
			);
		}
		
		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			if($atts['slider']){
			
				self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
			}else{
				echo ' <ul class = "products columns-'.$atts['columns'].'">';		
				while ( $products->have_posts() ) : 
					$products->the_post(); 
					wc_get_template_part( 'content','product' ); 
				endwhile; 
				echo '</ul>';
			}
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}


	public static function woo_categories( $atts ){
		global $woocommerce_loop;
		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = 0;

		$args = array(
				'taxonomy'     => $taxonomy,
				'orderby'      => $orderby,
				'show_count'   => $show_count,
				'pad_counts'   => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li'     => $title,
				'hide_empty'   => $empty
		);
		$all_categories = get_categories( $args );
		foreach ($all_categories as $cat) {
			if($cat->category_parent == 0) {
				$category_id = $cat->term_id;     
				echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';

				$args2 = array(
						'taxonomy'     => $taxonomy,
						'child_of'     => 0,
						'parent'       => $category_id,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty
				);
				$sub_cats = get_categories( $args2 );
				if($sub_cats) {
					foreach($sub_cats as $sub_category) {
						echo  $sub_category->name ;
					}   
				}
			}       
		}
		
	}
	
	
	public static function best_selling_products( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts(array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"space"		=> 	isset($atts["space"])&& !empty($atts["space"])?$atts["space"]:10,
			'el_class' 		=> isset($atts["el_class"])?$atts["el_class"]:'',
			'el_id' 		=> isset($atts["el_id"])?$atts["el_id"]:'',
			'uncategorized' => isset($atts["uncategorized"])&& !empty($atts["uncategorized"])?false:true,

			'autoplay' => 	isset($atts["autoplay"])&& !empty($atts["autoplay"])?'false':'true',
			'loop' => 	isset($atts["loop"])&& !empty($atts["loop"])?'false':'true',
			'hideoutofstock' => 	isset($atts["hideoutofstock"])&& !empty($atts["hideoutofstock"])?'false':'true',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
		),$atts);
		
		$meta_query = WC()->query->get_meta_query();
		
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'meta_key'            => 'total_sales',
			'orderby'             => 'meta_value_num',
			'meta_query'          => $meta_query
		);
		if($atts["uncategorized"]){
			$tax_query[] = array('relation'=> 'AND');
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug', // Or 'name' or 'term_id'
				'terms'    => array('sin-categorizar','sin-categoria','uncategorized'),
				'operator' => 'NOT IN', // Excluded
			);
		}

		if($atts['hideoutofstock'])$args['meta_query'][] = array('key'     => '_stock_status','value'   => 'instock',);
		
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'fw-woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}


}

endif;