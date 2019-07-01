<?php
// start insert contact
add_action( 'wp_ajax_insert_contact', 'func_ajax_insert_contact' );
add_action( 'wp_ajax_nopriv_insert_contact', 'func_ajax_insert_contact' );
function func_ajax_insert_contact(){

	$checked=1;
	$msg=array();
	$data=array();
	$k=0;

	$fullname = trim( $_POST['fullname'] );
	$phone = trim( $_POST['phone'] );
	$email = trim( $_POST['email'] );
	$title = trim( $_POST['title'] );
	$message = trim( $_POST['message'] );

	if(mb_strlen($fullname) < 5){
		$msg[$k] = 'Họ tên phải từ 5 ký tự trở lên';
		$data["fullname"]='';
		$checked = 0;
		$k++;
	}

	if(mb_strlen($phone) < 10){
		$msg[$k] = 'Điện thoại phải từ 10 ký tự trở lên';
		$data["phone"]='';
		$checked = 0;
		$k++;
	}

	if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#", mb_strtolower($email,'UTF-8')   )){
		$msg[$k] = 'Email không hợp lệ';
		$data["email"]='';
		$checked = 0;
		$k++;
	}

	if(mb_strlen($title) < 5){
		$msg[$k] = 'Tiêu đề phải từ 5 ký tự trở lên';
		$data["title"]='';
		$checked = 0;
		$k++;
	}

	if(mb_strlen($message) < 5){
		$msg[$k] = 'Nội dung liên hệ phải từ 5 ký tự trở lên';
		$data["message"]='';
		$checked = 0;
		$k++;
	}


	if($checked==1){
		$date_submit=datetimeConverter(date("Y-m-d"),"d/m/Y");
		$post_title = "Thông tin liên hệ từ SDT ".@$phone;
		$post_name = str_slug( $post_title );


		$insert = array(
			'post_type' => 'zacontact',
			'post_title' => $post_title ,
			'post_name' =>  $post_name  ,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_content' => $message,
		);
		$post_id = wp_insert_post($insert);
		update_post_meta( $post_id, 'op_contacted_name', $fullname);
		update_post_meta( $post_id, 'op_contacted_phone', $phone );
		update_post_meta( $post_id, 'op_contacted_email', $email );
		update_post_meta( $post_id, 'op_contacted_title', $title );
		update_post_meta( $post_id, 'op_contacted_date', $date_submit );

		/*require_once get_template_directory()."/scripts/phpmailer/PHPMailer.php";
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->CharSet = "UTF-8";
		$mail->Host ="smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = "dien.toannang@gmail.com";
		$mail->Password = "bjsdgetadsutdono";
		$mail->SMTPSecure = "ssl";
		$mail->Port = "465";
		$mail->setFrom('vidocodoc@gmail.com', get_bloginfo( 'name' ));
		$mail->addAddress(get_field("setting_thong_tin_chung_email","option"), get_bloginfo( 'name' ));
		$mail->Subject = "Thông tin liên hệ từ SDT ".@$phone ;

		$html_content='';
		$html_content .='<div><center><h2>THÔNG TIN KHÁCH HÀNG</h2></center></div>';
		$html_content .='<table border="1"  cellspacing="5" cellpadding="5" width="100%">';
		$html_content .='<tbody>';
		$html_content .='<tr><td width="20%">Người liên hệ</td><td width="80%">'.@$fullname.'</td></tr>';
		$html_content .='<tr><td>Ngày liên hệ</td><td>'.@$date_submit.'</td></tr>';
		$html_content .='<tr><td>Email</td><td>'.@$email.'</td></tr>';
		$html_content .='<tr><td>Điện thoại</td><td>'.@$phone.'</td></tr>';
		$html_content .='<tr><td>Nội dung</td><td>'.@$message.'</td></tr>';
		$html_content .='</tbody>';
		$html_content .='</table>';

		$mail->msgHTML($html_content);
		$mail->Send();*/

		$msg[$k]='Gửi thông tin thành công';
	}
	$result=array(
		"checked"       => 	$checked,
		"msg"			=>	$msg,
		"dulieu"		=>	$data,
	);
	echo json_encode($result);
	die();
}
// end insert contact
// start insert subcriber
add_action( 'wp_ajax_insert_subcriber', 'func_ajax_insert_subcriber' );
add_action( 'wp_ajax_nopriv_insert_subcriber', 'func_ajax_insert_subcriber' );
function func_ajax_insert_subcriber(){
	$checked=1;
	$msg=array();
	$data=array();
	$k=0;
	$email = trim( $_POST['email'] );
	if(!preg_match("#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#", mb_strtolower($email,'UTF-8')   )){
		$msg[$k] = 'Email không hợp lệ';
		$data["email"]='';
		$checked = 0;
		$k++;
	}
	if($checked==1){
		$email_option_source=get_option('email_subcriber_source');
		if(count($email_option_source) == 0){
			$email_subcriber_source=array();
			$email_subcriber_source[]=$email;
			add_option( 'email_subcriber_source', $email_subcriber_source,'no' );
			$msg[$k]='Đăng ký email thành công';
		}else{
			if(!in_array($email, $email_option_source)){
				$email_option_source[]=$email;
				update_option( "email_subcriber_source" ,$email_option_source, "no" );
				$msg[$k]='Đăng ký email thành công';
			}else{
				$msg[$k] = 'Email đã tồn tại trong hệ thống';
				$checked = 0;
			}
		}
	}
	$result=array(
		"checked"       => 	$checked,
		"msg"			=>	$msg,
		"dulieu"		=>	$data,
	);
	echo json_encode($result);
	die();
}
// end insert subcriber
// start load_price_min_max
add_action( 'wp_ajax_load_price_min_max', 'func_ajax_load_price_min_max' );
add_action( 'wp_ajax_nopriv_load_price_min_max', 'func_ajax_load_price_min_max' );
function func_ajax_load_price_min_max(){
	$price_min=200000;
	$price_max=6000000;
	$args = array(
		'post_type' => 'zaproduct',
		'posts_per_page' => 1,
		'orderby'  => array( 'meta_value_num' => 'ASC'),
		'meta_key' => 'zaproduct_price',
	);
	$the_query = new WP_Query( $args );
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$post_id=$the_query->post->ID;
			$price_min=get_field('zaproduct_price',$post_id);
		}
		wp_reset_postdata();
	}
	$args = array(
		'post_type' => 'zaproduct',
		'posts_per_page' => 1,
		'orderby'  => array( 'meta_value_num' => 'DESC'),
		'meta_key' => 'zaproduct_price',
	);
	$the_query = new WP_Query( $args );
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$post_id=$the_query->post->ID;
			$price_max=get_field('zaproduct_price',$post_id);
		}
		wp_reset_postdata();
	}
	$result=array(
		"price_min"     =>	$price_min,
		"price_max"		=>	$price_max,
	);
	echo json_encode($result);
	die();
}
// end load_price_min_max
/* begin add to cart */
add_action('wp_ajax_add_to_cart','add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');
function add_to_cart(){
	global $zController;
	$id=(int)@$zController->getParams("id");
	$quantity=(int)@$zController->getParams("quantity");
	$arg=array(
		'p'=>$id,
		'post_type'=>'zaproduct'
	);
	$product_id=0;
	$product_sku='';
	$product_name='';
	$product_image='';
	$product_price=0;
	$product_quantity=0;
	$total_quantity=0;
	$permalink="";
	$data=array();
	$the_query=new WP_Query($arg);
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$post_id=$the_query->post->ID;
			$title=get_the_title($post_id);
			$featured_img=get_the_post_thumbnail_url($post_id, 'full');
			$product_image=$featured_img;
			$price=get_field('zaproduct_price',@$post_id);
			$sale_price=get_field('zaproduct_sale_price', @$post_id);
			$product_id=$post_id;
			$product_sku=get_field( 'zaproduct_sku',@$post_id);
			$product_name=$title;
			$product_price=$price;
			if((float)@$sale_price < (float)@$price){
				$product_price=$sale_price;
			}
			$product_quantity=(float)@$quantity;
			$ssName="vmart";
			$ssValue="zcart";
			$ssCart 	= $zController->getSession('SessionHelper',$ssName,$ssValue);
			$arrCart = @$ssCart->get($ssValue)['cart'];
			if($product_id > 0){
				if(count($arrCart) == 0){
					$arrCart[$product_id]["product_quantity"] = $product_quantity;
				}else{
					if(!isset($arrCart[$product_id])){
						$arrCart[$product_id]["product_quantity"] = $product_quantity;
					}else{
						$arrCart[$product_id]["product_quantity"] = $arrCart[$product_id]["product_quantity"] + $product_quantity;
					}
				}
				$arrCart[$product_id]["product_id"]=$product_id;
				$arrCart[$product_id]["product_sku"]=$product_sku;
				$arrCart[$product_id]["product_name"]=$product_name;
				$arrCart[$product_id]["product_image"]=$product_image;
				$arrCart[$product_id]["product_price"]=$product_price;
				$product_quantity=(float)@$arrCart[$product_id]["product_quantity"];
				$product_total_price=$product_price * $product_quantity;
				$arrCart[$product_id]["product_total_price"]=($product_total_price);
				$cart['cart']=$arrCart;
				$ssCart->set($ssValue,$cart);
				$source_cart = @$ssCart->get($ssValue)['cart'];
				if(count($source_cart) > 0){
					foreach($source_cart as $key => $value){
						$total_quantity+=(int)@$value['product_quantity'];
					}
				}
				$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');
				$permalink = get_permalink($pageID);
				$data=array(
					'total_quantity'=>$total_quantity,
					'permalink'=>$permalink
				);
			}
		}
		wp_reset_postdata();
	}
	echo json_encode($data);
	die();
}
/* end add to cart */
/* begin load payment method */
add_action('wp_ajax_load_payment_method_info','load_payment_method_info');
add_action('wp_ajax_nopriv_load_payment_method_info', 'load_payment_method_info');
function load_payment_method_info(){
	global $zController;
	$payment_method_id=(float)@$zController->getParams("payment_method_id");
	$data=array();
	$args=array(
		"post_type"=>"zapayment_method",
		"p"=>$payment_method_id
	);
	$the_query = new WP_Query( $args );
	if($the_query->have_posts()){
		while ($the_query->have_posts()) {
			$the_query->the_post();
			$post_id=$the_query->post->ID;
			$title=get_the_title($post_id);
			$content=apply_filters( "the_content", get_the_content( null,false ) );
			$data["id"]=$post_id;
			$data["title"]=$title;
			$data["content"]=$content;
		}
		wp_reset_postdata();
	}
	echo json_encode($data);
	die();
}
/* end load payment method */
?>