<?php



function loadnoimgs($phpprefix,$usesame=false){
    global $TEMPLATE_DIR,$CHILDTEMPLATE_DIR;
    $lavar=$phpprefix."s";
    $dires=array();
    array_push($dires,new DirectoryIterator($TEMPLATE_DIR .$lavar));
    $path=$CHILDTEMPLATE_DIR .$lavar;
    if(is_dir($path))array_push($dires,new DirectoryIterator($path)); 
    $miarray=array();
    if($usesame)$miarray[0]= "Use same as desktop";
    foreach($dires as $dir){
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if(!strpos($fileinfo->getFilename(),".php"))continue;
                $nombresinphp=str_replace(".php", "", $fileinfo->getFilename());
                $nombre= str_replace($phpprefix."-", "",$nombresinphp );
                $i=explode("-", $nombre)[0];
                $j=explode("-", $nombre)[1];
                $alt=$i;
                if(isset($j))$alt.="-".$j;
                
                $miarray[$alt] =$nombresinphp;
            }
        }
    }
    
    

    return $miarray;
}


function seporate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, $depth=0 ) {
    // Loop through $classes array to find linkmod or icon classes.
    foreach ( $classes as $key => $class ) {
        // If any special classes are found, store the class in it's
        // holder array and and unset the item from $classes.
        if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
            // Test for .disabled or .sr-only classes.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
            // Test for .dropdown-header or .dropdown-divider and a
            // depth greater than 0 - IE inside a dropdown.
            $linkmod_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
        
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        } elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
            // Glyphicons.
            $icon_classes[] = $class;
            unset( $classes[ $key ] );
        }
    }

    return $classes;
}
//generate username for gravity forms
add_filter( 'gform_username', 'fw_auto_username', 10, 4 );
function fw_auto_username( $username, $feed, $form, $entry ) {
    $username=str_replace(' ', '', $username);
	//$username = strtolower( rgar( $entry, '2.3' ) . rgar( $entry, '2.6' ) );
	$username = sanitize_user( current( explode( '@', $username ) ), true );
	
	if ( empty( $username ) ) {
		return $username;
	}
	
	if ( ! function_exists( 'username_exists' ) ) {
		require_once( ABSPATH . WPINC . '/registration.php' );
    }
	if ( username_exists( $username ) ) {
		$i = 2;
		while ( username_exists( $username . $i ) ) {
			$i++;
		}
		$username = $username . $i;
	};
	
	return $username;
}


function fw_modal_block($rand,$id,$iframe=false,$size="modal-lg"){
    if(!$iframe){
        $block=fw_StaticBlock::getSticBlockContent($id,true);
        //$block=nl2br($block);
    }
    else $block='<iframe height="700" width="100%" frameBorder="0" scrolling="auto" src="'.$id.'" ></iframe>';
  return <<<HTML
<!-- Modal -->
<div class="modal fade" id="$rand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog $size" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body">
        $block
        </div>
    </div>
  </div>
</div>
HTML;
}


