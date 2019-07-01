<?php
get_header();
$ssName="vmart";
$ssValue="zcart";
$ssCart     = $zController->getSession('SessionHelper',$ssName,$ssValue);
$arrCart = @$ssCart->get($ssValue)['cart'];
$total_quantity=0;
$total_price=0;
$page_id_zcart = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');
$permarlink_zcart = get_permalink($page_id_zcart);
if(count(@$arrCart) == 0){
    wp_redirect($permarlink_zcart);
}
$data_payment_method=array();
$data_payment_method[]=array("id"=>0,"title"=>"Hình thức thanh toán","content"=>"");
$args = array(
    'post_type' => 'zapayment_method',
    'orderby' => 'id',
    'order'   => 'DESC',
    'posts_per_page' => 9,
);
$the_query_payment_method=new WP_Query($args);
if($the_query_payment_method->have_posts()){
    while ($the_query_payment_method->have_posts()) {
        $the_query_payment_method->the_post();
        $post_id=$the_query_payment_method->post->ID;
        $title=get_the_title($post_id);
        $content=apply_filters( "the_content", get_the_content( null,false ));
        $item=array();
        $item["id"]=$post_id;
        $item["title"]=$title;
        $item["content"]=$content;
        $data_payment_method[]=$item;
    }
    wp_reset_postdata();
}
$data=array();
$msg=array();
$checked=0;
?>
<h1 style="display: none;"><?php echo get_bloginfo( 'name', '' ); ?></h1>
<div class="box-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php include get_template_directory()."/block/block-breadcrumb.php"; ?>
            </div>
        </div>
    </div>
</div>
<div class="box-category-product margin-top-40">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="khuyen-mai-theo-ngay">
                    <?php
                    if(have_posts()){
                        while (have_posts()) {
                            the_post();
                            echo get_the_title();
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php include get_template_directory()."/block/block-category-menu-product.php"; ?>
            </div>
            <div class="col-lg-9">
                <?php
                if(count(@$arrCart) > 0){
                    ?>
                    <form method="POST" name="com_product_zcart" class="margin-top-20">
                        <table class="com-product-cart" cellpadding="0" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng giá</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($arrCart as $key => $value){
                                    $total_quantity+=(float)@$value["product_quantity"];
                                    $total_price+=(float)@$value["product_total_price"];
                                    $link_delete="index.php?action=delete&id=".(float)@$value["product_id"];
                                    ?>
                                    <tr>
                                        <td><?php echo @$value["product_sku"]; ?></td>
                                        <td><a href="<?php echo get_the_permalink(@$value["product_id"]); ?>" class="com-product-product-name-permalink"><?php echo @$value["product_name"]; ?></a></td>
                                        <td class="text-right"><?php echo fnPrice(@$value["product_price"]); ?> đ</td>

                                        <td class="text-center"><?php echo fnPrice(@$value["product_quantity"]); ?></td>

                                        <td class="text-right"><?php echo fnPrice(@$value["product_total_price"]) ?> đ</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Tổng cộng
                                    </td>
                                    <td class="text-center"><?php echo fnPrice(@$total_quantity); ?></td>
                                    <td class="text-right"><?php echo fnPrice(@$total_price)  ; ?> đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <?php
                    if(count(@$zController->_data["data"]) > 0){
                        $data=@$zController->_data["data"];
                    }
                    $msg=@$zController->_data["msg"];
                    $checked=@$zController->_data["checked"];
                    if(count(@$msg) > 0){
                        $type_msg='';
                        if((float)@$checked == 1){
                            $type_msg='note-success';
                        }else{
                            $type_msg='note-danger';
                        }
                        ?>
                        <div class="note2 margin-top-5 <?php echo $type_msg; ?>" >
                            <ul>
                                <?php
                                foreach (@$msg as $key => $value) {
                                    ?>
                                    <li><?php echo $value; ?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <form name="com_product_checkout" method="POST" >
                        <input type="hidden" name="action" value="confirmed-checkout" />
                        <input type="hidden" name="total_price" value="<?php echo @$total_price; ?>" />
                        <input type="hidden" name="total_quantity" value="<?php echo @$total_quantity; ?>" />
                        <?php wp_nonce_field("confirmed-checkout",'security_code',true);?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="com-product-wrapper-chout">
                                    <h2 class="com-product-shopping-cart-header-checkout" >Thông tin khách hàng</h2>
                                    <div  class="com-product-box-checkout" >
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4">Email:</div>
                                            <div class="col-md-8"><input type="text" name="email" class="com-product-checkout-txt" value="<?php echo @$data["email"]; ?>" placeholder="Email"></div>
                                        </div>
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4">Họ tên:</div>
                                            <div class="col-md-8"><input type="text" name="fullname" class="com-product-checkout-txt" value="<?php echo @$data["fullname"]; ?>" placeholder="Họ tên"></div>
                                        </div>
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4">Địa chỉ:</div>
                                            <div class="col-md-8"><input type="text" name="address" class="com-product-checkout-txt" value="<?php echo @$data["address"]; ?>" placeholder="Địa chỉ"></div>
                                        </div>
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4">Số điện thoại:</div>
                                            <div class="col-md-8"><input type="text" name="phone" class="com-product-checkout-txt" value="<?php echo @$data["phone"]; ?>" placeholder="Số điện thoại"></div>
                                        </div>
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4">Ghi chú:</div>
                                            <div class="col-md-8"><textarea name="note" cols="65" rows="5" class="com-product-checkout-txt" placeholder="Ghi chú"><?php echo @$data["note"]; ?></textarea></div>
                                        </div>
                                        <div class="row margin-bottom-5">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-8">
                                                <div class="com-product-checkout-submit"><a href="javascript:void(0);" onclick="document.forms['com_product_checkout'].submit();"><span><i class="fas fa-file-invoice-dollar"></i></span><span class="margin-left-5">Thanh toán</span></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="com-product-wrapper-chout">
                                    <h2 class="com-product-shopping-cart-header-checkout" >Hình thức thanh toán</h2>
                                    <div  class="com-product-box-checkout" >
                                        <div class="row">
                                            <div class="col">Vui lòng chọn một hình thức thanh toán</div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col">
                                                <select class="com-product-payment-method-selected" name="payment_method_id" onchange="changePaymentMethod(this);">
                                                    <?php
                                                    foreach ($data_payment_method as $key => $value) {
                                                        $payment_method_id=$value["id"];
                                                        $title=$value["title"];
                                                        if((float)@$data["payment_method_id"] == (float)@$payment_method_id){
                                                            echo '<option selected value="'.$payment_method_id.'">'.$title.'</option>';
                                                        }
                                                        else{
                                                            echo '<option          value="'.$payment_method_id.'">'.$title.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="com-product-payment-method-content"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                }else{
                    ?>
                    <div class="text-center">Giỏ hàng rỗng</div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>