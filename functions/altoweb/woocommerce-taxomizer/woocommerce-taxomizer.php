<?php 

if(!empty(fw_theme_mod('fw_extra_tax')))include( plugin_dir_path( __FILE__ ) . 'categorizacion.php');

class WooTaxomizer {
	public $menu_id;

	// Plugin initialization
	public function __construct() {
		// Load up the localization file if we're using WordPress in a different language
		load_plugin_textdomain( 'woo-taxomizer' );

		add_action( 'admin_menu',                              array( $this, 'add_admin_menu' ) );
		add_action( 'admin_enqueue_scripts',                   array( $this, 'admin_enqueues' ) );
		add_action( 'wp_ajax_wootaxomizer',             array( $this, 'ajax_process_products' ) );
		// Allow people to change what capability is required to use this plugin
		$this->capability = apply_filters( 'regenerate_thumbs_cap', 'manage_options' );
	}


	// Register the management page
	public function add_admin_menu() {
		$this->menu_id = add_management_page( __( 'Woocommerce Taxomizer', 'woo-taxomizer' ), __( 'Taxomizer', 'woo-taxomizer' ), $this->capability, 'woo-taxomizer', array($this, 'regenerate_interface') );
	}


	// Enqueue the needed Javascript and CSS
	public function admin_enqueues( $hook_suffix ) {
		if ( $hook_suffix != $this->menu_id ) {
			return;
		}

	}


	/**
	 * Creates a nonced URL to the plugin's admin page for a given set of attachment IDs.
	 *
	 * @param array $ids An array of attachment IDs that should be regenerated.
	 *
	 * @return string The nonced URL to the admin page.
	 */
	public function create_page_url( $ids ) {
		$url_args = array(
			'page'     => 'woo-taxomizer',
			'goback'   => 1,
			'ids'      => implode( ',', $ids ),
			'_wpnonce' => wp_create_nonce( 'woo-taxomizer' ), // Can't use wp_nonce_url() as it escapes HTML entities
		);

		// https://core.trac.wordpress.org/ticket/17923
		$url_args = array_map( 'rawurlencode', $url_args );

		return add_query_arg( $url_args, admin_url( 'tools.php' ) );
	}

	// The user interface plus thumbnail regenerator
	public function regenerate_interface() {
		global $wpdb;

		?>

	<div id="message" class="updated fade" style="display:none"></div>

	<div class="wrap regenthumbs">
	<h2><?php _e('Woocommerce Taxomizer', 'woo-taxomizer'); ?> v3</h2>
	<?php
		// If the button was clicked
		if ( ! empty( $_POST['woo-taxomizer'] ) || ! empty( $_REQUEST['ids'] ) ) {
			// Capability check
			if ( ! current_user_can( $this->capability ) )
				wp_die( __( 'Cheatin&#8217; uh?' ) );

			// Form nonce check
			check_admin_referer( 'woo-taxomizer' );

			// Create the list of image IDs
			$count_posts = wp_count_posts( 'product' );
			$count=$count_posts->publish;	
			$ids=implode(",",range(0, $count));
			$text_goback = ( ! empty( $_GET['goback'] ) ) ? sprintf( __( 'To go back to the previous page, <a href="%s">click here</a>.', 'woo-taxomizer' ), 'javascript:history.go(-1)' ) : '';
			$text_failures = "listo!";
			$text_nofailures = sprintf( __( 'All done! %1$s image(s) were successfully resized in %2$s seconds and there were 0 failures. %3$s', 'woo-taxomizer' ), "' + rt_successes + '", "' + rt_totaltime + '", $text_goback );
	?>
	<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'woo-taxomizer' ) ?></em></p></noscript>

	<div id="regenthumbs-bar" style="position:relative;height:25px;">
		<div id="regenthumbs-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>
	</div>

	<p><input type="button" class="button hide-if-no-js" name="regenthumbs-stop" id="regenthumbs-stop" value="<?php _e( 'Abort Resizing Images', 'woo-taxomizer' ) ?>" /></p>

	<h3 class="title"><?php _e( 'Debugging Information', 'woo-taxomizer' ) ?></h3>

	<p>
		<?php printf( __( 'Total Products: %s', 'woo-taxomizer' ), $count ); ?> v2<br />
		
	</p>

	<ol id="regenthumbs-debuglist">
		<li style="display:none"></li>
	</ol>

	<script type="text/javascript">
		jQuery(document).ready(function($){
			var i;
			var rt_images = [<?php echo $ids; ?>];
			var rt_total = rt_images.length;
			var rt_count = 200;
			var rt_percent = 0;
			var rt_successes = 0;
			var rt_errors = 0;
			var rt_failedlist = '';
			var rt_resulttext = '';
			var rt_timestart = new Date().getTime();
			var rt_timeend = 0;
			var rt_totaltime = 0;
			var rt_continue = true;
			var rt_batch=rt_count;
			var cuenta=0;
			// Create the progress bar
			$("#regenthumbs-bar").progressbar();
			$("#regenthumbs-bar-percent").html( "0%" );

			// Stop button
			$("#regenthumbs-stop").click(function() {
				rt_continue = false;
				$('#regenthumbs-stop').val("<?php echo $this->esc_quotes( __( 'Stopping...', 'woo-taxomizer' ) ); ?>");
			});

			// Clear out the empty list element that's there for HTML validation purposes
			$("#regenthumbs-debuglist li").remove();

			

			// Called when all images have been processed. Shows the results and cleans up.
			function WooTaxFinishUp() {
				rt_timeend = new Date().getTime();
				rt_totaltime = Math.round( ( rt_timeend - rt_timestart ) / 1000 );

				$('#regenthumbs-stop').hide();

				if ( rt_errors > 0 ) {
					rt_resulttext = '<?php echo $text_failures; ?>';
				} else {
					rt_resulttext = '<?php echo $text_nofailures; ?>';
				}

				$("#message").html("<p><strong>" + rt_resulttext + "</strong></p>");
				$("#message").show();
			}

			// Regenerate a specified image via AJAX
			function WooTax( id,cuenta ) {
				//console.log(cuenta);
				//console.log(id);
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: { action: "wootaxomizer", id: id,cuenta:cuenta },
					success: function( response ) {
						//console.log(response);
						if(rt_count>rt_total)rt_count=rt_total;
						$("#regenthumbs-bar").progressbar( "value", ( rt_count / rt_total ) * 100 );
						$("#regenthumbs-bar-percent").html( Math.round( ( rt_count / rt_total ) * 1000 ) / 10 + "%" );
						rt_count = rt_count + rt_batch;
						rt_successes = rt_successes + rt_batch;
						cuenta=cuenta+1;
						$("#regenthumbs-debug-successcount").html(rt_successes);
						//$("#regenthumbs-debuglist").append("<li></li>");
						
						if ( rt_images.length && rt_continue ) {
							WooTax( JSON.stringify(rt_images.splice(0, rt_batch)),cuenta);
						}
						else {
							WooTaxFinishUp();
						}

					}
					
				});
			}

			WooTax( JSON.stringify(rt_images.splice(0, rt_batch)),cuenta);
		});
	</script>
	<?php
		}

		// No button click? Display the form.
		else {
	?>
	<form method="post" action="">
	<?php wp_nonce_field('woo-taxomizer') ?>

	
	<p><input type="submit" class="button hide-if-no-js" name="woo-taxomizer" id="woo-taxomizer" value="<?php _e( 'Taxomize All Products', 'woo-taxomizer' ) ?>" /></p>

	<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'woo-taxomizer' ) ?></em></p></noscript>

	</form>
	<div class="paginaopciones">
	<style type="text/css">
   	input[type="text"]{
      	width: 500px !important;
   	}
   	textarea {
  		width: 100%;
  		height: 150px;
	}
	tr{
		text-align:left;
	}
	</style>
	<form method="post" action="options.php">
	<?php settings_fields( 'taxomizer_options_group' ); ?>
	<table>
	<tr valign="top">
	<th scope="row"><label for="fw_extra_tax">Custom Tax</label></th>
	<td>
	<input type="text" id="fw_extra_tax" name="fw_extra_tax"  value="<?php echo fw_theme_mod('fw_extra_tax'); ?>" placeholder="Marca, Color... etc (todo singular)" />
	</td>
	</tr>
	</table>