if( !function_exists( 'fw_menu' ) ) {
    add_shortcode('fw_menu', 'fw_menu');
    function fw_menu( $atts ) {
        $atts = shortcode_atts(array('id' => 'primary' ), $atts );
        $id=$atts['id'];
        $isprimary=false;
        if ( empty($id) ) return;
        if (($locations = get_nav_menu_locations()) && isset($locations[$id]) ) {
            $menu = get_term( $locations[$id], 'nav_menu' );
            $isprimary=true;
            $menu_items = wp_get_nav_menu_items($menu->term_id);
        }else{
            $menu = wp_get_nav_menu_object($id);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
        }
        $megamenu=fw_theme_mod("mega_menu");
        $cols="";
        if($megamenu && $isprimary)$cols=fw_theme_mod("mega_menu_cols");
        $clasem="fwmenu1";
        $idmenu='';
        if($megamenu && $isprimary)$clasem="fw_mega_menu";
        if($isprimary)$idmenu="fw_menu";

        $menu_list  = '<nav id="'.$idmenu.'" class="'.$clasem.' navbar navbar-expand-md"><div class="collapse navbar-collapse" id=""><ul class="navbar-nav ">'."\n";

        if(empty($menu_items))return;
        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();


                $nuevoitem="";
                $first=false;
                foreach( $menu_items as $submenu ) {
                if( $submenu->menu_item_parent == $parent ) {
                        if($submenu->attr_title==="init_col" && $megamenu && $isprimary){
                            if($first)$menu_array[] ='</div>';
                            $first=true;
                            $menu_array[]='<div class="col-md-'.$cols.'">';
                        }
                        $bool = true;
                        $url=$submenu->url;
                        $title=$submenu->title;

                        $linkmod_classes = array();
                        $classes =implode(' ',$submenu->classes);
                        $icon_classes    = array();
                        $icon_classes=implode(' ',$icon_classes);
                        if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                


                        $childs=getChilds($submenu->ID,$menu_items);
                        //3er nivel
                        if($megamenu && $isprimary){
                            $menu_array[] = '<li class="dropdown-submenu '.$classes.' '.$submenu->attr_title.' nav-item menu-item padre"><a class="dropdown-item" href="' . $url . '">'.$icon_classes.' '. $title . '</a></li>' ."\n";
                            foreach( $childs as $s_submenu ) {
                                $s_url=$s_submenu->url;
                                $s_title=$s_submenu->title;
                                $menu_array[] = '<li class="nav-item hijo"><a class="nav-link " href="' . $s_url . '">' . $s_title . '</a></li>' ."\n";
                            }
                        }else if(!$megamenu && $isprimary){
                            $laclase="";
                            $toggle="";
                            if(count($childs)>0){
                                $laclase="dropdown-submenu";
                                $toggle='<span class="toggle"> > </span>';
                            }
                            $menu_array[] = '<li class="'.$laclase.' nav-item menu-item padre"><a class="dropdown-item" href="' . $url . '">'.$icon_classes.' '. $title .$toggle.'</a>';
                            if(count($childs)>0)$menu_array[] = '<ul class="dropdown-menu second" style="display:none;">';
                            foreach( $childs as $s_submenu ) {
                                $s_url=$s_submenu->url;
                                $s_title=$s_submenu->title;
                                $menu_array[] = '<li class="dropdown-item"><a href="'.$s_url.'">'.$s_title.'</a></li>';
                                
                            }
                            if(count($childs)>0)$menu_array[] = '</ul>';
                            $menu_array[] = '</li>' ."\n";
                            
                        }
                        
                    }
                }


                $linkmod_classes = array();
                $icon_classes    = array();
                $classes =implode(' ', seporate_linkmods_and_icons_from_classes( $menu_item->classes, $linkmod_classes, $icon_classes ));
                $icon_classes=implode(' ',$icon_classes);
                if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
           

                if( $bool == true && count( $menu_array ) > 0 ) {
                    
                    $menu_list .= '<li class="nav-item menu-item dropdown '.$classes.'">' ."\n";
                    $menu_list .= '<a href="#" class="dropdown-toggle nav-link "  data-toggle="collapse" role="button" aria-haspopup="true" aria-expanded="false">'.$icon_classes.' '.$menu_item->title . '</a>' ."\n";
            
                    $menu_list .= '<ul class="dropdown-menu first">' ."\n";
                    if($megamenu)$menu_list .= '<div class="container row">';
                
                    $menu_list .= implode( "\n", $menu_array );
                    if($megamenu)$menu_list .= '</div>';
                
                    $menu_list .= '</ul>' ."\n";
                    
                } else {
                    
                    $menu_list .= '<li class="nav-item menu-item '.$classes.'">' ."\n";
                    $menushort=$menu_item->title;
                    if(startsWith($menushort,"[") && endsWith($menushort,"]")) $menushort=do_shortcode($menushort);
                    $menu_list .= '<a href="'.$menu_item->url.'" class="nav-link" >'.$icon_classes.' '.$menushort . '</a>' ."\n";
                }
                
            }
            // end <li>
            $menu_list .= '</li>' ."\n";
            
        }
        $menu_list .= '</ul></div></nav>';
        if(fw_theme_mod("mega_menu_overlay") && $isprimary)$menu_list .= '<div class="submenu-overlay"></div>' ."\n";
        
        return $menu_list;
    }
}
// Function to check string starting 
// with given substring 
function startsWith ($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 
function endsWith($string, $endString) { 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
} 
  
function getChilds($parent,$menu_items){
    $devolver=array();
    foreach( $menu_items as $s_submenu ) 
        if( $s_submenu->menu_item_parent == $parent ) array_push($devolver,$s_submenu);
    return $devolver;
}
function fw_menu_vertical( $atts ) {
    $atts = shortcode_atts(array('id' => 'mobile' ), $atts );
    $id=$atts['id'];
    
    if ( ($id) && ($locations = get_nav_menu_locations()) && isset($locations[$id]) ) {
        $menu = get_term( $locations[$id], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $cols="";
        $clasem="fwmenu1";
  
        $menu_list  = '
        <div id="navBar" class="'.$clasem.' navbar-collapse py-0">
        <ul id="main-menu-mobile" class="navbar-nav ">'."\n";
 
        if(empty($menu_items))return;
        foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == 0 ) {
                $parent = $menu_item->ID;
                $menu_array = array();

                $linkmod_classes = array();
                $icon_classes    = array();
                $classes = seporate_linkmods_and_icons_from_classes( $menu_item->classes, $linkmod_classes, $icon_classes );
                $classes=implode(' ',$classes);
                $icon_classes=implode(' ',$icon_classes);
                if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                

                $nuevoitem="";
                $first=false;
                foreach( $menu_items as $submenu ) {
                   if( $submenu->menu_item_parent == $parent ) {
                        if($submenu->attr_title==="init_col" && $megamenu){
                            if($first)$menu_array[] ='</div>';
                            $first=true;
                            $menu_array[]='<div class="col-md-'.$cols.'">';
                        }
                        $bool = true;
                        $url=$submenu->url;
                        $title=$submenu->title;

                        $linkmod_classes = array();
                        $icon_classes    = array();
                        $classes = seporate_linkmods_and_icons_from_classes( $submenu->classes, $linkmod_classes, $icon_classes );
                  
                        $icon_classes=implode(' ',$icon_classes);
                        if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                
                        
                        $menu_array[] = '<li class="nav-item menu-item padre"><a class="dropdown-item" href="' . $url . '">'.$icon_classes.' '. $title . '</a></li>' ."\n";
                        //3er nivel
                        if($megamenu){
                            $s_parent = $submenu->ID;
                            foreach( $menu_items as $s_submenu ) {
                                if( $s_submenu->menu_item_parent == $s_parent ) {
                                  $s_url=$s_submenu->url;
                                  $s_title=$s_submenu->title;
                                  $menu_array[] = '<li class="nav-item hijo"><a class="nav-link" href="' . $s_url . '">' . $s_title . '</a></li>' ."\n";
                              } 
                            }
                           
                        }
                        
                    }
                }

                if( $bool == true && count( $menu_array ) > 0 ) {
                     
                    $menu_list .= '<li class="nav-item menu-item dropdown '.$classes.'">' ."\n";
                    $menu_list .= '<a href="#" class="dropdown-toggle nav-link " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$icon_classes.' '.$menu_item->title . '</a>' ."\n";
             
                    $menu_list .= '<ul class="dropdown-menu first">' ."\n";
                    if($megamenu)$menu_list .= '<div class="row">';
                
                    $menu_list .= implode( "\n", $menu_array );
                    if($megamenu)$menu_list .= '</div>';
                
                    $menu_list .= '</ul>' ."\n";
                     
                } else {
                     
                    $menu_list .= '<li class="nav-item menu-item '.$classes.'">' ."\n";
                    $menu_list .= '<a href="'.$menu_item->url.'" class="nav-link" >'.$icon_classes.' '.$menu_item->title . '</a>' ."\n";
                }
                 
            }
            // end <li>
            $menu_list .= '</li>' ."\n";
            
        }
        $menu_list .= '</ul></div>';
        
    } 
    return $menu_list;
}

