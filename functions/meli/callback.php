<?php
$path = preg_replace('/wp-content.*$/','',__DIR__);require_once($path."/wp-load.php");
header("HTTP/1.1 200 OK");
echo "OK";

if(!fw_theme_mod('fw_ml_on'))return;
$notifications=file_get_contents("php://input");
if(fw_theme_mod('fw_ml_stock_ml_a_web') && $notifications){

    try{

    
      $obj = json_decode($notifications, true);
      $order_id=explode("/",$obj['resource'])[2]; 
      custom_logs('Se recibio de ml la order: '.$order_id);
      $nombre_array='ml_array_orders_'.date("m");
      if(!get_option($nombre_array))update_option($nombre_array,array());

      /*
      $orders_used=get_option($nombre_array);
      if(!isset($orders_used[$order_id]))$orders_used[$order_id]=true;
      else if(isset($orders_used[$order_id])){
        http_response_code(200);
        custom_logs("Repetido: ".$order_id);
        return;
      }*/

      custom_logs('Se procesara la orden: '.$order_id);

      //Init
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
      $order=$meli->get('/orders/'.$order_id, array('access_token' => $access_token));
      $items=$order['body']->order_items;



      foreach ($items as $itemm) {
        $item_id=$itemm->item->id;

        custom_logs("Se procesara el item: ".$item_id);
        $item=$meli->get('/items/'.$itemm->item->id);
        $var_id=$itemm->item->variation_id;
        $item=$item['body'];

        if($var_id){
          foreach($item->variations as $var){
            if($var_id==$var->id){
              $stock=$var->available_quantity;
              $precio=$var->price;
            }
          }
          
        }else{
          $stock=$item->available_quantity;
          $precio=$item->original_price?$item->original_price:$item->price;
          $oferta=$item->original_price?$item->price:'';

          

        }

        
        $variation_id = wc_get_product_id_by_sku($var_id);
        if($variation_id){
          $product_id = wp_get_post_parent_id($variation_id);
          $product = wc_get_product($product_id);
        }
        if(!$product){
          //custom_logs("Se buscara por SKU:".$item_id);
          $product_id = wc_get_product_id_by_sku($item_id);
          $product = wc_get_product($product_id);
        }

        if(is_object($product) && $product->get_sku()){
          //custom_logs("Se encontro el prod: ".$product->get_sku());
        }else{
          custom_logs("No se encontro el prod".$item_id);
          continue;
        }
        
        $product->set_stock($stock);
        $product->set_price($precio);
        if($quantity==0)$product->set_stock_status('outofstock');
        $product->save();   
        
        custom_logs("El producto fue actualizado:<br>SKU:".$item_id."<br>Nombre:".$product->get_name()."<br>Stock:".$product->get_stock_quantity()."<br>Precio:".$precio);
      
        update_option($nombre_array,$orders_used);
      }


      http_response_code(200);
      //custom_logs("Se devolvio 200");
      return;

    }catch (Exception $e) {
      custom_logs('Excepción capturada: ',  $e->getMessage(), "\n"); 
      http_response_code(400);
      custom_logs("Se devolvio 400");
      return;
    }
}





function custom_logs($message) { 
  if(is_array($message)) $message = json_encode($message); 
  $file = fopen(ABSPATH."ml_logs/".fw_theme_mod('fw_id_ml').".log","a"); 
  echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message); 
  fclose($file); 
}