<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'fastway' ) );
	return;
}

?>
<script>
jQuery(document).ready(function() {
  jQuery(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
if (typeof wc_tokenization_form_params === 'undefined')wc_tokenization_form_params=null



var logged=false;
var paso = 1;
</script>
<?php if(is_user_logged_in()){ ?>
<script>
  paso=2
  logged=true
</script>
<?php } ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout fw_checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" novalidate="novalidate">
    <div class="col-lg-8 col-sm-12">
      <div class="box-detail mostrar paso-loading" style="display:none;text-align:center;width:100%;"> 
            <div class="capsula ">
              <i class="fal fa-circle-notch fa-spin" style="color:var(--main);width:100%;font-size:80px !important;margin-bottom:50px;" aria-hidden="true"></i>
              <span><?=fw_theme_mod('fw_label_checkout_loading')?></span>
            </div>
      </div>
      <div class="box-detail paso-cuenta" >
        <div class="uno" style="display: <?=is_user_logged_in()?'none':'block'?>">
            <h1><span class="icon-paso">1</span><?=fw_theme_mod('fw_label_checkout_1')?></h1>
            <div class="cajamail"><input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="Ingresá un email valido" value="<?=wp_get_current_user()->user_email?>" autocomplete="email username"></div>
            <?php
              if(is_user_logged_in()){//saco la password si ya inicio sesión
                add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
                function custom_override_checkout_fields( $fields ) {
                    unset($fields['account']['account_password']);
                    unset($fields['account']['account_password-2']);
                    return $fields;
                }
              }
              $fields = $checkout->get_checkout_fields( 'account' );
              foreach ( $fields as $key => $field ) {
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
              }
              ?>
            <div class="login-btn">
            <span class="no_existe"><?=fw_theme_mod('fw_label_checkout_already')?></span><span class="existe">Este mail ya existe</span><a class="login" onclick="switchlogin()"><?=fw_theme_mod('fw_label_checkout_init')?></a>	
            </div>
              
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled><?=fw_theme_mod('fw_label_checkout_continuar')?></button>
            <div class="clear"></div>	

        </div>
        <div class="dos" style="display:none">
            <h1><span class="icon-paso">1</span><?=fw_theme_mod('fw_label_checkout_enter')?></h1>
            <div id="login" action="login" method="post">
                <input id="username" type="text" name="username" placeholder="Email o username">
                <input id="password" type="password" name="password" placeholder="Contraseña">
                <a class="lost" href="<?php echo wp_lostpassword_url(); ?>"><?=fw_theme_mod('fw_label_checkout_forgot')?></a>
                <p class="status"></p>
                <input class="submit_button boton" type="button" value="Login" onclick="fw_login()" name="submit">
                <div class="submit_button loading" style="display:none;"><i class='fas fa-circle-notch fa-spin'></i></div>
                <?php wp_nonce_field( 'ajax-login-nonce', 'security'); ?>
            </div>

            <div class="login-btn"><?=fw_theme_mod('fw_label_checkout_already_not')?> <a class="registro" onclick="switchlogin()"><?=fw_theme_mod('fw_label_checkout_back')?></a></div>
            
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled><?=fw_theme_mod('fw_label_checkout_continuar')?></button>
            <div class="clear"></div>	
        </div>
        <div class="capsula box-step" style="display: <?=!is_user_logged_in()?'none':'block'?>">
            <a class="editar" style="display:<?=is_user_logged_in()?'none':'block'?>" onclick="editpaso(1)"><?=fw_theme_mod('fw_label_checkout_change')?></a>
            <a class="editar cerrar" style="display:<?=!is_user_logged_in()?'none':'block'?>"  onclick="fw_logout()"><?=fw_theme_mod('fw_label_checkout_close')?></a>
            <span class="icon"><i class="fa fa-check"></i></span>
            <span class="title"><?=fw_theme_mod('fw_label_checkout_1')?></span>
            <span class="subtitle" data-id=""><?=is_user_logged_in()?wp_get_current_user()->user_email:''?></span>	
        </div> 
      </div>

      <div class="box-detail paso-datos" style="display:<?=is_user_logged_in()?'block':'none';?>;">
          <h1><span class="icon-paso">2</span><?=fw_theme_mod('fw_label_checkout_2')?></h1>
          <div class="woocommerce-billing-fields">

            <?php /*SOLO EL LABEL*/ if('billing_only' !== get_option( 'woocommerce_ship_to_destination' )){?> <h3 class="billing_details_title"><?=fw_theme_mod('fw_label_checkout_datos_1');?></h3> <?php } ?>
            <div id="billing_form" class="woocommerce-billing-fields__field-wrapper">
              <?php
              $fields = $checkout->get_checkout_fields( 'billing' );
              foreach ( $fields as $key => $field ) {
                $valor=$checkout->get_value( $key );
                if($field['type']=='checkbox')$valor=false;
                woocommerce_form_field( $key, $field, $valor );
              }
              ?>
            </div>
            <div class="woocommerce-shipping-fields">
                <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
                  <h3 id="ship-to-different-address">
                    <p class="form-row w100 validate-required" id="fw_terms_checkbox_field" data-priority=""><span class="woocommerce-input-wrapper"><label class="checkbox ">
                      <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?=fw_theme_mod('fw_label_checkout_ship_to_other'); ?></span>
                    </p>
                  </h3>
                  <div class="shipping_address">
                    <?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>
                      <h3><?=fw_theme_mod('fw_label_checkout_datos_2');?></h3>
                    <div class="woocommerce-shipping-fields__field-wrapper">
                      <?php
                      $fields = $checkout->get_checkout_fields( 'shipping' );
                      foreach ( $fields as $key => $field ) woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                      ?>
                    </div>
                    <?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>
                  </div>
                <?php endif; ?>
            </div>
            <?php 

            $fields = $checkout->get_checkout_fields( 'order' );
            foreach ( $fields as $key => $field ) {
              woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
            }
            if(fw_theme_mod('fw_terms_required')){
              $ja='<span class="fw_terms" >'.fw_theme_mod('fw_label_terms_acepto').'<a style="color:#4D96EC" target="_blank" href="'.esc_url( get_permalink( wc_terms_and_conditions_page_id() )).'"> '.fw_theme_mod('fw_label_terms_name').'</a></span>  ';
              woocommerce_form_field( 'fw_terms_checkbox', array(
                  'type'          => 'checkbox',
                  'label'         => $ja,
                  'class'  =>      ['w100'],
                  'required'  => true,
              ), $checkout->get_value( 'fw_terms_checkbox' ));
            } 
            ?>
          </div>

          <div class="capsula box-step" style="display:none;">
						<a class="editar" onclick="editpaso(2)"><?=fw_theme_mod('fw_label_checkout_change')?></a>
						<span class="icon"><i class="fa fa-check"></i></span>
						<span class="title"><?=fw_theme_mod('fw_label_checkout_2')?></span>
						<span class="subtitle" data-id=""></span>					
          </div> 
          <button type="button" onclick="nextpaso()" class="btn-checkout continuar" disabled><?=fw_theme_mod('fw_label_checkout_continuar')?></button>
          <div class="clear"></div>	
      </div>
      <?php if(get_option('woocommerce_ship_to_countries')!='disabled'){  ?>
      <div class="box-detail paso-shipping" style="display:none;">
            <h1><span class="icon-paso">2</span><?=fw_theme_mod('fw_label_checkout_3')?>
            <small><?=fw_theme_mod('fw_label_checkout_desc')?></small></h1>
            
            <?php wc_get_template(	'checkout/shipping-order-review.php'); ?>

            <div class="capsula box-step" style="display:none;">
              <a class="editar" onclick="editpaso(3)"><?=fw_theme_mod('fw_label_checkout_change')?></a>
              <span class="icon"><i class="fa fa-check"></i></span>
              <span class="title"><?=fw_theme_mod('fw_label_checkout_3')?></span>
              <span class="subtitle" data-id=""></span>					
            </div>
            <button type="button" onclick="nextpaso()" class="btn-checkout continuar shipping" disabled><?=fw_theme_mod('fw_label_checkout_continuar')?></button>
            <div class="clear"></div>	
      </div>
      <?php } ?>
        
       
      <div class="box-detail paso-pagos" style="display:none;">
            <h1><span class="icon-paso">3</span><?=fw_theme_mod('fw_label_checkout_4')?>
            <small><?=fw_theme_mod('fw_label_checkout_desc')?></small></h1>
            
            <?php woocommerce_checkout_payment() ?>

            <div class="capsula box-step" style="display:none;">
              <a class="editar" onclick="editpaso(4)"><?=fw_theme_mod('fw_label_checkout_change')?></a>
              <span class="icon"><i class="fa fa-check"></i></span>
              <span class="title"><?=fw_theme_mod('fw_label_checkout_4')?></span>
              <span class="subtitle" data-id=""></span>					
            </div>

            <button type="button" onclick="nextpaso()" class="btn-checkout continuar pagos" disabled><?=fw_theme_mod('fw_label_checkout_continuar')?></button>
        </div>
        
      </div>
            
    <div class="col-lg-4  col-sm-12 order-container" >
      </form>
        <?php if ( 'yes' === get_option( 'woocommerce_enable_coupons' ) ) { ?>
          <?php if ( fw_theme_mod('fw_hide_coupon')  ) { ?>
            <div class="cupones ">
              <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
                <p class="form-row form-row-first">
                  <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" style="width:70%;display:inline;"/>
                  <button type="submit" class="button" name="apply_coupon"   style="width:30%;"><?=fw_theme_mod('fw_label_checkout_aplicar')?></button>
                </p>
                <div class="clear"></div>
              </form>
            </div>
          <?php } ?>
        <div class="totales">
        <div id="overlay"></div>
        <?php } ?>
        <?php woocommerce_order_review() ?>

        <div class="cart-form-actions">

            <a href="<?=wc_get_cart_url()?>"><?=fw_theme_mod('fw_label_agregar_mas')?></a>
            <button type="submit" class="btn-checkout finalizar" disabled style="display:none">
              <?=fw_theme_mod('fw_place_order_text')?>
            </button>
        </div>

        <div class="cart-form-desc">
           <p><?=fw_theme_mod('checkout-msg')?></p>
        </div>
        <?php 
    $haybacks=false;
    
    if(get_option('woocommerce_manage_stock')==='yes'){
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        if($_product->get_stock_status()=='onbackorder')$haybacks=true;
      }
    }
    if($haybacks){ 
      ?>
        <div class="cart-form-desc">
           <p>Hay productos de tu carrito de los cuales no contamos en inventario actualmente. Mediante el pago estas realizando una reserva de los mismos y nos comunicaremos con vos ni bien lo tengamos en stock.</p>
        </div>
     <?php } ?>
     <div class="row place-order"> 
            <noscript>
              <?php
              printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
              ?>
              <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
            </noscript>
            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>
            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>

        </div>
    </div>


</form>
<script>
var shippingLabel=''
var pagosLabel=''

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function fw_logout(){
    confirm("Se perderán los datos del carrito. Desea continuar?");
    jQuery.ajax({
          type: 'POST',
          url:ajaxurl,
          data: { 
              action: 'fw_ajax_logout'
          },
          success: function(){
            window.location.reload()
          }
      });
}
function fw_login(){
    if(!jQuery('#login #username').val() || !jQuery('#login #password').val())return
    jQuery('.submit_button.boton').hide()
    jQuery('.submit_button.loading').show()
    jQuery.ajax({
          type: 'POST',
          dataType: 'json',
          url:ajaxurl,
          data: { 
              action: 'fw_ajax_login', //calls wp_ajax_nopriv_ajaxlogin
              username: jQuery('#login #username').val(), 
              password: jQuery('#login #password').val(), 
              security: jQuery('#login #security').val() 
          },
          success: function(data){
            if(data && data.loggedin){
              jQuery('#login .status').html('<span style="color:green;" >Login exitoso!</span>') 
              window.location.reload()
            }else{
              jQuery('.submit_button.boton').show()
              jQuery('.submit_button.loading').hide()
              jQuery('#login .status').html('<span style="color:red;" >Login incorrecto</span>') 
            }
          }
      });
}

function getDataEmail(email){
  return jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url:ajaxurl,
      data: { 
          action: 'fw_ajax_email_exists', //calls wp_ajax_nopriv_ajaxlogin
          email: email,
      }});
}