function fw_menu_mobilenew( $atts ) {
    $atts = shortcode_atts(array('id' => 'mobile' ), $atts );
    $id=$atts['id'];
    
    if ( ($id) && ($locations = get_nav_menu_locations()) && isset($locations[$id]) ) {
        $menu = get_term( $locations[$id], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $yacreados=array();
        if(!empty($menu_items)){
            foreach( $menu_items as $menu_item ) {
                $padre=$menu_item->menu_item_parent;
                if ( !in_array($padre,$yacreados) ) {
                    $menu_list .= fw_menu_mobilenew_submenu($menu_items,$padre);
                    array_push($yacreados,$padre);
                }
            }
        }
        
        
    } 
    return $menu_list;
}

function fw_menu_parent_count($menu_items,$parent_id){
    if($parent_id==0)return 0;
    $cant=1;
    foreach( $menu_items as $menu_item_layer1 ){
        if( $menu_item_layer1->ID == $parent_id ){
            if($menu_item_layer1->menu_item_parent==0)return $cant;
            return $cant+1;
        } 
    }
    return $cant;
}
function fw_menu_children_count($menu_items,$parent_id){
    $cant=0;
    foreach( $menu_items as $menu_item )if( $menu_item->menu_item_parent == $parent_id ) $cant++;
     return $cant;
}
function fw_menu_mobilenew_submenu($menu_items,$parent_id){
    $cols="";
    $clasem="fwmenu1";
    $clasem.=' submenu-layer-'.fw_menu_parent_count($menu_items,$parent_id).' ';;
    $menu_list  = '
    <div id="submenu_'.$parent_id.'" class="'.$clasem.' navbar-collapse py-0">
    <ul id="main-menu-mobile" class="navbar-nav ">'."\n";
    if($parent_id>0){
        $menu_list.='
        <div class="categoria-menu-mobile">
            <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu"></span>
        </div>';
    }
    if(empty($menu_items))return;
    foreach( $menu_items as $menu_item ) {
            if( $menu_item->menu_item_parent == $parent_id ) {
                $parent = $menu_item->ID;
                $linkmod_classes = array();
                $icon_classes    = array();
                $classes = seporate_linkmods_and_icons_from_classes( $menu_item->classes, $linkmod_classes, $icon_classes );
                $classes=implode(' ',$classes);
                $icon_classes=implode(' ',$icon_classes);
                if(!empty($icon_classes))$icon_classes='<i class="'.esc_attr($icon_classes).'" aria-hidden="true"></i>';
                

                $nuevoitem="";
                $first=false;


                if($menu_item->attr_title!=="init_col"){
                    $menu_list .= '<li class="nav-item menu-item  '.$classes.'">' ."\n";
                    if( fw_menu_children_count($menu_items,$menu_item->ID) > 0 ){
                        $menu_list .= '<a onclick="mostrar_submenu('.$menu_item->ID.')" class="nav-link" >'.$icon_classes.' '.$menu_item->title;
                        $menu_list.='<i class="far fa-chevron-right"></i>';
                    }else{
                        $menu_list .= '<a href="'.$menu_item->url.'" class="nav-link" >'.$icon_classes.' '.$menu_item->title;
                    }
                    $menu_list .= '</a></li>';
                }else{
                    foreach( $menu_items as $menu_item ) {   
                        if( $menu_item->menu_item_parent == $parent ) {    
                            $menu_list .= '<li class="nav-item menu-item '.$menu_item->attr_title.' '.$classes.'">' ."\n";
                            if( fw_menu_children_count($menu_items,$menu_item->ID) > 0 ){
                                $menu_list .= '<a onclick="mostrar_submenu('.$menu_item->ID.')" class="nav-link" >'.$icon_classes.' '.$menu_item->title;
                                $menu_list.='<i class="far fa-chevron-right"></i>';
                            }else{
                                $menu_list .= '<a href="'.$menu_item->url.'" class="nav-link" >'.$icon_classes.' '.$menu_item->title;
                            }
                            $menu_list .= '</a></li>';
                        }
                    }

                }
                 
            }
            // end <li>
            
        }
        $menu_list .= '</ul></div>';
        return $menu_list;
}
function fw_getmsliders(){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'ml-slider',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $jaja=array(get_the_title($block->ID)=>$block->ID);
        $res_args=array_merge($res_args,$jaja);
    }
    return $res_args;
}



