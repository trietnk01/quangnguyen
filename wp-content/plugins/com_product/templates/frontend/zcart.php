<?php
get_header();
$ssName="vmart";
$ssValue="zcart";
$ssCart     = $zController->getSession('SessionHelper',$ssName,$ssValue);
$arrCart = @$ssCart->get($ssValue)['cart'];
$total_quantity=0;
$total_price=0;
$link_delete=null;
$page_id_zcart = $zController->getHelper('GetPageId')->get('_wp_page_template','zcart.php');
$page_id_checkout = $zController->getHelper('GetPageId')->get('_wp_page_template','checkout.php');
$permarlink_zcart = get_permalink($page_id_zcart);
$permarlink_checkout = get_permalink($page_id_checkout);
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
                        <input type="hidden" name="action" value="update-cart" />
                        <?php
                        wp_nonce_field("update-cart",'security_code',true);
                        ?>
                        <table class="com-product-cart" cellpadding="0" cellspacing="0" width="100%" >
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng giá</th>
                                    <th>Xóa</th>
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

                                        <td class="text-center"><input type="text" onkeypress="return isNumberKey(event);" value="<?php echo @$value["product_quantity"]; ?>" size="4" class="com-product-quantity" name="quantity[<?php echo @$value["product_id"]; ?>]"></td>

                                        <td class="text-right"><?php echo fnPrice(@$value["product_total_price"]) ?> đ</td>
                                        <td class="text-center"><a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa ?');" href="<?php echo site_url(@$link_delete,null); ?>"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <a href="<?php echo site_url('index.php?action=delete-all',null); ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa ?');" class="com-product-button-action-gio-hang"><span><i class="far fa-trash-alt"></i></span><span class="margin-left-5">Xóa giỏ hàng</span></a>
                                        <a href="javascript:void(0);" onclick="document.forms['com_product_zcart'].submit();" class="com-product-button-action-gio-hang" ><span><i class="fas fa-sync-alt"></i></span><span class="margin-left-5" >Cập nhật</span></a>
                                        <a href="<?php echo @$permarlink_checkout; ?>" class="com-product-button-action-gio-hang"><span><i class="fas fa-money-bill-wave"></i></span> <span class="margin-left-5">Thanh toán</span></a>
                                    </td>
                                    <td class="text-center"><?php echo fnPrice(@$total_quantity); ?></td>
                                    <td class="text-right"><?php echo fnPrice(@$total_price)  ; ?> đ</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    <?php
                }else{
                    ?>
                    <div class="text-center margin-top-15">Giỏ hàng rỗng</div>
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