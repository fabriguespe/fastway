<?php

if( !class_exists( 'fw_StaticBlock' ) ) {

	class fw_StaticBlock{

		private $labels = array();
		private static $post_type = 'fw_stblock';
		private $customCss;

		public function __construct(){
			$this->setLabel();
			add_action('init', array($this,'register_postType') );
			add_filter( 'manage_nth_stblock_posts_columns', array( $this, 'tableHeader' ) );
			add_action( 'manage_nth_stblock_posts_custom_column', array( $this,'tableContent' ), 10, 2 );
		}

		public function setLabel(){
			$this->labels = array(
				'name'               => _x( 'Static blocks', 'post type general name', 'fastway' ),
				'singular_name'      => _x( 'Block', 'post type singular name', 'fastway' ),
				'menu_name'          => _x( 'Static Blocks', 'admin menu', 'fastway' ),
				'name_admin_bar'     => _x( 'Block', 'add new on admin bar', 'fastway' ),
				'add_new'            => _x( 'Add New', 'static block', 'fastway' ),
				'add_new_item'       => __( 'Add New Static Blocks', 'fastway' ),
				'new_item'           => __( 'New Block', 'fastway' ),
				'edit_item'          => __( 'Edit Block', 'fastway' ),
				'view_item'          => __( 'View Block', 'fastway' ),
				'all_items'          => __( 'Static Blocks', 'fastway' ),
				'search_items'       => __( 'Search Static Blocks', 'fastway' ),
				'parent_item_colon'  => __( 'Parent Static Blocks:', 'fastway' ),
				'not_found'          => __( 'No Static blocks found.', 'fastway' ),
				'not_found_in_trash' => __( 'No Static blocks found in Trash.', 'fastway' )
			);
		}

		public function register_postType(){
			$args = array(
				'labels' => $this->labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => self::$post_type ),
				'capability_type' => 'post',
				'has_archive' => 'staticblocks',
				'hierarchical' => false,
				'menu_icon'			 => "dashicons-editor-quote",
				'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
			);
			register_post_type( self::$post_type, $args );
		}

		public static function getStaticBlocks( $cats = array('all') ){
			$res_args = array();
			$args = array(
				'post_type' => self::$post_type,
				'posts_per_page' => 50,
				'orderby'	=> 'title',
				'order'		=> 'ASC',
				/*'meta_query' => array(
					array(
						'key'	=> 'fw_nth_stblock_options',
						'value'	=> $cats,
						'compare' => "IN"
					),
				),*/
			);

			$blocks = get_posts( $args );
			if( $blocks ) {
				$data = array(
					'title'		=> __('--Select--'),
					'id'		=> '',
					'slug'		=> ''
				);
				array_push($res_args, $data);
				foreach( $blocks as $block ){
					$data = array(
						'title'		=> get_the_title($block->ID),
						'id'		=> $block->ID,
						'slug'		=> $block->post_name
					);
					array_push($res_args, $data);
				}
			}
			return $res_args;
		}

		public static function getImage( $id = false, $size = 'full' ){
			if(!$id) return;
			if( has_post_thumbnail( $id ) ) {
				echo get_the_post_thumbnail( $id, $size );
			}
		}

		public static function getSticBlockContent( $id = false, $return = false ){
			if(!$id) return;
			$output = false;
			$output = wp_cache_get( $id, 'nth_get_staticBlock' );

			if( !$output ) {
				if(is_numeric($id))
					$blocks = get_posts( array( 'include' => $id,'post_type' => 'fw_stblock', 'posts_per_page' => 1) );
				else $blocks = get_posts( array( 'name' => $id,'post_type' => 'fw_stblock', 'posts_per_page' => 1) );
				$output = '';
				$customCss = '';
				ob_start();
				foreach( $blocks as $post ) {
					setup_postdata($post);

					$shortcodes_custom_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_custom_css ) ) {
						echo '<style type="text/css" scoped data-type="vc_staticblock-custom-css-'.$post->ID.'">';
						echo $shortcodes_custom_css;
						echo '</style>';
					}

					echo do_shortcode( $post->post_content );

				}

				$output = ob_get_clean();
				wp_reset_postdata();
				wp_cache_add( $id, $output, 'nth_get_staticBlock' );
			}

			if( $return ) return $output; else echo $output;

		}

		public function tableHeader( $cols ){
			unset( $cols['date'] );
			$cols['position'] = __('Position', 'fastway');
			$cols['date'] = __('Date', 'fastway');
			return $cols;
		}

		public function tableContent( $column_name, $post_id ){
			if( strcmp( trim( $column_name ), 'position' ) == 0 ) {
				$data = get_post_meta($post_id, 'fw_nth_stblock_options',true);
				if( isset( $data ) && strlen( $data ) > 0 ) {
					switch( $data ) {
						case 'menu':
							$text = __( 'Mega menu', 'fastway' );
							break;
						case 'widget':
							$text = __( 'Widget', 'fastway' );
							break;
						default:
							$text = __( "Standard", 'fastway' );
					}
					printf( '<span class="nth-label %1$s">%2$s</span>', esc_attr($data), $text );
				}
			}
		}

	}

	new fw_StaticBlock();
}