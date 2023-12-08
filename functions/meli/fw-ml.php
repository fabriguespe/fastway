<?php

function ml_log_register_plugin_page() {
	add_options_page('ML Log', 'ML Log', 'manage_options', 'mllog', 'mllog_options_page');
}
add_action('admin_menu', 'ml_log_register_plugin_page');
	
function custom_log($message) { 
  if(is_array($message)) $message = json_encode($message); 
  $file = fopen(ABSPATH."ml_logs/".fw_theme_mod('fw_id_ml').".log","a"); 
  echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message); 
  fclose($file); 
}

function mllog_options_page(){
  $handle = fopen(ABSPATH."ml_logs/".fw_theme_mod('fw_id_ml').".log","r"); 
  if ($handle) {
      $logs=[];
      while (($line = fgets($handle)) !== false){
        if(empty($line))continue;
        $line='<span class="fecha">'.$line;
        $line=str_replace('::','</span>',$line);
        $line=$line.'<br>';
        $logs[]= $line;
      }
      fclose($handle);
      $logs=array_reverse($logs);
      foreach($logs as $log){
        $log_total.= nl2br($log);
      }
  } ?>
  <h2>Log mercadolibre</h2>
  <small>Recibe las ventas de ML</p>
  <pre class="log_fw" ><?=$log_total?></pre>
  <style>
  .log_fw{
    overflow-y: scroll; 
    height:400px !important;
    width:95% ;
    height:100%;
    min-height:500px;
    margin-top:10px;
    background:#1F1E1E;
    color:white;
    white-space: pre-line;
  }
  .log_fw .fecha{
    color:green;
  }
</style>
<?php 
}

if(fw_theme_mod('fw_ml_stock_web_a_ml')){
  //esata corre antes!! add_action('woocommerce_checkout_order_processed', 'fw_ml_update_stock', 10, 1);
 if(fw_theme_mod('fw_ml_stock_slm_test'))add_action('woocommerce_reduce_order_stock','woo_order_status_change_custom', 10, 1);
 else add_action('woocommerce_thankyou', 'fw_ml_update_stock', 10, 1);

}
function woo_order_status_change_custom($post_id) {
  
    // Get an instance of the WC_Order object (in a plugin)
    $order = new WC_Order( $post_id ); 
    $order->add_order_note("woocommerce_order_status_changed ".$order->id);
    fw_ml_update_stock($order->id);
  }

function pl_save_post_shop_order( $post_id, $post, $update ){
    
    // Get an instance of the WC_Order object (in a plugin)
    $order = new WC_Order( $post_id ); 
    $order->add_order_note("save_post_shop_order ".$order->id);
    fw_ml_update_stock($order->id);
  
}
function fw_ml_update_stock( $order_id ) {
    if ( ! $order_id ){
      error_log("no entro");
      return;
    }
    
    try{
            if(get_post_meta( $order_id, '_ml_done' )=='yes' )return;
            if(!fw_theme_mod('fw_ml_on'))return;
            $usuario=getconfig(fw_theme_mod('fw_id_ml'));
            $iduser=trim($usuario['iduser']);
            $access_token= trim($usuario['access_token']);
            $refresh_token = trim($usuario['refresh_token']);
            $appId=fw_theme_mod('fw_ml_appid');
            $secretKey=fw_theme_mod('fw_ml_appsecret');

            $meli = new Meli($appId, $secretKey,$access_token,$refresh_token);
            $nuevos=$meli->refreshAccessToken();
            $access_token=$nuevos['body']->access_token;
            $refresh_token=$nuevos['body']->refresh_token;
            if(!empty($refresh_token) && !empty($access_token))saveconfig($iduser,$access_token,$refresh_token);
            
            $order = wc_get_order( $order_id );

            $noteg="STOCK MERCADOLIBRE"."\n";
            foreach ( $order->get_items() as $item_id => $item ) {
                $parent_sku=null;
                if( $item['variation_id'] > 0 ){
                  $product_id = wp_get_post_parent_id($item['variation_id']);
                  $product = wc_get_product($product_id);
                  $parent_sku=$product->get_sku(); 
                  $product_id = $item['variation_id']; // simple product
                }else {
                  $product_id = $item['product_id']; // simple product
                } 


                $product = wc_get_product($product_id);
                $sku=$parent_sku?$parent_sku:$product->get_sku(); 
                
                /*$note="Nuevo Proceso: ".$product_id."-".$sku."\n";
                if($product_id == $item['product_id'])$note.="Es un prod simple\n";
                else if($product_id == $item['variation_id'])$note.="Es una variacion\n";
                $order->add_order_note($note);*/


                if(strpos( $sku, 'MLA' ) !== false){
                  $stock=$product->get_stock_quantity()/*-$item->get_quantity()*/;
                  if($stock<0)$stock=0;
                  $prod=$meli->get('/items/'.$sku, array('access_token' => $access_token));
                  $vars=$prod['body']->variations;
                  $permalink=$prod['body']->permalink;
                  if(count($vars)>0){
                      $var_id=$vars[0]->id;//es unica por como funciona woo
                      //$note=$var_id." - es un prod variable \n";
                      //$order->add_order_note($note);

                      $item = array(
                        "variations" => array(
                          array(
                            "id"=>$var_id,
                            "available_quantity"=>$stock
                          )
                        )
                      );
                  }else{
                    //$note=$sku." - es un prod simple \n";
                    //$order->add_order_note( $note);
           

                    $item = array("available_quantity"=>$stock);
                  }

                  $result=[];
                  if($debug){
                    custom_log(print_r($prod,true));
                    custom_log('vars cant:'.count($vars));
                    custom_log('/items/'.$sku);
                    custom_log(print_r($item,true));
                  }else{
                    $result=$meli->put('/items/'.$sku, $item, array('access_token' => $access_token));
                  }
                  if($result['httpCode']==200)$noteg.="<a target='_blank' href='".$permalink."'>".$sku."</a>"." ->".$stock."\n";
                  else $noteg.="ERROR ".$sku." -> ".$stock."\n";

                  ## HERE you Create/update your custom post meta data to avoid repetition
                  update_post_meta( $order_id, '_ml_done', 'yes' );
                  
                  
                }

            }

            $order->add_order_note( $noteg );
    }catch(Exeption $e){
            custom_log($e);
            error_log($e);
    }
}
