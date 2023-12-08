
  <?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);

?>
<div class="swiper-cats-<?=$rand?> over-hidden relative">
<div class="swiper-wrapper clear-ul">

<?php 
//Si tiene las mismas columnas , no es slider.
if(!$autoplay)$autoplay='false';
global $fw_woo_cat;          
foreach ($terms as $term) {
    echo '<div class="swiper-slide" data-swiper-autoplay="'.$slider_delay.'">';
    $fw_woo_cat=$term;
    echo woo_loop_cat();
    echo '</div>';
    
}
?>
</div>
<?php //if($columns<count($terms)){ ?>
<div class="swiper-prev swiper-cats-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-next swiper-cats-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
<?php //} ?>
</div>
 <script>
     var ProductSwiper = new Swiper('.swiper-cats-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-cats-<?=$rand?>-next',
                prevEl: '.swiper-cats-<?=$rand?>-prev',
            },   
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            preventClicks: false,
            preventClicksPropagation: false,
            spaceBetween: 10,
            loop: true,
            touchRatio: 0 ,
            autoplay: <?=$autoplay;?>,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>