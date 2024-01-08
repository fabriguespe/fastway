<div id="modal_carrito" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center t2">
                <h4 class="modal-title text-center"><?=fw_theme_mod('fw_label_mi_pedido')?></h4>
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body mx-3">
                <?php 
                    if(fw_theme_mod('fw_code_modalcart')){
                        echo '<div class="row fw_code_modalcart mb20">'.do_shortcode(fw_theme_mod('fw_code_modalcart')).'</div>';
                    }
                ?>
                <div class="container"><!--ajax content, do not touch--></div>
                <div class="row mt20">
                        <div class="col-lg-6 col-md-12 d-flex align-items-center botonescarrito">
                        <?php 
                        if(fw_theme_mod('fw_seguircomprando_url')=='/'){
                            echo '<button type="button" class="btn seguir" data-dismiss="modal" aria-label="Close">'.fw_theme_mod('fw_label_agregar_mas').'</button>';
                        }else{
                            echo '<a href="'.fw_theme_mod('fw_seguircomprando_url').'" class="btn seguir" >'.fw_theme_mod('fw_label_agregar_mas').'</a>';
                        }?>
                        <a  class="btn seguir iralcarrito" style="padding-right:0px;color: inherit !important;text-decoration: none !important;font-size: inherit !important;font-family: inherit !important;font-weight: inherit !important;line-height: inherit !important;" href="<?=esc_url( wc_get_cart_url() )?>"><?=fw_theme_mod('fw_label_ir_carrito')?></a>
                        </div>
                        <div class="col-lg-6 col-md-12 d-flex ">
                            <?php 
                            if(fw_theme_mod('fw_seguircomprando_url')=='/' && fw_theme_mod('fw_modal_cart_calltoa')=='checkout'){ ?>
                                <button type="button" onclick="ir_al_checkout()" id="" class="btn comprar ml-auto"><?=fw_theme_mod('fw_place_order_text')?></button>
                            <?php }else if(fw_theme_mod('fw_modal_cart_calltoa')=='cart'){?>
                                <button type="button" onclick="location.href='<?=esc_url( wc_get_cart_url() )?>'" id="" class="btn comprar ml-auto"><?=fw_theme_mod('fw_place_order_text')?></button>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <style>
                    @media (max-width: 799px) {
                        .botonescarrito{
                            justify-content:space-between;
                        }
                        .botonescarrito a,
                        .botonescarrito button{
                            padding:2px
                        }.botonescarrito{
                            width:100%;
                            margin-bottom:20px;
                        }
                        #modal_carrito .btn.comprar{
                            width:100% !important;
                        }
                    }
                    </style>
            </div>
        </div>
    </div>
