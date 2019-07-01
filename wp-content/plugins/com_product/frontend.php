<?php
class Frontend{
	public function __construct(){
		global $zController;
		add_filter('template_include', array($this,'load_template'));
		add_action('init', array($this,'do_output_buffer'));

	}
	public function do_output_buffer(){
		ob_start();
	}
	public function load_template($templates){
		global $wp_query, $post;
		if(is_page() == 1){
			$page_template = get_post_meta($post->ID,'_wp_page_template', true);
			$file = PLUGIN_PATH . DS . "templates" . DS . "frontend". DS . $page_template;
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('za_category') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'za-category.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('za_category_trade') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'za-category.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('zaproduct') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'zaproduct.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('za_category_video') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'za-category-video.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('za_category_album') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'za-category-album.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('zaalbum') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'zaalbum.php';
			if(file_exists($file)){
				return $file;
			}
		}
		if(get_query_var('za_category_faq') != ''){
			$file = PLUGIN_PATH  . "templates" . DS . "frontend" . DS . 'za-category-faq.php';
			if(file_exists($file)){
				return $file;
			}
		}
		return $templates;
	}
}