async function emailExists(email){

  let verifEmail='<?=fw_theme_mod('fw_client_admin_verificaremail')?>';
  if(!verifEmail || !email || logged)return;
  
  try {
    jQuery('.btn-checkout.continuar').prop('disabled', true);
    const data = await getDataEmail(email)
    console.log(email)

    if(data.result){
          console.log('Existe!')
          jQuery('.no_existe').hide();
          jQuery('#account_password').hide();
          jQuery('.existe').show();
          jQuery('.btn-checkout.continuar').prop('disabled', true);
      }else{
          jQuery('.existe').hide();
          jQuery('#account_password').show();
          jQuery('.no_existe').show();
          jQuery('.btn-checkout.continuar').prop('disabled', false);
      }
  } catch(err) {
    console.log(err);
  }
}
function verificarEmail(num){
  let email=jQuery('#billing_email').val()
  let e_valid= isEmail(email)
  if(!e_valid){
    jQuery('#billing_email').addClass('enrojo')
  }else{
    jQuery('.paso-cuenta .box-step .subtitle').text(email)
    jQuery('#billing_form #billing_email').val(email);
    jQuery('#billing_email').removeClass('enrojo')
  }
  let pass=jQuery('#account_password').length
  let p_valid=false
  if(pass){
   // console.log('campo pass SI existe',e_valid)
    p_valid=jQuery('#account_password').val() && jQuery('#account_password').val().length>=6
    if(!p_valid){
      jQuery('#account_password').addClass('enrojo')
    }else{
      jQuery('#account_password').removeClass('enrojo')
    }
    sacar1(!e_valid || !p_valid,8)
  }else{
    //console.log('campo pass NO existe',e_valid)
    sacar1(!e_valid ,9)
  }
  
  emailExists(email);
}