</div>
<?php if(is_product()){?>

<div id="modal_envio" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body mx-3">
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
                <div class="row text-center"><i class="fa fa-shipping-fast mb10" style="color:var(--second);font-size:30px;margin:0 auto;"></i></div>
                <div class="container">
                <h4 class="modal-title text-center"><?=fw_theme_mod('fw_label_calcular_costo_envio')?></h4>
                <div id="shipping-calc" class="text-center mt20 mb20">
                    <span class="text-center db mb10 mt10">Ingresa tu código postal</span>
                    <input type="tel" id="wscp-postcode" autocomplete="off"  name="wscp-postcode" class="text-center" style="" placeholder="Ej: 1804" />
                    <button type="button" id="wscp-button" class="btn btn-main btn_mp_calc_shipping db mt20 mb20 pb5 pt5">
                        <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
                        Calcular
                    </button>
                    <input type="hidden" name="wscp-nonce" id="wscp-nonce" value="<?= wp_create_nonce( "wscp-nonce" ); ?>">
                    <div id="wscp-response"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_cuotas" class="modal fade addNewInputs show" role="dialog" aria-labelledby="modalAdd" aria-modal="true" style="" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body mx-3">
                <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
                <div class="row text-center"><i class="fa fa-credit-card mb10" style="color:var(--second);font-size:30px;margin:0 auto;"></i></div>
                <div class="container">
                    <h4 class="modal-title text-center mb10"><?=fw_theme_mod('fw_label_calcular_cuotas')?></h4>
                    <?php if(is_plugin_active('Plugin-WooCommerce-master/index.php') && is_plugin_active('woocommerce-mercadoenvios/woocommerce-mercadoenvios.php')){ ?>
                    <div class="d-flex justify-content-center tabus"> 
                    <button class="mp btn active" onclick="toggle('mp')" >Mercadopago</button>
                    <button class="tp btn" onclick="toggle('tp')" >Todopago</button>
                    </div>
                    <?php } ?>
                    <div class="row mt20 mpshow">
                        <div class="col-md-5 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Tarjeta</label><br>
                                <select name="forma" class="dropdown-toggle bs-placeholder btn btn-main" id="forma" onchange="obtenerBancos();">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Banco</label><br>
                                <select name="banco" class="dropdown-toggle bs-placeholder btn btn-main" id="banco" onchange="obtenerCuotas();"></select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Cuotas</label>
                                <select id="cuotas" class="dropdown-toggle bs-placeholder btn btn-main" onchange="calcular();"></select>
                            </div>
                        </div>
                        <div class="col-md-12 align-bottom">
                            <div class="row finales">
                                <div class="col-md-6 text-center align-bottom">
                                    <label class="control-label btns">Cuotas de: <span id="cuota" class="b">0</span></label>	
                                </div>
                                <div class="col-md-6 text-center">									
                                    <label class="control-label btns">Total: <span id="montofinal" class="b">0</span></label>	
                                </div>	
                            </div>								
                        </div>
                    </div>
                    <div class="row mt20 tpshow hid text-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cuotas</label>
                                <select id="cuotastp" class="dropdown-toggle bs-placeholder btn btn-main" onchange="calcular();">
                                <?php 
                                foreach(explode( ',',fw_theme_mod('fw_cuotas_todopago_calculador' )) as $cuota) echo '<option value="'.$cuota.'">'.$cuota.'</option>';
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 align-bottom">
                            <div class="row finales">
                                <div class="col-md-6 text-center align-bottom">
                                    <label class="control-label btns">Cuotas de: <span id="cuotatp" class="b"></span></label>	
                                </div>
                                <div class="col-md-6 text-center">									
                                    <label class="control-label btns">Total: <span id="montofinaltp" class="b"></span></label>	
                                </div>	
                            </div>								
                        </div>
                    </div>
                    <div class="row mt20">
                            <div class="col-md-12 text-center">
                                <img width="300" src="/wp-content/themes/fastway/assets/img/altoweb/mp.png"><br>
                                <a href="https://www.mercadopago.com.ar/cuotas" target="_blank" class="text-center text-info" style="font-size:12px;boder-bottom">Ver todas las promociones</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Configurá tu Public Key
    obtenerTarjetas();

    function obtenerTarjetas(){

        jQuery.getJSON( "https://api.mercadolibre.com/sites/MLA/payment_methods/", function( data ) {
            jQuery.each( data, function( key, val ) {
                if(val['payment_type_id']!='credit_card')return;

                var o = new Option(val['name'],val['id']);
                jQuery("#forma").append(o);
            });
            obtenerBancos();
        });
    }
    
            
    function limpiarComboCuotas(){
        document.getElementById('cuotas').innerHTML = ' <select id="cuotas" onchange="calcular();" style="width: 200px;"></select>';
    }
    
            
    function obtenerSeleccionCombo(idCombo){
        if(jQuery('#cuotatp').is(":visible"))idCombo+='tp'
        var indice = document.getElementById(idCombo).selectedIndex;
        if(indice>=0)return document.getElementById(idCombo).options[indice].value;
    }
    
    function limpiarComboBancos(){
        if(document.getElementById('banco'))document.getElementById('banco').innerHTML = '<select id="banco" onchange="obtenerCuotas();" style="width: 200px;"></select>';
    }
    
    function obtenerBancos(){
        limpiarComboBancos();
        var id = obtenerSeleccionCombo('forma');
        var parametros = {};
        jQuery.getJSON( "https://api.mercadolibre.com/sites/MLA/payment_methods/"+id, function( val ) {
            var banco = val.card_issuer.name;
            var id = val.card_issuer.id;
            if(id==1 || id==3 || id==2 || id==1007 || id==5 || id==288 || id==692 || id==688 || id==4){
                banco = 'Otros Bancos'; 
            }

            var o = new Option(banco,id);
            jQuery("#banco").append(o);

            var excepciones = val.exceptions_by_card_issuer;
        
            var tamanio = excepciones.length;                    
            var i = 0;
            var k = 1;
            while(i<tamanio)
                    {
                        var banco = excepciones[i].card_issuer.name;
                        var id = excepciones[i].card_issuer.id;
                        var o = new Option(banco,id);
                        jQuery("#banco").append(o);
                        i++;
            k++;
            }
            obtenerCuotas();
        });
    }

    function obtenerCuotas(){
        limpiarComboCuotas();
        
        var id = obtenerSeleccionCombo('forma');
        var banco = obtenerSeleccionCombo('banco');
        var parametros = {};
        jQuery.ajax({
            data:  parametros,
            url:   'https://api.mercadolibre.com/sites/MLA/payment_methods/'+id,
            type:  'get',
            dataType: "json",
            beforeSend: function () {
                //$("#resultado").html("Procesando, espere por favor...");
            },
            success:  function (response) {
                ejecutorObtenerCuotas(banco,response);
            }
        });
        
    }

    function ejecutorObtenerCuotas(idBanco,respuesta){                
        var arregloTextos = respuesta;//JSON.parse(respuesta);
        var x = 0;
        var bancoObtenido = arregloTextos.card_issuer.id;
        if(bancoObtenido == idBanco){
            var opcionesPago = arregloTextos.payer_costs;
            var tamanioOpciones = opcionesPago.length;
            var k = 0;
            while(k<tamanioOpciones){
                var cuotas = opcionesPago[k].installments;
                var rate = opcionesPago[k].installment_rate;
                document.getElementById("cuotas").options[x] = new Option(cuotas,rate);
                x++;
                k++;
            }
        }
        
        var excepciones = arregloTextos.exceptions_by_card_issuer;
        var tamanio = excepciones.length;                    
        var i = 0;
        while(i<tamanio)
        {
            var bancoObtenido = excepciones[i].card_issuer.id;
            if(bancoObtenido == idBanco){
                var opcionesPago = excepciones[i].payer_costs;
                var tamanioOpciones = opcionesPago.length;
                var k = 0;
                while(k<tamanioOpciones){
                    var cuotas = opcionesPago[k].installments;
                    var rate = opcionesPago[k].installment_rate;
                    document.getElementById("cuotas").options[x] = new Option(cuotas,rate);
                    x++;
                    k++;
                }
            }
            i++;
        }
        obtenerPrecioProducto();
    }
        
    function obtenerPrecioProducto(){
            precioObtenido = jQuery(".fw_price").attr("data-precio");
            calcular();
    }
        
    function obtenerClaveCombo(idCombo){
        if(jQuery('#cuotatp').is(":visible"))idCombo+='tp'
        var indice = document.getElementById(idCombo).selectedIndex;
        var resultado = document.getElementById(idCombo).options[indice].text;
        return resultado;
    }

    function ejecutorObtenerPrecioProducto(){
        var arregloTextos = JSON.parse(respuesta3);
        precioObtenido = arregloTextos[0].precio;
        calcular();
    }
        
    function calcular(){
        var rate = obtenerSeleccionCombo('cuotas');

        var montoFinal = 0;	
        if(rate>0){
            montoFinal = parseFloat(precioObtenido) + (parseFloat(rate) * parseFloat(precioObtenido)) / 100;
        }else{
            montoFinal = parseFloat(rate) + parseFloat(precioObtenido);
        }

        var cantCuotas = obtenerClaveCombo('cuotas');
        var valorCuota = montoFinal / parseInt(cantCuotas);

        document.getElementById('cuota').innerHTML = '$' + valorCuota.toFixed(2);
        document.getElementById('montofinal').innerHTML = '$' + montoFinal.toFixed(2);
        document.getElementById('cuotatp').innerHTML = '$' + valorCuota.toFixed(2);
        document.getElementById('montofinaltp').innerHTML = '$' + montoFinal.toFixed(2);
    }

        
</script>
<?php } ?>
<style>
.tabus .mp{
    border-left:1px solid var(--main);
    border-bottom:1px solid var(--main);
    border-top:1px solid var(--main);
    border-right:1px solid var(--main);
    background:white;
    border-radius:0px;
    border-top-left-radius:5px;
    border-bottom-left-radius:5px;
}

