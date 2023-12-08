<?php 
if( strlen( $title ) > 0 )echo '<h3 class="heading-title" style="margin-bottom:20px;">'.$title.'</h3>';
$rand=generateRandomString(5);
?>
<div id="<?=$rand?>" class="swiper-posts swiper-posts-<?=$rand?> over-hidden relative">
<div class="swiper-wrapper clear-ul">
<?php 
if(!$autoplay)$autoplay='false';
if(!$loop)$loop='false';
$cant=1;	
global $fw_loop_event;	
while ($posts->have_posts()){
    $cant++;
    $posts->the_post(); 
    $fw_loop_event= get_post();
    echo '<div class="swiper-slide" data-swiper-autoplay="'.$slider_delay.'">';
    echo fw_loop_event();
    echo '</div>';
    ?>
<?php } ?>
</div>
<?php if($cant>=$prodsperrow){?>
<div class="swiper-arrows swiper-prev swiper-posts-<?=$rand?>-prev"><i class="fa fa-angle-left"></i></div>
<div class="swiper-arrows swiper-next swiper-posts-<?=$rand?>-next"><i class="fa fa-angle-right"></i></div>
<?php } ?>
</div>
 <script>
     var postswiper2 = new Swiper('.swiper-posts-<?=$rand?>', {
            navigation: {
                nextEl: '.swiper-posts-<?=$rand?>-next',
                prevEl: '.swiper-posts-<?=$rand?>-prev',
            }, 
            slidesPerView: <?=$prodsperrow?>,
            slidesPerGroup:<?=$prodsperrow?>,
            paginationClickable: true,
            preventClicks: false,
            preventClicksPropagation: false,
            spaceBetween: 10,
            loop: <?=$loop;?>,
            touchRatio: 0 ,
            autoplay: <?=$autoplay;?>,
	        autoplayDisableOnInteraction: false,
            breakpoints: {
            // when window width is <= 320px
                900:    {slidesPerView: 1,slidesPerGroup:1},
            }
        });
  </script>



<style>
    
</style>