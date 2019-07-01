<?php
/*
Plugin Name: com_product
Plugin URI: http://cloudbeauty.vn
Description: Xay dung shopping don gian WP
Author: laptrinhtainhatui
Version: 1.0
Author URI: http://cloudbeauty.vn
*/
ob_start();
require_once 'define.php';
require_once PLUGIN_PATH . DS .  'includes'. DS .'Controller.php';
$zController;
$zendvn_sp_settings;
$zController = new zController();
if(!class_exists('HtmlControl')){
	require_once PLUGIN_PATH . DS . 'includes'. DS .'html.php';
}
if(is_admin()){
	require_once 'backend.php';
	new Backend();
	$zController->getHelper("AdminMenu");
	$zController->getController('/backend','AdminProductController');
}else{
	require_once 'frontend.php';
	new Frontend();
}
add_action('init','zendvn_sp_session_start',1);
function zendvn_sp_session_start(){
	if(!session_id()){
		session_start();
	}
}