function verificarFields(first=false,cuando){
  console.log('entra',cuando)
  var disable=false

  jQuery('#billing_form input').each(function(index,data) {
    var element = jQuery(this);
    let type=element.attr('type')
    let req=type!='checkbox'?element.parent().parent().hasClass('validate-required'):element.parent().parent().parent().hasClass('validate-required')

    //rellena
    if(!first)jQuery.cookie(element.attr('id'), jQuery('#'+element.attr('id')).val());
    else if(jQuery.cookie(element.attr('id')))element.val(jQuery.cookie(element.attr('id')))
  
    if (req && type!='checkbox' && element.val() == "") {
      disable = true;
      element.addClass('enrojo')
    }else if (req && type=='checkbox' && !element.is(":checked")) {
      disable = true;
      element.addClass('enrojo')
    }else{
      element.removeClass('enrojo')
    }
  });

  if(!disable){
    let mailing=jQuery('#billing_address_1').val()
    if(!mailing)mailing=jQuery('#billing_first_name').val()
    jQuery('.paso-datos .box-step .subtitle').text(mailing)
  }
  sacar1(disable,4)
}
function unselect(type){
  jQuery('input:radio[name="'+type+'"]').each(function () { 
    jQuery(this).prop('checked', false);
    jQuery(this).parent().removeClass('active')
  });
  sacar1(true,5)
}
jQuery(document).ready( function(jQuery) {


	jQuery('.extras_shipping').hide();
	jQuery('.extras_payment').hide();
  //Cupones
  jQuery('.checkout_coupon').show()
  
  //Resets
  unselect('shipping_method[0]')
  unselect('payment_method')

  verificarEmail(2);
  verificarFields(true,1);

  jQuery('#billing_email').on('input', function(e){
    verificarEmail(3);
  })
  jQuery('#account_password').on('input', function(e){
    verificarEmail(4);
  })

  jQuery('#billing_form input').on('input', function(e){
    console.log(e)
    verificarFields(false,2);
  })
  

  // Login
  jQuery('a#show_login').on('click', function(e){
      jQuery('body').prepend('<div class="login_overlay"></div>');
      jQuery('#login').fadeIn(500);
      jQuery('div.login_overlay, #login a.close').on('click', function(){
        jQuery('div.login_overlay').remove();
        jQuery('#login').hide();
      });
  });

  
})


