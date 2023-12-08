<?php

function refes_db($type){
	$types['header_1']= ['loopboardshop.com.ar'];
	$types['header_2']= ['bontey.com.ar','tomate.ecom2.kinsta.cloud'];
	$types['header_11']= ['proshop.com.ar'];
	$types['header_12']= ['sale.insti2.kinsta.cloud'];
	$types['header_13']= ['mendar.com.ar'];

	$types['fw_iconos_home_1']= ['sale.insti2.kinsta.cloud','bontey.com.ar'];
	$types['fw_iconos_home_2']= ['digital-storeweb.com.ar'];
	$types['fw_iconos_home_3']= ['porceland.insti2.kinsta.cloud','proshop.com.ar'];
	

	$types['mobileh_2']= ['digital-storeweb.com.ar'];
	$types['mobileh_3']= ['elementosesenciales.com.ar'];
	$types['mobileh_4']= ['berrydesign.com.ar'];


	$types['fw_prod_loop_2']= ['proshop.com.ar'];
	$types['fw_prod_loop_4']= ['loopboardshop.com.ar'];
	$types['fw_prod_loop_6']= ['digital-storeweb.com.ar'];


	$types['fw_cat_loop_2']= ['loopboardshop.com.ar','carosilvabertolo.com'];
	$types['fw_cat_loop_4']= ['proshop.com.ar'];
	$types['fw_cat_loop_5']= ['digital-storeweb.com.ar'];

	$types['fw_rev_loop_1']= ['sale.insti2.kinsta.cloud'];
	$types['fw_rev_loop_2']= ['inlat.global'];

	$types['footer_1']= ['berrydesign.com.ar'];
	$types['footer_2']= ['bontey.com.ar'];
	$types['footer_3']= ['mendar.com.ar','porceland.insti2.kinsta.cloud'];
	$types['footer_4']= ['loopboardshop.com.ar'];
	$types['footer_6']= ['digital-storeweb.com.ar'];
	$types['footer_10']= ['sale.insti2.kinsta.cloud','proshop.com.ar'];

	$devolver="";
	if($types[$type]){
		foreach($types[$type] as $web){
			$link='https://www.';
			if(strpos( $web, 'kinsta.cloud' ) !== false) $link='http://';
			$devolver.='<a class="refe" target="_blank" href="'.$link.$web.'">'.$web.'</a> ';
		}
	}
	return $devolver;

}
function preset_db($type){
	$types['header_1']= '[fw_header id="top"]<div class="col-6 text-left"> [fw_menu id="top-nav-menu"]</div><div class="col-6 text-right"> <span class="frase-top">Productos para deportes extremos</span></div>[/fw_header][fw_header id="middle"]<div class="col-4 text-left"> [fw_search_form id="1"]</div><div class="col-4 text-center">[fw_logo]</div><div class="col-4 text-right">[fw_user_account][fw_shopping_cart]</div>[/fw_header][fw_header id="bottom"][fw_menu][/fw_header]';
	$types['header_2']= '[fw_header id="middle"] <div class="d-flex w-100 align-items-center"> [fw_logo] [fw_search_form id="1"] <div class="d-inline-flex mt-auto mb-auto"> [fw_shopping_cart] [fw_user_account] </div> </div>[/fw_header] [fw_header id="bottom"] [fw_menu]<div class="nav-redes"> [fw_social_icons type="fb,ig,twitter" el_class="redes"] </div>[/fw_header]';
	$types['header_11']= '[fw_header id="top"] [fw_data type="truck" isli="true" stext="Envío a todo el país"] [fw_data type="repeat" isli="true" stext="Cambio y devolución gratis"] [fw_data type="email" isli="true" stext="" id="email"] [fw_data type="user" isli="true" stext="Mayoristas" link="/mayoristas"] <div class="redestop"> [fw_data type="fb" isli="true"] [fw_data type="ig" isli="true"] [fw_data type="youtube" isli="true"] </div> [/fw_header] [fw_header id="middle"][fw_logo] <div class="search_container"> [fw_search_form id="1"] </div> <div class="datoscontacto"> [fw_data type="whatsapp" isli_i="true" stext="Whatsapp"] [fw_data type="phone" isli_i="false" stext="Ventas"] </div> <div> [fw_user_account] [fw_shopping_cart] </div> [/fw_header] [fw_header id="bottom"] [fw_menu]<!-- <div class="nav-redes"> [fw_social_icons type="fb,ig,twitter" el_class="redes"] </div>-->[/fw_header]';
	$types['header_12']= '[fw_header][fw_logo]<div class="datos d-flex flex-column justify-content-around" style="">[fw_data type="email"  ][fw_data type="phone" ]</div>[/fw_header]  [fw_header id="bottom"][fw_menu][/fw_header]';
	$types['header_13']= '[fw_header id="top"]<div >[fw_data type="truck" text="Envíos" link="/envios"][fw_data type="repeat" text="Pagos" link="/pagos"][fw_data type="map-marker" text="Como llegar" link="/como-llegar"]</div><div>[fw_data type="user" text="Ingresa" link="/my-account"][fw_data type="user-plus" text="Registrate" link="/my-account"]</div>[/fw_header][fw_header][fw_logo][fw_menu id="main-corto"][fw_search_form ][fw_shopping_cart][/fw_header]';
	
	$types['mobileh_1']= '[fw_m_header][fw_m_menu][fw_logo][/fw_m_header]';
	$types['mobileh_2']= '[fw_m_header]<div class="col-3 row align-items-center justify-content-around px-0"> [fw_m_menu][fw_m_search_form id="3"] </div> <div class="col-6 row align-items-center justify-content-center"> [fw_logo] </div> <div class="col-3 row align-items-center justify-content-center"> [fw_shopping_cart] </div>[/fw_m_header]';
	$types['mobileh_3']= '[fw_m_header][fw_logo][/fw_m_header][fw_m_header id="bottom"][fw_m_menu][fw_user_account][fw_m_search_form][fw_shopping_cart][/fw_m_header]';
	$types['mobileh_4']= '[fw_m_header][fw_logo] [/fw_m_header] [fw_m_header id="bottom"] <div> [fw_m_menu] </div> <div class="alignder"> [fw_user_account][fw_m_search_form][fw_shopping_cart] </div> [/fw_m_header]';

	$types['fw_prod_loop_2']= '[fw_loop_container][fw_loop_image][fw_loop_title][fw_short_desc][fw_div_open class="contiene"][fw_loop_btn][fw_loop_price][fw_div_close][/fw_loop_container]';
	$types['fw_prod_loop_4']= '[fw_loop_container ][fw_loop_image][fw_loop_title][fw_short_desc][fw_loop_price][/fw_loop_container][fw_loop_btn]';
	$types['fw_prod_loop_6']= '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][/fw_loop_container]';


	$types['fw_rev_loop_1']= '[fw_review_container]<div class="review-inner">[fw_review_image]<div  class="review-head"><h4  class="review-client-name">[fw_review_title]</h4> <span class="review-job">[fw_review_position]</span></div> <div class="review-comment">[fw_review_desc]</div> [fw_review_logo]</div>[/fw_review_container]';
	$types['fw_rev_loop_2']= '[fw_review_container]<div class="comment_ribbon"><div class="ribbon_bg"><span class="quote">"</span></div>	</div><div class="comment_client">[fw_review_image]<span class="client_name">[fw_review_title]</span><span class="client_job">[fw_review_position]</span></div><div class="comment_wrapper"><div class="desc">[fw_review_desc]</div><div class="comment_footer">[fw_review_logo]<a href="[fw_review_url]" target="_blank" class="comment_button">EXPLORE</a></div></div>[/fw_review_container]';
	


	$types['fw_cat_loop_2']= '[vc_row el_id="categorias" el_class="carusel_block categories"][vc_column][vc_empty_space][vc_column_text][/vc_column_text][vc_empty_space height="64px"][product_categories orderby="" order="ASC" columns="2" ids="47, 83, 58, 548"][vc_empty_space][/vc_column][/vc_row]';
	$types['fw_cat_loop_4']= '[fw_cat_container][fw_cat_image][fw_cat_title][/fw_cat_container]';
	$types['fw_cat_loop_5']= '[fw_cat_container][fw_cat_image]<div class="contenedor">[fw_cat_title][fw_cat_desc]</div>[/fw_cat_container]';

	$types['footer_1']= '[vc_row][vc_column][vc_empty_space height="32px"][/vc_column][/vc_row][vc_row gap="20" content_placement="top"][vc_column width="3/6"][vc_column_text]<h4>RECIBÍ OFERTAS EXCLUSIVAS</h4>[/vc_column_text][gravityform id="3" title="false" description="false" ajax="false"][vc_column_text]<h4>SEGUINOS</h4>[/vc_column_text][fw_social_icons icon_size="30" type="fb,ig"][/vc_column][vc_column width="1/6" fw_responsive="d-none d-md-flex"][vc_column_text]<h4>SECCIONES</h4>[/vc_column_text][vc_wp_custommenu nav_menu="34"][/vc_column][vc_column width="2/6"][fw_data format="isli" sblock="" type="address" el_class="mb-3" stext="Visitanos"][fw_data format="isli" sblock="" type="phone" el_class="mb-3" stext="Atención telefonica"][fw_data format="isli" sblock="" type="email" el_class="mb-3" stext="Envianos un correo"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="32px"][/vc_column][/vc_row]';
	$types['footer_2']= '[vc_row][vc_column][vc_empty_space][/vc_column][/vc_row][vc_row gap="20" content_placement="top"][vc_column width="1/5" fw_columns_responsive="onehalf_mobile"][vc_column_text]</p> <h5>Mi cuenta</h5> <p>[/vc_column_text][vc_wp_custommenu nav_menu="41"][/vc_column][vc_column width="1/5" fw_columns_responsive="onehalf_mobile"][vc_column_text]</p> <h5>Nosotros</h5> <p>[/vc_column_text][vc_wp_custommenu nav_menu="42"][/vc_column][vc_column width="1/5" fw_responsive="d-none d-md-flex" el_class="footercontacto"][vc_column_text]</p> <h5>Contacto</h5> <p>[/vc_column_text][fw_data only_text="true" sblock="" type="phone"][fw_data only_text="true" sblock="" type="email"][fw_social_icons type="fb,ig" el_class="redes"][/vc_column][vc_column width="2/5" fw_columns_margin="withtopmargin" el_class="footernews"][vc_column_text]</p> <h5 style="text-align: center;">Suscribite al newsletter</h5> <p>[/vc_column_text][gravityform id="3" title="false" description="false" ajax="true"][fw_image_function image="613" size="150px" sblock=""][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space][/vc_column][/vc_row] ';
	$types['footer_3']= '[vc_row el_class="footer_top"][vc_column][vc_empty_space][vc_column_text]</p> <div class="title"> <h3 style="text-align: center;">Suscribite al newsletter</h3> <h4 style="text-align: center;">para recibir novedades en tu e-mail</h4> </div> <p>[/vc_column_text][gravityform id="3" title="false" description="false" ajax="true"][vc_empty_space][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space][vc_row_inner content_placement="top"][vc_column_inner width="1/4" fw_responsive="d-none d-md-flex"][fw_image_function image="147" size="50% auto" sblock=""][/vc_column_inner][vc_column_inner width="1/4" fw_columns_responsive="onehalf_mobile"][vc_wp_custommenu nav_menu="34"][/vc_column_inner][vc_column_inner width="1/4" fw_columns_responsive="onehalf_mobile"][vc_wp_custommenu nav_menu="34"][/vc_column_inner][vc_column_inner width="1/4"][fw_data format="isli" only_text="true" sblock="" type="email"][fw_social_icons icon_size="25" type="address,email"][fw_data format="isli" text_color="#fff" type="whatsapp" stext="Hablanos por whatsapp!"][vc_column_text]<span style="color: #ffffff;">HORARIO DE ATENCIÓN</span><br /> <span style="color: #ffffff;">Lunes a Viernes de 9 a 18hs</span>[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_empty_space][/vc_column][/vc_row] ';
	$types['footer_4']= '[vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row][vc_row el_id="newsletter"][vc_column width="4/12"][fw_data format="isli" sblock="" type="envelope-open" text="NEWSLETTER" stext="SUSCRIBITE AHORA"][/vc_column][vc_column width="8/12"][gravityform id="3" title="false" description="false" ajax="true"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space][/vc_column][/vc_row][vc_row el_id="datoscontacto"][vc_column width="1/3" el_class="contacto_col"][fw_data format="isli_i" sblock="" type="email" stext="NUESTRO EMAIL"][/vc_column][vc_column width="1/3" el_class="contacto_col"][fw_data format="isli_i" sblock="" type="address" stext="UBICACIÓN"][/vc_column][vc_column width="1/3" el_class="contacto_col"][fw_data format="isli_i" sblock="" type="phone" stext="CONTÁCTENOS"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="16px"][/vc_column][/vc_row][vc_row][vc_column][vc_wp_custommenu nav_menu="39"][vc_column_text el_class="redes_title"]</p> <p style="text-align: center">Seguinos en nuestras redes</p> <p>[/vc_column_text][fw_social_icons icon_align="center" type="fb,youtube,ig" el_class="redes_icons"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row] ';
	$types['footer_6']= '[vc_row content_placement="middle" css=".vc_custom_1547832843358{padding-top: 10px !important;padding-bottom: 10px !important;}" el_class="newsletterform_fw"][vc_column width="2/6"][vc_column_text]</p> <h4>RECIBÍ NUESTRAS OFERTAS</h4> <p>[/vc_column_text][/vc_column][vc_column width="3/6"][gravityform id="3" title="false" description="false" ajax="true"][/vc_column][vc_column width="1/6" fw_responsive="d-none d-md-flex"][fw_social_icons icon_align="center" icon_size="30" type="fb,ig"][/vc_column][/vc_row][vc_row content_placement="middle" el_class="bottom_icons"][vc_column el_class="paddindesktop"][vc_empty_space][vc_row_inner][vc_column_inner width="1/3" fw_columns_margin="withbottommargin"][fw_data format="isli" sblock="" type="clock" text="10:00 a 19:00hs" stext="Lunes a Viernes"][/vc_column_inner][vc_column_inner width="1/3" fw_columns_margin="withbottommargin"][fw_data format="isli" type="address" text="Marcelo T. de Alvear 1247" stext="CABA, Argentina"][/vc_column_inner][vc_column_inner width="1/3" fw_columns_margin="withbottommargin"][fw_data format="isli" type="phone" text="011-5365-8460" stext="Atención telefónica"][/vc_column_inner][/vc_row_inner][vc_empty_space el_class="d-none d-md-block"][/vc_column][/vc_row] ';
	//$types['footer_7']= '[vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row][vc_row content_placement="top"][vc_column width="3/4"][vc_row_inner][vc_column_inner width="1/3"][vc_column_text]</p> <h3>Recibí nuestras ofertas</h3> <p>[/vc_column_text][/vc_column_inner][vc_column_inner width="2/3"][gravityform id="3" title="false" description="false" ajax="true"][/vc_column_inner][/vc_row_inner][vc_empty_space][/vc_column][vc_column width="1/4" fw_responsive="d-none d-md-flex"][fw_social_icons type="fb,ig,twitter"][vc_empty_space][/vc_column][/vc_row][vc_row content_placement="top" fw_columns_responsive="two_mobile_columns"][vc_column width="1/4"][vc_wp_custommenu nav_menu="34"][/vc_column][vc_column width="1/4"][vc_wp_custommenu nav_menu="34"][/vc_column][vc_column width="1/4" fw_responsive="d-none d-md-flex" el_class="contact-info"][fw_data format="isli" only_text="true" sblock="" type="email"][fw_data format="isli" only_text="true" sblock="" type="address"][vc_column_text]<span style="color: #ffffff;"><strong>Horarios de Atención:</strong></span><br /> <span style="color: #ffffff;">de Lunes a Lunes, de 8:30 a 0:30 de la noche</span>[/vc_column_text][/vc_column][vc_column width="1/4" fw_responsive="d-none d-md-flex"][fw_image_function image="3" size="auto" sblock="" el_class="logo-footer"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row] ';
	$types['footer_10']='[vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row][vc_row content_placement="middle" el_id="newsletter"][vc_column][vc_row_inner content_placement="middle"][vc_column_inner width="4/12"][vc_column_text]</p> <h4>Recibí nuestras ofertas</h4> <p>[/vc_column_text][/vc_column_inner][vc_column_inner width="8/12"][gravityform id="3" title="false" description="false" ajax="true"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space][/vc_column][/vc_row][vc_row content_placement="top" fw_columns_responsive="two_mobile_columns"][vc_column width="1/4" fw_responsive="d-none d-md-flex"][vc_wp_custommenu nav_menu="133"][/vc_column][vc_column width="1/4"][vc_wp_custommenu nav_menu="32"][/vc_column][vc_column width="1/4"][fw_data format="isli" only_text="true" sblock="" type="email"][fw_data sblock="" type="phone" stext="Ventas"][fw_data sblock="" type="whatsapp" stext="Ventas"][fw_data format="isli" only_text="true" sblock="" text="BUENOS AIRES" stext="ARGENTINA"][/vc_column][vc_column width="1/4" fw_responsive="d-none d-md-flex"][fw_image_function image="56654" size="auto" sblock="" el_class="logo_footer"][/vc_column][/vc_row][vc_row][vc_column][vc_empty_space height="64px"][/vc_column][/vc_row] ';

	$types['fw_iconos_home_1']= '[vc_row el_class="fw_iconos_home_1" equal_height="yes" content_placement="top" fw_columns_responsive="two_mobile_columns" ][vc_column width="1/4"][fw_data format="iconbox" text_align="center" sblock="" type="credit-card" text="Pago en cuotas" stext="Muchos medios de pago" el_class="icono1"][/vc_column][vc_column width="1/4" el_class="no_border_on_mobile"][fw_data format="iconbox" text_align="center" sblock="" type="shipping-fast" text="Envíos en el día" stext="Comprando antes de las 14hs." el_class="icono2"][/vc_column][vc_column width="1/4"][fw_data format="iconbox" text_align="center" sblock="" type="gift" text="Envío gratis AMBA" stext="Compras superiores a $3500" el_class="icono3"][/vc_column][vc_column width="1/4" el_class="noborder"][fw_data format="iconbox" text_align="center" sblock="" type="tag" text="Cotización de envíos" stext="Online con etiqueta" el_class="icono4"][/vc_column][/vc_row]';
	$types['fw_iconos_home_2']= '[vc_row el_class="fw_iconos_home_2" full_width="" fw_columns_responsive="two_mobile_columns" ][vc_column width="1/4"][fw_data format="isli" type="fa-credit-card" text="Hasta 12 cuotas" stext="Ver más" iframe="https://www.mercadolibre.com.ar/gz/promociones-bancos?modal=true"][/vc_column][vc_column width="1/4"][fw_data format="isli" sblock="" type="usd-circle" text="Medios de pago" stext="Ver más" link="/medios-de-pago"][/vc_column][vc_column width="1/4"][fw_data format="isli" sblock="" type="shipping-timed" text="Medios de envío" stext="Ver más" link="/medios-de-envio"][/vc_column][vc_column width="1/4"][fw_data format="isli" sblock="" type="award" text="10 días de prueba" stext="Ver más" link="/medios-de-envio"][/vc_column][/vc_row]';
	$types['fw_iconos_home_3']= '[vc_row el_class="fw_iconos_home_1"][vc_column width="1/3"][fw_data format="iconbox" text_align="center" type="fa-handshake-alt" text="¿POR QUE CONFIAR EN NOSOTROS?" stext="Mirá las opiniones de nuestros clientes"][/vc_column][vc_column width="1/3"][fw_data format="iconbox" text_align="center" type="fa-comments" text="0810 345 1102" stext="Lu-Vi: 9 a 20hs / Sa y Fer: 10 a 17hs"][/vc_column][vc_column width="1/3"][fw_data format="iconbox" text_align="center" type="fa-map-marker-alt" text="SUCURSAL MICROCENTRO" stext="Lu-Vi: 9 a 19hs / Sa y Fer: 10 a 17hs"][/vc_column][/vc_row]';
	
	if($type)return $types[$type];
	else return $types;
}
function presets(){
	$devo=[];
	foreach(preset_db(null) as $clase=>$code){
		$devo[$clase]=['settings' => ['preset_field' => preset_db($clase)]];
	}
	return $devo;
}

