<?php
$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
?>

<footer id="footer" class="<?=fw_theme_mod('fw_builder_footer_class')?>">
	<div class="<?php echo esc_attr( $container ); ?>">
    <?php 
    if(is_plugin_active("woocommerce/woocommerce.php")){
      if(!(is_checkout())){
        do_action( 'fastway_footer_init' );
      }
    }else{
      do_action( 'fastway_footer_init' );
    }
    ?>
	</div>
</footer>

<?php 
if(fw_theme_mod('footer-copyright-switch')){
  echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('footer-copyright-text'))));
}?>

<style type="text/css" id="css_editor-footer-copywright"><?php echo fw_theme_mod('css_editor-footer-copywright')?></style>
<?php wp_footer(); ?>
<script>
/*QUE ES ESTO?>!!!
var index = window.location.href.indexOf('?')
if(index != -1){
    var querystring = window.location.href.slice(index + 1)
    var tagA = document.getElementsByTagName('a');

    for(var i = 0; i < tagA.length; i++){
        var href = tagA[i].getAttribute('href');
        if(href){
          href += (href.indexOf('?') != -1)? '&' : '?';
          href += querystring;

          tagA[i].setAttribute('href', href);
        }
    }
}*/
</script>
<script><?php echo $js;?></script>

    <?php echo fw_theme_mod('fw_footer_scripts');?>
<?php  
if(usesWhatsapp())fw_whatsappfooter();
if(!is_plugin_active('Plugin-WooCommerce-master/index.php')){?>
<style>
#todopago-tab{
  display:none !important;
}
</style>
<?php } 

if(is_plugin_active('woocommerce/woocommerce.php'))get_template_part( 'global-templates/modals' );
if(fw_theme_mod("fw_popup_type")!='off' && is_front_page()){
?>

<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?=fw_theme_mod('popup-size')?>">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body" style="padding:0px;">
            <?php if(fw_theme_mod('fw_popup_type')=='image' && fw_theme_mod('fw_popup_img')){
              $linkpop=fw_theme_mod('fw_popup_link')?fw_theme_mod('fw_popup_link'):'#';
              ?>
              <a class="img" href="<?=$linkpop?>"><img width="100%" src="<?php echo fw_theme_mod('fw_popup_img');?>"/></a>
            <?php }else if(fw_theme_mod('fw_popup_type')=='html' && fw_theme_mod('fw_popup_html')){ ?>
              <?php echo do_shortcode(fw_theme_mod('fw_popup_html'));?>
            <?php } ?>
            <?php if(fw_theme_mod('fw_popup_form_mode')){?>
              <div class="modal_form"> <?php echo do_shortcode('[gravityform id="'.fw_theme_mod('fw_pupup_form_id').'" description="false" title="false" ajax="true"]')?></div>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">

jQuery(document).ready( function(jQuery) {
    
    var in_customizer = false;
    if ( typeof wp !== 'undefined' ) in_customizer =  typeof wp.customize !== 'undefined' ? true : false;
    let searchParams = new URLSearchParams(window.location.search)
    setTimeout(function(){
      if(searchParams.has('testmodal'))jQuery('#modalpopup').modal('show');
      if (jQuery.cookie('modal_shown') == null || in_customizer) {
        console.log('entra')
        jQuery.cookie('modal_shown', 'yes', { expires: 1, path: '/' });
        jQuery('#modalpopup').modal('show');
      }
   }, 2000);
});
</script>
<?php } ?> 
<?php if(get_option('fw_popup_unload_img') && (is_cart() || is_checkout() && !is_order_received_page())) { ?>
<div class="modal fade" id="modal_exit" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body"><img width="100%" src="<?=get_option('fw_popup_unload_img')?>"></div>
        </div>
      </div>
</div>
<script>
jQuery(document).bind("mouseleave", function(e) {
    console.log(e.pageY,jQuery(window).scrollTop())
    if (e.pageY - jQuery(window).scrollTop() < -2) {    
      jQuery('#modal_exit').modal('show');
    }
});
</script>
<?php } ?>
<script type="text/javascript">

jQuery(document).ready( function(jQuery) {
  let es_ES='<?=get_locale()=='es_ES'?>'
  let link='<?=fw_theme_mod('fw_arrepentimiento_link')?>'
  if(link && es_ES)jQuery('.copyright').append('<a class="botonarrepe" href="'+link+'">ARREPENTIMIENTO</a>');
});

function check_ga() {
  if (typeof ga === 'function') {
    console.log('Loaded :'+ ga);
    return true
  } else {
    console.log('Not loaded');
    setTimeout(check_ga,500);
  }
}
jQuery( ".btn-wapp" ).click(function() {
  
  console.log('eventAction:whatsapp' );
  let event='Whatsappp'
  if(window.ga)ga('send', {hitType: 'event',eventCategory: 'Contacto',eventAction: 'whatsapp', eventLabel: event});
  if(window.gtag)gtag('send', {hitType: 'event',eventCategory: 'Contacto',eventAction: 'whatsapp', eventLabel: event});
  if(window.dataLayer)window.dataLayer.push({'event': event});
  
  jQuery.get(ajaxurl,{'action': 'register_wp'});
});
jQuery(document).ready( function(jQuery) {
      if(jQuery('.qty').attr('max')){
        jQuery('.qty').on('click', function() {      //click en las flechas
          if(parseInt(jQuery('.qty').val()) > parseInt(jQuery('.qty').attr('max'))){
            alert('Está solicitando una cantidad que no tenemos en stock ')
          }
        });

        jQuery('.qty').on('change', function(e) {     //input manual escribe
          if(parseInt(jQuery('.qty').val()) > parseInt(jQuery('.qty').attr('max'))){
            alert('Está solicitando una cantidad que no tenemos en stock ')
            jQuery('.qty').val(jQuery('.qty').attr('max'))
          }
        });
      }
      let searchParams = new URLSearchParams(window.location.search)
      if ( jQuery.cookie('visited') == null || searchParams.has('visited') ){
        jQuery.cookie('visited', 'yes', { expires: 1, path: '/' });
        
        jQuery.get(ajaxurl,{'action': 'register_visit'});
      }
});

</script>
</body>
<style>
.botonarrepe{
  font-size:10px;
  color:var(--main);
  border:1px solid var(--main);
  border-radius:5px;
  margin-left:5px;
  padding:5px;
}
.widecolumn {
    max-width: 1200px;
  margin:0 auto;
  margin-top:100px;
}

.page- footer,
.page- #fw_footercopy{
    display:none !important;
}

</style>
</html>


