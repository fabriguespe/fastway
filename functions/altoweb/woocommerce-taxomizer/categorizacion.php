<?php
  



function wootax_categorizacon_array($valor){
  $devuelvo=array();
  $filas=explode("\n", trim($valor));
  foreach ( $filas as $fila){
    $newfila=explode(',',trim($fila));
    array_push($devuelvo , $newfila);
  }
  return $devuelvo;
}



function wootax_procesar_producto($prod,$catesmanuales,$tipo){
      if(!empty(get_option('taxomizer_'.$tipo.'_cf'))){//Chequeo custom fiel completo
        if(get_option('taxomizer_'.$tipo.'_cf')[0]=="_"){
          $titulo=get_post_meta( $prod->ID, get_option('taxomizer_'.$tipo.'_cf'), true );
          //write_log($titulo);
        }else{
          $todojunto="";
          $varos=get_the_terms( $prod->ID, get_option('taxomizer_'.$tipo.'_cf'));
          foreach ($varos as $una){
            $todojunto.=$una->name." ";
          }
          $titulo=$todojunto;
        }
      }else{
        $titulo=wootax_formatear($prod->post_title); 
        //write_log($titulo);
      }
      $agregar=array();
      foreach ($catesmanuales as $cateaevaluar) {
        //Entro a una tira de array
        $slugpadre=$cateaevaluar[0];
        $objpadre=get_term_by('slug', (string)$slugpadre, $tipo);
        
        //Traigo las negativas
        $negativas=array();
        foreach ($cateaevaluar as $palabra) {//recorro todas las palabras
            if(mb_strpos(wootax_formatear($palabra),"-") === false)continue;
            array_push($negativas,$palabra);
        }
        //Traido las positivas
        $positivas=array();
        foreach ($cateaevaluar as $palabra) {//recorro todas las palabras
            if(mb_strpos(wootax_formatear($palabra),"+") === false)continue;
            array_push($positivas,$palabra);
        }
        
        foreach ($cateaevaluar as $palabra) {//recorro todas las palabras
          if(mb_strpos(wootax_formatear($titulo), wootax_formatear($palabra)) === false)continue;
          
          //SACO NEGATIVAS
          if(count($negativas)>0){
            $sacar=false;
            foreach ($negativas as $nega) {//recorro todas las palabras
              if(mb_strpos(wootax_formatear($titulo), str_replace("-","",wootax_formatear($nega))) !== false){
                  $sacar=true;
                  break;
              }
            }
            if($sacar)continue;
          }
          
          //SACO NO POSITIVAS
          if(count($positivas)>0){
            $sacar=false;
            foreach ($positivas as $posi) {//recorro todas las palabras
              if(mb_strpos(wootax_formatear($titulo), str_replace("+","",wootax_formatear($posi))) !== false){
                  $sacar=true;
                  break;
              }
            }
            if(!$sacar)continue;
          }
          
          if (wootax_categoriaok($titulo,$palabra))array_push($agregar,$objpadre->term_id);
            
        }
        
      }
      //write_log($prod->post_title);
      wp_set_object_terms($prod->ID, $agregar, $tipo);
      return $prod->post_title;
}

function wootax_formatear($string){
    return strtolower(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string));
}
function wootax_categoriaok($titulo, $cate){
    $nombrecate=$cate->name;
    if(!$cate->name)$nombrecate=wootax_formatear($cate);
    
    //write_log("cates -> ". $titulo." ".$nombrecate);
    $dale1=mb_strpos(wootax_formatear($titulo), wootax_formatear($nombrecate));
    $dale2=mb_strpos(wootax_formatear($titulo), wootax_formatear($nombrecate."s"));
    $dale3=mb_strpos(wootax_formatear($titulo), wootax_formatear($nombrecate."es"));
    if($dale1>=0 || $dale2>=0 || $dale3>=0){
        //write_log("cates -> ". "OK");
        return true;   
    }  
    return false;
}

