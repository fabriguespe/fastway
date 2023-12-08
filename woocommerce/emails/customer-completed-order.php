<?php

if ( ! defined( 'ABSPATH' ) )exit;

echo fw_parse_mail('customer_completed_order',$order, $sent_to_admin, $plain_text,$email_heading,$email);

