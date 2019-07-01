<?php
get_header();
$post_id=0;
$title="";
$excerpt="";
$permalink="";
$featured_img="";
$source_term_id=array();
$source_thumbnail=array();
$source_tinh_trang_con_hang=array();
$product_sku="";
$product_price=0;
$product_price_desc_percent=0;
$product_sale_price=0;
$product_price_tiet_kiem=0;
$content=null;
$source_term_trade=array();
$product_video_id="";
$data_product_tskt=array();
?>
<h1 style="display: none;"><?php echo get_bloginfo( 'name', 'raw' ); ?></h1>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <?php
            if(have_posts()){
                while (have_posts()) {
                    the_post();
                    $post_id=get_the_ID();
                    $title=get_the_title(@$post_id);
                    $excerpt=get_the_excerpt( @$post_id );
                    $content=apply_filters( "the_content", get_the_content( null, false ) );
                    $permalink=get_the_permalink( $post_id );
                    $featured_img=get_the_post_thumbnail_url(@$post_id, 'full');
                    $data_thumbnail=get_field("zaalbum_thumbnail_rpt",@$post_id,true);
                    foreach ($data_thumbnail as $key => $value) {
                        $source_thumbnail[]=$value["zaalbum_thumbnail_img"];
                    }
                }
                wp_reset_postdata();
            }
            ?>
            <div class="box-zaalbum">
                <h2 class="zaalbum-title"><?php echo @$title; ?></h2>
                <?php
                if(count(@$source_thumbnail) > 0){
                    ?>
                    <div class="owl-carousel-photo owl-carousel owl-theme owl-loaded">
                        <?php
                        $j=0;
                        $k=0;
                        foreach(@$source_thumbnail as $key => $value) {
                            if($j % 9 == 0){
                                echo '<div class="item">';
                            }
                            if($k % 3==0){
                                echo '<div class="row">';
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="box-album-item">
                                    <div class="box-item-news-img">
                                        <a href="<?php echo @$value; ?>">
                                            <img src="<?php echo @$value; ?>" alt="<?php echo @$title; ?>">
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
                            </div>
                            <?php
                            $k++;
                            $j++;
                            if($k % 3==0 || $k == 9){
                                echo '</div>';
                            }
                            if($j % 9 == 0 || $j == count(@$source_thumbnail)){
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
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