<?php 

if(is_admin())add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );

function prefix_add_dashboard_widget() {
   
    if(fw_theme_mod('fw_widget_estado')){
        wp_add_dashboard_widget(
            'fw_widget_estado', 
            __('Site Status','fastway'), 
            'fw_widget_estado_dash', 
            'fw_widget_estado_dash_handler'
        );
    }
    if(fw_theme_mod('fw_currency_conversion')){
        wp_add_dashboard_widget(
            'fw_currency_widget', 
            __('Currency Conversion','fastway'), 
            'fw_dash_conversion', 
            'fw_dash_conversion_handler'
        );
    }
    if(fw_theme_mod('fw_widget_lili_discount')){
        wp_add_dashboard_widget(
            'fw_widget_lili_discount', 
            __('Lili Discount','fastway'), 
            'fw_widget_lili_discount_dash', 
            'fw_widget_lili_discount_dash_handler'
        );
    }

    if(fw_theme_mod('fw_widget_talles_vonder')){
        wp_add_dashboard_widget(
            'fw_widget_talles_vonder', 
            __('Talles','fastway'), 
            'fw_widget_talles_vonder_dash', 
            'fw_widget_talles_vonder_dash_handler'
        );
    }

    if(fw_theme_mod('fw_widget_desc_prods')){
        wp_add_dashboard_widget(
            'fw_widget_desc_prods', 
            __('Product Discount','fastway'), 
            'fw_widget_desc_prods_dash', 
            'fw_widget_desc_prods_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_popup')){
        wp_add_dashboard_widget(
            'fw_widget_popup', 
            __('Popup','fastway'), 
            'fw_widget_popup_dash', 
            'fw_widget_popup_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cupones')){
        wp_add_dashboard_widget(
            'fw_widget_cupones', 
            __('Coupons','fastway'), 
            'fw_widget_cupones_dash', 
            'fw_widget_cupones_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cuotas_tp')){
        wp_add_dashboard_widget(
            'fw_widget_cuotas_tp', 
            __('Todopago Installments','fastway'), 
            'fw_widget_cuotas_tp_dash', 
            'fw_widget_cuotas_tp_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cuotas_general')){
        wp_add_dashboard_widget(
            'fw_widget_cuotas_general', 
            __('Installments','fastway'), 
            'fw_widget_cuotas_general_dash', 
            'fw_widget_cuotas_general_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_mensaje_barra')){
        wp_add_dashboard_widget(
            'fw_widget_mensaje_barra', 
            __('Important Message','fastway'), 
            'fw_widget_mensaje_barra_dash', 
            'fw_widget_mensaje_barra_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_popup_unload')){
        wp_add_dashboard_widget(
            'fw_widget_popup_unload', 
            __('Antes de Salir','fastway'), 
            'fw_widget_popup_unload_dash', 
            'fw_widget_popup_unload_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_mensaje_sec')){
        wp_add_dashboard_widget(
            'fw_widget_mensaje_sec', 
            __('Secondary Message','fastway'), 
            'fw_widget_mensaje_sec_dash', 
            'fw_widget_mensaje_sec_dash_handler'
        );
    }
}

function fw_widget_popup_dash(){
    $estado=fw_theme_mod('fw_popup_type');
    $color=$estado=='off'?'red':'green';
    if($estado!='off') $estado=($estado=='html')?'Newsletter':'Imagen';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $l_label=__('Change','fastway');
    $l_estado=__('Status','fastway');
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$l_estado: $estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_popup#fw_widget_popup">$l_label</a>
    </div>
HTML;
}


function fw_widget_popup_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_popup_options' ) )$widget_options = array( );

    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_popup_options'] ) ) {

        $estado = ( $_POST['fw_widget_popup_options']['estados'] );
        $widget_options['urlimg'] = ( $_POST['fw_widget_popup_options']['urlimg'] );
        $widget_options['link'] = ( $_POST['fw_widget_popup_options']['link'] );

        if($estado=='html')set_theme_mod('fw_popup_form_mode',true);
        else set_theme_mod('fw_popup_form_mode',false);

        set_theme_mod('fw_popup_type',$estado);
        set_theme_mod('fw_popup_img',$widget_options['urlimg']);
        set_theme_mod('fw_popup_link',$widget_options['link']);
        
    }

    if( !isset( $widget_options['estados'] ) )$widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>Tipo</label>
         <select name=\"fw_widget_popup_options[estados]\" id=\"estados\">
            <option value=\"off\">".__('Disabled','fastway')."</option> 
            <option value=\"image\">".__('Image','fastway')."</option>
            <option value=\"html\">".__('Newsletter','fastway')."</option>
         </select><br>

        <label>URL img: <input type=\"text\" name=\"fw_widget_popup_options[urlimg]\" id=\"urlimg\" value=\"".fw_theme_mod('fw_popup_img')."\"><br>
        <small>*".__('Copy the image url,you can get it from the <a target=\"_blank\" href=\"/wp-admin/upload.php\">gallery</a>. You can also copy for example a GIF from its url on <a href="https://giphy.com/create/gifmaker">giphy</a>')."<br>
        <label>".__('URL to link').":<input type=\"text\" name=\"fw_widget_popup_options[link]\" id=\"link\" value=\"".fw_theme_mod('fw_popup_link')."\"><br>
        *".__('If empty, it will not redirect on click')."</small><br><br>
      </div>";
}






function fw_widget_cupones_dash(){
    $estado=get_option('woocommerce_enable_coupons')==='yes'?__('Active','fastway'):__('Inactive','fastway');
    $color=$estado==__('Active','fastway')?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cupones#fw_widget_cupones">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_cupones_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_cupones_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD']/* && isset( $_POST['fw_widget_cupones_options'] )*/) {
        $ess='no';
        if($_POST['fw_widget_cupones_options']) $ess='yes';
        update_option( 'woocommerce_enable_coupons',  $ess);
    }
    
    $estado=get_option('woocommerce_enable_coupons')==='yes'?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";

    echo "<div>
        <label>".__('Status','fastway')." <input type=\"checkbox\" name=\"fw_widget_cupones_options[estado]\" id=\"estado\" ".$estado." ></label><br>
    </div><br>";
}