function fw_custom_loginui() {
    $image=fw_theme_mod('general-logo');
    if(fw_theme_mod('ca-clientarea-logo'))$image=fw_theme_mod('ca-clientarea-logo');

echo '<style type="text/css">
h1 a {background-image: url('.$image.') !important; }
/*LOGIN*/
#login h1 a{
    width:100%;
    background-size: auto auto;
    background-size: contain; 
}
p.register{
    display:none;
}
button,a,input,textarea,.vc_row,ul,li,div{
    border-radius:0px !important;
}
.login{
    background:white !important;
}
#loginform{
    border: 1px solid '.fw_theme_mod('ca-main-color').';
}
/*FIX TERMS*/
.login .privacy-policy-page-link{
	display:none !important;
}
#wp-submit{
    color: white;
    border:0px !important;
    border-radius:0px;
    background: '.fw_theme_mod('ca-main-color').' !important;
    text-shadow:none;
    -webkit-box-shadow:none;
}';
echo fw_theme_mod('ca-customcss');
echo '</style>';

}
add_action('login_head', 'fw_custom_loginui');

//if(fw_theme_mod("maintainance-mode"))add_action('get_header', 'fw_maintenance_mode');
function fw_maintenance_mode(){
    if(!current_user_can('administrator') )wp_die(do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('maintainance_code')))));
}