.tabus .tp{
    border-left:1px solid var(--main);
    border-bottom:1px solid var(--main);
    border-top:1px solid var(--main);
    border-right:1px solid var(--main);
    background:white;
    border-radius:0px;
    border-left:0px;
    border-top-right-radius:5px;
    border-bottom-right-radius:5px;
}

.tabus .tp.active,
.tabus .mp.active{  
    color:white;
    background: var(--main);
}
#modal_carrito .btn.seguir{
    background:var(--second);
    color:white;
    border:0px ;
}
#modal_carrito .btn.seguir{
    background:white ;
    border:1px solid var(--main) ;
    color:var(--main);
}
#modal_carrito .iralcarrito{
    font-size:12px;;
    color:#0000EE !important;
    border:0px !important;
}
#modal_carrito .btn.comprar{
    background:var(--main);
    color:white;
    border:0px ;
}

.fw_variations{
    text-align:center !important;
    width:100% !important;
}

.fw_add_to_cart_button:disabled {
  background: #ccc;
}

/*MODAL ENVIO*/
#wscp-postcode{
  text-align: center;;
  border:0px !important;
  border-bottom: 1px solid #eeeeee !important;
}
#wscp-response p,
#wscp-response span{
  font-size:14px !important;
  line-height:16px !important;
  margin-bottom:10px !important;
}
#modal_cuotas .finales{
font-size:20px;
line-height:60px !important;
}
#modal_cuotas .finales span{
font-size:30px;
line-height:60px !important;
}
#modal_cuotas select{
color:white !important;
}
</style>
<script>
function toggle(quien){
    if(quien=='mp'){
        jQuery('.tabus .mp').addClass('active')
        jQuery('.tabus .tp').removeClass('active')
        jQuery('.tpshow').toggle()
        jQuery('.mpshow').toggle()
    }else{
        jQuery('.tabus .tp').addClass('active')
        jQuery('.tabus .mp').removeClass('active')
        jQuery('.tpshow').toggle()
        jQuery('.mpshow').toggle()

    }
}


