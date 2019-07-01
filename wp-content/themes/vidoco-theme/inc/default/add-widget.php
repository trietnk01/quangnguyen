<?php 
add_action('widgets_init', 'zendvn_theme_widgets_init');
function zendvn_theme_widgets_init(){
	$themeName="dienkimtheme";	
	register_sidebar(array(
		'name'          => __( 'XT counter visitor', $themeName ),
		'id'            => 'xt_counter_visitor',		
		'class'         => '',
		'before_widget' => '',
		'before_title'  => '',
		'after_title'   => '',
		'after_widget'  => ''				
	));
}
?>