add_action('admin_head', 'custom_redux_panel');
function custom_redux_panel() {
  echo '<style>
    #redux-header,#redux-intro-text{
display:none;
}
.redux-group-menu i{
color: '.fw_theme_mod('ca-main-color').';
}
.redux-group-menu{
background:white;
}
.redux-main{
    background:white !important;
}
.redux-main .button-primary,
.admin-color-fresh .redux-field-container .ui-buttonset .ui-state-active,
.redux-main .redux-container-switch .cb-enable.selected{
    background:'.fw_theme_mod('ca-main-color').' !important;
    border:0px !important;
    text-shadow:none !important;
    box-shadow:none !important;
}

  </style>';
}


function fw_header_builder($atts = [], $content = null){
    $atts = shortcode_atts(array('class' => '','type' => '','id' => 'middle' ), $atts );
    if(!empty($atts['type']))$atts['id']=$atts['type'];
    $header_class=" fw_header ".$atts['class']." ".$atts['id']." desktop d-none d-md-block ";
    $header_container   = fw_theme_mod('header-width');
    //if(fw_theme_mod("transparent-header") && is_home())$header_class.=" fw_transparent_header ";
    $volver='<div class="'.esc_attr( $header_class ).'">';
    $volver.='<div class="'.esc_attr( $header_container).'">';
    $volver.='<div class=" d-flex row align-items-center codes">';
    $volver .= do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    $volver .='</div></div></div>';
    
    return $volver;
}
add_shortcode('fw_header', 'fw_header_builder');

add_shortcode('fw_m_header', 'fw_header_builder_mobile');
function fw_header_builder_mobile($atts = [], $content = null){
    $atts = shortcode_atts(array('type' => '','id' => 'middle'  ), $atts );
    if(!empty($atts['type']))$atts['id']=$atts['type'];


    $clasem="d-md-none";
    global $post;
    $post_slug = $post->post_name;
    if($post_slug=='mobilehs')$clasem="";

    $volver.='<div class="navbar fw_header '.fw_theme_mod('fw_builder_mheader_class').' '.$atts['id'].' '.$clasem.' mobile codes">';
    $volver .= do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    $volver .='</div>';

    return $volver;
}
function usesWhatsapp(){
    return fw_theme_mod('whats-button')!='none';
}

