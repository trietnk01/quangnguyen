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
$product_so_tien_dong_gop=0;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="box-product-detail">
                <?php
                if(have_posts()){
                    while (have_posts()) {
                        the_post();
                        $post_id=get_the_ID();
                        $title=get_the_title(@$post_id);
                        $excerpt=get_the_excerpt( @$post_id );
                        $content=apply_filters( "the_content", get_the_content( null, false ) );
                        $permalink=get_the_permalink( $post_id );
                        $product_sku=get_field("zaproduct_sku",@$post_id,true);
                        $featured_img=get_the_post_thumbnail_url(@$post_id, 'full');
                        $source_term = wp_get_object_terms( @$post_id,  'za_category' );
                        if(count($source_term) > 0){
                            foreach ($source_term as $key => $value) {
                                $source_term_id[]=$value->term_id;
                            }
                        }
                        $product_price=get_field("zaproduct_price",@$post_id,true);
                        $product_price_desc_percent=get_field("zaproduct_price_desc_percent",@$post_id,true);
                        $product_sale_price=get_field("zaproduct_sale_price",@$post_id,true);
                        $product_price_tiet_kiem=(float)@$product_price - (float)@$product_sale_price;

                        $source_tinh_trang_con_hang=get_field("zaproduct_tinh_trang",@$post_id,true);
                        $data_thumbnail=get_field("zaproduct_thumbnail_rpt",@$post_id,true);
                        $source_thumbnail[]=$featured_img;
                        foreach ($data_thumbnail as $key => $value) {
                            $source_thumbnail[]=$value["zaproduct_thumbnail_img"];
                        }
                        $source_term_trade=wp_get_object_terms( @$post_id,"za_category_trade", array() );
                        $product_video_id=get_field("zaproduct_video_id",@$post_id,true);
                        $data_product_tskt=get_field("zaproduct_thong_so_ky_thuat_rpt",@$post_id);
                        $product_so_tien_dong_gop=get_field("zaproduct_so_tien_dong_gop",@$post_id);
                    }
                    wp_reset_postdata();
                }
                ?>
                <div class="row box-rox">
                    <div class="col-md-5">
                        <div class="box-product-detail-image">
                            <div class="owl-carousel-product-detail-img owl-carousel owl-theme owl-loaded">
                                <?php
                                foreach ($source_thumbnail as $key => $value) {
                                    ?>
                                    <div class="item">
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo @$value; ?>" alt="<?php echo @$title; ?>" class="mitom">
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="box-product-thumbnail">
                            <div class="owl-carousel-product-thumbnail owl-carousel owl-theme owl-loaded">
                                <?php
                                foreach ($source_thumbnail as $key => $value) {
                                    ?>
                                    <div class="item">
                                        <div class="thumbnail-item">
                                            <img src="<?php echo @$value; ?>" alt="<?php echo @$title; ?>" class="thumbnail-nio">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="box-product-detail-schema" itemscope itemtype="http://schema.org/NewsArticle">
                            <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
                            <h1 class="product-detail-title" itemprop="headline"><?php echo @$title; ?></h1>
                            <h2 style="display: none;"><?php echo get_bloginfo( 'name', 'raw' ); ?></h2>
                            <!-- begin schema -->
                            <p style="display: none;" itemprop="author" itemscope itemtype="https://schema.org/Person"> By <span itemprop="name">DienKim</span>
                            </p>
                            <p style="display: none;" itemprop="description"><?php echo @$title; ?></p>
                            <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject" style="display: none;">
                                <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>"/>
                                <meta itemprop="url" content="<?php echo @$featured_img; ?>">
                                <meta itemprop="width" content="800">
                                <meta itemprop="height" content="800">
                            </div>
                            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="display: none;">
                                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                    <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>"/>
                                    <meta itemprop="url" content="<?php echo @$featured_img; ?>">
                                    <meta itemprop="width" content="600">
                                    <meta itemprop="height" content="60">
                                </div>
                                <meta itemprop="name" content="Google">
                            </div>
                            <meta itemprop="datePublished" content="2015-02-05T08:00:00+08:00" style="display: none;" />
                            <meta itemprop="dateModified" content="2015-02-05T09:20:00+08:00" style="display: none;" />
                            <!-- end schema -->
                            <div class="post-kk-star-rating">
                                <?php echo do_shortcode( "[ratings]" ); ?>
                            </div>
                            <div class="post-share-facebook">
                                <div class="fb-share-button" data-href="<?php echo @$permalink; ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo @$permalink; ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                            </div>
                            <div class="ma-sp-thuong-hieu">
                                <span class="msp-label">Mã sản phẩm:</span>
                                <span class="msp-text"><?php echo @$product_sku; ?></span>
                                <span class="thuong-hieu-label">Thương hiệu:</span>
                                <?php
                                if(count(@$source_term_trade) > 0){
                                    $permalink_term_trade=get_term_link( @$source_term_trade[0], 'za_category_trade' );
                                    ?>
                                    <span class="thuong-hieu-text"><a href="<?php echo @$permalink_term_trade; ?>" ><?php echo @$source_term_trade[0]->name; ?></a></span>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="video-va-review-sp" >
                                <div class="video-icon">
                                    <?php
                                    if(!empty(@$product_video_id)){
                                        ?>
                                        <a href="javascript:void(0);" class="js-modal-btn" data-video-id="<?php echo @$product_video_id; ?>">
                                            <img src="<?php echo get_template_directory_uri()."/assets/images/icon-video.svg"; ?>" style="width: 100%;" alt="<?php echo @$title; ?>">
                                        </a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="javascript:void(0);">
                                            <img src="<?php echo get_template_directory_uri()."/assets/images/icon-video.svg"; ?>" style="width: 100%;" alt="<?php echo @$title; ?>">
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="video-label">
                                    Video
                                </div>
                                <div class="video-icon2">
                                    <a href="javascript:void();">
                                        <img src="<?php echo get_template_directory_uri()."/assets/images/icon-review.svg"; ?>" style="width: 100%;" alt="<?php echo @$title; ?>">
                                    </a>
                                </div>
                                <div class="video-label">
                                    Xem review sản phẩm
                                </div>
                                <div class="clr"></div>
                            </div>
                            <div class="product-detail-price">
                                <span class="product-sale-price"><?php echo fnPrice(@$product_sale_price); ?> ₫</span>
                                <?php
                                if(floatval(@$product_price) > floatval(@$product_sale_price)){
                                    ?>
                                    <span class="product-origin-price"><?php echo fnPrice(@$product_price); ?> ₫</span>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            if(floatval(@$product_so_tien_dong_gop) > 0){
                                ?>
                                <div class="mua-san-pham">
                                    Mua sản phẩm này bạn đã đóng góp <?php echo fnPrice(@$product_so_tien_dong_gop); ?> đ vào quỹ tiếp lửa
                                </div>
                                <?php
                            }
                            ?>
                            <!--<form class="product-detail-quantity-input-form" name="frm_mua_ngay">
                                <div class="product-detail-quantity">
                                    <div class="product-detail-quanity-label">
                                        Số lượng
                                    </div>
                                    <div class="product-detail-quantity-input" >
                                        <div class="btn-nhap-1"><a href="javascript:void(0);" onclick="minus(this);" class="quantity-left-minus"><i class="fas fa-minus"></i></a></div>
                                        <div class="input-nhap"><input name="quantity" value="1"  onkeypress="return isNumberKey(event);" class="quantity_cart" /></div>
                                        <div class="btn-nhap-2"><a href="javascript:void(0);" onclick="plus(this);" class="quantity-right-plus"><i class="fas fa-plus"></i></a></div>
                                        <div class="clr"></div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="product-detail-mua-ngay">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-alert-add-cart" onclick="javascript:addToCart(<?php echo $post_id; ?>,document.getElementsByName('quantity')[0].value);">
                                        Mua ngay
                                    </a>
                                    <a href="javascript:void(0);">Mua hàng trả góp</a>
                                </div>
                            </form>-->
                            <div class="mua-hang-qua-dien-thoai-text">Mua hàng qua điện thoại</div>
                            <div class="product-detail-mua-hang-qua-dt">
                                <div class="icon-mua-hang-qua-dt">
                                    <img src="<?php echo get_template_directory_uri()."/assets/images/24h-icon.svg" ?>" alt="<?php echo @$title; ?>">
                                </div>
                                <span class="product-detail-hotline"><a href="tel:<?php echo get_field("setting_thong_tin_chung_call_now","option"); ?>"><?php echo get_field("setting_thong_tin_chung_hotline","option"); ?></a></span>
                            </div>
                            <div class="product-detail-tai-sao-box">
                                <h2 class="tsnm">Tại sao nên mua sản phẩm tại <?php echo get_bloginfo( 'name','raw' ); ?></h2>
                                <div class="product-detail-box-slogan">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-1.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">Uy tín hàng đầu</h3>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-2.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">ĐỔI HÀNG DỄ DÀNG - MIỄN PHÍ</h3>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-3.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">THANH TOÁN DỄ DÀNG (COD)</h3>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-4.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">HẬU MÃI HÀNG ĐẦU</h3>

                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-5.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">HỖ TRỢ MIỄN PHÍ</h3>

                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="box-item-slogan">
                                                <div class="box-item-sl-img">
                                                    <img src="<?php echo get_template_directory_uri()."/assets/images/icon-6.svg"; ?>" alt="<?php echo @$title; ?>">
                                                </div>
                                                <div class="box-item-sl-info">
                                                    <h3 class="box-item-sl-title">1 ĐỔI 1</h3>

                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="product-info">
                            <div class="tab">
                                <button class="tablinks h-title" onclick="openCity(event, 'thong-so-ky-thuat')">Thông số kỹ thuật</button>
                                <button class="tablinks h-title" onclick="openCity(event, 'danh-gia')">Đánh giá</button>
                                <button class="tablinks h-title" onclick="openCity(event, 'chinh-sach-bao-hanh')">Chính sách bảo hành</button>
                                <button class="tablinks h-title" onclick="openCity(event, 'chinh-sach-giao-hang')">Chính sách giao hàng</button>
                                <button class="tablinks h-title" onclick="openCity(event, 'phuong-thuc-thanh-toan')">Phương thức thanh toán</button>
                                <div class="clr"></div>
                            </div>
                            <div id="thong-so-ky-thuat" class="tabcontent">
                                <?php
                                if(count(@$data_product_tskt) > 0){
                                    ?>
                                    <table >
                                        <tbody>
                                            <?php
                                            foreach ($data_product_tskt as $key => $value) {
                                                if(floatval($k)%2==0){
                                                    ?>
                                                    <tr>
                                                        <td  style="width: 30%"><span class="product-detail-tskt-label"><?php echo @$value["zaproduct_tskt_label"]; ?></span></td>
                                                        <td class="text-center" style="width: 40%" ><span>-</span></td>
                                                        <td ><?php echo @$value["zaproduct_tskt_chi_so"]; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                            <div id="danh-gia" class="tabcontent">
                                <div class="fb-comments" data-href="<?php echo @$permalink; ?>" data-width="" data-numposts="5"></div>
                            </div>
                            <div id="chinh-sach-bao-hanh" class="tabcontent">
                                <?php echo get_field("zaproduct_chinh_sach_bao_hanh","option"); ?>
                            </div>
                            <div id="chinh-sach-giao-hang" class="tabcontent">
                                <?php echo get_field("zaproduct_chinh_sach_giao_hang","option"); ?>
                            </div>
                            <div id="phuong-thuc-thanh-toan" class="tabcontent">
                                <?php echo get_field("zaproduct_payment_method","option"); ?>
                            </div>
                        </div>
                        <div class="product-detail-thong-so-ky-thuat margin-top-30">
                            <h3 class="khuyen-mai-theo-ngay">Thông số kỹ thuật</h3>
                            <div class="product-detail-tskt-ipad">
                                <?php
                                if(count(@$data_product_tskt) > 0){
                                    ?>
                                    <table >
                                        <tbody>
                                            <?php
                                            foreach ($data_product_tskt as $key => $value) {
                                                if(floatval($k)%2==0){
                                                    ?>
                                                    <tr>
                                                        <td  style="width: 30%"><span class="product-detail-tskt-label"><?php echo @$value["zaproduct_tskt_label"]; ?></span></td>
                                                        <td class="text-center" style="width: 40%" ><span>-</span></td>
                                                        <td ><?php echo @$value["zaproduct_tskt_chi_so"]; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                        $args = array(
                            'post_type' => 'zaproduct',
                            'orderby' => 'id',
                            'order'   => 'DESC',
                            'posts_per_page' => 12,
                            'post__not_in'=>array($post_id),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'za_category',
                                    'field'    => 'term_id',
                                    'terms'    => @$source_term_id,
                                ),
                            ),
                        );
                        $the_query_sp_lien_quan=new WP_Query($args);
                        if($the_query_sp_lien_quan->have_posts()){
                            ?>
                            <div class="box-product-detail-related">
                                <h3 class="khuyen-mai-theo-ngay">Sản phẩm tương tự</h3>
                                <div class="owl-carousel-product-related owl-carousel owl-theme owl-loaded">
                                    <?php
                                    while($the_query_sp_lien_quan->have_posts()){
                                        $the_query_sp_lien_quan->the_post();
                                        $post_id=$the_query_sp_lien_quan->post->ID;
                                        $permalink=get_the_permalink(@$post_id);
                                        $title=get_the_title(@$post_id);
                                        $excerpt=get_the_excerpt(@$post_id);
                                        $featured_img=get_the_post_thumbnail_url(@$post_id, 'full');
                                        $product_price=get_field("zaproduct_price",@$post_id);
                                        $product_price_desc_percent=get_field("zaproduct_price_desc_percent",@$post_id);
                                        $product_sale_price=get_field("zaproduct_sale_price",@$post_id);
                                        $product_count_view=get_field("zaproduct_count_view",@$post_id);
                                        ?>
                                        <div class="item">
                                            <div class="sale-off-on-day-box-item">
                                                <div class="sale-off-box-hinh-tron">
                                                    <a href="<?php echo @$permalink; ?>">
                                                        <img src="<?php echo @$featured_img; ?>" alt="<?php echo @$title; ?>">
                                                    </a>
                                                    <?php
                                                    if(floatval(@$product_price_desc_percent) > 0){
                                                        ?>
                                                        <div class="sale-off-box">
                                                            <div class="sale-off-txt">Sale off</div>
                                                            <div class="sale-off-number"><?php echo floatval(@$product_price_desc_percent) ; ?>%</div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <h3 class="sale-off-on-day-title">
                                                    <a href="<?php echo @$permalink; ?>"><?php echo wp_trim_words(@$title,55, "[...]" ) ?></a>
                                                    <div class="post-kk-star-rating">
                                                        <?php echo do_shortcode( "[ratings]" ); ?>
                                                    </div>
                                                </h3>
                                                <div class="sale-off-on-day-price">
                                                    <span class="sale-off-on-day-sale-price"><?php echo fnPrice(@$product_sale_price) ; ?> ₫</span>
                                                    <?php
                                                    if(floatval(@$product_price) > floatval(@$product_sale_price)){
                                                        ?>
                                                        <span class="sale-off-on-day-sale-original-price"><?php echo fnPrice(@$product_price); ?> ₫</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
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