function editpaso(ppaso){
  let type=''
  if(ppaso==1){//
    resetStep('cuenta')
    jQuery('.paso-cuenta').show()
    resetStep('datos')
    resetStep('shipping')
    resetStep('pagos')
    verificarEmail(1)
    paso=1
  }else if(ppaso==2){//shipping
    resetStep('datos')
    jQuery('.paso-datos').show()
    resetStep('shipping')
    resetStep('pagos')
    verificarFields(false,3)
    paso=2
  }else if(ppaso==3){
    resetStep('shipping')
    jQuery('.paso-shipping').show()
    resetStep('pagos')
    paso=3
  }else if(ppaso==4){
    resetStep('pagos')
    jQuery('.paso-pagos').show()
    paso=4
  }
  console.log('entra')
  

}
function resetStep(type){

  jQuery('.paso-'+type).hide()
  jQuery('.paso-'+type+' div:not(.box-step)').show()
  jQuery('.paso-'+type+' .dos').hide()//Nunca se da porq e otro cierra sesion
  jQuery('.paso-'+type+' .box-step').hide()
  if(!jQuery('#' + 'ship-to-different-address-checkbox').is(":checked"))jQuery('.paso-'+type+' .shipping_address').hide()
  jQuery('.paso-'+type+' .box-step').removeClass('efecto')
  jQuery('.paso-'+type+' h1').show()
  jQuery('.paso-'+type+' button').show()
  //jQuery('.btn-checkout.continuar').show()
  jQuery('.btn-checkout.finalizar').hide()
  if(type=='shipping'){
    unselect('shipping_method[0]')
    unselect('payment_method')
  }else if(type=='pagos'){
    unselect('payment_method')
  }
    unselect('shipping_method[0]')
    unselect('payment_method')
}

