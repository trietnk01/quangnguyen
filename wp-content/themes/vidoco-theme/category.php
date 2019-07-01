<?php
get_header();
$productModel=$zController->getModel("/frontend","ProductModel");
/* start set the_query */
$the_query_category=null;

$args = $wp_query->query;
$args['orderby']='id';
$args['order']='DESC';
$s="";
if(isset($_POST["s"])){
    $s=trim($_POST["s"]);
}
if(!empty(@$s)){
    $args["s"] =@$s;
}
$wp_query->query($args);
$the_query_category=$wp_query;
/* end set the_query */
/* start setup pagination */
$totalItemsPerPage=4;
$pageRange=3;
$currentPage=1;
if(!empty(@$_POST["filter_page"]))          {
    $currentPage=@$_POST["filter_page"];
}
$productModel->setWpQuery($the_query_category);
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
?>
<h1 style="display: none;"><?php echo get_bloginfo( 'name', 'raw' ); ?></h1>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if($the_query_category->have_posts()){
                ?>
                <form class="category-box" method="POST">
                    <input type="hidden" name="filter_page" value="1" />
                    <div class="box-news-list">
                        <?php
                        $i=0;
                        while($the_query_category->have_posts()) {
                            $the_query_category->the_post();
                            $post_id=$the_query_category->post->ID;
                            $title=get_the_title($post_id);
                            $permalink=get_the_permalink($post_id);
                            $date_post=get_the_date( 'd/m/Y',@$post_id );
                            $featured_img=get_the_post_thumbnail_url($post_id, 'full');
                            $excerpt=get_field("single_article_excerpt",@$post_id);
                            $source_term = wp_get_object_terms( $post_id,  'category' );
                            ?>
                            <div class="box-post-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-item-news-img">
                                            <a href="<?php echo @$permalink; ?>">
                                                <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>">
                                                <div class="panel-top-to-bottom"></div>
                                                <div class="panel-bottom-to-top"></div>
                                                <div class="panel-link">
                                                    <div class="panel-circle">
                                                        <i class="fas fa-link"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="box-post-info">
                                            <h2 class="box-post-tile"><a href="<?php echo @$permalink; ?>"><?php echo @$title; ?></a></h2>
                                            <div class="box-post-excerpt"><?php echo wp_trim_words( @$excerpt, 50, "[...]" ) ; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-post-category">
                                    <span class="fa-folder-box"><i class="far fa-folder-open"></i></span>
                                    <span class="chuyen-muc">Chuyên mục:</span>
                                    <?php
                                    foreach ($source_term as $key => $value) {
                                        $term_permalink=get_term_link( $value, 'category' );
                                        ?>
                                        <span class="taxonomy-name"><a href="<?php echo @$term_permalink; ?>"><?php echo @$value->name; ?></a></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="category-pagination"><?php echo @$pagination->showPagination();?></div>
                </form>
                <?php
                wp_reset_postdata();
            }
            ?>
        </div>
        <div class="col-lg-4">
            <div class="box-info-right">
                <?php include get_template_directory()."/block/block-ceo.php"; ?>
                <?php include get_template_directory()."/block/block-tai-lieu-moi.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>