function fw_widget_desc_prods_dash(){

    $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_product_discount_categories')?fw_theme_mod('fw_product_discount_categories'):__('All products','fastway'));
    $estado=__('Status','fastway').': '.(fw_theme_mod('fw_product_discount')?__('Active','fastway'):__('Inactive','fastway'));
    $color=$estado==__('Active','fastway')?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_product_discount_percentage'));
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$estado</label><br>
        <label>$cates</label><br>
        <label>$porcentage </label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_desc_prods#fw_widget_desc_prods">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_desc_prods_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_desc_prods' ) )$widget_options = array();
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_desc_prods'] ) ) {
        set_theme_mod('fw_product_discount',$_POST['fw_widget_desc_prods']['estado']);
        set_theme_mod('fw_product_discount_percentage',$_POST['fw_widget_desc_prods']['percentage']);
        set_theme_mod('fw_product_discount_categories',$_POST['fw_widget_desc_prods']['categories']);
    }

    $estado=fw_theme_mod('fw_product_discount')?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";

    echo "
    <div>
    <label>".__('Status','fastway').": <input type=\"checkbox\" name=\"fw_widget_desc_prods[estado]\" id=\"estado\" ".$estado." ></label><br>
    <label>".__('Categories','fastway').": <input type=\"text\" name=\"fw_widget_desc_prods[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_product_discount_categories')."\"><br>
    <small>*".__('If empty, aplies to all products','fastway')."</small><br>
    <label>".__('Discount (%)','fastway').":<input type=\"number\" name=\"fw_widget_desc_prods[percentage]\" id=\"percentage\" placewholder=\"Ej: 20\" value=\"".fw_theme_mod('fw_product_discount_percentage')."\"><br>
    <small>".__('For more info: <a href=\"https://altoweb.freshdesk.com/a/solutions/articles/36000234206\">click here</a>','fastway')."<br>
    </div><br>";
}




function fw_widget_lili_discount_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_lili_discount_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_lili_discount_options'] ) ) {
        //Logica save
        set_theme_mod('fw_lili_discount',$_POST['fw_widget_lili_discount_options']['estado']);
        set_theme_mod('fw_lili_discount_categories',$_POST['fw_widget_lili_discount_options']['categories']);
        set_theme_mod('fw_lili_discount_cant',$_POST['fw_widget_lili_discount_options']['cant']);
        set_theme_mod('fw_lili_discount_label',$_POST['fw_widget_lili_discount_options']['label']);
        set_theme_mod('fw_lili_discount_percentage',$_POST['fw_widget_lili_discount_options']['percentage']);
        set_theme_mod('fw_lili_discount_cupones',$_POST['fw_widget_lili_discount_options']['cupones']);

    }
    
    if(fw_theme_mod('fw_widget_lili_discount_multi')){

        if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_lili_discount_options_2'] ) ) {
            //Logica save
            set_theme_mod('fw_lili_discount_2',$_POST['fw_widget_lili_discount_options_2']['estado']);
            set_theme_mod('fw_lili_discount_categories_2',$_POST['fw_widget_lili_discount_options_2']['categories']);
            set_theme_mod('fw_lili_discount_cant_2',$_POST['fw_widget_lili_discount_options_2']['cant']);
            set_theme_mod('fw_lili_discount_label_2',$_POST['fw_widget_lili_discount_options_2']['label']);
            set_theme_mod('fw_lili_discount_percentage_2',$_POST['fw_widget_lili_discount_options_2']['percentage']);
            set_theme_mod('fw_lili_discount_cupones_2',$_POST['fw_widget_lili_discount_options_2']['cupones']);
    
        }

        if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_lili_discount_options_3'] ) ) {
            //Logica save
            set_theme_mod('fw_lili_discount_3',$_POST['fw_widget_lili_discount_options_3']['estado']);
            set_theme_mod('fw_lili_discount_categories_3',$_POST['fw_widget_lili_discount_options_3']['categories']);
            set_theme_mod('fw_lili_discount_cant_3',$_POST['fw_widget_lili_discount_options_3']['cant']);
            set_theme_mod('fw_lili_discount_label_3',$_POST['fw_widget_lili_discount_options_3']['label']);
            set_theme_mod('fw_lili_discount_percentage_3',$_POST['fw_widget_lili_discount_options_3']['percentage']);
            set_theme_mod('fw_lili_discount_cupones_3',$_POST['fw_widget_lili_discount_options_3']['cupones']);
    
        }


    }

    echo "<div style='margin-top:20px;'>
        <label>".__('Status','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options[estado]\" id=\"estado\" ".(fw_theme_mod('fw_lili_discount')?"checked=\"true\"":"")." ></label><br>
        <label>".__('Name','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options[label]\" id=\"label\" value=\"".fw_theme_mod('fw_lili_discount_label')."\"><br>
        <label>".__('Applies to','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_lili_discount_categories')."\"><br>
        <label>".__('Allows coupons','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options[cupones]\" id=\"cupones\" ".(fw_theme_mod('fw_lili_discount_cupones')?'checked':'')." ></label><br>
        <label>".__('Quantity','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options[cant]\" id=\"cant\" value=\"".fw_theme_mod('fw_lili_discount_cant')."\"><br>
        <label>".__('Discount (%)','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options[percentage]\" id=\"percentage\" value=\"".fw_theme_mod('fw_lili_discount_percentage')."\"><br>
        <small>".__('Instructions','fastway').":<br>
    </div>";


    if(fw_theme_mod('fw_widget_lili_discount_multi')){

        echo "<div style='margin-top:20px;'>
            <label>".__('Status','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options_2[estado]\" id=\"estado\" ".(fw_theme_mod('fw_lili_discount_2')?"checked=\"true\"":"")." ></label><br>
            <label>".__('Name','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options_2[label]\" id=\"label\" value=\"".fw_theme_mod('fw_lili_discount_label_2')."\"><br>
            <label>".__('Applies to','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options_2[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_lili_discount_categories_2')."\"><br>
            <label>".__('Allows coupons','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options_2[cupones]\" id=\"cupones\" ".(fw_theme_mod('fw_lili_discount_cupones_2')?'checked':'')." ></label><br>
            <label>".__('Quantity','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options_2[cant]\" id=\"cant\" value=\"".fw_theme_mod('fw_lili_discount_cant_2')."\"><br>
            <label>".__('Discount (%)','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options_2[percentage]\" id=\"percentage\" value=\"".fw_theme_mod('fw_lili_discount_percentage_2')."\"><br>
            <small>".__('Instructions','fastway').":<br>
        </div>";

        echo "<div style='margin-top:20px;'>
            <label>".__('Status','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options_3[estado]\" id=\"estado\" ".(fw_theme_mod('fw_lili_discount_3')?"checked=\"true\"":"")." ></label><br>
            <label>".__('Name','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options_3[label]\" id=\"label\" value=\"".fw_theme_mod('fw_lili_discount_label_3')."\"><br>
            <label>".__('Applies to','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options_3[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_lili_discount_categories_3')."\"><br>
            <label>".__('Allows coupons','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options_3[cupones]\" id=\"cupones\" ".(fw_theme_mod('fw_lili_discount_cupones_3')?'checked':'')." ></label><br>
            <label>".__('Quantity','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options_3[cant]\" id=\"cant\" value=\"".fw_theme_mod('fw_lili_discount_cant_3')."\"><br>
            <label>".__('Discount (%)','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options_3[percentage]\" id=\"percentage\" value=\"".fw_theme_mod('fw_lili_discount_percentage_3')."\"><br>
            <small>".__('Instructions','fastway').":<br>
        </div>";

    }

    echo "
    <div style='margin-top:20px;'>
        1) ".__('For categories, it must be entered in the field, the category slug, which can be obtained in <a href=\'edit-tags.php?taxonomy=product_cat&post_type=product\'>categories</a> section (separated with \',\')','fastway')."<br> 
        2) ".__('Leave empty and it will apply to all categories','fastway')."<br> 
        3) ".__('Quantity is the minimum of the ratio. in the case of 3x2 it should be 3, and 2x1 should be 2','fastway')."<br>
        4) ".__('Discount always applies only to the cheapiests','fastway')."</small>
        </div>
    <br>";
}

