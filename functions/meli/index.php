<?php
session_start();

$path = preg_replace('/wp-content.*$/','',__DIR__);
require_once($path."/wp-load.php");
$appId = fw_theme_mod('fw_ml_appid');//fw_theme_mod('fw_ml_appid');;//mlsync
$secretKey = fw_theme_mod('fw_ml_appsecret');
echo "App Id:".$appId.'<br>';
echo "secretKey:".$secretKey.'<br><br>';

$redirectURI = 'https://'.$_SERVER['HTTP_HOST'].'/wp-content/themes/fastway/functions/meli/';
$siteId = 'MLA';

$meli = new Meli($appId, $secretKey);

if($_GET['code']) {
	// If the code was in get parameter we authorize
	$user = $meli->authorize($_GET['code'], $redirectURI);
	$iduser=$user['body']->user_id;
	$access_token= $user['body']->access_token;
	
    $_SESSION['user_id'] = $user['body']->user_id;
    $_SESSION['access_token'] = $user['body']->access_token;

	$_SESSION['expires_in'] = $user['body']->expires_in;
	$_SESSION['refresh_token'] = $user['body']->refresh_token;
	// We can check if the access token in invalid checking the time
	if($_SESSION['expires_in'] + time() + 1 < time()) {
		try {
			print_r($meli->refreshAccessToken());
		} catch (Exception $e) {
			echo "Exception: ",  $e->getMessage(), "\n";
		}
	}
	
    saveconfig($_SESSION['user_id'],$_SESSION['access_token'],$_SESSION['refresh_token']);
    echo "Exito ".$_SESSION['user_id'];



    

} else {
	echo '<div class="cuerpo"><a href="' . $meli->getAuthUrl($redirectURI, Meli::$AUTH_URL['MLA']) . '">Autorizar</a></div>';

}
