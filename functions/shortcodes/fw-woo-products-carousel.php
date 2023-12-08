<?php 
if( strlen( $title ) > 0 ):
    echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
endif;

$rand=generateRandomString(5);
?>
<div id="<?=$el_id?>" class="swiper-products swiper-products-<?=$rand?> over-hidden relative <?=$el_class?>">
<div class="swiper-wrapper clear-ul">
<?php 
if(!$autoplay)$autoplay='false';
if(!$loop)$loop='false';
$cant=1;		
while ( $products->have_posts() ) : 
    $cant++;
    $products->the_post(); 
    global $product;
    echo '<div class="swiper-slide '.get_attrClasses($product).'" data-swiper-autoplay="'.$slider_delay.'">';
    wc_get_template_part( 'content','product' ); 
    echo '</div>';    
endwhile; 
?>
</div>
<?php
if($cant>=$columns){?>
<div class="swiper-arrows swiper-prev swiper-products-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-arrows swiper-next swiper-products-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
<?php } ?>
</div>
 <script>
     var ProductSwiper2 = new Swiper('.swiper-products-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-products-<?=$rand?>-next',
                prevEl: '.swiper-products-<?=$rand?>-prev',
            }, 
            slidesPerView: <?=$columns?>,
            slidesPerGroup:<?=$columns?>,
            paginationClickable: true,
            preventClicks: false,
            preventClicksPropagation: false,
            spaceBetween: <?=$space?>,
            loop: <?=$loop;?>,
            touchRatio: 0 ,
            autoplay: <?=$autoplay;?>,
	        autoplayDisableOnInteraction: false,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 2,slidesPerGroup:2},
                1000:   {slidesPerView: 3,slidesPerGroup:3},            
                1200:    {slidesPerView: 4,slidesPerGroup:4}
            }
        });
  </script>



  