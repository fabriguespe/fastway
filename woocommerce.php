<?php
/**
 * The template for displaying all woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = fw_theme_mod('container-shop');
//$container="container";
$datas = array(
	'show_bcrumb'	=> 1,
	'is_shop'		=> 1
); 
$clase="";
if(is_shop() || is_tax())$clase="woocommerce-shop";
?>

<div class="wrapper <?=$clase?>" id="woocommerce-wrapper">
	<?php if(is_product())do_action( 'fw_breadcrumb', $datas );?>
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<?php if(is_shop() && fw_theme_mod('fw_shop_stblock_header')){
			echo '<div class="row"><div class="container">';
			fw_StaticBlock::getSticBlockContent( fw_theme_mod('fw_shop_stblock_header') );
			echo '</div></div>';
		}?>
		<div class="row">
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>
			<main class="site-main" id="main">
			<?php 
				$template_name = '/archive-product.php'; 
				$args = array(); 
				$template_path = ''; 
				$default_path = untrailingslashit( plugin_dir_path(__FILE__) ) . '/woocommerce';
				if ( is_singular( 'product' ) )woocommerce_content();
				//For ANY product archive, Product taxonomy, product search or /shop landing page etc Fetch the template override;
				else if ( file_exists( $default_path . $template_name ) ){
					wc_get_template( $template_name, $args, $template_path, $default_path );
					//If no archive-product.php template exists, default to catchall;
				}else woocommerce_content( );
			;?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

	</div><!-- .row -->
	<!-- .footer block -->
	<?php do_action( 'fastway_singleblock_init' ); ?>

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
