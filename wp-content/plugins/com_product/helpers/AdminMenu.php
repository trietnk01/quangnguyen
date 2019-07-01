<?php
class AdminMenu{
	public function __construct(){
		if(isset($_GET['post_type']) && $_GET['post_type'] == 'zaproduct'){
			add_action('admin_enqueue_scripts', array($this,'add_js'));
		}
	}
	public function add_js(){
		wp_register_script("admin_menu",PLUGIN_URL . "public/backend/js/admin_menu.js" ,array('jquery'),'1.0',true);
		wp_enqueue_script("admin_menu");
	}
}