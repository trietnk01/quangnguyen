<?php
class AdminProductController{
	private $_metabox_id="zendvn-sp-zaproduct";
	private $_prefix_id="zendvn-sp-zaproduct-";
	private $_prefix_key="_zendvn_sp_zaproduct_";
	public function __construct(){
		global $zController;
		preg_match('#(?:.+\/)(.+)#', $_SERVER['SCRIPT_NAME'],$matches);
		$phpFile = $matches[1];
		if($zController->getParams("post_type")=="zaproduct"){
			if($phpFile == 'edit.php'){
				add_filter('manage_posts_columns', array($this,'add_column'));
				add_action('manage_zaproduct_posts_custom_column', array($this,'display_value_column'),10,2);
				add_filter('manage_edit-zaproduct_sortable_columns', array($this,'sortable_cols'));
				add_action('pre_get_posts', array($this,'modify_query'));
				add_action('restrict_manage_posts', array($this,'za_category_list'));
			}
		}
	}
	public function za_category_list(){
		global $zController;
		wp_dropdown_categories(array(
			'show_option_all' => __("Danh mục sản phẩm"),
			'taxonomy'			=> 'za_category',
			'name'				=> 'za_category',
			'orderby'			=> 'name',
			'selected'			=> $zController->getParams('za_category'),
			'hierarchical'		=> true,
			'depth'				=> 3,
			'show_count'		=> true,
			'hide_empty'		=> true,

		));
	}
	public function modify_query($query){
		global $zController;
		if($zController->getParams('orderby') == ''){
			$query->set('orderby','ID');
			$query->set('order','DESC');
		}

		$orderby = $query->get('orderby');

		if($orderby == 'view'){
			$query->set('meta_key',$this->create_key('view'));
			$query->set('orderby','meta_value_num');
		}


		if($zController->getParams('za_category') > 0){

			$tax_query = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'za_category',
					'field'		=> 'term_id',
					'terms'		=> $zController->getParams('za_category'),
				));
			$query->set('tax_query',$tax_query);
		}

	}
	public function sortable_cols($columns){
		$columns['id'] 		= 'ID';
		$columns['view'] 	= 'view';
		return $columns;
	}
	public function display_value_column($column,$post_id){
		if($column == 'id'){
			echo $post_id;
		}
		if($column == 'view'){
			$view  = get_post_meta($post_id, $this->create_key('view'),true);
			if($view == null){
				update_post_meta($post_id, $this->create_key('view'), 0);
				echo '0';
			}else{
				echo $view;
			}

		}
		if($column == 'category'){
			echo get_the_term_list($post_id, 'za_category','', ', ');
		}
	}
	public function add_column($columns){
		$newArr = array();
		foreach ($columns as $key => $title){
			$newArr[$key] = $title;
			if($key == 'author'){
				$newArr['category'] = __('Category');
			}
		}

		$new_columns = array(
			'view'=> __('View'),
			'id' => __('ID')
		);
		$newArr = array_merge($newArr,$new_columns);
		return $newArr;
	}
	public function create_id($val){
		return $this->_prefix_id . $val;
	}
	public function create_key($val){
		return $this->_prefix_key . $val;
	}
}