function ir_al_checkout(modal=true){
    let url='<?=wc_get_checkout_url()?>';
    let pasa_filtro_rol='<?=has_min_purchase()?>';
    if(!pasa_filtro_rol)return location.href=url
    console.log('min:',pasa_filtro_rol,url)
    

    let min=jQuery('#totals').data("min")
    let total=jQuery('#totals').data("subtotal")
    if(!min)min='<?=fw_get_minimum_order_amount()?>';
    console.log('min',min)

    let min2='<?=fw_theme_mod('fw_min_purchase')?>';
    let min3='<?=fw_theme_mod('fw_min_purchase2')?>';
    let min4='<?=fw_get_customer_orders()?>';
    console.log(min2,min3,min4)
    if(!total)total=Number((jQuery('.cart-subtotal td span').text()).replace(/[^0-9.-]+/g,""));
    
    if(typeof min === 'string'){
        min = min.match(/\d/g);
        min = min.join("");
    }

    console.log('v2',parseInt(min),parseInt(total),min<=total)
    if(!min)location.href=url
    else if(min && parseInt(min)<=parseInt(total))location.href=url
    else alert('Compra minima <?=fw_theme_mod('fw_min_purchase')?>. Puede ir al carrito y agregar mas unidades, o seguir comprando.');
}

function getVariation(){
    let selects=jQuery( ".fw_variations select" )
    let vars=jQuery( ".fw_variations" ).data( "product_variations" );
    let indexes=[]
    let elid=-1
    
    selects.each(function( index ) {
        indexes[jQuery(this).data('attribute_name')]=jQuery(this).val()
    });
    let vara=null
    vars.forEach(function(element) {
        let atr=element['attributes']
        let names=Object.keys(indexes)
        let esigual=true
        names.forEach(function(name) {
            if(atr[name]!=indexes[name])esigual=false
        })

        if(esigual) vara=element
    });
    return vara
}

jQuery( ".fw_variations select" ).change(function() {

    let vara=getVariation()
    if(!vara){
        console.log('vara1')
        jQuery('.fw_add_to_cart_button').prop("disabled",true)
        return;
    }
    console.log('no pasa')
    jQuery('.summary .fw_price').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    jQuery.get(ajaxurl, { 'action': 'get_variation_price',variation_id:vara['variation_id']}, 
        function (msg) { 
            jQuery('.summary .fw_price').html(msg)

            

            jQuery('#mini_label_stock').remove()
            //Slide!!
            var ee="clase-"+vara['variation_id']
            var index = 0;
            jQuery.each(jQuery(".swiper-wrapper").children(), function(i, item) {
                console.log("slide:",i,ee)
                if (jQuery(item).hasClass(ee)) {
                    index = i;                
                    console.log("ebtra")

                    return false;
                }
            });
            swiper.slideTo(index, 500);
            
            if((vara['is_in_stock'] && vara['is_purchasable']) || vara['backorders_allowed']){
                
                jQuery('.fw_add_to_cart_button').prop("disabled",false)
            }else {
                //console.log('vara2',vara['is_in_stock'],vara['is_purchasable'],vara['backorders_allowed'])
                jQuery('.fw_add_to_cart_button').prop("disabled",true)
                jQuery('.fw_add_to_cart_button').after('<small id="mini_label_stock" style="text-align:center !important;margin:0 auto;display:block;"><?=fw_theme_mod('out-of-stock-text')?></small>')
            }
        }
    );
});