function fw_widget_cuotas_tp_dash(){
    $cuotas =__('Max installments','fastway').':'.fw_theme_mod('fw_cuotas_todopago');
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$cuotas</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cuotas_tp#fw_widget_cuotas_tp">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_cuotas_tp_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_todopago_widget_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_todopago_widget_options'] ) ) {
        # minor validation
         $variable=( $_POST['fw_todopago_widget_options']['max_cuotas'] );
        $arra=get_option( 'woocommerce_todopago_settings' );
        $arra['max_cuotas']=$variable;
        update_option( 'woocommerce_todopago_settings', $arra );
        set_theme_mod('fw_cuotas_todopago',$variable);
    }

    if( !isset( $widget_options['fw_cuotas_todopago'] ) )$widget_options['fw_cuotas_todopago'] = fw_theme_mod('fw_cuotas_todopago');

    echo "
    <div>
        <label>Maximo cuotas sin interes</label>
        <input type=\"text\" name=\"fw_todopago_widget_options[max_cuotas]\" id=\"max_cuotas\" value=\"".fw_theme_mod('fw_cuotas_todopago')."\">
    </div>";
}



add_shortcode('fw_cuotas_general','fw_cuotas_general');
function fw_cuotas_general(){
    return fw_theme_mod('fw_cuotas_general');
}
function fw_widget_cuotas_general_dash(){
    $cuotas =__('Installments','fastway').': '.fw_theme_mod('fw_cuotas_general');
    $cambiar_l=__('Change','fastway');
    
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$cuotas</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cuotas_general#fw_widget_cuotas_general">$cambiar_l</a>
    </div>
HTML;
}

function fw_widget_cuotas_general_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_cuotas_general_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_cuotas_general_options'] ) ) {
        $cuotas=( $_POST['fw_widget_cuotas_general_options']['cuotas'] );
        set_theme_mod('fw_cuotas_general',$cuotas);
    }

    # set defaults  
    if( !isset( $widget_options['fw_cuotas_general'] ) )$widget_options['fw_cuotas_general'] = fw_theme_mod('fw_cuotas_general');

    echo "
    <div>
        <label>".__('Installments','fastway').': '."</label>
        <input type=\"text\" name=\"fw_widget_cuotas_general_options[cuotas]\" id=\"cuotas\" value=\"".fw_theme_mod('fw_cuotas_general')."\">
    </div>";
}

















function fw_widget_popup_unload_dash(){
    $mensaje =__('Image','fastway').':<a href="'.get_option('fw_popup_unload_img').'" target="_blank" >'.__('Image','fastway').'</a>';
    $cambiar_l=__('Change','fastway');
    $submsg='*'.__('This will show an image before leaving the cart or checkout page.','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje</label><br>
        <small>$submsg</small>
        <a class="iralasopciones" href="index.php?edit=fw_widget_popup_unload#fw_widget_popup_unload">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_popup_unload_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_popup_unload_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_popup_unload_options'] ) ) {
        $img=($_POST['fw_widget_popup_unload_options']['img']);
        update_option('fw_popup_unload_img',$img);
    }

    if( !isset( $widget_options['fw_general_message'] ) )$widget_options['fw_general_message'] = get_option('fw_popup_unload_img');
    echo "<div>
        <label>".__('Message','fastway')."</label><br>
        <textarea style='width:100%' name=\"fw_widget_popup_unload_options[img]\" id=\"img\">".get_option('fw_popup_unload_img')."</textarea>
    </div>";
}




add_shortcode('fw_mensaje_barra','fw_mensaje_barra');
function fw_mensaje_barra(){
    if(fw_theme_mod("fw_general_message")){
        $htlm=stripslashes(htmlspecialchars_decode( fw_theme_mod('fw_general_message')));
        return '<div class="maintainance-notice" style="background:red;color:white;text-align:center;">'.$htlm.'</div>';
    }
}
function fw_widget_mensaje_barra_dash(){
    $mensaje =__('Message','fastway').': '.fw_theme_mod('fw_general_message');
    $cambiar_l=__('Change','fastway');
    $submsg='*'.__('This will create a red top bar on the website displaying the message.','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje</label><br>
        <small>$submsg</small>
        <a class="iralasopciones" href="index.php?edit=fw_widget_mensaje_barra#fw_widget_mensaje_barra">$cambiar_l</a>
    </div>
HTML;
}
function fix_templatess($mail){
    $mail=preg_replace('/\\\\{2,}/', '',$mail);
    
    $mail=stripslashes(htmlspecialchars_decode($mail));
    return $mail;
}

function fw_widget_mensaje_barra_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_mensaje_barra_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_mensaje_barra_options'] ) ) {
        $mensaje=( $_POST['fw_widget_mensaje_barra_options']['mensaje'] );
        set_theme_mod('fw_general_message',fix_templatess($mensaje));
    }

    if( !isset( $widget_options['fw_general_message'] ) )$widget_options['fw_general_message'] = fw_theme_mod('fw_general_message');
    echo "
    <div>
        <label>".__('Message','fastway')."</label><br>
        <textarea style='width:100%' name=\"fw_widget_mensaje_barra_options[mensaje]\" id=\"mensaje\">".fw_theme_mod('fw_general_message')."</textarea>
    </div>";
}