function fillNextStep(type){
  jQuery('.paso-'+type+' .box-step').show()
  jQuery('.paso-'+type+' .box-step').addClass('efecto')
  jQuery('.paso-'+type+' div:not(.box-step)').hide()
  jQuery('.paso-'+type+' h1').hide()
  jQuery('.paso-'+type+' button').hide()
}
function sacar1(estado,msg){
    //console.log(estado,msg)
    jQuery('.btn-checkout.continuar').prop('disabled', estado);
}
function nextpaso(){
  paso++
  if(paso==2){
    fillNextStep('cuenta')
    jQuery('.paso-datos').show()
    verificarFields(false,4);

  }else if(paso==3){
    fillNextStep('datos')
    unselect('shipping_method[0]')
    jQuery('.paso-shipping').show()
    sacar1(true,1)

    if(paso==3 && '<?=!hasShipping()?>'){//sin envios
      jQuery(document.body).trigger("update_checkout"); 
      nextpaso()
    }

  }else if(paso==4){
    if(jQuery('select[name="_shipping_method_pickup_location_id[0]"').length>0 && jQuery('#shipping_method_0_local_pickup_plus').prop("checked")){//si esta activo local pickups
      let sucnumber=jQuery('select[name="_shipping_method_pickup_location_id[0]"').val()
  
      if(!sucnumber){
        alert('Falta seleccionar sucursal')
        paso--
        return
      }
    }
    fillNextStep('shipping')
    jQuery('.paso-pagos').show()
    sacar1(true,2)
    
  }else if(paso==5){
   /* if(jQuery('#payment_method_stripe').prop("checked")){//si esta activo local pickups
      let p=jQuery('iframe[name="__privateStripeFrame6"]').contents().attr('class')
      console.log(p)

      let pusolataj=jQuery('form.ElementsApp').hasClass('is-complete')
      if(!pusolataj){
        alert('Falta ingresar datos de tarjeta')
        paso--
        return
      }
    }*/

    fillNextStep('pagos')
    jQuery('.btn-checkout.finalizar').prop('disabled', false);
    jQuery('.btn-checkout.finalizar').show()

  }
 
}
function switchlogin(){
    jQuery('.paso-cuenta .uno').toggle()
    jQuery('.paso-cuenta .dos').toggle()
}

