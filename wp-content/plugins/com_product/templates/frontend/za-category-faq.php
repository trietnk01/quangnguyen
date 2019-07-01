<?php
get_header();
$productModel=$zController->getModel("/frontend","ProductModel");
/* start set the_query */
$the_query=null;

$args = $wp_query->query;
$args['orderby']='id';
$args['order']='DESC';
$wp_query->query($args);
$the_query=$wp_query;

/* end set the_query */
/* start setup pagination */
$totalItemsPerPage=14;
$pageRange=3;
$currentPage=1;
if(!empty(@$_POST["filter_page"]))          {
    $currentPage=@$_POST["filter_page"];
}
$productModel->setWpQuery($the_query);
$productModel->setPerpage($totalItemsPerPage);
$productModel->prepare_items();
$totalItems= $productModel->getTotalItems();
$arrPagination=array(
    "totalItems"=>$totalItems,
    "totalItemsPerPage"=>$totalItemsPerPage,
    "pageRange"=>$pageRange,
    "currentPage"=>$currentPage
);
$pagination=$zController->getPagination("Pagination",$arrPagination);
/* end setup pagination */
include get_template_directory()."/block/block-breadcrumb.php";
?>
<h1 style="display: none;"><?php echo bloginfo( "name" ); ?></h1>
<div class="container box-faq">
    <div class="row">
        <div class="col-lg-3">
            <?php include get_template_directory()."/block/block-category-menu-product.php";?>
        </div>
        <div class="col-lg-9">
            <?php
            if($the_query->have_posts()){
                ?>
                <ul class="ul-faq">
                    <?php
                    while($the_query->have_posts()){
                        $the_query->the_post();
                        $post_id=$the_query->post->ID;
                        $title=get_the_title(@$post_id);
                        $content = apply_filters('the_content',get_the_content( null, false ));
                        ?>
                        <li class="question-item2">
                            <a href="javascript:void(0);">
                                <span class="question-text"><?php echo @$title; ?></span>
                                <span class="angle-down"><i class="fas fa-plus"></i></span>
                            </a>
                            <div class="question-content2 content-off">
                                <?php echo @$content; ?>
                            </div>
                        </li>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>