<?php
get_header();
$productModel=$zController->getModel("/frontend","ProductModel");
/* start set the_query */
$the_query_video=null;

$args = $wp_query->query;
$args['orderby']='id';
$args['order']='DESC';
$wp_query->query($args);
$the_query_video=$wp_query;
/* end set the_query */
/* start setup pagination */
$totalItemsPerPage=6;
$pageRange=3;
$currentPage=1;
if(!empty(@$_POST["filter_page"]))          {
    $currentPage=@$_POST["filter_page"];
}
$productModel->setWpQuery($the_query_video);
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
<h1 style="display: none;"><?php echo bloginfo( "name" ); ?></h1>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if($the_query_video->have_posts()){
                ?>
                <form class="category-box-video" method="POST">
                    <input type="hidden" name="filter_page" value="1" />
                    <div class="box-news-list-video">
                        <?php
                        $k=0;
                        while($the_query_video->have_posts()) {
                            $the_query_video->the_post();
                            $post_id=$the_query_video->post->ID;
                            $title=get_the_title($post_id);
                            $video_id=get_field("video_id",@$post_id);
                            $featured_img=get_the_post_thumbnail_url($post_id, 'full');
                            if($k%2==0){
                                echo '<div class="row">';
                            }
                            ?>
                            <div class="col-md-6">
                                <div class="box-video-item">
                                    <div class="video-pin-box">
                                        <a href="javascript:void(0);" class="js-modal-btn" data-video-id="<?php echo @$video_id; ?>">
                                            <div>
                                                <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>">
                                            </div>
                                            <div class="overlay-youtube">
                                            </div>
                                            <div class="youtube-icon">
                                                <div class="youtube-bg"></div>
                                            </div>
                                        </a>
                                    </div>
                                    <h2 class="video-name"><a href="javascript:void(0);" class="js-modal-btn" data-video-id="<?php echo @$video_id; ?>" ><?php echo wp_trim_words(@$title, 15,"[...]" ) ; ?></a></h2>
                                </div>
                            </div>
                            <?php
                            $k++;
                            if($k%2 == 0 || $k==$the_query_video->post_count){
                                echo '</div>';
                            }
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