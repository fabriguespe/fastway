<?php


defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); 

$html =fw_theme_mod('fw_email_content_customer_new_account');

$emailValues = array(
    'blogname' => get_bloginfo( 'name' ),
    'user_name' => esc_html( $user_login ),
    'user_pass' => esc_html( $user_pass) ,
    'myaccount' => make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) )
);

foreach ($emailValues as $key => $value) $html = str_replace("{{". $key . "}}", $value, $html);
echo wp_kses_post( wpautop( wptexturize($html)));


?>