function fw_header_html(){
    if(is_plugin_active('woocommerce/woocommerce.php') && is_checkout()/* && !is_order_received_page()*/){
        return do_shortcode(stripslashes(htmlspecialchars_decode('[fw_header][fw_logo][fw_compra_protegida][/fw_header]')));
    }
    return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header_code'))));
  }
  function fw_header_html_mobile(){
    if(is_plugin_active('woocommerce/woocommerce.php') && is_checkout()/* && !is_order_received_page()*/){
        return do_shortcode(stripslashes(htmlspecialchars_decode('[fw_m_header][fw_logo][/fw_m_header]')));
    }
    return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('header_mobile_code'))));
  }


add_action( 'fastway_footer_init', 'fastway_footer_block', 10 );
add_action( 'fastway_singleblock_init', 'fastway_singleblock_block', 10 );



function fw_custom_css(){
    $css="";
    
    if(fw_theme_mod('responsive-typo')){
        $tipos=array("p","span","a","li","h4","h3","h2","h1");
        foreach ($tipos as $key) {    
            if($key == "a" || $key == "div" || $key == "p" || $key == "span" || $key == "li" )$nombre='opt-typography-body';
            else $nombre='opt-typography-'.$key;
            if(empty(fw_theme_mod($nombre)))continue;
            $font=fw_theme_mod($nombre);
            $size=str_replace("px", "", $font['font-size']);
            $height=str_replace("px", "", $font['line-height']);
            $resized=round($size*0.7);
            if($resized<16)$resized=16;
            $css.= "body ".$key."{";
            $css.= "font-size: calc(".$resized."px + (".$size." - ".$resized.") * ((100vw - 300px) / (1600 - 300))); ";
            $css.= "line-height: calc(".($resized+4)."px + (".$height." - ".($resized+4).") * ((100vw - 300px) / (1600 - 300))); ";
            $css.= "}";   
        }
       
    }
    //Oculta las partes del sticky
    if(!empty(fw_theme_mod('sticky-menu'))){
        foreach(fw_theme_mod('sticky-menu') as $key){
           $css.=".fw_sticky_header .".$key."{
                display:none !important;
           }";
        }
    }
    if(fw_theme_mod('fw_general_ratio')>0){
        $css.="
        body button,body a.btn,body a.button,body input{
          border-radius:".fw_theme_mod('fw_general_ratio')."px !important;
        }";
    }
    return $css;
}
add_action( 'add_topbar', 'get_topbar' );
function get_topbar(){
    
    $container = fw_theme_mod('header-width');
    if(!fw_theme_mod('top-header'))return;
    echo '<div class="fw_header top d-none d-lg-flex py-2">
    <div class="'. esc_attr( $container ).'">
    <div>';
    $sidebar_name = "header-top-widget-area";
    if( is_active_sidebar( $sidebar_name ) ):
        echo '<ul class="widgets-sidebar">';
        dynamic_sidebar( $sidebar_name );
        echo '</ul>';
    else:
        esc_html_e( "Please add some widgets here!","fastway" );
    endif;
    echo '</div> </div>  </div>';
}


function fw_add_to_pages() {  
    // Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page'); 
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'fw_add_to_pages' );
if(!function_exists('fastway_getImage')) {
    function fastway_getImage($atts){
        $atts = wp_parse_args($atts, array(
            'alt'   => 'image alt',
            'width' => '',
            'height' => '',
            'src'  => '',
            'class' => 'fastway-image'
        ));

        $src = esc_url($atts['src']);

        if(strlen(trim($src)) > 0) {
            $_img = '<img';
            foreach($atts as $k => $v) {
                if(empty($v)) continue;
                $_img .= " {$k}=\"{$v}\"";
            }
            $_img .= '>';
            return wp_kses($_img, array(
                'img' => array('alt' => array(), 'width' => array(), 'height' => array(), 'src' => array(), 'class' => array())
            ));
        }
    }
}




add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    
  $cols =  fw_theme_mod('shop_per_page');
  return $cols;
}

/*Static Blocks*/
function fastway_footer_block(){
        
    if( !empty( fw_theme_mod("footer-stblock") ) && strlen( fw_theme_mod("footer-stblock")) > 0 && class_exists("fw_StaticBlock") ) {
        fw_StaticBlock::getSticBlockContent( fw_theme_mod("footer-stblock") );
    }
}