var envioSeleccionado=0
function checkpostalCode(){
  if(jQuery('#billing_postcode').length && !jQuery('#billing_postcode').val()){
    var msg = window.prompt("Complete su código postal para poder calcular su envío", "");
    jQuery('#billing_postcode').val(msg)
  }
}
function resetShippingFake(){
  let subt=jQuery('.cart-subtotal bdi').text()
  let tot=jQuery('.order-subtotal bdi').text()
  if(paso<3 && subt!=tot){jQuery('.order-total').hide()
  }else {
    jQuery('.order-total').show()
  }
  //jQuery('.order-total bdi').text(jQuery('.cart-subtotal bdi').text())
}

jQuery(document).on('updated_checkout', function(){
  //updateEnvioGratisME();
  setTodopago();
  //zippinCambiar();
  resetShippingFake();
  //setEpostnet();
  shippingGroups();
	if(envioSeleccionado>0)jQuery('.shipping-total').attr("style", "display: table-row")
  else jQuery('.shipping-total').attr("style", "display: none")

  //Verificar all!
  verificarEmail();
  if(paso>1)verificarFields(false,5);
  if(paso==4 && jQuery("input[name='payment_method']").is(':checked')){
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}else if(paso==3 && jQuery("input[name='shipping_method[0]']").is(':checked')){
		jQuery('.btn-checkout.continuar.shipping').prop('disabled', false);
		jQuery('.btn-checkout.continuar.pagos').prop('disabled', false);
	}
});

function zippinCambiar(){
    var element=jQuery('.shipping.zippin .title');
		if(jQuery('.shipping.zippin').data('costo')==0){
				element.text('Entrega GRATIS por correo a domicilio');
        element.addClass('mercadoenvios-shipping free');
		}else{
				element.text('Entrega por correo a domicilio');
				
		}
}


function setTodopago(){
  let litp=jQuery(document).find(`[data-radio="todopago"]`)
  let img='<img class="imgtp" width="100" src="/wp-content/themes/fastway/assets/img/ahora3y6tp.png"/>'
  if(!litp.find('img.imgtp').length)jQuery('#payment_method_todopago').after(img)
  let label='<?=fw_theme_mod('fw_checkout_todopago_label')?>'
  let desc='<?=fw_theme_mod('fw_checkout_todopago_desc')?>'
  if(label)litp.find('.title').text(label)
  if(desc)litp.find('small').text(desc)
}
function setEpostnet(){
  let litp=jQuery(document).find(`[data-radio="spyr_firstdata_gateway"]`)
  let label='<?=fw_theme_mod('fw_checkout_eposnet_label')?>'
  let desc='<?=fw_theme_mod('fw_checkout_eposnet_desc')?>'
  if(label)litp.find('.title').text(label)
  if(desc)litp.find('small').text(desc)

  var ccheckbox = jQuery('#installment_itemdiv input[type=radio]');
  var llabels = jQuery('#installment_itemdiv span');
  var sselect = jQuery('<select id="_multiplepayment" name="_multiplepayment"></select>'); 
  sselect.attr('name',ccheckbox.attr('name'));
      
  ccheckbox.each(function(i, checkbox){
      var str= ccheckbox.eq(i).val();
      var sm= llabels.eq(i).text();
    sselect.append(jQuery('<option>').val(str).text(sm) );
  });
  let input1=jQuery('<input id="_installmentpaymet" type="hidden" name="_fullpaymet" value="multiplepayment">')
  jQuery('#_installmentpaymet').prop("checked", true);
  jQuery('.payment_method_spyr_firstdata_gateway .extras div').replaceWith(sselect)

}
function updateflete(){

  let buscar="label:contains('Radio de 10km (Canning)')"
  var element =jQuery(buscar);
  if(element){
    jQuery( "<br><b>Fletes:</b>" ).insertBefore( element.closest('li') );

  }
  buscar="label:contains('Munro')"
  element =jQuery(buscar);
  if(element){
    jQuery( "<br><b>Otros:</b>" ).insertAfter( element.closest('li') );

  }
}
/*
if(jQuery('input#billing_ship_to_different_address').length>0){
    jQuery('input#billing_ship_to_different_address').change(function(){
      if (this.checked) {
          jQuery('#shipping_form').removeClass('d-none');
      } else {
          jQuery('#shipping_form').addClass('d-none');
      }
        
    });
}
*/