add_shortcode('fw_modal_talles','fw_modal_talles');
function fw_modal_talles(){
    //$htlm=stripslashes(htmlspecialchars_decode( fw_theme_mod('fw_general_message')));
    global $product;
    $terms = get_the_terms( $product->ID, 'product_cat' );
    $jpg='';
    foreach ($terms as $term) {
        if($term->name==="CALZADOS")$jpg='CALZADOS';
        if($term->name==="INDUMENTARIA")$jpg='INDUMENTARIA';
    }
    if($jpg==="CALZADOS"){
      $terms = get_the_terms( $product->ID, 'marca' );
      foreach ($terms as $term) {
        //RECORDAR PONER TODO EN MAYUSCULA EL NOMBRE DE LA MARCA
          if($term->name=="ADIDAS" ||
            $term->name=="TOPPER" ||
            $term->name=="PUMA"   ||
            $term->name=="NEW BALANCE" ||
            $term->name=="REEBOK" ||
            $term->name=="BICIINVEN" ||
            $term->name=="RIDER" ||
            $term->name=="WILSON" ||
            $term->name=="REEF" ||
            $term->name=="CUBALLTERRAINS" ||
            $term->name=="KAPPA" ||
            $term->name=="PONY" ||

            
            $term->name=="ADDNICE" ||
            $term->name=="DIADORA" ||
            $term->name=="FILAMENT" ||
            $term->name=="HEAD" ||
            $term->name=="JAGUAR" ||

            $term->name=="ATHIX" ||


            
            $term->name=="CONVERSE" ||
            $term->name=="JOHNFOOS"   ||
            $term->name=="COCACOLA"   ||
            $term->name=="CAPSLABS"   ||
            $term->name=="ATOMIK"   ||
            $term->name=="MONTAGNE"   ||
            $term->name=="DC" ) $jpg="CALZADOS-".$term->name;
      }
    }
    if(empty($jpg))return "";
    $jpg=strtolower($jpg);
    return '<button type="button" class="btn talles" data-toggle="modal" data-target="#exampleModal">Ver guía de talles</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <img width="100%" src="'.get_option($jpg).'">
            </div>
        </div>
        </div>
    </div>';
}
/*
function fw_widget_talles_vonder_dash(){
    $echo='<div class='fw_widget_dash'>'
    foreach($marca in explode(",",$todos)){
        $echo+="<label>calzados-: ".$marca.(get_option('calzados-adidas')?("<a target=\"_blank\" href=".get_option('calzados-adidas')."> Ver imagen</a>"):"").'</label><br>';
    }
    echo  $echo;

    $cambiar_l=__('Change','fastway');
    $submsg='*Estos son las imagenes que luego aparecen en el popup en los productos';

    echo <<<HTML
    <div class='fw_widget_dash'>
        <small>$submsg</small>
        <a class="iralasopciones" href="index.php?edit=fw_widget_talles_vonder#fw_widget_talles_vonder">$cambiar_l</a>
    </div>
HTML;
}*/
function fw_widget_talles_vonder_dash(){
    $mensaje1="calzados-adidas: ".(get_option('calzados-adidas')?("<a target=\"_blank\" href=".get_option('calzados-adidas')."> Ver imagen</a>"):"");
    $mensaje2="calzados-topper: ".(get_option('calzados-topper')?("<a target=\"_blank\" href=".get_option('calzados-topper')."> Ver imagen</a>"):"");
    $mensaje3="calzados-puma: ".(get_option('calzados-puma')?("<a target=\"_blank\" href=".get_option('calzados-puma')."> Ver imagen</a>"):"");
    $mensaje4="calzados-newbalance: ".(get_option('calzados-newbalance')?("<a target=\"_blank\" href=".get_option('calzados-newbalance')."> Ver imagen</a>"):"");
    $mensaje5="calzados-reebok: ".(get_option('calzados-reebok')?("<a target=\"_blank\" href=".get_option('calzados-reebok')."> Ver imagen</a>"):"");
    $mensaje6="calzados-converse: ".(get_option('calzados-converse')?("<a target=\"_blank\" href=".get_option('calzados-converse')."> Ver imagen</a>"):"");
    $mensaje7="calzados-johnfoos: ".(get_option('calzados-johnfoos')?("<a target=\"_blank\" href=".get_option('calzados-johnfoos')."> Ver imagen</a>"):"");
    $mensaje8="calzados-montagne: ".(get_option('calzados-montagne')?("<a target=\"_blank\" href=".get_option('calzados-montagne')."> Ver imagen</a>"):"");
    $mensaje9="calzados-dc: ".(get_option('calzados-dc')?("<a target=\"_blank\" href=".get_option('calzados-dc')."> Ver imagen</a>"):"");
    $mensaje10="indumentaria: ".(get_option('indumentaria')?("<a target=\"_blank\" href=".get_option('indumentaria')."> Ver imagen</a>"):"");
    $mensaje11="calzados-atomik: ".(get_option('calzados-atomik')?("<a target=\"_blank\" href=".get_option('calzados-atomik')."> Ver imagen</a>"):"");
    $mensaje12="calzados-kappa: ".(get_option('calzados-kappa')?("<a target=\"_blank\" href=".get_option('calzados-kappa')."> Ver imagen</a>"):"");

    $mensaje13="calzados-addnice: ".(get_option('calzados-addnice')?("<a target=\"_blank\" href=".get_option('calzados-addnice')."> Ver imagen</a>"):"");
    $mensaje14="calzados-diadora: ".(get_option('calzados-diadora')?("<a target=\"_blank\" href=".get_option('calzados-diadora')."> Ver imagen</a>"):"");
    $mensaje15="calzados-filament: ".(get_option('calzados-filament')?("<a target=\"_blank\" href=".get_option('calzados-filament')."> Ver imagen</a>"):"");
    $mensaje16="calzados-head: ".(get_option('calzados-head')?("<a target=\"_blank\" href=".get_option('calzados-head')."> Ver imagen</a>"):"");
    $mensaje17="calzados-jaguar: ".(get_option('calzados-jaguar')?("<a target=\"_blank\" href=".get_option('calzados-jaguar')."> Ver imagen</a>"):"");
    
    $mensaje18="calzados-pony: ".(get_option('calzados-pony')?("<a target=\"_blank\" href=".get_option('calzados-pony')."> Ver imagen</a>"):"");

    $mensaje19="calzados-athix: ".(get_option('calzados-athix')?("<a target=\"_blank\" href=".get_option('calzados-athix')."> Ver imagen</a>"):"");
    $mensaje20="calzados-cocacola: ".(get_option('calzados-cocacola')?("<a target=\"_blank\" href=".get_option('calzados-cocacola')."> Ver imagen</a>"):"");
    $mensaje21="calzados-capslabs: ".(get_option('calzados-capslabs')?("<a target=\"_blank\" href=".get_option('calzados-capslabs')."> Ver imagen</a>"):"");
    $mensaje22="calzados-BICIINVEN: ".(get_option('calzados-BICIINVEN')?("<a target=\"_blank\" href=".get_option('calzados-BICIINVEN')."> Ver imagen</a>"):"");
    $mensaje23="calzados-CUBALLTERRAINS: ".(get_option('calzados-CUBALLTERRAINS')?("<a target=\"_blank\" href=".get_option('calzados-CUBALLTERRAINS')."> Ver imagen</a>"):"");
    $mensaje24="calzados-REEF: ".(get_option('calzados-REEF')?("<a target=\"_blank\" href=".get_option('calzados-REEF')."> Ver imagen</a>"):"");
    $mensaje24="calzados-RIDER: ".(get_option('calzados-RIDER')?("<a target=\"_blank\" href=".get_option('calzados-RIDER')."> Ver imagen</a>"):"");
    $mensaje25="calzados-WILSON: ".(get_option('calzados-WILSON')?("<a target=\"_blank\" href=".get_option('calzados-WILSON')."> Ver imagen</a>"):"");
    
    $cambiar_l=__('Change','fastway');
    $submsg='*Estos son las imagenes que luego aparecen en el popup en los productos';

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje1</label><br>
        <label>$mensaje2</label><br>
        <label>$mensaje3</label><br>
        <label>$mensaje4</label><br>
        <label>$mensaje5</label><br>
        <label>$mensaje6</label><br>
        <label>$mensaje7</label><br>
        <label>$mensaje8</label><br>
        <label>$mensaje9</label><br>
        <label>$mensaje10</label><br>
        <label>$mensaje11</label><br>
        <label>$mensaje12</label><br>
        <label>$mensaje13</label><br>
        <label>$mensaje14</label><br>
        <label>$mensaje15</label><br>
        <label>$mensaje16</label><br>
        <label>$mensaje17</label><br>
        <label>$mensaje18</label><br>
        <label>$mensaje19</label><br>
        <label>$mensaje20</label><br>
        <label>$mensaje21</label><br>
        <label>$mensaje22</label><br>
        <label>$mensaje23</label><br>
        <label>$mensaje24</label><br>
        <label>$mensaje25</label><br>
        <small>$submsg</small>
        <a class="iralasopciones" href="index.php?edit=fw_widget_talles_vonder#fw_widget_talles_vonder">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_talles_vonder_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_talles_vonder_options' ) )$widget_options = array( );
    

    
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_talles_vonder_options'] ) ) {
        update_option('calzados-adidas',$_POST['fw_widget_talles_vonder_options']['calzados-adidas']);
        update_option('calzados-topper',$_POST['fw_widget_talles_vonder_options']['calzados-topper']);
        update_option('calzados-puma',$_POST['fw_widget_talles_vonder_options']['calzados-puma']);
        update_option('calzados-newbalance',$_POST['fw_widget_talles_vonder_options']['calzados-newbalance']);
        update_option('calzados-reebok',$_POST['fw_widget_talles_vonder_options']['calzados-reebok']);
        update_option('calzados-CUBALLTERRAINS',$_POST['fw_widget_talles_vonder_options']['calzados-CUBALLTERRAINS']);
        update_option('calzados-BICIINVEN',$_POST['fw_widget_talles_vonder_options']['calzados-BICIINVEN']);
        update_option('calzados-RIDER',$_POST['fw_widget_talles_vonder_options']['calzados-RIDER']);
        update_option('calzados-WILSON',$_POST['fw_widget_talles_vonder_options']['calzados-WILSON']);
        update_option('calzados-REEF',$_POST['fw_widget_talles_vonder_options']['calzados-REEF']);
        update_option('calzados-converse',$_POST['fw_widget_talles_vonder_options']['calzados-converse']);
        update_option('calzados-dc',$_POST['fw_widget_talles_vonder_options']['calzados-dc']);
        update_option('calzados-johnfoos',$_POST['fw_widget_talles_vonder_options']['calzados-johnfoos']);
        update_option('calzados-atomik',$_POST['fw_widget_talles_vonder_options']['calzados-atomik']);
        update_option('calzados-montagne',$_POST['fw_widget_talles_vonder_options']['calzados-montagne']);
        update_option('calzados-kappa',$_POST['fw_widget_talles_vonder_options']['calzados-kappa']);

        update_option('calzados-addnice',$_POST['fw_widget_talles_vonder_options']['calzados-addnice']);
        update_option('calzados-diadora',$_POST['fw_widget_talles_vonder_options']['calzados-diadora']);
        update_option('calzados-filament',$_POST['fw_widget_talles_vonder_options']['calzados-filament']);
        update_option('calzados-head',$_POST['fw_widget_talles_vonder_options']['calzados-head']);
        update_option('calzados-jaguar',$_POST['fw_widget_talles_vonder_options']['calzados-jaguar']);


        update_option('calzados-athix',$_POST['fw_widget_talles_vonder_options']['calzados-athix']);
        update_option('calzados-capslabs',$_POST['fw_widget_talles_vonder_options']['calzados-capslabs']);
        update_option('calzados-cocacola',$_POST['fw_widget_talles_vonder_options']['calzados-cocacola']);

        update_option('calzados-pony',$_POST['fw_widget_talles_vonder_options']['calzados-pony']);
        update_option('indumentaria',$_POST['fw_widget_talles_vonder_options']['indumentaria']);
    }
    echo "
    <div>
        <label>calzados-adidas</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-adidas]\" id=\"calzados-adidas\" value=\"".get_option('calzados-adidas')."\"><br>
        <label>calzados-topper</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-topper]\" id=\"calzados-topper\" value=\"".get_option('calzados-topper')."\"><br>
        <label>calzados-puma</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-puma]\" id=\"calzados-puma\" value=\"".get_option('calzados-puma')."\"><br>
        <label>calzados-newbalance</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-newbalance]\" id=\"calzados-newbalance\" value=\"".get_option('calzados-newbalance')."\"><br>
        <label>calzados-reebok</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-reebok]\" id=\"calzados-reebok\" value=\"".get_option('calzados-reebok')."\"><br>
        <label>calzados-BICIINVEN</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-BICIINVEN]\" id=\"calzados-BICIINVEN\" value=\"".get_option('calzados-BICIINVEN')."\"><br>
        <label>calzados-RIDER</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-RIDER]\" id=\"calzados-RIDER\" value=\"".get_option('calzados-RIDER')."\"><br>
        <label>calzados-WILSON</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-WILSON]\" id=\"calzados-WILSON\" value=\"".get_option('calzados-WILSON')."\"><br>
        <label>calzados-REEF</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-REEF]\" id=\"calzados-REEF\" value=\"".get_option('calzados-REEF')."\"><br>
        <label>calzados-CUBALLTERRAINS</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-CUBALLTERRAINS]\" id=\"calzados-CUBALLTERRAINS\" value=\"".get_option('calzados-CUBALLTERRAINS')."\"><br>
        <label>calzados-converse</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-converse]\" id=\"calzados-converse\" value=\"".get_option('calzados-converse')."\"><br>
        <label>calzados-montagne</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-montagne]\" id=\"calzados-montagne\" value=\"".get_option('calzados-montagne')."\"><br>
        <label>calzados-johnfoos</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-johnfoos]\" id=\"calzados-johnfoos\" value=\"".get_option('calzados-johnfoos')."\"><br>
        <label>calzados-atomik</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-atomik]\" id=\"calzados-atomik\" value=\"".get_option('calzados-atomik')."\"><br>
        <label>calzados-dc</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-dc]\" id=\"calzados-dc\" value=\"".get_option('calzados-dc')."\"><br>
        <label>calzados-kappa</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-kappa]\" id=\"calzados-kappa\" value=\"".get_option('calzados-kappa')."\"><br>
        
        <label>calzados-addnice</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-addnice]\" id=\"calzados-addnice\" value=\"".get_option('calzados-addnice')."\"><br>
        <label>calzados-diadora</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-diadora]\" id=\"calzados-diadora\" value=\"".get_option('calzados-diadora')."\"><br>
        <label>calzados-filament</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-filament]\" id=\"calzados-filament\" value=\"".get_option('calzados-filament')."\"><br>
        <label>calzados-head</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-head]\" id=\"calzados-head\" value=\"".get_option('calzados-head')."\"><br>
        <label>calzados-jaguar</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-jaguar]\" id=\"calzados-jaguar\" value=\"".get_option('calzados-jaguar')."\"><br>
        <label>calzados-athix</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-athix]\" id=\"calzados-athix\" value=\"".get_option('calzados-athix')."\"><br>
        <label>calzados-pony</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-pony]\" id=\"calzados-pony\" value=\"".get_option('calzados-pony')."\"><br>
        <label>calzados-cocacola</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-cocacola]\" id=\"calzados-cocacola\" value=\"".get_option('calzados-cocacola')."\"><br>
        <label>calzados-capslabs</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[calzados-capslabs]\" id=\"calzados-capslabs\" value=\"".get_option('calzados-capslabs')."\"><br>
        <label>indumentaria</label><input type=\"text\" name=\"fw_widget_talles_vonder_options[indumentaria]\" id=\"indumentaria\" value=\"".get_option('indumentaria')."\"><br>
    </div>";
}





