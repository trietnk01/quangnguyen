<?php
get_header();
global $zController;
$productModel=$zController->getModel("/frontend","ProductModel");
/* start set the_query */
$q="";
if(isset($_POST["q"])){
    $q=trim($_POST["q"]);
}
$args = array(
    'post_type' => 'zavideo',
    'orderby' => 'id',
    'order'   => 'DESC',
    "s"=>@$q,
    'posts_per_page' => 9,
  );
$the_query=new WP_Query($args);
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
$title="";
if(have_posts()){
    while (have_posts()) {
        the_post();
        $post_id= get_the_id();
        $title=get_the_title($post_id);
    }
    wp_reset_postdata();
}
?>
<div class="container">
    <?php include get_template_directory()."/block/block-breadcrumb.php"; ?>
    <div class="row">
        <div class="col">
            <?php include get_template_directory()."/block/block-search-video.php"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="category-video" method="POST">
                <input type="hidden" name="filter_page" value="1" />
                <h1 class="category-video-title"><?php echo @$title; ?></h1>
                <?php require_once PLUGIN_PATH . DS . "templates" . DS . "frontend". DS . "loop-za-category-video.php"; ?>
            </form>
        </div>
    </div>
</div>
<?php
get_footer();
?>