/*
function updateEnvioGratisME(){
    //Cambio el label a mercadoenvios gratis
    let dias=['(2-4 días)','(1-3 días)','(3-5 días)','(6-8 días)','(5-7 días)'];
    let tipos=['Envió Estándar','Envió Gratis'];
    for(let j in tipos){
      let label=tipos[j];
      for(let i in dias){
        let freecuando=dias[i]
        let buscar="label:contains('"+label+" "+freecuando+"')"
        var element =jQuery(buscar);
        if(element && label==tipos[1]){  
          element.text('Envio Gratis Por Correo A Domicilio '+freecuando+'');
          element.addClass('mercadoenvios-shipping free');
        }else if(element && label==tipos[0]){  
          element.html('<span class="title">Correo a domicilio '+freecuando+'</span><small style="display:inline;"> * Pagando con mercadopago</small>');
          element.addClass('mercadoenvios-shipping ');
        }
      }
    }
}*/

function shippingGroups(){
  let shippingGroups='<?=fw_theme_mod('fw_shipping_groups');?>';
	if(shippingGroups && jQuery('.woocommerce-shipping-methods li.local_pickup').length>1){
    let topLabel='<?=fw_theme_mod('fw_label_shipping_grouptitle');?>';
    let descLabel='<?=fw_theme_mod('fw_label_shipping_groupdesc');?>';
    jQuery('.paso-shipping').addClass('groupping')
    jQuery('.woocommerce-shipping-methods li.local_pickup').hide()
    if(!jQuery('.capsula.shipping.group').length)jQuery('.woocommerce-shipping-methods').prepend('<li class="capsula shipping group"><input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup2" value="local_pickup:2" class="shipping_method"><label for="shipping_method_0_local_pickup2" class="title">'+topLabel+'</label><small class="costo">'+descLabel+'</small></li>');
	}
}
jQuery(document).on('click', function(e) {
	var target = jQuery( event.target );
	if(!target.is( "li" ))target=target.parent()
	if(!target.is( "li" ))return;
	
	if(target.is( "li" ) && target.hasClass( "shipping" ) && target.hasClass( "group" )){
    jQuery('.paso-shipping').addClass('inside')
		e.preventDefault()
	}else if(target.is( "li" ) && target.hasClass( "shipping" )){
		//console.log('entra-shipping')
		target.find('input:radio').prop("checked", true);
		seleccionarEnvio(target)
	}else if(target.is( "li" ) && target.hasClass( "payment" )){
		//console.log('entra-payment')
		target.find('input:radio').prop("checked", true);
		seleccionarPago(target)
	}
});

function seleccionarPago(capsula){
	
  console.log('trigger 1')
  jQuery(document.body).trigger("update_checkout");
  shippingGroups()
	jQuery('li.capsula.payment').removeClass("active");
	capsula.addClass('active');


	jQuery('.extras_payment').hide();
	jQuery('.active .extras_payment').show();

	let label=capsula.data('label')
	jQuery('.paso-pagos .box-step .subtitle').text(label)
	
}

function seleccionarEnvio(capsula){

  console.log('trigger 2')
  jQuery(document.body).trigger("update_checkout");
  shippingGroups()
  
	envioSeleccionado=capsula.data('costo')
	jQuery('li.capsula.shipping').removeClass("active");capsula.addClass('active');


	jQuery('.extras_shipping').hide();
	jQuery('.active .extras_shipping').show();

	
	let label=capsula.data('label')+' '+(capsula.data('costo')>0?'$'+capsula.data('costo'):'')

	jQuery('.paso-shipping .box-step .subtitle').data('id',capsula.data('value'))
	jQuery('.paso-shipping .box-step .subtitle').text(label)
	
}


</script>