add_shortcode('fw_mensaje_sec','fw_mensaje_sec');
function fw_mensaje_sec(){
    return fw_theme_mod('fw_mensaje_sec');
}
function fw_widget_mensaje_sec_dash(){
    $mensaje =__('Message','fastway').': '.fw_theme_mod('fw_mensaje_sec');
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_mensaje_sec#fw_widget_mensaje_sec">$cambiar_l</a>
    </div>
HTML;
}

function fw_widget_mensaje_sec_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_mensaje_sec_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_mensaje_sec_options'] ) ) {
        # minor validation
        $mensaje=( $_POST['fw_widget_mensaje_sec_options']['mensaje'] );
        set_theme_mod('fw_mensaje_sec',$mensaje);
    }

    if(!isset( $widget_options['fw_mensaje_sec']))$widget_options['fw_mensaje_sec'] = fw_theme_mod('fw_mensaje_sec');

    echo "
    <div>
        <label>".__('Message','fastway')."</label>
        <input type=\"text\" name=\"fw_widget_mensaje_sec_options[mensaje]\" id=\"mensaje\" value=\"".fw_theme_mod('fw_mensaje_sec')."\">
    </div>";
}




function fw_dash_conversion(){
    echo"<div class='fw_widget_dash'>
    <label>".__('1 equals','fastway').': '.fw_theme_mod('fw_currency_conversion')."</label>
    <a class=\"iralasopciones\" href=\"index.php?edit=fw_currency_widget#fw_currency_widget\">Cambiar</a>
    </div>";
}
function fw_dash_conversion_handler(){
    if( !$widget_options = get_option( 'fw_currency_widget_options' ) ) $widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_currency_widget_options'] ) ) {
         $convers=( $_POST['fw_currency_widget_options']['conversion'] );
        set_theme_mod('fw_currency_conversion',$convers);
    }

    if( !isset( $widget_options['fw_currency_conversion'] ) )$widget_options['fw_currency_conversion'] = fw_theme_mod('fw_currency_conversion');

    echo "
      <div>
        <label>".__('1 equals','fastway').":</label>
        <input type=\"text\" name=\"fw_currency_widget_options[conversion]\" id=\"conversion\" value=\"".fw_theme_mod('fw_currency_conversion')."\">
      </div>";
}