<?php 
$varss="product_cat,brand,".fw_theme_mod('fw_extra_tax');
foreach (explode(",",$varss) as $nombre ) {
$titulo=$nombre;
$nombre=strtolower($nombre);
if(empty($nombre))break;
?>
<h2><?=($titulo);?> </h2>
<tr valign="top">
<th scope="row"><label for="<?='taxomizer_'.($nombre);?>_cf">Custom Field</label></th>
<td>
<input type="text" id="<?='taxomizer_'.($nombre);?>_cf" name="<?='taxomizer_'.($nombre);?>_cf" value="<?php echo get_option('taxomizer_'.($nombre).'_cf')?>"/>
</td>
</tr>
</table>
<table width="90%">
<tr valign="top" >
<td>
<textarea id="<?='taxomizer_'.($nombre);?>_vars" name="<?='taxomizer_'.($nombre);?>_vars" width="100%"><?php echo get_option('taxomizer_'.($nombre).'_vars'); ?></textarea>
</td>
</tr>
</table>
<?php 
}
?>
<?php  submit_button(); ?>
</form>
</div>
<?php
		} // End if button
?>
</div>
<?php
	}
	// Process a single image ID (this is an AJAX handler)
	public function ajax_process_products() {
		$array=json_decode($_REQUEST['id']);
		$elems=count($array);
		$cuenta=(int)$_REQUEST['cuenta']*$elems;	
		//$nombre="product_cat";
		$varss="product_cat,brand,".fw_theme_mod('fw_extra_tax');
		// Create the list of image IDs
		$args     = array( 'post_type' => 'product' , 'posts_per_page'=>$elems,'offset'=>$cuenta);
		$products = get_posts( $args ); 
		foreach ($products as $pid ) {
	      	//update_post_meta( $pid->ID, '_codigo',substr(wc_get_product($pid->ID)->sku,0,1) );
	      	//write_log(substr(wc_get_product($pid->ID)->sku,0,1));
	      	//write_log($pid->ID." ".$pid->post_title);
	      	foreach (explode(",",$varss) as $nombre ) {
				$nombre=strtolower($nombre);
	      		$tipo=$nombre;
	      		if(empty($nombre))break;
	      		echo wootax_procesar_producto(get_post($pid->ID),wootax_categorizacon_array(get_option('taxomizer_'.$nombre.'_vars')),$nombre);
	    	}
		}
		die();
	}
	// Helper to make a JSON error message
	public function die_json_error_msg( $id, $message ) {
		die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'woo-taxomizer' ), esc_html( get_the_title( $id ) ), $id, $message ) ) ) );
	}


	// Helper function to escape quotes in strings for use in Javascript
	public function esc_quotes( $string ) {
		return str_replace( '"', '\"', $string );
	}
}
// Start up this plugin
add_action( 'init', 'WooTaxomizer' );
function WooTaxomizer() {
	global $WooTaxomizer;
	$WooTaxomizer = new WooTaxomizer();
}