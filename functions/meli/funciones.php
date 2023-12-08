<?php


function saveconfig($iduser,$access_token,$refresh_token){
    if(empty($access_token)|| empty($iduser) || empty($refresh_token)){
		echo "ERROR";
		return;
	}
	$vars=array(
        "iduser" => $iduser,
        "access_token" => $access_token,
		"refresh_token" => $refresh_token
	);
	update_option('fw_ml_app_'.$iduser,$vars);
    return $vars;
}


function getconfig($iduser){
	$vars=get_option('fw_ml_app_'.$iduser,$vars);
	return $vars;
}