function fw_widget_estado_dash() {
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) ) $widget_options = array();


    $estado=$widget_options['estados'];
    if(!fw_theme_mod("maintainance-mode") && fw_theme_mod("fw_shop_state")=='normal')$output="<label class='labelstatus normal'>".__('All functions enabled','fastway')."</label>";
    else if(fw_theme_mod("maintainance-mode"))$output="<label class='labelstatus mante'>".__('Under maintainance','fastway')."</label>";
    else if(fw_theme_mod("fw_shop_state")=='hidepurchases')$output="<label class='labelstatus hidepurchases'>".__('Show only prices, purchases disabled','fastway')."</label>";
    else if(fw_theme_mod("fw_shop_state")=='hideprices')$output="<label class='labelstatus hideprices' >".__('Hide purchases and prices','fastway')."</label>";
 
    echo "<style>
    .fw_widget_dash .labelstatus{
        padding:10px;
    }
    .fw_widget_dash .normal{
        color:green !important;
    }
    .fw_widget_dash .mante{
        color:red !important;
        text-transform:uppercase !important;
    }
    .fw_widget_dash .hidepurchases{
        color:red !important;
    }
    .fw_widget_dash .hideprices{
        color:orange !important;
    }
    .fw_widget_dash .iralasopciones{
        background:".fw_theme_mod('ca-main-color').";
        color:white !important;
        padding:5px;
        display:block;
        border:0px !important;
        width:90px;
        margin:5px ;
        margin-top:15px ;
        text-align:center;
    }
    </style>   
    <div class='fw_widget_dash'>
    <div>$output</div>
    <a class='iralasopciones' href=\"index.php?edit=fw_widget_estado#fw_widget_estado\">".__('Change','fastway')."</a>
    </div>";
    }

