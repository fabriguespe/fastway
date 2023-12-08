<div id="shipping-calc">
	<span style="display:block;"><?=fw_theme_mod('fw_label_calcular_costo_envio')?>:</span>
	<i class="fad fa-shipping-fast" style="color:var(--second);"></i>
	<input type="tel" id="wscp-postcode" autocomplete="off"  name="wscp-postcode" class="input-text text" style="width:70px;font-size:10px !important;" placeholder="CP" />
	<input type="button" id="wscp-button" class="btn_mp_calc_shipping" value="Calcular" >
	<input type="hidden" name="wscp-nonce" id="wscp-nonce" value="<?= wp_create_nonce( "wscp-nonce" ); ?>">
	<div id="wscp-response"></div>
</div>