<?php

if ( ! defined( 'ABSPATH' ) )exit;
echo fw_parse_mail('admin_new_order',$order, $sent_to_admin, $plain_text,$email_heading,$email);

