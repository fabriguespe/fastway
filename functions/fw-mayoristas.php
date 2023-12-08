<?php


function parser_mayorista($value,$role='administrator'){
  //'a:1:{s:9:"mayorista";s:6:"943.64";}'
  if(is_array($value)){
    $value=json_encode($value);
  }
  $data=json_decode($value,true);
  $number=$data[$role];
  if(empty($number) && $value[0]=='a' && $value[1]==':'){
    preg_match_all('/"([^"]+)"/', $value, $m);
    $number=json_encode($m[0][1]);
    $number=preg_replace("/[^0-9.]/", "", $number);
  }
  if(empty($number))$number=0;
  return $number;
}
function array_swap_assoc(&$array,$k1,$k2) {
  if($k1 === $k2) return;  // Nothing to do

  $keys = array_keys($array);  
  $p1 = array_search($k1, $keys);
  if($p1 === FALSE) return;  // Sanity check...keys must exist

  $p2 = array_search($k2, $keys);
  if($p2 === FALSE) return;

  $keys[$p1] = $k2;  // Swap the keys
  $keys[$p2] = $k1;

  $values = array_values($array); 

  // Swap the values
  list($values[$p1],$values[$p2]) = array($values[$p2],$values[$p1]);
  $array = array_combine($keys, $values);
}

if(fw_theme_mod('fw_client_admin_columnaprecio')){
  add_filter( 'manage_edit-product_columns', 'manage_product_posts_custom_mayorista_title',11);
  function manage_product_posts_custom_mayorista_title($columns){
    $nombre='Mayorista';
    $nuevas=[];
    foreach($columns as $key => $value){
      $nuevas[$key]=$value;
      if($key=='price')$nuevas[strtolower($nombre)]=ucfirst($nombre);
    }
    return $nuevas;
  }

  add_action( 'manage_product_posts_custom_column', 'manage_product_posts_custom_mayorista_set', 10, 2 );
  function manage_product_posts_custom_mayorista_set( $column, $postid ) {
      $nombre='Mayorista';
      $product = wc_get_product( $postid );
      if ( $column == strtolower($nombre) ) {
        $valor=get_post_meta( $postid, 'festiUserRolePrices', true );
        echo '$'.parser_mayorista($valor,strtolower($nombre));
      }
  }
}
?>