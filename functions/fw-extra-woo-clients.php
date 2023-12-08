<?php

add_shortcode('hans_table','hans_table');
function hans_table(){
  global $product;

  if( $product->is_type('variable') ){
    // Searching for the default variation
    $default_attributes = $product->get_default_attributes();
    // Loop through available variations.
    $tabla= '
    <style>
	
    .nav-item{
      margin-right:1px;
      }
      .fw_tabla_variaciones .nav-item{
      width:24.5% !important;
      }
      .fw_tabla_variaciones .nav-item{
      border-right:1px solid #d3ced2;
      }
      .vc_tta-tab a{
      background:white !important;
      border-radius:1px !important;
      }
    .fw_tabla_variaciones td{
      text-transform: capitalize !important; !important;
    }
	.fw_add_to_cart_button_table i{
color:black
}
    .fw_tabla_variaciones{
      float:left;
      width:100%;
    }
    .fw_tabla_variaciones #myTab{
      margin-top:20px;
    }
    .fw_tabla_variaciones table.fw_variations_table,
    .fw_tabla_variaciones .fw_variations_table th,.fw_variations_table td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    
    /* -- quantity box -- */
    
    .fw_tabla_variaciones .fw_variations_table .quantity {
      display: inline-block; }
     .quantity {
     padding:4px;
     }
    .fw_tabla_variaciones .fw_variations_table .quantity .input-text.qty {
      width: 25px;
      height: 30px;
      padding: 0 5px;
      font-size:12px;
      text-align: center;
      background-color: transparent;
      border: 1px solid #efefef;
     }
     
     .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added {
      text-align: left;
      position: relative;
      white-space: nowrap;
      vertical-align: top; }
     
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added input {
      display: inline-block;
      margin: 0;
      vertical-align: top;
      box-shadow: none;
     }
     
     .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .minus,
     .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .plus {
      height: 30px;
     line-height:15px;
      background-color: #ffffff;
      border: 1px solid #efefef;
      cursor:pointer;}
     
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .minus {
      border-right: 0; }
     
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .plus {
      border-left: 0; }
     
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .minus:hover,
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .plus:hover {
      background: #eeeeee; }
     
      .fw_tabla_variaciones .fw_variations_table .quantity input::-webkit-outer-spin-button,
      .fw_tabla_variaciones .fw_variations_table .quantity input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      margin: 0; }
      
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .minus:focus,
      .fw_tabla_variaciones .fw_variations_table .quantity.buttons_added .plus:focus {
      outline: none; }
      .fw_variations_table th,
      .fw_variations_table  td{
      border: 1px solid #d3ced2 !important;;
      }
      .fw_tabla_variaciones .nav-item .nav-link.active{
        background:var(--main);
        color:white;
        border-radius:2px;
        border-color:var(--main);
        border-bottom:0px !important;
        border-rad
      }
      .fw_tabla_variaciones .fw_variations_table {
        text-align:center !important;
      }
      .fw_tabla_variaciones .fw_variations_table thead{
        background:#D1D2D4;
      }
      .fw_tabla_variaciones .fw_variations_table{
        padding:3px;
        font-size:12px;
        font-weight:400 !important;
      }
      .fw_tabla_variaciones .buttons_added,
      .fw_tabla_variaciones .buttons_added input{
        padding:2px !important;
      }
      
      .fw_tabla_variaciones .fw_variations_table td button{
        margin:0 auto !important;
        display:block !important;
        float:none !important;
      }
      .fw_tabla_variaciones .fw_variations_table th{
        font-weight:400 !important;
      }
      .fw_tabla_variaciones .nav-tabs{
        border:0px;
      }
      .fw_tabla_variaciones .nav-item .nav-link.active{
        border-bottom-left-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
        border-bottom:0px !important;
      }
      .fw_tabla_variaciones .nav-link{
        text-align:center;
        }
      .fw_tabla_variaciones small{
        font-size:10px;
        display:block;
        line-height:8px !important;
        text-align:center !important;
      }
      .fw_tabla_variaciones .nav-item {
        border-top: 1px solid #d3ced2;
        border-left: 1px solid #d3ced2;
      }
      .fw_tabla_variaciones .nav-item.last{
        border-right: 1px solid #d3ced2;
      }
      .fw_tabla_variaciones .nav-item{
        width:25%
      }
    </style>';
    

    $tabla.='<div class="fw_tabla_variaciones">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="unit-tab" data-toggle="tab" href="#unit" role="tab" aria-controls="unit" aria-selected="true">Unit<small>Purchase</small></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="b5-tab" data-toggle="tab" href="#b5" role="tab" aria-controls="b5" aria-selected="false">Bundle 5<small>Get 1 FREE</small></a>
        
      </li>
      <li class="nav-item">
      <a class="nav-link" id="b10-tab" data-toggle="tab" href="#b10" role="tab" aria-controls="b10" aria-selected="false">Bundle 10<small>Get 3 FREE</small></a>
      </li>
      <li class="nav-item last">
      <a class="nav-link" id="b20-tab" data-toggle="tab" href="#b20" role="tab" aria-controls="b20" aria-selected="false">Bundle 15<small>Get 5 FREE</small></a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">';

    $tpos=array('unit'=>'Unit','b5'=>'Bundle 5','b10'=>'Bundle 10','b20'=>'Bundle 20');
      
    foreach($tpos as $key_type => $type_name){
      $firsopen="";
      if($key_type=='unit')$firsopen="fade show active";
      $tabla.='
      <div class="tab-pane '.$firsopen.'" id="'.$key_type.'" role="tabpanel" aria-labelledby="'.$key_type.'-tab">
      <table class="fw_variations_table" style="width:100%">
      <thead>
      <tr>
        <th>Type</th>
        <th>Size</th>
        <th>Volume</th>
        <th>SKU</th>
        <th>Price</th>';
        if($key_type!='unit')$tabla.='<th>Units</th>';
        $tabla.='<th>Qty</th>
        <th width="8">Buy</th>
      </tr>
      </thead>
	  <tbody>';

      foreach($product->get_available_variations() as $variation){
        if($variation['attributes']['attribute_pa_package']!=$key_type)continue;
        $tabla .= '<tr>';
        $tabla .= '<td>'.$variation['attributes']['attribute_pa_form'].'</td>';
        $tabla .= '<td>'.$variation['attributes']['attribute_pa_size'].'</td>';

        $volume=$variation['attributes']['attribute_pa_form'];
        if($volume=='chip')$volume='850~1500um';
        if($volume=='powder')$volume='250~850um';
        if($volume=='putty')$volume='200~850um';


        $id_var=$variation['variation_id'];

        $bundle=1;
		  
        if($key_type=='b5')$bundle=6;
        else if($key_type=='b10')$bundle=13;
        else if($key_type=='b20')$bundle=20;
        
		  

        $tabla.='
          <td>'.$volume.'</td>
          <td>'.$variation['sku'].'</td>
          <td>$'.$variation['display_price'].'</td>';
          if($key_type!='unit')$tabla.='<th>'.$bundle.'</th>';
          $tabla.='
          <td><div class="quantity buttons_added">
          <input type="button" value="-" class="minus"><input id="'.$id_var.'" type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
          </div></td>
          <td ><button id="fw_add_to_cart_button_'.$id_var.'"  onclick="add_to_minicart_table('.$product->id.','. $id_var.')" class=" btn fw_add_to_cart_button_table var_'.$id_var.'" data-product_id="'.$product->id.'">
          <i class="fad fa-cart-plus "></i>
          <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
          </button></td>
        </tr>';
      }
      $tabla .= '</tbody></table></div>';
    }
  $tabla .= '</div></div>';
  }
  return $tabla;
}



?>