function fw_widget_estado_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_estado_options'] ) ) {
         $widget_options['estados'] = ( $_POST['fw_widget_estado_options']['estados'] );
         $estado=$widget_options['estados'];
        if($estado=='normal'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','normal');
        }else if($estado=='maintainance'){
            set_theme_mod('maintainance-mode',true);
            set_theme_mod('fw_shop_state','normal');
        }else if($estado=='hidepurchases'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','hidepurchases');
        }else if($estado=='hideprices'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','hideprices');
        }
        update_option( 'fw_widget_estado_options', $widget_options );
    }

    # set defaults  
    if( !isset( $widget_options['estados'] ) )$widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>".__('Status','fastway')."</label>
         <select name=\"fw_widget_estado_options[estados]\" id=\"estados\">
         <option value>-".__('Estado','fastway')."-</option> 
            <option value=\"normal\">".__('All functions enabled','fastway')."</option> 
            <option value=\"maintainance\" >".__('Under maintainance','fastway')."</option>
            <option value=\"hidepurchases\">".__('Show only prices, purchases disabled','fastway')."</option>
            <option value=\"hideprices\">".__('Hide purchases and prices','fastway')."</option>
         </select>
      </div>";
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 function my_custom_dashboard_widgets() {
     global $wp_meta_boxes;
     if(fw_theme_mod("fw_id_ml"))wp_add_dashboard_widget('custom_help_widget1', 'Mercadolibre', 'custom_ml_help');
     if((fw_theme_mod('fw_id_filesync') && !empty(fw_theme_mod('fw_id_wpallimport'))) || !empty(fw_theme_mod('fw_id_wpallexport')))wp_add_dashboard_widget('fw_actualizar_precios', __('Update prices','fastway'), 'fw_actualizar_precios');
     if(fw_theme_mod('fw_widget_support_fresh_es'))wp_add_dashboard_widget('custom_dashboard_help', __('Need help','fastway'), 'custom_dashboard_help');
     wp_add_dashboard_widget('fw_ajustes_generales', __('General Settings','fastway'), 'fw_ajustes_generales');
     if(fw_theme_mod('ca-videos'))wp_add_dashboard_widget('fw_client_videos', __('Info Videos','fastway'), 'fw_client_videos');
 }
 
 function fw_client_videos() {

    foreach(fw_get_yt_videos(fw_theme_mod('ca-videos')) as $video){
        $url = $video[1];
        echo '<iframe src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen width="100%" height="200" class="fw_video_frame"></iframe>';
    }
 }
 function fw_ajustes_generales() {
    echo '
    <p>
    <span>'.__('Customize emails & texts','fastway').': <a href="options-general.php?page=myplugin" class="btn">'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Shipping Methods','fastway').': <a href="admin.php?page=wc-settings&tab=shipping" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Payment Methods','fastway').': <a href="admin.php?page=wc-settings&tab=checkout" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Export forms','fastway').': <a href="admin.php?page=gf_export" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Export users/orders','fastway').': <a href="admin.php?page=wc_customer_order_csv_export" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Customize menus','fastway').': <a href="nav-menus.php" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Email log','fastway').': <a href="/wp-admin/admin.php?page=email-log" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Refresh cache','fastway').': <a href="/wp-admin/?kinsta-cache-cleared=true" class="btn"  >'.__('clean','fastway').'</a></span><br><br>';
    if(is_plugin_active("wc-abandoned-carts-by-small-fish-analytics/class-sfa-woocommerce-abandoned-carts.php"))echo '
    <span>'.__('Abandoned Cart','fastway').': <a href="/wp-admin/admin.php?page=sfa-abandoned-carts&tab=sfa_data" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    </p>' ;
}
function fw_actualizar_precios() {
    if(!empty(fw_theme_mod('fw_id_wpallexport')))echo '<span>'.__('Export updated prices','fastway').' <a href="/wp-admin/admin.php?page=pmxe-admin-manage&id='.fw_theme_mod("fw_id_wpallexport").'&action=update" target="_blank">'.__('Export','fastway').'</a></span><br><br>';
    if(!empty(fw_theme_mod('fw_id_wpallimport')))echo '<span>'.__('Import updated prices','fastway').' <a href="/wp-admin/upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id='.fw_theme_mod('fw_id_filesync').'" target="_blank">'.__('Import','fastway').'</a></span><br><br>' ;
    echo '<span style="color:red">'.__('IMPORTANT: Do not modifty coulmns nor its titles, you could damage or lost data. If in doubt , contact support.','fastway').'</span><br>';
}
function custom_dashboard_help() {
    echo '<p>'.__('Send your requirement via email to our account','fastway').' <small>'.__('soporte@altoweb.ar','fastway').'</small></a>';
    //echo '<p>'.__('Send your requirement from our support widget','fastway').' <a href="#" class="btn" onclick="FreshworksWidget(\'open\');" >'.__('create ticket','fastway').'</a>';
    echo '<br><br>'.__('For more information about the altoweb service <a target="_blank" href="https://www.altoweb.ar/tickets/">click here</a>','fastway').'</p>
    '.__('You can also register in the help portal to see tutorials and send us inquiries. <a target="_blank" href="https://altoweb.freshdesk.com/">Go to portal</a>','fastway');
}
function custom_ml_help() {
    echo '<p>'.__('Products will be updated once per day. You can do the process manually the following way: ','fastway').'<br> 
    1) '.__('Update info from mercadolibre with the following link','fastway').': <a href="https://mlsync.altoweb.ar/user.php?user='.fw_theme_mod("fw_id_ml").'" target="_blank">'.__('open','fastway').'</a><br>
    2) '.__('Once finished, start the import process with the following link','fastway').': <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.fw_theme_mod("fw_id_wpallimport_ml").'&action=update" target="_blank">'.__('open','fastway').'</a>' ;
    if(fw_theme_mod('fw_ml_stock_ml_a_web'))echo '<br><br><a href="/wp-admin/options-general.php?page=mllog">Ver logs</a>';
}
 
 

