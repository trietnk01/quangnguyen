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
    </div>
</div>
<?php
$ssValueCart="zcart";
$ssCart     = $zController->getSession('SessionHelper',$ssName,$ssValue);
$ssCart->reset();
get_footer();
?>