function builder_labels(){
	$devo=[];
	foreach(preset_db(null) as $clase=>$name){
		$devo[$clase]=$clase;
	}
	return $devo;
}

add_shortcode('fw_builder_reviews','fw_builder_reviews');
function fw_builder_reviews(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'fw_rev_loop_' ) === false) continue;
		global $preset_class,$preset_code;
		$preset_class=$clase;
		$preset_code=$code;

		echo "<div class=\"container\" style=\"border:2px solid black;margin-bottom:50px;padding:10px;\" >";
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo do_shortcode(stripslashes(htmlspecialchars_decode('[vc_row][vc_column][fw_review_carousel prodsperrow="1"][/vc_column][/vc_row]')));
		echo "</div>";
	}
	echo '</div>';
}

add_shortcode('fw_builder_headers','fw_builder_headers');
function fw_builder_headers(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'header' ) === false) continue;
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo '<header id="header" style="border:2px solid black;margin-bottom:50px;" class="'.$clase.'">';
		echo do_shortcode(stripslashes(htmlspecialchars_decode($code)));
		echo '</header>';
	}
	echo '</div>';
}

add_shortcode('fw_builder_mobilehs','fw_builder_mobilehs');
function fw_builder_mobilehs(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'mobileh' ) === false) continue;
		echo "<div class=\"container\" >";
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo '<header id="header" style="border:2px solid black;margin-bottom:50px;" class="'.$clase.'">';
		echo do_shortcode(stripslashes(htmlspecialchars_decode($code)));
		echo '</header>';
		echo "</div>";
	}
	echo '</div>';
}