//Eso acomoda de lugar los widgets
//add_action( 'admin_init', 'set_dashboard_meta_order' );
function set_dashboard_meta_order() {
  $id = get_current_user_id(); //we need to know who we're updating
  $meta_value = array(
    'normal'  => 'woocommerce_dashboard_status,fw_ajustes_generales', //first key/value pair from the above serialized array
    'side' => 'custom_dashboard_help,fw_widget_estado,fw_widget_popup,fw_widget_mensaje_barra,fw_widget_mensaje_sec', //third key/value pair from the above serialized array
    'column3' => 'rg_forms_dashboard,fw_widget_desc_prods,fw_widget_cupones', //last key/value pair from the above serialized array
  );
  update_user_meta( $id, 'meta-box-order_dashboard', $meta_value ); //update the user meta with the user's ID, the meta_key meta-box-order_dashboard, and the new meta_value
}
 

function fw_widget_lili_discount_dash(){
    $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_lili_discount_categories')?fw_theme_mod('fw_lili_discount_categories'):__('All products','fastway'));
    $cant=fw_theme_mod('fw_lili_discount_cant');
    $label=__('Name','fastway').': '.fw_theme_mod('fw_lili_discount_label');
    $cant=__('Quantity','fastway').': '.$cant."x".($cant-1);
    $estado=__('Status','fastway').': '.(fw_theme_mod('fw_lili_discount')?__('Active','fastway'):__('Inactive','fastway'));
    $color= fw_theme_mod('fw_lili_discount')?'green':'red';
    $cupones=__('Allows coupons','fastway').': '.(fw_theme_mod('fw_lili_discount_cupones')?__('Yes','fastway'):__('No','fastway'));
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_lili_discount_percentage')).'<small>('.__('Applies to the cheapiest','fastway').')</small>';
    $cambiar_l=__('Change','fastway');
    
    echo <<<HTML
    <div class='fw_widget_dash'>
    <div class='group' style="margin-top:20px;">
        <label>$estado</label><br>
        <label>$label</label><br>
        <label>$cates</label><br>
        <label>$cupones</label><br>
        <label>$porcentage</label><br>
        <label>$cant</label>
    </div>
HTML;

    if(fw_theme_mod('fw_widget_lili_discount_multi')){

        $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_lili_discount_categories_2')?fw_theme_mod('fw_lili_discount_categories_2'):__('All products','fastway'));
        $cant=fw_theme_mod('fw_lili_discount_cant_2');
        $label=__('Name','fastway').': '.fw_theme_mod('fw_lili_discount_label_2');
        if(is_numeric($cant))$cant=__('Quantity','fastway').': '.$cant."x".($cant-1);
        $estado=__('Status','fastway').': '.(fw_theme_mod('fw_lili_discount_2')?__('Active','fastway'):__('Inactive','fastway'));
        $color= fw_theme_mod('fw_lili_discount_2')?'green':'red';
        $cupones=__('Allows coupons','fastway').': '.(fw_theme_mod('fw_lili_discount_cupones_2')?__('Yes','fastway'):__('No','fastway'));
        $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
        $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_lili_discount_percentage_2')).'<small>('.__('Applies to the cheapiest','fastway').')</small>';
        $cambiar_l=__('Change','fastway');
    
        echo <<<HTML
    <div class='group' style="margin-top:20px;">
        <label>$estado</label><br>
        <label>$label</label><br>
        <label>$cates</label><br>
        <label>$cupones</label><br>
        <label>$porcentage</label><br>
        <label>$cant</label>
    </div>
    HTML;


    echo <<<HTML
    <a class="iralasopciones" href="index.php?edit=fw_widget_lili_discount#fw_widget_lili_discount">$cambiar_l</a>
</div>
HTML;
    }else{
        $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_lili_discount_categories_3')?fw_theme_mod('fw_lili_discount_categories_3'):__('All products','fastway'));
        $cant=fw_theme_mod('fw_lili_discount_cant_3');
        $label=__('Name','fastway').': '.fw_theme_mod('fw_lili_discount_label_3');
        if(is_numeric($cant))$cant=__('Quantity','fastway').': '.$cant."x".($cant-1);
        $estado=__('Status','fastway').': '.(fw_theme_mod('fw_lili_discount_3')?__('Active','fastway'):__('Inactive','fastway'));
        $color= fw_theme_mod('fw_lili_discount_3')?'green':'red';
        $cupones=__('Allows coupons','fastway').': '.(fw_theme_mod('fw_lili_discount_cupones_3')?__('Yes','fastway'):__('No','fastway'));
        $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
        $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_lili_discount_percentage_3')).'<small>('.__('Applies to the cheapiest','fastway').')</small>';
        $cambiar_l=__('Change','fastway');

        echo <<<HTML
    <div class='group' style="margin-top:20px;">
        <label>$estado</label><br>
        <label>$label</label><br>
        <label>$cates</label><br>
        <label>$cupones</label><br>
        <label>$porcentage</label><br>
        <label>$cant</label>
    </div>
    HTML;
    


    echo <<<HTML
    <a class="iralasopciones" href="index.php?edit=fw_widget_lili_discount#fw_widget_lili_discount">$cambiar_l</a>
</div>
HTML;
}
}

?>