function fastway_singleblock_block(){
    
    if( !empty( fw_theme_mod("product-page-footer-block") ) && strlen( fw_theme_mod("product-page-footer-block") ) > 0 && class_exists("fw_StaticBlock") ) fw_StaticBlock::getSticBlockContent( fw_theme_mod("product-page-footer-block") );
}


function get_blocks( ){
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'DESC',
        'post_type'        => 'static-block',
        'post_status'      => 'publish',
    );
    
    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->ID;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'understrap_post_nav' ) ) :

    function understrap_post_nav() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next     = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous ) {
            return;
        }
        ?>
                <nav class="container navigation post-navigation">
                    <h2 class="sr-only"><?php _e( 'Post navigation', 'fastway' ); ?></h2>
                    <div class="row nav-links justify-content-between">
                        <?php

                            if ( get_previous_post_link() ) {
                                previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'fastway' ) );
                            }
                            if ( get_next_post_link() ) {
                                next_post_link( '<span class="nav-next">%link</span>',     _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'fastway' ) );
                            }
                        ?>
                    </div><!-- .nav-links -->
                </nav><!-- .navigation -->

        <?php
    }
endif;

function init_analytics() {
    
   /* $analytics = "<!-- Google Analytics -->
    <script>
    window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
    ga('create', '".fw_theme_mod('analytics-id')."', 'auto');
    ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <!-- End Google Analytics -->";*/
    $analytics= "<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=".fw_theme_mod('analytics-id')."'></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '".fw_theme_mod('analytics-id')."');
    </script>";

    echo "\n" . $analytics;
}
function init_mixpanel() {
    $analytics= '<script type="text/javascript">
    (function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
    for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
    MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);
    mixpanel.init("'.fw_theme_mod('mixpanel-id').'", {loaded: function(mixpanel) { 
        distinct_id = mixpanel.get_distinct_id();
        console.log("distinct_id",distinct_id)
        mixpanel.track("visit")
        console.log("visit");
    } });
    </script>';
    echo "\n" . $analytics;
 }
 
function init_fb() {
    $analytics = "<!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '".fw_theme_mod('fbpixel_id')."');
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height='1' width='1'
    src='https://www.facebook.com/tr?id=".fw_theme_mod("fbpixel_id")."&ev=PageView
    &noscript=1'/>
    </noscript>
    <!-- End Facebook Pixel Code -->";
    echo "\n" . $analytics;
}
function init_gtagmanager() {
    $analytics = "<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','".fw_theme_mod("gtagmanager_id")."');</script>
    <!-- End Google Tag Manager -->";
    echo "\n" . $analytics;
}
if(!empty(fw_theme_mod('gtagcheckout_id')))add_action( 'woocommerce_thankyou', 'init_gtagcheckout' );
if(!empty(fw_theme_mod('analytics-id')))add_action('wp_head', 'init_analytics', 35);
if(!empty(fw_theme_mod('mixpanel-id')))add_action('wp_head', 'init_mixpanel', 35);
if(!empty(fw_theme_mod('fbpixel_id')))add_action('wp_head', 'init_fb', 35);
if(!empty(fw_theme_mod('gtagmanager_id')))add_action('wp_head', 'init_gtagmanager', 35);
if(!empty(fw_theme_mod('thankyou_insert')))add_action( 'woocommerce_thankyou', 'bbloomer_conversion_tracking_thank_you_page' );

function bbloomer_conversion_tracking_thank_you_page() {
    echo fw_theme_mod('thankyou_insert');
}

function init_gtagcheckout() {
    
    $analytics = "<!-- Global site tag (gtag.js) - CHECKOUT -->
    <script>
  gtag('event', 'conversion', {
      'send_to': '".fw_theme_mod("gtagmanager_id")."/".fw_theme_mod("gtagcheckout_id")."',
      'transaction_id': ''
  });
</script>";
    echo "\n" . $analytics;
}


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}
?>