add_filter( 'manage_edit-product_columns', 'wootax_taxomizer_custom_shop_order_column',11);
function wootax_taxomizer_custom_shop_order_column($columns){
    foreach (explode(",",fw_theme_mod('fw_extra_tax')) as $nombre) 
        if(!empty($nombre))$columns[strtolower($nombre)] =ucfirst($nombre).'s';
    return $columns;
}

add_action( 'manage_product_posts_custom_column', 'wootax_taxomizer_product_column_offercode', 10, 2 );
function wootax_taxomizer_product_column_offercode( $column, $postid ) {
    // agrego a la columna
    foreach (explode(",",fw_theme_mod('fw_extra_tax')) as $nombre) {
        if ( $column == strtolower($nombre) ) {
            $arrra=get_the_terms( $postid, strtolower($nombre));
            if($arrra){
              foreach ($arrra as $jaj)$todojunto.=$jaj->name.",";
            }
            echo rtrim($todojunto,",");
        }    
    }
}
add_action('admin_bar_menu', 'wootax_taxomizer_custom_node_tax', 50);
function wootax_taxomizer_custom_node_tax($wp_admin_bar){
  foreach (explode(",",fw_theme_mod('fw_extra_tax')) as $nombre) {
        $varnom=strtolower($nombre);
        $args = array(
                'parent' => 'custom-node-otros',
                'id' => 'custom-node-'.$varnom.'s',
                'title' => '- '.$nombre.'s',
                'href' => 'edit-tags.php?taxonomy='.$varnom.'&post_type=product',
                'meta' => array(
                    'class' => 'estiloiconomenu titulo-subitem'
                )
        );
        $wp_admin_bar->add_node($args);
  }  
}

add_action( 'init', 'wootax_taxomizer_custom_taxonomy_Item' );
function wootax_taxomizer_custom_taxonomy_Item()  {
  foreach (explode(",",fw_theme_mod('fw_extra_tax')) as $nombre ) {
      $nombre = ucfirst($nombre);
      $labels = array(
          'name'                       => $nombre.'s',
          'singular_name'              => $nombre,
          'menu_name'                  => $nombre.'s',
          'all_items'                  => 'Todas las '.$nombre.'s',
          'parent_item'                => $nombre.' Padre',
          'parent_item_colon'          => $nombre.' Padre',
          'new_item_name'              => 'Nueva '.$nombre,
          'add_new_item'               => 'Crear '.$nombre,
          'edit_item'                  => 'Editar '.$nombre,
          'update_item'                => 'Actualizar '.$nombre,
          'separate_items_with_commas' => 'Separar con comas',
          'search_items'               => 'Buscar '.$nombre.'s',
          'add_or_remove_items'        => 'Agregar or eliminar '.$nombre.'s'
      );
      $args = array(
        
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' =>strtolower($nombre), 'hierarchical' => true ),
      );
      register_taxonomy( strtolower($nombre), 'product', $args );
      register_taxonomy_for_object_type( strtolower($nombre), 'product' );
  }
}




function wootax_register_settings_taxomizer() {

  add_option( 'fw_extra_tax', '');
  register_setting( 'taxomizer_options_group', 'fw_extra_tax', 'myplugin_callback' );


  $varss="product_cat,brand,".fw_theme_mod('fw_extra_tax');
  foreach (explode(",",$varss) as $nombre ) {
  $nombre=strtolower($nombre);
  if(empty($nombre))break;
      add_option( 'taxomizer_'.($nombre)."_vars", '');
      add_option( 'taxomizer_'.($nombre)."_cf", '');
      register_setting( 'taxomizer_options_group', 'taxomizer_'.($nombre)."_vars", 'myplugin_callback' );
      register_setting( 'taxomizer_options_group', 'taxomizer_'.($nombre)."_cf", 'myplugin_callback' );
  }
   
}
add_action( 'admin_init', 'wootax_register_settings_taxomizer' );