function clickproduct(url,redirect){
    location.href=url
}
function add_to_minicart_table(prod_id,var_id){
    jQuery('.var_'+var_id).addClass('loading')
    let qty=1
    if(jQuery('.quantity #'+var_id).val())qty=jQuery('.quantity #'+var_id).val()
    jQuery.get(ajaxurl,
    {'action': 'add_to_cart',id:prod_id,var_id:var_id,qty:qty}, 
    function (msg) { 
        jQuery('#modal_carrito').modal('show');
        jQuery('.var_'+var_id).removeClass('loading')
    });
}


function add_to_minicart(prod_id){
    let var_id=0;

    if(jQuery( ".fw_variations" ).length){
        var_id=getVariation()
        if(!var_id){
            alert('<?=fw_theme_mod('fw_label_seleccionar_opcion')?>')
            return;
        }else{
            var_id=var_id['variation_id']
        }
    }
    jQuery('#fw_add_to_cart_button_'+prod_id).addClass('loading')
    jQuery('.minicart').addClass('bouncing')
    
    console.log('eventAction:addtocart' );
    
    let qty=1
    if(jQuery('.quantity input').val())qty=jQuery('.quantity input').val()

    jQuery.get(ajaxurl,
    {'action': 'add_to_cart',id:prod_id,var_id:var_id,qty:qty}, 
    function (product) { 
        product=JSON.parse(product)

        jQuery('#modal_carrito').modal('show');
        jQuery('#fw_add_to_cart_button_'+prod_id).removeClass('loading')

        if(window.fbq)fbq('track', 'AddToCart');
        if(window.gtag)gtag('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'addtocart', eventLabel: 'Agregar al carrito'});
        if(window.ga)ga('send', {hitType: 'event',eventCategory: 'Ecommerce',eventAction: 'addtocart', eventLabel: 'Agregar al carrito'});
        if(window.dataLayer){
            let datala={
                'event': 'AddToCart',
                'ecommerce': {
                    'currencyCode': 'ARS',
                    'add': {                              
                        'products': [{                       
                            'name': product.name,
                            'id': product.sku,
                            'price': product.price,
                            'category': product.category,
                            'quantity': product.qty
                        }]
                    }
                }
            }
            console.log(datala)
            dataLayer.push(datala);
        }
        
    });
}
jQuery('#modal_carrito').on('show.bs.modal', function () {
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    populatecart();
});


function addCant(index,cart_item_key,sum=1,max=11111111,){
    let actual=parseInt(jQuery('#qty_'+index).val())
    console.log(sum,actual)
    if(sum==actual)sum=1;
    else if(sum==actual*-1)sum=-1
    else sum=0
    let total=(parseInt(actual)+parseInt(sum))
    

    if(total>=max){
        alert('Máximo permitido alcanzado')
        return
    }
    
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    jQuery.get(ajaxurl, { 'action': 'sum_cart_qty',cart_item_key:cart_item_key,total:total}, 
    function (msg) { 
        populatecart();
    });
}


function populatecart(){
    jQuery.get(ajaxurl,
    {'action': 'fw_get_minicart'}, 
    function (datos) { 
        datos=jQuery.parseJSON(datos)
        let jqe=''
        let totals=datos['totals']
        console.log('totals',totals)
        let shipping_total=totals['shipping_total']
        let min=datos['min']
        let subtotal=parseFloat(totals['subtotal'])
        let total=parseFloat(totals['total'])//cart_contents_total
        let discount_total=parseFloat(totals['fee_total'])+parseFloat(totals['discount_total']);
        
        jQuery('.minicart .cant').text('('+datos['items']+')')
        jQuery.each(datos['cart'], function (index, value) {
            console.log(value)
            let precio=value['precio']
            let quantity=value['quantity']
            let extra=value['extra']
            let stock_status=value['stock_status']
            let maximum_quantity=value['maximum_quantity']

            let maxlabel='<small style="margin-left:20px;font-size:10px;display:none;" class="labelmax" >(Max:'+(maximum_quantity>1000?'+1000':maximum_quantity)+')</small>'
            let line_subtotal=value['line_subtotal']
            jqe+='<div class="row row-item-cart">'
            jqe+='<div class="col-2" style="padding:0px !important;text-align:center !important;"><img style="max-height:90px;" src="'+value['url']+'" class="img-cart"></div>'
            jqe+='<div class="col-6">'
            jqe+='<a target="_self" href="'+value['link']+'"><div class="titulo-producto-cart">'+value['nombre']+'</div></a>'
            jqe+='<div id="loadingshow_'+index+'" style="display:none;"><i  class="fa fa-circle-notch fa-spin" style="color:var(--main);" ></i></div>'
            jqe+='<div class="row d-flex justify-content-left item-cantidad " id="loadinghide_'+index+'">'
            //jqe+='<div class="item-sumar text-left align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',\'-'+value['quantity']+'\',\''+maximum_quantity+'\')" class="txt-22"><i class="fa fa-minus-circle"></i></a></div>'	
            jqe+='<input  type="text" style="width:40px;text-align:center;margin-left:10px;margin-right:10px;" id="qty_'+index+'" name="quantity" class="input-number" value="'+value['quantity']+'" min="1" max="100">'
            jqe+='<div class="item-restar align-self-center"><a href="#" onclick="addCant('+index+',\''+value['cart_item_key']+'\',\''+value['quantity']+'\',\''+maximum_quantity+'\')"  class="txt-22"> <i class="fa fa-redo"></i></a></div>'
            jqe+='<div class="item-restar align-self-center" style="margin-left:10px;"><a href="#" onclick="remove('+index+',\''+value['cart_item_key']+'\')"  class="txt-22"> <i class="fa fa-trash-alt" style="color:red;"></i></a>'+maxlabel+'</div>'
            jqe+='</div>'
            jqe+='</div><div class="col-4 precio-cart text-right">'
            jqe+='<span id="qtyx_'+index+'">'+quantity+'</span> x <span> $'+parseFloat(precio).toFixed(2)+'</span>'+'<?=fw_theme_mod('fw_show_taxrate')?'+IVA':''?>'+'<br>'
            jqe+='<span id="lineprice_'+index+'" data-price="'+parseFloat(precio*quantity).toFixed(2)+'"> $'+(parseFloat(precio*quantity).toFixed(2))+' </span>'+'<?=fw_theme_mod('fw_show_taxrate')?'+IVA':''?>'+'<br>'
            if(extra)jqe+='<span class="variation-fw_extra"><p>'+extra+'</p></span>'
            if(stock_status)jqe+='<span class="variation-fw_extra stock"><p>'+stock_status+'</p></span>'
            jqe+='</div></div>'
        });
        jqe+='<div id="loadinghide_totals"   class="row total" style="padding-top:0.5em;">'
        jqe+='<div  id="totals" class="col-6 col-md-8" data-min="'+min+'" data-subtotal="'+subtotal+'" class="col-6 col-md-8">Subtotal</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+subtotal+'<?=fw_theme_mod('fw_show_taxrate')?'+IVA':''?>'+'</span></span></div>'
        if(typeof discount_total == 'number' && (discount_total>0 || discount_total<0) ){
            jqe+='<div class="col-6 col-md-8">'+'<?=__( 'Discount', 'fastway' )?>'+'</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+parseFloat(discount_total).toFixed(2)+'</span></span></div>'
            if(discount_total>0)discount_total=discount_total*-1
            if(subtotal+discount_total)jqe+='<div class="col-6 col-md-8">TOTAL</div><div class="col-6 col-md-4 text-right"><span id="order-cost"><span id="total">$'+parseFloat(subtotal+discount_total).toFixed(2)+'</span></span></div>'
        }
        jqe+='</div>'
        if(subtotal>0){
            jQuery('#modal_carrito .container').html(jqe);
        }else{
            jQuery('#modal_carrito .container').html('<?=fw_theme_mod('fw_label_no_hay')?>');
        }
    });
}

function remove(index,cart_item_key){
    jQuery('#modal_carrito .container').html('<i class="fas fa-circle-notch fa-spin" ></i>');
    jQuery.get(ajaxurl,
    {'action': 'cart_remove_item',cart_item_key:cart_item_key}, 
    function (msg) { 
        populatecart();
    });
}
</script>