add_shortcode('fw_builder_prod_loops','fw_builder_prod_loops');
function fw_builder_prod_loops(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'fw_prod_' ) === false) continue;
		global $preset_class,$preset_code;
		$preset_class=$clase;
		$preset_code=$code;

		echo "<div class=\"container\" style=\"border:2px solid black;margin-bottom:50px;padding:10px;\" >";
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo do_shortcode(stripslashes(htmlspecialchars_decode('[vc_row][vc_column][fw_featured_products][/vc_column][/vc_row]')));
		echo "</div>";
	}
	echo '</div>';
}


add_shortcode('fw_builder_cat_loops','fw_builder_cat_loops');
function fw_builder_cat_loops(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'fw_cat_' ) === false) continue;
		global $preset_class,$preset_code;
		$preset_class=$clase;
		$preset_code=$code;

		echo "<div class=\"container\" style=\"border:2px solid black;margin-bottom:50px;padding:10px;\" >";
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		$cates="";
		if($clase=='fw_cat_loop_2')$cates='';//'[vc_row el_id="categorias" el_class="carusel_block categories"][vc_column][product_categories orderby="" order="ASC" columns="2" ids="50,47,49,48"][/vc_column][/vc_row]';
		if($clase=='fw_cat_loop_4')$cates='[vc_row][vc_column][fw_categories_carousel cats="4-auriculares,4-camaras,4-drones,4-proyectores"][/vc_column][/vc_row]';
		if($clase=='fw_cat_loop_5')$cates='[vc_row][vc_column][fw_categories_carousel cats="5-clothing,decor,5-music,5-shorts"][/vc_column][/vc_row]';
		
		echo do_shortcode(stripslashes(htmlspecialchars_decode($cates)));
		echo "</div>";
	}
	echo '</div>';
}
add_shortcode('fw_builder_icons','fw_builder_icons');
function fw_builder_icons(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'fw_iconos_home_' ) === false) continue;
		global $preset_class,$preset_code;
		$preset_class=$clase;
		$preset_code=$code;
		echo "<div class=\"container\" style=\"border:2px solid black;margin-bottom:50px;padding:10px;\" >";
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo do_shortcode(stripslashes(htmlspecialchars_decode($code)));
		echo "</div>";
	}
	echo '</div>';
}

add_shortcode('fw_builder_footers','fw_builder_footers');
function fw_builder_footers(){
	echo "<div class='fw_builder_template'>";
	foreach(preset_db(null) as $clase=>$code){
		if(strpos( $clase, 'footer_' ) === false) continue;
		echo "<h2>.".$clase."</h2>".refes_db($clase);
		echo '<footer id="footer" style="border:2px solid black;margin-bottom:50px;" class="'.$clase.'">';
		echo "<div class='container'>";
		echo do_shortcode(stripslashes(htmlspecialchars_decode($code)));
		echo '</div></footer>';
	}
	echo '</div>';
}
?>